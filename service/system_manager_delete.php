<!-- 刪除訊息-功能 -->
<?php
    require_once('./connect_db.php');
    $conn = connect_db();

    $account = $_GET["account"];

    $sql ="DELETE FROM User WHERE account = ? ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s",$account);
    $stmt->execute();

    $sql ="DELETE FROM System_Manager WHERE account = ? ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s",$account);
    $stmt->execute();

    mysqli_stmt_close($stmt);

	header("Location: ../backstage_main.php#pills-system-manager");
?> 