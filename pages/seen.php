<?php
	include('config.php');
	
	$id = $_GET['id'];
	
	$sql = "UPDATE notifications SET seen = 1 WHERE id = " . $id;
    $result = mysqli_query($connection, $sql);

    header("location: notification.php");
?>