<?php
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $servername = "localhost";
		$username = "a10955pysy";
		$password = "qwertyuiop";
		$dbname = "school_dormitory_db";
		$conn = mysqli_connect($servername, $username, $password, $dbname);

		if (!$conn) {
		    die("Connection failed: " . mysqli_connect_error());
		}
	    echo "Connected successfully";
		
		$_POST['password'] = password_hash($_POST["password"] ,PASSWORD_DEFAULT);

		$sql = "INSERT INTO User (name, password, email, phone, account, type) VALUES (?, ?, ?, ?, ?, ?)";

		$type = 'student';
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('sssiss' ,$_POST['name'] , $_POST['password'] , $_POST['email'] , $_POST['phone'] , $_POST['account'] , $type);

		$stmt->execute();	

		header("Location: ../login_view.php" , 301);
        die();
	}
?>

