<?php

class inicio {


    public function __construct() {
        $database = new Database();
        $this->db = $database->getDB();
    }
}