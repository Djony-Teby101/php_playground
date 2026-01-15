<?php
// src/Controllers/BlogController.php

class BlogController {
    private $params;
    
    public function __construct($params = []) {
        $this->params = $params;
    }
    
    public function index() {
        $data = [
            'title' => 'Blog - Tous les articles',
            'articles' => $this->getArticles()
        ];
        
        $this->render('blog/index', $data);
    }
    
    public function show() {
        $slug = $this->params['slug'] ?? '';
        
        $article = $this->getArticleBySlug($slug);
        
        if (!$article) {
            $this->error404("Article non trouvé");
        }
        
        $data = [
            'title' => $article['title'],
            'article' => $article
        ];
        
        $this->render('blog/show', $data);
    }
    
    public function categorie() {
        $categorie = $this->params['categorie'] ?? '';
        
        $data = [
            'title' => "Articles de la catégorie: $categorie",
            'categorie' => $categorie,
            'articles' => $this->getArticlesByCategory($categorie)
        ];
        
        $this->render('blog/categorie', $data);
    }
    
    private function getArticles() {
        // Simulation de données
        return [
            ['id' => 1, 'slug' => 'premier-article', 'title' => 'Mon premier article', 'category' => 'general'],
            ['id' => 2, 'slug' => 'systeme-routage-php', 'title' => 'Créer un système de routage en PHP', 'category' => 'tutoriel'],
            ['id' => 3, 'slug' => 'php-vanilla', 'title' => 'Les avantages du PHP vanilla', 'category' => 'tutoriel']
        ];
    }
    
    private function getArticleBySlug($slug) {
        $articles = $this->getArticles();
        
        foreach ($articles as $article) {
            if ($article['slug'] === $slug) {
                return $article;
            }
        }
        
        return null;
    }
    
    private function getArticlesByCategory($category) {
        $articles = $this->getArticles();
        
        return array_filter($articles, function($article) use ($category) {
            return $article['category'] === $category;
        });
    }
    
    protected function render($view, $data = []) {
        extract($data);
        
        require_once VIEWS_PATH . '/layouts/base.php';
    }
    
    protected function error404($message = '') {
        http_response_code(404);
        
        $errorView = VIEWS_PATH . '/errors/404.php';
        
        if (file_exists($errorView)) {
            require_once $errorView;
        } else {
            echo "<h1>404 - Page non trouvée</h1>";
            if ($message) {
                echo "<p>$message</p>";
            }
        }
        exit();
    }
}
?>