<?php

// Connexion et lien à la base de donnée
global $db;

// Création de la fonction pour ajouter un bookmark 

function add_bookmark($url, $title, $description, $selectedCategorie, $db) {
    try{

        // Insertion via requête SQL de l'url, titre et description du nouveau bookmark dans la table bookmarks
        $addBookmarkSql=$db->prepare("INSERT INTO bookmarks (`URL`,`Title`, `Description`) 
        VALUES (?, ?, ?)");
        $addBookmarkSql->execute([$url, $title, $description]);
        //on stocke la valeur de l'id bookmark via lastInsertId
        $bookmark_id=$db->lastInsertId();

        // Insertion via requête SQL des valeurs id de bookmark et catégorie dans la table de relation en fonction des choix multiples ou non de l'utilisateur 

        if(isset($selectedCategorie)){}
        foreach($_POST['categorie'] as $selectedCategorie){
            $addCategories=$db->prepare("INSERT INTO bookmarks_categories (`bookmark_id`, `categorie_id`) VALUES ($bookmark_id, $selectedCategorie)");
            $addCategories->execute();
        }
        
        return "Bookmark ajouté avec succès!";
            } catch (PDOException $e) {
            $db->rollback();
            return "Erreur lors de l'ajout du Bookmark: " . $e->getMessage();
        }
}   
