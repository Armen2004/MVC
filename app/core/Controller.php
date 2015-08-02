<?php

class Controller {

    //LOAD MODEL AND RETURN MODEL OBJECT
    protected  function loadModel($model){
        require_once __app_path__.'models/' . $model . '.php';
        $modelName = $model.'_Model';
        return new $modelName();
    }

    protected function getParams(){
        if(Redirect::parsUrl()) {
            $allURL = array_values(Redirect::parsUrl());
            unset($allURL[0]); //controller
            unset($allURL[1]); //method
            $this->params = array_values($allURL);
        }else{
            $this->params = [];
        }
        return $this->params;

    }

}