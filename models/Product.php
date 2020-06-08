<?php

class Product {
//define properties
public $name;
public $description;
public $id;
public $price;
public $categories;
public $category_id;
private $conn;

private $table_name;

public function __construct($db)
{
    $this->conn=$db;
    $this->table_name="product";

}
public function create_product()
{
    $product_query= "INSERT INTO product (name, description,price) VALUES ( '" . $this->name . "', '" . $this->description . "', '" . $this->price . "')";
    $product_obj = $this->conn->prepare($product_query);
    
   if( $product_obj->execute())
    {
        $product_id = $this->conn->lastInsertId();;
        foreach($this->categories as $value)
        {
            $product_category_query= "INSERT INTO product_category (product_id, category_id) VALUES ( " . $product_id . ", " . $value . ")";
            $product_category_obj = $this->conn->prepare($product_category_query);
            $product_category_obj->execute();
        }
        return true;
    }
    return false;
    
    
}
public function update_product()
{
    $query= "Update product  Set name= '" . $this->name . "', description= '" . $this->description . "' , price= '" . $this->price . "' where id=". $this->id ."";
    $obj = $this->conn->prepare($query);
    
    if($obj->execute())
    {
        $delete_product_category_query= "Delete from product_category where product_id=". $this->id ."";
        $delete_obj = $this->conn->prepare($delete_product_category_query);
      
        $delete_obj->execute();
        foreach($this->categories as $value)
        {
            $product_category_query= "INSERT INTO product_category (product_id, category_id) VALUES ( " . $this->id . ", " . $value . ")";
            $product_category_obj = $this->conn->prepare($product_category_query);
            $product_category_obj->execute();
        }
        return true;


    }
    else
    return false;
}
public function delete_product()
{
    $delete_product_category_query= "Delete from product_category where product_id=". $this->id ."";
    $delete_obj = $this->conn->prepare($delete_product_category_query);
      
    if($delete_obj->execute())
    {
      //  return true;
      $query= "Delete from product where id=". $this->id ."";
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
public function get_product()
{
  $query= "SELECT * FROM ". $this->table_name ." where id=". $this->id ." ";
  $product_obj = $this->conn->prepare($query);
  if($product_obj->execute()){
    $category_query = "select id from category where id in (select category_id from product_category where product_id=". $this->id .")";
    $category_obj = $this->conn->prepare($category_query);
    $category_obj->execute();
 //   $data_category = $category_obj->fetch();
    $objects = array();
    while ($object = $category_obj->fetch(PDO::FETCH_OBJ)) {
        $objects[] = $object;
    }
    $data = $product_obj->fetch();
    $result = array(
        "id"=>$data["id"],
        "name"=> $data["name"],
        "description"=> $data["description"],
        "price"=> $data["price"],
        "categories"=> $objects
    );
    return $result;
 }

 return array();
}


public function check_product()
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

  public function get_products_list()
  {
    $query= "SELECT * FROM ". $this->table_name ." ";
    $product_obj = $this->conn->prepare($query);
    $product_obj->execute();
    $objects = array();
    while ($object = $product_obj->fetch(PDO::FETCH_OBJ)) {

        $objects[] = $object;
    }
    
    return $objects;
  }
  public function get_products_list_category()
  {
    //$query= "SELECT * FROM ". $this->table_name ."where id in (select product_id from product_category where category_id=" .$this->category_id .")";
    $query="SELECT * FROM product where id in (select product_id from product_category WHERE category_id=".$this->category_id.")";
    $product_obj = $this->conn->prepare($query);
    $product_obj->execute();
    $objects = array();
    while ($object = $product_obj->fetch(PDO::FETCH_OBJ)) {

        $objects[] = $object;
    }
    
    return $objects;
  }

}



?>