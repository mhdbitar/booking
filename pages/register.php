<!DOCTYPE html>
<html lang="en">
<head>
<title>Shahed Movies | Register</title>
<meta charset="utf-8">
<link rel="icon" href="../images/favicon.ico">
<link rel="shortcut icon" href="../images/favicon.ico">
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/form.css">
<link rel="stylesheet" href="../css/jquery.countdown.css">
<script src="../js/jquery.js"></script>


<script src="../js/jquery.easing.1.3.js"></script>
<script src="../js/script.js"></script>
<script src="../js/jquery.carouFredSel-6.1.0-packed.js"></script>
<script src="../js/jquery.touchSwipe.min.js"></script>
<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<link rel="stylesheet" media="screen" href="css/ie.css">
<![endif]-->
</head>
<?php
  require('config.php');
?>
<body>
<header>
  <div class="container_12">
    <div class="grid_12">
      <h1><img src="../images/the-movies-logo-1 (1).gif" width="250" height="300"></h1>
      <div id="countdown"></div>
      <div class="clear"></div>
      <div class="menu_block">
        <nav>
          <ul class="sf-menu">
            <li><a href="../index.php">Home</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li class="current"><a href="register.php">Register</a></li>
            <?php
              if (!is_login()) { ?>
                <li><a href="login.php">Login</a></li>
            <?php } else { ?>
              <?php if (is_admin()) { ?>
                <li><a href="admin.php">Admin</a></li>
              <?php } ?>
                <li><a href="logout.php">Logout</a></li>
            <?php } ?>
          </ul>
        </nav>
       <br/'>_____________________________________________<label>DateTime :<input type="datetime-local"/>
        <div class="clear"></div>
      </div>
      <div class="clear"></div>
    </div>
  </div>
</header>
<div class="content">
  <div class="container_12">
    <div class="grid_12 cont1">
      <div class="box bx2 pb1">
        <div class="grid_12 ">
          <h3>Create an Account</h3>
          <?php
            if (isset($_POST["submit"]))
            {
              $name = mysqli_real_escape_string($connection,$_POST['name']);
              $password = mysqli_real_escape_string($connection,$_POST['password']);
              $email = mysqli_real_escape_string($connection,$_POST['email']);
    
              $sql = "INSERT INTO users (name, email, password) values('".$name."', '".$email."', '".md5($password)."')";
              $result = mysqli_query($connection, $sql);

              if ($result) {
                echo "<p style='color: green;'>$name created successfully.</p>";
              } else {
                echo "<p style='color: red;'>Something went wrong!</p>";
              }
            }
          ?>
          
          <form id="form" action="register.php" method="post" name="myForm" onsubmit="return validateForm()">
            <fieldset>
              <label class="name">
                <input type="text" placeholder="Name:" name="name">
                <br class="clear">
              </label>
              
              <label class="email">
                <input type="text" placeholder="E-mail:" name="email">
                <br class="clear">
              </label>
              
              <label class="password">
                <input type="password" placeholder="Password:" name="password">
                <br class="clear">
              </label>
              
              <div class="clear"></div>
              <div class="btns">
                <input type="submit" class="col1" name="submit" value="Register">
                <input type="reset" value="Reset" class="col1">
                <div class="clear"></div>
              </div>
            </fieldset>
          </form>
        <div class="clear"></div>
      </div>
    </div>
  </div>
</div>
<footer>
  <div class="container_12">
    <div class="grid_12">
      <div class="socials"> <a href="#"></a> <a href="#"></a> <a href="#"></a> <a href="#"></a> </div>
      <div class="copy">Shahed Movies &copy; 2045 | <a href="#">Top</a> | Design by: Maram-Lama-Alaa-Amjad-Samhaa</a></div>
    </div>
  </div>
</footer>

<script>

function validateForm() {
    var name = document.forms["myForm"]["name"].value;
    var email = document.forms["myForm"]["email"].value;
    var password = document.forms["myForm"]["password"].value;
    
    if (name == "") {
        alert("Name must be filled out");
        return false;
    }

    if (email == "") {
        alert("Email must be filled out");
        return false;
    }

    if (password == "") {
      alert("Password must be filled out");
      return false;
    }
    return true;
}
</script>

</body>
</html>