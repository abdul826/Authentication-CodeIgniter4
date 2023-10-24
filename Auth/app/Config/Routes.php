<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/auth', 'Auth::index');

$routes->get('/auth/register', 'Auth::register');

$routes->post('/auth/registerUser', 'Auth::registerUser');

$routes->post('/auth/loginUser', 'Auth::loginUser');

$routes->post('/auth/uploadImage', 'Auth::uploadImage');

$routes->get('/auth/logout', 'Auth::logout');

// Looged In route

$routes->group('', ['filter'=> 'AuthCheck'], function($routes){
    $routes->get('/dashboard', 'Dashboard::index');
});


