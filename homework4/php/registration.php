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
<form action="insert_user.php" method="post">
    <div>
        <label for="name">Имя</label>
        <input required type="text" name="name" id="name">
    </div>
    <div>
        <label for="age">Возраст</label>
        <input required type="number" name="age" id="age">
    </div>
    <div>
        <label for="description">О себе</label>
        <input required type="text" name="description" id="description">
    </div>
    <div>
        <label for="login">Логин</label>
        <input required type="text" name="login" id="login">
    </div>
    <div>
        <label for="password">Пароль</label>
        <input required type="password" name="password" id="password">
    </div>
    <div>
        <input type="submit" value="Зарегистрироваться">
        <input type="button" value="Отмена" onClick="window.location.href='../index.html';">
    </div>
</form>
</body>
</html>