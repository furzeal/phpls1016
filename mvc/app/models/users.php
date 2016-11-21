<?php

class Users extends Model
{
    public $allUsers;
    public function __construct()
    {
        parent::__construct();
    }

    public function getUsers()
    {
        try {
            $sql = "SELECT id
                    FROM users
                    ";
            $STH = parent::$DBH->prepare($sql);
            $STH->execute();
            $row = $STH->fetchAll();
            return $row;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}