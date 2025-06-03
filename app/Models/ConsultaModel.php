<?php

namespace App\Models;
use CodeIgniter\Model;

class ConsultaModel extends Model
{
    protected $table      = 'consulta';
    protected $primaryKey = 'id_consulta';

    protected $allowedFields = ['nombre', 'descripcion', 'categoria', 'precio', 'stock', 'imagen', 'activo'];
    protected $useTimestamps = false;

    protected $returnType = 'array'; 
}

