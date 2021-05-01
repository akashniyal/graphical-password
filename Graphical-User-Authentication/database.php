<?php
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'auth';

/*
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($link == false)
{
	die("Error: Could not connect to database");
}
*/
$link=mysqli_connect($server,$username,$password,$database);
	if(!$link){
		echo 'Connection failed !';
}
?>
