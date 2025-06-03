<?php

namespace App\Controllers;
use App\Models\UsuarioModel;

class UsuarioController extends BaseController
{
    public function login()
    {
        return view('/pages/auth/login');
    }

    public function autenticarLogin()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->where('email', $email)->first();

        if ($usuario && password_verify($password, $usuario['password'])) {
            session()->set([
                'id_usuario' => $usuario['id_usuario'],
                'nombre'     => $usuario['nombre'],
                'email'      => $usuario['email'],
                'celular'    => $usuario['celular'],
            ]);
            return redirect()->to('/');
        } else {
            return redirect()->back()->with('error', 'Credenciales inválidas');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }

    public function registrar()
    {
        return view('/pages/auth/registro');
    }

    public function guardarRegistro()
    {

    $usuarioModel = new UsuarioModel();

    $validation = \Config\Services::validation();
    $validation->setRules([
        'nombre'   => 'required|min_length[10]',
        'email'    => 'required|valid_email|is_unique[usuario.email]',
        'password' => 'required|min_length[8]',
        'celular'  => 'required'
    ]);

    if (!$validation->withRequest($this->request)->run()) {
        return redirect()->back()->withInput()->with('error', implode('<br>', $validation->getErrors()));
    }

    $data = [
        'nombre'      => $this->request->getPost('nombre'),
        'email'       => $this->request->getPost('email'),
        'password'    => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        'celular'     => $this->request->getPost('celular'),
        'id_direccion'=> null, 
        'es_admin'    => 0,
        'activo'      => 1
    ];

    $usuarioModel->insert($data);

    return redirect()->to('/login')->with('success', 'Registro exitoso. Ahora puedes iniciar sesión.');
}
}
