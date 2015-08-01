<?php

class Index_Model extends Model
{

    public function __construct()
    {
        parent::__construct();
        $this->db->query("USE " . DB_DATABASE);
    }

    public function createContactInfo(array $data)
    {
        $keys = "";
        $value = "";
        foreach ($data as $key => $val) {
            $keys .= htmlentities(stripslashes($key)) . ", ";
            $value .= "'" . htmlentities(stripslashes($val)) . "', ";
        }
        $keys = rtrim($keys, " ,");
        $value = rtrim($value, " ,");
        $sql = "INSERT INTO contacts (" . $keys . ") VALUES (" . $value . "); ";
        try {
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Error Handling
            $this->db->exec($sql);
            $data = [
                'status' => TRUE,
                'massage' => 'Contact Create Successfully.'
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

    public function getAllContacts(){
        $sth = $this->db->prepare("SELECT * FROM contacts");
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


}