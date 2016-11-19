<?php


class Dashboard extends Controller
{
    public function __construct() {
        Session::init();
        $logged = Session::get('loggedIn');
        if($logged == false) {
            Session::destroy();
            header('Location:' . App::$host .'mvc/public/login');
            exit();
        }
    }
    public function index()
    {
        $this->view('dashboard/index');
    }
    public function logout() {
        Session::destroy();
        header('Location:' . App::$host .'mvc/public/login');
        exit();
    }
}


