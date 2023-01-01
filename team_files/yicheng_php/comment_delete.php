<!-- 刪除訊息-功能 -->
<?php

    require_once('./connect_db.php');
    $conn = connect_db();

    $account = $_GET["account"];
    $comment_id =$_GET["comment_id"];
    $sql ="DELETE FROM comment WHERE comment_id = $comment_id and account = $account ";
    $result = $conn->query($sql);
    header('Location: ./comment_view.php'); 
?> 