<div class="home-page">
    <h1><?php echo htmlspecialchars($title); ?></h1>
    <p><?php echo htmlspecialchars($message); ?></p>
    
    <h2>Exemples de routes disponibles:</h2>
    <ul>
        <?php foreach ($routes_examples as $route => $description): ?>
            <li><a href="<?php echo $route; ?>"><?php echo $description; ?></a></li>
        <?php endforeach; ?>
    </ul>
    
    <h2>Fonctionnalités du routeur:</h2>
    <ul>
        <li>Gestion des routes statiques (/contact, /a-propos)</li>
        <li>Gestion des routes dynamiques avec paramètres (/blog/{slug})</li>
        <li>Système de contrôleurs et actions</li>
        <li>Gestion des erreurs 404</li>
        <li>Séparation claire entre logique et présentation</li>
    </ul>
</div>