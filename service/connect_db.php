<!-- 連接資料庫 -->
<?php
    function connect_db(){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "school_dormitory_db";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
    
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

		// echo "Connected successfully";

        return $conn;
    }
?>