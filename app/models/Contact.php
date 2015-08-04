<?php

class Contact_Model extends Model
{

    public function __construct()
    {
        parent::__construct();
        $this->db->query("USE " . DB_DATABASE);
    }

    public function getAllData(){
        $sth = $this->db->prepare("SELECT * FROM addersses");
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($result);
    }
}