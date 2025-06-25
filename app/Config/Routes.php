<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/home', 'Home::index');
$routes->get('/contacto', 'Home::contacto');
$routes->get('/quienes-somos', 'Home::quienesSomos');
$routes->get('/comercio', 'Home::comercio');
$routes->get('/terminos', 'Home::terminos');

$routes->get('catalogo/(:segment)', 'CatalogoController::categoria/$1');
$routes->get('carrito', 'CarritoController::carrito');


$routes->get('/registro', 'UsuarioController::registrar');
$routes->post('/registro', 'UsuarioController::guardarRegistro');
$routes->get('/login', 'UsuarioController::login');
$routes->post('/login', 'UsuarioController::autenticarLogin');
$routes->get('/logout', 'UsuarioController::logout');

$routes->get('perfil', 'UsuarioController::perfil');
$routes->post('perfil/actualizar', 'UsuarioController::actualizar');
$routes->post('perfil/direccion', 'UsuarioController::guardarDireccion');
$routes->post('perfil/desactivar', 'UsuarioController::desactivar');
$routes->get('perfil/facturas', 'UsuarioController::facturas');

/*admin*/
$routes->group('admin', ['filter' => 'admin'], function ($routes) {
    $routes->get('/', 'AdminController::panel'); // Esto es /admin

    $routes->get('usuarios', 'AdminController::usuarios');
    $routes->get('usuarios/desactivados', 'AdminController::usuariosDesactivados');
    $routes->get('usuarios/ver_usuario/(:num)', 'AdminController::verUsuario/$1');
    $routes->get('usuarios/desactivar/(:num)', 'AdminController::desactivarUsuario/$1');
    $routes->get('usuarios/reactivar/(:num)', 'AdminController::reactivarUsuario/$1');
    $routes->post('usuarios/actualizar/(:num)', 'AdminController::actualizarUsuario/$1');
    $routes->get('usuarios/desactivar/(:num)', 'AdminController::desactivarUsuario/$1');
    $routes->get('usuarios/facturas/(:num)', 'AdminController::mostrarFacturasUsuario/$1');


    $routes->get('productos', 'AdminController::productos');
    $routes->get('productos/agregar', 'AdminController::agregarProducto');
    $routes->post('productos/guardar', 'AdminController::guardarProducto');
    $routes->get('productos/eliminar/(:num)', 'AdminController::eliminarProducto/$1');
    $routes->get('productos/desactivados', 'AdminController::productosDesactivados');
    $routes->get('productos/reactivar/(:num)', 'AdminController::reactivarProducto/$1');
    $routes->get('productos/editar/(:num)', 'AdminController::editarProducto/$1');
    $routes->post('productos/actualizar/(:num)', 'AdminController::actualizarProducto/$1');

    $routes->get('consultas', 'AdminController::consultas');
    $routes->get('consultasSinSesion', 'AdminController::consultasSinSesion');
    $routes->post('consultas/estado/(:segment)/(:num)', 'AdminController::cambiarEstado/$1/$2');
    $routes->get('consultas/toggleLeido/(:num)', 'AdminController::toggleLeido/$1');
    $routes->get('consultasSinSesion/toggleLeido/(:num)', 'AdminController::toggleLeidoSinSesion/$1');
    $routes->get('consultas/ver/(:num)', 'AdminController::verConsulta/$1');
    $routes->get('consultasSinSesion/ver/(:num)', 'AdminController::verConsultaSinSesion/$1');

});


$routes->post('consultas/enviar', 'ConsultaController::enviar');

$routes->post('carrito/agregar', 'CarritoController::agregar');
$routes->get('carrito/eliminar/(:num)', 'CarritoController::eliminarItem/$1');
$routes->get('carrito/actualizar/(:num)', 'CarritoController::actualizarItem/$1');
$routes->get('carrito/confirmar', 'CarritoController::confirmarCompra');
$routes->post('carrito/confirmar', 'CarritoController::guardarCompra');

$routes->get('factura/ver/(:num)', 'FacturaController::ver/$1');
