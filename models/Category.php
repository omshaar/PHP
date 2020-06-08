<?php

class Category {
//define properties
public $name;
public $description;
public $id;
private $conn;

private $table_name;

public function __construct($db)
{
    $this->conn=$db;
    $this->table_name="category";

}
public function create_category()
{
    $user_query= "INSERT INTO category (name, description) VALUES ( '" . $this->name . "', '" . $this->description . "')";
    $user_obj = $this->conn->prepare($user_query);
    
    if($user_obj->execute())
    {
        return true;

    }
    else
    return false;
}
public function update_category()
{
    $query= "Update category  Set name= '" . $this->name . "', description= '" . $this->description . "' where id=". $this->id ."";
    $obj = $this->conn->prepare($query);
    
    if($obj->execute())
    {
        return true;

    }
    else
    return false;
}
public function delete_category()
{
    $delete_product_category_query= "Delete from product_category where category_id=". $this->id ."";
    $delete_obj = $this->conn->prepare($delete_product_category_query);
      
    if($delete_obj->execute())
    {
      //  return true;
      $query= "Delete from category where id=". $this->id ."";
      $obj = $this->conn->prepare($query);
      
      if($obj->execute())
      {
          return true;
  
      }
      else
      return false;
    }
    
    else
    return false;
}
public function get_Category()
{
  $query= "SELECT * FROM ". $this->table_name ." where id=". $this->id ." ";
  $category_obj = $this->conn->prepare($query);
  if($category_obj->execute()){

    $data = $category_obj->fetch();

    return $data;
 }

 return array();
}


public function check_category()
{
    $query= "SELECT * FROM ". $this->table_name ." WHERE name = '" . $this->name . "'";
    $obj = $this->conn->prepare($query);
    if($obj->execute())
    {
        $num = $obj->rowCount();
       if($num>0)
       return true;

    }
    else
    return false;
}

  public function get_Categries_list()
  {
    $query= "SELECT * FROM ". $this->table_name ." ";
    $category_obj = $this->conn->prepare($query);
    $category_obj->execute();
    $objects = array();
    while ($object = $category_obj->fetch(PDO::FETCH_OBJ)) {
        $objects[] = $object;
    }
    return $objects;
  }


}



?>