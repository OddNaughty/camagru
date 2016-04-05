<?php
/**
 * Created by PhpStorm.
 * User: cwagner
 * Date: 07/12/15
 * Time: 17:35
 */
require_once("header.php"); ?>
<form method="post" action="/controllers/login.php">
    Pseudo:<br>
    <input type="text" name="pseudo" required/><br>
    <?php if (isset($error['pseudo'])) echo '<p>'.$error['pseudo'].'</p>' ?>
    Password:<br>
    <input type="password" name="password" required minlength="5"/><br>
    <?php if (isset($error['password'])) echo '<p>'.$error['password'].'</p>' ?>
    <input type="submit" value="Log moi :D."/>
</form>
    <form action="/controllers/password_reset.php">
        <input type="submit" value="J'ai perdu mon mdp tel un gros tard">
    </form>
<?php require_once("footer.php");?>