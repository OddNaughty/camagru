<?php
/**
 * Created by PhpStorm.
 * User: cwagner
 * Date: 07/12/15
 * Time: 19:17
 */
require_once("../constant.php");

if (isset($_SESSION['user'])) {
    session_destroy();
    header("Refresh: 2; ../index.php");
    echo "<p>Vous avez bien été déconnecté</p>";
}
else {
    header("Location: ../index.php");
}
?>