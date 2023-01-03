<!-- 新增訊息-功能 -->
<?php
    session_start();
    require_once('./connect_db.php');
    $conn = connect_db();

    $account = $_SESSION["account"];
    $root = 'root';
    
    $sql = "INSERT INTO Apply_Data(academic_year, semester, state, pay_fee_or_not, progress, student_account, system_manager_account) VALUES(?, ?, '審核中','還沒','', ?,?);";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isss", $_POST["academic_year"], $_POST["semester"], $account, $root);
    $stmt->execute();
    mysqli_stmt_close($stmt);

    header('Location: ../main.php')
?>