<?php
/**
 * Created by PhpStorm.
 * User: cwagner
 * Date: 07/12/15
 * Time: 17:35
 */
require_once("header.php"); ?>
<form method="post" action="/controllers/login.php">
    <input type="text" name="pseudo" required/>
    <input type="password" name="password" required/>
    <input type="email" name="email" required>
    <input type="submit" value="Log moi :D."/>
</form>
<?php require_once("footer.php");?>