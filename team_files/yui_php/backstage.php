<?php
	session_start();
#	echo 	isset($_SESSION["permission"]);
#	echo  $_SESSION["permission"];
#	echo  $_SESSION["account"];
	if (!isset($_SESSION["permission"]) || $_SESSION['permission']!="system_manager" || $_SESSION["account"] != "root"){
					
		Header("Location: ./backstage_login.php" , 301);
		die();
	}		
?>

<table>
    <thead>
        <tr>
            <th colspan="2"  align='middle'>System_Manager</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td align='middle'>account</th>
            <td align='middle'>name</th>
            
        </tr>
            
        <?php
            $servername = "localhost";
            $username = "a10955pysy";
            $password = "qwertyuiop";
            $dbname = "school_dormitory_db";
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
			echo "Connected successfully";
			            
			$sql = "SELECT * FROM System_Manager JOIN User ON User.account = System_Manager.account";
			$result = $conn->query($sql);

			if (mysqli_num_rows($result) > 0) 
			{
				while ($userinfo = mysqli_fetch_assoc($result)) 
				{
																			                    
					echo "<tr>" .
						"<td align='middle'> ". $userinfo['account'] ."</td> ".
						"<td align='middle'> " . $userinfo['name'] . "</td>".
						"</tr>";
				}
			}

									        
									        
		?>
    </tbody>
</table>

<table>
    <thead>
        <tr>
            <th colspan="2"  align='middle'>Student</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td align='middle'>account</th>
            <td align='middle'>name</th>
			<td align='middle'>student no</th>           
        </tr>
            
        <?php
                        

			$sql = "SELECT * FROM Student JOIN User ON Student.account = User.account";
			$result = $conn->query($sql);

			if (mysqli_num_rows($result) > 0) 
			{
				while ($userinfo = mysqli_fetch_assoc($result)) 
				{
																			                    
					echo "<tr>" .
						"<td align='middle'> ". $userinfo['account'] ."</td> ".
						"<td align='middle'> " . $userinfo['name'] . "</td>".
						"<td align='middle'> " . $userinfo['student_id'] . "</td>".
						"</tr>";
				}
			}

									        
									        
		?>
    </tbody>
</table>

<table>
    <thead>
        <tr>
            <th colspan="2"  align='middle'>Dormitory Supervisor</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td align='middle'>account</th>
            <td align='middle'>name</th>
			<td align='middle'>student no</th>           
        </tr>
            
        <?php
                        
						            
			$sql = "SELECT * FROM Dormitory_Supervisor JOIN User ON Dormitory_Supervisor.account = User.account";
			$result = $conn->query($sql);

			if (mysqli_num_rows($result) > 0) 
			{
				while ($userinfo = mysqli_fetch_assoc($result)) 
				{
																			                    
					echo "<tr>" .
						"<td align='middle'> ". $userinfo['account'] ."</td> ".
						"<td align='middle'> " . $userinfo['name'] . "</td>".
						"<td align='middle'> " . $userinfo['dormitory_id'] . "</td>".
						"</tr>";
				}
			}

									        
									        
		?>
    </tbody>
</table>

<h3>Create new user manager </h1>

<form method="post" action="./backstage_register.php">
	<select name="type"> 
		<option>System manager</option>
		<option>Dormitory Supervisor</option>
	</select><br>
	<input required type="text" placeholder="Account" name="account">  <br>
  
	<input required type="password" placeholder="Password" name="password"> <br>  

	<input required type="text" placeholder="Name" name="name">  <br>
  
	<input required type="email" placeholder="Email" name="email">  <br>

  
	<input required type="tel" placeholder="Phone" name="phone">  <br>


	<input type="submit" value="Create">

</form>
