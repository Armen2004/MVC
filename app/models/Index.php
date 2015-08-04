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
            $this->db->exec($sql);
            $data = [
                'status' => TRUE,
                'massage' => 'Contact Updated Successfully.'
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

    public function updateEmail($id, array $data)
    {
        $row = "emails='" . htmlentities(stripslashes($data['emails'])) . "'";

        $sql = "UPDATE emails SET " . $row . " WHERE id='". $id ."'; ";
        try {
            $this->db->exec($sql);
            $data = [
                'status' => TRUE,
                'massage' => 'Email Updated Successfully.'
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

    public function updatePhone($id, array $data)
    {
        $row = "numbers='" . htmlentities(stripslashes($data['phones'])) . "'";

        $sql = "UPDATE phonenumbers SET " . $row . " WHERE id='". $id ."'; ";
        try {
            $this->db->exec($sql);
            $data = [
                'status' => TRUE,
                'massage' => 'Phone Number Updated Successfully.'
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

    public function updateAddress($id, array $data)
    {
        $str = "";
        foreach ($data as $key => $val) {
            $str .= htmlentities(stripslashes($key)) . "='" . htmlentities(stripslashes($val)) . "', ";
        }
        $str = rtrim($str, " ,");
        $sql = "UPDATE addersses SET " . $str . " WHERE id='". $id ."'; ";
        try {
            $this->db->exec($sql);
            $data = [
                'status' => TRUE,
                'massage' => 'Phone Number Updated Successfully.'
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

    public function deleteData($id, $tableName){
        try {
            $sql = "DELETE FROM " . $tableName . " WHERE id=:ID";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':ID', $id, PDO::PARAM_INT);
            $stmt->execute();
            $data = [
                'status' => TRUE,
                'massage' => 'Data Deleted Successfully.'
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

    public function getContactByUUID($uuid){
        $sth = $this->db->prepare("SELECT * FROM contacts WHERE uuid='".$uuid."' ORDER BY id DESC");
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($result);
    }

    public function getEmailByUUID($uuid){
        $sth = $this->db->prepare("SELECT * FROM emails WHERE uuid='".$uuid."' ORDER BY id DESC");
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($result);
    }

    public function getEmailById($id){
        $sth = $this->db->prepare("SELECT * FROM emails WHERE id='".$id."'");
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($result);
    }

    public function getPhoneByUUID($uuid){
        $sth = $this->db->prepare("SELECT * FROM phonenumbers WHERE uuid='".$uuid."' ORDER BY id DESC");
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($result);
    }

    public function getPhoneById($id){
        $sth = $this->db->prepare("SELECT * FROM phonenumbers WHERE id='".$id."'");
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($result);
    }

    public function getAddressByUUID($uuid){
        $sth = $this->db->prepare("SELECT * FROM addersses WHERE uuid='".$uuid."' ORDER BY id DESC");
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($result);
    }

    public function getAddressById($id){
        $sth = $this->db->prepare("SELECT * FROM addersses WHERE id='".$id."'");
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($result);
    }
}