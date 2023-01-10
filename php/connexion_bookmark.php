<?php

try {
    // Connexion à la base de données
    $connexion_bookmark = new PDO('mysql:host=localhost;dbname=bookmark_gestionnaire;charset=utf8', 'root', '');
    echo("connexion établie ");
    // définir le mode exception d'erreur PDO 
    $connexion_bookmark->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    

    // REQUETE INSERTION USERS //
    $insert_requete = "INSERT INTO `users` (`second_name`, `first_name`, `email`,`password`) 
    VALUES 
    ('Quentin', 'DESTRADE', 'quentin.destrade@gmail.com', 'aloha'),
    ('Kevin', 'Molines', 'kevin.molines@gmail.com', 'ffee22'),
    ('Laeticia', 'CASTA', 'laeticiouille@gmail.com', 'bvderr'),
    ('Jonhatan', 'LACOSTE', 'jojolac@gmail.com', 'a114771d'),
    ('Thomas', 'VILLEGAS', 'thom@gmail.com', 'babahs'),
    ('Leandre', 'VEYRON', 'lveyron@gmail.com', 'cdgey'),
    ('Veronique', 'FLEIG', 'veroofleig@gmail.com', 'dhetyagzz'),
    ('Pierre-Bruno', 'VERNET', 'pb48@gmail.com', 'dneuejede1'),
    ('Tony', 'TRIEWVELLER', 'toto341@gmail.com', 'kejaui'),
    ('Jolene', 'Mikus', 'jojo.mik@gmail.com', 'ejhyyyyeh')";

    $stmt = $connexion_bookmark->prepare($insert_requete);

    // Execution de la requête

    $stmt->execute();
    echo "</br>Nouveaux enregistrement ajoutés avec succès";
      } catch(PDOException $e) {
        echo $insert_requete . "
        " . $e->getMessage();    
  }
  $connexion_bookmark = null;

?>