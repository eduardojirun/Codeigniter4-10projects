<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Books;

/**
 * @var RouteCollection $routes
 */
$routes->view('/', 'welcome_message');
$routes->view('scrud_bootstrap', 'bootstrap/scrud_bootstrap');
$routes->view('form_validation', 'bootstrap/form_validation');
// $routes->get('/', 'Home::index');
$routes->get('/quizzes/(:num)', 'Quizzes::index/$1');
$routes->get('/quizzes/search/(:segment)', 'Quizzes::search/$1');
$routes->get('/quizzes/search/(:segment)/(:num)', 'Quizzes::search/$1/$2');
$routes->resource('quizzes');

$routes->resource('books');

/* $routes->post('books', 'Books::create');
$routes->get('books', 'Books::index'); */


