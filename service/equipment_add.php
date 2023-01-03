<?php 
    session_start();
    require_once('./connect_db.php');
    $conn = connect_db();
    
    $name = $_POST["name"];
    $expired_year = $_POST["expired_year"];
    $state = $_POST["state"];
    $room_number = $_POST["room_number"];
    $account = $_POST["account"];

    // echo $name;
    // echo $expired_year;
    // echo $state;
    // echo $room_number;
    // echo $account;

    $sql= "INSERT INTO equipment (`name`, expired_year, `state`, room_number, account) VALUE(?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisis",$name,$expired_year,$state,$room_number,$account);
    $stmt->execute();
    mysqli_stmt_close($stmt);

    header('Location: ../backstage_main.php#pills-equipment')
?>