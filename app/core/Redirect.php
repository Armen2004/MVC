<?php

class Redirect {

    public $path;

    public static function to($path, $status = 404, $message = null){
        print_r(urldecode($message));
        header('Location: ' . $path . '/' . $status . '/' . urldecode($message));
    }

    public static function URL(){
        if(isset($_GET['url'])){
            return filter_var($_GET['url'], FILTER_SANITIZE_URL);
        }
    }

    public static function parsUrl() {
        if (isset($_GET['url'])) {
            return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }

}