<?php
    class Database {
        // DB Params
        private $host = 'localhost';
        private $db_name = 'myblog';
        private $username = 'root';
        private $password = '123456';
        private $conn;
        
        // DB Connect
        public function connect() {
            $this->conn = null;
            // PDO Exception
            try {
                $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            } catch(PDOException $e) {
                echo 'connection error:'.$e->getMessage();
            }
            return $this->conn;
        }
    }
