<?php
/**
 * Created by PhpStorm.
 * User: cwagner
 * Date: 07/12/15
 * Time: 16:47
 */

require_once("models/db.php");

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
                    password  TEXT NOT NULL,
                    token     TEXT NOT NULL UNIQUE,
                    confirmed BOOL NOT NULL DEFAULT FALSE);");
//                    FOREIGN KEY (likes_id) REFERENCES pictures(id));");
    }

    public function getUsers() {
        $req = $this->_dbh->prepare("SELECT * FROM users");
        $req->execute();
        $users = $req->fetchAll();
        return $users;
    }

    public function getUserByName($pseudo) {
        $req = $this->_dbh->prepare("SELECT * FROM users WHERE pseudo=\"$pseudo\" AND confirmed=\"TRUE\"");
        $req->execute();
        return $req->fetch();
    }

    public function getUserByEmail($email) {
        $req = $this->_dbh->prepare("SELECT * FROM users WHERE mail=\"$email\" AND confirmed=\"TRUE\"");
        $req->execute();
        return $req->fetch();
    }

    public function resetPassword($token) {
        $pwd = $this->randomPassword();
        $req = $this->_dbh->prepare("UPDATE users SET password=? WHERE token=?");
        $req->execute(array(hash("sha256", $pwd), $token));
        return $pwd;
    }

    public function sendResetMail($user) {
        $headers = "X-Sender: camagru_cwagner@camagru.fr\n";
        $headers .= "From:<camagru_cwagner@camagru.fr>\n";
        $headers .= "Reply-To: 'No reply'\n";
        $headers .= "Content-Type: text/html; charset=\"iso-8859-1\n";
        $link = "http://" . $_SERVER['HTTP_HOST'] . "/controllers/password_reset.php?t=".$user['token'];

        if(mail($user['mail'], "Camagru - Passoword Reset", "Bonjour, merci de vouloir suivre ce lien pour enregistrer un nouveau mot de passe: \n".$link, $headers))
            return true;
        return false;
    }

    public function createUser($username, $email, $password) {
        $token = md5(uniqid($username, true));
        $req = $this->_dbh->prepare("INSERT OR IGNORE INTO users(pseudo, mail, password, token)
                VALUES(?, ?, ?, ?)");
        $ret = $req->execute(array($username, $email, $password, $token));
        if ($ret) {
            $headers = "X-Sender: camagru_cwagner@camagru.fr\n";
            $headers .= "From:<camagru_cwagner@camagru.fr>\n";
            $headers .= "Reply-To: 'No reply'\n";
            $headers .= "Content-Type: text/html; charset=\"iso-8859-1\n";
            $link = "http://" . $_SERVER['HTTP_HOST'] . "/controllers/register.php?username=".$username."&token=".$token;

            if(mail($email, "Inscription à Camagru", "Bonjour, merci de vouloir suivre ce lien: \n".$link, $headers)){
                return true;
            }
        }
        return false;
    }

    public function activateUser($username, $token) {
        $req = $this->_dbh->prepare("UPDATE users SET confirmed=\"TRUE\" WHERE pseudo=? AND token=?");
        $ret = $req->execute(array($username, $token));
        return ($ret);
    }

    private function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 5; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
}
