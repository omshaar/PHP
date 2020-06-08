<?php
ini_set("display_errors",1);
//include headers
header("Access-Control-Allow-Orgin: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: application/json");

//including files
include_once("../db_operations/DatabaseService.php");
include_once("../models/Category.php");
// objects
$method=$_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents("php://input"));
switch($method) {

    case 'POST':
        if(!empty($input->id))
        getCategory();
        else
        addCategory();
        break;

    case 'PUT':
        updateCategory();
        break;
    case 'DELETE':
        deleteCategory();
        break;
    case 'GET':
        getAllCategories();
        break;

    default:
        echo 'Hey! You just got 404\'D. Did you just come up with that url by your own?';
        return header("HTTP/1.1 404 Not Found");
}



function addCategory()
{
    $db =  new DatabaseService();
    $connection = $db->getConnection();
    $category_obj = new Category($connection);

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

}
function updateCategory()
{
    $db =  new DatabaseService();
    $connection = $db->getConnection();
    $category_obj = new Category($connection);

    $data = json_decode(file_get_contents("php://input"));
  
    if(!empty($data->name) && !empty($data->id))
    {
    $category_obj->name = $data->name;
    $category_obj->description =  $data->description;
    $category_obj->id =  $data->id;
    
    {
        if($category_obj->update_category()){
            http_response_code(200);
            echo json_encode(array(
               "status"=> 1,
               "message"=> "category has been updated"
           ));
       }else{
           http_response_code(500);
           echo json_encode(array(
               "status"=> 0,
               "message"=> "faild to update category"
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
function deleteCategory()
{
    $db =  new DatabaseService();
    $connection = $db->getConnection();
    $category_obj = new Category($connection);
    $data = json_decode(file_get_contents("php://input"));
  
    if(!empty($data->id))
    {

    $category_obj->id =  $data->id;

    {
        if($category_obj->delete_category()){
            http_response_code(200);
            echo json_encode(array(
               "status"=> 1,
               "message"=> "category has been deleted"
           ));
       }else{
           http_response_code(500);
           echo json_encode(array(
               "status"=> 0,
               "message"=> "faild to delete category"
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
function getAllCategories()
{
    $db =  new DatabaseService();
    $connection = $db->getConnection();
    $category_obj = new Category($connection);
    $categories = $category_obj->get_Categries_list();

    if(count($categories) > 0){

     // $projects_arr = array();

     
       http_response_code(200); // Ok
       echo json_encode(array(
         "status" => 1,
         "data"=> $categories
       ));

    }else{
       http_response_code(404); // no data found
       echo json_encode(array(
         "status" => 0,
         "message" => "No Category found"
       ));

    }
}

function getCategory()
{
    $db =  new DatabaseService();
    $connection = $db->getConnection();
    $category_obj = new Category($connection);
    $data = json_decode(file_get_contents("php://input"));
  

   if(!empty($data->id)){

        $category_obj->id = $data->id;
        //$user_obj->password = $data->password;

        $category_data = $category_obj->get_Category();

        if(!empty($category_data)){
            $result = array(
                "id" => $category_data['id'],
                "name" => $category_data['name'],
                "description" =>$category_data['description']
            );
            http_response_code(200); // Ok
            echo json_encode(array(
              "status" => 1,
              "Category" => $result
            ));
        }
        else
        {
            http_response_code(404); // no data found
            echo json_encode(array(
              "status" => 0,
              "message" => "No Category found"
            ));
        }
}
}


?>