<?php
if(isset($_POST['add_btn'])){
	include "php_actions/database_connect.php";
	
	$subprogram = $_POST['sub_program'];
	
	$sql_sub = "SELECT * FROM sub_program WHERE sub_program_id=$subprogram";
	$result_sub= $connect->query($sql_sub);

	$agency_id="";
	
	if ($result_sub->num_rows > 0) {
			// output data of each row
			while($row_sub = $result_sub->fetch_assoc()) {
				$agency_id=$row_sub['agency_id'];
			}
			
	}
	
	
	//$program = $_POST['program'];
	$saa_num = $_POST['saa_num'];
	$project = $_POST['description'];
	$uacs = $_POST['uacs'];
	$rc = $_POST['rc'];
	$classCategory = "MOOE";
	$budget = $_POST['budget_value'];
	
	$withsub = true;
	
	$sql_add = "INSERT INTO list_of_sub_allotments (agency_id, sub_program_id, saa_number, project, uacs_id,responsibility_center, class_category, budget) VALUES ('$agency_id','$subprogram', '$saa_num', '$project','$uacs','$rc','$classCategory','$budget')";
	
	if ($connect->query($sql_add) === TRUE) {	
			  echo "New record created successfully";
			  
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
			  $connect->close();
			  $agency_name="";
			  
			  $agency_name="sub_allotment";
			  
			  header("Location: index.php?o=".$agency_name);
			  exit();
	}
	else {
			echo "Error: " . $sql_add . "<br>" . $connect->error;
	}
}
?>