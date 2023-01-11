<?php

    // Connexion et lien à la base de donnée
    include '../include/database.php'; 
    global $db; 
    echo'connexion réussie';
    
    // REQUETE INSERTION BOOKMARKS //
    $p = "INSERT INTO `categories` (`name`) 
    VALUES 
    ('HTML'),
    ('CSS'),
    ('LOCATION'),
    ('MUSIQUE')";

    $stmt = $db->prepare($p);

    // Execution de la requête

    $stmt->execute();
    echo "</br>Nouveaux enregistrement ajoutés avec succès"; 

?>