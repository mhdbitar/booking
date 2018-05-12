<!DOCTYPE html>
<html>
<head>
  <title>Room Booking - Admin Page</title>
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
  <?php include('config.php'); ?>
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

  <h2>Reservations Management</h2>
  <div class="admin-links">
    <a href="room.php">Rooms</a>
    <a href="booking.php">Reservations</a>  
    <a href='timetable.php'>Timetable</a>
  </div>

  <?php
    $sql = "SELECT * FROM rooms";
    $result = mysqli_query($connection, $sql);
    $rooms = array();

    if ($result->num_rows > 0) { 
      while ($row = mysqli_fetch_assoc($result)) {
        $rooms[$row['id']] = $row['room_name'];
      }
    }
  ?>
  <div class="form-group">
      <label for="room">Room</label>
      <select name="room" id="room">
          <option>- Please select a room -</option>
          <?php foreach ($rooms as $key => $value) {
            echo "<option value='".$key."'>".$value."</option>";
          }?>
      </select>
    </div>
<div id='calendar'></div>

  

<script>
  $(document).ready(function () {
    $("body").on("change", "#room", function () {
      var room = $(this).val();
      $('#calendar').fullCalendar('removeEventSources');

      $.ajax({
            url: 'getReservations.php',
            type: "GET",
            data: {
              "room" : room
            },
            success: function(doc) {
              var data = JSON.parse(doc);
              var events = [];

              for (var i = 0; i < data.length; i++) {
                events.push({
                  id: i,
                  start: data[i].start,
                  end: data[i].end,
                  title: data[i].customer,
                });
              }
              
              $('#calendar').fullCalendar('addEventSource', events);        
            
            },
            error: function (e) {
              console.log(e);
            }
          });
        
    });

    $('#calendar').fullCalendar( {
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
            data: {
              "room" : 0
            },
            success: function(doc) {
              var data = JSON.parse(doc);
              var events = [];

              for (var i = 0; i < data.length; i++) {
                events.push({
                  id: i,
                  start: data[i].start,
                  end: data[i].end,
                  title: data[i].customer,
                });
              }
              
              callback(events);
            },
            error: function (e) {
              console.log(e);
            }
          });
        }
      });
  });

</script>
</body>
</html>