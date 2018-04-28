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
      $password = $_POST['password'];

      $sql = "SELECT * FROM users where email='".$email."'";
      $result = mysqli_query($connection, $sql);

      if ($result->num_rows == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
          if (password_verify($password.$row['salt'], $row['password'])) {
            $_SESSION['login'] = 1;
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['full_name'];
            $_SESSION['is_admin'] = $row['is_admin'];
           
            if ($row['is_admin'] == "1") {
              header("location: admin.php");
            } else {
              header("location: ../index.php");
            }
          }
        }
      }
    }
  ?>

  <h2>Login</h2>
  <form action="login.php" method="POST">
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" name="email" id="email" placeholder="Please Enter your Email Address">
    </div>

    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" name="password" id="password" placeholder="Please Enter your Password">
    </div>

    <br>
    <input type="submit" name="submit" value="Login">
    <a href="forget.php" style="background-color: transparent; border: 0px; color: red;">Forget password</a>
  </form>
</body>
</html>