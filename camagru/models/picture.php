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
                    likes     INTEGER DEFAULT 0,
                    user_id INTEGER NOT NULL,
                    FOREIGN KEY (user_id) REFERENCES users(id)
                    );");
    }

    public function getPictures() {
        $req = $this->_dbh->prepare("SELECT * FROM PICTURES");
        $req->execute();
        return $req->fetchAll();
    }

    public function createPicture($user, $picture) {
        $req = $this->_dbh->prepare("INSERT INTO pictures(picture, user_id) VALUES(?, ?)");
        $ret = $req->execute(array($picture, $user));
        return $ret;
    }
}

?>