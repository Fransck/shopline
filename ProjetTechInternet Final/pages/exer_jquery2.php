<h2>Apprendre Ajax</h2>
<?php
$fl = new FleurBD($cnx);
$fleur = $fl->getVueAllFleurs();
$nbr = count($fleur);

?>
<form method="get" action="<?php print $_SERVER['PHP_SELF'];?>">
    Par référence : <input type="text" name="id_produit" id="id_produit"> ou par
    <select name="choix_fleur" id="choix_fleur">
        <option value="">Par nom</option>
        <?php
        for($i=0;$i<$nbr;$i++){
            ?>
            <option value="<?php print $fleur[$i]->id_fleur;?>"><?php print $fleur[$i]->nom_fleur;?></option>
        <?php
        }
        ?>
    </select>&nbsp;&nbsp;
    <input type="submit" name="submit" id="submit" value="Description" class="btn btn-success">
</form>

<p>&nbsp;</p>
<div class="card mb-3" style="max-width: 540px;" id="description_fleur">
    <div class="row g-0">
        <div class="col-md-6" id="image_fleur">

        </div>
        <div class="col-md-6">
            <div class="card-body">
                <p class="card-text" id="detail_fleur"></p>
            </div>
        </div>
    </div>
</div>