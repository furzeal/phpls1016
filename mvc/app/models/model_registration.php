<?php

class Model_Registration extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function checkUser($login)
    {
        try {
            $sql = "SELECT login, password
                        FROM users
                        WHERE login = :login";
            $STH = parent::$DBH->prepare($sql);
            $STH->execute([':login' => $login]);
            $row = $STH->fetch();
            if ($row) {
                // User exists
                return false;
            } else {
                return true;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function checkFile($file)
    {
        try {
            if (preg_match('/(jpeg|jpg|png|gif)/', $file['name'])
                && preg_match('/(jpeg|jpg|png|gif)/', $file['type'])
            ) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function insertUser($data)
    {
        try {
            $sql = "INSERT INTO users(name, age, description, login, password)
                    VALUES (?, ?, ?, ?, ?)";
            $STH = self::$DBH->prepare($sql);
            $pureData = self::getPureData($data);
            $STH->execute($pureData);
            $login = $data['login'];
            $id = self::getIdByLogin($login);
            // Return id of user
            Session::init();
            Session::set('loggedIn', true);
            Session::set('id', $id);
            return $id;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function insertFile($id, $file)
    {
        try {
            $filename = self::makeFilename($id, $file);
            move_uploaded_file($file['tmp_name'], '../photos/' . $filename);
            $data = [$filename, $id];
            $sql = "INSERT INTO photos(filename, id_user)
                    VALUES (?, ?)";
            $STH = self::$DBH->prepare($sql);
            $STH->execute($data);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    private static function getPureData($data)
    {
        foreach ($data as $value) {
            $result[] = $value;
        }
        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    private static function getIdByLogin($login)
    {
        try {
            $sql = "SELECT id
            FROM users
            WHERE login = :login";
            $STH = self::$DBH->prepare($sql);
            $STH->execute([':login' => $login]);
            $row = $STH->fetch();
            if (isset($row)) {
                return $row['id'];
            } else {
                return null;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    private static function makeFilename($id, $file)
    {
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $result = $id . "_avatar.$ext";
        return $result;
    }
}