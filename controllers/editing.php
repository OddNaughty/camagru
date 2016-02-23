<?php
/**
 * Created by PhpStorm.
 * User: cwagner
 * Date: 15/12/15
 * Time: 15:22
 */
require_once("../constant.php");

if (!isset($_SESSION['user'])) {
    header('Location: ../index.php');
}
if (!empty($_POST) && isset($_POST['photo64'])) {
    require_once("models/picture.php");
    $Picture = Picture::getInstance();
    $ret = $Picture->createPicture($_SESSION['user']['id'], $_POST['photo64']);
}
require_once("views/editing.php");
?>