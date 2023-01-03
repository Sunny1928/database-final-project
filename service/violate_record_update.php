<!-- 更新公告-功能 -->
<?php 
    session_start();
    require_once('./connect_db.php');
    $conn = connect_db();
    
    $rule_id = $_POST["rule_id"];
    $student_account = $_POST["student_account"];
    $point = $_POST["point"];
    $violate_record_id = $_POST["violate_record_id"];
    $dormitory_supervisor_account = $_POST["dormitory_supervisor_account"];

    $account = $_SESSION["account"];


    echo $rule_id;
    echo $student_account;
    echo $point;
    echo $dormitory_supervisor_account;
    echo $account;

    
    $sql= "UPDATE Violate_Record SET `rule_id` = '$rule_id', student_account = '$student_account', `point` = '$point', `dormitory_supervisor_account` = '$dormitory_supervisor_account' WHERE violate_record_id = ?";
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