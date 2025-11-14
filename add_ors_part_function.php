<?php
if(isset($_POST['add_btn'])){
	include "php_actions/database_connect.php";
	


$ors_id = $_POST['ors_id'];

	$sub_program_id = $_POST["sub_program"];
	$particular  = $_POST["particular"];
	$uacs  = $_POST["uacs"];
	$rc  = $_POST["rc"];
	$class_category  = $_POST["class_category"];
	$allotment  = $_POST["allotment"];
	$amount  = $_POST["particularAmount"];
	$date = date("Y/m/d");
	$agency_id=0;
	
	if($sub_program_id>=1 && $sub_program_id<=10){
		$agency_id=3;
	}
	else if($sub_program_id==11){
		$agency_id=1;
	}
	else if($sub_program_id==12){
		$agency_id=2;
	}
	
	$sql_ors_part_add = "INSERT INTO ors_particulars (ors_id, sub_program_id,particulars, uacs_id, responsibility_center, class_category, allotment, particulars_amount, date_added) VALUES ('$ors_id', '$sub_program_id','$particular','$uacs', '$rc', '$class_category','$allotment','$amount','$date')";
	
	if ($connect->query($sql_ors_part_add) === TRUE) {	
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
			
				$sql_agency_budget_update="UPDATE agency SET agency_budget='$new_agency_budget' WHERE agency_id=$agency_id";
				//UPDATE GAS BUDGET
				$connect->query($sql_agency_budget_update); 
			//
			  $connect->close();
			  
			  header("Location: index.php?o=ors_particulars&ors_id=$ors_id");
			  exit();
	}
	else {
			echo "Error: " . $sql_ors_part_add . "<br>" . $connect->error;
	}
}
?>