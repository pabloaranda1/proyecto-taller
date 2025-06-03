<?php

namespace App\Models;
use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table      = 'usuario';
    protected $primaryKey = 'id_usuario';

    protected $allowedFields = ['nombre', 'email', 'password', 'celular', 'id_direccion', 'activo', 'es_admin'];
    protected $useTimestamps = false;

    protected $returnType = 'array'; 
}

