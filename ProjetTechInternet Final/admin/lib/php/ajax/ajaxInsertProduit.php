<?php
header('Content-Type: application/json');
require '../dbPgConnect.php';
require '../classes/Connexion.class.php';
require '../classes/Produit.class.php'; 
require '../classes/ProduitBD.class.php'; 

$cnx = Connexion::getInstance($dsn,$user,$password);

$prod = new ProduitBD($cnx); 
$data[] = $prod->addProduit($_GET['libelle'],$_GET['prix'],$_GET['illustration'],$_GET['qstock'],$_GET['id_categorie']);
print json_encode($data);
