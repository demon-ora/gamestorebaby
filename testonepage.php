<?php 
session_start();
if (!isset($_SESSION['username'])) {
  header('location:index.php?key=1');
}
 ?>
<?php
  require_once 'database.php';
$id = $_GET['id']; 

$sqll = "SELECT * FROM game WHERE id='$id'";

$resultt = $connection->query($sqll);

$roww = $resultt->fetch_assoc();
// print_r($roww);
//  print_r($roww['url']);
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
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="jquery/jquery.js">
  <link rel="stylesheet" type="text/css" href="jquery/mixitup.min.js">
  <link rel="stylesheet" type="text/css" href="bootstrap/js/bootstrap.bundle.min.js">
  <link rel="stylesheet" type="text/css" href="bootstrap/js/bootstrap.min.js">
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
    <div id="divman">
		<h1 class="titlee"> Title of game</h1><br>
		<span  class="spann">
			<?php echo $roww['title'] ?>
		</span>
		<h1 class="imgtitle">Image of game:</h1>
		<img src="<?php echo $roww['image']?>" >
		<br><br>
		<p class="game-description">Something about game: <?php echo $roww['descripation']?></p>
   </div>
  <p id="size">downlod this file<br>
    <a href="<?php  echo $roww['url'];?>" download rel="noopener noreferrer" target="_blank">
    <button type="button" class="btn btn-primary">Download File</button>
   </a>
     </p>
	<form method="post" enctype="multipart/form-data"  action="" class="formm">
		<!-- <label for="something" style="font-family: 'Dancing Script', cursive; font-size: 24px" > </label> -->
		<input type="hidden" name="id" value="<?php echo $roww['id'] ?>">
		<h2">comment:</h2>
		<textarea name="comment" class="comment"></textarea>
		  <div>
        <h3>Student Rating System</h3>
    </div>
 
         <div class="rateyo" id= "rating"
         data-rateyo-rating="4"
         data-rateyo-num-stars="5"
         data-rateyo-score="3">
         </div>
 
    <span class='result'>0</span>
    <input type="hidden" name="rating">
 
 
    <div><input type="submit" name="submit"> </div>
 
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
<?php
require 'database.php';
$sql="SELECT * FROM feedback";
$result = $connection->query($sql);         
           if ($result->num_rows > 0) {
          if($row = $result->fetch_assoc()) {
               if($row['userid']==$_SESSION['id']) {
                if($roww['id']!=$row['gameid']){
if (isset($_POST['submit'])) {
    $gameid = $roww['id'];
    $comment= $_POST['comment'];
    $rating = $_POST["rating"];
    $userid= $_SESSION['id'];
 
    $sql = "INSERT INTO feedback (gameid,userid,comment,rating) VALUES ('$gameid','$userid','$comment','$rating')";
   if ($connection->query($sql)){  
     header("location:newpage.php?id=".$gameid);
    } else {
      die("Category creation failed $connection->error");
    }
}}else{
  header("location:newpage.php?id=".$roww['id']);
}}}}
else{
  header("location:newpage.php?id=".$roww['id']);
}
?>
<?php
$sql="SELECT * FROM feedback";
$result = $connection->query($sql);         
           if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
             	  if($row['gameid']==$roww['id']){
              
              
             for($i=1;$i<=$row['rating'];$i++){?>
         <span class="fa fa-star checked"></span> 
           <?php }?>
           <?php
           for($j=1;$j<=5-$row['rating'];$j++){?>
         	<span class="fa fa-star"></span> 
           <?php  } ?>
         <br> 
           <?php echo $row['comment'] ?> <br> 
           <?php } ?>

          <?php
     	  if($row['gameid']==$roww['id']){
        if($row['userid']==$_SESSION['id']) {
     	?>
     	  <a href="deletecomment.php?id=<?php echo $row['id'] ?>&&gameid=<?php echo $row['gameid'] ?>" onclick="return confirm('Are you sure to delete?')">
     	 Delete
     	</a>
     	<br>
     	 <?php }} ?>
     	 <?php
     	  if($row['gameid']==$roww['id']){
         if($row['userid']==$_SESSION['id']) {
     	?>
     	 <a href="commentupdate.php?id=<?php echo $row['id'] ?>&&gameid=<?php echo $row['gameid'] ?>">
     	 update
     	</a>
     	<br>
     	 <?php  }} ?>
     	<?php }} ?>
         <footer class="bg-dark text-white foot">
     <div class="row" style="margin-right: 0px;">
      <div class="col-sm-6">
         <h4 class="footheading">ABOUT US</h4>
         <p class="footpa1">Game store is the website where you can upload game and download game Copy right under the law of right of property</p><br>
         <i class="fab fa-facebook-square fa-2x"></i>
           <i class="fab fa-twitter-square fa-2x" ></i>
           <i class="fab fa-youtube fa-2x" ></i>
           <i class="fab fa-instagram fa-2x"></i>
      </div>
      <div class="col-sm-6"> 
         <h4 class="footheading">ADDRESS</h4>
       <i class="fas fa-map-marker-alt fa-2x footi"></i>
      <p class="footpa">Shubhal,Lalitpur</p><br>
      <i class="fas fa-phone fa-2x footi"></i>
        <p class="footpa">++9846983492</p><br>
        <i class="fas fa-envelope fa-2x footi"></i>
       <p class="footpa">gamestore@gmail.com</p><br>
       </div>
    </div>
    <p  class="last">Made with <i class="fas fa-heart"></i> and <i class="fas fa-coffee"></i></p>
  </div>
  </footer>

<?php
// $sql="SELECT * FROM feedback";
//  $result = $connection->query($sql);

//            $data = [];
           
//            if ($result->num_rows > 0) {
//              while ($row = $result->fetch_assoc()) {
//                array_push($data, $row);
//              }
//            }
?>
  <!-- <table border="1">
  <tr>
    <th>SN</th>  
    <th>comment</th>
    <th>delete</th>
    <th>update</th>
    </tr>     -->
     <?php //foreach($data as $key => $value){ ?>
        <!-- <tr>
        	<td> --><?php //echo $key+1 ?><!-- </td>
           <td>
         <a> --><?php 
         // if($value['gameid']==$roww['id']){
         //  echo $value['comment'];
         // }
        ?><!-- </a>
     </td>
     <td> -->
     	<?php
     	 // if($value['gameid']==$roww['id']){
       //   if($value['userid']==$_SESSION['id']) {
     	?>
     	<!--  <a href="deletecomment.php?id=<?php // echo $value['id'] ?>&&gameid=<?php //echo $value['gameid'] ?>" onclick="return confirm('Are you sure to delete?')">
     	 Delete
     	</a> -->
     	 <?php //}} ?>
     <!-- </td>
     <td> -->
     	<?php
     	 // if($value['gameid']==$roww['id']){
       //   if($value['userid']==$_SESSION['id']) {
     	?>
     	<!--  <a href="commentupdate.php?id=<?php //echo $value['id'] ?>&&gameid=<?php // echo $value['gameid'] ?>">
     	 update
     	</a> -->
     	 <?php //}} ?>	
     <!-- </td>
     </tr> -->
      <?php //} ?>
   <!--  </table> -->
</body>
</html>
