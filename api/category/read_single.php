<?php
    // header
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    
    include_once '../../config/Database.php';
    include_once '../../models/Category.php';

    // Instantiate DB and connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate blog post category object
    $category = new Category($db);

    // Get ID
    $category->category_id = isset($_GET['id']) ? $_GET['id'] : die();

    // Blog categories query
    $category->read_single();

    // Create aArray
    $category_arr = array(
        'category_id' => $category->category_id,
        'name' => $category->name,
    );

    // Make JSON
    echo json_encode($category_arr);