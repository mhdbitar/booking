<!DOCTYPE html>
<html lang="en">
<head>
<title>Shahed Movies | Admin</title>
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

<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 15px;
    border: 1px solid #000 !important;
    text-align: center;
}

#add, #edit, #delete {
  border: 1px solid #fe8c21;
    font-size: 14px;
    background: #322b36;
    padding: 1%;
}
</style>
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
            <li><a href="register.php">Register</a></li>
            <?php
              if (!is_login()) { ?>
                <li><a href="login.php">Login</a></li>
            <?php } else { ?>
              <?php if (is_admin()) { ?>
                <li class="current"><a href="admin.php">Admin</a></li>
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
        <div class="grid_12">
  <div class="container_12">
    <div class="grid_12 cont1">
      <div class="box bx2 pb1">
        <div class="grid_12 ">
          <h3>Edit Movie</h3>
          <?php
            if (isset($_POST["submit"]))
            {
     
              $name = mysqli_real_escape_string($connection,$_POST['name']);
              $description = mysqli_real_escape_string($connection,$_POST['description']);
              $box_office = mysqli_real_escape_string($connection,$_POST['box_office']);
              $release_date = mysqli_real_escape_string($connection,$_POST['release_date']);
              
              $sql = "UPDATE movies SET name = '".$name."', description = '".$description."' , box_office = '".$box_office."', release_date = '".$release_date."' WHERE movie_id = " . $_GET['id'];
              $result = mysqli_query($connection, $sql);
              if ($result) {
                echo '<p style="color: green;">Edited successfully</p>';
                header('./admin.php');
              } else {
                echo '<p style="color: red;">Something went wrong!</p>';
              }

            }
          ?>
          <form id="form" action="edit.php?id=<?= $_GET['id']?> " method="post">
            <fieldset>
              <?php
                $sql = "SELECT * FROM movies WHERE movie_id = " . $_GET['id'];
                $result = mysqli_query($connection, $sql);

                if ($result->num_rows > 0) {
                  while ($row = mysqli_fetch_assoc($result)) { ?>
                    <label class="name">
                      <input type="text" placeholder="Name:" name="name" value="<?= $row['name'] ?>">
                      <br class="clear">
                    </label>
              
                    <label class="box_office">
                      <input type="text" placeholder="Box Office:" name="box_office" value="<?= $row['box_office']?>">
                      <br class="clear">
                    </label>
              
                    <label class="release_date">
                      <input type="date" placeholder="Release Date:" name="release_date" value="<?= $row['release_date']?>">
                      <br class="clear">
                    </label>

                    <label class="description">
                      <textarea placeholder="Description:" name="description" value="<?= $row['description'] ?>"><?= $row['description'] ?></textarea>
                      <br class="clear"> 
                    </label>

                    <div class="clear"></div>
                    
                    <div class="btns">
                      <input type="submit" class="col1" name="submit" value="Edit">
                      <input type="reset" value="Reset" class="col1">
                      <div class="clear"></div>
                    </div>
                  <?php }
                }
              ?>
            </fieldset>
          </form>
      </div>
    </div>
  </div>

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


</body>
</html>