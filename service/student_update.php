<!-- 更新訊息-功能 -->
<?php
    require_once('./connect_db.php');
    $conn = connect_db();

    $account =$_POST["account"];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $student_id = $_POST['student_id'];
    $academic_year = $_POST['academic_year'];
    $major_year = $_POST['major_year'];
    $gender = $_POST['gender'];

    $sql = "UPDATE  User SET `name` = '$name', email = '$email', phone = '$phone' WHERE account = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s',$account);
    $stmt->execute();

    $sql = "UPDATE  Student SET `student_id` = '$student_id', major_year = '$major_year', academic_year = '$academic_year', gender = '$gender' WHERE account = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s',$account);
    $stmt->execute();
    
	header("Location: ../backstage_main.php");
?>