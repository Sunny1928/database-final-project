<!-- 更新訊息-功能 -->
<?php
	session_start();

    require_once('./connect_db.php');
    $conn = connect_db();

    $account =$_SESSION["account"];
    $permission =$_SESSION["permission"];

    // if ($permission == 'student') {
    //     $sql = "UPDATE Apply_Data SET academic_year=?, semester=? WHERE apply_data_id = ?";
    //     $stmt = $conn->prepare($sql);
    //     $stmt->bind_param("isi", $_POST["academic_year"], $_POST["semester"], $_POST["apply_data_id"]);

    // } else 

    // echo $permission.' ';
    // echo $_POST["pay_fee_or_not"];
    // echo $_POST["apply_data_id"];
    
    if ($permission == 'system_manager') {
        echo $_POST["pay_fee_or_not"];

        $sql = "UPDATE Apply_Data SET `state`=?, pay_fee_or_not=?, system_manager_account=?  WHERE apply_data_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $_POST["state"], $_POST["pay_fee_or_not"], $account, $_POST["apply_data_id"]);
    }

    $stmt->execute();
    mysqli_stmt_close($stmt);
    
    header('Location: ../main.php')
?>