<?php 
session_start();
if (isset($_SESSION['msg'])) {
	echo $_SESSION['msg'];
}
 ?>
<?php
//check button click status
if (isset($_POST['login'])) {
	//array to store error list
	$err = [];

	//check username
	if (isset($_POST['username']) && !empty($_POST['username'])) {
		$uuname =  $_POST['username'];
	} else {
		$err['username'] =  '<span style="color:white">Enter username</span>';
	}

	//check password
	if (isset($_POST['password']) && !empty($_POST['password'])) {
		$ppword =  $_POST['password'];
		$pppword= md5($ppword);
	} else {
		$err['password'] =  '<span style="color:white">Enter password</span>';
	}
	//check error array to ensure that there is no error occured yet 
	if (count($err)==0) {
		require_once'database.php';
		$sql = "SELECT * FROM users where name='$uuname' && password='$pppword'";
		  $result = $connection->query($sql);
		  $check=$result->num_rows;
		//define list of users as an array
		if($uuname=='ora' && $ppword=='oraora'){
			$_SESSION['username']=$uuname;
			header('location:dashboard.php');
		}elseif($check==1){
			if($row = $result->fetch_assoc()){
				if($pppword == $row['password']){
                 $_SESSION['username']=$uuname;
                  $_SESSION['id']=$row['id'];
			  header('location:home.php');
				}
			}
		}
		else{
			echo '<span style="color:white">Username or password is not correct</span>';
		}
	}
}
 ?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>Array Login Form</title>
</head>
<body>
	<?php 
	// if (isset($_GET['key']) && $_GET['key'] == 1) {
	// 	echo ' Please login to access your dashboard';
	// }
	 ?>
	<!-- 
		Session is serverside global variable to store user data .
		we need session data to transfer data from page to page.
		Common uses-
		Login form
		Add to cart for ecommerce
		Multipage form

		* we need to start session before we use session related data
	 -->

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="box">
	<h1>Login Form</h1>
	<div class="form-element">
		<label style="color:white">Username</label>
		<input type="text" name="username" placeholder="enter username">
		<?php 
			if (isset($err['username'])) {
				echo $err['username'];
			}
		 ?>
	</div>
	<div class="form-element">
		<label style="color:white">Password</label>
		<input type="password" name="password" placeholder="enter password">
		<?php 
			if (isset($err['password'])) {
				echo $err['password'];
			}
		 ?>
	</div>
	<div class="form-element">
		<input type="submit" value="Login" name="login">
	</div>
	<button><a href="5th.php">create account</a></button>
</form>
</body>
</html>