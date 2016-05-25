<?php
/**
 * Created by PhpStorm.
 * User: cwagner
 * Date: 17/12/15
 * Time: 11:51
 */

require_once("models/db.php");

class Picture {

    private $_dbh;

    private static $_instance; //The single instance

    /*
    Get an instance of the Database
    @return Instance
    */
    public static function getInstance()
    {
        if (!self::$_instance) { // If no instance then make one
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct() {
        $db = Db::getInstance();
        $this->_dbh = $db->getConnection();
        $this->_dbh->exec("CREATE TABLE IF NOT EXISTS pictures (
                    id        INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
                    creation_time DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP NOT NULL,
                    picture   TEXT NOT NULL,
                    user_id INTEGER NOT NULL,
                    FOREIGN KEY (user_id) REFERENCES users(id)
                    );");
    }

    public function getPictures() {
//        $req = $this->_dbh->prepare("SELECT pictures.picture FROM pictures ORDER BY datetime(pictures.creation_time) DESC");
        $req = $this->_dbh->prepare("SELECT pictures.picture, pictures.id, (SELECT COUNT(*) FROM likes WHERE likes.picture_id = pictures.id) AS nb_likes FROM pictures");
        $req->execute();
        return $req->fetchAll();
    }

    public function getPicturesFromUser($userId) {
        $req = $this->_dbh->prepare("SELECT pictures.picture, pictures.id FROM pictures WHERE pictures.user_id = ? ORDER BY datetime(pictures.creation_time) DESC");
        $req->execute(array($userId));
        return $req->fetchAll();
    }

    public function createPicture($user, $picture, $overlay) {
        $im1 = imagecreatefromstring(base64_decode(substr($picture, 22)));
        imagecopy($im1, imagecreatefromstring(base64_decode(substr($overlay, 22))), 0, 0, 0, 0, 200, 150);
        ob_start();
        imagepng($im1);
        $contents =  ob_get_contents();
        ob_end_clean();
        imagedestroy($im1);
        $req = $this->_dbh->prepare("INSERT INTO pictures(picture, user_id) VALUES(?, ?)");
        $ret = $req->execute(array("data:image/png;base64,".base64_encode($contents), $user));
        return $ret;
    }

    public function deletePicture($userId, $pictureId) {
        if ($userId == $_SESSION['user']['id']) {
            $req = $this->_dbh->prepare("DELETE FROM pictures WHERE id = ? AND user_id = ?");
            $req->execute(array($pictureId, $userId));
        }
    }

}

?>