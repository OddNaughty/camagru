<?php
/**
 * Created by PhpStorm.
 * User: cwagner
 * Date: 09/12/15
 * Time: 16:52
 */

//require_once("database.php");
//
//
//try {
//    $sqlite = new PDO($DSN);
//    $sqlite->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
//    $sqlite->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // ERRMODE_WARNING | ERRMODE_EXCEPTION | ERRMODE_SILENT
//} catch(Exception $e) {
//    echo "lol";
//    echo "Impossible d'accéder à la base de données SQLite : ".$e->getMessage();
//    die ();
//}

set_include_path(__DIR__."/..");

//require_once("models/comment.php");
//require_once("models/db.php");
//require_once("models/like.php");
//require_once("models/picture.php");
require_once("models/user.php");


//Comment::getInstance();
//Db::getInstance();
//Like::getInstance();
//Picture::getInstance();
User::getInstance();


?>