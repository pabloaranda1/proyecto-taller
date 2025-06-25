<?php
namespace App\Controllers;

use App\Models\FacturaModel;
use App\Models\DetalleFacturaModel;
use App\Models\ProductoModel;

class FacturaController extends BaseController
{
    public function ver($idFactura)
    {
        $session = session();
        $idUsuario = $session->get('id_usuario');

        $facturaModel = new FacturaModel();
        $detalleModel = new DetalleFacturaModel();
        $productoModel = new ProductoModel();

        $factura = $facturaModel->find($idFactura);

        if (!$factura || $factura['id_usuario'] != $idUsuario && !$session->get('es_admin')) {
            return redirect()->to('/usuario/perfil')->with('error', 'No tienes permiso para ver esta factura.');
        }

        $detalles = $detalleModel->where('id_factura', $idFactura)->findAll();

        foreach ($detalles as &$item) {
            $producto = $productoModel->find($item['id_producto']);
            $item['nombre_producto'] = $producto ? $producto['nombre'] : 'Producto eliminado';
        }

        return view('pages/compras/factura', [
            'factura' => $factura,
            'detalles' => $detalles
        ]);
    }
}
