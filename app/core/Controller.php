<?php

class Controller {

    //LOAD MODEL AND RETURN MODEL OBJECT
    protected  function loadModel($model){
        require_once __app_path__.'models/' . $model . '.php';
        $modelName = $model.'_Model';
        return new $modelName();
    }

    //LOAD VIEW
    protected function view($view,$data=[]){
        require_once '../app/views/'.$view.'.php';
    }
}