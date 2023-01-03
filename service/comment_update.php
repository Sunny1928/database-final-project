<!-- 更新訊息-功能 -->
<?php
    require_once('./connect_db.php');
    $conn = connect_db();

    $account =$_POST["account"];
    $comment_id = $_POST["comment_id"];
    $content = $_POST["content"];

    $sql = "UPDATE Comment SET content = ? WHERE account = ? and comment_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi",$content,$account,$comment_id);
    $stmt->execute();
    mysqli_stmt_close($stmt);
    
    header('Location: ../main.php#pills-message')
?>