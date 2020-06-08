<?php

ini_set("display_errors",1);
//including files
include_once("../db_operations/DatabaseService.php");
include_once("../models/Users.php");
require_once 'api.php';
// objects


class AccountController extends API
    {
        protected function account() {
            $db =  new DatabaseService();
$connection = $db->getConnection();
$users_obj = new Users($connection);
            if($_SERVER['REQUEST_METHOD']=== "POST")
            {
            
                $data = json_decode(file_get_contents("php://input"));
                if(empty($data->last_name))
                {
                    http_response_code(500);
                    echo json_encode(array(
                        "status"=> 0,
                        "message"=> "first empty"
                    ));
                }else
                if(!empty($data->username) && !empty($data->password) && !empty($data->email) && !empty($data->first_name) && !empty($data->last_name) )
                {
                $users_obj->username = $data->username;
                $users_obj->password =  password_hash($data->password,PASSWORD_DEFAULT);
                $users_obj->email = $data->email;
                $users_obj->first_name = $data->first_name;
                $users_obj->last_name = $data->last_name;
               // $username_data = $user_obj->check_username();
                if($users_obj->check_username())
                {
                    http_response_code(500);
                       echo json_encode(array(
                           "status"=> 0,
                           "message"=> "User already exists try another username"
                       ));
            
                }else{
                    if($users_obj->create_user()){
                        http_response_code(200);
                        echo json_encode(array(
                           "status"=> 1,
                           "message"=> "user has been created"
                       ));
                   }else{
                       http_response_code(500);
                       echo json_encode(array(
                           "status"=> 0,
                           "message"=> "faild to create user"
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
        }
        protected function login() {
            http_response_code(200);
            echo json_encode(array(
                "status"=> 1,
                "message"=> "you loged in"
            ));
            
        }
    }

?>