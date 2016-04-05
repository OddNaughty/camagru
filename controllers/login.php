<?php
/**
 * Created by PhpStorm.
 * User: cwagner
 * Date: 07/12/15
 * Time: 18:18
 */
require_once("../constant.php");

// GET POSTS FOR FORM
require_once("models/user.php");
if (!empty($_POST)) {
    if (isset($_POST['pseudo']) && isset($_POST['password'])) {
        session_start();
        $username = htmlspecialchars($_POST['pseudo']);
        $password = hash("sha256", $_POST['password']);
        $user = User::getInstance()->getUserByName($_POST['pseudo']);
        $error = array();
        if (!$user) {
            $error['pseudo'] = "Aucun utilisateur n'existe avec ce pseudo";
        }
        if (strlen($_POST['password']) < 5) {
            $error['password'] = "Le mot de passe rentré est trop court";
        }
        else if ($user['password'] !== $password) {
            $error['password'] = "Le mot de passe rentré n'est pas le bon";
        }
        if (!empty($error))
            require_once("views/login.php");
        else {
            $_SESSION['user'] = $user;
            require_once("views/login_ok.php");
        }
    }
}
else {
    require_once("views/login.php");
}
?>
