<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

/* $routes->group('acme', ['namespace' => 'Promotion\Controllers'], static function ($routes) {
    $routes->get('home', 'Home::index');
}); */

// Routes app to API
$routes->group('', ['namespace' => 'App\Controllers'], static function ($routes) {
    $routes->get('promotions', 'PromotionsController::index');
    $routes->post('promotions', 'PromotionsController::create');
    $routes->patch('promotions/(:num)', 'AuthController::update/$1');
});

// Routes to Module Acme/Promotions
$routes->get('home', '\Promotion\Controllers\Home::index', ['filter' => 'promotion']);
$routes->get('expired', '\Promotion\Controllers\Home::expired', ['filter' => 'expired']);