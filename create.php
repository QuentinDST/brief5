<!DOCTYPE html>
<html lang="fr">
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
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

      // Connexion à la base de donnée et lien à mon fichier fonctions

      include 'connexionDb/database.php';
      include_once 'php/functionBookmark.php';

      ?>

      <form method="post">
        <div class="form-group formulaire">
          <label for="url">URL :</label>
          <input type="text" class="form-control" id="url" name="url" placeholder="Ajoute ton url" required>
        </div>

        <div class="form-group formulaire">
          <label for="title">Titre :</label>
          <input type="text" class="form-control" id="title" name="title" placeholder="Ajoute ton titre" required>
        </div>

        <div class="form-group formulaire">
          <label for="description">Description :</label>
          <textarea id="description" class="form-control" name="description" rows="3"></textarea>
        </div>
          
        <div class="form-check formulaire"> 
          <label for="categorie">Catégorie :</label>
          <?php
            $addSql = "SELECT `id`, `name`, `categorie_id` FROM categories"; /* groupe concat */
            $result = $db->query($addSql);
            $num_rows = $result->rowCount();
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
              echo "<input type='checkbox' value='" . $row['id'] . "'>" . $row['name'] . "</input>";
            };
          ?> 
        </div>

        <input class="btn btn-success" type="submit" value="+ Ajouter" name="submit">
        <a href="index.php" class="btn btn-success"><i class="bi bi-plus"></i> Retour</a>
      </form>
    </div>
  </div>
  <?php

  // Appel de la fonction addBookmark pour ajouter un bookmark

  if (isset($_POST['submit'])) {
    $url = $_POST['url'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $categorie_id = $_POST['categorie'];
    $message = add_bookmark($url, $title, $description, $categorie_id, $db);
    echo $message;
  };

  ?>
</body>

</html>