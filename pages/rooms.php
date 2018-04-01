<!DOCTYPE html>
<html>
<head>
  <title>Room Booking</title>

  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <link rel="stylesheet" href="../css/w3.css">
</head>
<body>
  <?php
    include('config.php'); 
  ?>

  <ul>
    <li><a href="index.php">Home</a></li>
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

    <li><a href="rooms.php" class="active">Rooms</a></li>
  </ul>

  <div class="w3-container">
  <h2>Photo Card</h2>

    <?php
      $sql = "SELECT * FROM rooms";
      $result = mysqli_query($connection, $sql);

      if ($result->num_rows > 0) { 
        while ($row = mysqli_fetch_assoc($result)) {
          echo '<div class="w3-card-4" style="width:50%">';
          echo '<img src="../img/'.$row['image'].'" style="width:100%">';
          echo '<div class="w3-container w3-center">';
          echo '<h3>'. $row['room_number'] .'</h3>';
          echo '<p>'. $row['description'] .'</p>';
          echo '</div>';
          echo '</div>';
        }
      }
    ?>
  
  </div>

</body>
</html>