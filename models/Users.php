<?php

class Users {
//define properties
public $username;
public $password;
public $first_name;
public $last_name;
public $email;
public $id;
private $conn;

private $table_name;

public function __construct($db)
{
    $this->conn=$db;
    $this->table_name="user";

}
public function create_user()
{
    $user_query= "INSERT INTO user (username, password,email,first_name,last_name) VALUES ( '" . $this->username . "', '" . $this->password . "', '" . $this->email . "', '" . $this->first_name . "', '" . $this->last_name . "')";
    $user_obj = $this->conn->prepare($user_query);
    //$user_obj->bind_param("sssss", $this->username , $this->email ,$this->password ,$this->first_name , $this->last_name);
    //$user_obj->bindParam(':username', $this->username);
    //$user_obj->bindParam(':email', $this->email);
    //$user_obj->bindParam(':password', $this->password);
    //$user_obj->bindParam(':first_name', $this->first_name);
    //$user_obj->bindParam(':last_name', $this->last_name);
    if($user_obj->execute())
    {
        return true;

    }
    else
    return false;
}
public function check_username()
{
    $user_query= "SELECT * FROM ". $this->table_name ." WHERE username = '" . $this->username . "'";
    $user_obj = $this->conn->prepare($user_query);
    if($user_obj->execute())
    {
        $num = $user_obj->rowCount();
       if($num>0)
       return true;

    }
    else
    return false;
}

public function check_login(){

    $email_query = "SELECT * from ".$this->table_name." WHERE username = '". $this->username ."'";

    $usr_obj = $this->conn->prepare($email_query);

  //  $usr_obj->bind_param("s", $this->username);

    if($usr_obj->execute()){

       $data = $usr_obj->fetch();

       return $data;
    }

    return array();
  }

}



?>