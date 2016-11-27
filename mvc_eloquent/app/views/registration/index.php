<?php
// https://www.google.com/recaptcha/admin#site/336394373
// homework6(localhost, dz06.loftschool)
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
<h3>Регистрация</h3>
<form enctype="multipart/form-data" action="registration" method="post">
    <div>
        <label for="name">Имя</label>
        <div><input required type="text" name="name" id="name"></div>
    </div>
    <div>
        <label for="age">Возраст</label>
        <div><input required type="number" name="age" id="age"></div>
    </div>
    <div>
        <label for="email">e-mail</label>
        <div><input required type="email" name="email" id="email"></div>
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
    <div><input type="hidden" name="g-recaptcha-response" value="6LeF-AwUAAAAANxb6DQvYEpvazp8V00oCQib8cjw"></div>
    <div class="g-recaptcha" data-sitekey="6LeF-AwUAAAAANxb6DQvYEpvazp8V00oCQib8cjw"></div>

    <div>
        <input type="submit" value="Зарегистрироваться">
        <div><input type="button" value="Отмена" onClick="window.location.href='home';"></div>
    </div>

</form>
</body>