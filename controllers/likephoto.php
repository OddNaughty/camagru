<?php
/**
 * Created by PhpStorm.
 * User: cwagner
 * Date: 17/12/15
 * Time: 17:22
 */
require_once("../constant.php");

require_once("models/like.php");

$Like = Like::getInstance();
if (isset($_SESSION['user']) && isset($_SESSION['user']['id']))
    $Like->like($_SESSION['user']['id'], intval($_GET['p']));

?>