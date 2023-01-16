<?php

// Connexion et lien à la base de donnée
global $db;

// Création de la fonction pour ajouter un bookmark 

function add_categorie($name, $db) {
    try{
        // Récupération des données de la nouvelle catégorie
        $name = $_POST["name"];

        $name = strtoupper($name);

        $addCategorie = $db->prepare("INSERT INTO categories (name) VALUES (:name)");
            $addCategorie->bindValue(':name', PDO::PARAM_STR);
        $addCategorie->execute(array(':name' => $name));

        // On récupère l'id de la nouvelle catégorie
        $categorie_id = $db->lastInsertId();

        // On récupère l'id du bookmark lié à la nouvelle catégorie
        @$bookmark_id = $_POST["bookmark_id"];

        // Préparation de la requête d'insertion de la relation entre la catégorie et le signet
        $addBookmarkCategorie = $db->prepare("INSERT INTO bookmarks_categories (bookmark_id, categorie_id) VALUES (:bookmark_id, :categorie_id)");
            $addBookmarkCategorie->bindValue(':bookmark_id', PDO::PARAM_INT);
            $addBookmarkCategorie->bindValue(':categorie_id', PDO::PARAM_INT);
        $addBookmarkCategorie->execute(array(':bookmark_id' => $bookmark_id, ':categorie_id' => $categorie_id));
        
        } catch (PDOException $e) {
            return "Erreur lors de l'ajout de cette Catégorie: " . $e->getMessage();
        }
    }
?>
    
