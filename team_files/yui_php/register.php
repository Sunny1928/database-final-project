

<form method="post" action="./register.php">
	
	<input required type="text" placeholder="Account" name="account">  <br>
  
	<input required type="password" placeholder="Password" name="password"> <br>  

	<input required type="text" placeholder="Name" name="name">  <br>
  
	<input required type="email" placeholder="Email" name="email">  <br>

  
	<input required type="tel" placeholder="Phone" name="phone">  <br>

	<input  type="radio" name="sex" value="male"> Male 
	<input  type="radio" name="sex" value="female"> Female

	



	<input type="submit" value="Login">

</form>

<a href="./"> Sign in</a>

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

//		$user_data = "('$_POST['account']', '$_POST['password']' , 

		$sql = "INSERT INTO User (name, password, email, phone, account, type) VALUES (?, ?, ?, ?, ?, ?)";

		$type = 'student';
		$stmt = $conn->prepare($sql);
//		$stmt->bind_param('ss' , $_POST['name'] , $_POST['password'] , $_POST['email'] , $_POST['phone'] , $_POST['account'] , 'student');
		$stmt->bind_param('sssiss' ,$_POST['name'] , $_POST['password'] , $_POST['email'] , $_POST['phone'] , $_POST['account'] , $type);
		

		$stmt->execute();	

		header("Location: ./index.php" , 301);
        die();

	}
?>
