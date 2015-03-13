<?php

class Controller {
//    protected $model;

    public function __construct(){

    }

    public function loadModel($name){
        $path = __app_path__.'models/' . $name . '.php';
        if(file_exists($path)){
            require_once $path;
            $modelName = $name.'_Model';
            $this->model = new $modelName;
            return true;
        }else{
            return false;
        }
    }

//    public static function view($view, $data=[]){
//        require_once __app_path__.'views/' . $view .'.php';
//    }

}