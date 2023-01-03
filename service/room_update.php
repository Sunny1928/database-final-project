<?php 
    require_once('./connect_db.php');
    $conn = connect_db();
    
    $room_number = $_POST["room_number"];
    $num_of_people = $_POST["num_of_people"];
    $fee = $_POST["fee"];
    $dormitory_id = $_POST["dormitory_id"];
    
    $sql= "UPDATE Room SET `num_of_people` = '$num_of_people', `fee` = '$fee', `dormitory_id` = '$dormitory_id' WHERE room_number = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i",$room_number);
    $stmt->execute();
    mysqli_stmt_close($stmt);

    header('Location: ../backstage_main.php#pills-room')
?>