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

  <h2>Reservations Management</h2>
  <div class="admin-links">
    <a href="room.php">Rooms</a>
    <a href="booking.php">Reservations</a>  
  </div>
  <table style="width:100%">
  <tr>
    <th>#</th>
    <th>Room number</th> 
    <th>Customer name</th>
    <th>Reservation date</th>
    <th>From (time)</th>
    <th>To (time)</th>
    <th>Monthly Frequency</th>
    <th>Weekly Frequency</th>
    <th>Approved</th>
    <th>Actions</th>
  </tr>
  <?php

    $sql = "SELECT * FROM reservations INNER JOIN rooms ON reservations.room_id = rooms.id";
    $rooms = mysqli_query($connection, $sql);
    
    if ($rooms->num_rows > 0) { 
      while ($row = mysqli_fetch_assoc($rooms)) {
         echo "<tr>";
          echo "<td>".$row['reservation_id']."</td>";
          echo "<td>".$row['room_number']."</td>";
          echo "<td>".$row['name']."</td>";
          echo "<td>".$row['reservation_date']."</td>";
          echo "<td>".$row['from_time']."</td>";
          echo "<td>".$row['to_time']."</td>";
          if ($row['repeat_month'] == "1") {
              echo "<td>Yes</td>";
          } else {
              echo "<td>No</td>";
          }
          if ($row['repeat_week'] == "1") {
              echo "<td>Yes</td>";
          } else {
              echo "<td>No</td>";
          }
          if ($row['approved'] == "1") {
            echo "<td>Yes</td>";
          } else {
            echo "<td>No</td>";
          }
          echo "<td><a href='deleteReservation.php?id=".$row['reservation_id']."' class='delete'>Delete</a> <a href='editReservation.php?id=".$row['reservation_id']."'>Edit</a></td>";
         echo "</tr>";
      }
    }
  ?>
</table>
</body>
</html>