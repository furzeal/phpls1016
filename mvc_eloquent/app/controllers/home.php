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
            header('Location: login');
            exit();
        }

    }

    public function index()
    {
        $id = Session::get('id');
        $currentUser = $this->model('user');
        $currentUser->getData($id);
        $ids = $this->model('users')->getUsers();
        foreach ($ids as $userID) {
            $id = $userID['id'];
            $user = $this->model('user');
            $user->getData($id);
            $users[] = $user;
        }
        usort($users, array($this, "cmp_obj"));
        $this->view('home', ['user' => $currentUser, 'users' => $users]);
        //$this->view('home');

    }

    public function logout()
    {
        Session::destroy();
        header('Location: ../login');
        exit();
    }

    private static function cmp_obj($a, $b)
    {
        $al = $a->age;
        $bl = $b->age;
        if ($al == $bl) {
            return 0;
        }
        return ($al > $bl) ? +1 : -1;
    }
}