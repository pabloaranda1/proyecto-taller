<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('home', 'Home::index');
$routes->get('/contacto', 'Home::contacto');
$routes->get('/quienes-somos', 'Home::quienesSomos');
$routes->get('/comercio', 'Home::comercio');
$routes->get('/terminos', 'Home::terminos');
$routes->get('catalogo-invierno', 'Home::invierno');
$routes->get('catalogo-verano', 'Home::verano');
