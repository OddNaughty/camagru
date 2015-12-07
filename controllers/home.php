<?php
/**
 * Created by PhpStorm.
 * User: cwagner
 * Date: 07/12/15
 * Time: 19:17
 */
require_once("models/user.php");
$User = User::getInstance();
$users = $User->getUsers();
require_once("views/home.php");
?>