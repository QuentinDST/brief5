<!DOCTYPE html>
<html>

<head>
  <title>BOOKMARKS</title>
</head>

<body>

  <h1>Add New Bookmark</h1>
    <?php

      // Connexion à la base de donnée et lien à mon fichier fonctions
      
      include '../connexionDb/database.php';
      include_once '../php/functionBookmark.php';
      
    ?>
    <form method="post">
    
    <label for="url">URL :</label>
    <input type="text" id="url" name="url" required>
    <br>

    <label for="title">Title :</label>
    <input type="text" id="title" name="title" required>
    <br>
    
    <label for="description">Description :</label>
    <textarea id="description" name="description"></textarea>
    <br>
    
    <label for="categorie">Categorie :</label>
    <select id="categorie" name="categorie">
        
        <?php
            $addSql = "SELECT * FROM categories";
            $result = $db->query($addSql);
            $num_rows = $result->rowCount();
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                    echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                };
        ?>
    </select>
    <br>
    <input type="submit" value="Add" name="submit">
</form>

<?php

// Appel de la fonction addBookmark pour ajouter un bookmark

if(isset($_POST['submit'])) {
    $title = $_POST['title'];
    $url = $_POST['url'];
    $description = $_POST['description'];
    $categorie_id = $_POST['categorie'];
    $message = add_bookmark($title, $url, $description, $categorie_id, $db);
    echo $message;
};
?>
</body>

</html>