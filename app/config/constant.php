<?php

// define the directory separator
define('DS', DIRECTORY_SEPARATOR);

// define the base path
define('__base_path__', dirname(dirname(dirname(__FILE__))) . DS);

// define the application path
define('__app_path__', dirname(dirname(__FILE__)) . DS);

// define the public path
define('__public_path__', dirname($_SERVER['PHP_SELF']) . DS);

