<?php

use App\Controllers\Home;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
// $routes->get('/runMigrateSeeds', 'Home::runMigrateSeeds');

$routes->group("api", ["namespace" => "App\Controllers\Api", 'filter' => 'cors'], function($routes){
    $routes->resource('books');
    $routes->resource('authors');
    // $routes->options('books/(:any)', static function () {});
});
// $routes->get('/books/(:num)', 'Books::index/$1');
