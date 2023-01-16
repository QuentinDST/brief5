<?php

    // Connexion à la base de donnée et lien à mon fichier fonctions
    include 'connexionDb/database.php';
    
    // Déclaration des variables

    $url = "";
    $title = "";
    $description = "";
    $categories = "";
    $message = ""; 
    $errorMessage = "";
    $successMessage ='';

    // Vérification si les données entrée sont bien récupérées par la méthode POST

    if (isset($_POST['submit'])) {  
     $url = $_POST['url'];
     $title = $_POST['title'];
     $description = $_POST['description'];
     @$categories = $_POST['categorie'];
    
    //Si l'URL et le titre ne sont pas remplis, alors message d'erreur

    do{
      if (empty($url) || empty($title)){
       $errorMessage = " L'URL et le titre sont obligatoires";
       break;
      }
      
      // Appel de la fonction addbookmark pour ajouter un nouveau bookmark avec sa catégorie

      include_once 'php/addBookmark.php';
      $message = add_bookmark($url, $title, $description, $categories,$db);
      
      //Si la requête a fonctionné, l'utilisateur et redirigé sur l'index.



      header("location: /BRIEF5/index.php");
      exit;

      } while(false);
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
        <h1>Add New Bookmark</h1>
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
      <div class="row justify-content-center"> 
        <div class="col-sm-12 col-md-8 col-lg-8">
          <form method="post">
            <div class="form-group formulaire">
              <label for="url">URL :</label>
              <input type="text" class="form-control" id="url" name="url" placeholder="Ajoute ton url"<?php echo $url; ?>>
            </div>
       
            <div class="form-group formulaire">
              <label for="title">Titre :</label>
              <input type="text" class="form-control" id="title" name="title" placeholder="Ajoute ton titre"<?php echo $title; ?>>
            </div>
       
            <div class="form-group formulaire">
              <label for="description">Description :</label>
              <textarea id="description" class="form-control" name="description" rows="3" <?php echo $description; ?>></textarea>
            </div>
       
            <div class="form-check formulaire"> 
              <label for="categorie">Catégorie :</label>
              <br>
              <?php
                // On lance ici une requête pour récupérer l'id et et le nom de categorie afin de les afficher dynamiquement dans le table
       
                $addSql = "SELECT `id`, `name` FROM categories";
                $result = $db->query($addSql);
                while ($row = $result->fetch()) {
                 
                  echo '<input type="checkbox" name="categorie" value="'.$row['id'].'">'. $row['name'].'</br></input>';
                }
                ?> 
              <?php 
   
              if(!empty($successMessage)){
                echo "
                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                  <strong>$successMessage</strong>
                  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                ";
              }
             
              ?>
   
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