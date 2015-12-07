<?php
/**
 * Created by PhpStorm.
 * User: cwagner
 * Date: 07/12/15
 * Time: 14:42
 */
if (!empty($_POST))
{
    require_once("models/user.php");
    if (isset($_POST['pseudo']) && isset($_POST['password'])) {
        $username = htmlspecialchars($_POST['pseudo']);
        $password = hash("sha256", $_POST['password']);
        echo 'Encrypted password: '.$password.'\n' ;

    }
?>
<p>Il y a des datas dans POST :D</p>
<?php } else { ?>
<form method="post" action="/controllers/login.php">
    <input type="text" name="pseudo" required/>
    <input type="password" name="password" required/>
    <input type="submit" value="Log moi :D."/>
</form>
<?php }?>