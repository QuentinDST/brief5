<?php

// Connexion et lien à la base de donnée
global $db;

// Création de la fonction pour editer un bookmark 

function edit_bookmark($id, $url, $title, $description, $db){
    
    try{

        //Modifier les données depuis la table bookmark et les appliquer

        $updateSql = $db->prepare('UPDATE bookmarks SET URL = :url, Title = :title, Description = :description WHERE id = :id');
            $updateSql->bindValue(':url', $url, PDO::PARAM_STR);
            $updateSql->bindValue(':title', $title, PDO::PARAM_STR);
            $updateSql->bindValue(':description', $description, PDO::PARAM_STR);
            $updateSql->bindValue(':id', $id, PDO::PARAM_INT);
        $updateSql->execute();
                
        } catch (PDOException $e) {
            $db->rollback();
        return "Erreur lors de la mise à jour du Bookmark: " . $e->getMessage();
    }
}