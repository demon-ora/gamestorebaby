<?php 
require_once "database.php";

$id = $_GET['id'];
$gameid=$_GET['gameid'];

//query to delete data into table
$sql = "DELETE FROM feedback WHERE id='$id'";

if ($connection->query($sql)){	
	echo "Category deleted successfully";
} else {
	die("Category delete failed $connection->error");
}

//connection close
$connection->close();
 header('location:testonepage.php?id='.$gameid);

 ?>