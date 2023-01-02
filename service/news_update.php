<!-- 更新公告-功能 -->
<?php 
    require_once('./connect_db.php');
    $conn = connect_db();
    
    $account = $_POST["account"];
    $content = $_POST["content"];
    $news_id = $_POST["news_id"];
    
    $sql= "UPDATE news SET content = '$content' WHERE account = ? and news_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si",$account,$news_id);
    $stmt->execute();
    mysqli_stmt_close($stmt);

    header('Location: ../main.php#pills-news')
?>