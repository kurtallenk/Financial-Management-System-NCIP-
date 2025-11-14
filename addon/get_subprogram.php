<?php 
			
	include "../php_actions/database_connect.php";
	
	$program_id = $_GET['q'];
	
	$sql_subprogram = "SELECT * FROM sub_program WHERE program_id=$program_id";
	$result_subprogram = $connect->query($sql_subprogram);
			
	echo "<option value=''>Choose...</option>";
	if($result_subprogram->num_rows > 0){
			// output data of each row
		while($row_subprogram = $result_subprogram->fetch_assoc()) {
?>
				
			<option value="<?php echo $row_subprogram['sub_program_id'];?>">
	
<?php 
			echo $row_subprogram['sub_program_accronym'];
?>
			</option>
					
<?php
		}
				
			
	}
	
	$connect->close();
			
?>