<?php
/**
 * Created by PhpStorm.
 * User: cwagner
 * Date: 07/12/15
 * Time: 16:47
 */

require_once ("db.php");

class User {

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
        $this->_dbh->exec("CREATE TABLE IF NOT EXISTS users (
                    id        INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
                    pseudo    TEXT NOT NULL UNIQUE,
                    mail      TEXT NOT NULL UNIQUE,
                    password  TEXT NOT NULL);");
    }

    public function getUsers() {
        $req = $this->_dbh->prepare("SELECT * FROM users");
        $req->execute();
        $users = $req->fetchAll();
        return $users;
    }

    public function createUser($username, $email, $password) {

        $req = $this->_dbh->prepare("INSERT OR IGNORE INTO users(pseudo, mail, password)
                VALUES(?, ?, ?)");
        $ret = $req->execute(array($username, $email, $password));
        return $ret;
    }
}
