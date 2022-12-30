<?php
    
    require_once('./connect_db.php');
    $conn = connect_db();

    $account_id =$_POST["account"];
    $comment_id = $_POST["comment_id"];
    $content = $_POST["content"];

    $sql = "UPDATE  comment SET content = $content_id WHERE account = $account and comment_id = $comment_id";
    $result = $conn->query($sql);
    
    header('Location: comment_view.php'); 
?>