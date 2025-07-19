<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Mascotas::index');


// Rutas para Mascotas.
// Usamos el filtro 'auth' para proteger las rutas que requieren inicio de sesión.
// Asegúrate de tener configurado el filtro 'auth' en app/Config/Filters.php
$routes->get('mascotas', 'Mascotas::dashboard', ['filter' => 'auth']); // Dashboard de mascotas
$routes->get('mascotas/nuevo', 'Mascotas::nuevo', ['filter' => 'auth']); // Formulario para nueva mascota
$routes->post('mascotas/guardar', 'Mascotas::guardar', ['filter' => 'auth']); // Guardar la nueva mascota

// Rutas públicas que no requieren login
$routes->get('mascotas/informacion', 'Mascotas::informacion'); // Página de información general
$routes->get('mascotas/ver/(:any)', 'Mascotas::ver/$1'); // Vista pública del QR

// Rutas para Autenticación
$routes->get('login', 'Login::index');
$routes->post('login/authenticate', 'Login::authenticate');
$routes->get('logout', 'Login::logout');
