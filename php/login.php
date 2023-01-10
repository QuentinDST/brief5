<html>
 <head>
 <meta charset="utf-8">
 <link rel="stylesheet" href="style.css" media="screen" type="text/css" />
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

 <input type="submit" id='submit' value='LOGIN' >

 <?php

    include 'database.php';

 if(isset($_GET['erreur'])){
 $err = $_GET['erreur'];
 if($err==1 || $err==2)
 echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
 }
 ?>
 </form>
 </div>
 </body>
</html>