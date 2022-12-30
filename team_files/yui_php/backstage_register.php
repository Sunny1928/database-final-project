
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
		
		//echo $_POST['academic_year'];
		//echo $_POST['gender'];
		
		/* 
		 * new account
		 */

		
		$_POST['password'] = password_hash($_POST["password"] ,PASSWORD_DEFAULT);

		$sql = "INSERT INTO User (name, password, email, phone, account, type) VALUES (?, ?, ?, ?, ?, ?)";

		$type = 'student';
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('sssiss' ,$_POST['name'] , $_POST['password'] , $_POST['email'] , $_POST['phone'] , $_POST['account'] , $type);
		$stmt->execute();	
		
		/*
		 * new system manager
		 */
		if ($_POST['type'] = 'System manager'){
			$sql = "INSERT INTO System_Manager (account) VALUES(?)";
			$stmt = $conn->prepare($sql);		
			$stmt->bind_param('s' , $_POST['account']);
			$stmt->execute();	
		}
		else{	
			$sql = "INSERT INTO Dormitory_Supervisor (account , dormitory_id) VALUES(?,?)";
			$stmt = $conn->prepare($sql);		
			$dormitory_id = null;
			$stmt->bind_param('si' , $_POST['account'] , $dormitory_id);
			$stmt->execute();	
		}
		
		header("Locaition: ./backstage.php");
        die();
	}
?>

