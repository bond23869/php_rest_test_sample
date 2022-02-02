<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include('../../config/Database.php');
include('../../models/Category.php');

$database = new Database();
$db = $database->connect();

$category = new Category($db);

$result = $category->read();

if(($result->rowCount()) > 0){
    $category_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $category_item = [
            'id' => $id,
            'name' => $name,
            'created_at' => $created_at
        ];

        array_push($category_arr,$category_item);
    }
    echo json_encode($category_arr);

} else{
    echo json_encode(array('message' => 'No categories were found'));
}




