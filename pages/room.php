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

  <h2>Room Management</h2>
  <div class="admin-links">
    <a href="room.php">Rooms</a>
    <a href="booking.php">Reservations</a>  
    <a href='timetable.php'>Timetable</a>
  </div>
  <table style="width:100%">
  <tr>
    <th>#</th>
    <th>Room number</th> 
    <th>Room description</th>
    <th>Actions</th>
  </tr>
  <?php

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

      if (move_uploaded_file($_FILES['image']["tmp_name"], "../img/" . basename($_FILES["image"]['name']))) {
            }

      $sql = "INSERT INTO rooms (room_number, description, image) VALUES ('".$room_number."', '".$description."', '".$_FILES["image"]['name']."')";
    
      $result = mysqli_query($connection, $sql);

      if ($result) {
        echo "<p style='color: green;'>The room added successfully.</p>";
        header("location: room.php");
      } else {
        echo "<p style='color: red;'>Something went wrong, please try again.</p>";
      }
    }
  ?>
  <form action="room.php" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="room_number">Room number</label>
      <input type="number" name="room_number" id="room_number" placeholder="Please Enter Room Number">      
    </div>

    <div class="form-group">
      <label for="description">Room Description</label>
      <textarea id="description" name="description"></textarea>
    </div>

    <div class="form-group">
      <label for="image">Room Image</label>
      <input type="file" name="image">
    </div>

    <input type="submit" name="submit" value="Add Room">
  </form>
</body>
</html>