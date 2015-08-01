<?php

class Install_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function createNewDatabase($dbName) {
        try {
            $this->db->exec("CREATE DATABASE IF NOT EXISTS `$dbName`;
                CREATE USER '{DB_USER}'@'{DB_HOST}' IDENTIFIED BY '{DB_PASS}';
                GRANT ALL ON `$dbName`.* TO '{DB_USER}'@'{DB_HOST}';
                FLUSH PRIVILEGES;") or die(print_r($this->db->errorInfo(), true));
                Session::set('massage-db', 'Database Created Successfully.');
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
            Session::set('massage-table', 'Table Created Successfully.');
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
        if(!Session::get('max_row_count')) {
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
    }

    public function insertDataIntoTableArray(array $data, $id) {
        if(!Session::get('max_row_count')) {
            $sql = "";
            foreach ($data as $key => $val) {
                foreach ($val as $key1 => $val1) {
                    switch (strtolower($key)) {
                        case "phonenumbers":
                            $sql .= "INSERT INTO " . strtolower($key) . " (uuid, numbers) VALUES ('" . htmlentities(stripslashes($id)) . "', '" . htmlentities(stripslashes($val1)) . "'); ";
                            break;
                        case "emails":
                            $sql .= "INSERT INTO " . strtolower($key) . " (uuid, emails) VALUES ('" . htmlentities(stripslashes($id)) . "', '" . htmlentities(stripslashes($val1)) . "'); ";
                            break;
                    }
                }
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
                echo $e->getMessage();
                $data = [
                    'status' => FALSE,
                    'massage' => $e->getMessage()
                ];
                return $data;
            }
        }
    }

    public function insertDataIntoTableNewArray(array $data, $id) {
        if(!Session::get('max_row_count')) {
            $keys = "";
            $vals = "";
            foreach ($data as $key => $val) {
                $tableName = $key;
                foreach ($val as $key1 => $val1) {
                    $keys .= htmlentities(stripslashes($key1)) . ", ";
                    $vals .= "'" . htmlentities(stripslashes($val1)) . "', ";
                }
            }
            $keys = rtrim($keys, " ,");
            $vals = rtrim($vals, " ,");
            $sql = "INSERT INTO " . $tableName . " (uuid, " . $keys . ") VALUES ('" . $id . "', " . $vals . "); ";
            try {
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Error Handling
            $this->db->exec($sql);
                $data = [
                    'status' => TRUE,
                    'massage' => 'Data Inserted Successfully.'
                ];
                return $data;
            } catch (PDOException $e) {
                echo $e->getMessage();
                $data = [
                    'status' => FALSE,
                    'massage' => $e->getMessage()
                ];
                return $data;
            }
        }
    }

}
