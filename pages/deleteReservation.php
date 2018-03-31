<?php
	include('config.php');

	$id = $_GET['id'];

	$sql = "DELETE FROM reservations WHERE reservation_id = '$id'";
	$result = mysqli_query($connection, $sql);

	header('location: booking.php');
?>