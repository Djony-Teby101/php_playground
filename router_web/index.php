<?php
// index.php - Point d'entrée unique

// Configuration de base
define('BASE_PATH', dirname(__FILE__));
define('APP_PATH', BASE_PATH . '/src');
define('VIEWS_PATH', BASE_PATH . '/views');
define('PUBLIC_PATH', BASE_PATH . '/public');

// Autoloader simple
spl_autoload_register(function ($class) {
    $file = APP_PATH . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

// Inclusion des dépendances
require_once APP_PATH . '/Router.php';

// Démarrer la session
session_start();

// Configuration des routes
$routes = require_once BASE_PATH . '/config/routes.php';

// Instanciation du routeur
$router = new Router($routes);

// Récupération de l'URL demandée
$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '/';

// Traitement de la requête
$router->dispatch($url);
?>