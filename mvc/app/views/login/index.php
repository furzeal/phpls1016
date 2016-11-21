<h3>Авторизация</h3>

<form action="login" method="post">
    <div>
        <label for="login">Логин</label>
        <div>
            <input type="text" name="login" id="login">
        </div>
    </div>
    <div>
        <label for="password">Пароль</label>
        <div>
            <input type="password" name="password" id="password">
        </div>
    </div>
    <div>
        <div>
            <input type="submit" value="Войти">
        </div>
        <input type="button" value="Зарегистрироваться" onClick="window.location.href='registration'">
    </div>
</form>