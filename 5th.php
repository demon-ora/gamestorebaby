<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>َAnimated regestation Form</title>
    <link rel="stylesheet" href="css/stylee.css">
  </head>
  <body>
    <?php
 if (isset($_POST['login'])) {
  //array to store error list
  $reg="/^[a-z]{8,12}+$/";
  $reg1="/^[a-z0-9]{8,12}+$/";
  $err = [];
  //check username
  if (isset($_POST['name']) && !empty($_POST['name'])) {
    if(preg_match($reg, $_POST['name'])){
    $name =  $_POST['name'];
  }
  else{
     $err['name'] =  '<span style="color:white">Enter valid name</span>';
  }
  } else {
    $err['name'] =  '<span style="color:white">Enter name</span>';
  }
  //check email
   if (isset($_POST['email']) && !empty($_POST['email'])) {
    $email =  $_POST['email'];
  } else {
    $err['email'] =  '<span style="color:white">Enter email</span>';
  }
  

  //check password
  if (isset($_POST['password']) && !empty($_POST['password'])) {
        if(preg_match($reg1, $_POST['password'])){
    $pass =  $_POST['password'];
    $passs =md5($pass);
  } else{
     $err['password'] =  '<span style="color:white">Enter valid password</span>';
  } }
  else {
    $err['password'] =  '<span style="color:white">Enter password</span>';
  }
  //print_r($_POST); 
  
  if (count($err) == 0) {
    //include database connection 
    require_once 'database.php';
    //sql query to insert data into database taken from form
    $sql = "INSERT INTO users(name,email,password) VALUES ('$name','$email','$passs')";
    //execute query
    if ($connection->query($sql)){ 
     session_start();
     $_SESSION['msg']="<h1 style='color:white;'>account sucessfully created</h1>"; 
     header("location:index.php ");
    } else {
      die("Category creation failed $connection->error");
    }
    //connection close
    $connection->close();
  }
 }
  //check error array to ensure that there is no error occured yet s

?>
<form  class="box" action="" method="post">
  <h1>regestation form</h1>
  <input type="text" name="name" placeholder="name">
    <?php 
      if (isset($err['name'])) {
        echo $err['name'];
      }
     ?>
  <input type="email" name="email" placeholder="type your email">
    <?php 
      if (isset($err['email'])) {
        echo $err['email'];
      }
     ?>
  <input type="password" name="password" placeholder="password">
      
 <?php 
      if (isset($err['password'])) {
        echo $err['password'];
      }
     ?>
 <input type="submit" name="login" value="Login">
</form>
 </body>
 </html>