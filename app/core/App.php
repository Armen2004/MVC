<?php

class App {

    protected $controller = 'IndexController';//DEFAULT CONTROLLER
    protected $method = 'index';//DEFAULT METHOD
    protected $params = [];//PARAMETERS ARE NOT SET BY DEFAULT

    public function __construct() {
        //GETTING PARSED URL
        $url = $this->parsUrl();
        
        //CHECK IF CONTROLLER EXISTS, IF NOT REQUIRING DEFAULT CONTROLLER
        if ($url) {
            if (isset($url[0])) {
                if (file_exists(__app_path__ . 'controllers/' . ucwords($url[0]) . 'Controller.php')) {
                    $this->controller = ucwords($url[0]) . 'Controller';
                    unset($url[0]);
                } else {
                    $this->errorHandler(404, ucwords($url[0]) . 'Controller.php');
                    return false;
                }
            }
        }
        
        require_once __app_path__ . 'controllers/' . ucwords($this->controller) . '.php';

        $this->controller = new $this->controller;
        
        //CHECK IF CONTROLLER METHOD EXISTS
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            } else {
                $this->errorHandler(404, $url[1] . ' action');
                return false;
            }
        }
        
        //CHANGING INDEXES TO START FROM 0 IF URL EXISTS
        $this->params = $url ? array_values($url) : [];

        //CALLING THE FUNCTION BASED ON URL ELEMENTS (CONTROLLER,METHOD,PARAMS)
        call_user_func_array([$this->controller, $this->method], $this->params);
    }
    
    //PARSING URL FOR TRIMMING SLASHES AFTER URL, SANITIZING URL AND EXPLODING
    public function parsUrl() {
        if (isset($_GET['url'])) {
            return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }

    //ERROR HANDLER
    public function errorHandler($code = 404, $massage) {
        require_once __app_path__ . 'controllers/ErrorController.php';
        $controller = new ErrorController();
        $controller->Error($code, $massage);
    }

}
