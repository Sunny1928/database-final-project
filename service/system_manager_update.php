<!-- 更新訊息-功能 -->
<?php
    require_once('./connect_db.php');
    $conn = connect_db();

    $account =$_POST["account"];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = "UPDATE  User SET `name` = '$name', email = '$email', phone = '$phone' WHERE account = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s',$account);
    $stmt->execute();
    
    header('Location: ../backstage_main.php#pills-system-manager')
?>