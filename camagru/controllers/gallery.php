<?php
/**
 * Created by PhpStorm.
 * User: cwagner
 * Date: 17/12/15
 * Time: 13:16
 */

require_once("../constant.php");

require_once("models/picture.php");

$Picture = Picture::getInstance();
$pictures = $Picture->getPictures();

require_once("views/gallery.php");

?>