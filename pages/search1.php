<!DOCTYPE html>
<html>
<head>
  <title>Room Booking</title>

  <link href='../js/lib/fullcalendar.min.css' rel='stylesheet' />
  <link href='../js/lib/fullcalendar.print.min.css' rel='stylesheet' media='print' />
  <link href='../js/scheduler.min.css' rel='stylesheet' />
  <script src='../js/lib/moment.min.js'></script>
  <script src='../js/lib/jquery.min.js'></script>
  <script src='../js/lib/fullcalendar.min.js'></script>
  <script src='../js/scheduler.min.js'></script>
  <link rel="stylesheet" type="text/css" href="../css/fontawesome-all.min.css">
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
        <?php
          $sql = "SELECT * FROM notifications WHERE seen = 0";
          $result = mysqli_query($connection, $sql);
        ?>
        <li style="float:right;"><a href="notification.php"><i class="fas fa-bell"></i> <?=  $result->num_rows > 0 ? $result->num_rows : "" ?>
          </a></li>
      <?php } ?>
    
    <?php } else { ?>
      <li><a href="login.php">Login</a></li>
    <?php } ?>

    <li><a href="rooms.php">Rooms</a></li>
  </ul>
<?php

  $flag = false;
  
  if (isset($_POST['single-submit'])) 
  {
    $room_id = $_POST['room'];
    $date = $_POST['date'];
    $from = $_POST['from'];
    $to = $_POST['to'];
    $user = $_GET['id'];

    $sql = "SELECT * FROM reservations WHERE room_id = '".$room_id."' AND reservation_date = '".$date."' AND from_time = '".$from."' AND to_time >= '".$from."'";
    $result = mysqli_query($connection, $sql);

    if ($result->num_rows == 0) {
        echo "<p style='color: green;'>This room is empty, please press on the book button <a href='javascript:void(0);' class='submit' data-room='".$room_id."' data-date='".$date."' data-from='".$from."' data-to='".$to."' data-week='0' data-month='0' data-duration='0' data-start_week='0' data-user='".$user."'>Book</a> to reserve this room.</p>";
        $flag = true;
    } else {
      echo "<p style='color: red;'>Unfortunately this room is not empty, please press on the back button <a href='reserve.php'>Back</a> to research again for another room.</p>";
    }
  }

  if (isset($_POST['weekly-submit'])) {
        $room_id = $_POST['room'];
        $week = $_POST['week'];
        $date = $_POST['date'];
        $from = $_POST['from'];
        $to = $_POST['to'];
        $duration = $_POST['duration'];
        $user = $_GET['id'];

        $sql = "SELECT * FROM reservations WHERE room_id = '".$room_id."' AND reservation_date = '".$date."' AND from_time = '".$from."' AND to_time >= '".$from."'";
        $result = mysqli_query($connection, $sql);

        if ($result->num_rows == 0) {
            echo "<p style='color: green;'>This room is empty, please press on the book button <a href='javascript:void(0);' class='submit' data-room='".$room_id."' data-date='".$date."' data-from='".$from."' data-to='".$to."' data-week='".$week."' data-month='0' data-duration='".$duration."' data-start_week='0'  data-user='".$user."'>Book</a> to reserve this room.</p>";
            $flag = true;
        } else {
          echo "<p style='color: red;'>Unfortunately this room is not empty, please press on the back button <a href='reserve.php'>Back</a> to research again for another room.</p>";
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
        $user = $_GET['id'];

        $sql = "SELECT * FROM reservations WHERE room_id = '".$room_id."' AND reservation_date = '".$date."' AND from_time = '".$from."' AND to_time >= '".$from."'";
        $result = mysqli_query($connection, $sql);

        if ($result->num_rows == 0) {
            echo "<p style='color: green;'>This room is empty, please press on the book button <a href='javascript:void(0);' class='submit' data-room='".$room_id."' data-date='".$date."' data-from='".$from."' data-to='".$to."' data-week='0' data-month='".$week."' data-duration='".$duration."' data-start_week='".$start_week."'  data-user='".$user."'>Book</a> to reserve this room.</p>";
            $flag = true;
        } else {
          echo "<p style='color: red;'>Unfortunately this room is not empty, please press on the back button <a href='reserve.php'>Back</a> to research again for another room.</p>";
        }
  }
?>
<div id='calendar'></div>
<!-- <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script> -->
  <script>

  $(function() { // document ready

    $('#calendar').fullCalendar({
      editable: false, // enable draggable events
      aspectRatio: 1.8,
      scrollTime: '00:00', // undo default 6am scrollTime
      header: {
        left: 'today prev,next',
        center: 'title',
        right: 'timelineDay,agendaWeek,month'
      },
      // defaultView: 'timelineDay',
      views: {
        timelineThreeDays: {
          type: 'timeline',
          duration: { days: 3 }
        }
      },
      events: function(start, end, timezone, callback) {
        $.ajax({
          url: 'getReservations.php',
          type: "GET",
          success: function(doc) {
            var data = JSON.parse(doc);
            var events = [];

            for (var i = 0; i < data.length; i++) {
              events.push({
                id: i,
                start: data[i].start,
                end: data[i].end,
                title: "Customer name : " + data[i].customer + "\nRoom: " + data[i].room_number,
                color  : 'red'
              });
            }
            events.push({
              title: 'Your Search',
              start: "<?= $_POST['date']; ?>"
            });  
            callback(events);
          },
          error: function (e) {
            console.log(e);
          }
        });
      },
      eventColor: '#378006',
    });
  
  });

</script>
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
        var user = $(this).data("user");
        
        if (x == true) {
          $.ajax({
            type: "POST",
            url: "book1.php",
            data: {
              room_id: room_id,
              date: date,
              from: from,
              to: to,
              week: week,
              month: month,
              duration: duration,
              start_week: start_week,
              user: user
            },
            success: function (data) {
              location.replace("users.php");
            },
            error: function (error) {
              console.log("the error: " + error);
            }
          });
        }
    });
  });
</script>


</body>
</html>
