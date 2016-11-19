<?php


class App
{
    // default controller
    protected $controller = 'home';
    // default method
    protected $method = 'index';
    // default parameters
    protected $params = [];
    // host
    public static $host;

    public function __construct()
    {
        // Get host
        self::$host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        // Parse url
        $url = $this->parseUrl();
        if (isset($url)) {
            if (file_exists('../app/controllers/' . $url[0] . '.php')) {
                // Define controller
                $this->controller = $url[0];
                // Remove from array
                unset($url[0]);
            } else {
                self::ErrorPage404();
            }
            require_once '../app/controllers/' . strtolower($this->controller) . '.php';
            // Replace controller to avoid dumped on this controller
            $this->controller = new $this->controller;
            if (isset($url[1])) {
                if (method_exists($this->controller, $url[1])) {
                    $this->method = $url[1];
                    // Remove (Helps to manage default parameters input)
                    unset($url[1]);
                }
            }
            // Get params if they exist
            $this->params = $url ? array_values($url) : [];
        } else {
            // default controller
            require_once '../app/controllers/' . strtolower($this->controller) . '.php';
            $this->controller = new $this->controller;
        }
        // Call method
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl()
    {

        if (isset($_GET['url'])) {
            // Remove trailing /
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return $url = explode('/', $url);
        }
    }

    static function ErrorPage404()
    {

        header('HTTP/1.1 404 Not Found');
        header('Status: 404 Not Found');
        header('Location:' . self::$host . 'mvc/public/error404');

    }

}
