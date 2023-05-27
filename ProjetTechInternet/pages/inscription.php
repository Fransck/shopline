
<?php
  // fonction pour la mise en forme et la sécurité
  function post_data($field)
  {
      if (!isset($_POST[$field])) {
          return false;
      }
      $data = $_POST[$field];
      return htmlspecialchars(stripslashes(trim($data)));
  }
  // trim() retirer les occurences des espaces blancs

  // stripslashes() enlève les antislashs par exemple pour l'échappement

  // htmlspecialchars() certains caractères ont des significations spéciales 
  // en HTML, et doivent être remplacés par des entités HTML pour conserver 
  // leurs significations éviter le XSS Cross-site scripting
  define('REQUIRED_FIELD_ERROR', 'Ce champ est requis');
  $errors = [];
  $username = '';
  $email = '';
  $password = '';
  $password_confirm = '';
  if (isset($_POST['submit'])) {
      $username = post_data('username');
      $email = post_data('email');
      $password = post_data('password');
      $password_confirm = post_data('password_confirm');
      if (!$username) {
          $errors['username'] = REQUIRED_FIELD_ERROR;
      } else if (strlen($username) < 4 || strlen($username) > 16){
          $errors['username'] = 'Utilisateur doit être entre 4 et 16 caractères';
      }
      if (!$email) {
          $errors['email'] = REQUIRED_FIELD_ERROR;
      } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
          $errors['email'] = 'Entrer une adresse email valide';
      }
      if (!$password) {
          $errors['password'] = REQUIRED_FIELD_ERROR;
      }
      if (!$password_confirm) {
          $errors['password_confirm'] = REQUIRED_FIELD_ERROR;
      }
      if ($password && $password_confirm && strcmp($password, $password_confirm) != 0){
          $errors['password_confirm'] = 'Répéter le mot de passe correctement';
      }
      else {
        header("Location:index_.php?page=accueil.php");
    }
      // strcmp() comparaison binaire de chaînes
  }
?>








<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Formulaire d'enregistrement</title>
    <!-- lien CDN(Content Delivery Network) pour insérer bootstrap https://getbootstrap.com/ -->
    <!-- https://getbootstrap.com/docs/5.1/getting-started/download/ -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<!-- https://getbootstrap.com/docs/5.1/layout/containers/ -->
<div class="container"> 
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>" >
        <!-- système de grille basée sur flexbox -->
        <!-- https://getbootstrap.com/docs/5.1/layout/grid/ -->
        <div class="row">
            <div class="col">
                <!-- espacement margin et padding -->
                <!-- https://getbootstrap.com/docs/5.1/utilities/spacing/ -->
                <div class="mt-5 mb-5">    
                    <label for="username">Nom</label>
                    <!-- validation du formulaire form-control is-invalid-->
                    <!-- https://getbootstrap.com/docs/5.1/forms/validation/ -->
                    <input class="form-control <?php echo isset($errors['username']) ? 'is-invalid' : '' ?>"
                        name="username" placeholder="Entrer votre nom d'utilisateur" value="<?php echo $username ?>">
                    <!-- form-text -->
                    <!-- https://getbootstrap.com/docs/5.1/forms/overview/ -->
                    <!-- text-muted -->
                    <!-- https://getbootstrap.com/docs/5.1/utilities/colors/ -->
                    <small class="form-text">Min. 6 et max. 16 caractères</small>
                    <!-- invalid-feedback -->
                    <!-- https://getbootstrap.com/docs/5.1/forms/validation/ -->
                    <div class="invalid-feedback">
                        <?php echo $errors['username'] ?>
                    </div>
                </div>
            </div>
            
            <div class="col">
                <div class="mt-5 mb-5">
                    <label for="email">Email</label>
                    <input type="text" class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : '' ?>"
                        name="email" placeholder="Entrer votre email" value="<?php echo $email ?>">
                    <div class="invalid-feedback">
                        <?php echo $errors['email'] ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <!-- espacement margin et padding -->
                <!-- https://getbootstrap.com/docs/5.1/utilities/spacing/ -->
                <div class="mt-5 mb-5">    
                    <label for="username">Prenom</label>
                    <!-- validation du formulaire form-control is-invalid-->
                    <!-- https://getbootstrap.com/docs/5.1/forms/validation/ -->
                    <input class="form-control "name="username" placeholder="Entrer votre prenom" >
                    
                </div>
            </div>

            <div class="col">
                <!-- espacement margin et padding -->
                <!-- https://getbootstrap.com/docs/5.1/utilities/spacing/ -->
                <div class="mt-5 mb-5">    
                    <label for="username">ville</label>
                    <!-- validation du formulaire form-control is-invalid-->
                    <!-- https://getbootstrap.com/docs/5.1/forms/validation/ -->
                    <input class="form-control "name="username" placeholder="Entrer votre ville" >
                    
                </div>
            </div>
            </div>
        <div class="row">
            <div class="col">
                <div class="mb-5">
                    <label for="password">Mot de passe</label>
                    <input type="password" class="form-control <?php echo isset($errors['password']) ? 'is-invalid' : '' ?>"
                        name="password" placeholder="Entrer votre nom mot de passe" value="<?php echo $password ?>">
                    <div class="invalid-feedback">
                        <?php echo $errors['password'] ?>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="mb-5">
                    <label for="password_confirm">Répéter le mot de passe</label>
                    <input type="password"
                        class="form-control <?php echo isset($errors['password_confirm']) ? 'is-invalid' : '' ?>"
                        name="password_confirm" placeholder="Répéter votre mot de passe" value="<?php echo $password_confirm ?>">
                    <div class="invalid-feedback">
                        <?php echo $errors['password_confirm'] ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <!-- espacement margin et padding -->
                <!-- https://getbootstrap.com/docs/5.1/utilities/spacing/ -->
                <div class="mt-5 mb-5">    
                    <label for="username">Nom Rue</label>
                    <!-- validation du formulaire form-control is-invalid-->
                    <!-- https://getbootstrap.com/docs/5.1/forms/validation/ -->
                    <input class="form-control "name="username" placeholder="Entrer votre nom de rue" >
                    
                </div>
            </div>

            <div class="col">
                <!-- espacement margin et padding -->
                <!-- https://getbootstrap.com/docs/5.1/utilities/spacing/ -->
                <div class="mt-5 mb-5">    
                    <label for="username">Numero Rue</label>
                    <!-- validation du formulaire form-control is-invalid-->
                    <!-- https://getbootstrap.com/docs/5.1/forms/validation/ -->
                    <input class="form-control "name="username" placeholder="Entrer votre numero de rue" >
                    
                </div>
            </div>
            </div>
        <br>
        <div>
            <!-- btn btn-primary -->
            <!-- https://getbootstrap.com/docs/5.1/components/buttons/ -->
            <input type="submit" class="btn btn-primary" name="submit" value="Enregistrement">
        </div>
    </form>
</div>
</body>
</html>