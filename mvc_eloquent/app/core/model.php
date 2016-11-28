<?php

class Model
{
    public static $DBH;
    public function __construct()
    {
        self::DBconnect();

    }

    protected static function DBconnect()
    {
        try {
            $host = 'localhost';
            $dbname = 'phpls1016mvc';
            $user = 'root';
            $pass = 'password';
            self::$DBH = new PDO("mysql:unix_socket=$host;dbname=$dbname",
                $user, $pass);
            $sql = "SET NAMES 'UTF-8";
            self::$DBH->query($sql);

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function CreateUsers()
    {
        try {
            $sql = "
    CREATE TABLE users (
      id INT(10) NOT NULL AUTO_INCREMENT,
      name VARCHAR(100) NOT NULL,
      age INT(10) NOT NULL,
      description VARCHAR(255),
      login VARCHAR(20) NOT NULL UNIQUE,
      password VARCHAR(20) NOT NULL,
      email VARCHAR(100) NOT NULL,
      PRIMARY KEY (id)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8 AUTO_INCREMENT = 1;";
            self::$DBH->prepare($sql)->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public static function CreatePhotos()
    {
        try {
            $sql = "
    CREATE TABLE photos (
      id INT(10) NOT NULL AUTO_INCREMENT,
      filename VARCHAR(100) NOT NULL,
      id_user INT(10) NOT NULL,
      PRIMARY KEY (id),
      FOREIGN KEY(id_user) REFERENCES users(id)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8 AUTO_INCREMENT = 1;";
            self::$DBH->prepare($sql)->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}


