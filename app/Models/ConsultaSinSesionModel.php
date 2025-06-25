<?php

namespace App\Models;
use CodeIgniter\Model;

class ConsultaSinSesionModel extends Model
{
    protected $table      = 'consulta_sin_sesion';
    protected $primaryKey = 'id_consulta';

    protected $allowedFields = ['nombre', 'email', 'mensaje', 'leido', 'activo'];
    protected $useTimestamps = false;

    protected $returnType = 'array'; 
}