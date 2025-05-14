<?php
class Session {
    use tSingleton;

    protected function __construct() {
        session_start();
    }

    public function isAuth() {
        return !empty($_SESSION) && !empty($_SESSION['user']);
    }

    public function auth(string $login, string $pwd) {
        $r = false;
        $u = DB::getInstance()->getUser($login);
        if(!empty($u) && ($u['pwd'] === md5($pwd))) {
            $_SESSION['user'] = $login;
            $r = true;
        }
        return $r;
    }

    public function getAuthedUser() {
        $r = null;
        if($this->isAuth()) {
            $r = DB::getInstance()->getUser($_SESSION['user']);
        }
        return $r;
    }

    public function unauth() {
        $_SESSION['user'] = null;
    }
}
