<?php

class View {

    public static function make($view, $data=[]){
        require_once __app_path__.'views/layouts/header.php';
        require_once __app_path__.'views/' . $view .'.php';
        require_once __app_path__.'views/layouts/footer.php';
    }

}