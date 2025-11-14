<?php
date_default_timezone_set('Asia/Kuala_Lumpur');
if(isset($_POST['add_btn'])){
	include "php_actions/database_connect.php";
	
	//$sub_agency = $_POST['sub_agency'];
	
	$agency_id=$_POST['agency_id'];
	$program = $_POST['program'];
	$subprogram = $_POST['subprogram'];
	$project = $_POST['project'];
	$uacs = $_POST['uacs'];
	$allotment = $_POST['allotment'];
	$classCategory = $_POST['classCategory'];
	
	$withsub = true;
	
	$sql_add = "INSERT INTO sub_program_budget (agency_id, program_id, sub_program_id,uacs_id, project, allotment, class_category) VALUES ('$agency_id','$program','$subprogram','$uacs','$project','$allotment','$classCategory')";
	
	$last_id=0;
	
	if ($connect->query($sql_add) === TRUE) {	
			  echo "New record created successfully";
			  $last_id = $connect->insert_id;
			  /*
			  //UPDATE GAS BUDGET
				//GET GAS BUDGET
				$sql_agency_gas = "SELECT * FROM agency WHERE agency_id=$agency_id";
				$result_agency_gas = $connect->query($sql_agency_gas);
				
				$agency_budget=0;//BUDGET

				if ($result_agency_gas->num_rows > 0) {
							// output data of each row
							while($row_agency_gas = $result_agency_gas->fetch_assoc()) {
								$agency_budget = $row_agency_gas['agency_budget'];
							}
				}
			//PROGRAM BUDGET DEDUCT to AGENCY BUDGET
				$new_agency_budget = $agency_budget - $budget; 
			
				$sql_gas_budget_update="UPDATE agency SET agency_budget='$new_agency_budget' WHERE agency_id=$agency_id";
				//UPDATE GAS BUDGET
				$connect->query($sql_gas_budget_update); 
			//
			*/
			
			//ACTIVITY
			$time=date('H:i:s');
			$date=date('Y-m-d');
			$activity="";
			$activity="Added ".$project." on Operations Sub-Program";
			
			$sql_activity_add = "INSERT INTO activity (activity, activity_time, activity_date, action) VALUES('$activity', '$time', '$date', 'Add')";
			$connect->query($sql_activity_add); 
			
			  $connect->close();
			  
			  header("Location: index.php?o=sub_programs&c=".$last_id."&p=".$project);
			  exit();
	}
	else {
			echo "Error: " . $sql_add . "<br>" . $connect->error;
	}
}
?>