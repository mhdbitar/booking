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
      $salt = generateRandomString();
      $full_name = $_POST['full_name'];
      $email = $_POST['email'];
      $password = password_hash($_POST['password'].$salt, PASSWORD_BCRYPT);
      $address = $_POST['address'];
      $gender = $_POST['gender'];
      $phonenumber = $_POST['phonenumber'];
      
      $sql = "INSERT INTO users (full_name, phonenumber, address, gender, email, password, salt) VALUES ('".$full_name."', '".$phonenumber."', '".$address."', '".$gender."', '".$email."', '".$password."', '".$salt."')";
      
      $result = mysqli_query($connection, $sql);

      if ($result) {
        echo "<p style='color: green;'>The customer added successfully.</p>";
      } else {
          echo "<p style='color: red;'>Something went wrong, please try again.</p>";
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

  <h2>Register</h2>
  <form action="register.php" method="POST">
    <div class="form-group">
      <label for="full_name">Full Name</label>
      <input type="text" name="full_name" id="full_name" placeholder="Please Enter your Full Name">      
    </div>

    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" name="email" id="email" placeholder="Please Enter your Email Address">
    </div>

    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" name="password" id="password" placeholder="Please Enter your Password">
    </div>

    <div class="form-group">
      <label for="phonenumber">Phone number</label>
      <input type="text" name="phonenumber" id="phonenumber" placeholder="Please Enter your Phone number">
    </div>

    <div class="form-group">
      <label for="gender">Gender</label>
      <select id="gender" name="gender">
        <option value="0">Male</option>
        <option value="1">Female</option>
      </select>
    </div>

    <div class="form-group">
      <label for="address">Address</label>
      <textarea id="address" name="address"></textarea>
    </div>

    <input type="submit" name="submit" value="Regsiter">
  </form>
</body>
</html>