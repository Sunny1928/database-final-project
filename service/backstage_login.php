<?php
    session_start();

    require_once('./connect_db.php');
    $conn = connect_db();

    $account = $_POST["account"];
    $password = $_POST["password"];


    $sql = "SELECT * FROM User WHERE account ='root'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0){
        $user_info =  $result->fetch_assoc();

        if (password_verify($password, $user_info["password"]) && $account == "root") 
        {
            echo "!";
            $_SESSION['account']=$account;
            $_SESSION['permission'] = $user_info["type"];
            $_SESSION['name'] = $user_info["name"];
			$_SESSION['email'] = $user_info["email"];
            header("Location: ../backstage_main.php");
            die();

        }
        else{
            $_SESSION['permission'] = "Error";
            header("Location: ../backstage_index.php" , 301);
            die();
        }


    }
    else{
        $_SESSION['permission'] = "Error";
        header("Location: ../backstage_index.php" , 301);
        die();
    }

?>

