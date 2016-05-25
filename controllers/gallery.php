<?php
/**
 * Created by PhpStorm.
 * User: cwagner
 * Date: 17/12/15
 * Time: 13:16
 */

require_once("../constant.php");

require_once("models/picture.php");

$user = $_SESSION['user'];
$Picture = Picture::getInstance();
$perPage = 3;
if (isset($_GET['p']) && intval($_GET['p']) > 0)
    $page = intval($_GET['p']);
else
    $page = 0;
$pictures = array_slice($Picture->getPictures(), $page * $perPage, $perPage);

require_once("views/gallery.php");

?>