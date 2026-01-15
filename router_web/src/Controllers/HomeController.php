<?php
// src/Controllers/HomeController.php

class HomeController {
    private $params;
    
    public function __construct($params = []) {
        $this->params = $params;
    }
    
    public function index() {
        $data = [
            'title' => 'Bienvenue sur notre site',
            'message' => 'Ceci est la page d\'accueil générée par notre système de routage.',
            'routes_examples' => [
                '/a-propos' => 'Page À propos',
                '/contact' => 'Page Contact',
                '/blog' => 'Liste des articles',
                '/blog/premier-article' => 'Article avec slug "premier-article"'
            ]
        ];
        
        $this->render('home/index', $data);
    }
    
    /**
     * Méthode de rendu de vue
     */
    protected function render($view, $data = []) {
        extract($data);
        
        // Inclure le template de base
        require_once VIEWS_PATH . '/layouts/base.php';
    }
    
    /**
     * Redirection
     */
    protected function redirect($url) {
        header('Location: ' . $url);
        exit();
    }
}
?>