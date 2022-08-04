<?php 
require_once "database.php";

$id = $_GET['id'];

//query to delete data into table
$sql = "DELETE FROM game WHERE id='$id'";

if ($connection->query($sql)){	
	echo "Category deleted successfully";
} else {
	die("Category delete failed $connection->error");
}

//connection close
$connection->close();

header('location:userdashboardgamee.php');

 ?>