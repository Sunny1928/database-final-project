<?php
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        require_once('./connect_db.php');
    	$conn = connect_db();
		
		$_POST['password'] = password_hash($_POST["password"] ,PASSWORD_DEFAULT);

		$sql = "INSERT INTO User (name, password, email, phone, account, type) VALUES (?, ?, ?, ?, ?, ?)";

		$type = 'student';
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('sssiss' ,$_POST['name'] , $_POST['password'] , $_POST['email'] , $_POST['phone'] , $_POST['account'] , $type);
		$stmt->execute();	
		
		/*
		 * new student
		 */
		$sql = "INSERT INTO Student (academic_year , student_id ,major_year , gender , account) VALUES(?, ?, ?, ?, ?)";
		$stmt = $conn->prepare($sql);		
		$stmt->bind_param('isiss' ,$_POST['academic_year'] , $_POST['student_id'] , $_POST['major_year'] , $_POST['gender'] , $_POST['account']);
		$stmt->execute();	
		
		header("Location: ../backstage_main.php");
        die();
	}
?>