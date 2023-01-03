<?php 
    session_start();
    require_once('./connect_db.php');
    $conn = connect_db();

    
    $rule_id = $_POST["rule_id"];
    $student_account = $_POST["student_account"];
    $point = $_POST["point"];
    $dormitory_supervisor_account = $_POST["dormitory_supervisor_account"];
    $account = $_SESSION["account"];

    echo $rule_id;
    echo $student_account;
    echo $point;
    echo $dormitory_supervisor_account;

    $sql= "INSERT INTO Violate_Record (rule_id, `student_account`, `point`, dormitory_supervisor_account) VALUE(?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isis",$rule_id,$student_account,$point,$dormitory_supervisor_account);
    $stmt->execute();
    mysqli_stmt_close($stmt);

    if($account=='root'){
        header('Location: ../backstage_main.php#pills-violate-record');
    }
    else{
        header('Location: ../main.php#pills-violate-record');
    }
?>