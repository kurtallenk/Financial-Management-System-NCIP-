<?php 

if(!isset($_GET['ors_id'])){ 
	header("Location: index.php?o=ors");
	exit(); 
}

$ors_id = $_GET['ors_id'];

include "php_actions/database_connect.php";
?>

<div class="container-fluid">

  <div class="py-2 text-center">
	
	<div style="font-size:50px;">ORS</div>
	
    <h2>ORS Particulars</h2>
    
  </div>
  
<div class="row">

<?php 

$sql_ors = "SELECT * FROM ors WHERE ors_id=".$ors_id;
$result_ors = $connect->query($sql_ors);

		$serialnum="";
		$payee="";
		  
		if ($result_ors->num_rows > 0) {
			// output data of each row
			while($row_ors = $result_ors->fetch_assoc()) {
				$serialnum=$row_ors['serial_number'];
				$payee=$row_ors['payee'];
				$orsid=$row_ors['ors_id'];
			}	
		}
?>


<div> <h3><a href="index.php?o=ors"> Back </a></h3> </div>

<table class="table table-sm">
	<thead class="thead-dark">
	
	<tr>
	<th style="width:10%;">Payee</th>
	<td style="width:10%;"> <?php echo  $payee; ?> <a href="#" data-toggle="modal" data-target="#ors_edit_payee_modal<?php echo $orsid;?>">EDIT</a></td>
	<th style="width:10%;">Serial Number</th>
	<td style="width:10%;"> <?php echo  $serialnum; ?></td>

	</tr>
	
	</thead>
	
</table>
  
	
</div>


  
 <!-- INPUT FIELDS HERE-->
 
 
 
 
 
 
 <!-- INPUT FIELDS HERE END-->


  
<div class="row">

<div class="col-md-12">
	  <a class="nav-link" href="#" data-toggle="modal" data-target="#ors_part_add_modal" style="float: right;">
				  <h3>+ADD Particulars</h3>
	   </a>
	</div>

</div>

  <div class="row">
	<table class="table table-sm">

	  <thead class="thead-dark">
		<tr>
		  <th scope="col">Date</th>
		  <th scope="col">Sub-Program</th>
		  <th scope="col">Particulars</th>
		  <th scope="col">Responsibility Center</th>
		  <th scope="col">Class Category</th>
		  <th scope="col">Allotment</th>
		  <th scope="col">UACS</th>
		  <th scope="col">Amount</th>
		  <th colspan="1"> </th>
		</tr>
	  </thead>
	  <tbody>
<?php 

		$sql_ors_part = "SELECT * FROM ors_particulars INNER JOIN chart_of_accounts ON ors_particulars.uacs_id = chart_of_accounts.chart_account_id INNER JOIN sub_program ON sub_program.sub_program_id = ors_particulars.sub_program_id WHERE ors_id=".$ors_id." ORDER BY ors_particulars_id ASC";
			$result_ors_part = $connect->query($sql_ors_part);
		  
			if ($result_ors_part->num_rows > 0) {
				
				$number_of_particulars = $result_ors_part->num_rows;
				// output data of each row
				while($row_ors_part = $result_ors_part->fetch_assoc()) {
			?>
			
			
			<tr>
			<td><?php echo $row_ors_part['date_added'];?></td>
			<td><?php echo $row_ors_part['sub_program_accronym'];?></td>
			<td><?php echo $row_ors_part['particulars'];?></td>
			<td><?php echo $row_ors_part['responsibility_center'];?></td>
			<td><?php echo $row_ors_part['class_category'];?></td>
			<td>
			<?php 
			if($row_ors_part['allotment']==0){
				echo "GAA";
			}
			else if($row_ors_part['allotment']>0){
				echo "SAA ".$row_ors_part['allotment'];
			}
			?>
			
			</td>
			<td><?php echo $row_ors_part['chart_account_title'];?></td>
			<td>&#8369; <?php echo number_format($row_ors_part['particulars_amount'],2);?></td>
			<td>
		  
			<a href="#" data-toggle="modal" data-target="#ors_delete_modal<?php echo $row_ors_part['ors_particulars_id'];?>">DELETE</a> 
			
			|
			
			<a href="#" data-toggle="modal" data-target="#ors_edit_modal<?php echo $row_ors_part['ors_particulars_id'];?>">EDIT</a>
			</td>
			</tr>
			
			<!-- EDIT Modal -->
			<div class="modal fade" id="ors_edit_modal<?php echo $row_ors_part['ors_particulars_id'];?>" tabindex="-1" aria-labelledby="ors_edit_modal" aria-hidden="true">
			  <div class="modal-dialog">
			  
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="ors_edit_modal">Edit ORS
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  
				  <div class="modal-body">
				   <form action="php_actions/ors_particulars_update_function.php" method="POST">
				  
				  <input type="hidden" name="ors_part_id_edit" value="<?php echo $row_ors_part['ors_particulars_id'];?>">
				  <input type="hidden" name="ors_id_edit" value="<?php echo $row_ors_part['ors_id'];?>">
				  
				 <?php include "ors_particulars_edit.php"; ?>
				   </div>
				   <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-primary" name="update_btn">Save Changes</button>
				  </div>
				</form>  
				</div>
				
			  </div>
			</div>
			
			<!-- DELETE Modal -->
				<div class="modal fade" id="ors_delete_modal<?php echo $row_ors_part['ors_particulars_id'];?>" tabindex="-1" aria-labelledby="ors_delete_modal" aria-hidden="true">
				  <div class="modal-dialog">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="ors_delete_modal">Confirm Delete
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
					  
					  <h3>
					   Are you sure you want to delete 
					  <b><?php echo $row_ors_part['particulars'];?></b>? 
					   </h3>
					   
					   
					   
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						<a href="php_actions/ors_particulars_delete_function.php?ors_part_id=<?php echo $row_ors_part['ors_particulars_id']."&ors_id=".$row_ors_part['ors_id'];?>">
						<button type="button" class="btn btn-primary" name="delete_btn">Confirm</button></a>
					  </div>
					  
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
 
 
 <!-- ORS ADD Particulars Modal -->
			<div class="modal fade" id="ors_part_add_modal" tabindex="-1" aria-labelledby="ors_part_add_modal" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="ors_part_add_modal_title">Add Particulars
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  
				  <form action="add_ors_part_function.php" method="POST">
				  <div class="modal-body">
				  <input type="hidden" value="<?php echo $ors_id;?>" name="ors_id">
				  
						<div class="row">
						<div class="col-md-12 mb-1">
							<label for="country">Sub-program</label>
							<select class="custom-select d-block w-100" id="sub_program" name="sub_program" required>
							  <option value="">Choose...</option>
							  
					<?php 
				  
				  include "php_actions/database_connect.php";
				  
				  
				  $sql_sub_program = "SELECT * FROM sub_program";
				  $result_sub_program = $connect->query($sql_sub_program);
				  
				  if($result_sub_program->num_rows > 0){
					  while($row_sub_program = $result_sub_program->fetch_assoc()){
					  ?>
					  
					  <option value="<?php echo $row_sub_program['sub_program_id']; ?>"><?php echo $row_sub_program['sub_program_accronym']; ?></option>
					  
					  <?php  
						}
				  }
				  ?>
							  
							</select>

						  </div>
						  
						  <div class="col-md-12 mb-1">
							<label for="Project">Particular</label>
							<input type="text" class="form-control" name="particular" placeholder="Particular" value="">
						  </div>
						  
						  <div class="col-md-12 mb-1">
							<label for="rc">Responsibility Center</label>
							<select class="custom-select d-block w-100" name="rc">
							  <option>Regional Office</option>
							  <option>Abra</option>
							  <option>Apayao</option>
							  <option>Baguio</option>
							  <option>Benguet</option>
							  <option>Ifugao</option>
							  <option>Kalinga</option>
							  <option>Mountain Province</option>
							</select>
						  </div> 
						  
						  <div class="col-md-12 mb-1">
							<label for="class_category">Class Category</label>
							<select class="custom-select d-block w-100" name="class_category">
							  <option>MOOE</option>
							  <option>PS</option>

							</select>
						  </div>
						  
						  <div class="col-md-12 mb-1">
							<label for="class_category">Alloment</label>
							<select class="custom-select d-block w-100" name="allotment">
							  <option value=0>GAA</option>
							 <?php
							 
							 $sql_saa= "SELECT * FROM list_of_sub_allotments";
							 $result_saa = $connect->query($sql_saa);
		  
							if ($result_saa->num_rows > 0) {
								// output data of each row
								while($row_saa = $result_saa->fetch_assoc()) {
									if($row_saa['saa_number']>=1 and $row_saa['saa_number']<=9998){
										echo "<option value='".$row_saa['saa_number']."'>";
										echo "SAA ".$row_saa['saa_number'];
										echo "</option>";
									}
									else if($row_saa['saa_number']==9999){
										echo "<option value='".$row_saa['saa_number']."'>";
										echo "CA";
										echo "</option>";
									}
								}
							}
							 ?>

							</select>
						  </div>
						  
						  <div class="col-md-6 mb-1">
							<label for="uacs">UACS</label>
							<select class="custom-select d-block w-100" name="uacs" required>
							
								<?php include "addon/uacs_select.php"; ?>
								
							</select>

						  </div>
						  
						  <div class="col-md-6 mb-1">
							<label for="orsAmount">ORS Amount</label>
							<input type="text" class="form-control" name="particularAmount" placeholder="&#8369; Amount" value="" required>
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
			
<!-- EDIT ORS Payee Modal -->
			<div class="modal fade" id="ors_edit_payee_modal<?php echo $orsid;?>" tabindex="-1" aria-labelledby="ors_edit_payee_modal" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="ors_edit_payee_modal">Edit ORS</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  
				  
				   <form action="php_actions/ors_update_function_part_page.php" method="POST">
			  
				  <input type="hidden" name="ors_id" value="<?php echo $orsid;?>">
				  
				  <!-- -->
				  
				  <div class="container-fluid">
					  <div class="row">
						
						<div class="col-md-12 order-md-1">
						  <h4 class="mb-3">Obligation Status and Request Information</h4>
						  
						  <div class="row">
							  <div class="col-md-12 mb-3">
								<label for="serialnum">Serial Number</label>
								<input type="text" class="form-control" name="serialnum" placeholder="" value="<?php echo $serialnum;?>" required>
								<div class="invalid-feedback">
								  Serial Number is required.
								</div>
							  </div>
							  
							</div>
						  

							<div class="row">
							
							<div class="col-md-12 mb-3">
								<label for="payee">Payee</label>
								<input type="text" class="form-control" name="payee" placeholder="" value="<?php echo $payee;?>" required>
								<div class="invalid-feedback">
								  Valid first name is required.
								</div>
							  </div>
						  

							</div>
						</div>
					  </div>

					 </div>
				  
				   
				   
				   <!-- -->
				   <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-primary" name="update_btn">Save Changes</button>
				  </div>
				</form>
				  
				</div>
			  </div>
			</div>
			
<script type="text/javascript">
    $(window).on('load', function() {
        $('#ors_part_add_modal').modal('show');
    });
</script>