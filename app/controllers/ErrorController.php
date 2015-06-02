<?php

class ErrorController{

    public $status;
    public $massage;

    public function Error($status = null, $massage = null){
        $data['massage'] = "ErrorNo : <strong>{$status}</strong>. <strong>{$massage}</strong> doesn't exist.";
        View::errorMake('error/error', $data);
    }
    
    public function Request($status = null, $massage = null){
        $data['massage'] = "ErrorNo : <strong>{$status}</strong>. <strong>HTTP Error {$status} - Bad Request</strong> .";
        View::errorMake('error/error', $data);
    }
}