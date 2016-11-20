<?php

Class Home extends Controller
{
    public function __construct()
    {
        Session::init();
        $logged = Session::get('loggedIn');
        var_dump($logged);
        if ($logged == false) {
            //Session::destroy();
            header('Location:' . App::$host . 'mvc/public/login');
            exit();
        }

    }

    public function index()
    {
        $this->view('header');
        $this->view('home/index');
    }

    public function logout()
    {
        Session::destroy();
        header('Location:' . App::$host . 'mvc/public/login');
        exit();
    }
}
