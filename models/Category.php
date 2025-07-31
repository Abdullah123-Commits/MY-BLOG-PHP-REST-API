<?php
    class Category {
        // Db stuff
        private $conn;
        private $table = 'categories';

        // Post Properties
        public $id;
        public $name;
        public $created_at;

        // Constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        // read all function
        public function read() {
            // create query
            $query = 'SELECT
                id,
                name,
                created_at
                    FROM ' . $this->table . ' 
                    ORDER BY created_at DESC';

            // Prepare Statement 
            $stmt = $this->conn->prepare($query);
            // Execute query
            $stmt->execute();

            return $stmt;
        }
    }