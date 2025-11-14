<?php
if(isset($_POST['update_btn'])){
	include "../php_actions/database_connect.php";
	
	$id=$_POST['id'];
	
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
	$project = $_POST['project'];
	$uacs = $_POST['uacs'];
	$rc = $_POST['rc'];
	$classCategory = "MOOE";
	$budget = $_POST['budget_value'];
	
	$sql_update = "UPDATE list_of_sub_allotments SET agency_id='$agency_id', sub_program_id='$subprogram', saa_number='$saa_num', project='$project', uacs_id='$uacs', responsibility_center='$rc', class_category='$classCategory', budget='$budget' WHERE sub_allot_id=$id";
	
	//UPDATE GAS BUDGET
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
				
				//GET LAST SUB ALLOT BUDGET
				$sql_sub_allot = "SELECT * FROM list_of_sub_allotments WHERE sub_allot_id=$id";
				$result_sub_allot = $connect->query($sql_sub_allot);
				
				$sub_allot_budget=0;//SUB ALLOT BUDGET

				if ($result_sub_allot->num_rows > 0) {
							// output data of each row
							while($row_sub_allot = $result_sub_allot->fetch_assoc()) {
								$sub_allot_budget = $row_sub_allot['budget'];
							}
				}
				
			//PROGRAM BUDGET ADD BACK to AGENCY BUDGET
				$new_agency_budget = ($agency_budget + $sub_allot_budget)-$budget;
	
$sql_agency_budget_update="UPDATE agency SET agency_budget='$new_agency_budget' WHERE agency_id=$agency_id";
				//UPDATE GAS BUDGET
	if($connect->query($sql_agency_budget_update) === TRUE){
		if ($connect->query($sql_update) === TRUE) {	
				  echo "New record created successfully";
				
				  $connect->close();
				  header("Location: ../index.php?o=sub_allotment");
				  exit();
		}
		else {
				echo "Error: " . $sql_update . "<br>" . $connect->error;
		}
	}
}
?>