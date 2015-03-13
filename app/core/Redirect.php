<?php

class Redirect {

    public $path;

    public static function to($path, $status = 404, $message = null){
        print_r(urldecode($message));
        header('Location: ' . $path . '/' . $status . '/' . urldecode($message));
    }

}