<?php

include_once 'DatabaseService.php';
$databaseService = new DatabaseService();
	$conn = $databaseService->getConnection();
	$query = "SHOW TABLES LIKE 'product";
	$stmt = $conn->prepare( $query );
	$stmt->execute();
	$num = $stmt->rowCount();
	echo $num;

	if($num > 0) {
		echo "'product' table already exists!<br/>";
	
	} else {
		$query = "CREATE TABLE product ( id int(11) NOT NULL auto_increment, name varchar(20) NOT NULL,price DECIMAL(10,2) NOT NULL,description varchar(100) Null,PRIMARY KEY (id))";
		
		$stmt = $conn->prepare( $query );
		
		if($stmt->execute()){

			http_response_code(200);
			echo json_encode(array("message" => "product table created!<br/> Inserting one sample product."));
		}
		


		$query="INSERT INTO product (name, price) VALUES ( 'Item A', '5.99')";
		$stmt = $conn->prepare( $query );
		
		if($stmt->execute()){

			http_response_code(200);
			echo json_encode(array("message" => "product added successfully."));
		}
	
	}

	

?>