<!DOCTYPE html>
<html>
<head>
  <title>Room Booking</title>

  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
  <?php
    include('pages/config.php'); 
  ?>

  <ul>
    <li><a href="index.php" class="active">Home</a></li>
    <li><a href="pages/register.php">Regsiter</a></li>
    <?php if (isset($_SESSION['login'])) { ?>
      <li><a href="pages/reservations.php">Reservations</a></li>
      <li><a href="pages/logout.php">Logout</a></li>
      <?php if (isset($_SESSION['is_admin']) && ($_SESSION['is_admin'] == "1")) { ?>
        <li><a href="pages/admin.php">Admin</a></li>
      <?php } ?>
    
    <?php } else { ?>
      <li><a href="pages/login.php">Login</a></li>
    <?php } ?>
  </ul>

  <div class="jumbotron">
    <div class="container">
      <h1>Welcome to ROOM BOOKING system</h1>
      <p>You can find and reserve a specific room in this website.</p>
    </div>
  </div>
</body>
</html>