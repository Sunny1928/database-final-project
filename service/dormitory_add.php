<?php 
    session_start();
    require_once('./connect_db.php');
    $conn = connect_db();
    
    $name = $_POST["name"];

    $sql= "INSERT INTO Dormitory (`name`) VALUE(?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s",$name);
    $stmt->execute();
    mysqli_stmt_close($stmt);

    header('Location: ../backstage_main.php#pills-dormitory')
?>