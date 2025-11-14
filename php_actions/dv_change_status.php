<?php

include "database_connect.php";

if(isset($_POST['dv_id']) && $_POST['dv_status']){
	$dv_id = $_POST['dv_id'];
	$dv_status = $_POST['dv_status'];
	$dv_number = "";

	$sql_get_dv = "SELECT * FROM disbursement WHERE dv_id=".$dv_id;
	$result_get_dv = $connect->query($sql_get_dv);
	
	if($result_get_dv->num_rows > 0){
			// output data of each row
		while($row_get_dv = $result_get_dv->fetch_assoc()) {
			$dv_number = $row_get_dv['dv_number'];
		}
	}


	$sql_dv_status = "UPDATE disbursement SET dv_status='$dv_status' WHERE dv_id=$dv_id";
	

		if ($connect->query($sql_dv_status) === TRUE) {	
			echo "New record updated successfully";	
			
			//ACTIVITY
			$time=date('H:i:s');
			$date=date('Y-m-d');
			$activity="Changed Status DV#: ".$dv_number.". Status: ".$dv_status;
			
			$sql_activity_add ="INSERT INTO activity(activity, activity_time, activity_date, action) VALUES('$activity', '$time', '$date', 'Add')";
			if($connect->query($sql_activity_add)){
				$connect->close();
			  header("Location: ../index.php?o=dv");
			  exit();
			  
			}
			else{
				echo "Error: " . $sql_activity_add . "<br>" . $connect->error;
			}
			//ACTIVITY END
		}
		else {
			echo "Error: " . $sql_dv_status . "<br>" . $connect->error;
		}
}
else{
	
	header("Location: ../index.php?o=home");
	exit();
	
}
?>