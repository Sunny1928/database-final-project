<?php 
    require_once('./connect_db.php');
    $conn = connect_db();
    
    $content = $_POST["content"];
    $rule_id = $_POST["rule_id"];
    
    $sql= "UPDATE rule SET `content` = '$content' WHERE rule_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i",$rule_id);
    $stmt->execute();
    mysqli_stmt_close($stmt);

    header('Location: ../backstage_main.php#pills-rule')
?>