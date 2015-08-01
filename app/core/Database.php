<?php

class Database extends PDO{

    public function __construct(){
        parent::__construct( "mysql:host=".DB_HOST, DB_USER, DB_PASS );
    }
}