<?php
date_default_timezone_set('Asia/Kuala_Lumpur');

include "database_connect.php";
	
if(isset($_POST['save_print_ors_btn'])){
	
	$serialnum = $_POST['serialnum'];
	$payee = $_POST['payee'];
	$date_ors = date("Y/m/d");
	
	
	$rc = $_POST['rc'];
	$agency   = $_POST["agency"];
	$project  = $_POST["project"];
	$uacs  = $_POST["uacs"];
	$amount  = $_POST["particularAmount"];
	$date = date("Y/m/d");
	
	$current_id = "";
	
	$sql_ors_add = "INSERT INTO ors (serial_number, payee,project ,date_added) VALUES ('$serialnum','$payee','$project','$date_ors')";
	
	if ($connect->query($sql_ors_add) === TRUE) {
			  echo "New record created successfully";
			  $current_id = $connect->insert_id;
				
			//ACTIVITY
			$time=date('H:i:s');
			$date=date('Y-m-d');
			$activity="";
			$activity="Added ORS with Serial Number: ".$serialnum;
			
			$sql_activity_add = "INSERT INTO activity (activity, activity_time, activity_date, action) VALUES('$activity', '$time', '$date', 'Add')";
			$connect->query($sql_activity_add); 

			  $connect->close();
			  header("Location: ../index.php?o=ors_particulars&ors_id=".$current_id);
			  exit();
	}
	else {
		echo "Error: " . $sql_ors_add . "<br>" . $connect->error;
	}
	
}

?>