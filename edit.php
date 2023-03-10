<?php

// Connexion à la base de donnée et lien à mon fichier fonctions
include 'connexionDb/database.php';
    
// Déclaration des variables

$id = "";
$url = "";
$title = "";
$description = "";

$errorMessage = "";
$successMessage = "";
$updateSql = "";

// Vérification si l'id est bien récupérées par la méthode GET

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    
    //Vérifier si l'id est bien récupéré
    if(!isset($_GET['id'])){
    header("location: /BRIEF5/index.php");
    exit;
    }

    $id = $_GET["id"];

    
    //Requête pour récupérer la ligne du bookmark selectionné

    $getBookmark = "SELECT `URL`, `Title`, `Description` FROM bookmarks WHERE `id` = $id";
    $result = $db->prepare($getBookmark);
    $result->execute();
    $rowBookmark = $result->fetch();
    

    if(!$rowBookmark){
        header("location: /BRIEF5/index.php");
        exit;
    } 

    //On récupère ici les données de la table
    $url = $rowBookmark["URL"];
    $title = $rowBookmark["Title"];
    $description = $rowBookmark["Description"];
   

  }  // Modifier les données du client
  
    else {
      $id = intval($_POST["id"]);
      $url = $_POST["URL"];
      $title = $_POST["Title"];
      $description = $_POST["Description"];
      
      if(empty($id) ||empty($url) || empty($title)){
          $errorMessage = "L'URL et le titre sont Obligatoires";
      }

      //Appel de la fonction editBookmark pour update les nouvelles données.
      
      include_once 'php/editBookmark.php';
      $message = edit_bookmark($id, $url, $title, $description, $db);

      header("location: /BRIEF5/index.php");
  }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style/style.css">
  <title>BOOKMARKS</title>
</head>

<body>

  <div class="wrapper">
    <div class="container">
      <div class="row text-center create-title">
        <h1>Edit Your Bookmark</h1>
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
      ?>

      <form method="POST">

        <input type="hidden" name="id" value="<?php echo $id; ?>">
    

        <div class="form-group formulaire">
          <label for="url">URL :</label>
          <input type="text" class="form-control" name="URL" value="<?php echo $url ?>">
        </div>

        <div class="form-group formulaire">
          <label for="title">Titre :</label>
          <input type="text" class="form-control" name="Title" value="<?php echo $title ?>">
        </div>

        <div class="form-group formulaire">
          <label for="description">Description :</label>
          <textarea id="description" class="form-control" name="Description" rows="3" value="<?php echo $description ?>"></textarea>
        </div>
        
        <div class="form-check formulaire"> 
          <label for="categorie">Catégorie :</label>
          <br>
          <?php
            // On lance ici une requête pour récupérer l'id et et le nom de categorie afin de les afficher dynamiquement dans le table
    
            $getCategories = "SELECT `id`, `name` FROM categories";
            $result = $db->query($getCategories);
            while ($row = $result->fetch()) {
              echo '<input type="checkbox" name="categorie[]" value="'.$row['id'].'">'. $row['name'].'</br></input>';
            }
          ?> 
        </div>

        <div class="row">
          <div class="offset-sm-3 col-sm-3 col-md-3 d-grid">
            <input class="btn btn-success" type="submit" value="Modifier" name="submit">
          </div>
          <div class="col-sm-3 col-md-3 d-grid">
            <a href="index.php" class="btn btn-success" role="button"><i class="bi bi-plus"></i> Retour</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</body>

</html>