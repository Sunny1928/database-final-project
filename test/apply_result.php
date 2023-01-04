<?php

    session_start();
    if (!isset($_SESSION["permission"]) || $_SESSION['permission'] == "error") {

        Header("Location: ./main.php", 301);
        die();
    }

    require_once('print_table.php');
    require_once('connect_sql.php');
    $conn = connect_sql();
    $account = $_SESSION['account'];
    $permission = $_SESSION['permission'];
    print("Hello " . $_SESSION['name'] . '.<br>');

    //輸出申請資料
    $sql = "SELECT * FROM `Apply_Data` ";

    if ($permission == 'student') {
        $sql = $sql . "WHERE `student_account` =  ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $account);
    }else{
        $stmt = $conn->prepare($sql);
    }
    
    $stmt->execute();
    $result = $stmt->get_result();
    print("申請資料：" . '<br>');
    print_data($result);
    mysqli_stmt_close($stmt);
?>
