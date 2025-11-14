<?php


include "../php_actions/database_connect.php";
	
	$id = $_GET['q'];
	$projectName = $_GET['p'];
	
	$sql_subprogram_rc = "SELECT * FROM sub_program_rc WHERE sub_program_budget_id=$id";
	$result_subprogram_rc = $connect->query($sql_subprogram_rc);


?>

	<div class="row">

		<div class="col-md-8"><h2>RCs</h2>
		
			<b style="position:absolute; color: green;"><?php echo $projectName?></b>
		</div>
		
		<div class="col-md-4">
			<div style="float: right;">
			<a class="nav-link" href="#" data-toggle="modal" data-target="#sub_prog_rc_add_modal">
					  <button class="btn btn-primary btn-lg" style="text-decoration: none;">+ADD</button>
		   </a>
		   </div>
		</div>
		
	</div>


	<table class="table table-bordered table-sm table-hover " cellspacing="0"
	  width="100%" style="border: 1px solid black;">
	  
	<thead class="thead-dark" style="height: 50px;">
		<tr>
			<th class="th-sm" style="width: 40%">RC</th>
			<th class="th-sm" style="width: 30%">Budget</th>
			<th class="th-sm">Action</th>
		</tr>
	</thead>
		  <tbody>
		
		  <!---->
		  <?php 
		  if ($result_subprogram_rc->num_rows > 0) {
			while($row_subprogram_rc = $result_subprogram_rc->fetch_assoc()) {
		  ?>
		  <tr>
			<td><?php echo $row_subprogram_rc['rc']; ?></td>
			<td>&#8369; <?php echo number_format($row_subprogram_rc['rc_budget'],2); ?></td>
			<td>
			
			<a href="#" data-toggle="modal" data-target="#sub_prog_rc_delete_modal<?php echo $row_subprogram_rc['sub_program_rc_id'];?>">DELETE</a> |
			<a href="#" data-toggle="modal" data-target="#sub_prog_rc_edit_modal<?php echo $row_subprogram_rc['sub_program_rc_id'];?>">EDIT</a>
			
			
			<!-- EDIT Modal -->
		  
			<div class="modal fade" id="sub_prog_rc_edit_modal<?php echo $row_subprogram_rc['sub_program_rc_id'];?>" tabindex="-1" aria-labelledby="sub_prog_rc_edit_modal" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="sub_prog_rc_edit_modal">Edit RC</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				<form id="update_rc_f_js" action="./update_sub_prog_rc_function.php" method="POST">
					<div class="modal-body">
				  
					<?php include "../sub_program_rc_edit.php";?>
					
					<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-primary" name="update_btn">Save Changes</button>
				  </div>

				</div>
				</form>
			  </div>
			</div>
			
			<!-- DELETE Modal -->
				<div class="modal fade" id="sub_prog_rc_delete_modal<?php echo $row_subprogram_rc['sub_program_rc_id'];?>" tabindex="-1" aria-labelledby="sub_prog_rc_delete_modal" aria-hidden="true">
				  <div class="modal-dialog">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="sub_prog_rc_delete_modal">Confirm Delete</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
					  
					  Are you sure you want to delete 
					  <b><?php echo $row_subprogram_rc['rc'];?></b> from Project?
					   
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						<a href="php_actions/subprog_rc_delete_function.php?rc_id=<?php echo $row_subprogram_rc['sub_program_rc_id'];?>&s_id=<?php echo $_GET['q'];?>&s_name=<?php echo $_GET['p'];?>">
						<button type="button" class="btn btn-primary" name="del_btn">Confirm</button></a>
					  </div>

					</div>
				  </div>
				</div>
			
			</td>
		  </tr>
		  
		  
		  
		  <?php
			}
		  }
		  
		  else{
			  ?>
			  <tr>
			<td colspan=3><center style="font-size: 15px; color: red;">No RC record for this Sub Program</center></td>
		  </tr>
			  <?php
		  }
		  ?>
			<!---->
		  
		  </tbody>
	  
	</table>
	
	<!-- RC ADD Modal -->
			<div class="modal fade" id="sub_prog_rc_add_modal" tabindex="-1" aria-labelledby="operations_add_modal" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="sub_prog_rc_add_modal">Add RC to <?php echo $projectName;?></b></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  
				  <form action="add_subprog_rc_function.php" method="POST">
				  <div class="modal-body">
				  
				  <input type="hidden" value="<?php echo $id;?>" name="subprog_budget_id">
				   <?php include "../sub_program_rc_add.php"?>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary" name="add_btn">Add RC</button>
				  </div>
				  </form>
				  
				</div>
			  </div>
			</div>
<!-- / OPERATIONS Modal -->


