<?php
ini_set("display_errors",1);
require '../vendor/autoload.php';
use \Firebase\JWT\JWT;
ini_set("display_errors",1);
//include headers
header("Access-Control-Allow-Orgin: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: application/json");

//including files
include_once("../db_operations/DatabaseService.php");
include_once("../models/Product.php");
// objects

$db =  new DatabaseService();
$connection = $db->getConnection();
$product_obj = new Product($connection);
$filter= $_GET["filter"];
if(!empty($filter))
{
    $product_obj->category_id= $filter;
    $producs = $product_obj->get_products_list_category();
}

else
$producs = $product_obj->get_products_list();

if(count($producs) > 0){

 // $projects_arr = array();

 
   http_response_code(200); // Ok
   echo json_encode(array(
    "status" => 1,
    "data"=> $producs
   ));

}else{
   http_response_code(200); // no data found
   echo json_encode(array(
     "status" => 1,
     "message" => "No product found",
     "date"=>  $producs,
   ));

}





?>