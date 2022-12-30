<?php
    session_start();

    $servername = "localhost";
    $username = "a10955pysy";
    $password = "qwertyuiop";
    $dbname = "school_dormitory_db";
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    echo "Connected successfully";

    $account = $_POST["account"];
    $password = $_POST["password"];


    $sql = "SELECT * FROM User WHERE account ='root'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0){
        $user_info =  $result->fetch_assoc();
        
#        echo $account ."\n";
#        echo $password . "\n";
#        echo password_verify($password, $user_info["password"])."\n" ;
#        echo ($account == "root");

        if (password_verify($password, $user_info["password"]) && $account == "root") 
        {
            echo "!";
            $_SESSION['account']=$account;
            $_SESSION['permission'] = $user_info["type"];
            $_SESSION['name'] = $user_info["name"];
            header("Location: ./backstage.php");
            die();

        }
        else{
            $_SESSION['permission'] = "Error";
            header("Location: ./index.php" , 301);
            die();
        }


    }
    else{
        $_SESSION['permission'] = "Error";
        header("Location: ./index.php" , 301);
        die();
    }


    


?>

