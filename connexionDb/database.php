<?php

/* define('HOST','localhost');
define('dbname','bookmark');
define('user','root');
define('pass',''); */

try{
    $db = new PDO('mysql:host=localhost;dbname=bookmark;charset=utf8', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    echo $e;
}

/* $q = $db->query("SELECT * FROM `bookmarks`");
    while ($link = $q->fetch()){
      var_dump($link);
    } */

