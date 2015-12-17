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
                    like      INTEGER NOT NULL DEFAULT 0,
                    picture_id   INTEGER NOT NULL,
                    user_id INTEGER NOT NULL,
                    FOREIGN KEY (user_id) REFERENCES users(id),
                    FOREIGN KEY (picture_id) REFERENCES pictures(id)
                    );");
    }

    public function like($pictureId, $userId) {
        $req = $this->_dbh->prepare("INSERT OR IGNORE INTO likes(picture_id, user_id) VALUES($pictureId, $userId)");
        return $req->execute();
    }
}

?>