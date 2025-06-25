<?php

namespace App\Controllers;

use App\Models\ProductoModel;

class CatalogoController extends BaseController
{
    public function categoria($categoria)
{
    $titulo = ucfirst($categoria); // convierte "invierno" en "Invierno", etc.
    $productoModel = new \App\Models\ProductoModel();

    $productos = $productoModel
        ->where('activo', 1)
        ->where('categoria', $categoria)
        ->where('stock >', 0)
        ->findAll();

    // Obtenemos las cantidades que el usuario ya tiene en el carrito
    $itemsCarrito = [];
    $session = session();
    $usuarioId = $session->get('id_usuario');

    if ($usuarioId) {
        $carritoModel = new \App\Models\ItemCarritoModel();
        $items = $carritoModel->where('id_usuario', $usuarioId)->findAll();
        foreach ($items as $item) {
            $itemsCarrito[$item['id_producto']] = $item['cantidad'];
        }
    }

    return view('pages/catalogo', [
        'productos' => $productos,
        'titulo' => "Catálogo de $titulo",
        'itemsEnCarrito' => $itemsCarrito
    ]);
}

}