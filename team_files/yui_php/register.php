<<<<<<< HEAD




=======
>>>>>>> 86d78bed97f3b3473dab82fc57f24c526699da10
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
<<<<<<< HEAD
		echo "Connected successfully";
		
		//echo $_POST['academic_year'];
		//echo $_POST['gender'];
		
		/* 
		 * new account
		 */
=======
	    echo "Connected successfully";
>>>>>>> 86d78bed97f3b3473dab82fc57f24c526699da10
		
		$_POST['password'] = password_hash($_POST["password"] ,PASSWORD_DEFAULT);

		$sql = "INSERT INTO User (name, password, email, phone, account, type) VALUES (?, ?, ?, ?, ?, ?)";

		$type = 'student';
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('sssiss' ,$_POST['name'] , $_POST['password'] , $_POST['email'] , $_POST['phone'] , $_POST['account'] , $type);
<<<<<<< HEAD
=======

>>>>>>> 86d78bed97f3b3473dab82fc57f24c526699da10
		$stmt->execute();	
		
		/*
		 * new student
		 */

<<<<<<< HEAD
		$sql = "INSERT INTO Student (academic_year , student_id ,major_year , gender , account) VALUES(?, ?, ?, ?, ?)";
		$stmt = $conn->prepare($sql);		
		$stmt->bind_param('isiss' ,$_POST['academic_year'] , $_POST['student_id'] , $_POST['major_year'] , $_POST['gender'] , $_POST['account']);
		$stmt->execute();	
	
		
		header("Locaition: ../login_view.php" , 301);
=======
		header("Location: ../login_view.php" , 301);
>>>>>>> 86d78bed97f3b3473dab82fc57f24c526699da10
        die();
	}
?>

