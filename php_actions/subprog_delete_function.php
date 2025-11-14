<?php
date_default_timezone_set('Asia/Kuala_Lumpur');
$id=$_GET['id'];

include "../php_actions/database_connect.php";

$sql_delete = "DELETE FROM sub_program_budget WHERE sub_program_budget_id=$id";
$sql_delete_rc = "DELETE FROM sub_program_rc WHERE sub_program_budget_id=$id";

//UPDATE BUDGET
				//GET BUDGET
				$sql_agency_gas = "SELECT * FROM agency WHERE agency_id=3";
				$result_agency_gas = $connect->query($sql_agency_gas);
				
				$agency_budget=0;//BUDGET
				$agency_name="";

				if ($result_agency->num_rows > 0) {
							// output data of each row
							while($row_agency = $result_agency->fetch_assoc()) {
								$agency_budget = $row_agency['agency_budget'];
								$agency_name= $row_agency['agency_name'];
							}
				}
				
				//GET RC BUDGET
				$sql_subprog_budget = "SELECT * FROM sub_program_budget WHERE sub_program_budget_id=$id";
				$result_subprog_budget = $connect->query($sql_subprog_budget);
				
				$subprog_budget=0;//PROJECT BUDGET
				$project="";

				if ($result_subprog_budget->num_rows > 0) {
							// output data of each row
							while($row_subprog_budget = $result_subprog_budget->fetch_assoc()) {
								$subprog_budget = $row_subprog_budget['budget'];
								$project= $row_subprog_budget['project'];
							}
				}
				
			//PROGRAM BUDGET ADD BACK to AGENCY BUDGET
				$new_agency_budget = $agency_budget + $subprog_budget; 
			
				$sql_budget_update="UPDATE agency SET agency_budget='$new_agency_budget' WHERE agency_id=3";
				//UPDATE GAS BUDGET
if($connect->query($sql_budget_update) === TRUE){

	//DELETE SUB PROG RCs
	
	if ($connect->query($sql_delete_rc) === TRUE){
	//DELETE SUB PROG
		if ($connect->query($sql_delete) === TRUE) {
				//ACTIVITY
			$time=date('H:i:s');
			$date=date('Y-m-d');
			$activity="";
			$activity="Deleted ".$project." from ".$agency_name." Sub-Program";
			
			$sql_activity_add = "INSERT INTO activity (activity, activity_time, activity_date, action) VALUES('$activity', '$time', '$date', 'Delete')";
			
			$connect->query($sql_activity_add); 
					$connect->close();
					  header("Location: ../index.php?o=sub_programs");
					  exit();

		}

	}
}


?>