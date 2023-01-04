<?php

    session_start();
    if (!isset($_SESSION["permission"]) || $_SESSION['permission'] == "error" || $_SESSION['permission'] == "dormitory_supervisor") {

        Header("Location: ./main.php", 301);
        die();
    }

    require_once('print_table.php');
    require_once('connect_sql.php');
    $conn = connect_sql();
    $account = $_SESSION['account'];
    $permission =  $_SESSION['permission'];
    $root = 'root';

    //輸出申請住宿資料
    $sql = "SELECT * FROM `Apply_Data` ";

    if ($permission == 'student') {
        $sql = $sql . "WHERE `student_account` =  ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $account);
    } else {
        $stmt = $conn->prepare($sql);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    print("申請住宿資料：" . '<br>');
    print_data($result);
    mysqli_stmt_close($stmt);

   
    if($permission == 'student'){
        //新增申請住宿
        print("新增申請住宿：" . '<br>');
        echo '<form method="post">
            <input type="hidden" name="step" value=1>
                <input required type="number" placeholder="academic_year" name="academic_year"><br>
                <input required type="text" placeholder="semester" name="semester"><br>
                <input type="submit" value="Submit">
            </form>';


        //刪除住宿申請
        print('<br>' . "刪除住宿申請：" . '<br>');

        $sql = "SELECT * FROM Apply_Data WHERE student_account = " . $account . " ORDER BY apply_data_id";
        echo
        '<form method="post">
                <input type="hidden" name="step" value=2>
                <label>apply_data_id</label>
                <select name=apply_data_id>';
        foreach ($conn->query($sql) as $row) {
            echo "<option value=$row[apply_data_id]>$row[apply_data_id]</option>";
        }
        echo '</select><br>        
                <input type="submit" value="Submit">
            </form>';
    }


    //修改住宿申請
    print('<br>' . "修改住宿申請：" . '<br>');

    $sql = "SELECT * FROM Apply_Data ";
    if ($permission == 'student') {
        $sql = $sql . "WHERE student_account = " . $account;
    }
    $sql = $sql . " order by apply_data_id";

    echo
    '<form method="post">
        <input type="hidden" name="step" value=3>
        <label>apply_data_id</label>
        <select name=apply_data_id>';
    foreach ($conn->query($sql) as $row) {
        echo "<option value=$row[apply_data_id]>$row[apply_data_id]</option>";
    }
    echo '</select><br>  
        <input required type="text" placeholder="academic_year" name="academic_year"><br>     
        <input required type="text" placeholder="semester" name="semester"><br>';
    if($permission == 'manager'){
        echo '<input required type="text" placeholder="state" name="state"><br>';
        echo '<input required type="text" placeholder="pay_fee_or_not" name="pay_fee_or_not"><br>';
    }
    echo '<input type="submit" value="Submit">
    </form>';



    if ($_POST["step"] == 1) { //新增

        $sql = "INSERT INTO Apply_Data(academic_year, semester, state, pay_fee_or_not, progress, student_account, system_manager_account) VALUES(?, ?, '審核中','not','', ?,?);";
        $stmt = $conn->prepare($sql);

        
        $stmt->bind_param("isss", $_POST["academic_year"], $_POST["semester"], $account, $root);

    }else if ($_POST["step"] == 2) { //刪除

        $sql = "DELETE FROM Apply_Data WHERE apply_data_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $_POST["apply_data_id"]);
    }else if ($_POST["step"] == 3) { //修改

        if ($permission == 'student') {
            $sql = "UPDATE Apply_Data SET academic_year=?, semester=? WHERE apply_data_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("isi", $_POST["academic_year"], $_POST["semester"], $_POST["apply_data_id"]);

        } else if ($permission == 'manager') {
            $sql = "UPDATE Apply_Data SET academic_year=?, semester=?, `state`=?, pay_fee_or_not=?,system_manager_account=?  WHERE apply_data_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("issssi", $_POST["academic_year"], $_POST["semester"], $_POST["state"], $_POST["pay_fee_or_not"], $account, $_POST["apply_data_id"]);
        }
    }
    $stmt->execute();
    mysqli_stmt_close($stmt);


    // 跳轉，才會顯示最新的資料
    if(isset($_POST["step"])){
        header("Location: ./manage_apply.php"); 
    }
?>


