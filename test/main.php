<?php

    session_start();
    require_once('connect_sql.php');
    
    if (!isset($_SESSION["permission"]) || $_SESSION['permission'] == "error") {
        
        Header("Location: ./login_view.php", 301);
        die();
    }
    
    $conn = connect_sql();
    $account = $_SESSION['account'];
    $permission = $_SESSION['permission'];
    print("Hello " . $_SESSION['name'] . '.<br>' . "Your permission is " . $permission . '.<br>');

    echo   '<a href="violate_record.php" target="_blank">違規紀錄查詢</a><br>
            <a href="room_equipment.php" target="_blank">房間資料查詢</a><br>';

    if($permission == 'student'){
        echo '<a href="apply_result.php" target="_blank">申請結果查詢</a><br>
              <a href="manage_apply.php" target="_blank">管理住宿申請</a>';
    }else if ($permission == 'dormitory_supervisor') {
        echo '<a href="manage_record.php" target="_blank">管理違規紀錄</a>';
    } else if ($permission == 'system_manager') {
        echo '<a href="apply_result.php" target="_blank">申請結果查詢</a><br>
              <a href="manage_apply.php" target="_blank">管理住宿申請</a><br>
              <a href="manage_live_in.php" target="_blank">管理住宿學生</a><br>
              <a href="manage_equipment.php" target="_blank">管理設備狀況</a>';
    }

?>
