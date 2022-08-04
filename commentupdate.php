<?php
require 'database.php';
$gameid=$_GET['gameid'];
$id = $_GET['id']; 
$sqlll = "SELECT * FROM feedback WHERE id='$id'";

$resulttt = $connection->query($sqlll);

$rowww = $resulttt->fetch_assoc();
if (isset($_POST['submit'])) {
    $comment= $_POST['comment'];
    $rating = $_POST["rating"];
  if($rating==""){
        $rating = $rowww['rating'];
    }
 $sql = "UPDATE feedback SET comment='$comment',rating='$rating'where id='$id'";
   if ($connection->query($sql)){  
     header('location:newpage.php?id='.$gameid);
    } else {
      die("Category creation failed $connection->error");
    }
}

//print_r($rowww);
    $connection->close();
?>

    <!DOCTYPE html>
<html>
<head>
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/testonepage.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    <link rel="stylesheet" type="text/css" href="icon/all.min.css">
    <title>test</title>
</head>
<body>
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
 
<!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <!-- Links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
  <!-- Links -->
  <ul class="navbar-nav mr-auto">
    <li class="nav-item">
      <a class="nav-link  mx-4 namee" href="home.php"><i class="fas fa-home"></i>Home</a>
    </li>
    <li class="nav-item">  
      <a class="nav-link mx-4" href="2ndpage.php"><i class="fas fa-gamepad"></i>Moded Game</a>
    </li>
    <li class="nav-item">
      <a class="nav-link   mx-4" href="3rdpage.php"><i class="fab fa-d-and-d"></i>game</a>
    </li>
  </ul>
</div>
</nav>
	<form method="post" enctype="multipart/form-data"  action="" class="formm" style="margin-top: 30px;">
		<!-- <label for="something" style="font-family: 'Dancing Script', cursive; font-size: 24px" > </label> -->
		<input type="hidden" name="id" value="<?php echo $rowww['id'] ?>">
		<h2">comment:</h2>
		<textarea name="comment" class="comment">
      <?php echo $rowww['comment'] ?>      
        </textarea>
		  <div>
        <h3>Student Rating System</h3>
    </div>
 
         <div class="rateyo" id= "rating"
         data-rateyo-rating=<?php echo $rowww['rating'] ?>
         data-rateyo-num-stars="5"
         data-rateyo-score="3"> 
         </div>
 
    <span class='result'><?php echo $rowww['rating'] ?></span>
    <input type="hidden" name="rating">
    <?php echo $rowww['rating'] ?>
 
    </div>
 
    <div><input type="submit" name="submit"> </div>
 
</form>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
 
<script>
 
 
    $(function () {
        $(".rateyo").rateYo().on("rateyo.change", function (e, data) {
            var rating = data.rating;
            $(this).parent().find('.score').text('score :'+ $(this).attr('data-rateyo-score'));
            $(this).parent().find('.result').text('rating :'+ rating);
            $(this).parent().find('input[name=rating]').val(rating); //add rating value to input field
        });
    });
 
</script>
	</form>
</body>
</html>
