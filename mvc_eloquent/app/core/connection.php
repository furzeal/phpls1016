<?php
namespace app\core;
use Illuminate\Database\Capsule\Manager as Capsule;

class Connection Extends Capsule
{
    public $capsule;

    public function __construct()
    {
        parent::__construct();
        // Set global Capsule
        $this->capsule = new Capsule;
        $this->capsule->addConnection([
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'phpls1016mvc',
            'username' => 'root',
            'password' => '9Hu5SZdOmYg2SXGc',
            'charset' => 'utf-8',
            'collation' => 'utf_unicode_ci',
            'prefix' => ''
        ]);
        $this->capsule->setAsGlobal();
        $this->capsule->bootEloquent();
    }
}