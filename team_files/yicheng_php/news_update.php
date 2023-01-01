<!-- 更新公告-功能 -->
<?php 
    require_once('./connect_db.php');
    $conn = connect_db();
    
    $account = $_POST["account"];
    $content = $_POST["content"];
    $news_id = $_POST["news_id"];
    
    $sql= "UPDATE news SET content = '$content' WHERE account = '$account' and news_id = '$news_id'";
    $result = $conn->query($sql);

    header('Location: ./news_view.php');
?>