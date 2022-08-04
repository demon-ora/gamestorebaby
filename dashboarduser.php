<?php 
session_start();
if (!isset($_SESSION['username'])) {
  header('location:index.php?key=1');
}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Game store</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/home.css">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="icon/all.min.css">
<link rel="stylesheet" type="text/css" href="css/dashboarduser.css">
	<link rel="stylesheet" type="text/css" href="jquery/jquery.js">
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="bootstrap/js/bootstrap.bundle.min.js">
  <link rel="stylesheet" type="text/css" href="bootstrap/js/bootstrap.min.js">
</head> 
<body>
 <div id="wrapper">
   <!--side bar-->
   <div id="sidebar-wrapper" style="position:fixed">
     <ul class="sidebar-nav">
       <li><a href="#" class="logo"><img src="img/c.png " width="50px" height="50px">Dashboard</a></li>
       <li><a href="dashboard.php"><i class="fas fa-home"></i>Home</a></li>
       <li><a href="dashboarduser.php" ><i class="fas fa-user-alt"></i>User</a></li>
       <li><a href="dashboardgamee.php"><i class="fas fa-gamepad"></i>Game</a></li>
        <li><a href="dashboardgamee.php"><i class="fas fa-comments"></i>Game</a></li>
       <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
      </ul>
    </div>
   <!--page content-->
    <div id="page-content-wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <a href="#" class="btn btn-success" id="menu-toggle">toggle menu</a>
            <br>
            <?php require_once 'menu.php';?>
<?php 
// require_once 'database.php';
// $sql = "SELECT count(name) from users";
// $result = $connection->query($sql);
//   if ($result->num_rows > 0) {
//   $row = $result->fetch_assoc();
//   print_r($row);
//   }
   ?>
  <!--for displaying all the data -->
  <?php 
require_once 'database.php';
//query to select data from category table
$sql = "SELECT * FROM users ";
//execute query and get result object
$result = $connection->query($sql);

$data = [];

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    array_push($data, $row);
  }
}
 ?>
 <table class="table table-striped">
      <thead class="thead-dark">
  <tr>
    <th>SN</th>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>password</th>
     <th>delete</th>
     <th>update</th>
  </tr>
</thead>
<?php foreach($data as $key => $value){ ?>
  <tr>
    <td><?php echo $key+1 ?></td>
    <td><?php echo $value['id'] ?></td>
    <td><?php echo $value['name'] ?></td>
    <td><?php echo $value['email'] ?></td>
    <td><?php echo $value['password'] ?></td>
    <td>
      <a href="delete.php?id=<?php echo $value['id'] ?>" onclick="return confirm('Are you sure to delete?')"><i class="fas fa-trash-alt fa-2x"></i></a></td>
     <td> <a href="edit.php?id=<?php echo $value['id'] ?>"><button type="button" class="btn btn-warning">edit</button></a>
    </td>
  </tr>
 <?php } ?>
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
  </body>
</html>