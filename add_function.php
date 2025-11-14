<?php
date_default_timezone_set('Asia/Kuala_Lumpur');

$agency_id=$_POST['id'];
	$program = $_POST['program'];
	$project = $_POST['project'];
	$uacs = $_POST['uacs'];
	$rc = $_POST['rc'];
	$allotment = $_POST['allotment'];
	$classCategory = $_POST['classCategory'];
	$budget = $_POST['budget_value'];

if(isset($_POST['add_btn'])){
	include "php_actions/database_connect.php";
	
	$sql_add = "INSERT INTO specific_budget (agency_id, program_id, project, uacs_id,responsibility_center, allotment, class_category, specific_budget_amount) VALUES ('$agency_id','$program','$project', '$uacs','$rc','$allotment','$classCategory','$budget')";
	
	if ($connect->query($sql_add) === TRUE) {	
			  echo "New record created successfully";
			  
			  //UPDATE GAS BUDGET
				//GET GAS BUDGET
				$sql_agency_gas = "SELECT * FROM agency WHERE agency_id=$agency_id";
				$result_agency_gas = $connect->query($sql_agency_gas);
				
				$agency_budget=0;//BUDGET
				$agency_name="";

				if ($result_agency_gas->num_rows > 0) {
							// output data of each row
							while($row_agency_gas = $result_agency_gas->fetch_assoc()) {
								$agency_budget = $row_agency_gas['agency_budget'];
								$agency_name = $row_agency_gas['agency_name'];
							}
				}
			//PROGRAM BUDGET DEDUCT to AGENCY BUDGET
				$new_agency_budget = $agency_budget - $budget; 
			
				$sql_gas_budget_update="UPDATE agency SET agency_budget='$new_agency_budget' WHERE agency_id=$agency_id";
				//UPDATE GAS BUDGET
				$connect->query($sql_gas_budget_update); 
			//
			
			//ACTIVITY
			$time=date('H:i:s');
			$date=date('Y-m-d');
			$activity="Added ".$project." on ".$agency_name;
			
			$sql_activity_add = "INSERT INTO activity (activity, activity_time, activity_date, action) VALUES('$activity', '$time', '$date', 'Add')";
			
			$connect->query($sql_activity_add); 
			
			$agency_name=strtolower($agency_name);
			  $connect->close();
			  header("Location: index.php?o=".$agency_name);
			  exit();
	}
	else {
			echo "Error: " . $sql_add . "<br>" . $connect->error;
	}
}

else {
	echo "Error: " . $sql_add . "<br>" . $connect->error;
	
}
?>