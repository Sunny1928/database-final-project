<?php 
    session_start();
    require_once('./connect_db.php');
    $conn = connect_db();
    
    $room_number = $_POST["room_number"];
    $num_of_people = $_POST["num_of_people"];
    $fee = $_POST["fee"];
    $dormitory_id = $_POST["dormitory_id"];

    $sql= "INSERT INTO room (`room_number`, `num_of_people`, `fee`, `dormitory_id`) VALUE(?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiii",$room_number, $num_of_people, $fee, $dormitory_id);
    $stmt->execute();
    mysqli_stmt_close($stmt);

    header('Location: ../backstage_main.php#pills-room')
?>