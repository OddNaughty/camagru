<?php
/**
 * Created by PhpStorm.
 * User: cwagner
 * Date: 07/12/15
 * Time: 19:17
 */
if (isset($_SESSION['user'])) {
    session_destroy();
    require_once("views/logout.php");
}
?>