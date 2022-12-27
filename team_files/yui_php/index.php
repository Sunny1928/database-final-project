<form action="./login.php" method="post">

	<input required type="text" placeholder="Account" name="account">  
  
	<input required type="password" placeholder="Password" name="password">  

	<input type="submit" value="Login">
  	

</form>

<?php

session_start();

if (isset($_SESSION["permission"]) && $_SESSION["permission"] == "Error"){
	echo "Account or Password Wrong";
}

?>


<a href="./register.php" >Sign Up</a>
