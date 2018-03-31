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
  
  <h3>Edit reservation</h3>
  <?php

    include('config.php');
    
    if (isset($_POST['submit'])) 
    {
      $approved = $_POST['approved'];
      
      $sql = "UPDATE reservations SET approved = '".$approved."' WHERE reservation_id = " . $_GET['id'];
    
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

    <input type="submit" name="submit" value="Edit">
  </form>
</body>
</html>