<?php

class DB {
    use tSingleton;

    protected bool $loaded = false;
    protected array $data = [
        'users' => [],
    ];
    protected function __construct() {
        $this->load();
    }

    protected function getFile()
    {
        return __DIR__.'/../db.json';
    }

    protected function load(bool $force = false) {
        if($force || !$this->loaded) {
            if(file_exists($this->getFile())) {
                $this->data = json_decode(file_get_contents($this->getFile()), true);
            }
            $this->loaded = true;
        }
    }

    public function addUser($login, $pwd) {
        $muser = md5($login);
        if(!$this->userExists($login)) {
            $this->data['users'][$muser] = [
                'login' => $login,
                'pwd' => md5($pwd),
                'coins' => 1000,
            ];
            $this->flush();
        }
    }

    public function userExists($login) {
        $muser = md5($login);
        return array_key_exists($muser, $this->data['users']);
    }

    public function getUser($login) {
        $muser = md5($login);
        return $this->userExists($login)? $this->data['users'][$muser]:null;
    }

    public function saveUser($login, $coins) {
        $muser = md5($login);
        if($this->userExists($login)) {
            $this->data['users'][$muser]['coins'] = $coins;
            $this->flush();
        }
    }

    public function deleteUser($login) {
        $muser = md5($login);
        if($this->userExists($login)) {
            unset($this->data['users'][$muser]);
            $this->flush();
        }
    }

    protected function flush() {
        $fh = @fopen($this->getFile(), 'w+');
        if(false !== $fh) {
            fwrite($fh, json_encode($this->data));
            fclose($fh);
        } else {
            $cid = `whoami`;
            throw new Exception('Error : cannot write DB file "'.$this->getFile().'" (current user : '.$cid.')');
        }
    }
}
