
<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * ------------------------------------------------------------------
 * LavaLust - an opensource lightweight PHP MVC Framework
 * ------------------------------------------------------------------
 *
 * MIT License
 *
 * Copyright (c) 2020 Ronald M. Marasigan
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 *
 * @package LavaLust
 * @author Ronald M. Marasigan
 * @since Version 1
 */

/**
 * | -------------------------------------------------------------------
 * | URI ROUTING
 * | -------------------------------------------------------------------
 * | Here is where you can register web routes for your application.
 */

/** @var object $router */

// HOME
$router->get('/', 'Welcome::index');


// STUDENT
$router->get('/student', 'StudentController::index');

$router->get('/student/profile', 'StudentController::profile')
    ->middleware('student');


// USERS
$router->get('/users', 'UserController::index');


// PRODUCT CRUD ROUTES
$router->get('/products', 'ProductController::index')
    ->middleware('auth');

$router->get('/products/create', 'ProductController::create')
    ->middleware('auth');

$router->post('/products/store', 'ProductController::store')
    ->middleware('auth');

$router->get('/products/edit/{id}', 'ProductController::edit')
    ->middleware('auth');

$router->post('/products/update/{id}', 'ProductController::update')
    ->middleware('auth');

$router->get('/products/delete/{id}', 'ProductController::delete')
    ->middleware('auth');


// AUTHENTICATION ROUTES
$router->get('/login', 'AuthController::login');

$router->post('/login/authenticate', 'AuthController::authenticate');

$router->get('/logout', 'AuthController::logout');
