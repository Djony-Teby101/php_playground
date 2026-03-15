<?php 

$type_utilisateur="Admin";

switch ($type_utilisateur) {
    case 'Admin':
        var_dump("welcome Admin");
        break;
    
    case 'Conducteur':
        var_dump("profile redacteur");
        break;
    case 'utilisateur':
        var_dump("welcome here");
        break;
    
    default:
       var_dump("un probleme est survenu");
        break;
}

?>