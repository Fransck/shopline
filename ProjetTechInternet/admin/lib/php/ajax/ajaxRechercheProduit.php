<?php
header('Content-Type: application/json');
// Chemin d'accès depuis le fichier ajax php
require '../dbPgConnect.php';
require '../classes/Connexion.class.php';
require '../classes/Produit.class.php';
require '../classes/ProduitBD.class.php';
$cnx = Connexion::getInstance($dsn, $user, $password);

$produit = new ProduitBD($cnx);
$data[] = $produit->getProduitById($_GET['id_produit']);
print json_encode($data);
