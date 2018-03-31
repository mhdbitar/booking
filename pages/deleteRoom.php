<?php
	include('config.php');

	$id = $_GET['id'];

	$sql = "DELETE FROM rooms WHERE id = '$id'";
	$result = mysqli_query($connection, $sql);

	header('location: room.php');
?>