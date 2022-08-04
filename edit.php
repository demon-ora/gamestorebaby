<?php 
require_once "database.php";
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
   <div id="sidebar-wrapper">
     <ul class="sidebar-nav">
       <li><a href="#" class="logo"><img src="img/c.png " width="50px" height="50px">Dashboard</a></li>
       <li><a href="dashboard.php"><i class="fas fa-home"></i>Home</a></li>
       <li><a href="dashboarduser.php" ><i class="fas fa-user-alt"></i>ListUser</a></li>
       <li><a href="dashboardgamee.php"><i class="fas fa-gamepad"></i>Game</a></li>
       <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
      </ul>
    </div>
   <!--page content-->
    <div id="page-content-wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
	     <?php require_once 'menu.php';?>
<?php 
//check button click/ form submission
if (isset($_POST['btnUpdate'])) {
	//create blank array to store form error
	$err = [];
	//check empty and trim data(remove space) for name
	if (isset($_POST['name']) && !empty($_POST['name']) && trim($_POST['name']) != '') {
		//fetch name form $_POST array and save into variable
		$name = $_POST['name'];
	} else {
		//store error message into $err array
		$err['name'] = 'Enter name';
	}

	if (isset($_POST['email']) && !empty($_POST['email']) && trim($_POST['email']) != '') {
		//fetch name form $_POST array and save into variable
		$email = $_POST['email'];
	} else {
		//store error message into $err array
		$err['email'] = 'Enter email';
	}
   
   if (isset($_POST['password']) && !empty($_POST['password']) && trim($_POST['password']) != '') {
		//fetch name form $_POST array and save into variable
		$pass = $_POST['password'];
	} else {
		//store error message into $err array
		$err['password'] = 'Enter password';
	}

	$id = $_POST['id'];

	//count no of error into form
	if (count($err) == 0) {
		//include database connection 
		require_once 'database.php';
		//sql query to insert data into database taken from form
		$sql = "UPDATE users SET name='$name',email='$email',password='$pass' where id='$id'";
		//execute query
		if ($connection->query($sql)){	
			echo "Category Updated successfully";
		} else {
			die("Category updated failed $connection->error");
		}
		
	}
}

$id = $_GET['id'];

$sql = "SELECT * FROM users WHERE id='$id'";

$result = $connection->query($sql);

$row = $result->fetch_assoc();
//connection close
		$connection->close();
?>
<h1>Form to Edit Data</h1>
<form action="" method="post">
	<input type="hidden" name="id" value="<?php echo $row['id'] ?>">
	<label for="name">Name</label>
	<input type="text" name="name" id="name" value="<?php echo $row['name'] ?>">
	<?php 
	if (isset($err['name'])) {
		echo $err['name'];
	}
	 ?>
	<br>
	<label for="name">email</label>
	<input type="email" name="email" id="email" value="<?php echo $row['email'] ?>">
	<?php 
	if (isset($err['email'])) {
		echo $err['email'];
	}
	 ?>
	 <br>
	 <label for="name">password</label>
	<input type="password" name="password" id="password" value="<?php echo $row['password'] ?>">
	<?php 
	if (isset($err['password'])) {
		echo $err['password'];
	}
	 ?>
	<button type="submit" name="btnUpdate">Update</button>
</form>
</div>
</div>
</div>
</div>
</body>
</html>