<?php
include "php_actions/database_connect.php"; 

if(isset($_POST['login'])){
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	$user_id="";

	//$hashed_password = password_hash($password, PASSWORD_DEFAULT);
	$hashed_password_db='';

	//GET PASSWORD HASH
	$sql_user = "SELECT * FROM user WHERE username='$username';";
	$result_user = $connect->query($sql_user);

		if($result_user -> num_rows > 0){
			while($row_user = $result_user->fetch_assoc()){
				$hashed_password_db=$row_user['password'];
				$user_id = $row_user['user_id'];
			}
			
			if(password_verify($password, $hashed_password_db)){
				echo $password." Password CORRECT!";
				
				//SET COOKIES (86400 = 1 day)
				$cookie_name = "user";
				$cookie_value = $user_id;
				setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
				
				header('Location: index.php?o=home');
				exit;

			}
			else{
				echo $password." Password WRONG!";
			}
		}
	// GET PASSWORD HASH END

	// ELSE IF USER NOT EXIST - REDIRECT BACK TO LOGIN PAGE
		else{
			header('Location: login_page.php?loginfailed=1');
			exit;
		}
}
else{
	header('Location: login_page.php');
	exit;
}



?>