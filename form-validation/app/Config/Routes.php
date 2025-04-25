<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// form-validation 
$routes->get('form', 'Forms::index');
$routes->post('form', 'Forms::index');

// form-validation ajax
$routes->get('employees', 'Forms::listEmployees');
$routes->post('employees', 'Forms::saveEmployee');
