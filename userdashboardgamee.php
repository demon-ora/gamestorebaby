 <?php 
session_start();
if (!isset($_SESSION['username'])) {
  header('location:index.php?key=1');
}
 ?>
 <?php
if (isset($_POST['btnsave'])) {
  //array to store error list
  $err = [];
  //validate title
  if(isset($_POST['title']) && !empty($_POST['title'])){
    $title=$_POST['title'];
  }
  else
  {
  $err['title']=$_POST['title'];  
  }
   //validate categories
  if (isset($_POST['cate'])) {
    $cate=  $_POST['cate'];
  } 
  else {
    $err['cate'] =  '<span style="color:red">choose categories</span>';
  }
   //validate gametype
  if ($_POST['gametype']=="") {
    $err['gametype'] =  '<span style="color:red">choose game type</span>';
  }
  else{
    $gametype=  $_POST['gametype'];
  } 
  
     
 // validate image
  
  if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK){
    $files= $_FILES['image'];
    $fileName=$files['name'];
    $fileSize=$files['size'];
    $fileTmpLoc=$files['tmp_name'];
    $fileError=$files['error'];

    $f = explode(".", $fileName);
    var_dump($f);
    $fileExt = strtolower($f[1]);
    var_dump($fileExt);
    $allowedExt = array('png','jpg','docx');
  
    if (in_array($fileExt, $allowedExt)){
      if($fileSize < 2000000){
        $dest_path = 'uploadd/' . $fileName;
        move_uploaded_file($fileTmpLoc, $dest_path);
        $ok=$dest_path; 
      }
      else{
       $err['image'] =  '<span style="color:red">size is bigger</span>';
      }
    }
    else{
      $err['image'] =  '<span style="color:red">not correct type</span>';
   } 
 }
   else{
     $err['image'] =  '<span style="color:red">upload photo</span>';
   }       

  //check gameurl
  
      if (isset($_FILES['gameurl']['error']) && $_FILES['gameurl']['error'] == 0) {
    //check size
    if ($_FILES['gameurl']['size'] <= 200000000) {
      //check type
      $types = ['application/vnd.android.package-archive'];
      if (in_array($_FILES['gameurl']['type'], $types)) {
        if (file_exists('images/' . $_FILES['gameurl']['name'])) {
          //generate random file name
          $file_name = uniqid() . '_' . $_FILES['gameurl']['name'];
        } else {
          $file_name = $_FILES['gameurl']['name'];
        }
        //upload file to server: move to our project folder
        if (move_uploaded_file($_FILES['gameurl']['tmp_name'], 'gamefolder/' . $file_name)) {
         $loc='gamefolder/' . $file_name;
          echo 'File upload success';
        }else {
          $err['gameurl'] = 'File can not move to our folder';
        }
      } else {
        $err['gameurl'] = 'Invalid file type';
      }
    } else {
      $err['gameurl'] = 'Large game size';
    }
  } else {
    $err['gameurl'] = 'File upload error';
  }
  $descripation=$_POST['descripation'];


  if (count($err) == 0) {
    //include database connection 
    require_once 'database.php';
    $useridd= $_SESSION['id'];
    //sql query to insert data into database taken from form
    $sql = "INSERT INTO game(useridd,title,catagories,type,image,url,descripation) VALUES ('$useridd','$title','$cate','$gametype','$ok','$loc','$descripation')";
    //execute query
    if ($connection->query($sql)){  
    header("location:userdashboardgamee.php");
    } else {
    die("Category creation failed $connection->error");
    }
    //connection close
    $connection->close();
  } 
}

  ?>
<!DOCTYPE html>
<html>
<head>
	<title>Game store</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- <link rel="stylesheet" type="text/css" href="css/home.css"> -->
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="icon/all.min.css">
<link rel="stylesheet" type="text/css" href="css/userdashboardgame.css">
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="jquery/jquery.js">
  <link rel="stylesheet" type="text/css" href="jquery/mixitup.min.js">
  <link rel="stylesheet" type="text/css" href="bootstrap/js/bootstrap.bundle.min.js">
  <link rel="stylesheet" type="text/css" href="bootstrap/js/bootstrap.min.js">
</head> 
<!-- <body> -->
 <div id="wrapper">
   <!--side bar-->
   <div id="sidebar-wrapper">
     <ul class="sidebar-nav">
       <li><a href="#" class="logo"><img src="img/c.png" width="50px" height="50px">Dashboard</a></li>
       <li><a href="userdashboard.php"><i class="fas fa-home"></i>Dashboard home</a></li>
       <li><a href="userdashboardgamee.php"><i class="fas fa-gamepad"></i>Game</a></li>
       <li><a href="home.php"><i class="fas fa-sign-out-alt"></i>Homepage</a></li>
      </ul>
    </div>
   <!--page content-->
    <div id="page-content-wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <a href="#" class="btn btn-success" id="menu-toggle">toggle menu</a>
          <form method="post" enctype="multipart/form-data">
            <h1>Upload game</h1>
               <label> Enter title of game</label><br>
            <input type="text" name="title">
            <?php 
                        if (isset($err['title'])) {
                        echo $err['title'];
                        }
                      ?><br>
                <input type="radio" id="normal" name="cate" value="1">
                 <label for="normal">modedgame</label><br>
                 <input type="radio" id="moded" name="cate" value="0">
                 <label for="moded">normalgame</label><br>
                  <?php 
                        if (isset($err['cate'])) {
                        echo $err['cate'];
                        }
                      ?>
               <select name="gametype" class="custom-select">
              <option selected value="">Custom Select Menu</option>
              <option value="action">action</option>
              <option value="arcade">arcade</option>
              <option value="adventure">adventure</option>
              <option value="puzzel">puzzel</option>
              <option value="sport">sport</option>
             </select>
              <?php 
                if (isset($err['gametype'])) {
                   echo $err['gametype'];
                           }
                ?><br><br>
               <p>Choose image of game:</p>
           <input type="file" id="myFile" name="image">
            <?php 
               if (isset($err['image'])) {
               echo $err['image'];
                 }
            ?><br><br>
              <p>Custom game:</p>
              <input type="file"  name="gameurl">
              <?php 
               if (isset($err['gameurl'])) {
               echo $err['gameurl'];
                }
               ?><br>
             <label for="something">Write something about game:</label>
              <textarea class="form-control" rows="5" id="something" name="descripation"></textarea>
               <div class="mt-3">
                 <button type="submit" class="btn btn-primary" value="save" name="btnsave">Submit</button>
               </div>
           </form> 
             <hr>
                      <?php 
require_once 'database.php';
//query to select data from category table
$sql = "SELECT * FROM game order by id asc ";
//execute query and get result object
$result = $connection->query($sql);

$data = [];

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    array_push($data, $row);
  }
}
 ?>
  <table  style="font-size: 0.9375rem;" class="table table-striped">
  <thead class="thead-dark">
  <tr>
    <th>title</th>
    <th>Game catagories</th>
    <th>Game Type</th>
    <th>Image</th>
     <th>Gameurl</th>
     <th>descripation</th>
     <th>Delete</th>
     <th>Update</th>
  </tr>
</thead>
<?php foreach($data as $key => $value){ ?>
   <?php if($value['useridd']== $_SESSION['id']){ ?>
  <tr>
    <td><?php 
  if($value['useridd']== $_SESSION['id']){
    echo $value['title'];
      } ?>
      </td>
    <td><?php 
   if($value['useridd']== $_SESSION['id']){
    if($value['catagories']==1){
    echo"moded game" ;}
    else{
      echo"normal game";
    }}
      ?></td>
    <td><?php
     if($value['useridd']== $_SESSION['id']){
     echo $value['type'];}
      ?> 
     </td>
    <td><?php
     if($value['useridd']== $_SESSION['id']){ ?>
     <img src="<?php echo $value['image'] ?>" height="50" width="50" style="object-fit: cover;">
    <?php  } ?>
     </td>
    <td><?php
     if($value['useridd']== $_SESSION['id']){
     echo $value['url']; 
       } ?>
     </td>
    <td><?php 
     if($value['useridd']== $_SESSION['id']){
    echo $value['descripation'];
       } ?>
    </td>
    <td><?php
      if($value['useridd']== $_SESSION['id']){ ?>
      <a href="deletegameuser.php?id=<?php echo $value['id'] ?>" onclick="return confirm('Are you sure to delete?')"><i class="fas fa-trash-alt fa-2x"></i></a>
    <?php } ?>
    </td>
     <td> 
      <?php
      if($value['useridd']== $_SESSION['id']){ ?>
      <a href="editgameuser.php?id=<?php echo $value['id'] ?>"><button type="button" class="btn btn-warning">edit</button></a>
       <?php } ?>
    </td>
  </tr>
 <?php }} ?>
 </table>
         </div>
       </div>
      </div>
    </div>
  <!--menu toggle script-->
    <script>
      $("#menu-toggle").click(function(e){
       e.preventDefault();
      $("#wrapper").toggleClass("menuDisplayed");

      })
   </script>
   <?php  // print_r($_SESSION);
   ?>
  </body>
</html>