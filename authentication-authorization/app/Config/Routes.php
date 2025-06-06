<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');


service('auth')->routes($routes);

// Superadmin
$routes->group('superadmin', ['filter' => 'superadmin'], function($routes) {
    // Otras rutas solo para administradores
    $routes->presenter('dashboard',  ['controller' => 'Superadmin\Dashboard'] );
});

// Admin
$routes->group('admin', ['filter' => 'admin'], function($routes) {
    // Otras rutas solo para administradores
    $routes->presenter('dashboard',  ['controller' => 'Admin\Dashboard'] );
});

// Developer
$routes->group('developer', ['filter' => 'developer'], function($routes) {
    // Otras rutas solo para administradores
    $routes->presenter('dashboard',  ['controller' => 'Developer\Dashboard'] );
});

// User
$routes->group('user', ['filter' => 'user'], function($routes) {
    // Otras rutas solo para administradores
    $routes->presenter('dashboard',  ['controller' => 'Users\Dashboard'] );
});

// Beta
$routes->group('beta', ['filter' => 'beta'], function($routes) {
    // Otras rutas solo para administradores
    $routes->presenter('dashboard',  ['controller' => 'Beta\Dashboard'] );
});

// Shield 
$routes->get('logout', 'Auth::logout');