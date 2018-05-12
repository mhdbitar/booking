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

  <h2>Reservations Management</h2>
  <div class="admin-links">
    <a href="room.php">Rooms</a>
    <a href="booking.php">Reservations</a>  
    <a href='timetable.php'>Timetable</a>
  </div>

  <table style="width:100%">
  <tr>
    <th>#</th>
    <th>Room name</th> 
    <th>Customer name</th>
    <th>Reservation date</th>
    <th>From (time)</th>
    <th>To (time)</th>
    <th>Total price</th>
    <th>Approved</th>
    <th>Actions</th>
  </tr>
  <?php

    $sql = "SELECT * FROM reservations INNER JOIN rooms ON reservations.room_id = rooms.id INNER JOIN users ON users.id = reservations.user_id";
    $rooms = mysqli_query($connection, $sql);
    
    if ($rooms->num_rows > 0) { 
      while ($row = mysqli_fetch_assoc($rooms)) {
         echo "<tr>";
          echo "<td>".$row['reservation_id']."</td>";
          echo "<td>".$row['room_name']."</td>";
          echo "<td>".$row['full_name']."</td>";
          echo "<td>".$row['reservation_date']."</td>";
          echo "<td>".$row['from_time']."</td>";
          echo "<td>".$row['to_time']."</td>";
          echo "<td>".$row['room_price']."</td>";

          if ($row['approved'] == "1") {
            echo "<td>Yes</td>";
          } else {
            echo "<td>No</td>";
          }
          echo "<td><a href='deleteReservation.php?id=".$row['reservation_id']."' class='delete'>Delete</a> <a href='editReservation.php?id=".$row['reservation_id']."&room_id=".$row['room_id']."'>Edit</a><a href='approve.php?id=".$row['reservation_id']."' class='approve'>Approve</a><a href='discount.php?id=".$row['reservation_id']."' class='discount'>Set discount</a></td>";
         echo "</tr>";
      }
    }
  ?>
</table>
</body>
</html>