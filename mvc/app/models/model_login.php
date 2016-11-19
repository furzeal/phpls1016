<?php

class Model_Login extends Model
{
    public function __construct()
    {
        parent::__construct();

    }

    public function check($login, $password)
    {
        try {
            $sql = "SELECT login, password
                        FROM users
                        WHERE login = :login";
            $STH = parent::$DBH->prepare($sql);
            $STH->execute([':login' => $login]);
            $row = $STH->fetch();
            $loginDB = $row['login'];
            $passwordDB = ($row['password']);
            if (($login === $loginDB) && ($password === $passwordDB)) {
                Session::init();
                Session::set('LoggedIn', true);
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }

    }
}