<?php 
    session_start();
    require_once('./connect_db.php');
    $conn = connect_db();

    
    $semester = $_POST["semester"];
    $academic_year = $_POST["academic_year"];
    $student_account = $_POST["student_account"];
    $system_manager_account = $_POST["system_manager_account"];
    $room_number = $_POST["room_number"];
    $account = $_SESSION["account"];


    $sql= "INSERT INTO live_in (semester, `academic_year`, `student_account`, system_manager_account, room_number) VALUE(?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iissi",$semester,$academic_year,$student_account,$system_manager_account, $room_number);
    $stmt->execute();
    mysqli_stmt_close($stmt);

    if($account=='root'){
        header('Location: ../backstage_main.php#pills-live-in');
    }
    else{
        header('Location: ../main.php#pills-live-in');
    }
?>