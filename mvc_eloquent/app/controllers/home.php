<?php

Class Home extends Controller
{
    public function __construct()
    {
        parent::__construct();
        Session::init();
        $logged = Session::get('loggedIn');
        if ($logged == false) {
            //Session::destroy();
            header('Location:' . App::$host . 'login');
            exit();
        }
    }

    public function index()
    {
        $id = Session::get('id');
        $currentUser = \Models\User::find($id);
        $users = \Models\User::orderBy('age', 'asc')->get();
        $photos = $currentUser->photos();
        foreach ($users as $user) {
            if ($user->age < 18) {
                $ageTypes[] = 'несовершеннолетний';
            } else {
                $ageTypes[] = 'совершеннолетний';
            }

        }
        $this->view('home', [
            'user' => $currentUser,
            'users' => $users,
            'ageTypes' => $ageTypes,
            'photos' => $photos
        ]);
    }

    public function logout()
    {
        Session::destroy();
        header('Location:' . App::$host . 'login');
        exit();
    }
}