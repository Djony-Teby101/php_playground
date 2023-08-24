<?php
#variable de connexion.

$host='mysql:host=localhost; dbname=crud';
$user='root';
$pass='';

try {
    #etablir la connexion a la DB
    $db=new PDO($host,$user,$pass);

    #ecrire la requete.
    $sql='SELECT * FROM `liste` where id=2';
    $query=$db->prepare($sql);
    $query->execute();

    $result=$query->fetchAll(pdo::FETCH_ASSOC);
    foreach($result as $produit){
        ?>
        <h3>produit <?=$produit['produit'] ?></h3>
        <h3>Prix <?=$produit['prix'] ?></h3>
        <h3>Nombre <?=$produit['nombre'] ?></h3>
        <h3>Id<?=$produit['id'] ?></h3>
    <?php
    
    }foreach($db->query($sql) as $produit){
        print_r($produit);
    }


    
    # deconnecter la db.
    $db=null;

} catch (PDOException $e) {
    echo "connexion fail".$e->getMessage()."<br>";
    die();
}
?>