<?php


class Home_Model extends Model {

    public function __construct(){
        parent::__construct();
    }

    public function createNewDatabase($dbName){
        try {
            $this->db->exec("CREATE DATABASE `$dbName`;
                CREATE USER '{DB_USER}'@'{DB_HOST}' IDENTIFIED BY '{DB_PASS}';
                GRANT ALL ON `$dbName`.* TO '{DB_USER}'@'{DB_HOST}';
                FLUSH PRIVILEGES;") or die(print_r($this->db->errorInfo(), true));
            $data = [
                'status' => TRUE,
            ];
            return $data;
        } catch(PDOException $e) {
            $data = [
                'status' => FALSE,
                'massage' => $e->getMessage()
            ];
            return $data;
        }
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
                'status' => TRUE,
            ];
            return $data;

        } catch(PDOException $e) {
//            echo $e->getMessage();//Remove or change message in production code
            $data = [
                'status' => FALSE,
                'massage' => $e->getMessage()
            ];
            return $data;
        }

    }

}