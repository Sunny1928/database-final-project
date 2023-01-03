<!-- 新增訊息-功能 -->
<?php
    session_start();
    require_once('./connect_db.php');
    $conn = connect_db();

    $account = $_SESSION["account"];
    $content = $_POST["content"];
    
    $sql =  "INSERT INTO Comment (account , content) VALUE(?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss",$account,$content);
    $stmt->execute();
    mysqli_stmt_close($stmt);

    header('Location: ../main.php#pills-message')
?>