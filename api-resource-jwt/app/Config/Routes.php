<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');


// Rutas abiertas
$routes->post("auth/register", "Api\AuthorsController::registerAuthor");
$routes->post("auth/login", "Api\AuthorsController::loginAuthor"); // token value

// APIs protegidas
$routes->group("author", ["namespace" => "App\Controllers\Api", "filter" => "jwt_auth"], function($routes){

    // Author Routes
    $routes->get("profile", "AuthorsController::authorProfile");
    $routes->get("logout", "AuthorsController::logoutAuthor");

    // Books Routes
    $routes->post("add-book", "BooksController::createBook");
    $routes->get("list-book", "BooksController::authorBooks");
    $routes->delete("delete-book/(:num)", "BooksController::deleteAuthorBook/$1");
});
