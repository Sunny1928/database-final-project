<?php
    function connect_sql(){
        $servername = "localhost";
        $username = "a10955pysy";
        $password = "qwertyuiop";
        $dbname = "school_dormitory_db";
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        return $conn;
    }
?>

