<?php
/**
 * Created by PhpStorm.
 * User: cwagner
 * Date: 07/12/15
 * Time: 17:13
 */
$title = "Home - Camagru";
include_once("header.php"); ?>
<h3>Ceci est le home.</h3>
<p>Pour vous connecter, merci d'aller <a href="/controllers/login.php">ici</a></p>
<?php
print_r($users[0]);
include_once("footer.php");
?>