<?php
    require_once('./connect_db.php');
    $conn = connect_db();

    $account = $_GET["account"];
    $comment_id =$_GET["comment_id"];
    $sql ="DELETE FROM Comment WHERE comment_id = ? and account = ? ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is",$comment_id,$account);
    $stmt->execute();
    mysqli_stmt_close($stmt);

    header('Location: ../main.php#pills-message')
?> 