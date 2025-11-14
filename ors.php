<div class="container-fluid">

  <div class="py-3 text-center">

	
    <h1>Obligations Request Status Report</h1>
    
  </div>
 
  
  
<div class="row">

<div class="col-md-12">
	  <a class="nav-link" href="#" data-toggle="modal" data-target="#ors_add_modal" style="float: right;">
				  <h3>+ADD ORS</h3>
	   </a>
	</div>

</div>

  <div class="row">
	<table class="table table-bordered table-sm table-hover" cellspacing="0">

	  <thead class="thead-dark">
		<tr>
		  <th scope="col">Serial Number</th>
		  <th scope="col">Payee</th>
		  <th scope="col">Project</th>
		  <th scope="col">Number of Particulars</th>
		  <th scope="col">Total Amount</th>
		  <th scope="col"> </th>
		</tr>
	  </thead>
	  <tbody id="dataTable">
		<?php 
	  
	  include "php_actions/database_connect.php";
	  //PROGRAM
		$sql_ors = "SELECT * FROM ors ORDER BY ors_id ASC";
		$result_ors = $connect->query($sql_ors);
	  
		if ($result_ors->num_rows > 0) {
			// output data of each row
			while($row_ors = $result_ors->fetch_assoc()) {
			
			
			//GET TOTAL PARTICULARS AMOUNT
			$total_particulars_amount=0;
			$number_of_particulars=0;
			
			$sql_ors_part_sum = "SELECT SUM(particulars_amount) AS totalAmount FROM ors_particulars WHERE ors_id=".$row_ors['ors_id'].";";
			$result_ors_part_sum = $connect->query($sql_ors_part_sum);
		  
			if ($result_ors_part_sum->num_rows > 0) {
				// output data of each row
				while($row_ors_part_sum = $result_ors_part_sum->fetch_assoc()) {
					$total_particulars_amount= $row_ors_part_sum['totalAmount'];
				}
			}
			else {
				echo "Error: " . $sql_ors_part_sum . "-->" . $connect->error;
			}
			
			//NUMBER OF ROWS
			$sql_ors_part = "SELECT * FROM ors_particulars WHERE ors_id=".$row_ors['ors_id'];
			$result_ors_part = $connect->query($sql_ors_part);
		  
			if ($result_ors_part->num_rows > 0) {
				// output data of each row
				
				$number_of_particulars = $result_ors_part->num_rows;
			}
			
			?>
			
			
			<tr data-href='index.php?o=ors_particulars&ors_id=<?php echo $row_ors['ors_id'];?>'>
			<td><?php echo $row_ors['serial_number'];?></td>
			<td><?php echo $row_ors['payee'];?></td>
			<td><?php echo $row_ors['project'];?></td>
			<td><?php echo $number_of_particulars;?>  
				<a href="index.php?o=ors_particulars&ors_id=<?php echo $row_ors['ors_id'];?>"></a>
			</td>
			<td>&#8369; <?php echo number_format($total_particulars_amount,2);?></td>
			<td name="a">
		  
			<a href="#" data-toggle="modal" data-target="#ors_delete_modal<?php echo $row_ors['ors_id'];?>">DELETE</a> 
			
			|
			
			<a href="#" data-toggle="modal" data-target="#ors_edit_modal<?php echo $row_ors['ors_id'];?>">EDIT</a>
			</td>
			</tr>
			
			<!-- EDIT Modal -->
			<div class="modal fade" id="ors_edit_modal<?php echo $row_ors['ors_id'];?>" tabindex="-1" aria-labelledby="ors_edit_modal" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="ors_edit_modal">Edit ORS</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  
				  
				   <form action="php_actions/ors_update_function.php" method="POST">
			  
				  <input type="hidden" name="ors_id" value="<?php echo $row_ors['ors_id'];?>">
				   <?php include "ors_edit.php"; ?>
				   
				   <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-primary" name="update_btn">Save Changes</button>
				  </div>
				</form>
				  
				</div>
			  </div>
			</div>
			
			<!-- DELETE Modal -->
				<div class="modal fade" id="ors_delete_modal<?php echo $row_ors['ors_id'];?>" tabindex="-1" aria-labelledby="ors_delete_modal" aria-hidden="true">
				  <div class="modal-dialog">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="ors_delete_modal">Confirm Delete</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
					  
					  <form action="php_actions/ors_delete_function.php" method="POST">
			  
				  <input type="hidden" name="ors_id" value="<?php echo $row_ors['ors_id'];?>">
				  <input type="hidden" name="ors_serial_num" value="<?php echo $row_ors['serial_number'];?>">
					  <h3>
					  Are you sure you want to delete ORS Serial Number:
					  <b><?php echo $row_ors['serial_number'];?></b> and all of its project?<br>
					   Payee: <b><?php echo $row_ors['payee'];?></b>
					   
					   </h3>
					   
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						<a href="php_actions/ors_delete_function.php?id=<?php echo $row_ors['ors_id'];?>">
						<button type="submit" class="btn btn-primary" name="add_btn">Confirm</button></a>
					  </div>
					  
					  </form>
					  
					</div>
					
				  </div>
				  
				  
				  
				</div>
<?php
			}
		}
		else { echo "<tr><td colspan='6'><h1>NO DATA ON DB...</h1></td></tr>"; }
?>
	  </tbody>
	</table>

 </div>
</div>
 
<?php 
$connect->close();
?>