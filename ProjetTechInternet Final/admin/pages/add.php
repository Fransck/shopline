<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <form method="POST" action="pages/ajout.php">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom:</label>
                <input type="text" class="form-control" name="libelle" placeholder="Entrez le nom">
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Prix:</label>
                <input type="text" class="form-control" name="prix" placeholder="Entrez le prix">
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Illustration:</label>
                <input type="text" class="form-control" name="illustration" placeholder="Entrez l'illustration">
            </div>
            <div class="mb-3">
                <label for="qte" class="form-label">Qstock:</label>
                <input type="number" class="form-control" name="qstock" placeholder="Entrez la quantité en stock">
            </div>
            <div class="mb-3">
                <label for="id_categorie" class="form-label">ID Catégorie:</label>
                <input type="number" class="form-control" name="id_categorie" placeholder="Entrez l'ID de la catégorie">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Envoyer les informations</button>
        </form>
    </div>
</body>
</html>
