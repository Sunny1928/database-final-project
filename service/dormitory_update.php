<?php 
    require_once('./connect_db.php');
    $conn = connect_db();
    
    $name = $_POST["name"];
    $dormitory_id = $_POST["dormitory_id"];
    
    $sql= "UPDATE Dormitory SET `name` = '$name' WHERE dormitory_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i",$dormitory_id);
    $stmt->execute();
    mysqli_stmt_close($stmt);

    header('Location: ../backstage_main.php#pills-dormitory')
?>