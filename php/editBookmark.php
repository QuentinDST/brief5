<?php

// Connexion et lien à la base de donnée
global $db;

// Création de la fonction pour editer un bookmark 

function edit_bookmark($id, $url, $title, $description, $db){
    
    try{
        //Démarrer une transaction pour garantir que toutes les opérations sont effectuées ensemble.
        $db->beginTransaction();

        //Modifier les données depuis la table bookmark et les appliquer

        $updateSql = $db->prepare('UPDATE bookmarks SET URL = "'.$url.'", Title = "'.$title.'", Description ="'.$description.'" WHERE id = '.$id);
        $updateSql ->execute(); 
        
        $db->commit();
                
        } catch (PDOException $e) {
            $db->rollback();
        return "Erreur lors de la mise à jour du Bookmark: " . $e->getMessage();
    }
}