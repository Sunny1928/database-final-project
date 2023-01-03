<!-- 更新公告-功能 -->
<?php 
    require_once('./connect_db.php');
    $conn = connect_db();
    
    $name = $_POST["name"];
    $expired_year = $_POST["expired_year"];
    $state = $_POST["state"];
    $room_number = $_POST["room_number"];
    $account = $_POST["account"];
    $equipment_id = $_POST["equipment_id"];

    echo $name;
    echo $expired_year;
    echo $state;
    echo $room_number;
    echo $account;
    
    $sql= "UPDATE Equipment SET `name` = '$name', expired_year = '$expired_year', room_number = '$room_number', `state` = '$state', `account` = '$account' WHERE equipment_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i",$equipment_id);
    $stmt->execute();
    mysqli_stmt_close($stmt);

    if($account=='root'){
        header('Location: ../backstage_main.php#pills-equipment');
    }
    else{
        header('Location: ../main.php#pills-all');
    }
?>