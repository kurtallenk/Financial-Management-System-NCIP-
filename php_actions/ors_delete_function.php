<?php
date_default_timezone_set('Asia/Kuala_Lumpur');
$ors_id=$_POST['ors_id'];
$ors_serial_num=$_POST['ors_serial_num'];

include "../php_actions/database_connect.php";

$sql_delete_part = "DELETE FROM ors_particulars WHERE ors_id=$ors_id";
$sql_delete = "DELETE FROM ors WHERE ors_id=$ors_id";


	//DELETE	
	if ($connect->query($sql_delete_part) === TRUE) {
		if ($connect->query($sql_delete) === TRUE) {

			//ACTIVITY
			$time=date('H:i:s');
			$date=date('Y-m-d');
			$activity="";
			$activity="Deleted ORS with Serial Number: ".$ors_serial_num;
			
			$sql_activity_add = "INSERT INTO activity (activity, activity_time, activity_date, action) VALUES('$activity', '$time', '$date', 'Delete')";
			$connect->query($sql_activity_add); 
			
					$connect->close();
					  header("Location: ../index.php?o=ors");
					  exit();
		}	
		else {
			echo "Error: " . $sql_delete . "<br>" . $connect->error . "<br>";
		}
	}
	else {
			echo "Error: " . $sql_delete_part . "<br>" . $connect->error . "<br>";
	}
?>