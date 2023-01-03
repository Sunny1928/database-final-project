<?php 
    session_start();
    require_once('./connect_db.php');
    $conn = connect_db();
    
    $content = $_POST["content"];

    $sql= "INSERT INTO Rule (`content`) VALUE(?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s",$content);
    $stmt->execute();
    mysqli_stmt_close($stmt);

    header('Location: ../backstage_main.php#pills-rule')
?>