<?php
date_default_timezone_set('Asia/Kuala_Lumpur');
$id=$_GET['id'];

include "../php_actions/database_connect.php";

$sql_delete = "DELETE FROM list_of_sub_allotments WHERE sub_allot_id=$id";


//UPDATE GAS BUDGET
				
				
				//GET AGENCY ID
				
				$sql_sub = "SELECT * FROM list_of_sub_allotments WHERE sub_allot_id=$id";
				$result_sub= $connect->query($sql_sub);
				
				
				
				$agency_id="";
				$project="";
				
				if ($result_sub->num_rows > 0) {
						// output data of each row
						while($row_sub = $result_sub->fetch_assoc()) {
							$agency_id=$row_sub['agency_id'];
							$project=$row_sub['project'];
						}		
				}
				
				
				//GET GAS BUDGET
				$sql_agency_gas = "SELECT * FROM agency WHERE agency_id=$agency_id";
				$result_agency_gas = $connect->query($sql_agency_gas);
				
				$agency_budget=0;//GAS BUDGET

				if ($result_agency_gas->num_rows > 0) {
							// output data of each row
							while($row_agency_gas = $result_agency_gas->fetch_assoc()) {
								$agency_budget = $row_agency_gas['agency_budget'];
							}
				}
				
				//GET PROJECT BUDGET
				$sql_sub_allot = "SELECT * FROM list_of_sub_allotments WHERE sub_allot_id=$id";
				$result_sub_allot = $connect->query($sql_sub_allot);
				
				$sub_allot_budget=0;//PROJECT BUDGET

				if ($result_sub_allot->num_rows > 0) {
							// output data of each row
							while($row_sub_allot = $result_sub_allot->fetch_assoc()) {
								$sub_allot_budget = $row_sub_allot['budget'];
							}
				}
				
			//PROGRAM BUDGET ADD BACK to AGENCY BUDGET
				$new_agency_budget = $agency_budget + $sub_allot_budget; 
			
				$sql_agency_budget_update="UPDATE agency SET agency_budget='$new_agency_budget' WHERE agency_id=$agency_id";
				//UPDATE GAS BUDGET
if($connect->query($sql_agency_budget_update) === TRUE){


	//DELETE
	if ($connect->query($sql_delete) === TRUE) {
			//ACTIVITY
			$time=date('H:i:s');
			$date=date('Y-m-d');
			$activity="";
			$activity="Deleted ".$project." from Sub-Allotments";
			
			$sql_activity_add = "INSERT INTO activity (activity, activity_time, activity_date, action) VALUES('$activity', '$time', '$date', 'Delete')";
			
			$connect->query($sql_activity_add);
				$connect->close();
				  header("Location: ../index.php?o=sub_allotment");
				  exit();

	}

}


?>