<?php

/* define('HOST','localhost');
define('dbname','bookmark_gestionnaire');
define('user','root');
define('pass',''); */

try{
    $db = new PDO('mysql:host=localhost;dbname=bookmark_gestionnaire;charset=utf8', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    echo $e;
}

