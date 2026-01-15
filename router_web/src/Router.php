<?php
// src/Router.php

class Router {
    private $routes = [];
    private $params = [];
    private $basePath = '';
    
    public function __construct($routes = []) {
        $this->routes = $routes;
        $this->basePath = isset($_SERVER['BASE']) ? $_SERVER['BASE'] : '';
    }
    
    /**
     * Dispatch l'URL vers le contrôleur approprié
     */
    public function dispatch($url) {
        $url = $this->removeQueryStringVariables($url);
        
        if ($this->match($url)) {
            $controller = $this->params['controller'];
            $action = $this->params['action'];
            
            // Vérifier si le contrôleur existe
            $controllerFile = APP_PATH . '/Controllers/' . $controller . '.php';
            
            if (file_exists($controllerFile)) {
                require_once $controllerFile;
                
                // Créer une instance du contrôleur
                $controllerClass = $controller;
                $controllerInstance = new $controllerClass($this->params);
                
                // Appeler l'action
                if (method_exists($controllerInstance, $action)) {
                    call_user_func_array([$controllerInstance, $action], []);
                } else {
                    $this->error404("La méthode $action n'existe pas dans le contrôleur $controller");
                }
            } else {
                $this->error404("Le contrôleur $controller n'existe pas");
            }
        } else {
            $this->error404("Aucune route ne correspond à l'URL $url");
        }
    }
    
    /**
     * Compare l'URL avec les routes définies
     */
    private function match($url) {
        foreach ($this->routes as $route => $params) {
            // Convertir les paramètres de route {param} en regex
            $pattern = $this->buildPatternFromRoute($route);
            
            if (preg_match($pattern, $url, $matches)) {
                // Récupérer les valeurs des paramètres dynamiques
                foreach ($matches as $key => $value) {
                    if (is_string($key)) {
                        $params[$key] = $value;
                    }
                }
                
                $this->params = $params;
                return true;
            }
        }
        return false;
    }
    
    /**
     * Convertit une route avec paramètres en pattern regex
     */
    private function buildPatternFromRoute($route) {
        // Remplacer les paramètres {param} par des groupes nommés regex
        $pattern = preg_replace('/\{([a-z]+)\}/', '(?P<$1>[^\/]+)', $route);
        
        // Échapper les slashes et ajouter les délimiteurs
        $pattern = '@^' . $pattern . '$@i';
        
        return $pattern;
    }
    
    /**
     * Retire les variables de query string de l'URL
     */
    private function removeQueryStringVariables($url) {
        if ($url != '') {
            $parts = explode('&', $url, 2);
            
            if (strpos($parts[0], '=') === false) {
                $url = $parts[0];
            } else {
                $url = '';
            }
        }
        return $url;
    }
    
    /**
     * Génère une URL à partir d'un nom de route
     */
    public function generate($routeName, $params = []) {
        if (isset($this->routes[$routeName])) {
            $route = $routeName;
            
            // Remplacer les paramètres dans la route
            foreach ($params as $key => $value) {
                $route = str_replace('{' . $key . '}', $value, $route);
            }
            
            return $this->basePath . $route;
        }
        return null;
    }
    
    /**
     * Affiche une page d'erreur 404
     */
    private function error404($message = '') {
        http_response_code(404);
        
        // Vue d'erreur 404
        $errorView = VIEWS_PATH . '/errors/404.php';
        
        if (file_exists($errorView)) {
            require_once $errorView;
        } else {
            echo "<h1>404 - Page non trouvée</h1>";
            if ($message) {
                echo "<p>$message</p>";
            }
            echo "<p><a href='/'>Retour à l'accueil</a></p>";
        }
        exit();
    }
}
?>