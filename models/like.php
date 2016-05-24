<?php
/**
 * Created by PhpStorm.
 * User: cwagner
 * Date: 17/12/15
 * Time: 11:51
 */

require_once("models/db.php");

class Like {

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
        $this->_dbh->exec("CREATE TABLE IF NOT EXISTS likes (
                    id        INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
                    creation_time DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP NOT NULL,
                    picture_id   INTEGER NOT NULL,
                    user_id INTEGER NOT NULL,
                    FOREIGN KEY (user_id) REFERENCES users(id),
                    FOREIGN KEY (picture_id) REFERENCES pictures(id)
                    );");
    }

    public function like($userId, $pictureId) {
        $exists = $this->_dbh->prepare("SELECT * FROM likes WHERE picture_id = ? AND user_id = ?");
        $exists->execute(array($pictureId, $userId));
        $e = $exists->fetchAll();
        if ($e)
            $req = $this->_dbh->prepare("DELETE FROM likes WHERE picture_id = ? AND user_id = ?");
        else
            $req = $this->_dbh->prepare("INSERT INTO likes(picture_id, user_id) VALUES(?, ?)");
        $req->execute(array($pictureId, $userId));
    }
}

?>