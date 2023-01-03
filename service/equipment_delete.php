<?php
    session_start();
    require_once('./connect_db.php');
    $conn = connect_db();
    
    $equipment_id = $_GET["equipment_id"];

    $sql = "DELETE FROM equipment WHERE equipment_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i",$equipment_id);
    $stmt->execute();
    mysqli_stmt_close($stmt);

    header('Location: ../backstage_main.php#pills-equipment')
?> 