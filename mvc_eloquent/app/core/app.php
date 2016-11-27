<?php


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

        $router = new Router;
    }
}
