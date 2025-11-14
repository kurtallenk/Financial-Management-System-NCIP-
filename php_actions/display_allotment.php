<?php

//from SPECIFIC BUDGET
$sql_allotment = "SELECT SUM(specific_budget_amount) as total_allotment FROM specific_budget WHERE agency_id=$agency_num;";
$result_allotment = $connect->query($sql_allotment);

$allotment=0;

if($result_allotment->num_rows > 0){
	while($row_allotment = $result_allotment->fetch_assoc()) {
		$allotment = $row_allotment['total_allotment'];
	}
	
}

//from SUB PROGRAM BUDGET
$sql_subprog_allotment = "SELECT SUM(budget) as total_subprog_allotment FROM sub_program_budget WHERE agency_id=$agency_num;";
$result_subprog_allotment = $connect->query($sql_subprog_allotment);

$sub_prog_allotment=0;

if($result_subprog_allotment->num_rows > 0){
	while($row_subprog_allotment = $result_subprog_allotment->fetch_assoc()) {
		$sub_prog_allotment = $row_subprog_allotment['total_subprog_allotment'];
	}
	
}

//from list_of_sub_allotments BUDGET
$sql_saa = "SELECT SUM(budget) as total_saa FROM list_of_sub_allotments WHERE agency_id=$agency_num;";
$result_saa = $connect->query($sql_saa);

$total_saa=0;

if($result_saa->num_rows > 0){
	while($row_saa = $result_saa->fetch_assoc()) {
		$total_saa = $row_saa['total_saa'];
	}
	
}


$allotment=$allotment+$sub_prog_allotment+$total_saa;

?>