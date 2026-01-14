<?php
// nettoyer et valider de la data.

// Recuperation de la data.
$username = "lorince";
$email = "lorince21@gmail.com";
$password = 'mars2026';
$fake_pass = "mars";

// crypté le mots de base.
$pass_Hash = password_hash($password, PASSWORD_DEFAULT);


// Vérification avant validation du formulaire.
if (empty($username)) {
    $erreur[] = 'Le nom est requis';
}
if (!empty($email) || filter_var($email, FILTER_VALIDATE_EMAIL)) {

    if (!password_verify($password, $pass_Hash)) {
        $erreur[] = 'Email est invalide ou mots de passe incorrect !';
        http_response_code(404);
        echo json_encode($erreur);
    }
    $succes[] = 'Bienvenue, ' . $username;
    http_response_code(200);
    echo json_encode($succes);
};
