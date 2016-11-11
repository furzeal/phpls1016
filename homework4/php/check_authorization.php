<?php
require_once 'connect.php';
try {
    $login = htmlentities(strip_tags(trim($_POST['login'])), ENT_QUOTES);
    $password = htmlentities(strip_tags(trim($_POST['password'])), ENT_QUOTES);

    $sql = "SELECT login, password
            FROM users
            WHERE login = :login";
    $STH = $DBH->prepare($sql);
    $STH->execute([':login' => $login]);
    $row = $STH->fetch();
    $loginDB = $row['login'];
    $passwordDB = ($row['password']);
    if (($login === $loginDB) && ($password === $passwordDB)) {
        header('HTTP/1.1 307 Temporary Redirect');
        header('Location: homepage.php');
    } else {
        header('HTTP/1.1 307 Temporary Redirect');
        header('Location: ../index.html');
    }
    exit;

} catch (PDOException $e) {
    echo $e->getMessage();
}