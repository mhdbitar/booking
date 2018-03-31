<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Shahed movies</title>
    <meta charset="utf-8">
    <link rel="icon" href="images/favicon.ico">
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/jquery.countdown.css">
  </head>

  <style type="text/css">
  .head {
    text-align: center;
    font-size: 36px;
    color: #F60;
  }
  .table {
  }
  .subtitel {
    font-size: 24px;
    text-align: center;
    font-weight: bold;
  }
  .subtitle1 {
    text-align: center;
    font-weight: bold;
    font-size: 24px;
  }
  .subtitle2 {
    text-align: center;
    font-weight: bold;
    font-size: 24px;
  }
  .n {
    color: #000;
  }
  .text {
    font-weight: bold;
    font-size: 18px;
    color: #F60;
  }
  body {
    background-color: #322b36;
  }

  li {
    list-style-type: none;
  }
</style>  
<?php
  require('config.php');
?>
<body>


<?php 
    
    $id = $_GET['cat'];

    $sql = "SELECT * FROM movies INNER JOIN category_movie ON category_movie.movie_id = movies.movie_id WHERE category_movie.cat_id = '$id'";
    $movies = mysqli_query($connection, $sql);

    $sql = "SELECT * FROM categories WHERE cat_id = '$id' LIMIT 1";
    $category = mysqli_query($connection, $sql);

    $cat = '';
    while ($row = mysqli_fetch_assoc($category)) {
      $cat = $row['name'];
    }
?>

<h1 class="head"><?= $cat ?></h1>
<p>&nbsp;  </p>
<table width="584" border="1" align="center">
  <tr></tr>
  <tr></tr>
  <?php
    if ($movies->num_rows > 0) { 
      while ($row = mysqli_fetch_assoc($movies)) { 
  ?>
    <tr>
    <td height="285" bgcolor="#CCCCCC"><ol>
      <li>
        <a href="movie.php?movie=<?= $row['movie_id'] ?>">
          <img src="../images/<?= $row['cover'] ?>" width="200" height="280" alt="<?= $row['name'] ?>" /></a>
      </li>
    </td>
  </tr>
  <?php } } ?>
  
</table> 
    <a href="../index.php">Go back</a>
    <p class="text"><br />
    </p>
<p>&nbsp;</p>

<footer>
  <div class="container_12">
    <div class="grid_12">
      <div class="socials"> <a href="#"></a> <a href="#"></a> <a href="#"></a> <a href="#"></a> </div>
      <div class="copy">Shahed Movies &copy; 2045 | <a href="#TOP">Top</a> | Design by: Maram-Lama-Alla-Amjad-Samhaa</a></div>
    </div>
  </div>
</footer>

<script src="js/jquery.js"></script>


<script src="js/jquery.easing.1.3.js"></script>
<script src="js/script.js"></script>
<script src="js/jquery.carouFredSel-6.1.0-packed.js"></script>
<script src="js/jquery.touchSwipe.min.js"></script>

</body>
</html>