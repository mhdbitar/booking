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
      $approved = $_POST['approved'];
      $weekly = $_POST['repeat_week'];
      $monthly = $_POST['repeat_month'];
      
      $sql = "UPDATE reservations SET approved = '".$approved."', repeat_week = '".$weekly."', repeat_month = '".$monthly."' WHERE reservation_id = " . $_GET['id'];
    
      $result = mysqli_query($connection, $sql);

      header("location: booking.php");
    }
  ?>
  <form action="editReservation.php?id=<?= $_GET['id'] ?>" method="POST">
    <div class="form-group">
        <label for="approved">Approved</label>
        <select name="approved" id="approved">
          <option value="1">Yes</option>
          <option value="0">No</option>
        </select>      
    </div>

    <div class="form-group">
        <label for="weekly">Weekly Frequency</label>
        <select name="repeat_week" id="weekly">
          <option value="1">Yes</option>
          <option value="0">No</option>
        </select>      
    </div>

    <div class="form-group">
        <label for="monthly">Monthly Frequency</label>
        <select name="repeat_month" id="monthly">
          <option value="1">Yes</option>
          <option value="0">No</option>
        </select>      
    </div>

    <input type="submit" name="submit" value="Edit">
  </form>
</body>
</html>