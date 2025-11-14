<?php 
			
	include "../php_actions/database_connect.php";
	
if(isset($_GET['q'])){
	
	$ors_id = $_GET['q'];
	
	$sql_ors= "SELECT * FROM ors WHERE ors_id=$ors_id";
	$result_ors = $connect->query($sql_ors);

	if($result_ors->num_rows > 0){
			// output data of each row
		while($row_ors = $result_ors->fetch_assoc()) {
?>
				
		<div class="col-md-6">
            <label for="project">Serial Number</label>
            <input type="text" class="form-control" placeholder="" value="<?php echo $row_ors['serial_number'];?>" disabled>
			
			<input type="hidden" name="serial_number" value="<?php echo $row_ors['serial_number'];?>">

        </div>
		  
		<div class="col-md-6">
            <label for="project">Payee</label>
            <input type="text" class="form-control" placeholder="" value="<?php echo $row_ors['payee'];?>" disabled>
			
			<input type="hidden" name="payee" value="<?php echo $row_ors['payee'];?>">

        </div>
		
		<div class="col-md-12 tableFixHead2">
		<br>
		<table class="table table-bordered">
<?php 
		$sql_ors_part = "SELECT * FROM ors_particulars WHERE ors_id=$ors_id";
		$result_ors_part = $connect->query($sql_ors_part);
		
			if($result_ors_part->num_rows > 0){
				?>
				
				<thead>
				
					<tr>
						<th>Particulars <span class="badge badge-secondary"><?php echo $result_ors_part->num_rows;?></span></th>
						<th>RC</th>
						<th>Amount</th>
						<th></th>
					</tr>		
				</thead>
				
				<tbody>
				
				<?php
				// output data of each row
				while($row_ors_part = $result_ors_part->fetch_assoc()) {
					
				?>
						<tr>
						<td><?php echo $row_ors_part['particulars'];?></td>
						<td><?php echo $row_ors_part['responsibility_center'];?></td>
						<td>&#8369; <?php echo number_format($row_ors_part['particulars_amount'],2);?></td>
						<td>
						
							 <div class="form-group form-check invisible">
								<input type="checkbox" class="form-check-input" id="part_check<?php echo $row_ors_part['ors_id']."[]"; ?>">
							</div>
						
						</td></tr>
				
				<?php
					
				}
			
			}
		echo "</tbody>";
		echo "</table>";
		echo "</div>";


		}
	}
	else{
?>
		<div class="col-md-6">
            <label for="project">Serial Number</label>
            <input type="text" class="form-control" name="serial_number" id="serial_number" placeholder="" value="" disabled>

        </div>
		  
		<div class="col-md-6">
            <label for="project">Payee</label>
            <input type="text" class="form-control" name="payee" id="payee" placeholder="" value="" disabled>

        </div>
		
		<div class="col-md-12 tableFixHead2">
		<br>
		<table class="table">
				
				<thead>
				
					<tr>
						<th>Particulars</th>
						<th>RC</th>
						<th>Amount</th>
						<th></th>
					</tr>		
				</thead>
				
				<tbody>
					<tr>
						<td colspan=4><center>Select ORS</center></td>
					</tr>
				</tbody>
		</table>
		</div>



<?php
	}
}
else{
?>	

<div class="col-md-6">
            <label for="project">Serial Number</label>
            <input type="text" class="form-control" name="serial_number" id="serial_number" placeholder="" value="" disabled>

        </div>
		  
		<div class="col-md-6">
            <label for="project">Payee</label>
            <input type="text" class="form-control" name="payee" id="payee" placeholder="" value="" disabled>

        </div>
		
		<div class="col-md-12 tableFixHead2">
		<br>
		<table class="table">
				
				<thead>
				
					<tr>
						<th>Particulars</th>
						<th>RC</th>
						<th>Amount</th>
						<th></th>
					</tr>		
				</thead>
				
				<tbody>
					<tr>
						<td colspan=4><center>Select ORS</center></td>
					</tr>
				</tbody>
		</table>
		</div>


<?php
}
	
	
	$connect->close();
			
?>