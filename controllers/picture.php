<?php
/**
 * Created by PhpStorm.
 * User: cwagner
 * Date: 17/12/15
 * Time: 13:16
 */

require_once("../constant.php");

require_once("models/picture.php");
require_once("models/comment.php");

$user = $_SESSION['user'];
$Picture = Picture::getInstance();
if (isset($_GET['p']) && intval($_GET['p']) > 0) {
    $picture = $Picture->getPictureFromId(intval($_GET['p']));
    $comments = Comment::getInstance()->getCommentsFromPicture($picture['id']);
    require_once("views/picture.php");
}
else {
    header("Location: ../index.php");
}

?>