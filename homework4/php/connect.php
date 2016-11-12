<?php
try {
    $host = '/tmp/mysql.sock';
    $dbname = 'loftschool';
    $user = 'root';
    $pass = 'password';
    $DBH = new PDO("mysql:unix_socket=$host;dbname=$dbname",
        $user, $pass);
    $sql = "SET NAMES 'UTF-8";
    $DBH->query($sql);

} catch (PDOException $e) {
    echo $e->getMessage();
}

// Create table
//try {
//    $sql = "
//    CREATE TABLE users (
//      id INT(10) NOT NULL AUTO_INCREMENT,
//      name VARCHAR(100) NOT NULL,
//      age INT(10) NOT NULL,
//      description VARCHAR(255),
//      login VARCHAR(20) NOT NULL UNIQUE,
//      password VARCHAR(20) NOT NULL,
//      PRIMARY KEY (id)
//    ) ENGINE = InnoDB DEFAULT CHARSET = utf8 AUTO_INCREMENT = 1;";
//    $DBH->prepare($sql)->execute();
//} catch (PDOException $e) {
//    echo $e->getMessage();
//}
