<?php
/**
 * Created by PhpStorm.
 * User: cwagner
 * Date: 17/12/15
 * Time: 11:51
 */

require_once("models/db.php");

class Comment {

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
        $this->_dbh->exec("CREATE TABLE IF NOT EXISTS comments (
                    id        INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
                    creation_time DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP NOT NULL,
                    comment   TEXT  NOT NULL,
                    picture_id   INTEGER NOT NULL,
                    user_id INTEGER NOT NULL,
                    FOREIGN KEY (user_id) REFERENCES users(id),
                    FOREIGN KEY (picture_id) REFERENCES pictures(id)
                    );");
    }

    public function getComments() {
        $req = $this->_dbh->prepare("SELECT * FROM comments");
        $req->execute();
        return $req->fetchAll();
    }

    public function getCommentsFromPicture($pictureId) {
        $req = $this->_dbh->prepare("SELECT comment FROM comments WHERE picture_id = ?");
        $req->execute(array($pictureId));
        return $req->fetchAll();
    }

    public function createComment($comment, $user_id, $picture_id) {
        $req = $this->_dbh->prepare("INSERT INTO comments(comment, picture_id, user_id) VALUES(?, ?, ?)");
        $ret = $req->execute(array($comment, $picture_id, $user_id));
        if ($ret) {
            $picture = $this->_dbh->prepare("SELECT user_id FROM pictures WHERE pictures.id = ?");
            $picture->execute(array($picture_id));
            $pic = $picture->fetch();
            $user = $this->_dbh->prepare("SELECT users.mail FROM users WHERE users.id = ?");
            $user->execute(array($pic['user_id']));
            $mail = $user->fetch()['mail'];
            $headers = "X-Sender: camagru_cwagner@camagru.fr\n";
            $headers .= "From:<camagru_cwagner@camagru.fr>\n";
            $headers .= "Reply-To: 'No reply'\n";
            $headers .= "Content-Type: text/html; charset=\"iso-8859-1\n";
            if(mail($mail, "Camagru - Nouveau commentaire", "Bonjour, un commentaire a été posté sur votre photo", $headers))
                return true;
            return false;
        }
        return $ret;
    }
}

?>