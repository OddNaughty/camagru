<?php
/**
 * Created by PhpStorm.
 * User: cwagner
 * Date: 17/12/15
 * Time: 17:22
 */
require_once("../constant.php");

require_once("models/comment.php");

$Comment = Comment::getInstance();
if (isset($_SESSION['user']) && isset($_SESSION['user']['id']) && isset($_POST['comment']) && isset($_POST['pictureId'])) {
    $Comment->createComment(htmlspecialchars($_POST['comment']), $_SESSION['user']['id'], $_POST['pictureId']);
}

?>