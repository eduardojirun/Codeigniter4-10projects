<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->presenter('books');
$routes->get('/books/(:num)', 'Books::index/$1');
