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

      <li><a href="rooms.php">Rooms</a></li>
  </ul>

  <h2>Control Panel</h2>

<div class="admin-links">
    <a href="room.php">Rooms</a>
    <a href="booking.php">Reservations</a>  
    <a href='timetable.php'>Timetable</a>
</div>

  <p class="admin-paragraph">Here in this page the admin can manage the rooms and reservations for all the customers...</p>
</body>
</html>