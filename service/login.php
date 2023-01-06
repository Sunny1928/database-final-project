<?php
	session_start();

	require_once('./connect_db.php');
    $conn = connect_db();

	$account = $_POST["account"];
	$password = $_POST["password"];


	$sql = "SELECT name , type , password, email FROM User WHERE account ='$account'";

	$result = $conn->query($sql);

	if ($result->num_rows > 0){
		$user_info =  $result->fetch_assoc();
		

		if (password_verify($password, $user_info["password"])) {
			$_SESSION['account']=$account;
			$_SESSION['permission'] = $user_info["type"];
			if($_SESSION['permission'] == 'student'){
				$sql = "SELECT gender FROM Student WHERE account ='$account'";
				$result = $conn->query($sql);
				if ($result->num_rows > 0){
					$info =  $result->fetch_assoc();
					if($info['gender'] == 'male'){
						$_SESSION['icon'] = "./image/boy.png";
					}else{
						$_SESSION['icon'] = "./image/girl.png";
					}
				}
				
			} else if($_SESSION['permission'] == 'system_manager'){
				$_SESSION['icon'] = "./image/man.png";
			} else if($_SESSION['permission'] == 'dormitory_supervisor'){
				$_SESSION['icon'] = "./image/woman.png";
			}

			$_SESSION['name'] = $user_info["name"];
			$_SESSION['email'] = $user_info["email"];
			header("Location: ../main.php");	
			die();
		}
		else{
			$_SESSION['permission'] = "Error";
	        header("Location: ../index.php" , 301);
	        die();
		}

	}
	else{
		
		$_SESSION['permission'] = "Error";
		header("Location: ../index.php" , 301);
		die();
	}
?>

<!-- $servername = "localhost";
$username = "a10955pysy";
$password = "qwertyuiop";
$dbname = "school_dormitory_db"; -->