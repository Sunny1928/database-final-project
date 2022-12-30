<?php

    session_start();
    require_once('connect_sql.php');
    $conn = connect_sql();
    $account = $_SESSION['account'];
    $permission = $_SESSION['permission'];
    print("Hello " . $_SESSION['name'] . '.<br>' . "Your permission is " . $permission . '.<br>');

    switch ($permission) {

        case 'student': //學生

            //輸出違規紀錄
            $sql = "SELECT * FROM `Violate_Record` WHERE `student_account` =  ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $account);
            $stmt->execute();
            $result = $stmt->get_result();
            print("違規紀錄：" . '<br>');
            if (mysqli_num_rows($result) > 0) { // mysqli_num_rows方法可以回傳我們結果總共有幾筆資料
                while ($row = mysqli_fetch_assoc($result)) { //輸出想要的index
                    print('date:' . $row["date"] . ', point:' . $row["point"] . ', rule:' . $row["rule_id"] . '<br>');
                }
            }
            mysqli_stmt_close($stmt);  // 釋放資料庫查到的記憶體

            //輸出房間資料
            $sql = "SELECT * FROM `Room` JOIN live_in USING(room_number) WHERE student_account = ?;";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $account);
            $stmt->execute();
            $result = $stmt->get_result();
            print("房間資料：" . '<br>');
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    print('academic_year:' . $row["academic_year"] . ', semester:' . $row["semester"] . ', dormitory_id :' . $row["dormitory_id"] . ', room_number:' . $row["room_number"] . ', num_of_people:' . $row["num_of_people"] . ', fee:' . $row["fee"] . '<br>');
                }
            }
            mysqli_stmt_close($stmt);

            //輸出申請資料
            $sql = "SELECT * FROM `Apply_Data` WHERE `student_account` =  ?;";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $account);
            $stmt->execute();
            $result = $stmt->get_result();
            print("申請資料：" . '<br>');
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    print('academic_year:' . $row["academic_year"] . ', semester:' . $row["semester"] . ', apply_date:' . $row["apply_date"] . ', state:' . $row["state"] . ', 	pay_fee_or_not:' . $row["pay_fee_or_not"] . '<br>');
                }
            }
            mysqli_stmt_close($stmt);

        break;

        case 'supervisor':

            //輸出管理的宿舍
            $sql = "SELECT * FROM Dormitory_Supervisor JOIN Dormitory USING(dormitory_id) WHERE account = ?;";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $account);
            $stmt->execute();
            $result = $stmt->get_result();
            print("管理的宿舍：" . '<br>');
            if (mysqli_num_rows($result) > 0) { 
                while ($row = mysqli_fetch_assoc($result)) {
                    print('dormitory_id:' . $row["dormitory_id"] . ', dormitory_name:' . $row["name"] .'<br>');
                }
            };
            mysqli_stmt_close($stmt);

            //輸出管理的宿舍的房間
            $sql = "SELECT * FROM Dormitory_Supervisor JOIN Room USING(dormitory_id) WHERE account = ?;";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $account);
            $stmt->execute();
            $result = $stmt->get_result();
            print('<br>'."宿舍的每間房：" . '<br>');
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    print('room_number:' . $row["room_number"] . ', num_of_people:' . $row["num_of_people"]. ', fee:' . $row["fee"]. '<br>');
                    //輸出房間的學生
                    $sql2 = "SELECT * FROM live_in WHERE room_number = ?;";
                    $stmt2 = $conn->prepare($sql2);
                    $stmt2->bind_param("i", $row["room_number"]);
                    $stmt2->execute();
                    $result2 = $stmt2->get_result();
                    print('----------------' . '<br>');
                    print("這間房的學生：" . '<br>');
                    if (mysqli_num_rows($result2) > 0) {
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                            print('student_account:' . $row2["student_account"] .' academic_year:' . $row2["academic_year"] . ', semester:' . $row2["semester"] . '<br>');
                        }
                    }
                    print('----------------' . '<br>');
                    mysqli_stmt_close($stmt2); 
                }
            }
            mysqli_stmt_close($stmt);


            //輸出學生的違規紀錄
            $sql = "SELECT * FROM Violate_Record;";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            print("學生的違規紀錄：" . '<br>');
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    print('violate_record_id:' . $row["violate_record_id"] . ', student_account:' . $row["student_account"] .'date:' . $row["date"] . 'rule_id:' . $row["rule_id"] . ', point:' . $row["point"].'<br>');
                }
            };
            mysqli_stmt_close($stmt);
            
            break;

        case 'manager':

            break;
    }


?>
<form action="./apply_page.php" method="post">

    <input type="submit" value="Apply">

</form>
