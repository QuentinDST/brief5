<?php

// Connexion et lien à la base de donnée
global $db;

// Création de la fonction pour ajouter un bookmark 

function add_bookmark($url, $title, $description, $categories, $db) {
    try{
        //Démarrer une transaction pour garantir que toutes les opérations sont effectuées ensemble.
        $db->beginTransaction();

        // Insertion via requête SQL de l'url, titre et description du nouveau bookmark dans la table bookmarks
        $addBookmarkSql=$db->prepare("INSERT INTO bookmarks (`URL`,`Title`, `Description`) 
        VALUES (?, ?, ?)");
        $addBookmarkSql->execute([$url, $title, $description]);
        //on stocke la valeur de l'id bookmark via lastInsertId
        $bookmark_id=$db->lastInsertId();

        // Insertion via requête SQL des valeurs id de bookmark et catégorie dans la table de relation. 

        if(isset($categories)){
            $addCategories=$db->prepare("INSERT INTO bookmarks_categories (`bookmark_id`, `categorie_id`) VALUES ($bookmark_id, $categories)");
            $addCategories->execute();
        }

        $db->commit();
        
        return "Bookmark ajouté avec succès!";
            } catch (PDOException $e) {
            $db->rollback();
            return "Erreur lors de l'ajout du Bookmark: " . $e->getMessage();
        }
}   

//Fonction pour modifier un bookmark
/* 
function update_bookmark($id, $title, $url, $description, $db) {
    $updateSql = "UPDATE bookmarks SET title='$title', url='$url', description='$description'WHERE id=$id";
    if ($db->query($updateSql) === TRUE) {
        $message = "Bookmark modifié avec succès";
    } else {
        $message = "Erreur: " . $updateSql . "<br>" . $db->error;
    }
    return $message;
}
 */
//Fonction pour modifier un bookmark

function delete_bookmark($id, $db) {
    $deleteSql = "DELETE FROM bookmarks WHERE id=$id";
    if ($db->query($deleteSql) === TRUE) {
        $message = "Bookmark supprimé avec succès";
    } else {
        $message = "Error: " . $deleteSql . "<br>" . $db->error;
    }
    return $message;
}