<?php
date_default_timezone_set('Asia/Kuala_Lumpur');
$rc_id=$_GET['rc_id'];
$subprog_id=$_GET['s_id'];
$subprog_name=$_GET['s_name'];

include "../php_actions/database_connect.php";

$sql_delete_rc = "DELETE FROM sub_program_rc WHERE sub_program_rc_id=$rc_id";

//UPDATE BUDGET
				//GET SUB PROG BUDGET
				$sql_subprog_budget = "SELECT * FROM sub_program_budget WHERE sub_program_budget_id=$subprog_id";
				$result_subprog_budget = $connect->query($sql_subprog_budget);
				
				$subprog_budget=0;//BUDGET
				$agency_name="";

				if ($result_subprog_budget->num_rows > 0) {
							// output data of each row
							while($row_subprog_budget = $result_subprog_budget->fetch_assoc()) {
								$subprog_budget = $row_subprog_budget['budget'];
								$agency_name= $row_agency['agency_name'];
							}
				}
				
				//GET RC BUDGET
				$sql_subprog_rc = "SELECT * FROM sub_program_rc WHERE sub_program_rc_id=$rc_id";
				$result_subprog_rc_budget = $connect->query($sql_subprog_rc);
				
				$subprog_rc_budget=0;//RC BUDGET 0
				$project="";

				if ($result_subprog_rc_budget->num_rows > 0) {
							// output data of each row
							while($row_subprog_rc_budget = $result_subprog_rc_budget->fetch_assoc()) {
								$subprog_rc_budget = $row_subprog_rc_budget['rc_budget']; //RC BUDGET GET
								$project= $row_subprog_budget['project'];
							}
				}
				
			//RC BUDGET DEDUCT to SUB PROG BUDGET
				$new_subprog_budget = $subprog_budget - $subprog_rc_budget; 
			
				$sql_subprog_budget_update="UPDATE sub_program_budget SET budget='$new_subprog_budget' WHERE sub_program_budget_id=$subprog_id";
				//UPDATE SUBPROG BUDGET
if($connect->query($sql_subprog_budget_update) === TRUE){
	//DELETE SUB PROG RCs
	if ($connect->query($sql_delete_rc) === TRUE){
				//ACTIVITY
				$time=date('H:i:s');
				$date=date('Y-m-d');
				$activity="";
				$activity="Deleted RC ".$project." from ".$subprog_name." Operations Sub-Program";
				
				$sql_activity_add = "INSERT INTO activity (activity, activity_time, activity_date, action) VALUES('$activity', '$time', '$date', 'Delete')";
				
				$connect->query($sql_activity_add); 
					$connect->close();
					  header("Location: ../index.php?o=sub_programs&c=".$subprog_id."&p=".$subprog_name);
					  exit();
	}
}


?>