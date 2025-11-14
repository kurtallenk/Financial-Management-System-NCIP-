<?php
if(isset($_POST['update_btn'])){
	include "../php_actions/database_connect.php";
	$ors_id = $_POST['ors_id_edit'];
	$ors_part_id = $_POST['ors_part_id_edit'];
	$sub_program = $_POST['sub_program'];
	$particular = $_POST['particular'];
	$class_category = $_POST['class_category'];
	$allotment  = $_POST["allotment"];
	$rc = $_POST['rc'];
	$uacs = $_POST['uacs'];
	$particularAmount = $_POST['particularAmount'];
	$date=date("Y-m-d");
	
	$sql_ors_part_update = "UPDATE ors_particulars SET sub_program_id='$sub_program', particulars='$particular', uacs_id='$uacs', particulars_amount='$particularAmount', class_category='$class_category', allotment='$allotment', responsibility_center='$rc', date_updated='$date' WHERE ors_particulars_id='$ors_part_id'";

	if($connect->query($sql_ors_part_update) === TRUE){

		$connect->close();
		header("Location: ../index.php?o=ors_particulars&ors_id=".$ors_id);
		exit();
	}
	
	else {
		echo "Error: " . $sql_ors_part_update . "<br>" . $connect->error;
	}
}
?>