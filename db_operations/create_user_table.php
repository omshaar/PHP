<?php
	
	include_once 'DatabaseService.php';
	$databaseService = new DatabaseService();
		$conn = $databaseService->getConnection();
		$query = "SHOW TABLES LIKE 'user'";
		$stmt = $conn->prepare( $query );
		$stmt->execute();
		$num = $stmt->rowCount();
		
	
		if($num > 0) {
			echo "'user' table already exists!<br/>";
		
		} else {
			$query = "CREATE TABLE user ( id int(11) NOT NULL auto_increment, 
			username varchar(20) NOT NULL,
			password varchar(100) NOT NULL,
			email varchar(100) NOT Null,
			first_name varchar(50) NOT Null,
			last_name varchar(50) NOT Null,
			PRIMARY KEY (id),
			UNIQUE KEY username (username))";
			
			$stmt = $conn->prepare( $query );
			
			if($stmt->execute()){
	
				http_response_code(200);
				echo json_encode(array("message" => "user table created!<br/> Inserting admin user now."));
			}
			
	
			$username = "admin";
			$password = "password";
			$email= "admin@example.com";
			$firstName="Admin";
			$lastName="Admin";
			$password = password_hash($password,PASSWORD_DEFAULT);
			$query="INSERT INTO user (username, password,email,first_name,last_name) VALUES ( '" . $username . "', '" . $password . "', '" . $email . "', '" . $firstName . "', '" . $lastName . "')";
			$stmt = $conn->prepare( $query );
			
			if($stmt->execute()){
	
				http_response_code(200);
				echo json_encode(array("message" => "admin user added successfully."));
			}
		
		}


?>