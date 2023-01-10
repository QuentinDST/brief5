<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/style.css">
    <title>>Bookmarks</title>
</head>
<body>
    <!-- Formulaire de création de compte -->
<form action="index.php" method="post">
  <label for="second_name">Nom :</label><br>
  <input type="text" id="second_name" name="second_name"><br>
  <label for="first_name">Prénom :</label><br>
  <input type="text" id="first_name" name="first_name"><br>
  <label for="email">Email :</label><br>
  <input type="text" id="email" name="email"><br>
  <label for="password">Mot de passe :</label><br>
  <input type="password" id="password" name="password"><br><br>
  <input type="submit" value="Créer un compte">
</form> 

<!-- Formulaire de connexion -->
<form action="index.php" method="post">
  <label for="username">Nom:</label><br>
  <input type="text" id="username" name="username"><br>
  <label for="password">Mot de passe :</label><br>
  <input type="password" id="password" name="password"><br><br>
  <input type="submit" value="Se connecter">
</form>

<?php 
// Traitement du formulaire de création de compte

// Connexion à la base de données
try {
    $conn= new PDO('mysql:host=localhost;dbname=bookmark_gestionnaire;charset=utf8', 'root', '');
    echo("connexion établie ");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


if (isset($_POST['second_name']) && isset($_POST['first_name']) && isset($_POST['email']) && isset($_POST['password'])) {
  // Préparation de la requête d'insertion
  $stmt = $conn->prepare('INSERT INTO users (second_name, first_name, email, password) VALUES (:second_name, :first_name :email, :password)');
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
  $stmt = $conn->prepare('SELECT * FROM users WHERE second_name = :second_name');
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

} catch(PDOException $e) {
    $e->getMessage();    
}

// Récupération de la liste des catégories de l'utilisateur
$stmt = $conn->prepare('SELECT * FROM categories WHERE users_id = :users_id');
$stmt->bindValue(':users_id', $_SESSION['users']['id']);
$stmt->execute();
$categories = $stmt->fetchAll();

// Affichage de la liste des catégories
echo '<h2>Mes catégories</h2>';
echo '<ul>';
foreach ($categories as $category) {
  echo '<li><a href="index.php?category_id=' . $category['id'] . '">' . $category['name'] . '</a></li>';
}
echo '</ul>';

// Si une catégorie est sélectionnée, affichage de la liste des bookmarks de la catégorie
if (isset($_GET['category_id'])) {
  // Récupération de la liste des bookmarks de la catégorie
  $stmt = $pdo->prepare('SELECT * FROM bookmarks WHERE user_id = :user_id AND category_id = :category_id');
  $stmt->bindValue(':user_id', $_SESSION['user']['id']);
  $stmt->bindValue(':category_id', $_GET['category_id']);
  $stmt->execute();
  $bookmarks = $stmt->fetchAll();
}
// Affichage de la liste des bookmarks
echo '<h2>Bookmarks de la catégorie ' . $categories[$_GET['category_id']]['name'] . '</h2>';
echo '<ul>';
foreach ($bookmarks as $bookmark) {
    echo '<li><a href="' . $bookmark['url'] . '">' . $bookmark['name'] . '</a></li>';
  }
  echo '</ul>';
  
  // Formulaire d'ajout de bookmark
  echo '<h2>Ajouter un bookmark</h2>';
  echo '<form action="index.php?category_id=' . $_GET['category_id'] . '" method="post">';
  echo '  <label for="name">Nom :</label><br>';
  echo '  <input type="text" id="name" name="name"><br>';
  echo '  <label for="url">URL :</label><br>';
  echo '  <input type="url" id="url" name="url"><br><br>';
  echo '  <input type="submit" value="Ajouter">';
  echo '</form>';

  // Traitement du formulaire d'ajout de bookmark
if (isset($_POST['name']) && isset($_POST['url'])) {
    // Préparation de la requête d'insertion
    $stmt = $pdo->prepare('INSERT INTO bookmarks (name, url, user_id, category_id) VALUES (:name, :url, :user_id, :category_id)');
    // Liaison des variables de la requête
    $stmt->bindValue(':name', $_POST['name']);
    $stmt->bindValue(':url', $_POST['url']);
    $stmt->bindValue(':user_id', $_SESSION['user']['id']);
    $stmt->bindValue(':category_id', $_GET['category_id']);
    // Exécution de la requête
    $stmt->execute();
} 
?>

</body>
</html>