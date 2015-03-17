<?php

class Model {

    public function __construct(){
        $this->db = new Database();
        return $this->db;
    }

}