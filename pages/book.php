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
	 
	<?php

		$room_id = $_GET['id'];
		$date = $_GET['date'];
		$from = $_GET['from'];
		$to = $_GET['to'];
		$week = $_GET['week'];
		$month = $_GET['month'];
		$duration = $_GET['duration'];
		$start_week = $_GET['start_week'];
		
		if ($week != "0") {
			$date = new DateTime($_GET['date']);
			$thisMonth = $date->format('m');
			$i = 1;

			$sql = "SELECT * FROM reservations WHERE room_id = '".$room_id."' AND reservation_date = '".$date->format('Y-m-d')."'";
			$result = mysqli_query($connection, $sql);

			if ($result->num_rows == 0) {
				while ($date->format('m') === $thisMonth) {
					$sql = "INSERT INTO reservations (room_id, user_id, reservation_date, from_time, to_time) VALUES ('".$room_id."', '".$_SESSION['user_id']."', '".$date->format('Y-m-d')."', '".$from."', '".$to."')";
			  		$result = mysqli_query($connection, $sql);
				    $date->modify('next ' . $_GET['week']);
					if ($duration == $i) {
						break;
					}
					$i++;
				}
			} else {
				echo "<p style='color: red;'>You can not book this room, this room is booked by someone else.</p>";
			}
		}

		if ($month != "0") {
			$week_num = week_number($date);
			$num = abs($week_num - $start_week) * 7;
			$date = strtotime($date);
			$date = strtotime("+$num day", $date);
			$date =  date('Y-m-d', $date);

			$date = new DateTime($date);
			$thisYear = $date->format('y');
			$i = 1; 

			$sql = "SELECT * FROM reservations WHERE room_id = '".$room_id."' AND reservation_date = '".$date->format('Y-m-d')."'";
			$result = mysqli_query($connection, $sql);

			if ($result->num_rows == 0) {
				while ($date->format('y') === $thisYear) {
					$sql = "INSERT INTO reservations (room_id, user_id, reservation_date, from_time, to_time) VALUES ('".$room_id."', '".$_SESSION['user_id']."', '".$date->format('Y-m-d')."', '".$from."', '".$to."')";
			  		$result = mysqli_query($connection, $sql);
				    $date->modify('next month');
					if ($duration == $i) {
						break;
					}
					$i++;
				}
			} else {
				echo "<p style='color: red;'>You can not book this room, this room is booked by someone else.</p>";
			}
						
		}

		if ($month == 0 && $week == 0) {
			$sql = "SELECT * FROM reservations WHERE room_id = '".$room_id."' AND reservation_date = '".$date."'";
			$result = mysqli_query($connection, $sql);
			
			if ($result->num_rows == 0) {
				$sql = "INSERT INTO reservations (room_id, user_id, reservation_date, from_time, to_time) VALUES ('".$room_id."', '".$_SESSION['user_id']."', '".$date."', '".$from."', '".$to."')";
				$result = mysqli_query($connection, $sql);
			} else {
				echo "<p style='color: red;'>You can not book this room, this room is booked by someone else.</p>";
			}
		}

		function week_number($date) 
		{ 
	    	return ceil( date( 'j', strtotime( $date ) ) / 7 ); 
		} 
	?>  
	
</body>
</html>