<?php
if(isset($_POST['update_btn'])){
	include "php_actions/database_connect.php";
	$agency_id=$_POST['agency_id']; 
	$id=$_POST['spec_budget_id'];
	$program = $_POST['program'];
	$project = $_POST['project'];
	$uacs = $_POST['uacs'];
	$rc = $_POST['rc'];
	$gaasaa = $_POST['gaasaa'];
	$classCategory = $_POST['classCategory'];
	$budget = $_POST['budget_value'];
	
	$sql_update = "UPDATE specific_budget SET program_id='$program', project='$project', uacs_id='$uacs', responsibility_center='$rc', gaasaa='$gaasaa', class_category='$classCategory', specific_budget_amount='$budget' WHERE specific_budget_id=$id AND agency_id=$agency_id";
	
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
				
				//GET LAST PROJECT BUDGET
				$sql_gas_project = "SELECT * FROM specific_budget WHERE specific_budget_id=$id";
				$result_gas_project = $connect->query($sql_gas_project);
				
				$project_budget=0;//PROJECT BUDGET

				if ($result_gas_project->num_rows > 0) {
							// output data of each row
							while($row_gas_project = $result_gas_project->fetch_assoc()) {
								$project_budget = $row_gas_project['specific_budget_amount'];
							}
				}
				
			//PROGRAM BUDGET ADD BACK to AGENCY BUDGET
				$new_agency_budget = ($agency_budget + $project_budget)-$budget;
	
$sql_gas_budget_update="UPDATE agency SET agency_budget='$new_agency_budget' WHERE agency_id=$agency_id";
				//UPDATE GAS BUDGET
	if($connect->query($sql_gas_budget_update) === TRUE){
		if ($connect->query($sql_update) === TRUE) {	
				  echo "New record created successfully";
				  
				  $agency_name="";
				  if($agency_id==1){
					  $agency_name = "gas";
				  }
				  else if($agency_id==2){
					  $agency_name = "sto";
				  }
				  else if($agency_id==3){
					  $agency_name = "operations";
				  }
				
				  $connect->close();
				  header("Location: index.php?o=".$agency_name);
				  exit();
		}
		else {
				echo "Error: " . $sql_update . "<br>" . $connect->error;
		}
	}
}

else{
	echo "<h1>Something went wrong!</h1>";
}
?>