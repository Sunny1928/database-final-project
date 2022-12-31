<?php

    session_start();
    if (!isset($_SESSION["permission"]) || $_SESSION['permission'] == "error" || $_SESSION['permission'] != "manager") {

        Header("Location: ./main.php", 301);
        die();
    }

    require_once('print_table.php');
    require_once('connect_sql.php');
    $conn = connect_sql();
    $account = $_SESSION['account'];
    $permission =  $_SESSION['permission'];

    //輸出設備狀況
    $sql = "SELECT * FROM Equipment";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    print("設備狀況：" . '<br>');
    print_data($result);
    mysqli_stmt_close($stmt);


    //新增設備狀況
    print("新增設備狀況：" . '<br>');
    echo '<form method="post">
            <input type="hidden" name="step" value=1>
            <input required type="text" placeholder="equipment_name" name="equipment_name"><br>
            <input required type="date" placeholder="purchase_date" name="purchase_date"><br>
            <input required type="date" placeholder="expired_year" name="expired_year"><br>
            <input required type="text" placeholder="state" name="state"><br>
            <input required type="number" placeholder="room_number" name="room_number"><br>
            <input type="submit" value="Submit">
        </form>';


    //刪除設備狀況
    print('<br>' . "刪除設備狀況：" . '<br>');
    $sql = "SELECT * FROM Equipment ORDER BY equipment_id";

    echo
        '<form method="post">
            <input type="hidden" name="step" value=2>
            <label>equipment_id</label>
            <select name=equipment_id>';
    foreach ($conn->query($sql) as $row) {
        echo "<option value=$row[equipment_id]>$row[equipment_id]</option>";
    }
    echo '</select><br>        
            <input type="submit" value="Submit">
        </form>';


    //修改設備狀況
    print('<br>' . "修改設備狀況：" . '<br>');
    $sql = "SELECT * FROM Equipment  ORDER BY equipment_id";

    echo
    '<form method="post">
        <input type="hidden" name="step" value=3>
        <label>equipment_id</label>
        <select name=equipment_id>';
    foreach ($conn->query($sql) as $row) {
        echo "<option value=$row[equipment_id]>$row[equipment_id]</option>";
    }
    echo '</select><br>  
        <input required type="text" placeholder="equipment_name" name="equipment_name"><br>
        <input required type="date" placeholder="purchase_date" name="purchase_date"><br>
        <input required type="date" placeholder="expired_year" name="expired_year"><br>
        <input required type="text" placeholder="state" name="state"><br>
        <input required type="number" placeholder="room_number" name="room_number"><br>
        <input type="submit" value="Submit">
    </form>';


    if ($_POST["step"] == 1) { //新增

        $sql = "INSERT INTO Equipment(`name`, purchase_date, expired_year, `state`, room_number, account) VALUES(?, ?, ?, ?, ?, ?);";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssis", $_POST["equipment_name"], $_POST["purchase_date"], $_POST["expired_year"], $_POST["state"], $_POST["room_number"], $account);

    }else if ($_POST["step"] == 2) { //刪除

        $sql = "DELETE FROM Equipment WHERE equipment_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $_POST["equipment_id"]);
    }else if ($_POST["step"] == 3) { //修改

        $sql = "UPDATE Equipment SET `name`=?, purchase_date=?, expired_year=?,`state`=?, room_number=?,account=?  WHERE equipment_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssisi", $_POST["equipment_name"], $_POST["purchase_date"], $_POST["expired_year"], $_POST["state"], $_POST["room_number"], $account, $_POST["equipment_id"]);        
    }
    $stmt->execute();
    mysqli_stmt_close($stmt);


    // 跳轉，才會顯示最新的資料
    if(isset($_POST["step"])){
        header("Location: ./manage_equipment.php"); 
    }
?>


