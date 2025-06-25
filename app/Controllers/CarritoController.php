<?php

namespace App\Controllers;

use App\Models\ItemCarritoModel;
use App\Models\ProductoModel;
use App\Models\DireccionModel;
use App\Models\FacturaModel;
use App\Models\DetalleFacturaModel;
use CodeIgniter\Controller;

class CarritoController extends Controller
{
    public function agregar()
{
    log_message('debug', '🟡 Iniciando agregar()');

    $session = session();
    $usuarioId = $session->get('id_usuario');

    if (!$usuarioId) {
        log_message('error', '🔴 Usuario no autenticado');
        return $this->response->setStatusCode(403)->setJSON([
            'status' => 'error',
            'message' => 'Debes iniciar sesión',
            'csrfName' => csrf_token(),
            'csrfHash' => csrf_hash()
        ]);
    }

    $productoId = $this->request->getPost('id_producto');
    $cantidad = (int) $this->request->getPost('cantidad');

    log_message('debug', "📦 Producto recibido: $productoId, Cantidad: $cantidad");

    if ($cantidad < 1) {
        log_message('error', '🔴 Cantidad inválida');
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Cantidad inválida',
            'csrfName' => csrf_token(),
            'csrfHash' => csrf_hash()
        ]);
    }

    $productoModel = new \App\Models\ProductoModel();
    $producto = $productoModel->find($productoId);

    if (!$producto || !$producto['activo']) {
        log_message('error', '🔴 Producto no encontrado o inactivo');
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Producto no disponible',
            'csrfName' => csrf_token(),
            'csrfHash' => csrf_hash()
        ]);
    }

    if ($cantidad > $producto['stock']) {
        log_message('error', '🔴 Stock insuficiente');
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Stock insuficiente',
            'csrfName' => csrf_token(),
            'csrfHash' => csrf_hash()
        ]);
    }

    $carritoModel = new \App\Models\ItemCarritoModel();

    $item = $carritoModel->where('id_usuario', $usuarioId)
                         ->where('id_producto', $productoId)
                         ->first();

    if ($item) {
        $nuevaCantidad = $item['cantidad'] + $cantidad;
        $carritoModel->update($item['id_item_carrito'], ['cantidad' => $nuevaCantidad]);
        log_message('debug', "🔄 Actualizado item existente. Nueva cantidad: $nuevaCantidad");
    } else {
        $carritoModel->insert([
            'id_usuario' => $usuarioId,
            'id_producto' => $productoId,
            'cantidad' => $cantidad
        ]);
        log_message('debug', "🆕 Insertado nuevo item en carrito.");
    }

    log_message('debug', '🟢 Todo correcto. Respuesta enviada');

    return $this->response->setJSON([
        'status' => 'success',
        'message' => 'Producto agregado al carrito',
        'csrfName' => csrf_token(),
        'csrfHash' => csrf_hash()
    ]);
}

public function carrito()
{
    $session = session();
    $usuarioId = $session->get('id_usuario');
    $referer = $this->request->getServer('HTTP_REFERER');

    if (!$usuarioId) {
        return redirect()->to('/login'); // O donde manejes la sesión
    }

    $carritoModel = new \App\Models\ItemCarritoModel();
    $productoModel = new \App\Models\ProductoModel();

    // Obtener los items del carrito del usuario
    $items = $carritoModel->where('id_usuario', $usuarioId)->findAll();

    $productosCarrito = [];

    $total = 0;

    foreach ($items as $item) {
        $producto = $productoModel->find($item['id_producto']);
        if ($producto) {
            $subtotal = $producto['precio'] * $item['cantidad'];
            $total += $subtotal;

            $productosCarrito[] = [
                'id_item_carrito' => $item['id_item_carrito'],
                'id_producto' => $producto['id_producto'],
                'nombre' => $producto['nombre'],
                'precio' => $producto['precio'],
                'cantidad' => $item['cantidad'],
                'subtotal' => $subtotal,
                'imagen' => $producto['imagen'],
                'stock' => $producto['stock']
            ];
        }
    }

    return view('pages/carrito', [
        'productosCarrito' => $productosCarrito,
        'total' => $total,
        'titulo' => 'Tu carrito de compras',
        'url_volver' => $referer
    ]);
}

    public function eliminarItem($id_item_carrito)
    {
        $session = session();
        $usuarioId = $session->get('id_usuario');
        if (!$usuarioId) return redirect()->to('/login');

        $carritoModel = new ItemCarritoModel();

        // Solo eliminar si el item pertenece al usuario
        $item = $carritoModel->where('id_item_carrito', $id_item_carrito)
                            ->where('id_usuario', $usuarioId)
                            ->first();

        if ($item) {
            $carritoModel->delete($id_item_carrito);
            session()->setFlashdata('mensaje', 'Producto eliminado del carrito.');
        }
        return redirect()->to('/carrito');
    }

    public function confirmarCompra()
{
    $session = session();
    $usuarioId = $session->get('id_usuario');
    if (!$usuarioId) return redirect()->to('/login');

    $direccionModel = new DireccionModel();
    // Buscamos dirección asociada al usuario (puede no existir)
    $direccion = $direccionModel->where('id_usuario', $usuarioId)->first();

    return view('pages/compras/confirmar_compra', [
        'direccion' => $direccion,
        'mediosPago' => ['Tarjeta', 'Efectivo', 'Transferencia']
    ]);
}


    public function guardarCompra()
    {   
        $session = session();
        $usuarioId = $session->get('id_usuario');
        if (!$usuarioId) return redirect()->to('/login');

        $facturaModel = new FacturaModel();
        $detalleModel = new DetalleFacturaModel();
        $carritoModel = new ItemCarritoModel();
        $productoModel = new ProductoModel();
        $direccionModel = new DireccionModel();

        // Recibo datos post
        $medioPago = $this->request->getPost('medio_pago');
        $tipoEntrega = $this->request->getPost('tipo_entrega');
        $usarDireccionExistente = $this->request->getPost('usar_direccion_existente');
        $datosDireccion = $this->request->getPost(['calle', 'altura', 'ciudad', 'localidad']);

        // Validar o insertar direccion
        if ($tipoEntrega === 'envio' && $usarDireccionExistente !== 'si') {
            // Validar campos direccion
            if (empty($datosDireccion['calle']) || empty($datosDireccion['altura']) || empty($datosDireccion['ciudad']) || empty($datosDireccion['localidad'])) {
                return redirect()->back()->with('error', 'Complete la dirección correctamente');
            }
            // Guardar o actualizar direccion
            $direccion = $direccionModel->where('id_usuario', $usuarioId)->first();
            $datosDireccion['id_usuario'] = $usuarioId;
            if ($direccion) {
                $direccionModel->update($direccion['id_direccion'], $datosDireccion);
            } else {
                $direccionModel->insert($datosDireccion);
            }
        }

        // Obtener items carrito
        $items = $carritoModel->where('id_usuario', $usuarioId)->findAll();
        if (!$items) {
            return redirect()->to('/carrito')->with('error', 'No hay productos en el carrito');
        }

        // Calcular total
        $total = 0;
        foreach ($items as $item) {
            $producto = $productoModel->find($item['id_producto']);
            if (!$producto) continue;
            $subtotal = $producto['precio'] * $item['cantidad'];
            $total += $subtotal;
        }

        // Insertar factura
        $facturaId = $facturaModel->insert([
            'id_usuario' => $usuarioId,
            'fecha' => date('Y-m-d H:i:s'),
            'total' => $total,
            // podrías guardar el medio de pago si querés agregar campo
        ]);

        // Insertar detalle factura
        foreach ($items as $item) {
            $producto = $productoModel->find($item['id_producto']);
            if (!$producto) continue;

            $detalleModel->insert([
                'id_factura' => $facturaId,
                'id_producto' => $item['id_producto'],
                'cantidad' => $item['cantidad'],
                'precio' => $producto['precio'],
                'subtotal' => $producto['precio'] * $item['cantidad']
            ]);

            // Reducir el stock del producto
            $nuevoStock = $producto['stock'] - $item['cantidad'];
            if ($nuevoStock < 0) $nuevoStock = 0;

            $productoModel->update($producto['id_producto'], ['stock' => $nuevoStock]);

        }

        // Vaciar carrito
        $carritoModel->where('id_usuario', $usuarioId)->delete();

        return view('pages/compras/exito_compra');
    }
}

