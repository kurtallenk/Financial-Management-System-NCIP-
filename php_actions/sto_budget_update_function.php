<?php
if(isset($_POST['update_btn'])){
	include "../php_actions/database_connect.php";
	
	$budget = $_POST['budget'];
	
	$sql_update = "UPDATE agency SET agency_budget='$budget' WHERE agency_id=2";
	
	
		if ($connect->query($sql_update) === TRUE) {	
				  echo "New record created successfully";
				
				  $connect->close();
				  header("Location: ../index.php?o=sto");
				  exit();
		}
		else {
				echo "Error: " . $sql . "<br>" . $connect->error;
		}
}

?>