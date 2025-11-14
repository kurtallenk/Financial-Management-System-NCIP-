<?php 
			
	include "php_actions/database_connect.php";
	
	$sql_agency = "SELECT * FROM agency ORDER BY agency_id ASC";
	$result_agency = $connect->query($sql_agency);
			
	$all_agency="";
	$all_agency .= "<option>Choose...</option>";
	if($result_agency->num_rows > 0){
			// output data of each row
		while($row_agency = $result_agency->fetch_assoc()) {
			
			$all_agency .= "<option value=".$row_agency['agency_id'].">".$row_agency['agency_name']."</option>";
			
		}
				
			
	}
			
?>