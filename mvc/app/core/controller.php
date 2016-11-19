<?php

class Controller
{
    public function model($model)
    {
        require_once '../app/models/' . $model . '.php';
        // CHECK FILE EXISTANCE
        return new $model();
    }

    public function view($view, $data=[])
    {
        require_once '../app/views/' . $view . '.php';
    }
}