<!DOCTYPE html>
<html>
<head>
  <title>Room Booking - Admin Page</title>
  
  <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>

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
    <th>Approved</th>
    <th>Actions</th>
  </tr>
  <?php
    include('config.php');

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