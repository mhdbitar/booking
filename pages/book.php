<!DOCTYPE html>
<html>
<head>
	<title>Room Booking</title>

	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
	<?php
    include('config.php');
  ?>
  <ul>
    <li><a href="../index.php" class="active">Home</a></li>
    <li><a href="register.php">Regsiter</a></li>
    <?php if (isset($_SESSION['login'])) { ?>
      <li><a href="reservations.php">Reservations</a></li>
      <li><a href="logout.php">Logout</a></li>
      
      <?php if (isset($_SESSION['is_admin']) && ($_SESSION['is_admin'] == "1")) { ?>
        <li><a href="admin.php">Admin</a></li>
      <?php } ?>
    
    <?php } else { ?>
      <li><a href="login.php">Login</a></li>
    <?php } ?>

      <li><a href="rooms.php">Rooms</a></li>
  </ul>

	<h2>Book Here</h2>
	<p>Please insert your information to book this room.</p>
	<?php

		$room_id = $_GET['id'];
		$date = $_GET['date'];
		$from = $_GET['from'];
		$to = $_GET['to'];
		
		if (isset($_POST['submit']))
		{
			$name = $_POST['name'];
			$notes = $_POST['notes'];
			$repeat_week = $_POST['repeat_week'];
			$repeat_month = $_POST['repeat_month'];

			$week = date('w', strtotime($date));
			$month = date('m', strtotime($date));
			
      		$sql = "INSERT INTO reservations (room_id, reservation_date, from_time, to_time, name, notes, week, month, repeat_week, repeat_month) VALUES ('".$room_id."', '".$date."', '".$from."', '".$to."', '".$name."', '".$notes."', '".$week."', '".$month."', '".$repeat_week."', '".$repeat_month."')";
      
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

		<div class="form-group">
			<label for="repeat_week">Frequency - Week</label>
			<select name="repeat_week">
				<option value="0">No</option>
				<option value="1">Yes</option>
			</select>
		</div>

		<div class="form-group">
			<label for="repeat_month">Frequency - Month</label>
			<select name="repeat_month">
				<option value="0">No</option>
				<option value="1">Yes</option>
			</select>
		</div>

		<input type="submit" name="submit" value="Submit">
	</form>
</body>
</html>