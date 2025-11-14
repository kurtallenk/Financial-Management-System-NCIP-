<?php
date_default_timezone_set('Asia/Kuala_Lumpur');
if(isset($_POST['add_btn'])){
	include "php_actions/database_connect.php";
	
	$sub_prog_budget_id = $_POST['subprog_budget_id'];
	$sub_prog_name="";
	
	$rc=$_POST['rc'];
	$rc_budget = $_POST['rc_budget_value'];

	
	$sql_add = "INSERT INTO sub_program_rc (sub_program_budget_id, rc, rc_budget) VALUES ('$sub_prog_budget_id', '$rc', '$rc_budget')";
	
	if ($connect->query($sql_add) === TRUE) {
			  echo "New record created successfully";
			  
			  
			  //UPDATE BUDGET
				//GET BUDGET
				$sql_sub_prog_budget = "SELECT * FROM sub_program_budget WHERE sub_program_budget_id=$sub_prog_budget_id";
				$result_sub_prog_budget = $connect->query($sql_sub_prog_budget);
				
				$sub_prog_budget=0;//BUDGET

				if ($result_sub_prog_budget->num_rows > 0) {
							// output data of each row
							while($row_sub_prog_budget = $result_sub_prog_budget->fetch_assoc()) {
								$sub_prog_budget = $row_sub_prog_budget['budget'];
								$sub_prog_name = $row_sub_prog_budget['project'];
							}
				}
				
			//RC BUDGET ADD to SUB PROG BUDGET
				$new_subprog_budget = $sub_prog_budget + $rc_budget; 
			
				$sql_sub_prog_budget_update="UPDATE sub_program_budget SET budget='$new_subprog_budget' WHERE sub_program_budget_id=$sub_prog_budget_id";
				//UPDATE BUDGET
			
			if ($connect->query($sql_sub_prog_budget_update) === TRUE) {
				
				//ACTIVITY
			$time=date('H:i:s');
			$date=date('Y-m-d');
			$activity="Added RC to ".$sub_prog_name." on Operations Sub-Program";
			
			$sql_activity_add = "INSERT INTO activity (activity, activity_time, activity_date, action) VALUES ('$activity', '$time', '$date', 'Add')";
			$connect->query($sql_activity_add);
				
			  $connect->close();
			  header("Location: index.php?o=sub_programs&c=".$sub_prog_budget_id."&p=".$sub_prog_name);
			  exit();
			}
			
			else {
			echo "Error: " . $sql_sub_prog_budget_update . "<br>" . $connect->error;
			}
			
	}
	else {
			echo "Error: " . $sql_add . "<br>" . $connect->error;
	}
}
?>