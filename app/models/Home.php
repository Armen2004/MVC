<?php


class Home_Model extends Model {

    public function __construct(){
        parent::__construct();
    }

    public function run($dbName){
        $this->db->createDB($dbName);
    }

    public function showDBS(){
        return $this->db->query( 'SHOW DATABASES' )->fetchAll();
//        print_r($data);
    }

    public function showTablesByDB($dbName){
        $sql = "SHOW TABLES from {$dbName}";
        $query = $this->db->query($sql);
        return $query->fetchAll(PDO::FETCH_COLUMN);
    }

    public function createNewTable(){
        $this->db->query("use {$_POST['database']}" );
        $table = $_POST['table_name'];
        try {
            $this->db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );//Error Handling
            $sql ="CREATE table $table(
             ID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
             Prename VARCHAR( 50 ) NOT NULL,
             Name VARCHAR( 250 ) NOT NULL,
             StreetA VARCHAR( 150 ) NOT NULL,
             StreetB VARCHAR( 150 ) NOT NULL,
             StreetC VARCHAR( 150 ) NOT NULL,
             County VARCHAR( 100 ) NOT NULL,
             Postcode VARCHAR( 50 ) NOT NULL,
             Country VARCHAR( 50 ) NOT NULL);" ;
            $this->db->exec($sql);
            print("Created $table Table.\n");

        } catch(PDOException $e) {
            echo $e->getMessage();//Remove or change message in production code
        }
//        print_r($_POST);
    }

}