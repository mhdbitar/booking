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

<body>

<style type="text/css">
.m {
  color: #FFF;
}
.m {
  color: #FFF;
}
.m {
  color: #FFF;
}
.m {
  color: #FFF;
}
.a {
  color: #333;
  text-align: left;
  font-weight: bold;
}
body {
  background-color: #322b36;
  color: #D6D6D6;
}
.v {
  color: #F60;
}
.dd {
  color: #F60;
}
.kky {
  color: #F60;
}
.ass {
  color: #F60;
}

li {
  list-style-type: none;
}
</style>

<?php 
    require('config.php');

    $id = $_GET['movie'];

    $sql = "SELECT * FROM movies WHERE movie_id = '$id'";
    $movie = mysqli_query($connection, $sql);

    $name = '';
    $description = '';
    $box_office = '';
    $date = '';
    $cover = '';
    $rate = 0;
    while ($row = mysqli_fetch_assoc($movie)) {
      $name = $row['name'];
      $description = $row['description'];
      $box_office = $row['box_office'];
      $date = DateTime::createFromFormat('Y-m-d', $row['release_date']);
      $cover = $row['cover'];
      $rate = $row['rate'];
    }
?>
<p><img src="../images/<?= $cover ?>" width="200" height="280" alt="<?= $name ?>" /></p>
<table width="537" height="220" border="1">
  <tr>
    <td width="82" height="44" bgcolor="#666666" class="m">Movie name<br /></td>
    <td width="439" bgcolor="#CCCCCC" class="a"><?= $name ?></td>
  </tr>
  <tr>
    <td bgcolor="#666666" class="m">Production year</td>
    <td bgcolor="#CCCCCC" style="color: #000;"><?= $date->format('Y') ?></td>
  </tr>
  <tr>
    <td bgcolor="#666666" class="m">Rating</td>
    <td bgcolor="#CCCCCC" style="color: #000;"><?= $rate ?></td>
  </tr>
  <tr>
    <td bgcolor="#666666" class="m"><p>Describe</p></td>
    <td bgcolor="#CCCCCC" style="color: #000;"><?= $description ?></td>
  </tr>
</table>
<table width="537" height="53" border="1">
  <tr>
    <td width="83" height="47" bgcolor="#666666" class="m">Viewed link</td>
    <td width="438" bgcolor="#CCCCCC"><a href="http://online.dardarkom.com/195612-sharafat-vidto.html">Click Here</a></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>

<?php if (is_login()) { ?>
<?php 
    if (isset($_POST['submit'])) {
      $user_id = get_user_id();
      $content = $_POST['content'];

      $sql = "INSERT INTO comments (user_id, content) values('".$user_id."',  '".$content."')";
      $result = mysqli_query($connection, $sql);

      echo '<p style="color: red;">Your comment has been added successfully.</p>';
    }
?>
<span class="ass" dir="rtl">~ Add your comment about this movie</span><span class="uu" dir="rtl">
<pre>   </pre>
</span>
</p>
<form method="post" action="movie.php?movie=<?= $_GET['movie'] ?>" name="dle-comments-form" id="dle-comments-form">

  <ul class="pedit-form">
    
    <li>
      <span>
      <div class="bb-editor">
        <ul class="pedit-form">
          <div class="submit-btn" style="padding-bottom: 25px;">
          <pre>   </pre>
          <span class="submit-btn" style="padding-bottom: 25px;"><span class="submit-btn" style="padding-bottom: 25px;"><span class="submit-btn" style="padding-bottom: 25px;">
          <textarea name="content" cols="90" rows="4" id="content"></textarea>
          </span></span></span></div>
        </ul>
      </div></span>
    </li>
    
    <input type="submit" onclick="validation()" value="Send Comment">
    

    </div>
  </ul>
</form>
<?php } ?>
<script>

    var content =  document.getElementById('content');
    
    function validation (){

        if(content.value == ""){
            alert ('Comment content is reqired ');
        }
    }
</script>
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