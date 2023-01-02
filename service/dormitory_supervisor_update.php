<?php
    require_once('./connect_db.php');
    $conn = connect_db();

    $account =$_POST["account"];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $dormitory_id = $_POST['dormitory_id'];

    $sql = "UPDATE  User SET `name` = '$name', email = '$email', phone = '$phone' WHERE account = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s',$account);
    $stmt->execute();

    // echo $_POST['account'].' ';
	// echo $_POST['name'].' ';
	// echo $_POST['email'].' ';
	// echo $_POST['phone'].' ';
	// echo $_POST['dormitory_id'].' ';

    $sql = "UPDATE  Dormitory_Supervisor SET dormitory_id = '$dormitory_id' WHERE account = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s',$account);
    $stmt->execute();
    
    header('Location: ../backstage_main.php#pills-dormitory-supervisor')
?>