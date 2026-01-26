<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/alumnos', 'Alumnos::index');
$routes->get('/alumnos/create', 'Alumnos::create');
$routes->post('/alumnos/store', 'Alumnos::store');
$routes->get('/alumnos/edit/(:num)', 'Alumnos::edit/$1');
$routes->post('/alumnos/update/(:num)', 'Alumnos::update/$1');
$routes->get('/alumnos/delete/(:num)', 'Alumnos::delete/$1');
