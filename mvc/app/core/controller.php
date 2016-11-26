<?php

class Controller
{
    public $twig;
    public $base;
    public function __construct()
    {
        $this->base=str_replace("\\core","",__DIR__);
        $loader = new Twig_Loader_Filesystem($this->base.'/views/templates');
        $this->twig = new Twig_Environment($loader,[
         'cache'=>false
        ]);
    }

    public function model($model)
    {
        require_once '../app/models/' . $model . '.php';
        // CHECK FILE EXISTANCE
        return new $model();
    }

    public function view($view, $data = [])
    {
        //require_once '../app/views/' . $view . '.php';
        $view = $view.'.twig';
        echo "<pre>";
        var_dump($view);
        echo $this->twig->render($view, $data);
    }
}