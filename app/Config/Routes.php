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

$routes->get('/alumnosxcarrera', 'Alumnosxcarrera::index');
$routes->post('/alumnosxcarrera/filtrar', 'Alumnosxcarrera::filtrar');

$routes->get('/carreras', 'Carreras::index');
$routes->get('/carreras/create', 'Carreras::create');
$routes->post('/carreras/store', 'Carreras::store');
$routes->get('/carreras/edit/(:segment)', 'Carreras::edit/$1');
$routes->post('/carreras/update/(:segment)', 'Carreras::update/$1');
$routes->get('/carreras/delete/(:segment)', 'Carreras::delete/$1');
