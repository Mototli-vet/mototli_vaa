<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Mascotas::index');

// Ruta para el panel de administrador
$routes->get('dashboard', 'Mascotas::dashboard');

// Rutas para Perros
$routes->group('mascotas', function ($routes) {
    $routes->get('/', 'Mascotas::index'); // Listar perros
    $routes->get('informacion', 'Mascotas::informacion');
    $routes->get('misMascotas', 'Mascotas::misMascotas'); // Ver mis mascotas y QRs
    $routes->get('nuevo', 'Mascotas::nuevo'); // Formulario para nuevo perro
    $routes->post('guardar', 'Mascotas::guardar'); // Procesar el formulario de guardado
    $routes->get('ver/(:segment)', 'Mascotas::ver/$1'); // Ver perro y QR por qr_data
});

// Rutas para Autenticación
$routes->get('login', 'Login::index');
$routes->post('login/authenticate', 'Login::authenticate');
$routes->get('logout', 'Login::logout');
