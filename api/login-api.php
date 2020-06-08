<?php
ini_set("display_errors", 1);
// include vendor
require '../vendor/autoload.php';
use \Firebase\JWT\JWT;

//include headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-type: application/json; charset=utf-8");

// including files
include_once("../db_operations/DatabaseService.php");
include_once("../models/Users.php");
//objects
$db =  new DatabaseService();

$connection = $db->getConnection();

$user_obj = new Users($connection);

if($_SERVER['REQUEST_METHOD'] === "POST"){

   $data = json_decode(file_get_contents("php://input"));

   if(!empty($data->username) && !empty($data->password)){

        $user_obj->username = $data->username;
        //$user_obj->password = $data->password;

        $user_data = $user_obj->check_login();

        if(!empty($user_data)){

            $username = $user_data['username'];
            $email = $user_data['email'];
            $first_name = $user_data['first_name'];
            $last_name = $user_data['last_name'];
            $password = $user_data['password'];

            if(password_verify($data->password, $password)){ // normal password, hashed password

              $iss = "localhost";
              $iat = time();
              $nbf = $iat + 1;
              $exp = $iat + 3600;
              $aud = "users";
              $user_arr_data = array(
                "id" => $user_data['id'],
                "username" => $user_data['username'],
                "email" => $user_data['email'],
                "first_name"=> $user_data['first_name'],
                "last_name" => $user_data['last_name']
              );

              $secret_key = "owt125";

              $payload_info = array(
                "iss"=> $iss,
                "iat"=> $iat,
                "nbf"=> $nbf,
                "exp"=> $exp,
                "aud"=> $aud,
                "data"=> $user_arr_data
              );

              $jwt = JWT::encode($payload_info, $secret_key, 'HS512');
            session_start();
            $_SESSION["token"] = $jwt;
            
              http_response_code(200);
              echo json_encode(array(
                "status" => 1,
                "token" => $jwt,
                "message" => "User logged in successfully"
              ));
            }else{

              http_response_code(404);
              echo json_encode(array(
                "status" => 0,
                "message" => "Invalid credentials"
              ));
            }
        }else{

          http_response_code(404);
          echo json_encode(array(
            "status" => 0,
            "message" => "Invalid credentials"
          ));
        }
   }else{

     http_response_code(404);
     echo json_encode(array(
       "status" => 0,
       "message" => "All data needed"
     ));
   }
}
