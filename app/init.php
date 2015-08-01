<?php

//database connection
require_once 'config/database.php';

//constants
require_once 'config/constant.php';

//auto loading php cores
function __autoload($class){
    require_once "core/{$class}.php";
}

//STARTING SESSION
Session::init();

Session::set('site-title', 'Test App For Helix');