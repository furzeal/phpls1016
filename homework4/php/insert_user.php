<?php
require_once 'connect.php';
try {
    $name = htmlentities(strip_tags(trim($_POST['name'])), ENT_QUOTES);
    $age = (int)($_POST['age']);
    $description = htmlentities(strip_tags(trim($_POST['description'])), ENT_QUOTES);
    $login = htmlentities(strip_tags(trim($_POST['login'])), ENT_QUOTES);
    $password = htmlentities(strip_tags(trim($_POST['password'])), ENT_QUOTES);
    $sql = "INSERT INTO users(name, age, description, login, password)
                    VALUES (?, ?, ?, ?, ?)";
    $STH = $DBH->prepare($sql);
    $data = [$name, $age, $description, $login, $password];
    //var_dump($data);
    $STH->execute($data);

    header('HTTP/1.1 307 Temporary Redirect');
    header('Location: homepage.php');
    exit;

} catch (PDOException $e) {
    echo $e->getMessage();
}
