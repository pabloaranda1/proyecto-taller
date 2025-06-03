<?php

namespace App\Models;
use CodeIgniter\Model;

class DetalleFacturaModel extends Model
{
    protected $table      = 'detalle_factura';
    protected $primaryKey = 'id_detalle_factura';

    protected $allowedFields = ['id_factura', 'id_producto', 'cantidad', 'precio', 'subtotal'];
    protected $useTimestamps = false;

    protected $returnType = 'array'; 
}

