<?php
	include('config.php');

	$id = $_GET['id'];

	$sql = "DELETE FROM movies WHERE movie_id = '$id'";
	$result = mysqli_query($connection, $sql);

	header('location: admin.php');
?>