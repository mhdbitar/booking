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

    $sql = "SELECT * FROM reservations WHERE room_id = '".$room_id."' AND reservation_date = '".$date."' AND from_time = '".$from."' OR to_time >= '".$from."'";
    $result = mysqli_query($connection, $sql);

    if ($result->num_rows == 0) {
        echo "<p style='color: green;'>This room is empty, please press on the book button <a href='javascript:void(0);' class='submit' data-room='".$room_id."' data-date='".$date."' data-from='".$from."' data-to='".$to."' data-week='0' data-month='0' data-duration='0' data-start_week='0'>Book</a> to reserve this room.</p>";
    } else {
      echo "<p style='color: red;'>Unfortunately this room is not empty, please press on the back button <a href='reservations.php'>Back</a> to research again for another room.</p>";
    }
  }

  if (isset($_POST['weekly-submit'])) {
        $room_id = $_POST['room'];
        $week = $_POST['week'];
        $date = $_POST['date'];
        $from = $_POST['from'];
        $to = $_POST['to'];
        $duration = $_POST['duration'];

        $sql = "SELECT * FROM reservations WHERE room_id = '".$room_id."' AND reservation_date = '".$date."' AND from_time = '".$from."' OR to_time >= '".$from."'";
        $result = mysqli_query($connection, $sql);

        if ($result->num_rows == 0) {
            echo "<p style='color: green;'>This room is empty, please press on the book button <a href='javascript:void(0);' class='submit' data-room='".$room_id."' data-date='".$date."' data-from='".$from."' data-to='".$to."' data-week='".$week."' data-month='0' data-duration='".$duration."' data-start_week='0'>Book</a> to reserve this room.</p>";
        } else {
          echo "<p style='color: red;'>Unfortunately this room is not empty, please press on the back button <a href='reservations.php'>Back</a> to research again for another room.</p>";
        }
  }

  if (isset($_POST['month-submit'])) {
        $room_id = $_POST['room'];
        $week = $_POST['week'];
        $date = $_POST['date'];
        $from = $_POST['from'];
        $to = $_POST['to'];
        $duration = $_POST['duration'];
        $start_week = $_POST['start_week'];

        $sql = "SELECT * FROM reservations WHERE room_id = '".$room_id."' AND reservation_date = '".$date."' AND from_time = '".$from."' OR to_time >= '".$from."'";
        $result = mysqli_query($connection, $sql);

        if ($result->num_rows == 0) {
            echo "<p style='color: green;'>This room is empty, please press on the book button <a href='javascript:void(0);' class='submit' data-room='".$room_id."' data-date='".$date."' data-from='".$from."' data-to='".$to."' data-week='0' data-month='".$week."' data-duration='".$duration."' data-start_week='".$start_week."'>Book</a> to reserve this room.</p>";
        } else {
          echo "<p style='color: red;'>Unfortunately this room is not empty, please press on the back button <a href='reservations.php'>Back</a> to research again for another room.</p>";
        }
  }
?>
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
<script type="text/javascript">
  $(document).ready(function () {
    $('body').on('click', '.submit', function () {
        var x = confirm("To continue the book please press on Ok button.");

        var room_id = $(this).data("room");
        var date = $(this).data("date");
        var from = $(this).data("from");
        var to = $(this).data("to");
        var week = $(this).data("week");
        var month = $(this).data("month");
        var duration = $(this).data("duration");
        var start_week = $(this).data("start_week");
        
        if (x == true) {
            window.location.replace("book.php?id="+room_id+"&date="+date+"&from="+from+"&to="+to+"&week="+week+"&month="+month+"&duration="+duration+"&start_week="+start_week);
        }
    });
  });
</script>
</body>
</html>
