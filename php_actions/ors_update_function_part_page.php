<?php
if(isset($_POST['update_btn'])){
	include "../php_actions/database_connect.php";
	
	$ors_id=$_POST['ors_id'];
	$serial_number = $_POST['serialnum'];
	$payee = $_POST['payee'];
	$date = $_POST['date'];
	
	$sql_ors_update = "UPDATE ors SET serial_number='$serial_number', payee='$payee', date_updated='$date' WHERE ors_id=$ors_id";

	if($connect->query($sql_ors_update) === TRUE){

		$connect->close();
		header("Location: ../index.php?o=ors_particulars&ors_id=".$ors_id);
		exit();
	}
	
	else {
		echo "Error: " . $sql_ors_update . "<br>" . $connect->error;
	}
}
?>