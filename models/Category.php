<?php
    class Category {
        // Db stuff
        private $conn;
        private $table = 'categories';

        // Post Properties
        public $category_id;
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
                category_id,
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

        // read single function
        public function read_single() {
            // create query
            $query = 'SELECT
                category_id,
                name
                    FROM ' . $this->table . ' 
                    WHERE category_id = ?
                    LIMIT 0,1';

            // Prepare Statement 
            $stmt = $this->conn->prepare($query);
            // Bind ID
            $stmt->bindParam(1, $this->category_id);
            // Execute query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Set properties
            $this->category_id = $row['category_id'];
            $this->name = $row['name'];
        }

        // Create Category
        public function create() {
            // Create Category in Database
            $query = 'INSERT INTO ' . $this->table . '
                SET 
                    name = :name';
            // prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data for security
            $this->name = htmlspecialchars(strip_tags($this->name));

            // Bind data
            $stmt->bindParam(':name', $this->name);

            // Execute query
            if($stmt->execute()) {
                return true;
            }
            // print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);
            return false;
        }

        // Update Category
        public function update() {
            // update category in database
            $query = 'UPDATE ' . $this->table . '
                SET 
                    name = :name
                WHERE
                    category_id = :category_id';

            // prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data for security
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));

            // Bind data
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':category_id', $this->category_id);   

            // Execute query
            if($stmt->execute()) {
                return true;
            }

            // print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);
            return false;
        }

        // Delete Category
        public function delete() {
            // delete category in database
            $query = 'DELETE FROM ' . $this->table . ' WHERE category_id = :category_id';

            // prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data for security
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));

            // Bind data
            $stmt->bindParam(':category_id', $this->category_id);   

            // Execute query
            if($stmt->execute()) {
                return true;
            }

            // print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);
            return false;
        }
    }