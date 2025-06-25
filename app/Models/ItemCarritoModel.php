<?php

namespace App\Models;
use CodeIgniter\Model;

class ItemCarritoModel extends Model
{
    protected $table      = 'item_carrito';
    protected $primaryKey = 'id_item_carrito';

    protected $allowedFields = ['id_usuario', 'id_producto', 'cantidad'];
    protected $useTimestamps = false;

    protected $returnType = 'array'; 
}

