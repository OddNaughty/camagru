<?php
/**
 * Created by PhpStorm.
 * User: cwagner
 * Date: 07/12/15
 * Time: 18:18
 */
if (!empty($_POST) && isset($_POST['pseudo']) && isset($_POST['password']))
{
    session_start();
    require_once("models/user.php");
    $username = htmlspecialchars($_POST['pseudo']);
    $password = hash("sha256", $_POST['password']);
    $email = htmlspecialchars($_POST['email']);
    $user = User::getInstance();
    if ($user->createUser($username, $email, $password)) {
        $_SESSION['user'] = array(
            "username" => $username,
            "email" => $email
        );
        require_once("views/login_ok.php");
    }
    ?>
<?php } else {
    require_once("views/login.php");
}?>
