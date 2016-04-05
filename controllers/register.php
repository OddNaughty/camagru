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
    // On a rempli le formulaire
    if (isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['email'])) {
        session_start();
        $username = htmlspecialchars($_POST['pseudo']);
        $password = hash("sha256", $_POST['password']);
        $email = htmlspecialchars($_POST['email']);
        $user = User::getInstance();
        $error = array();
        if (!empty($user->getUserByName($username))) {
            $error['pseudo'] = "Un utilisateur existe déjà avec ce pseudo";
        }
        if (strlen($_POST['password']) < 5) {
            $error['password'] = "Le mot de passe rentré est trop court";
        }
        if (!empty($user->getUserByEmail($email))) {
            $error['email'] = "Un utilisateur existe déjà avec cet email";
        }

        if (!empty($error))
            require_once("views/register.php");
        else {
            $user->createUser($username, $email, $password);
            require_once("views/registration_ok.php");
        }
    }
}
// On a pas rempli le formulaire ==> lien de reset
elseif (!empty($_GET) && isset($_GET['token']) && isset($_GET['username'])) {
    $confirmed = false;
    $user = User::getInstance();
    if ($user->activateUser($_GET['username'], $_GET['token'])) {
        $confirmed = true;
    }
    require_once("views/register_confirmation.php");
}
// Rien du tout, on load le truc normal
else {
    require_once("views/register.php");
}
?>
