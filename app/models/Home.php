<?php

class Home_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function createNewDatabase($dbName) {
        try {
            $this->db->exec("CREATE DATABASE IF NOT EXISTS `$dbName`;
                CREATE USER '{DB_USER}'@'{DB_HOST}' IDENTIFIED BY '{DB_PASS}';
                GRANT ALL ON `$dbName`.* TO '{DB_USER}'@'{DB_HOST}';
                FLUSH PRIVILEGES;") or die(print_r($this->db->errorInfo(), true));
            $data = [
                'status' => TRUE,
                'massage' => 'Database Created Successfully.'
            ];
            return $data;
        } catch (PDOException $e) {
            $data = [
                'status' => FALSE,
                'massage' => $e->getMessage()
            ];
            return $data;
        }
    }

    public function createNewTable($sql) {
        $this->db->query("USE " . DB_DATABASE);
        try {
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Error Handling
            $this->db->exec($sql);
            $data = [
                'status' => TRUE,
                'massage' => 'Table Created Successfully.'
            ];
            return $data;
        } catch (PDOException $e) {
//            echo $e->getMessage();//Remove or change message in production code
            $data = [
                'status' => FALSE,
                'massage' => $e->getMessage()
            ];
            return $data;
        }
    }

    public function insertDataIntoTable(array $data) {
        $keys = "";
        $vals = "";
        foreach ($data as $key => $val) {
            $keys .= htmlentities(stripslashes($key)) . ", ";
            $vals .= "'" . htmlentities(stripslashes($val)) . "', ";
        }
        $keys = rtrim($keys, " ,");
        $vals = rtrim($vals, " ,");
        $sql = "INSERT INTO contacts (" . $keys . ") VALUES (" . $vals . ")";
        try {
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Error Handling
            $this->db->exec($sql);
            $data = [
                'status' => TRUE,
                'massage' => 'Data Inserted Successfully.'
            ];
            return $data;
        } catch (PDOException $e) {
            $data = [
                'status' => FALSE,
                'massage' => $e->getMessage()
            ];
            return $data;
        }
    }

    public function insertDataIntoTableNew(array $data, $id) {
        foreach ($data as $key => $val) {
            foreach ($val as $key1 => $val1) {
                switch ($key) {
                    case "phoneNumbers":
                        $sql = "INSERT INTO " . $key . " (uuid, numbers) VALUES ('" . $id . "', " . $val1 . "')";
                        break;
                    case "emails":
                        $sql = "INSERT INTO " . $key . " (uuid, uuid, emails) VALUES ('" . $id . "', " . $val1 . "')";
                        break;
                    default:
                        return;
                }
                try {
                    $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Error Handling
                    $this->db->exec($sql);
                    $data = [
                        'status' => TRUE,
                        'massage' => 'Data Inserted Successfully.'
                    ];
                    return $data;
                } catch (PDOException $e) {
                    $data = [
                        'status' => FALSE,
                        'massage' => $e->getMessage()
                    ];
                    return $data;
                }
            }
        }
    }

}
