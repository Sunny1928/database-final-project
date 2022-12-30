
<form method="post" action="./backstage_login.php">
    <input required type="text" placeholder="Account" name="account">  <br>
    <input required type="password" placeholder="Password" name="password"> <br>  
    <input type="submit" value="Login">
</form>


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




        $sql = "SELECT * FROM User WHERE account ='root'";

        $result = $conn->query($sql);

        if ($result->num_rows <= 0)
        {
            echo "NO root account , Auto create...";
            $sql = "INSERT INTO User (name, password, email, phone, account, type) VALUES (?, ?, ?, ?, ?, ?)";

            $root = "root";
            $password = password_hash("root" ,PASSWORD_DEFAULT);  
            $email = "X";
            $phone = 0;
            $type = "system_manager";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('sssiss' ,$root , $password , $email , $phone , $root , $type);
            $stmt->execute();

            $sql = "INSERT INTO System_Manager (account) VALUES (?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s' ,$root);
            $stmt->execute();


        }

?>

