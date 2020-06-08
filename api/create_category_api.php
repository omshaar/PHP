<?php
ini_set("display_errors",1);
//include headers
header("Access-Control-Allow-Orgin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

//including files
include_once("../db_operations/DatabaseService.php");
include_once("../models/Category.php");
// objects

$db =  new DatabaseService();
$connection = $db->getConnection();
$category_obj = new Category($connection);
if($_SERVER['REQUEST_METHOD']=== "POST")
{

    $data = json_decode(file_get_contents("php://input"));
  
    if(!empty($data->name))
    {
    $category_obj->name = $data->name;
    $category_obj->description =  $data->description;

    if($category_obj->check_category())
    {
        http_response_code(500);
           echo json_encode(array(
               "status"=> 0,
               "message"=> "Category already exists try another name"
           ));

    }else{
        if($category_obj->create_category()){
            http_response_code(200);
            echo json_encode(array(
               "status"=> 1,
               "message"=> "category has been created"
           ));
       }else{
           http_response_code(500);
           echo json_encode(array(
               "status"=> 0,
               "message"=> "faild to create category"
           ));
       }
    }

        
    }else{
        http_response_code(500);
        echo json_encode(array(
            "status"=> 0,
            "message"=> "all data needed"
        ));
    }

}else{
    http_response_code(503);
    echo json_encode(array(
        "status"=> 0,
        "message"=> "Access Denied"
    ));
    

}

?>