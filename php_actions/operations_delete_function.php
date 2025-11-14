<?php

date_default_timezone_set('Asia/Kuala_Lumpur');

$id=$_GET['id'];

include "../php_actions/database_connect.php";

$sql_delete = "DELETE FROM specific_budget WHERE specific_budget_id=$id";


//UPDATE GAS BUDGET
				//GET GAS BUDGET
				$sql_agency_gas = "SELECT * FROM agency WHERE agency_id=3";
				$result_agency_gas = $connect->query($sql_agency_gas);
				
				$agency_budget=0;//GAS BUDGET
				$agency_name="";

				if ($result_agency_gas->num_rows > 0) {
							// output data of each row
							while($row_agency_gas = $result_agency_gas->fetch_assoc()) {
								$agency_budget = $row_agency_gas['agency_budget'];
								$agency_name = $row_agency_gas['agency_name'];
							}
				}
				
				//GET PROJECT BUDGET
				$sql_gas_project = "SELECT * FROM specific_budget WHERE specific_budget_id=$id";
				$result_gas_project = $connect->query($sql_gas_project);
				
				$project_budget=0;//PROJECT BUDGET
				$project="";

				if ($result_gas_project->num_rows > 0) {
							// output data of each row
							while($row_gas_project = $result_gas_project->fetch_assoc()) {
								$project_budget = $row_gas_project['specific_budget_amount'];
								$project = $row_gas_project['project'];
							}
				}
				
			//PROGRAM BUDGET ADD BACK to AGENCY BUDGET
				$new_agency_budget = $agency_budget + $project_budget; 
			
				$sql_gas_budget_update="UPDATE agency SET agency_budget='$new_agency_budget' WHERE agency_id=3";
				//UPDATE GAS BUDGET
if($connect->query($sql_gas_budget_update) === TRUE){


	//DELETE
	if ($connect->query($sql_delete) === TRUE) {
		
			//ACTIVITY
			$time=date('H:i:s');
			$date=date('Y-m-d');
			$activity="";
			$activity="Deleted ".$project." from ".$agency_name;
			
			$sql_activity_add = "INSERT INTO activity (activity, activity_time, activity_date,action) VALUES('$activity', '$time', '$date', 'Add')";
			
			$connect->query($sql_activity_add); 
			
				$connect->close();
				  header("Location: ../index.php?o=operations");
				  exit();

	}

}


?>