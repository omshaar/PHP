<?php

include_once 'DatabaseService.php';
$databaseService = new DatabaseService();
	$conn = $databaseService->getConnection();
	$query = "SHOW TABLES LIKE 'category";
	$stmt = $conn->prepare( $query );
	$stmt->execute();
	$num = $stmt->rowCount();
	echo $num;

	if($num > 0) {
		echo "'category' table already exists!<br/>";
	
	} else {
		$query = "CREATE TABLE category ( id int(11) NOT NULL auto_increment, name varchar(20) NOT NULL,description varchar(100) Null,PRIMARY KEY (id))";
		
		$stmt = $conn->prepare( $query );
		
		if($stmt->execute()){

			http_response_code(200);
			echo json_encode(array("message" => "category table created!<br/> Inserting tow sample of category."));
		}
		


		$query="INSERT INTO category (name) VALUES ( 'Category A')";
		$stmt = $conn->prepare( $query );
		
		if($stmt->execute()){

			http_response_code(200);
			echo json_encode(array("message" => "category added successfully."));
		}
		$query="INSERT INTO category (name) VALUES ( 'Category B')";
		$stmt = $conn->prepare( $query );
		
		if($stmt->execute()){

			http_response_code(200);
			echo json_encode(array("message" => "category added successfully."));
		}
	}

	

?>