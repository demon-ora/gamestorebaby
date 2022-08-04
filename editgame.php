 <?php 
require_once "database.php";
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
<link rel="stylesheet" type="text/css" href="css/dashboardgame.css">
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="jquery/jquery.js">
  <link rel="stylesheet" type="text/css" href="jquery/mixitup.min.js">
  <link rel="stylesheet" type="text/css" href="bootstrap/js/bootstrap.bundle.min.js">
  <link rel="stylesheet" type="text/css" href="bootstrap/js/bootstrap.min.js">
</head> 
<body>
<!-- <body> -->
 <div id="wrapper">
   <!--side bar-->
   <div id="sidebar-wrapper" style="position: fixed;">
     <ul class="sidebar-nav">
       <li><a href="#" class="logo"><img src="img/c.png" width="50px" height="50px">Dashboard</a></li>
       <li><a href="dashboard.php"><i class="fas fa-home"></i>Home</a></li>
       <li><a href="dashboarduser.php" ><i class="fas fa-user-alt"></i>User</a></li>
       <li><a href="dashboardgamee.php"><i class="fas fa-gamepad"></i>ADDGame</a></li>
       <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
      </ul>
    </div>
   <!--page content-->
    <div id="page-content-wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
  
  <?php
if (isset($_POST['btnupdate'])) {
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
      $ok=$_POST['oldimage'];  //initializing url with old one
      // echo "old image url =".$ok."<br>";

  if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK){
     $files= $_FILES['image'];
    $fileName=$files['name'];
    $fileSize=$files['size'];
    $fileTmpLoc=$files['tmp_name'];
    $fileError=$files['error'];

    $f = explode(".", $fileName);
   // var_dump($f);
    $fileExt = strtolower($f[1]);
    //var_dump($fileExt);
    $allowedExt = array('png','jpg','docx');
  
    if (in_array($fileExt, $allowedExt)){
      if($fileSize < 200000){
        $dest_path = 'uploadd/' . $fileName;
        move_uploaded_file($fileTmpLoc, $dest_path);
        $ok=$dest_path;  //over writing new url if image is kept
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
      // $ok=$_POST['image'];

   } 

  //check gameurl
     $loc=$_POST['oldgameurl'];
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
      $err['gameurl'] = 'Large image size';
    }
  } else {
   // $err['gameurl'] = 'File upload error';
  }

     
     
 
  $descripation=$_POST['descripation'];
  $id=$_POST['id'];
  // echo "<br> new image url=".$ok."<br>";
// print_r($_POST);

  if (count($err) == 0) {
    //include database connection 
    require_once 'database.php';
    //sql query to insert data into database taken from form
    $sql = "UPDATE game SET title='$title',catagories='$cate',type='$gametype',image='$ok',url='$loc',descripation='$descripation'where id='$id'";
    //execute query
    if ($connection->query($sql)){  
        echo"game update successfully";
    } else {
    die("Category creation failed $connection->error");
    }
    //connection close
  } 
}
$id = $_GET['id']; 

$sqll = "SELECT * FROM game WHERE id='$id'";

$resultt = $connection->query($sqll);

$roww = $resultt->fetch_assoc();
// print_r($roww);
    $connection->close();

  ?>
   <form method="post" enctype="multipart/form-data">
            <h1>Edit game</h1>
            <input type="hidden" name="id" value="<?php echo $roww['id'] ?>">
           <label> Enter title of game</label><br>
            <input type="text" name="title" value="<?php echo $roww['title'] ?>">
              <?php 
                        if (isset($err['title'])) {
                        echo $err['title'];
                        }
                      ?><br>
                <input type="radio" id="normal" name="cate" value="1"
                <?php if($roww['catagories']==1){
                  echo"checked";
                }  ?>
                >
                 <label for="normal">modedgame</label><br>
                 <input type="radio" id="moded" name="cate" value="0" 
                  <?php if($roww['catagories']==0){
                  echo"checked";
                }  ?>
                >
                 <label for="moded">normalgame</label><br>
                  <?php 
                        if (isset($err['cate'])) {
                        echo $err['cate'];
                        }
                      ?>
               <select name="gametype" class="custom-select">
              <option selected value="">Custom Select Menu</option>
              <option value="action"
              <?php if($roww['type']=='action'){
                echo"selected";
              } ?>
              >action</option>
              <option value="arcade"
              <?php if($roww['type']=='arcade'){
                echo"selected";
              } ?>
              >arcade</option>
              <option value="adventure"
              <?php if($roww['type']=='adventure'){
                echo"selected";
              } ?>
              >adventure</option>
              <option value="puzzel"
              <?php if($roww['type']=='puzzel'){
                echo"selected";
              } ?>
              >puzzel</option>
              <option value="sport"
              <?php if($roww['type']=='sport'){
                echo"selected";
              } ?>
              >sport</option>
             </select>
              <?php 
                if (isset($err['gametype'])) {
                   echo $err['gametype'];
                           }
                ?><br><br>
               <p>Choose image of game:</p>
           <input type="file" id="myFile" name="image" >
              <input type="hidden" id="myFile" name="oldimage" value="<?php echo $roww['image'] ?>" >
              <?php echo $roww['image'] ?>
            <?php 
               if (isset($err['image'])) {
               echo $err['image'];
                 }
            ?><br><br>
              <p>Custom game:</p>
              <input type="file" id="myFile" name="gameurl">

              <input type="hidden" id="customFile" name="oldgameurl" value="<?php echo $roww['url'] ?>">
                  <?php echo $roww['url'] ?>
              <?php 
               if (isset($err['gameurl'])) {
               echo $err['gameurl'];
                }
               ?><br>
             <label for="something">Write something about game:</label>
              <textarea class="form-control" rows="5" id="something" name="descripation"><?php echo $roww['descripation'] ?></textarea>
               <div class="mt-3">
                 <button type="submit" class="btn btn-primary" value="save" name="btnupdate">Submit</button>
               </div>
           </form> 
           </div>
       </div>
      </div>
    </div>
 </body>
 </html>
 