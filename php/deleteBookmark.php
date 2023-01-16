<?php

// Connexion à la base de donnée et lien à mon fichier fonctions
include 'connexionDb/database.php';
global $db;

if (isset($_GET["id"])){
    $id = $_GET["id"];
    var_dump($id);
    
    

    $sql = "DELETE FROM bookmarks WHERE `id`=`$id`";
    $deleteSql= $db->prepare($sql);
    $deleteSql -> execute();
}

header("location: /BRIEF5/index.php");
exit;
?>