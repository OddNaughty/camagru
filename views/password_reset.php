<?php
/**
 * Created by PhpStorm.
 * User: cwagner
 * Date: 07/12/15
 * Time: 17:35
 */
require_once("header.php"); ?>
<form method="post" action="/controllers/password_reset.php">
    Email:<br>
    <input type="email" name="email" required><br>
    <?php if (isset($error['email'])) echo '<p>'.$error['email'].'</p>' ?>
    <input type="submit" value="Envoie l'email !"/>
</form>
<?php require_once("footer.php");?>