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

$routes->get('/admin', 'AdminController::panel');
$routes->get('/admin/usuarios', 'AdminController::usuarios');
$routes->get('/admin/productos', 'AdminController::productos');
$routes->get('admin/productos/agregar', 'AdminController::agregarProducto');
$routes->post('admin/productos/guardar', 'AdminController::guardarProducto');
$routes->get('admin/productos/eliminar/(:num)', 'AdminController::eliminarProducto/$1');
$routes->get('admin/productos/desactivados', 'AdminController::productosDesactivados');
$routes->get('admin/productos/reactivar/(:num)', 'AdminController::reactivarProducto/$1');
$routes->get('admin/productos/editar/(:num)', 'AdminController::editarProducto/$1');
$routes->post('admin/productos/actualizar/(:num)', 'AdminController::actualizarProducto/$1');

