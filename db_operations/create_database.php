<?php
	include_once 'DatabaseService.php';
	$databaseService = new DatabaseService();
	$conn = $databaseService->getConnection();

	$query = "CREATE DATABASE";
	$stmt = $conn->prepare($query);

	if($stmt->execute()){

		http_response_code(200);
		echo json_encode(array("message" => "Database successfully created."));
	}
	else{
		http_response_code(400);
	
		echo json_encode(array("message" => "Unable to create database."));
	}


	

?>