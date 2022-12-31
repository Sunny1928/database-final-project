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

    

    
    //輸出房間資料
    $sql = "SELECT * FROM Room JOIN live_in USING(room_number)";

    if($permission == 'student'){

        //會有不同年的
        $sql = $sql . "WHERE student_account =  ? ORDER BY academic_year DESC, semester DESC ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $account);

        //只輸出最新入住的設備
        $sql = $sql . "LIMIT 1";
        $stmt2 = $conn->prepare($sql);
        $stmt2->bind_param("s", $account);
        $stmt2->execute();
        $result = $stmt2->get_result();
        $room = mysqli_fetch_row($result)[0];
        mysqli_stmt_close($stmt2);
        
    } else if ($permission == 'supervisor') {

        $sql2 = "SELECT dormitory_id FROM Dormitory_Supervisor WHERE account = ?";
        $stmt = $conn->prepare($sql2);
        $stmt->bind_param("s", $account);
        $stmt->execute();
        $result = $stmt->get_result();
        $dormitory_id = mysqli_fetch_row($result)[0];
        mysqli_stmt_close($stmt);

        $sql = $sql . "WHERE dormitory_id =  ? ORDER BY academic_year DESC, semester DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $dormitory_id);
    }else if ($permission == 'manager') {

        $sql2 = "SELECT * FROM Dormitory";
        $stmt = $conn->prepare($sql2);
        $stmt->execute();
        $result = $stmt->get_result();
        print("宿舍資料：" . '<br>');
        print_data($result);
        mysqli_stmt_close($stmt);

        $sql = $sql . "ORDER BY academic_year DESC, semester DESC ";
        $stmt = $conn->prepare($sql);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    print("房間資料：" . '<br>');
    print_data($result);


    //輸出設備資料
    $sql = "SELECT * FROM Equipment ";

    if ($permission == 'student') {

        $sql = $sql . "WHERE room_number =  ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $room);
    } 
    else if ($permission == 'supervisor') {

        // $sql = $sql . "JOIN Room USING(room_number) WHERE dormitory_id =  ?";
        $sql = "SELECT `name`,purchase_date,expired_year,equipment_id,`state`,room_number,account FROM Equipment JOIN Room USING(room_number) WHERE dormitory_id =  ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $dormitory_id);
    }else if($permission == 'manager'){
        $stmt = $conn->prepare($sql);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    print("設備資料：" . '<br>');
    print_data($result);
    mysqli_stmt_close($stmt);

?>
