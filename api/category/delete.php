<?php
    // header
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: delete');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


    include_once '../../config/Database.php';
    include_once '../../models/Category.php';

    // Instantiate DB and connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate blog post object
    $category = new Category($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    // Set id to delete
    $category->category_id = $data->category_id;

    // delete post
    if ($category->delete()) {
        echo json_encode(
            array('message' => 'category deleted')
        );
    } else {
        echo json_encode(
            array('message' => 'category Not deleted')
        );
    }
?>
