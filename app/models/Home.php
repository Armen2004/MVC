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

    public function createNewTable($database, $sql){
        $this->db->query("use {$database}" );
        try {
            $this->db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );//Error Handling
            $this->db->exec($sql);
            $data = [
                'success' => true
            ];
            return json_encode($data);

        } catch(PDOException $e) {
            echo $e->getMessage();//Remove or change message in production code
        }

    }

}