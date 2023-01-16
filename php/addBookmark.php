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
