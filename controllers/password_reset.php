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
            $error['email'] = "Aucun utilisateur n'existe avec cet email";
        }
        if (!empty($error))
            require_once("views/password_reset.php");
        else {
            $User->sendResetMail($user);
            require_once("views/password_reset_mail.php");
        }
    }
}
elseif (!empty($_GET)) {
    if (isset($_GET['t'])) {
        $User = User::getInstance();
        $pwd = $User->resetPassword($_GET['t']);
        require_once("views/password_reset_ok.php");
    }
    else
        require_once("views/login.php");
}
else {
    require_once("views/password_reset.php");
}?>