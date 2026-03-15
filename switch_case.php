<?php 

// Gestionnaire des erreurs.
$erreur=[];

// type input form data.
$type_utilisateur=['Admin', 'Conducteur', 'Utilisateur'];
$session_connect= shuffle($type_utilisateur);

$session_connect=$type_utilisateur[0];
$session_connect=strtolower($session_connect);



try {

    switch ($session_connect) {
    
        case 'admin':
            var_dump("welcome Admin");
            break;
        
        case 'conducteur':
            var_dump("profile conducteur.");
            break;
        case 'utilisateur':
            var_dump("Bienvenu sur votre profile.");
            break;
        
        default:
        var_dump("un probleme est survenu.");
            break;
    }
} catch (PDOException $e) {
   $erreur[]="une erreur est survenu";
   return $erreur;
}


?>
