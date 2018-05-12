<!DOCTYPE html>
<html>
<head>
  <title>Room Booking</title>

  <link rel="stylesheet" type="text/css" href="../css/fontawesome-all.min.css">
  <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<style type="text/css">
      body {
        background-color: #4bf5131f;
      }

      ul {
          list-style-type: none;
          margin: 0;
          padding: 0;
          overflow: hidden;
          background-color: #333;
      }

      li {
          float: left;
      }

      li a {
          display: block;
          color: white;
          text-align: center;
          padding: 14px 16px;
          text-decoration: none;
      }

      li a:hover:not(.active) {
          background-color: #111;
      }

      .active {
          background-color: #4CAF50;
      }

      .jumbotron { 
          padding: 30px; /* fills out the jumbotron */
          background-color: #11111138;
        }

        .jumbotron h1, .jumbotron p {
          color: #fff;
          text-align: center;
        }
  </style>
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
  <h1>RESERVATION</h1>
  <h3>Please fill in the booking details as you wish</h3>

  

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

  <h2>Single Booking</h2>
  
  <form action="search.php" method="post">
    <div class="form-group">
      <label for="room">Room</label>
      <select name="room" id="room">
          <option>- Please select a room -</option>
          <?php foreach ($rooms as $key => $value) {
            echo "<option value='".$key."'>".$value."</option>";
          }?>
      </select>
    </div>
    <div class="form-group">
      <label for="single-date">Date</label>
      <input type="date" id="single-date" name="date">      
    </div>

    <div class="form-group">
      <label for="single-time">Time</label>
      <select name="from">
        <option value="9">09:00 AM</option>
        <option value="10">10:00 AM</option>
        <option value="11">11:00 AM</option>
        <option value="12">12:00 AM</option>
        <option value="13">01:00 PM</option>
        <option value="14">02:00 PM</option>
        <option value="15">03:00 PM</option>
        <option value="16">04:00 PM</option>
        <option value="17">05:00 PM</option>
        <option value="18">06:00 PM</option>
        <option value="19">07:00 PM</option>
        <option value="20">08:00 PM</option>
        <option value="21">09:00 PM</option>
      </select>

      <select name="to">
        <option value="9">09:00 AM</option>
        <option value="10">10:00 AM</option>
        <option value="11">11:00 AM</option>
        <option value="12">12:00 AM</option>
        <option value="13">01:00 PM</option>
        <option value="14">02:00 PM</option>
        <option value="15">03:00 PM</option>
        <option value="16">04:00 PM</option>
        <option value="17">05:00 PM</option>
        <option value="18">06:00 PM</option>
        <option value="19">07:00 PM</option>
        <option value="20">08:00 PM</option>
        <option value="21">09:00 PM</option>
      </select>
    </div>

    <input type="submit" name="single-submit" value="Search">
  </form>


  <h2>Regular Booking (Weekly)</h2>
  <form action="search.php" method="post" name="weekForm" onsubmit="return check()">
    <div class="form-group">
      <label for="room">Room</label>
      <select name="room" id="room">
          <option>- Please select a room -</option>
          <?php foreach ($rooms as $key => $value) {
            echo "<option value='".$key."'>".$value."</option>";
          }?>
      </select>
    </div>

    <div class="form-group">
      <label for="week">Every</label>
      <select name="week" id="week">
        <option value="Monday">Monday</option>
        <option value="Tuesday">Tuesday</option>
        <option value="Wednesday">Wednesday</option>
        <option value="Thursday">Thursday</option>
        <option value="Friday">Friday</option>
        <option value="Saturday">Saturday</option>
        <option value="Sunday">Sunday</option>
      </select>
    </div>
    
    <div class="form-group">
      <p style="color: #ff0000fa; font-style: italic; font-size: 16px;">Note: Start Date should be the equal to the selected day above.</p>
      <label for="date">Start Date</label>
      <input type="date" id="date" name="date">      
    </div>

    <div class="form-group">
      <label for="duration">Duration</label>
      <input type="number" id="duration" name="duration">
    </div>

    <div class="form-group">
      <label for="weekly-time">Time</label>
      <select name="from">
        <option value="9">09:00 AM</option>
        <option value="10">10:00 AM</option>
        <option value="11">11:00 AM</option>
        <option value="12">12:00 AM</option>
        <option value="13">01:00 PM</option>
        <option value="14">02:00 PM</option>
        <option value="15">03:00 PM</option>
        <option value="16">04:00 PM</option>
        <option value="17">05:00 PM</option>
        <option value="18">06:00 PM</option>
        <option value="19">07:00 PM</option>
        <option value="20">08:00 PM</option>
        <option value="21">09:00 PM</option>
      </select>

      <select name="to">
        <option value="9">09:00 AM</option>
        <option value="10">10:00 AM</option>
        <option value="11">11:00 AM</option>
        <option value="12">12:00 AM</option>
        <option value="13">01:00 PM</option>
        <option value="14">02:00 PM</option>
        <option value="15">03:00 PM</option>
        <option value="16">04:00 PM</option>
        <option value="17">05:00 PM</option>
        <option value="18">06:00 PM</option>
        <option value="19">07:00 PM</option>
        <option value="20">08:00 PM</option>
        <option value="21">09:00 PM</option>
      </select>
    </div>

    <input type="submit" name="weekly-submit" value="Search">
  </form>

    <h2>Regular Booking (Monthly)</h2>
  <form action="search.php" method="post" name="monthForm" onsubmit="return checkMonth()">
    <div class="form-group">
      <label for="room">Room</label>
      <select name="room" id="room">
          <option>- Please select a room -</option>
          <?php foreach ($rooms as $key => $value) {
            echo "<option value='".$key."'>".$value."</option>";
          }?>
      </select>
    </div>

    <div class="form-group">
      <label for="every-month">Every</label>
      <select name="week" id="every-month">
        <option value="Monday">Monday</option>
        <option value="Tuesday">Tuesday</option>
        <option value="Wednesday">Wednesday</option>
        <option value="Thursday">Thursday</option>
        <option value="Friday">Friday</option>
        <option value="Saturday">Saturday</option>
        <option value="Sunday">Sunday</option>
      </select>
    </div>

    <div class="form-group">
      <label for="duration">Duration</label>
      <input type="number" id="duration" name="duration">
    </div>
    
    <div class="form-group">
      <label for="date">Start Date</label>
      <input type="date" id="date" name="date">      
    </div>

    <div class="form-group">
      <label for="start_week">Start Week</label>
      <input type="number" id="start_week" name="start_week">
    </div>

    <div class="form-group">
      <label for="time">Time</label>
      <select name="from">
        <option value="9">09:00 AM</option>
        <option value="10">10:00 AM</option>
        <option value="11">11:00 AM</option>
        <option value="12">12:00 AM</option>
        <option value="13">01:00 PM</option>
        <option value="14">02:00 PM</option>
        <option value="15">03:00 PM</option>
        <option value="16">04:00 PM</option>
        <option value="17">05:00 PM</option>
        <option value="18">06:00 PM</option>
        <option value="19">07:00 PM</option>
        <option value="20">08:00 PM</option>
        <option value="21">09:00 PM</option>
      </select>

      <select name="to">
        <option value="9">09:00 AM</option>
        <option value="10">10:00 AM</option>
        <option value="11">11:00 AM</option>
        <option value="12">12:00 AM</option>
        <option value="13">01:00 PM</option>
        <option value="14">02:00 PM</option>
        <option value="15">03:00 PM</option>
        <option value="16">04:00 PM</option>
        <option value="17">05:00 PM</option>
        <option value="18">06:00 PM</option>
        <option value="19">07:00 PM</option>
        <option value="20">08:00 PM</option>
        <option value="21">09:00 PM</option>
      </select>
    </div>

    <input type="submit" name="month-submit" value="Search">
  </form>

  <script type="text/javascript">
    function check() {
      var week = document.forms["weekForm"]["week"].value;
      var date = document.forms["weekForm"]["date"].value;
      
      var newDate = new Date(date);
      var weekday = [];
      weekday[0] = "Sunday";
      weekday[1] = "Monday";
      weekday[2] = "Tuesday";
      weekday[3] = "Wednesday";
      weekday[4] = "Thursday";
      weekday[5] = "Friday";
      weekday[6] = "Saturday";
      
      var wd = weekday[newDate.getDay()];
    
      if (wd != week) {
          alert("Please enter correct date and dat.");
          return false;
      }

      return true;
    }

    function checkMonth() {
      var week = document.forms["monthForm"]["week"].value;
      var date = document.forms["monthForm"]["date"].value;
      var start_week = document.forms["monthForm"]["start_week"].value;
      var weekNumber = (new Date(date)).getWeek();
      
      if (start_week != weekNumber) {
        alert("Please enter correct date and start week.");
        return false;
      }

      var newDate = new Date(date);
      var weekday = [];
      weekday[0] = "Sunday";
      weekday[1] = "Monday";
      weekday[2] = "Tuesday";
      weekday[3] = "Wednesday";
      weekday[4] = "Thursday";
      weekday[5] = "Friday";
      weekday[6] = "Saturday";
      
      var wd = weekday[newDate.getDay()];
    
      if (wd != week) {
          alert("Please enter correct date and dat.");
          return false;
      }

      return true;
    }
  </script>

  <script>
      Date.prototype.getWeek = function(){
          var firstDay = new Date(this.getFullYear(), this.getMonth(), 1).getDay();
          return Math.ceil((this.getDate() + firstDay)/7);
      }
  </script>
</body>
</html>