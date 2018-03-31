<!DOCTYPE html>
<html>
<head>
	<title>Room Booking</title>

	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
	<h2>Book Here</h2>
	<p>Please insert your information to book this room.</p>
	<?php
		include('config.php');
		$room_id = $_GET['id'];
		$date = $_GET['date'];
		$from = $_GET['from'];
		$to = $_GET['to'];
		
		if (isset($_POST['submit']))
		{
			$name = $_POST['name'];
			$notes = $_POST['notes'];

      		$sql = "INSERT INTO reservations (room_id, reservation_date, from_time, to_time, name, notes) VALUES ('".$room_id."', '".$date."', '".$from."', '".$to."', '".$name."', '".$notes."')";
      
      		$result = mysqli_query($connection, $sql);

	      	if ($result) {
	        	echo "<p style='color: green;'>This room is reserved by you.</p>";
	      	} else {
	          echo "<p style='color: red;'>Something went wrong, please try again.</p>";
	      	}
		}
	?>
	<form action="book.php?id=<?= $room_id ?>&date=<?= $date ?>&from=<?= $from ?>&to=<?= $to ?>" method="post">
		<div class="form-group">
			<label for="name">Customer Name</label>
			<input type="text" name="name" placeholder="Please Enter Customer Name">
		</div>

		<div class="form-group">
			<label for="notes">Customer Notes</label>
			<textarea name="notes" id="notes" placeholder="Please Enter your notes."></textarea>
		</div>

		<input type="submit" name="submit" value="Submit">
	</form>
</body>
</html>