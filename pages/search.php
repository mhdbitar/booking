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
<?php
  
  if (isset($_POST['single-submit'])) 
  {
    $room_id = $_POST['room'];
    $date = $_POST['date'];
    $from = $_POST['from'];
    $to = $_POST['to'];

    $sql = "SELECT * FROM reservations WHERE room_id = '".$room_id."' AND reservation_date = '".$date."' AND from_time = '".$from."' AND to_time = '".$to."' AND week = NULL AND month = NULL AND repeat_week = 0 AND repeat_month = 0";
    $result = mysqli_query($connection, $sql);

    if ($result->num_rows == 0) {
        echo "<p style='color: green;'>This room is empty, please press on the book button <a href='book.php?id=".$room_id."&date=".$date."&from=".$from."&to=".$to."'>BOOK</a> to reserve this room.</p>";
    } else {
      echo "<p style='color: red;'>Unfortunately this room is not empty, please press on the back button <a href='../index.php'>Back</a> to research again for another room.</p>";
    }
  }

  if (isset($_POST['weekly-submit'])) {
        $room_id = $_POST['room'];
        $week = $_POST['week'];
        $date = $_POST['date'];
        $from = $_POST['from'];
        $to = $_POST['to'];

        $sql = "SELECT * FROM reservations WHERE room_id = '".$room_id."' AND reservation_date = '".$date."' AND from_time = '".$from."' AND to_time = '".$to."' AND week = '".$week."'";
        $result = mysqli_query($connection, $sql);

        if ($result->num_rows == 0) {
            echo "<p style='color: green;'>This room is empty, please press on the book button <a href='book.php?id=".$room_id."&date=".$date."&from=".$from."&to=".$to."'>BOOK</a> to reserve this room.</p>";
        } else {
          echo "<p style='color: red;'>Unfortunately this room is not empty, please press on the back button <a href='../index.php'>Back</a> to research again for another room.</p>";
        }
  }

  if (isset($_POST['month-submit'])) {
        $room_id = $_POST['room'];
        $week = $_POST['week'];
        $date = $_POST['date'];
        $from = $_POST['from'];
        $to = $_POST['to'];

        $sql = "SELECT * FROM reservations WHERE room_id = '".$room_id."' AND reservation_date = '".$date."' AND from_time = '".$from."' AND to_time = '".$to."' AND week = '".$week."'";
        $result = mysqli_query($connection, $sql);

        if ($result->num_rows == 0) {
            echo "<p style='color: green;'>This room is empty, please press on the book button <a href='book.php?id=".$room_id."&date=".$date."&from=".$from."&to=".$to."'>BOOK</a> to reserve this room.</p>";
        } else {
          echo "<p style='color: red;'>Unfortunately this room is not empty, please press on the back button <a href='../index.php'>Back</a> to research again for another room.</p>";
        }
  }
?>
</body>
</html>
