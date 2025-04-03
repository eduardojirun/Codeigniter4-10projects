<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('books-ajax', 'Home::booksAjax');

// jQuery client
$routes->get('jquery-client', 'JqueryBooks::index');

// Curl client
$routes->get('curl-get', 'CurlBooks::index');
$routes->get('curl-post', 'CurlBooks::createBooks');
$routes->get('curl-put/(:num)', 'CurlBooks::updateBooks/$1');
$routes->get('curl-delete/(:num)', 'CurlBooks::deleteBook/$1');
$routes->get('curl-patch/(:num)', 'CurlBooks::patchBook/$1');


// Guzzle client
$routes->get('guzzle-get', 'GuzzleBooks::index');
$routes->get('guzzle-post', 'GuzzleBooks::createBooks');
$routes->get('guzzle-put/(:num)', 'GuzzleBooks::updateBooks/$1');
$routes->get('guzzle-delete/(:num)', 'GuzzleBooks::deleteBook/$1');
$routes->get('guzzle-patch/(:num)', 'GuzzleBooks::patchBook/$1');
