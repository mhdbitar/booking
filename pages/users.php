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

    <li><a href="rooms.php">Rooms</a></li>
  </ul>

  <h2>Reservations Management</h2>
  <div class="admin-links">
    <a href="room.php">Rooms</a>
    <a href="booking.php">Reservations</a>  
    <a href='timetable.php'>Timetable</a>
    <a href='users.php'>Users</a>
  </div>

  <table style="width:100%">
  <tr>
    <th>#</th>
    <th>Full name</th> 
    <th>Email</th>
    <th>Phone number</th>
    <th>Address</th>
    <th>Admin</th>
    <th>Actions</th>
  </tr>
  <?php

    $sql = "SELECT * FROM users ORDER BY is_admin DESC";
    $users = mysqli_query($connection, $sql);
    
    if ($users->num_rows > 0) { 
      $i = 1;
      while ($row = mysqli_fetch_assoc($users)) {
         echo "<tr>";
          echo "<td>".$i++."</td>";
          echo "<td>".$row['full_name']."</td>";
          echo "<td>".$row['email']."</td>";
          echo "<td>".$row['phonenumber']."</td>";
          echo "<td>".$row['address']."</td>";

          if ($row['is_admin'] == "1") {
            echo "<td>Yes</td>";
          } else {
            echo "<td>No</td>";
          }
          echo "<td><a href='deleteUser.php?id=".$row['id']."' class='delete'>Delete</a> <a href='reserve.php?id=".$row['id']."' class='edit'>Book</a></td>";
         echo "</tr>";
      }
    }
  ?>
</table>

<h3>Add User</h3>
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
      $is_admin = $_POST['is_admin'];
      
      $sql = "INSERT INTO users (full_name, phonenumber, address, gender, email, password, is_admin, salt) VALUES ('".$full_name."', '".$phonenumber."', '".$address."', '".$gender."', '".$email."', '".$password."', '".$is_admin."', '".$salt."')";

      $result = mysqli_query($connection, $sql);

      if ($result) {
        echo "<p style='color: green;'>The usser added successfully.</p>";
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
  <form action="users.php" method="POST">
    <div class="form-group">
      <label for="full_name">Full name</label>
      <input type="text" name="full_name" id="full_name" placeholder="Please Enter Full Name">      
    </div>
    
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" name="email" id="email" placeholder="Please Enter Email">
    </div>

    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" name="password" id="password" placeholder="Please Password">
    </div>

    <div class="form-group">
      <label for="phonenumber">Phone number</label>
      <input type="number" name="phonenumber" id="phonenumber" placeholder="Please Enter Phone Number">      
    </div>

    <div class="form-group">
      <label for="address">Address</label>
      <textarea id="address" name="address"></textarea>
    </div>

    <div class="form-group">
      <label for="is_admin">User type</label>
      <select name="is_admin">
        <option>Please select</option>
        <option value="1">Admin</option>
        <option value="0">Customer</option>
      </select>
    </div>

    <div class="form-group">
      <label for="gender">Gender</label>
      <select name="gender">
        <option>Please select</option>
        <option value="0">Female</option>
        <option value="1">Male</option>
      </select>
    </div>

    <input type="submit" name="submit" value="Add User">
  </form>
</body>
</html>