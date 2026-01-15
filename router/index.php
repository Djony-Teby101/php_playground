<?php
// index.php
session_start();

// Inclure les fichiers nécessaires
require_once './routes.php';

// Récupérer l'URL demandée
$url = $_GET['url'] ?? '/';

// Fonction de routage
function route($url, $routes) {
    foreach ($routes as $pattern => $handler) {
        // Convertir les paramètres dynamiques {id} en regex
        $pattern = preg_replace('/\{([a-z]+)\}/', '([^/]+)', $pattern);
        $pattern = "#^" . $pattern . "$#";
        
        if (preg_match($pattern, $url, $matches)) {
            array_shift($matches); // Retirer l'URL complète
            return ['handler' => $handler, 'params' => $matches];
        }
    }
    
    return null;
}

// Trouver la route correspondante
$route = route($url, $routes);

if ($route) {
    $handler = $route['handler'];
    $params = $route['params'];
    
    // Gérer les différentes formes de handlers
    if (is_callable($handler)) {
        call_user_func_array($handler, $params);
    } elseif (is_string($handler) && strpos($handler, '@') !== false) {
        // Format "Controller@method"
        list($controller, $method) = explode('@', $handler);
        require_once "controllers/{$controller}.php";
        $controllerInstance = new $controller();
        call_user_func_array([$controllerInstance, $method], $params);
    } else {
        echo $handler;
    }
} else {
    // 404 Not Found
    http_response_code(404);
    echo "Page non trouvée";
}