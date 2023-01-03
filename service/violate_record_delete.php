<?php
    session_start();
    require_once('./connect_db.php');
    $conn = connect_db();
    
    $violate_record_id = $_GET["violate_record_id"];
    $account = $_SESSION["account"];

    $sql = "DELETE FROM violate_record WHERE violate_record_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i",$violate_record_id);
    $stmt->execute();
    mysqli_stmt_close($stmt);

    if($account=='root'){
        header('Location: ../backstage_main.php#pills-violate-record');
    }
    else{
        header('Location: ../main.php#pills-violate-record');
    }
?> 