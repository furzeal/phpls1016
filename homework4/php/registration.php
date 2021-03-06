<?php
if (isset($_GET['getsess'])) {
    session_start();
    exit('<pre>' . print_r($_SESSION,1));
}
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
        echo "Такой пользователь уже существует";
        $_SESSION['msg'] = 'Такой пользователь уже существует';
        session_write_close();
    } else {
        $_SESSION['login'] = $row['login'];
        // Check file
        $file = empty($_FILES['photo']) ? null : $_FILES['photo'];
        //echo '{$file:}';
        //var_dump($file['error']);
        //echo "</br>";

        // Бесполезные 2 IF, которые плодят однотипные конструкции else.
        // Правильнее объединить группы условий в одном IF
        if ($file['error'] === UPLOAD_ERR_OK) {
            if (preg_match('/jpg/', $file['name'])
                or preg_match('/png/', $file['name'])
                or preg_match('/gif/', $file['name'])
            ) {

                if (preg_match('/jpg/', $file['type'])
                    or preg_match('/png/', $file['type'])
                    or preg_match('/gif/', $file['type'])
                ) {
                    // $_FILES['photo'] = move_uploaded_file($file['tmp_name'],'../photos/'.$file['name']);
                    //session_write_close();
                    // Insert user
                    insertUser($DBH, true, $file);
                } else {
                    echo "Файл не является картинкой";
                    $_SESSION['msg'] = 'Файл не является картинкой';
                    session_write_close();
                }
            } else {
                echo "Файл не является картинкой";
                // Когда загружаешь файл другого типа - var_dump($msg) все равно показывает NULL
                $_SESSION['msg'] = 'Файл не является картинкой';
                session_write_close();
            }
        } else {
            insertUser($DBH);
        }
    }
} else {
    $login = $_SESSION['login'];
    $msg = $_SESSION['msg'];
}

function insertUser($DBH, $withFile = false, $file = null)
{
    try {
        $name = htmlentities(strip_tags(trim($_POST['name'])), ENT_QUOTES);
        $age = (int)($_POST['age']);
        $description = htmlentities(strip_tags(trim($_POST['description'])), ENT_QUOTES);
        $login = htmlentities(strip_tags(trim($_POST['login'])), ENT_QUOTES);
        $password = htmlentities(strip_tags(trim($_POST['password'])), ENT_QUOTES);
        if ($withFile) {
            $filename = makeFilename($login, $file);
            // Move file
            $_FILES['photo'] = move_uploaded_file($file['tmp_name'], '../photos/' . $filename);
            $sql = "INSERT INTO users(name, age, description, login, password, filename)
                    VALUES (?, ?, ?, ?, ?, ?)";
            $STH = $DBH->prepare($sql);
            $data = [$name, $age, $description, $login, $password, $filename];
        } else {
            $sql = "INSERT INTO users(name, age, description, login, password)
                    VALUES (?, ?, ?, ?, ?)";
            $STH = $DBH->prepare($sql);
            $data = [$name, $age, $description, $login, $password];

        }
        //var_dump($data);
        $STH->execute($data);
        header('HTTP/1.1 307 Temporary Redirect');
        header('Location: homepage.php');
        exit;

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function makeFilename($login, $file)
{
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $result = $login . "_avatar.$ext";
    return $result;
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
    <?php
    //echo '{$msg:}';
    //var_dump($msg);
    //echo "</br>";
    ?>
    <div>
        <label for="name">Имя</label>
        <div><input required type="text" name="name" id="name"></div>
    </div>
    <div>
        <label for="age">Возраст</label>
        <div><input required type="number" name="age" id="age"></div>
    </div>
    <div>
        <label for="reg_ta">О себе</label>
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