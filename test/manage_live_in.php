<?php

    session_start();
    if (!isset($_SESSION["permission"]) || $_SESSION['permission'] == "error" || $_SESSION['permission'] != "system_manager") {

        Header("Location: ./main.php", 301);
        die();
    }

    require_once('print_table.php');
    require_once('connect_sql.php');
    $conn = connect_sql();
    $account = $_SESSION['account'];
    $permission =  $_SESSION['permission'];

    //輸出住宿學生
    $sql = "SELECT * FROM live_in ORDER BY academic_year DESC, semester DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    print("住宿學生：" . '<br>');
    print_data($result);
    mysqli_stmt_close($stmt);


    //新增住宿學生
    print("新增住宿學生：" . '<br>');
    echo '<form method="post">
            <input type="hidden" name="step" value=1>
            <input required type="number" placeholder="semester" name="semester"><br>
            <input required type="number" placeholder="academic_year" name="academic_year"><br>
            <input required type="text" placeholder="student_account" name="student_account"><br>
            <input required type="number" placeholder="room_number" name="room_number"><br>
            <input type="submit" value="Submit">
        </form>';


    //刪除住宿學生
    print('<br>' . "刪除住宿學生：" . '<br>');
    $sql = "SELECT * FROM live_in ORDER BY academic_year DESC, semester DESC";

    echo
    '<form method="post">
        <input type="hidden" name="step" value=2>
        <label>academic_year - semester - student_account - room_number</label><br>
        <select name=live_in_data>';
    foreach ($conn->query($sql) as $row) {
        $toatl_data = $row["academic_year"] ."-". $row["semester"] ."-". $row["student_account"] ."-". $row["room_number"];
        echo "<option value=$toatl_data>$toatl_data</option>";
    }
    echo '</select><br>  
        <input type="submit" value="Submit">
    </form>';


    //修改住宿學生
    print('<br>' . "修改住宿學生：" . '<br>');
    $sql = "SELECT * FROM live_in ORDER BY academic_year DESC, semester DESC";

    echo
    '<form method="post">
        <input type="hidden" name="step" value=3>
        <label>academic_year - semester - student_account - room_number</label><br>
        <select name=live_in_data>';
    foreach ($conn->query($sql) as $row) {
        $toatl_data = $row["academic_year"] ."-". $row["semester"] ."-". $row["student_account"] ."-". $row["room_number"];
        echo "<option value=$toatl_data>$toatl_data</option>";
    }
    echo '</select><br>  
        <input required type="number" placeholder="room_number" name="room_number"><br>
        <input type="submit" value="Submit">
    </form>';


    if ($_POST["step"] == 1) { //新增
        echo "HI";
        $sql = "INSERT INTO live_in VALUES(?, ?, ?, ?, ?);";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iissi", $_POST["semester"], $_POST["academic_year"], $_POST["student_account"], $account, $_POST["room_number"]);

    }else if ($_POST["step"] == 2) { //刪除

        list($academic_year, $semester, $student_account, $ori_room_number) = explode("-", $_POST["live_in_data"]);
        $sql = "DELETE FROM live_in WHERE room_number=? AND academic_year = ? AND semester = ? AND student_account= ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiis", $ori_room_number, $academic_year, $semester, $student_account);   
    }else if ($_POST["step"] == 3) { //修改
        
        list($academic_year, $semester, $student_account, $ori_room_number) = explode("-", $_POST["live_in_data"]);
        $sql = "UPDATE live_in SET room_number=?, system_manager_account=? WHERE academic_year = ? AND semester = ? AND student_account= ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isiis", $_POST["room_number"],$account, $academic_year, $semester, $student_account);        
    }
    $stmt->execute();
    mysqli_stmt_close($stmt);


    // 跳轉，才會顯示最新的資料
    if(isset($_POST["step"])){
        header("Location: ./manage_live_in.php"); 
    }
?>


