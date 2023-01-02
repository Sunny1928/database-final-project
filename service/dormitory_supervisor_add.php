<?php
	require_once('./connect_db.php');
	$conn = connect_db();
	
	$_POST['password'] = password_hash($_POST["password"] ,PASSWORD_DEFAULT);

	$sql = "INSERT INTO User (name, password, email, phone, account, type) VALUES (?, ?, ?, ?, ?, ?)";
	$type = 'dormitory_supervisor';
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('sssiss' ,$_POST['name'] , $_POST['password'] , $_POST['email'] , $_POST['phone'] , $_POST['account'] , $type);
	$stmt->execute();
	
	$sql = "INSERT INTO Dormitory_Supervisor (account , dormitory_id) VALUES(?,?)";
	$stmt = $conn->prepare($sql);		
	$stmt->bind_param('si' , $_POST['account'] , $_POST['dormitory_id']);
	$stmt->execute();	

	
    header('Location: ../backstage_main.php#pills-dormitory-supervisor')
?>







