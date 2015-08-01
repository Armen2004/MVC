<?php

class Controller {

    //LOAD MODEL AND RETURN MODEL OBJECT
    protected  function loadModel($model){
        require_once __app_path__.'models/' . $model . '.php';
        $modelName = $model.'_Model';
        return new $modelName();
    }

    protected function getParams(){
        return $this->params = Redirect::parsUrl() ? array_values(Redirect::parsUrl()) : [];
    }

}