<?php 	

$localhost = "127.0.0.1:3307";
$username = "root";
$password = "";
$dbname = "ncip_ftms_db";

// db connection
$connect = new mysqli($localhost, $username, $password, $dbname);
// check connection
if($connect->connect_error) {
  die("Connection Failed : " . $connect->connect_error);
} else {
  // echo "Successfully connected";
}

?>