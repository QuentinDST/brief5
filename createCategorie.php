<?php

    // Connexion à la base de donnée et lien à mon fichier fonctions
    include 'connexionDb/database.php';
    
    // Déclaration des variables

    $name = "";
    $errorMessage = "";
    $bookmark_id = "";

    // Vérification si le nom bien récupéré par la méthode POST

    if (isset($_POST['submit'])) {  
     $name = $_POST['name'];
     
    
    
    //Si l'URL et le titre ne sont pas remplis, alors message d'erreur

    do{
      if (empty($name)){
       $errorMessage = " Le nom de categorie est obligatoire";
       break;
      }
    
      // Appel de la fonction addcategorie pour ajouter une nouvelle catégorie

      include_once 'php//addCategorie.php';
      $message = add_categorie($name, $db);

      // Si la requête a fonctionné on redirige l'utilisateur vers la page principale

      header("location: /BRIEF5/index.php");
      exit;
    } while (false);
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style/style.css">
  <title>BOOKMARKS</title>
</head>

<body>

  <div class="wrapper">
    <div class="container">
      <div class="row text-center create-title">
        <h1>Create a new category</h1>
      </div>

      <?php

    // Si les champs obliagtoire de ne sont pas remplis, on affiche un message d'erreur
    if(!empty($errorMessage)){
      echo "
      <div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>$errorMessage</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>
      ";
    }

    if($successMessage){
        echo "
        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
          <strong>$successMessage</strong>
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
        ";
      }

    ?>

      <div class="row justify-content-center">
        <div class="col-sm-12 col-md-8 col-lg-6 ">
            <form method="post">
                <div class="form-group formulaire">
                    <label for="Name">Nom Catégorie :</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Crée une nouvelle catégorie" value="<?php echo $name; ?>">
                </div>
                <div class="row">
                    <div class="offset-sm-3 col-sm-3 col-md-3 d-grid">
                      <input class="btn btn-success" type="submit" value="+ Ajouter" name="submit">
                    </div>
                    <div class="col-sm-3 col-md-3 d-grid">
                      <a href="index.php" class="btn btn-success" role="button"><i class="bi bi-plus"></i> Retour</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
  </div>
</body>

</html>