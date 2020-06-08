<?php
ini_set("display_errors",1);
//include headers
header("Access-Control-Allow-Orgin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

//including files
include_once("../db_operations/DatabaseService.php");
include_once("../models/Product.php");
// objects

$db =  new DatabaseService();
$connection = $db->getConnection();
$product_obj = new Product($connection);
if($_SERVER['REQUEST_METHOD']=== "POST")
{

    $data = json_decode(file_get_contents("php://input"));
  
    if(!empty($data->name) && !empty($data->price) && count($data->categories)>0)
    {
    $product_obj->name = $data->name;
    $product_obj->description =  $data->description;
    $product_obj->price =  $data->price;
    $product_obj->categories =  $data->categories;


    if($product_obj->check_product())
    {
        http_response_code(500);
           echo json_encode(array(
               "status"=> 0,
               "message"=> "product already exists try another name"
           ));

    }else{
        if($product_obj->create_product()){
            http_response_code(200);
            echo json_encode(array(
               "status"=> 1,
               "message"=> "product has been created"
           ));
       }else{
           http_response_code(500);
           echo json_encode(array(
               "status"=> 0,
               "message"=> "faild to create product"
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