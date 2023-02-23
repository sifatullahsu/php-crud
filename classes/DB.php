<?php

class DB {
    private $db_host = 'localhost';
    private $db_user = 'root';
    private $db_pass = '';
    private $db_name = 'crud';

    public $table;

    protected function connection() {
        $dsn = 'mysql:host=' . $this->db_host . ';dbname=' . $this->db_name;
        $pdo = new PDO($dsn, $this->db_user, $this->db_pass);

        return $pdo;
    }
}