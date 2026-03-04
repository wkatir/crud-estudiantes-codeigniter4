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
$routes->post('/alumnos/delete/(:num)', 'Alumnos::delete/$1');

$routes->get('/alumnosxcarrera', 'Alumnosxcarrera::index');
$routes->post('/alumnosxcarrera/filtrar', 'Alumnosxcarrera::filtrar');

$routes->get('/carreras', 'Carreras::index');
$routes->get('/carreras/create', 'Carreras::create');
$routes->post('/carreras/store', 'Carreras::store');
$routes->get('/carreras/edit/(:segment)', 'Carreras::edit/$1');
$routes->post('/carreras/update/(:segment)', 'Carreras::update/$1');
$routes->post('/carreras/delete/(:segment)', 'Carreras::delete/$1');

// Materias CRUD
$routes->get('/materias', 'Materias::index');
$routes->get('/materias/create', 'Materias::create');
$routes->post('/materias/store', 'Materias::store');
$routes->get('/materias/edit/(:num)', 'Materias::edit/$1');
$routes->post('/materias/update/(:num)', 'Materias::update/$1');
$routes->post('/materias/delete/(:num)', 'Materias::delete/$1');

// Docentes CRUD
$routes->get('/docentes', 'Docentes::index');
$routes->get('/docentes/create', 'Docentes::create');
$routes->post('/docentes/store', 'Docentes::store');
$routes->get('/docentes/edit/(:num)', 'Docentes::edit/$1');
$routes->post('/docentes/update/(:num)', 'Docentes::update/$1');
$routes->post('/docentes/delete/(:num)', 'Docentes::delete/$1');

// Horarios - Inscripción de materias por docente
$routes->get('/horarios/inscripcion', 'Horarios::inscripcion');
$routes->post('/horarios/guardar', 'Horarios::guardarInscripcion');
$routes->get('/horarios/listado', 'Horarios::listado');
$routes->post('/horarios/filtrar', 'Horarios::filtrar');
$routes->get('/horarios/materias-docente/(:num)', 'Horarios::materiasDocente/$1');
$routes->post('/horarios/delete/(:num)', 'Horarios::delete/$1');

// Alumnos por materia
$routes->get('/alumnosxmateria', 'AlumnosxMateria::index');
$routes->post('/alumnosxmateria/filtrar', 'AlumnosxMateria::filtrar');
