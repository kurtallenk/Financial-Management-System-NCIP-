<?php
if(isset($_POST['update_btn'])){
	include "php_actions/database_connect.php";
	
	$sub_prog_budget_id = $_POST['sub_prog_id'];
	$rc_id=$_POST['sub_prog_rc_id'];
	$sub_prog_name = $_POST['projectName'];
	$prev_rc_budget= $_POST['current_budget'];
	
	$rc=$_POST['rc'];
	$rc_budget = $_POST['rc_budget_value'];
	
	$withsub = true;
	
	$sql_update = "UPDATE sub_program_rc SET rc='$rc', rc_budget='$rc_budget' WHERE sub_program_rc_id='$rc_id'";
	
		if ($connect->query($sql_update) === TRUE) {
				  echo "New record created successfully";
				  
				  //GET SUB PROG BUDGET
				  $sql_sub_prog_budget = "SELECT * FROM sub_program_budget WHERE sub_program_budget_id=$sub_prog_budget_id";
				  $result_sub_prog_budget = $connect->query($sql_sub_prog_budget);
				  
				  $sub_prog_budget = 0; //BUDGET
				  
					if ($result_sub_prog_budget->num_rows > 0) {
							// output data of each row
							while($row_sub_prog_budget = $result_sub_prog_budget->fetch_assoc()) {
								$sub_prog_budget = $row_sub_prog_budget['budget'];
							}
					}
					
					//UPDATE NEW SUB PROG BUDGET (DEDUCT EDITED RC BUDGET and ADD NEW)
					$new_subprog_budget = ($sub_prog_budget - $prev_rc_budget) + $rc_budget; 
					
				$sql_update_new_sub_prog_budget = "UPDATE sub_program_budget SET budget='$new_subprog_budget' WHERE sub_program_budget_id=$sub_prog_budget_id";
					
				if ($connect->query($sql_update_new_sub_prog_budget) === TRUE) {
				  $connect->close();
				  header("Location: index.php?o=sub_programs&c=".$sub_prog_budget_id."&p=".$sub_prog_name);
				  exit();
				}
		}
		else {
				echo "Error: " . $sql_update . "<br>" . $connect->error;
		}
}

else{
	
	$sub_prog_name = $_POST['projectName'];
	echo "<h1>Something went wrong!</h1> ".$sub_prog_name;
}
?>