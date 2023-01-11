<?php

// Connexion et lien à la base de donnée
include '../connexionDb/database.php'; 
global $db;

// Add a new category
function add_category($name, $db) {
$sql = "INSERT INTO categories (name) VALUES ('$name')";
if ($db->query($sql) === TRUE) {
$message = "Categorie ajoutée avec succès";
} else {
$message = "Erreur: " . $sql . "<br>" . $db->error;
}
return $message;
}

// Update an existing category
function update_category($id, $name, $db) {
$sql = "UPDATE categories SET name='$name' WHERE id=$id";
if ($db->query($sql) === TRUE) {
$message = "Categorie modifiée avec succès";
} else {
$message = "Error: " . $sql . "<br>" . $db->error;
}
return $message;
}

// Delete an existing category
function delete_category($id, $db) {
$sql = "DELETE FROM categories WHERE id=$id";
if ($db->query($sql) === TRUE) {
$message = "Category supprimée avec succès";
} else {
$message = "Erreur: " . $sql . "<br>" . $db->error;
}
return $message;
}