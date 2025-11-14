<?php 
			
	include "../php_actions/database_connect.php";
	
	$agency_id = $_GET['q'];
	
	$sql_program = "SELECT * FROM program WHERE agency_id=$agency_id";
	$result_program = $connect->query($sql_program);
	
	echo "<option value=''>Choose...</option>";

	if($result_program->num_rows > 0){
			// output data of each row
		while($row_program = $result_program->fetch_assoc()) {
?>
				
			<option value="<?php echo $row_program['program_id'];?>">
	
<?php 
			echo $row_program['program_name'];
?>
			</option>
					
<?php
		}
				
			
	}
	
	$connect->close();
			
?>