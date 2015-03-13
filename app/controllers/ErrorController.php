<?php

class ErrorController{

    public $status;
    public $massage;

    public function Error($status = null, $massage = null){
        $data['massage'] = "ErrorNo : <strong>{$status}</strong>. <strong>{$massage}</strong> doesn't exist.";
        View::make('404/404', $data);
    }

}