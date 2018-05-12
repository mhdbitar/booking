<?php
  include('config.php');

  $room = $_GET['room'];
  $sql = "";

  if ($room != 0) {
    $sql = "SELECT * FROM reservations INNER JOIN rooms ON reservations.room_id = rooms.id INNER JOIN users ON users.id = reservations.user_id WHERE reservations.room_id = " . $_GET['room'];
  } else {
    $sql = "SELECT * FROM reservations INNER JOIN rooms ON reservations.room_id = rooms.id INNER JOIN users ON users.id = reservations.user_id";
  }
  $rooms = mysqli_query($connection, $sql);
  
  $array = array();

  if ($rooms->num_rows > 0) { 
    while ($row = mysqli_fetch_assoc($rooms)) {
       $from = 12;
       $to = 12;

       switch ($row['from_time']) {
         case '9':
           $from = 'T09:00:00';
           break;
        case '10':
           $from = 'T10:00:00';
           break;
        case '11':
           $from = 'T11:00:00';
           break;
        case '12':
           $from = 'T12:00:00';
           break; 
        case '13':
           $from = 'T01:00:00';
           break;
        case '14':
           $from = 'T02:00:00';
           break;
        case '15':
           $from = 'T03:00:00';
           break;
        case '16':
           $from = 'T04:00:00';
           break;
        case '17':
           $from = 'T05:00:00';
           break;
        case '18':
           $from = 'T06:00:00';
           break;
        case '19':
           $from = 'T07:00:00';
           break;
        case '20':
           $from = 'T08:00:00';
           break;
        case '21':
           $from = 'T09:00:00';
           break;
       }

       switch ($row['to_time']) {
         case '9':
           $to = 'T09:00:00';
           break;
        case '10':
           $to = 'T10:00:00';
           break;
        case '11':
           $to = 'T11:00:00';
           break;
        case '12':
           $to = 'T12:00:00';
           break; 
        case '13':
           $to = 'T01:00:00';
           break;
        case '14':
           $to = 'T02:00:00';
           break;
        case '15':
           $to = 'T03:00:00';
           break;
        case '16':
           $to = 'T04:00:00';
           break;
        case '17':
           $to = 'T05:00:00';
           break;
        case '18':
           $to = 'T06:00:00';
           break;
        case '19':
           $to = 'T07:00:00';
           break;
        case '20':
           $to = 'T08:00:00';
           break;
        case '21':
           $to = 'T09:00:00';
           break;
       }
       $temp = array(
          'customer' => $row['full_name'],
          'room_number' => $row['room_number'],
          'start' => $row['reservation_date'] . $from,
          'end' => $row['reservation_date'] . $to
       );

       array_push($array, $temp);
     }
  }

  echo json_encode($array);
?>