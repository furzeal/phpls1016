<?php
require_once 'connect.php';
session_start();
if (isset($_POST['login'])) {
    // Get login from base
    $login = htmlentities(strip_tags(trim($_POST['login'])), ENT_QUOTES);
    $sql = "SELECT login, password
            FROM users
            WHERE login = :login";
    $STH = $DBH->prepare($sql);
    $STH->execute([':login' => $login]);
    $row = $STH->fetch();
    if ($row) {
        $_SESSION['msg'] = 'Такой пользователь уже существует';
    } else {
        $_SESSION['login'] = $row['login'];
        // Check file
        $file = $_FILES['photo'];
        var_dump ($file);
        if ($file){
            if (preg_match('/jpg/', $file['name'])
                or preg_match('/png/', $file['name'])
                or preg_match('/gif/', $file['name'])
            ) {
                if (preg_match('/jpg/', $file['type'])
                    or preg_match('/png/', $file['type'])
                    or preg_match('/gif/', $file['type'])
                ) {
                    // Вот тут у меня затуп - не пойму как абсолютную ссылку указать
                    move_uploaded_file($file['tmp_name'],'/homework4/photos/'.$file['name']);
                }

            }
        }
    }

    session_write_close();
    header('Location: ' . $_SERVER['SCRIPT_NAME'], true, 302);
} else {
    $age = $_SESSION['login'];
}
?>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Homework#4</title>
</head>
<body>
<h3>Регистрация</h3>
<form enctype="multipart/form-data" method="post">
    <div>
        <label for="name">Имя</label>
        <div><input required type="text" name="name" id="name"></div>
    </div>
    <div>
        <label for="age">Возраст</label>
        <div><input required type="number" name="age" id="age"></div>
    </div>
    <div>
        <label for="description">О себе</label>
        <div>
            <textarea name="description" id="reg_ta" cols="30" rows="10"></textarea>
        </div>
        <!--        <input required type="text" name="description" id="description">-->
    </div>
    <div>
        <label for="photo">Фотография</label>
        <div>
            <input type="file" name="photo" id="photo">
        </div>
        <!--        <input required type="text" name="description" id="description">-->
    </div>
    <div>
        <label for="login">Логин</label>
        <div><input required type="text" name="login" id="login"></div>
    </div>
    <div>
        <label for="password">Пароль</label>
        <div><input required type="password" name="password" id="password"></div>
    </div>
    <div>
        <input type="submit" value="Зарегистрироваться">
        <div><input type="button" value="Отмена" onClick="window.location.href='../index.html';"></div>
    </div>

</form>
</body>
</html>