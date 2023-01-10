<?php require "index.php"; ?>

<?php

require 'index.php';

// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=bookmark_gestionnaire;charset=utf8', 'root', '');
echo 'connexion etabli';

// Traitement du formulaire de création de compte
if (isset($_POST['second_name']) && isset($_POST['first_name']) && isset($_POST['email']) && isset($_POST['password'])) {
  // Préparation de la requête d'insertion
  $stmt = $pdo->prepare('INSERT INTO users (second_name, first_name, email, password) VALUES (:second_name, :first_name :email, :password)');
  // Liaison des variables de la requête
  $stmt->bindValue(':second_name', $_POST['second_name']);
  $stmt->bindValue(':first_name', $_POST['first_name']);
  $stmt->bindValue(':email', $_POST['email']);
  $stmt->bindValue(':password', password_hash($_POST['password'], PASSWORD_DEFAULT));
  // Exécution de la requête
  $stmt->execute();
  echo 'connexion reussi';
}

// Traitement du formulaire de connexion
if (isset($_POST['second_name']) && isset($_POST['password'])) {
  // Préparation de la requête de sélection
  $stmt = $pdo->prepare('SELECT * FROM users WHERE second_name = :second_name');
  // Liaison de la variable de la requête
  $stmt->bindValue(':second_name', $_POST['second_name']);
  // Exécution de la requête
  $stmt->execute();
  // Récupération de l'utilisateur
  $user = $stmt->fetch();
  // Vérification du mot de passe
  if (password_verify($_POST['password'], $user['password'])) {
    // Connexion réussie, enregistrement de l'utilisateur en session
    $_SESSION['user'] = $user;
  } else {
    // Connexion échouée, affichage d'un message d'erreur
    echo 'Nom d\'utilisateur ou mot de passe incorrect';
  }
}
?>