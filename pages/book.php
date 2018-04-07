<?php
    include('config.php');
  
	$room_id = $_POST['room_id'];
	$date = $_POST['date'];
	$from = $_POST['from'];
	$to = $_POST['to'];
	$week = $_POST['week'];
	$month = $_POST['month'];
	$duration = $_POST['duration'];
	$start_week = $_POST['start_week'];
	
	if ($week != "0") {
		$date = new DateTime($_POST['date']);
		$thisMonth = $date->format('m');
		$i = 1;

		while ($date->format('m') === $thisMonth) {
			$sql = "INSERT INTO reservations (room_id, user_id, reservation_date, from_time, to_time) VALUES ('".$room_id."', '".$_SESSION['user_id']."', '".$date->format('Y-m-d')."', '".$from."', '".$to."')";
	  		$result = mysqli_query($connection, $sql);
		    $date->modify('next ' . $_GET['week']);
			if ($duration == $i) {
				break;
			}
			$i++;
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

		while ($date->format('y') === $thisYear) {
			$sql = "INSERT INTO reservations (room_id, user_id, reservation_date, from_time, to_time) VALUES ('".$room_id."', '".$_SESSION['user_id']."', '".$date->format('Y-m-d')."', '".$from."', '".$to."')";
	  		$result = mysqli_query($connection, $sql);
		    $date->modify('next month');
			if ($duration == $i) {
				break;
			}
			$i++;
		}						
	}

	if ($month == 0 && $week == 0) {
		$sql = "INSERT INTO reservations (room_id, user_id, reservation_date, from_time, to_time) VALUES ('".$room_id."', '".$_SESSION['user_id']."', '".$date."', '".$from."', '".$to."')";
		$result = mysqli_query($connection, $sql);
	}

	function week_number($date) 
	{ 
    	return ceil( date( 'j', strtotime( $date ) ) / 7 ); 
	}

	return true; 
?> 