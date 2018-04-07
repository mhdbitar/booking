<?php
	include('config.php');
	$id = $_GET['id'];

	$sql = "UPDATE reservations SET approved = '1' WHERE reservation_id = " . $id;
    $result = mysqli_query($connection, $sql);

    $sql = "SELECT * FROM users INNER JOIN reservations ON reservations.user_id = users.id WHERE reservations.reservation_id = " . $id;
 	$result = mysqli_query($connection, $sql);

 	$msg = "Your reservation is approved.";

 	$email = "";
 	while ($row = mysqli_fetch_assoc($result)) {
 		$email = $row['email'];
 	}

	mail($email, "Approved", $msg);

    header("location: booking.php");
?>