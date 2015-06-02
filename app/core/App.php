<?php

class App {

    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $model = 'User';
    protected $params = [];

    public function __construct() {
        $url = $this->parsUrl();
        if ($url) {
            if (isset($url[0])) {
                if (file_exists(__app_path__ . 'controllers/' . ucwords($url[0]) . 'Controller.php')) {
                    $this->controller = ucwords($url[0]) . 'Controller';
                    $modelName = ucwords($url[0]);
                    unset($url[0]);
                } else {
                    $this->errorHendler(404, ucwords($url[0]) . 'Controller.php');
                    return false;
                }
            }
        }

        require_once __app_path__ . 'controllers/' . ucwords($this->controller) . '.php';

        if (!isset($modelName)) {
            $modelName = explode('Controller', ucwords($this->controller));
            $modelName = $modelName[0];
        }
        $this->controller = new $this->controller;
        $data = $this->controller->loadModel($modelName);
        if (!$data) {
            $this->errorHendler(404, ucwords($url[0]) . ' model');
            return false;
        }


        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            } else {
                $this->errorHendler(404, $url[1] . ' action');
                return false;
            }
        }

        $this->params = $url ? array_values($url) : [];

        Session::init();

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parsUrl() {
        if (isset($_GET['url'])) {
            return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }

    public function errorHendler($code = 404, $massage) {
        require_once __app_path__ . 'controllers/ErrorController.php';
        $controller = new ErrorController();
        $controller->Error($code, $massage);
    }

}
