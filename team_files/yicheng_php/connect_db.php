<!-- 連接資料庫 -->
<?php
    function connect_db(){
        $servername = "127.0.0.1";
        $username = "root";
        $password = "12345678";
        $dbname = "school_dormitory_db";
        $port = 3307;
        $conn = mysqli_connect($servername, $username, $password, $dbname,$port);
    
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        return $conn;
    }
?>