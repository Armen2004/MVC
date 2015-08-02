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
                'uuid' => $data['uuid'],
                'massage' => 'Contact Created Successfully.'
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

    public function createEmails($id, array $data){
        $sql = "";
        foreach ($data as $key => $val) {
            $values = htmlentities(stripslashes($val));
            $id = htmlentities(stripslashes($id));
            $sql .= "INSERT INTO emails (uuid, emails) VALUES ('" . $id . "','" . $values . "'); ";
        }
        try {
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Error Handling
            $this->db->exec($sql);
            $data = [
                'status' => TRUE,
                'uuid' => $id,
                'massage' => 'Email(s) Created Successfully.'
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

    public function createPhones($id, array $data){
        $sql = "";
        foreach ($data as $key => $val) {
            $values = htmlentities(stripslashes($val));
            $id = htmlentities(stripslashes($id));
            $sql .= "INSERT INTO phonenumbers (uuid, numbers) VALUES ('" . $id . "','" . $values . "'); ";
        }
        try {
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Error Handling
            $this->db->exec($sql);
            $data = [
                'status' => TRUE,
                'uuid' => $id,
                'massage' => 'Phone Number(s) Created Successfully.'
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

    public function createAddresses($id, array $data){
        $keys = "";
        $value = "";
        foreach ($data as $key => $val) {
            $keys .= htmlentities(stripslashes($key)) . ", ";
            $value .= "'" . htmlentities(stripslashes($val)) . "', ";
        }
        $keys = rtrim($keys, " ,");
        $value = rtrim($value, " ,");
        $sql = "INSERT INTO addersses (uuid, " . $keys . ") VALUES ('" . $id . "', " . $value . "); ";
        try {
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Error Handling
            $this->db->exec($sql);
            $data = [
                'status' => TRUE,
                'uuid' => $id,
                'massage' => 'Phone Number(s) Created Successfully.'
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

    public function updateContactInfo($id, array $data)
    {
        $str = "";
        foreach ($data as $key => $val) {
            $str .= htmlentities(stripslashes($key)) . "='" . htmlentities(stripslashes($val)) . "', ";
        }
        $str = rtrim($str, " ,");
        $sql = "UPDATE contacts SET " . $str . " WHERE uuid='". $id ."'; ";
        try {
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Error Handling
            $this->db->exec($sql);
            $data = [
                'status' => TRUE,
                'massage' => 'Contact Created Successfully.'
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
        $sth = $this->db->prepare("SELECT * FROM contacts ORDER BY id DESC");
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($result);
    }

    public function getContactById($uuid){
        $sth = $this->db->prepare("SELECT * FROM contacts WHERE uuid='".$uuid."'");
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($result);
    }

    public function getEmailById($uuid){
        $sth = $this->db->prepare("SELECT * FROM emails WHERE uuid='".$uuid."'");
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($result);
    }

    public function getPhoneById($uuid){
        $sth = $this->db->prepare("SELECT * FROM phonenumbers WHERE uuid='".$uuid."'");
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($result);
    }

    public function getAddressById($uuid){
        $sth = $this->db->prepare("SELECT * FROM addersses WHERE uuid='".$uuid."'");
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($result);
    }
}