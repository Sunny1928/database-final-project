<!-- 刪除公告-功能 -->
<?php
    session_start();
    require_once('./connect_db.php');
    $conn = connect_db();
    
    $news_id = $_GET["news_id"];
    $account = $_GET["account"];
    $sql = "DELETE FROM news WHERE news_id = ? and account = ? ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is",$news_id,$account);
    $stmt->execute();
    mysqli_stmt_close($stmt);

    header('Location: ../main.php#pills-news')
?> 