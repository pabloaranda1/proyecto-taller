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
$routes->get('/catalogo-invierno', 'Home::invierno');
$routes->get('/catalogo-verano', 'Home::verano');
$routes->get('/registro', 'UsuarioController::registrar');
$routes->post('/registro', 'UsuarioController::guardarRegistro');
$routes->get('/login', 'UsuarioController::login');
$routes->post('/login', 'UsuarioController::autenticarLogin');
$routes->get('/logout', 'UsuarioController::logout');

/*admin*/
$routes->group('admin', ['filter' => 'admin'], function ($routes) {
    $routes->get('/', 'AdminController::panel'); // Esto es /admin

    $routes->get('usuarios', 'AdminController::usuarios');
    $routes->get('usuarios/desactivados', 'AdminController::usuariosDesactivados');
    $routes->get('usuarios/ver_usuario/(:num)', 'AdminController::verUsuario/$1');
    $routes->get('usuarios/desactivar/(:num)', 'AdminController::desactivarUsuario/$1');
    $routes->get('usuarios/reactivar/(:num)', 'AdminController::reactivarUsuario/$1');

    $routes->get('productos', 'AdminController::productos');
    $routes->get('productos/agregar', 'AdminController::agregarProducto');
    $routes->post('productos/guardar', 'AdminController::guardarProducto');
    $routes->get('productos/eliminar/(:num)', 'AdminController::eliminarProducto/$1');
    $routes->get('productos/desactivados', 'AdminController::productosDesactivados');
    $routes->get('productos/reactivar/(:num)', 'AdminController::reactivarProducto/$1');
    $routes->get('productos/editar/(:num)', 'AdminController::editarProducto/$1');
    $routes->post('productos/actualizar/(:num)', 'AdminController::actualizarProducto/$1');
});

