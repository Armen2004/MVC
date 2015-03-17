<?php

class Database extends PDO{

    public $dbhost = "localhost";
    public $dbusername = "root";
    public $dbpassword = "root";
    public $connectDB;

    public function __construct(){
        parent::__construct( "mysql:host={$this->dbhost}", $this->dbusername, $this->dbpassword );
//        return $this->connectDB;
    }

//    public function showDataBases(){
//        return $this->connectDB->query( 'SHOW DATABASES' )->fetchAll();
//    }

    public function createDB($dbName){
        try {
            $this->connectDB->exec("CREATE DATABASE `$dbName`;
                CREATE USER '$this->dbusername'@'{$this->dbhost}' IDENTIFIED BY '$this->dbpassword';
                GRANT ALL ON `$dbName`.* TO '$this->dbusername'@'{$this->dbhost}';
                FLUSH PRIVILEGES;")
            or die(print_r($this->connectDB->errorInfo(), true));

        } catch (PDOException $e) {
            die("DB ERROR: ". $e->getMessage());
        }
    }

    public function createTable($dbname, $tableName, $params = []){

        try {
            $this->connectDB->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );//Error Handling

            foreach($params as $param){

            }
            $sql ="CREATE table $tableName(
                 ID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
                 Prename VARCHAR( 50 ) NOT NULL,
                 Name VARCHAR( 250 ) NOT NULL,
                 StreetA VARCHAR( 150 ) NOT NULL,
                 StreetB VARCHAR( 150 ) NOT NULL,
                 StreetC VARCHAR( 150 ) NOT NULL,
                 County VARCHAR( 100 ) NOT NULL,
                 Postcode VARCHAR( 50 ) NOT NULL,
                 Country VARCHAR( 50 ) NOT NULL);" ;
            $this->connectDB->exec($sql);
            print("Created $tableName Table.\n");

        } catch(PDOException $e) {
            echo $e->getMessage();//Remove or change message in production code
        }

    }

}