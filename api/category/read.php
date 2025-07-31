<?php
    // header
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Category.php';

    // Instantiate DB and connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate blog post object
    $category = new Category($db);

    // Blog categories query
    $result = $category->read();
    // Get Row count
    $num = $result->rowCount();

    // Check if any categories 
    if ($num>0) {
        $category_arr = array();
        $category_arr['data'] = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $category_item = array(
                'id' => $id,
                'name' => $name,
            );

            // Push to data
            array_push($category_arr['data'], $category_item);
        }
    
        // Turn to JSON  & output
        echo json_encode($category_arr, JSON_PRETTY_PRINT);
        } else {
            // no posts
            echo json_encode(array('message' => 'No Posts Found!'));
        }

