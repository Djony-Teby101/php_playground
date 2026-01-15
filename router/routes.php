<?php
// routes.php

$routes = [
    // Pages statiques
    '/' => function() {
        require 'views/home.php';
    },
    
    '/apropos' => function() {
        require 'views/about.php';
    },
    
    '/contact' => function() {
        require 'views/contact.php';
    },
    
    // Routes avec paramètres
    '/article/{id}' => function($id) {
       
        echo "article/id";
    },
    
    '/user/{id}/{action}' => function($id, $action) {
        
        echo "article/id";
    },
    
    // API routes
    '/api/users' => 'UserController@index',
    '/api/users/{id}' => 'UserController@show',
];
