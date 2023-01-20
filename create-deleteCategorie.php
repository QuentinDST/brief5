<?php

    // Connexion à la base de donnée et lien à mon fichier fonctions
    include 'connexionDb/database.php';
    

   //////////////////// AJOUTER UNE NOUVELLE CATEGORIE //////////////////


    // Déclaration des variables

    $name = "";
    $errorMessage = "";
    $categories = "";

    // Vérification si le nom bien récupéré par la méthode POST

    if (isset($_POST['create-categorie'])) {  
     $name = $_POST['name'];
    
      //Si l'URL et le titre ne sont pas remplis, alors message d'erreur

      if (empty($name)){
       $errorMessage = " Le nom de categorie est obligatoire";
      }
    
      $name = strtoupper($name);
      // Appel de la fonction addcategorie pour ajouter une nouvelle catégorie
      include_once 'php/addCategorie.php';
      $message = add_categorie($name, $db);

    }
      //////////////////// SUPPRIMER UNE OU PLUSIEURS CATEGORIES ////////////////////


      // Déclaration des variables

      $selectedCategories = "";
      $values = "";
      $deleteSql = "";
      $deleteCategories = "";

      if(isset($_POST['categorie'])){
        var_dump($_POST);

      $selectedCategories = $_POST['categorie'];
      // On utilise la fonction implode pour retourner les elements du tableau en une chaine de caractère.
      // Puis la fonction array_fill qui parcours les éléments du tableau et retourne des valeurs sous forme de marqueurs
      $values = implode(',', array_fill(0, count($selectedCategories), '?'));
      
      $deleteSql = "DELETE FROM categories WHERE id IN ($values)";
      $deleteCategories = $db->prepare($deleteSql);
      $deleteCategories->execute($selectedCategories);
    
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
        <h1>Create Or Edit a new category</h1>
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
        <div class="col-sm-12 col-md-8 col-lg-6 ">
            <form method="post">
              <div class="form-group formulaire mb-5">
                  <label for="Name">Créer une nouvelle Catégorie :</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Crée une nouvelle catégorie" value="<?php echo $name; ?>">
              </div>
              <div class="row justify-content-center formulaire--button mb-5">
                  <div class="col-md-4 d-grid">
                    <input class="btn btn-md col-md btn-success" type="submit" value="+ Ajouter" name="create-categorie">
                  </div>
              </div>
            </form>

            <form method="post">
                <div class="form-check checkbox--categories mb-2 p-0"> 
                  <label for="categorie">Supprimer Une Catégorie :</label>
                  </br>
                   <?php
                     // On lance ici une requête pour récupérer l'id et et le nom de categorie
            
                     $getCategories = "SELECT `id`, `name` FROM categories";
                     $result = $db->query($getCategories);
                     while ($row = $result->fetch()) {
                       echo '<input type="checkbox" name="categorie[]" value="'.$row['id'].'">'. $row['name'].'</br></input>';
                     }
                     ?>               
                </div>

                <div class="row bookmark--button gx-5">
                  <div class="col-md-12 ">
                      <div class="col-6 gy-5 mx-auto d-flex justify-content-between index--title mx-2">
                        <button type="button" class="btn btn-md col-md-6 btn-danger delete--categorie" name="delete-categorie" data-toggle="modal" data-target="#confirmDeleteModal">Supprimer</button>
                        <a href="index.php" class="btn btn-md col-md-6 btn-success back--categorie" role="button"><i class="bi bi-plus"></i> Retour</a>
                      </div>
                  </div>
                </div>

                <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="deletecategorie" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirmer la suppression</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        Êtes-vous sûr de vouloir supprimer les catégories sélectionnées? Cette action est définitive.
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Annuler</button>
                        <button type="submit" name="delete-categorie" class="btn btn-danger">Supprimer</button>
                      </div>
                    </div>
                  </div>
                </div>
            </form>
        </div>
    </div>
  </div>
</body>

</html>