<!-- 刪除訊息-功能 -->
<?php
    require_once('./connect_db.php');
    $conn = connect_db();

    $sql = "DELETE FROM Apply_Data WHERE apply_data_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $_GET["apply_data_id"]);
    $stmt->execute();
    mysqli_stmt_close($stmt);

    header('Location: ../main.php')
?> 