<?php
	$location = "localhost"; 
	$account="root"; 
	$password=""; 
    $dbname = "school_db";

	$link=mysqli_connect($location,$account,$password,$dbname);

	if(!$link){
		die("無法連結資料庫");
	}

    echo "Connected successfully";
?>