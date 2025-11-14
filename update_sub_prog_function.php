<?php
if(isset($_POST['update_btn'])){
	include "php_actions/database_connect.php";
	
	$sub_agency = $_POST['sub_agency'];
	
	$agency_id=$_POST['agency_id']; 
	$id=$_POST['sub_prog_id'];
	$program = $_POST['program'];
	$subprogram = $_POST['subprogram'];
	$project = $_POST['project'];
	$uacs = $_POST['uacs'];
	$allotment = $_POST['allotment'];
	$classCategory = $_POST['classCategory'];
	
	$withsub = true;
	
	$sql_update = "UPDATE sub_program_budget SET program_id='$program', sub_program_id='$subprogram', project='$project', uacs_id='$uacs', allotment='$allotment', class_category='$classCategory' WHERE sub_program_budget_id=$id AND agency_id=$agency_id";
	
		if ($connect->query($sql_update) === TRUE) {	
				  echo "New record created successfully";
				
				  $connect->close();
				  header("Location: index.php?o=sub_programs");
				  exit();
		}
		else {
				echo "Error: " . $sql_update . "<br>" . $connect->error;
		}
}

else{
	echo "<h1>Something went wrong!</h1>";
}
?>