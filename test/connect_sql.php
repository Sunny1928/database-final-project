<?php
    function connect_sql(){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "school_dormitory_db";
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        return $conn;
    }
?>

