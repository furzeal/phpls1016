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
    $STH->bindParam($name, $age, $description, $login, $password);
    $STH->execute();

    header('HTTP/1.1 307 Temporary Redirect');
    header('Location: homepage.php');
    exit;

} catch (PDOException $e) {
    echo $e->getMessage();
}
