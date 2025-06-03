<?php
<?php

namespace App\Controllers;
use App\Models\UsuarioModel;

class AdminController extends BaseController
{
    // Panel principal del admin (puedes crear la vista admin/panel.php)
    public function panel()
    {
        return view('admin/panel');
    }

    // Listado de usuarios
    public function usuarios()
    {
        $usuarioModel = new UsuarioModel();
        $usuarios = $usuarioModel->findAll();

        return view('admin/usuarios', ['usuarios' => $usuarios]);
    }

    // Ver un usuario específico
    public function verUsuario($id)
    {
        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->find($id);

        if (!$usuario) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Usuario no encontrado");
        }

        return view('admin/ver_usuario', ['usuario' => $usuario]);
    }

    public function panel()
    {
        return view('admin/panel');
    }

    // Agrega aquí más métodos para stock, pedidos, etc., usando sus respectivos modelos
}