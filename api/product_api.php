<?php
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
$method=$_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents("php://input"));
switch($method) {

    case 'POST':
        if(!empty($input->id))
        getProduct();
       
        else
        addProduct();
        break;

    case 'PUT':
        updateProduct();
        break;
    case 'DELETE':
        deleteProduct();
        break;
    case 'GET':
        getAllProducts();
        break;

    default:
        echo 'Hey! You just got 404\'D. Did you just come up with that url by your own?';
        return header("HTTP/1.1 404 Not Found");
}



function addProduct()
{
    $db =  new DatabaseService();
$connection = $db->getConnection();
$product_obj = new Product($connection);

$data = json_decode(file_get_contents("php://input"));
$isAuthorized = checkAuthorization();
if($isAuthorized )
{
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
}
else
{
    http_response_code(401); // not Authorized
    echo json_encode(array(
      "status" => 0,
      "message" => "you are not authorized"
    ));
}

}
function updateProduct()
{
    $db =  new DatabaseService();
    $connection = $db->getConnection();
    $product_obj = new Product($connection);

    $data = json_decode(file_get_contents("php://input"));
    $isAuthorized = checkAuthorization();
    if($isAuthorized )
    {
    if(!empty($data->name) && !empty($data->id) && !empty($data->price) && count($data->categories)>0)
    {
    $product_obj->name = $data->name;
    $product_obj->description =  $data->description;
    $product_obj->id =  $data->id;
    $product_obj->price =  $data->price;
    $product_obj->categories =  $data->categories;
  //  if($category_obj->check_product())
   // {
    //    http_response_code(500);
     //      echo json_encode(array(
     //          "status"=> 0,
     //          "message"=> "Product already exists try another name"
      //     ));

    //}else
    {
        if($product_obj->update_product()){
            http_response_code(200);
            echo json_encode(array(
               "status"=> 1,
               "message"=> "product has been updated"
           ));
       }else{
           http_response_code(500);
           echo json_encode(array(
               "status"=> 0,
               "message"=> "faild to update product"
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
}
else
{
    http_response_code(401); // not Authorized
    echo json_encode(array(
      "status" => 0,
      "message" => "you are not authorized"
    ));
}

}
function deleteProduct()
{
    $db =  new DatabaseService();
    $connection = $db->getConnection();
    $product_obj = new Product($connection);
    $data = json_decode(file_get_contents("php://input"));
    $isAuthorized = checkAuthorization();
    if($isAuthorized ){
    if(!empty($data->id))
    {

    $product_obj->id =  $data->id;

    {
        if($product_obj->delete_product()){
            http_response_code(200);
            echo json_encode(array(
               "status"=> 1,
               "message"=> "product has been deleted"
           ));
       }else{
           http_response_code(500);
           echo json_encode(array(
               "status"=> 0,
               "message"=> "faild to delete product"
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
    
}
else
{
    http_response_code(401); // not Authorized
    echo json_encode(array(
      "status" => 0,
      "message" => "you are not authorized"
    ));
}

}
function getAllProducts()
{
    $db =  new DatabaseService();
    $connection = $db->getConnection();
    $product_obj = new Product($connection);
 
    $producs = $product_obj->get_products_list();
  
    if(count($producs) > 0){

     // $projects_arr = array();

     
       http_response_code(200); // Ok
       echo json_encode(array(
        "status" => 0,
        "data"=> $producs
       ));

    }else{
       http_response_code(404); // no data found
       echo json_encode(array(
         "status" => 0,
         "message" => "No product found"
       ));

    }

}
function getFiltered()
{
    $db =  new DatabaseService();
    $connection = $db->getConnection();
    $product_obj = new Product($connection);
    $data = json_decode(file_get_contents("php://input"));
    if(!empty($data->category_id))
    {
        $product_obj->category_id = $data->category_id;
        $producs = $product_obj->get_products_list_category();
  
        if(count($producs) > 0){
    
           http_response_code(200); // Ok
           echo json_encode(array(
            "status" => 0,
            "data"=> $producs
           ));
    
        }else{
           http_response_code(404); // no data found
           echo json_encode(array(
             "status" => 0,
             "message" => "No product found"
           ));
    
        }
    }

}

function getProduct()
{
    $db =  new DatabaseService();
    $connection = $db->getConnection();
    $product_obj = new Product($connection);
    $data = json_decode(file_get_contents("php://input"));
 
$isAuthorized = checkAuthorization();
if($isAuthorized ){
    
   
   if(!empty($data->id)){

        $product_obj->id = $data->id;
        //$user_obj->password = $data->password;

        $category_data = $product_obj->get_product();

        if(!empty($category_data)){
            $result = array(
                "id" => $category_data['id'],
                "name" => $category_data['name'],
                "description" =>$category_data['description'],
                "price"=> $category_data['price'],
                "categories"=> $category_data['categories'],
            );
            http_response_code(200); // Ok
            echo json_encode(array(
              "status" => 1,
              "Product" => $result
            ));
        }
        else
        {
            http_response_code(404); // no data found
            echo json_encode(array(
              "status" => 0,
              "message" => "No Product found"
            ));
        }
     }
    }
    else
    {
        http_response_code(401); // not Authorized
        echo json_encode(array(
          "status" => 0,
          "message" => "you are not authorized"
        ));
    }

}

function checkAuthorization()
{
    $all_headers = getallheaders();

    $jwt = $all_headers['Authorization'];
 
    if(!empty($jwt)){
 
       try{
 
         $secret_key = "owt125";
 
         $decoded_data = JWT::decode($jwt, $secret_key, array('HS512'));
 
         http_response_code(200);
 
         $user_id = $decoded_data->data->id;
 
         return true;
       }catch(Exception $ex){
 
      return false;
       }
 
    }
    return false;
}


?>