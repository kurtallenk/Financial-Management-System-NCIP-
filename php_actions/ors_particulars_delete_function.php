<?php

$ors_part_id=$_GET['ors_part_id'];
$ors_id=$_GET['ors_id'];
include "../php_actions/database_connect.php";

$sql_ors_part_delete = "DELETE FROM ors_particulars WHERE ors_particulars_id=$ors_part_id";

	//DELETE
	if ($connect->query($sql_ors_part_delete) === TRUE) {
				echo "DELETED SUCCESSFULLY...!";
				$connect->close();
				  header("Location: ../index.php?o=ors_particulars&ors_id=".$ors_id);
				  exit();

	}
	
	else {
		echo "Error: " . $sql_ors_part_delete . "<br>" . $connect->error;
	}


?>