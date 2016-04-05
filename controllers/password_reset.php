<?php
/**
 * Created by PhpStorm.
 * User: cwagner
 * Date: 07/12/15
 * Time: 19:17
 */
require_once("../constant.php");

require_once("models/user.php");
if (!empty($_POST)) {
    if (isset($_POST['email'])) {
        $User = User::getInstance();
        $user = $User->getUserByEmail($_POST['email']);
        $error = array();
        if (!$user) {
            $error['pseudo'] = "Aucun utilisateur n'existe avec cet email";
        }
        if (!empty($error))
            require_once("views/login.php");
        else {
            $User->sendResetPassword($_POST['email']);
            require_once("views/login_ok.php");
        }
    }
}
else {
    require_once("views/login.php");
}?>