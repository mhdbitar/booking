<!DOCTYPE html>
<html>
<head>
  <title>Room Booking</title>

  <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>

</body>
</html>
<?php
  include('config.php');
  
  if (isset($_POST['single-submit'])) 
  {
    $room_id = $_POST['room'];
    $date = $_POST['date'];
    $from = $_POST['from'];
    $to = $_POST['to'];

    $sql = "SELECT * FROM reservations WHERE room_id = '".$room_id."' AND reservation_date = '".$date."' AND from_time = '".$from."' AND to_time = '".$to."'";
    $result = mysqli_query($connection, $sql);

    if ($result->num_rows == 0) {
        echo "<p style='color: green;'>This room is empty, please press on the book button <a href='book.php?id=".$room_id."&date=".$date."&from=".$from."&to=".$to."'>BOOK</a> to reserve this room.</p>";
    } else {
      echo "<p style='color: red;'>Unfortunately this room is not empty, please press on the back button <a href='../index.php'>Back</a> to research again for another room.</p>";
    }
  }
?>