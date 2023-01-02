<?php
	require_once('./connect_db.php');
	$conn = connect_db();
	
	$_POST['password'] = password_hash($_POST["password"] ,PASSWORD_DEFAULT);

	$sql = "INSERT INTO User (name, password, email, phone, account, type) VALUES (?, ?, ?, ?, ?, ?)";
	$type = 'system_manager';
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('sssiss' ,$_POST['name'] , $_POST['password'] , $_POST['email'] , $_POST['phone'] , $_POST['account'] , $type);
	$stmt->execute();	
	
	$sql = "INSERT INTO System_Manager (account) VALUES(?)";
	$stmt = $conn->prepare($sql);		
	$stmt->bind_param('s' , $_POST['account']);
	$stmt->execute();	
	
	header("Location: ../backstage_main.php#pills-system-manager");
?>

