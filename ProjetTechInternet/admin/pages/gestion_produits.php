
<?php
$produit = new ProduitBD($cnx);
$produits = $produit->getVueAllProduits();
$nbr = count($produits);
?>

<div class="subdivision">
    <div class="subdiv1">
        <input class="form-control" id="filtre" type="text" placeholder="Filtrer"><br/>
        <p id="ajouter_produit" class="txtGras txtItalic red">Nouveau produit</p>
        <div id="nouveau_td"></div>
        <table class="table table-striped table-hover" id="tableau_produits">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Produit</th>
                <th scope="col">Prix</th>
                <th scope="col">Image</th>

            </tr>
            </thead>
            <tbody id="table_produits">
            <?php
            for ($i = 0; $i < $nbr; $i++) {
                ?>
                <tr id="<?php print $produits[$i]->id_produit; ?>">
                    <th scope="row"><?php print $produits[$i]->id_produit; ?></th>
                    <td contenteditable="true" id="<?php print $produits[$i]->id_produit; ?>"
                        name="libelle"><?php print $produits[$i]->libelle; ?></td>
                    <td contenteditable="true" id="<?php print $produits[$i]->id_produit; ?>"
                        name="prix"><?php print $produits[$i]->prix; ?></td>
                    <td contenteditable="true" id="<?php print $produits[$i]->id_produit; ?>"
                        name="illustration"><?php print $produits[$i]->illustration; ?></td>
                    <td><img class="delete" src="./images/delete.jpg" alt="delete"
                             id="<?php print $produits[$i]->id_produit; ?>"></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
    <div class="subdiv2">
        <span id="illustration"></span>
    </div>
</
