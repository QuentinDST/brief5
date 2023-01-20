<?php

    // Connexion à la base de donnée et lien à mon fichier fonctions
    include 'connexionDb/database.php';
    
    // Déclaration des variables

    $url = "";
    $title = "";
    $description = "";
    $categories = "";
    $selectedCategorie = "";
    $message = ""; 

    $errorMessage = "";

    // Vérification si les données entrée sont bien récupérées par la méthode POST

    if (isset($_POST['submit'])) {  
     $url = $_POST['url'];
     $title = $_POST['title'];
     $description = $_POST['description'];
     $categories = $_POST['categorie'];
    
    // Boucle pour récupérer les choix multiples des checkbox null ou multiple 
     
     foreach($_POST['categorie'] as $selectedCategorie){
      echo $selectedCategorie."</br>";
    }
    
    
    if(empty($categories)){
      $selectedCategorie=null;

      if (empty($url) || empty($title)){
       $errorMessage = " L'URL et le titre sont obligatoires";
      }
    }
      
    // Appel de la fonction addbookmark pour ajouter un nouveau bookmark avec sa catégorie
    include_once 'php/addBookmark.php';
    $message = add_bookmark($url, $title, $description, $selectedCategorie,$db);
    
    //Si la requête a fonctionné, l'utilisateur et redirigé sur l'index.

      include_once 'php/addBookmark.php';
      $message = add_bookmark($url, $title, $description, $selectedCategorie,$db);
      
      //Si la requête a fonctionné, l'utilisateur et redirigé sur l'index.



      header("location: /BRIEF5/index.php");
      exit;
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
        <h1>Add New Bookmark</h1>
      </div>
      
      <?php

      // Si les champs obliagtoire de ne sont pas remplis, on affiche un message d'erreur
      
      if(!empty($successMessage)){
        echo "
        <div class='row justify-content-center'>
          <div class='col-sm-12 col-md-8 col-lg-8'>
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
             <strong>L'URL et le titre sont obligatoire</strong>
             <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
          </div>
        </div>
        ";
      }
      ?>
      <div class="row justify-content-center"> 
        <div class="col-sm-12 col-md-8 col-lg-8">
          <form method="post">
            <div class="form-group formulaire">
              <label for="url">URL :</label>
              <input type="text" class="form-control" id="url" name="url" placeholder="Ajoute ton url"<?php echo $url; ?> required>
            </div>
       
            <div class="form-group formulaire">
              <label for="title">Titre :</label>
              <input type="text" class="form-control" id="title" name="title" placeholder="Ajoute ton titre"<?php echo $title; ?> required>
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
       
                $getCategories = "SELECT `id`, `name` FROM categories";
                $result = $db->query($getCategories);
                while ($row = $result->fetch()) {
                 
                  echo '<input type="checkbox" name="categorie[]" value="'.$row['id'].'">'. $row['name'].'</br></input>';
                }
                ?> 
   
            <div class="row">
              <div class="offset-sm-3 col-sm-3 col-md-3 d-grid">
                <input class="btn btn-success" type="submit" value="+ Ajouter" name="submit">
              </div>
              <div class="col-sm-3 col-md-3 d-grid">
                <a href="index.php" class="btn btn-success btn--close" role="button"><i class="bi bi-plus"></i> Retour</a>
              </div>
            </div>
          </form>
        </div>    
    </div>
  </div>
</body>

</html>