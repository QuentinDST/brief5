<?php

    // Connexion et lien à la base de donnée
    include '../include/database.php'; 
    global $db;

    // REQUETE INSERTION BOOKMARKS //
    $b = "INSERT INTO `bookmarks` (`URL`, `title`, `Description`) 
    VALUES 
    ('https://www.youtube.com/', 'youtube', 'site de musique'),
    ('https://getbootstrap.com/', 'bootsrap', 'framework'),
    ('https://www.airbnb.fr/', 'airbnb', 'location de maison'),
    ('https://www.figma.com/', 'figma', 'creation de wireframe')";

    $requeteprepare = $db->prepare($b);

    // Execution de la requête

    $requeteprepare->execute();
    echo "</br>Nouveaux enregistrement ajoutés avec succès"; 
/* 
    $q = $db->query("SELECT * FROM `users`");
    while ($user = $q->fetch(PDO::FETCH_ASSOC)){
      var_dump($user);
    }  */


?>
