<!DOCTYPE html>
<html>
<head>
  <title>Room Booking - Admin Page</title>
  
  <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>

  <h2>Room Management</h2>
  <div class="admin-links">
    <a href="room.php">Rooms</a>
    <a href="booking.php">Reservations</a>  
  </div>
  <table style="width:100%">
  <tr>
    <th>#</th>
    <th>Room number</th> 
    <th>Room description</th>
    <th>Actions</th>
  </tr>
  <?php
    include('config.php');

    $sql = "SELECT * FROM rooms";
    $rooms = mysqli_query($connection, $sql);
    
    if ($rooms->num_rows > 0) { 
      while ($row = mysqli_fetch_assoc($rooms)) {
         echo "<tr>";
          echo "<td>".$row['id']."</td>";
          echo "<td>".$row['room_number']."</td>";
          echo "<td>".$row['description']."</td>";
          echo "<td><a href='deleteRoom.php?id=".$row['id']."' class='delete'>Delete</a></td>";
         echo "</tr>";
      }
    }
  ?>
</table>
  <h3>Add Room</h3>
  <?php
    if (isset($_POST['submit'])) 
    {
      $room_number = $_POST['room_number'];
      $description = $_POST['description'];

      $sql = "INSERT INTO rooms (room_number, description) VALUES ('".$room_number."', '".$description."')";
    
      $result = mysqli_query($connection, $sql);

      if ($result) {
        echo "<p style='color: green;'>The room added successfully.</p>";
        header("location: room.php");
      } else {
        echo "<p style='color: red;'>Something went wrong, please try again.</p>";
      }
    }
  ?>
  <form action="room.php" method="POST">
    <div class="form-group">
      <label for="room_number">Room number</label>
      <input type="number" name="room_number" id="room_number" placeholder="Please Enter Room Number">      
    </div>

    <div class="form-group">
      <label for="description">Room Description</label>
      <textarea id="description" name="description"></textarea>
    </div>

    <input type="submit" name="submit" value="Add Room">
  </form>
</body>
</html>