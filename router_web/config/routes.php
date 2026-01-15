<?php
// config/routes.php

return [
    // Route d'accueil
    '/' => [
        'controller' => 'HomeController',
        'action' => 'index'
    ],
    
    // Page à propos
    '/a-propos' => [
        'controller' => 'AboutController',
        'action' => 'index'
    ],
    
    // Page contact
    '/contact' => [
        'controller' => 'ContactController',
        'action' => 'index'
    ],
    '/contact/traitement' => [
        'controller' => 'ContactController',
        'action' => 'traitement'
    ],
    
    // Blog avec paramètres dynamiques
    '/blog' => [
        'controller' => 'BlogController',
        'action' => 'index'
    ],
    '/blog/{slug}' => [
        'controller' => 'BlogController',
        'action' => 'show'
    ],
    '/blog/categorie/{categorie}' => [
        'controller' => 'BlogController',
        'action' => 'categorie'
    ],
    
    // Exemple d'API REST
    '/api/articles' => [
        'controller' => 'ApiController',
        'action' => 'articles'
    ],
    '/api/articles/{id}' => [
        'controller' => 'ApiController',
        'action' => 'article'
    ]
];
?>