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
  </ul>

  <h2>Reservations Management</h2>
  <div class="admin-links">
    <a href="room.php">Rooms</a>
    <a href="booking.php">Reservations</a>  
  </div>
  
  <h3>Add discount</h3>
  <?php
  
    if (isset($_POST['submit'])) 
    {
      $discount = $_POST['discount'] / 100;

      $sql = "SELECT * FROM reservations WHERE reservation_id = " . $_GET['id'];
      $result = mysqli_query($connection, $sql);
      $price = 0;

      if ($result->num_rows > 0) { 
        while ($row = mysqli_fetch_assoc($result)) {
          $price = $row['room_price'];
        }
      }

      $price *= $discount;

      $sql = "UPDATE reservations SET room_price = '".$price."' WHERE reservation_id = " . $_GET['id'];
        $result = mysqli_query($connection, $sql);

        header("location: booking.php");
    } else {
        // echo "<p style='color: red;'>You can not disount this reservation.</p>";
    }

  ?>
  <form action="discount.php?id=<?= $_GET['id'] ?>" method="POST">
  
    <div class="form-group">
      <label for="discount">Discount value</label>
      <input type="number" id="discount" name="discount">      
    </div>

    <input type="submit" name="submit" value="Edit">
  </form>
</body>
</html>