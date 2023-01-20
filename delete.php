<?php

// Connexion à la base de donnée et lien à mon fichier fonctions
include 'connexionDb/database.php';

if (isset($_GET["id"])){
    $id = $_GET["id"];

    $sql = ("DELETE bookmarks, bookmarks_categories
    FROM bookmarks
    LEFT OUTER JOIN bookmarks_categories ON bookmarks_categories.bookmark_id = bookmarks.id
    WHERE bookmarks.id = $id;");
    $deleteSql= $db->prepare($sql);
    $deleteSql -> execute();
}

header("location: /BRIEF5/index.php");
exit;

?>