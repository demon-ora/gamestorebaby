<?php
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'project';

//create connection
$connection = new mysqli($server,$username,$password,$database);
//check connection error
if ($connection->connect_errno != 0) {
	die('Connection error');
}
?>
