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
		$date = strtotime($date);
		$date =  date('Y-m-d', $date);

		$dayOfDate = date('l', strtotime($date));
		$dayOfDate1 = date('N', strtotime($date));

		if ($dayOfDate == $week) {
			$date = new DateTime($date);
			$thisMonth = $date->format('m');
			$i = 1;

			while ($duration >= $i) {
				$sql = "INSERT INTO reservations (room_id, user_id, reservation_date, from_time, to_time) VALUES ('".$room_id."', '".$_SESSION['user_id']."', '".$date->format('Y-m-d')."', '".$from."', '".$to."')";
		  		$result = mysqli_query($connection, $sql);
			    $date->modify('next ' . $week);
			    
				$i++;
			}

			set_notification($i, $_SESSION['user_name'], $room_id, $connection);
			    
			echo json_encode("true");
		} else {
			echo json_encode("Day does not match the start date.");	
		}
	}

	if ($month != "0") {
		$week_num = week_number($date);
		$num = abs($week_num - $start_week) * 7;
		$date = strtotime($date);
		$date = strtotime("+$num day", $date);
		$date =  date('Y-m-d', $date);
		$dayOfDate = date('l', strtotime($date));
		$dayOfDate1 = date('N', strtotime($date));

		if ($dayOfDate == $month) {
			$date = new DateTime($date);
			$thisYear = $date->format('y');
			$i = 1; 

			while ($date->format('y') === $thisYear) {
				$sql = "INSERT INTO reservations (room_id, user_id, reservation_date, from_time, to_time) VALUES ('".$room_id."', '".$_SESSION['user_id']."', '".$date->format('Y-m-d')."', '".$from."', '".$to."')";
		  		$result = mysqli_query($connection, $sql);
			    $date->modify('next month');

	    		$getDay = date('N', strtotime($date->format('Y-m-d')));
			    $days = $dayOfDate1 - $getDay;

				if ($days < 0) {
			    	$days = abs($days);
			    	$date = date_create($date->format('Y-m-d'));
					date_sub($date, date_interval_create_from_date_string($days." days"));
					$date = date_format($date,"Y-m-d");
				    $date = new DateTime($date);
		
			    } else {
			    	$date = date_create($date->format('Y-m-d'));
					date_add($date, date_interval_create_from_date_string($days." days"));
					$date = date_format($date,"Y-m-d");
			    	$date = new DateTime($date); 	
			    }
				if ($duration == $i) {
					break;
				}
				$i++;
			}

			set_notification($i, $_SESSION['user_name'], $room_id, $connection);

			echo json_encode("true");
			
		} else {
			echo json_encode("Day does not match the start date.");
		}						
	}

	if ($month == 0 && $week == 0) {
		$sql = "INSERT INTO reservations (room_id, user_id, reservation_date, from_time, to_time) VALUES ('".$room_id."', '".$_SESSION['user_id']."', '".$date."', '".$from."', '".$to."')";
		$result = mysqli_query($connection, $sql);
		set_notification(1, $_SESSION['user_name'], $room_id, $connection);
		if ($result) {
			echo json_encode("true");
		}
	}

	function week_number($date) 
	{ 
    	return ceil( date( 'j', strtotime( $date ) ) / 7 ); 
	} 

	function set_notification ($i, $user_name, $room_number, $connection) {			
		$sql = "SELECT * FROM rooms WHERE id = " . $room_number;	
		$room = mysqli_query($connection, $sql);
		
		while ($row = mysqli_fetch_assoc($room)) {
	   		$room_number = $row['room_number'];  		
	    }

	    for ($j = 0; $j < $i; $j++) {
		    $sql = "INSERT INTO notifications (customer, room) VALUES ('".$user_name."', '".$room_number."')";
			$result = mysqli_query($connection, $sql);		  	
	    }
	}
?> 