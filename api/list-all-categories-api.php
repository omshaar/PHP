<?php

ini_set("display_errors", 1);
header("Access-Control-Allow-Orgin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

//including files
include_once("../db_operations/DatabaseService.php");
include_once("../models/Category.php");

//objects
$db =  new DatabaseService();

$connection = $db->getConnection();

$category_obj = new Category($connection);
if($_SERVER['REQUEST_METHOD'] === "GET"){

    $categories = $category_obj->get_Categries_list();

    if(count($categories) > 0){

     // $projects_arr = array();

     
       http_response_code(200); // Ok
       echo json_encode(array(
         "status" => 1,
         "Categories" => $categories
       ));

    }else{
       http_response_code(404); // no data found
       echo json_encode(array(
         "status" => 0,
         "message" => "No Category found"
       ));

    }
}

 ?>
