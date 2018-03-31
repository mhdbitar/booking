<?php
	define("HOST", "localhost");
	define("USER", "root");
	define("PASSWORD", "");
	define("DATABASE", "booking");

	//Start session
	session_start();

	//Create connection
	$connection = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
?>