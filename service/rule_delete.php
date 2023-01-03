<?php
    session_start();
    require_once('./connect_db.php');
    $conn = connect_db();

    $rule_id = $_GET["rule_id"];

    $sql = "DELETE FROM Rule WHERE rule_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i",$rule_id);
    $stmt->execute();
    mysqli_stmt_close($stmt);

    header('Location: ../backstage_main.php#pills-rule')
?> 