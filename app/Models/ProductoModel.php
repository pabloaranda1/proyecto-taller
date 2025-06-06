<?php

namespace App\Models;
use CodeIgniter\Model;

class ProductoModel extends Model
{
    protected $table      = 'producto';
    protected $primaryKey = 'id_producto';

    protected $allowedFields = ['nombre', 'categoria', 'precio', 'stock', 'imagen', 'imagen2', 'activo'];
    protected $useTimestamps = false;

    protected $returnType = 'array'; 
}

