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
    $routes->get('eliminar/(:num)', 'Mascotas::eliminar/$1'); // Ruta para eliminar mascota
    $routes->get('ver/(:segment)', 'Mascotas::ver/$1'); // Ver perro y QR por qr_data
    $routes->post('guardar-ubicacion', 'Mascotas::guardarUbicacion'); // Para guardar la ubicación vía AJAX
});

/**
 * Rutas para la gestión de usuarios (solo para administradores).
 * El filtro 'auth' asegura que solo usuarios logueados puedan intentar acceder.
 * La autorización final (si es admin o no) se hace en el controlador Usuarios.
 */
$routes->group('usuarios', ['filter' => 'auth'], static function ($routes) {
    $routes->get('gestionar', 'Usuarios::gestionar');
    $routes->get('nuevo', 'Usuarios::nuevo');
    $routes->post('guardar', 'Usuarios::guardar');
    $routes->get('editar/(:num)', 'Usuarios::editar/$1');
    $routes->post('actualizar', 'Usuarios::actualizar');
    $routes->get('eliminar/(:num)', 'Usuarios::eliminar/$1');
});

// Rutas para Autenticación
$routes->get('login', 'Login::index');
$routes->post('login/authenticate', 'Login::authenticate');
$routes->get('logout', 'Login::logout');
