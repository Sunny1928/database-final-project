<!-- 刪除公告功能 -->
<?php

    session_start();
    require_once('./connect_db.php');
    $conn = connect_db();
    
    $news_id =$_GET["news_id"];
    $account = $_GET["account"];
    $sql = "DELETE FROM news WHERE news_id = $news_id and account = $account ";
    $result = $conn->query($sql);

    header('Location: ./news_view.php')

    
?> 