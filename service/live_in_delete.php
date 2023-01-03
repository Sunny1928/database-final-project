<?php
    session_start();
    require_once('./connect_db.php');
    $conn = connect_db();
    
    $semester = $_GET["semester"];
    $academic_year = $_GET["academic_year"];
    $student_account = $_GET["student_account"];
    $room_number = $_GET["room_number"];
    $account = $_SESSION["account"];

    echo $academic_year. ' ';
    echo $semester. ' ';
    echo $student_account. ' ';
    echo $room_number. ' ';

    $sql = "DELETE FROM live_in WHERE room_number=? AND academic_year = ? AND semester = ? AND student_account= ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiis", $room_number, $academic_year, $semester, $student_account);   
    $stmt->execute();
    mysqli_stmt_close($stmt);

    if($account=='root'){
        header('Location: ../backstage_main.php#pills-live-in');
    }
    else{
        header('Location: ../main.php#pills-live-in');
    }
?> 