<?php
/**
 * Created by PhpStorm.
 * User: cwagner
 * Date: 07/12/15
 * Time: 17:35
 */
require_once("header.php"); ?>
<form method="post" action="/controllers/register.php">
    Pseudo:<br>
    <input type="text" name="pseudo" required/><br>
    <?php if (isset($error['pseudo'])) echo '<p>'.$error['pseudo'].'</p>' ?>
    Password:<br>
    <input type="password" name="password" required minlength="5"/><br>
    <?php if (isset($error['password'])) echo '<p>'.$error['password'].'</p>' ?>
    Email:<br>
    <input type="email" name="email" required><br>
    <?php if (isset($error['email'])) echo '<p>'.$error['email'].'</p>' ?>
    <input type="submit" value="Inscris moi :D."/>
</form>
<?php require_once("footer.php");?>