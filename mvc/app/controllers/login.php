<?php


class Login extends Controller
{
    public function index()
    {
        if ((isset($_POST['login'])) && (isset($_POST['password'])))
            {
                $model = $this->model('model_login');
                $login = htmlentities(strip_tags(trim($_POST['login'])), ENT_QUOTES);
                $password = htmlentities(strip_tags(trim($_POST['password'])), ENT_QUOTES);
                if ($model->check($login,$password)) {
                    //echo 1;
                    header('Location:' . App::$host . 'mvc/public/home');
                    exit();
                }else{
                    echo "Неверный логин и пароль";
                }
            }
        $this->view('login');
    }
}