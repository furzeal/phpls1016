<?php

class Login extends Controller
{
    public function index()
    {
        if ((isset($_POST['login'])) && (isset($_POST['password']))) {
            $login = $this->clear($_POST['login']);
            $password = $this->clear($_POST['password']);
            if ($this->check($login, $password)) {
                header('Location: ' . App::$host . 'home');
                exit();
            } else {
                echo "Неверный логин и пароль";
            }
        }
        $this->view('login');
    }

    private function check($login, $password)
    {
        $user = \Models\User::where('login', '=', $login)
            ->where('password', '=', $password)
            ->first();
        Session::init();
        if (!empty($user)) {
            Session::set('loggedIn', true);
            Session::set('id', $user->id);

            return true;
        } else {
            Session::set('loggedIn', false);
            return false;
        }
    }
}