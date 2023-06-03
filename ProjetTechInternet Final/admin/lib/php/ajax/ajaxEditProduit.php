<?php
header('Content-Type: application/json');
/*
la fonction header('Content-Type: application/json') assure que la réponse du serveur est correctement
et directement interprétée comme objet JSON et non texte ou html.
*/
require '../dbPgConnect.php';
require '../classes/Connexion.class.php';
require '../classes/Produit.class.php';
require '../classes/ProduitBD.class.php';

$cnx = Connexion::getInstance($dsn,$user,$password);

try{
    $produit = new ProduitBD($cnx);
    $rep = $produit->editProduit($_GET['champ'],$_GET['id'],$_GET['nouveau']);
}catch(PDOException $e){
    print $e->getMessage();
}
