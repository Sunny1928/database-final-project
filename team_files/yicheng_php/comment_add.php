<?php
    session_start();
    require_once('./connect_db.php');
    $conn = connect_db();

    $account = $_SESSION["account"];
    $content = $_POST["content"];
    
    $sql =  "INSERT INTO comment (account , content) VALUE($account,'$content')";
    $result = $conn->query($sql);

    header('Location: comment_view.php'); 


?>