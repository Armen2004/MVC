<?php

// define the directory separator
define('DS', '/');

//checking if user created virtual host
if($_SERVER['SERVER_NAME'] == 'localhost'){
    
    // define the base path
    define('__base_path__', 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'] . '?url=');
    
    // define the application path
    define('__app_path__', dirname(dirname(__FILE__)) . DS);
    
    // define the public path
    define('__public_path__', dirname($_SERVER['PHP_SELF']) . DS);

    // define the file path
    define('__file_path__', $_SERVER['DOCUMENT_ROOT'] . __public_path__);
    
}else{
        
    // define the base path
    define('__base_path__', DS);

    // define the application path
    define('__app_path__', dirname(dirname(__FILE__)) . DS);

    // define the public path
    define('__public_path__', DS);

    // define the file path
    define('__file_path__', $_SERVER['DOCUMENT_ROOT'] . __public_path__);
}

define('LOGIN_SALT', "!4Q45$@A#2ED%c6^G2&1h27*Y3(B48)4?h_s4T0+9Bgt");
define('OTHER_SALT', "a4zxDfe67g9@%hKN5rfgyGHuikjB6H5&Yh6nm$7p0*k");

