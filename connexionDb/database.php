<?php

// Connexion à la base de donnée via PDO

try{
    $db = new PDO('mysql:host=localhost;dbname=bookmark;charset=utf8', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    echo $e;
}


