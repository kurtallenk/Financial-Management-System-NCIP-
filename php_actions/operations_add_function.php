<?php
if(isset($_POST['add_btn'])){
	include "../php_actions/database_connect.php";
	
	$program = $_POST['program'];
	$project = $_POST['project'];
	$rc = $_POST['rc'];
	$gaasaa = $_POST['gaasaa'];
	$classCategory = $_POST['classCategory'];
	$budget = $_POST['budget_value'];
	
	$sql_add = "INSERT INTO specific_budget (program_id, project, responsibility_center, gaasaa, class_category, specific_budget_amount) VALUES ('$program', '$project','$rc','$gaasaa','$classCategory','$budget')";
	
	if ($connect->query($sql_add) === TRUE) {	
			  echo "New record created successfully";
			  
			  //UPDATE GAS BUDGET
				//GET GAS BUDGET
				$sql_agency_gas = "SELECT * FROM agency WHERE agency_id=3";
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
			
				$sql_gas_budget_update="UPDATE agency SET agency_budget='$new_agency_budget' WHERE agency_id=3";
				//UPDATE GAS BUDGET
				$connect->query($sql_gas_budget_update); 
			//
			
			//ACTIVITY
			$time=date('H:i:s');
			$date=date('Y-m-d');
			$activity="";
			
			$sql_activity_add = "INSERT INTO activity (activity, activity_time, activity_date) VALUES ($activity, $time, $date)";
			$activity="Added '".$project."' on OPERATIONS";
			$connect->query($sql_activity_add);
			
			  $connect->close();
			  header("Location: ../index.php?o=operations");
			  exit();
	}
	else {
			echo "Error: " . $sql . "<br>" . $connect->error;
	}
}
?>