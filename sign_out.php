<?php

if(isset($_GET['q'])){
	$user_id=$_GET['q'];
}

// set the expiration date to one hour ago
setcookie("user", null, time() - 3600, "/");

if(count($_COOKIE) > 0) {
	echo "Cannot Sign Out.";
}
else{
	
	header('Location: login_page.php');
	exit;
}

header("Refresh:0");
?>