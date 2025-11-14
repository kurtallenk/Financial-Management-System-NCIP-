<div class="container-fluid">

  <div class="py-3 text-center">
	
    <h1>Sub-Allotments</h1>
    
  </div>
  
  <div class="row">

<div class="col-md-12">
	  <a class="nav-link" href="#" data-toggle="modal" data-target="#sub_allotment_add_modal" style="float: right;">
				  <h3>+ADD SUB-ALLOTMENT</h3>
	   </a>
	</div>

</div>

  <div class="row">
	<table class="table table-bordered table-sm table-hover" cellspacing="0">

	  <thead class="thead-dark">
		<tr>
		  <th scope="col">Program</th>
		  <th scope="col">Responsibility Center</th>
		  <th scope="col">SAA #</th>
		  <th scope="col">Project</th>
		  <th scope="col">UACS Code</th>
		  <th scope="col">Account Title</th>
		  <th scope="col">Class Category</th>
		  <th scope="col">Budget</th>
		  <th scope="col"> </th>
		</tr>
	  </thead>
	  <tbody>
		<?php 
	  
	  include "php_actions/database_connect.php";
	  //PROGRAM
		$sql_sub_allot = "SELECT * FROM list_of_sub_allotments INNER JOIN sub_program ON list_of_sub_allotments.sub_program_id  = sub_program.sub_program_id INNER JOIN chart_of_accounts ON chart_of_accounts.chart_account_id = list_of_sub_allotments.uacs_id";
		$result_sub_allot = $connect->query($sql_sub_allot);
	  
		if ($result_sub_allot->num_rows > 0) {
			// output data of each row
			while($row_sub_allot = $result_sub_allot->fetch_assoc()) {
				
			?>
			<tr>
			<td><?php echo $row_sub_allot['sub_program_name'];?></td>
			<td><?php echo $row_sub_allot['responsibility_center'];?></td>
			<td>SAA# <?php echo $row_sub_allot['saa_number'];?></td>
			<td><?php echo $row_sub_allot['project'];?></td>
			<td><?php echo $row_sub_allot['chart_account_code'];?></td>
			<td><?php echo $row_sub_allot['chart_account_title'];?></td>
			<td><?php echo $row_sub_allot['class_category'];?></td>
			<td>&#8369; <?php echo number_format($row_sub_allot['budget'],2);?></td>
		  
			<td>
		  
			<a href="#" data-toggle="modal" data-target="#sub_allot_delete_modal<?php echo $row_sub_allot['sub_allot_id'];?>">DELETE</a> 
			
			|
			
			<a href="#" data-toggle="modal" data-target="#sub_allot_edit_modal<?php echo $row_sub_allot['sub_allot_id'];?>">EDIT</a>
			</td>
			</tr>
			
			<!-- EDIT Modal -->
			<div class="modal fade" id="sub_allot_edit_modal<?php echo $row_sub_allot['sub_allot_id'];?>" tabindex="-1" aria-labelledby="sub_allot_edit_modal" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="sub_allot_edit_modal">Edit Sub Allotment</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  
				  
				   <form action="php_actions/sub_allotment_update_function.php" method="POST">
				  
				   <?php include "sub_allot_edit.php"; ?>
				   
				   <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-primary" name="update_btn">Save Changes</button>
				  </div>
				</form>
				  
				</div>
			  </div>
			</div>
			
			<!-- DELETE Modal -->
				<div class="modal fade" id="sub_allot_delete_modal<?php echo $row_sub_allot['sub_allot_id'];?>" tabindex="-1" aria-labelledby="sub_allot_delete_modal" aria-hidden="true">
				  <div class="modal-dialog">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="sub_allot_delete_modal">Confirm Delete</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
					  
					  Are you sure you want to delete 
					  <b><?php echo $row_sub_allot['project'];?></b> Project?
					   
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						<a href="php_actions/sub_allotment_delete_function.php?id=<?php echo $row_sub_allot['sub_allot_id'];?>">
						<button type="button" class="btn btn-primary" name="add_btn">Confirm</button></a>
					  </div>
					  
					</div>
				  </div>
				</div>
<?php
			}
		}
		else { echo "NO DATA ON DB..."; }
?>
	  </tbody>
	</table>

  </div>
  
  
  
 </div>
 
 
 <!-- SUB ALLOTMENT Modal -->
			<div class="modal fade" id="sub_allotment_add_modal" tabindex="-1" aria-labelledby="sub_allotment_add_modal" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="sub_allotment_add_modal">Add Sub-Allotment</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  
				  <form action="add_sub_allotment_function.php" method="POST">
				  <div class="modal-body">
				  <input type="hidden" value="1" name="id">
				   
				   
				     <div class="row">
    
					<div class="col-md-12 order-md-1">
					  <h4 class="mb-3">SAA Information</h4>
					  
					  <div class="row">
					  
						<div class="col-md-12 mb-3">
						<label for="program">Program</label>
						<select name="sub_program" class="form-control select">
							
							<!-- INSERT DB PROGRAM LIST-->
							
							<?php 
							include "php_actions/database_connect.php";
							
							$sql_program_select = "SELECT * from sub_program ORDER BY agency_id ASC";
							$result_program_select  = $connect->query($sql_program_select);

							if($result_program_select->num_rows > 0){
								while($row_program_select  = $result_program_select->fetch_assoc()) {
							
							?>	
								<option value=<?php echo $row_program_select['sub_program_id'];?>>
								<?php echo $row_program_select['sub_program_name']; ?>

								</option>
							<?php 
								}
							}
							
							?>
							
						</select>
							
						  </div>
						  
						</div>
						
						<?php include "sub_allotment_add.php";?>
						
					</div>
				  </div>
				   
				   
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary" name="add_btn">Add Project</button>
				  </div>
				  </form>
				  
				</div>
			  </div>
			</div>
			
			
<?php 
$connect->close();
?>