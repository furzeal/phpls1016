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
            $sql = "SELECT id, login, password
                        FROM users
                        WHERE login = :login";
            $STH = parent::$DBH->prepare($sql);
            $STH->execute([':login' => $login]);
            $row = $STH->fetch();
            $id= $row['id'];
            $loginDB = $row['login'];
            $passwordDB = ($row['password']);
            Session::init();
            if (($login === $loginDB) && ($password === $passwordDB)) {
                Session::set('loggedIn', true);
                Session::set('id', $id);
                return true;
            } else {
                Session::set('loggedIn', false);
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }

    }
}