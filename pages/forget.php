<!DOCTYPE html>
<html>
<head>
  <title>Room Bookng</title>

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
  
  <?php
    if (isset($_POST['submit'])) 
    {
      $email = $_POST['email'];
      $salt = generateRandomString();
      $password = password_hash($_POST['password'].$salt, PASSWORD_BCRYPT);
      
      $sql = "SELECT * FROM users where email='".$email."'";
      $result = mysqli_query($connection, $sql);

      if ($result->num_rows == 1) {
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $sql = "UPDATE users SET password = '".$password."', salt = '".$salt."' WHERE email = '".$email."'";
        $result = mysqli_query($connection, $sql);
        
        header("location: login.php");
      } else {
        echo "<p style='color: red;'>Something went wrong, please try again.</p>";
        header("location: ../index.php");
      }
    }

    function generateRandomString($length = 10) {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;
    }
  ?>

  <h2>Login</h2>
  <form action="forget.php" method="POST">
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" name="email" id="email" placeholder="Please Enter your Email Address">
    </div>

    <div class="form-group">
      <label for="password">New Password</label>
      <input type="password" name="password" id="password" placeholder="Please Enter your new password">
    </div>

    <br>
    <input type="submit" name="submit" value="Change Password">
  </form>
</body>
</html>