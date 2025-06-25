<?php

namespace App\Controllers;
use App\Models\UsuarioModel;
use App\Models\DireccionModel;
use App\Models\FacturaModel;
use App\Models\DetalleFacturaModel;
use App\Models\ProductoModel;
use App\Controllers\BaseController;
use CodeIgniter\Controller;

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
                'id_direccion' => $usuario['id_direccion'],
                'es_admin'   => $usuario['es_admin'],
                'activo'     => $usuario['activo'],
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

public function perfil()
{
    $session = session();
    $usuarioId = $session->get('id_usuario');
    if (!$usuarioId) return redirect()->to('/login');

    $usuarioModel = new UsuarioModel();
    $facturaModel = new FacturaModel();
    $detalleModel = new DetalleFacturaModel();
    $productoModel = new ProductoModel();
    $direccionModel = new DireccionModel();

    $usuario = $usuarioModel->find($usuarioId);
    $direccion = $direccionModel->where('id_usuario', $usuarioId)->first();

    $facturas = $facturaModel->where('id_usuario', $usuarioId)->findAll();

    foreach ($facturas as &$factura) {
        // Cargar detalles para cada factura
        $detalles = $detalleModel->where('id_factura', $factura['id_factura'])->findAll();

        // Opcional: agregar nombre del producto a cada detalle
        foreach ($detalles as &$detalle) {
            $producto = $productoModel->find($detalle['id_producto']);
            $detalle['nombre_producto'] = $producto ? $producto['nombre'] : 'Producto no disponible';
        }

        $factura['detalles'] = $detalles;
    }
    unset($factura); // evitar referencias no deseadas

    return view('pages/perfil', [
        'usuario' => $usuario,
        'direccion' => $direccion,
        'facturas' => $facturas,
    ]);
}


public function actualizar()
{
    $usuarioId = session()->get('id_usuario');
    if (!$usuarioId) return redirect()->to('/login');

    $usuarioModel = new UsuarioModel();
    $data = [
        'nombre' => $this->request->getPost('nombre'),
        'email'  => $this->request->getPost('email')
    ];

    $usuarioModel->update($usuarioId, $data);
    session()->set($data); // Refresca la sesión

    return redirect()->back()->with('success', 'Datos actualizados correctamente.');
}

public function guardarDireccion()
{
    $usuarioId = session()->get('id_usuario');
    if (!$usuarioId) return redirect()->to('/login');

    $direccionModel = new DireccionModel();
    $data = [
        'calle'     => $this->request->getPost('calle'),
        'altura'    => $this->request->getPost('altura'),
        'ciudad'    => $this->request->getPost('ciudad'),
        'localidad' => $this->request->getPost('localidad'),
        'id_usuario'=> $usuarioId
    ];

    $direccion = $direccionModel->where('id_usuario', $usuarioId)->first();
    if ($direccion) {
        $direccionModel->update($direccion['id_direccion'], $data);
    } else {
        $direccionModel->insert($data);
    }

    return redirect()->back()->with('success', 'Dirección actualizada correctamente.');
}

public function desactivar()
{
    $usuarioId = session()->get('id_usuario');
    if (!$usuarioId) return redirect()->to('/login');

    $usuarioModel = new UsuarioModel();
    $usuarioModel->update($usuarioId, ['activo' => 0]);

    session()->destroy();
    return redirect()->to('/')->with('mensaje', 'Cuenta desactivada exitosamente.');
}

}

