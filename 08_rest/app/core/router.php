<?php
namespace Shop;
class Router
{
//    // default controller
//    protected $controller = 'home';
//    // default method
//    protected $method = 'index';
//    // default parameters
//    protected $params = [];

    public function __construct()
    {
        // Get method
        $method = $_SERVER['REQUEST_METHOD'];
        // Parse url
        $url = $this->parseUrl();
//        exit(print_r($url, 1));
        if (isset($url)) {
            if ((isset($url[0])) && ($url[0] == "api")) {
                unset($url[0]);
            } else {
                exit();
            }
            // Check version
            if (isset($url[1]))
                if (preg_match("/v[0-9]*/", $url[1])) {
                    unset($url[1]);
                } else {
                    exit();
                }
            // Get table
            if (isset($url[2])) {
                $this->table = $url[2];
                // Remove (Helps to manage default parameters input)
                unset($url[2]);
            }
            // Get params if they exist
            $this->params = $url ? array_values($url) : [];
            $className = "\\Shop\\".$this->table;
            // Search class
            if (class_exists($className)) {
                $this->table = new $className;
                // Call method
                if (!empty($this->params)) {
                    $id = $this->params[0];
                }
                switch ($method) {
                    case "GET":
                        if (isset($id)) {
                            $this->table->show($id);
                        } else {
                            $this->table->index();
                        }
                        break;
                    case "POST":
                        $this->table->store();
                        break;
                    case "PUT":
                        if (isset($id)) {
                            $this->table->edit($id);
                        } else {
                            exit();
                        }
                        break;
                    case "DELETE":
                        if (isset($id)) {
                            $this->table->destroy($id);
                        } else {
                            exit();
                        }
                        break;
                }
            } else {
                exit();
            }
        } else {
            exit();
        }
    }

    public
    function parseUrl()
    {
        if (isset($_GET['url'])) {
            // Remove trailing /
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return $url = explode('/', $url);
        }
    }

    static function RedirectErrorPage404()
    {
        header('HTTP/1.1 404 Not Found');
        header('Status: 404 Not Found');
        header('Location: error404.php');
    }
}