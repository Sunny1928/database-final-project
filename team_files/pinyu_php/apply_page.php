<?php

    session_start();
    require_once('connect_sql.php');
    $conn = connect_sql();
    $account = $_SESSION['account'];
    $permission =  $_SESSION['permission'];

    switch ($permission){
        
        case 'student':

            print("申請住宿：" . '<br>');
            echo '<form method="post"><input required type="number" placeholder="academic_year" name="academic_year"><br><input required type="text" placeholder="semester" name="semester"><br><input type="submit" value="Submit"></form>';

            //新增申請資料
            $root = '3'; //放root權限，system menager更改時再update
            $sql = "INSERT INTO Apply_Data(academic_year, semester, state, pay_fee_or_not, progress, student_account, system_manager_account) VALUES(?, ?, '審核中','not','', ?,?);";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("isss", $_POST["academic_year"], $_POST["semester"], $account, $root);
            $stmt->execute();
            mysqli_stmt_close($stmt);

            break;

        case 'supervisor':

            print("新增違規紀錄：" . '<br>');
            echo '<form method="post"><input required type="text" placeholder="student_account" name="student_account"><br><input required type="number" placeholder="violate_record_id" name="violate_record_id"><br><input required type="number" placeholder="point" name="point"><br><input type="submit" value="Submit"></form>';

            break;

        case 'manager':

            break;
        default:
            echo $permission;
            break;
    }

    

    // header("Location: ./main.php"); // 自動跳轉回 student.php
?>


