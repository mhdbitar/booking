<!DOCTYPE html>
<html>
<head>
  <title>Room Booking - Admin Page</title>

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

  <h2>Notifications</h2>

  <table style="width:100%">
  <tr>
    <th>Customer</th> 
    <th>Room Number</th>
    <th>Actions</th>
  </tr>
  <?php

    $sql = "SELECT * FROM notifications WHERE seen = 0";
    $notifications = mysqli_query($connection, $sql);
    
    if ($notifications->num_rows > 0) { 
      while ($row = mysqli_fetch_assoc($notifications)) {
         echo "<tr>";
          echo "<td>".$row['customer']."</td>";
          echo "<td>".$row['room']."</td>";
          echo "<td><a href='seen.php?id=".$row['id']."' class='delete'>Seen</a></td>";
         echo "</tr>";
      }
    }
  ?>
</table>

</body>
</html>