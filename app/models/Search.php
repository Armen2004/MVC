<?php

class Search_Model extends Model
{

    public function __construct()
    {
        parent::__construct();
        $this->db->query("USE " . DB_DATABASE);
    }

    public function getAllTables(){
        $sql = "show tables from " . DB_DATABASE . "";
        $result = $this->db->query($sql)->fetchAll(PDO::FETCH_COLUMN);
        return $result;
    }

    public function getTableRowNames($tableName){
        $sql = "DESCRIBE " . $tableName . "";
        $q = $this->db->prepare($sql);
        $q->execute();
        $data = $q->fetchAll(PDO::FETCH_COLUMN);
        unset($data[0]);
        unset($data[1]);
        return array_values($data);
    }

    public function search(array $data){

        $sql = "SELECT * FROM " . $data['table'] . " WHERE " . $data['field'] . " LIKE '%" . $data['search'] . "'";
        try {
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Error Handling
            $q = $this->db->prepare($sql);
            $q->execute();
            $data = $q->fetchAll(PDO::FETCH_ASSOC);
            $data = [
                'status' => TRUE,
                'massage' => 'Search Finished. With ' . count($data) . ' result.',
                'data' => json_encode($data)
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