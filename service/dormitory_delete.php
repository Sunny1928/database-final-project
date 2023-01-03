<?php
    session_start();
    require_once('./connect_db.php');
    $conn = connect_db();

    $dormitory_id = $_GET["dormitory_id"];

    $sql = "DELETE FROM Dormitory WHERE dormitory_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i",$dormitory_id);
    $stmt->execute();
    mysqli_stmt_close($stmt);

    header('Location: ../backstage_main.php#pills-dormitory')
?> 