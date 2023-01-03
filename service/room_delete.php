<?php
    session_start();
    require_once('./connect_db.php');
    $conn = connect_db();

    $room_number = $_GET["room_number"];

    $sql = "DELETE FROM room WHERE room_number = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i",$room_number);
    $stmt->execute();
    mysqli_stmt_close($stmt);

    header('Location: ../backstage_main.php#pills-room')
?> 