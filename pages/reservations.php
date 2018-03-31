<!DOCTYPE html>
<html>
<head>
  <title>Room Booking</title>

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
      <?php } ?>
    
    <?php } else { ?>
      <li><a href="login.php">Login</a></li>
    <?php } ?>
  </ul>
  <h1>RESERVATION</h1>
  <h3>Please fill in the booking details as you wish</h3>

  

  <?php
    $sql = "SELECT * FROM rooms";
    $result = mysqli_query($connection, $sql);
    $rooms = array();

    if ($result->num_rows > 0) { 
      while ($row = mysqli_fetch_assoc($result)) {
        $rooms[$row['id']] = $row['room_number'];
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
        <option value="09:00AM">09:00 AM</option>
        <option value="10:00AM">10:00 AM</option>
        <option value="11:00AM">11:00 AM</option>
        <option value="12:00AM">12:00 AM</option>
        <option value="01:00PM">01:00 PM</option>
        <option value="02:00PM">02:00 PM</option>
        <option value="03:00PM">03:00 PM</option>
        <option value="04:00PM">04:00 PM</option>
        <option value="05:00PM">05:00 PM</option>
        <option value="06:00PM">06:00 PM</option>
        <option value="07:00PM">07:00 PM</option>
        <option value="08:00PM">08:00 PM</option>
        <option value="09:00PM">09:00 PM</option>
      </select>

      <select name="to">
        <option value="09:00AM">09:00 AM</option>
        <option value="10:00AM">10:00 AM</option>
        <option value="11:00AM">11:00 AM</option>
        <option value="12:00AM">12:00 AM</option>
        <option value="01:00PM">01:00 PM</option>
        <option value="02:00PM">02:00 PM</option>
        <option value="03:00PM">03:00 PM</option>
        <option value="04:00PM">04:00 PM</option>
        <option value="05:00PM">05:00 PM</option>
        <option value="06:00PM">06:00 PM</option>
        <option value="07:00PM">07:00 PM</option>
        <option value="08:00PM">08:00 PM</option>
        <option value="09:00PM">09:00 PM</option>
      </select>
    </div>

    <input type="submit" name="single-submit" value="Search">
  </form>


  <h2>Regular Booking (Weekly)</h2>
  <form action="index.php" method="post">
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
      <label for="every-week">Every</label>
      <select name="every-week" id="every-week">
        <option value="monday">Monday</option>
        <option value="tuesday">Tuesday</option>
        <option value="wednesday">Wednesday</option>
        <option value="thursday">Thursday</option>
        <option value="friday">Friday</option>
        <option value="saturday">Saturday</option>
        <option value="sunday">Sunday</option>
      </select>
    </div>
    
    <div class="form-group">
      <label for="weekly-date">Date</label>
      <input type="date" id="weekly-date" name="weekly-date">      
    </div>

    <div class="form-group">
      <label for="weekly-time">Time</label>
      <select name="weekly-from">
        <option value="09:00AM">09:00 AM</option>
        <option value="10:00AM">10:00 AM</option>
        <option value="11:00AM">11:00 AM</option>
        <option value="12:00AM">12:00 AM</option>
        <option value="01:00PM">01:00 PM</option>
        <option value="02:00PM">02:00 PM</option>
        <option value="03:00PM">03:00 PM</option>
        <option value="04:00PM">04:00 PM</option>
        <option value="05:00PM">05:00 PM</option>
        <option value="06:00PM">06:00 PM</option>
        <option value="07:00PM">07:00 PM</option>
        <option value="08:00PM">08:00 PM</option>
        <option value="09:00PM">09:00 PM</option>
      </select>

      <select name="weekly-to">
        <option value="09:00AM">09:00 AM</option>
        <option value="10:00AM">10:00 AM</option>
        <option value="11:00AM">11:00 AM</option>
        <option value="12:00AM">12:00 AM</option>
        <option value="01:00PM">01:00 PM</option>
        <option value="02:00PM">02:00 PM</option>
        <option value="03:00PM">03:00 PM</option>
        <option value="04:00PM">04:00 PM</option>
        <option value="05:00PM">05:00 PM</option>
        <option value="06:00PM">06:00 PM</option>
        <option value="07:00PM">07:00 PM</option>
        <option value="08:00PM">08:00 PM</option>
        <option value="09:00PM">09:00 PM</option>
      </select>
    </div>

    <input type="submit" name="weekly-submit" value="Search">
  </form>

    <h2>Regular Booking (Monthly)</h2>
  <form action="index.php" method="post">
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
      <select name="every-month" id="every-month">
        <option value="monday">Monday</option>
        <option value="tuesday">Tuesday</option>
        <option value="wednesday">Wednesday</option>
        <option value="thursday">Thursday</option>
        <option value="friday">Friday</option>
        <option value="saturday">Saturday</option>
        <option value="sunday">Sunday</option>
      </select>
    </div>
    
    <div class="form-group">
      <label for="month-date">Date</label>
      <input type="date" id="month-date" name="month-date">      
    </div>

    <div class="form-group">
      <label for="month-time">Time</label>
      <select name="month-from">
        <option value="09:00AM">09:00 AM</option>
        <option value="10:00AM">10:00 AM</option>
        <option value="11:00AM">11:00 AM</option>
        <option value="12:00AM">12:00 AM</option>
        <option value="01:00PM">01:00 PM</option>
        <option value="02:00PM">02:00 PM</option>
        <option value="03:00PM">03:00 PM</option>
        <option value="04:00PM">04:00 PM</option>
        <option value="05:00PM">05:00 PM</option>
        <option value="06:00PM">06:00 PM</option>
        <option value="07:00PM">07:00 PM</option>
        <option value="08:00PM">08:00 PM</option>
        <option value="09:00PM">09:00 PM</option>
      </select>

      <select name="month-to">
        <option value="09:00AM">09:00 AM</option>
        <option value="10:00AM">10:00 AM</option>
        <option value="11:00AM">11:00 AM</option>
        <option value="12:00AM">12:00 AM</option>
        <option value="01:00PM">01:00 PM</option>
        <option value="02:00PM">02:00 PM</option>
        <option value="03:00PM">03:00 PM</option>
        <option value="04:00PM">04:00 PM</option>
        <option value="05:00PM">05:00 PM</option>
        <option value="06:00PM">06:00 PM</option>
        <option value="07:00PM">07:00 PM</option>
        <option value="08:00PM">08:00 PM</option>
        <option value="09:00PM">09:00 PM</option>
      </select>
    </div>

    <input type="submit" name="month-submit" value="Search">
  </form>
</body>
</html>