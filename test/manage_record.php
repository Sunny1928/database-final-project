<?php

    session_start();
    if (!isset($_SESSION["permission"]) || $_SESSION['permission'] == "error" || $_SESSION['permission'] != "dormitory_supervisor") {

        Header("Location: ./main.php", 301);
        die();
    }

    require_once('print_table.php');
    require_once('connect_sql.php');
    $conn = connect_sql();
    $account = $_SESSION['account'];
    $permission =  $_SESSION['permission'];

    //輸出違規紀錄
    $sql = "SELECT * FROM `Violate_Record`";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    print("違規紀錄：" . '<br>');
    print_data($result);
    mysqli_stmt_close($stmt);  // 釋放資料庫查到的記憶體

    //新增違規紀錄
    print('<br>'."新增違規紀錄：" . '<br>');

    echo
        '<form method="post">
            <input type="hidden" name="step" value=1>
            <input required type="text" placeholder="student_account" name="student_account"><br>
            <select name=rule_id>';
        $sql = "SELECT * FROM Rule order by rule_id";
        foreach ($conn->query($sql) as $row) { 
            echo "<option value=$row[rule_id]>$row[rule_id]: $row[content]</option>";
        }
        echo '</select><br>
            <input required type="number" placeholder="point" name="point"><br>
            <input type="submit" value="Submit">
        </form>';
    
    
    // $sql = "INSERT INTO Violate_Record(rule_id, `point`, student_account, dormitory_supervisor_account) VALUES(?, ?, ?, ?);";
    // $stmt = $conn->prepare($sql);
    // if($_POST["step"] == 1){
    //     $stmt->bind_param("iiss", $_POST["rule_id"], $_POST["point"], $_POST["student_account"], $account);
    //     $stmt->execute();
    // }
    // mysqli_stmt_close($stmt);
        
   

    //刪除違規紀錄
    print('<br>' . "刪除違規紀錄：" . '<br>');

    $sql = "SELECT * FROM Violate_Record order by violate_record_id";
    echo
        '<form method="post">
            <input type="hidden" name="step" value=2>
            <label>rule_id</label>
            <select name=violate_record_id>';
        foreach ($conn->query($sql) as $row) {
            echo "<option value=$row[violate_record_id]>$row[violate_record_id]</option>";
        }
        echo '</select><br>        
            <input type="submit" value="Submit">
        </form>';

    // $sql = "DELETE FROM Violate_Record WHERE violate_record_id = ?";
    // $stmt = $conn->prepare($sql);
    // if ($_POST["step"] == 2) {
    //     $stmt->bind_param("i", $_POST["violate_record_id"]);
    //     $stmt->execute();
    // }
    // mysqli_stmt_close($stmt);

    //修改違規紀錄
    print('<br>' . "修改違規紀錄：" . '<br>');

    $sql = "SELECT * FROM Violate_Record order by violate_record_id";
    $sql2 = "SELECT * FROM Rule order by rule_id";
    echo
        '<form method="post">
            <input type="hidden" name="step" value=3>
            <label>violate_record_id</label>
            <select name=violate_record_id>';
        foreach ($conn->query($sql) as $row) {
            echo "<option value=$row[violate_record_id]>$row[violate_record_id]</option>";
        }
        echo '</select><br> 
            <input required type="text" placeholder="student_account" name="student_account"><br>
            <label>rule_id</label>
            <select name=rule_id>';
            foreach ($conn->query($sql2) as $row) {
                echo "<option value=$row[rule_id]>$row[rule_id]: $row[content]</option>";
            }
        echo '</select><br>
            <input required type="number" placeholder="point" name="point"><br>
            <input type="submit" value="Submit">
        </form>';


    if ($_POST["step"] == 1) { //新增

        $sql = "INSERT INTO Violate_Record(rule_id, `point`, student_account, dormitory_supervisor_account) VALUES(?, ?, ?, ?);";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiss", $_POST["rule_id"], $_POST["point"], $_POST["student_account"], $account);
    }else if ($_POST["step"] == 2) { //刪除

        $sql = "DELETE FROM Violate_Record WHERE violate_record_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $_POST["violate_record_id"]);
    }else if ($_POST["step"] == 3) { //修改

        $sql = "UPDATE Violate_Record SET student_account=?, `point`=?, rule_id=?, dormitory_supervisor_account=?  WHERE violate_record_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("siisi", $_POST["student_account"], $_POST["point"], $_POST["rule_id"], $account,$_POST["violate_record_id"]);
    }
    $stmt->execute();
    mysqli_stmt_close($stmt);


    // 跳轉manage_record，才會顯示最新的資料
    if(isset($_POST["step"])){
        header("Location: ./manage_record.php"); 
    }
?>


