<?php

include_once 'DatabaseService.php';
$databaseService = new DatabaseService();
	$conn = $databaseService->getConnection();
	$query = "SHOW TABLES LIKE 'product_category";
	$stmt = $conn->prepare( $query );
	$stmt->execute();
	$num = $stmt->rowCount();
	echo $num;

	if($num > 0) {
		echo "'product_category' table already exists!<br/>";
	
	} else {
		$query = "CREATE TABLE product_category ( id int(11) NOT NULL auto_increment, product_id int(11) NOT NULL,category_id int(11) Null,PRIMARY KEY (id))";
		
		$stmt = $conn->prepare( $query );
		
		if($stmt->execute()){

			http_response_code(200);
			echo json_encode(array("message" => "product_category table created!<br/> Inserting tow sample of category."));
		}
		


		$query="INSERT INTO product_category (product_id,category_id) VALUES ( 1,1)";
		$stmt = $conn->prepare( $query );
		
		if($stmt->execute()){

			http_response_code(200);
			echo json_encode(array("message" => "product_category added successfully."));
		}
		$query="INSERT INTO product_category (product_id,category_id) VALUES ( 1,2)";
		$stmt = $conn->prepare( $query );
		
		if($stmt->execute()){

			http_response_code(200);
			echo json_encode(array("message" => "product_category added successfully."));
		}
	}

	

?>