<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title ?? 'Mon Site'); ?></title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="/">Accueil</a></li>
                <li><a href="/a-propos">À propos</a></li>
                <li><a href="/contact">Contact</a></li>
                <li><a href="/blog">Blog</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        <div class="container">
            <?php 
            // Inclure la vue spécifique
            $viewFile = VIEWS_PATH . '/' . $view . '.php';
            if (file_exists($viewFile)) {
                require_once $viewFile;
            } else {
                echo "<p>Vue non trouvée: $view</p>";
            }
            ?>
        </div>
    </main>
    
    <footer>
        <p>&copy; <?php echo date('Y'); ?> Mon Site avec Routage PHP</p>
    </footer>
</body>
</html>