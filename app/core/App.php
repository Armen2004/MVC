<?php

class App {

    protected $controller = 'HomeController';

    protected $method = 'index';

    protected $model = 'User';

    protected $params = [];

    public function __construct(){
        $url = $this->parsUrl();

        if(isset($url[0])) {
            if (file_exists(__app_path__.'controllers/' . ucwords($url[0]) . 'Controller.php')) {
                $this->controller = ucwords($url[0]) . 'Controller';
            } else {
                require_once __app_path__.'controllers/ErrorController.php';
                $controller = new ErrorController();
                $controller->Error(404, ucwords($url[0]) . 'Controller.php');
                return false;
            }
        }

        require_once __app_path__.'controllers/' . ucwords($this->controller) . '.php';

        $this->controller = new $this->controller;
        $data = $this->controller->loadModel(ucwords($url[0]));
        if(!$data){
            require_once __app_path__.'controllers/ErrorController.php';
            $controller = new ErrorController();
            $controller->Error(404, ucwords($url[0]) . '.php');
            return false;
        }
        unset($url[0]);

        if(isset($url[1])){
            if(method_exists($this->controller, $url[1])){
                $this->method = $url[1];
                unset($url[1]);
            }else{
                echo '<strong>' . $url[1] . '</strong> method does not exists';
                exit;
            }
        }

        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parsUrl(){
        if(isset($_GET['url'])){
            return $url = explode('/', filter_var(rtrim($_GET['url'],'/'), FILTER_SANITIZE_URL));
        }
    }

}