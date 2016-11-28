<?php
use Illuminate\Database\Capsule\Manager as Capsule;

class App
{
    // host
    public static $host;
    // root directory
    public static $baseDir;
    // capsule
    public static $capsule;

    public function __construct()
    {
        // Define Base Dir
        self::$baseDir = dirname(dirname(__DIR__));
        // Get host
        self::$host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        // Get connection
        self::$capsule = self::getCapsule();
        // Start router
        $router = new Router;
    }

    public static function getCapsule()
    {
        $capsule = new Capsule;
        $capsule->addConnection([
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'phpls1016mvc',
            'username'  => 'root',
            'password'  => '9Hu5SZdOmYg2SXGc',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => ''
        ]);
        // Make this Capsule instance available globally via static methods... (optional)
        $capsule->setAsGlobal();
        // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
        $capsule->bootEloquent();
        return $capsule;
    }
}
