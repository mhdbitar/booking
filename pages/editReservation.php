<!DOCTYPE html>
<html>
<head>
  <title>Room Booking - Admin Page</title>
  
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
  </ul>

  <h2>Reservations Management</h2>
  <div class="admin-links">
    <a href="room.php">Rooms</a>
    <a href="booking.php">Reservations</a>  
  </div>
  
  <h3>Edit reservation</h3>
  <?php

  
    if (isset($_POST['submit'])) 
    {
      $date = $_POST['date'];
      $from = $_POST['from'];
      $to = $_POST['to'];

      $sql = "SELECT * FROM reservations WHERE room_id = '".$_GET['room_id']."' AND reservation_date = '".$date."' AND from_time = '".$from."' AND to_time >= '".$from."'";
      $result = mysqli_query($connection, $sql);

      if ($result->num_rows == 0) {
        $sql = "UPDATE reservations SET reservation_date = '".$date."', from_time = '".$from."', to_time = '".$to."' WHERE reservation_id = " . $_GET['id'];
        $result = mysqli_query($connection, $sql);

        header("location: booking.php");
      } else {
        echo "<p style='color: red;'>You can not update your reservation.</p>";
      }
    }
  ?>
  <form action="editReservation.php?id=<?= $_GET['id'] ?>&room_id=<?= $_GET['room_id']?>" method="POST">

    <?php
      $sql = "SELECT * FROM reservations WHERE reservation_id = '".$_GET['id']."'";
      $result = mysqli_query($connection, $sql);

      $date = "";
      $from = "";
      $to = "";
      while ($row = mysqli_fetch_assoc($result)) {
        $date = $row['reservation_date'];
        $from = $row['from_time'];
        $to = $row['to_time'];
      }

      $time = array(
          "9" => "09:00 AM",
          "10" => "10:00 AM",
          "11" => "11:00 AM",
          "12" => "12:00 AM",
          "13" => "01:00 PM",
          "14" => "02:00 PM",
          "15" => "03:00 PM",
          "16" => "04:00 PM",
          "17" => "05:00 PM",
          "18" => "06:00 PM",
          "19" => "07:00 PM",
          "20" => "08:00 PM",
          "21" => "09:00 PM"
      );
    ?>

    <div class="form-group">
      <label for="date">Date</label>
      <input type="date" id="date" name="date" value="<?= $date ?>">      
    </div>

    <div class="form-group">
      <label for="from">Time</label>
      <select name="from" id="from">
        <?php foreach ($time as $key => $value) { ?>
          <?php if ($key == $from) { ?>
            <option value="<?= $key ?>" selected="selected"><?= $value ?></option>
          <?php } else { ?>
            <option value="<?= $key ?>"><?= $value ?></option>
          <?php } ?>
        <?php } ?>
      </select>

      <label for="to">To</label>
      <select name="to">
        <?php foreach ($time as $key => $value) { ?>
          <?php if ($key == $to) { ?>
            <option value="<?= $key ?>" selected="selected"><?= $value ?></option>
          <?php } else { ?>
            <option value="<?= $key ?>"><?= $value ?></option>
          <?php } ?>
        <?php } ?>  
      </select>
    </div>

    <input type="submit" name="submit" value="Edit">
  </form>
</body>
</html>