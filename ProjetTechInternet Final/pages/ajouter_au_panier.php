<?php


if (isset($_POST['idProduit'])) {
    $idProduit = $_POST['idProduit'];
    $produit = new ProduitBD($cnx); //$cnx est fourni par l'index
    $produitDetail = $produit->getProduitById($idProduit);
    
    // Vérifiez si le produit existe
    if ($produitDetail) {
        $nomProduit = $produitDetail['libelle'];
        $prixProduit = $produitDetail['prix'];
        $illustrationProduit = $produitDetail['illustration'];
        
    } else {
        echo "Le produit n'existe pas.";
    }
    

    // Exemple de code pour ajouter le produit à la session du panier
    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = array();
    }
    $_SESSION['panier'][] = $idProduit;

    echo "Le produit a été ajouté au panier.";
}
else {
    echo "Erreur : ID du produit non spécifié.";
}
?>
