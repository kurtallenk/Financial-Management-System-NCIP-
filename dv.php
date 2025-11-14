<div class="container-fluid">

  <div class="py-3 text-center">

	
    <h1>Disbursement Voucher</h1>
    
  </div>
 
  
  
<div class="row">

<div class="col-md-12">
	  <a class="nav-link" href="#" data-toggle="modal" data-target="#dv_add_modal" style="float: right;">
				  <h3>+ADD DV</h3>
	   </a>
	</div>

</div>

  <div class="row">
	<table class="table table-bordered table-sm table-hover" cellspacing="0">

	  <thead class="thead-dark">
		<tr>
		  <th scope="col">DV Number</th>
		  <th scope="col">Payee</th>
		  <th scope="col">Project</th>
		  <th scope="col">Tax</th>
		  <th scope="col">Gross</th>
		  <th scope="col">Net</th>
		  <th scope="col">Status</th>
		  <th scope="col"> </th>
		</tr>
	  </thead>
	  <tbody id="dataTable">
		<?php 
	  
	  include "php_actions/database_connect.php";
	  
	  $payee="";
	  $project="";
	  $tax_uacs_title="";
	  
	  //DISBURSEMENT
		$sql_disbursement = "SELECT * FROM disbursement ORDER BY dv_id DESC";
		$result_disbursement = $connect->query($sql_disbursement);
	  
		if ($result_disbursement->num_rows > 0) {
			
			// output data of each row
			while($row_disbursement = $result_disbursement->fetch_assoc()) {
				
				//GET PAYEE NAME (ORS)
				$sql_ors="SELECT * FROM ors WHERE ors_id=".$row_disbursement['ors_id'];
				$result_ors = $connect->query($sql_ors);
				
				if($result_ors->num_rows > 0){
					  while($row_ors = $result_ors->fetch_assoc()){
						  $payee=$row_ors['payee'];
						  $project=$row_ors['project'];
					  }
				}
				//GET PAYEE NAME END
				
				//GET UACS BIR TITLE
				if($row_disbursement['tax_id']>=1){ //IF TAX is not zero
					$sql_uacs_bir="SELECT * FROM uacs_bir WHERE uacs_bir_id=".$row_disbursement['tax_id'];
					$result_uacs_bir = $connect->query($sql_uacs_bir);
					
					if($result_uacs_bir->num_rows > 0){
						  while($row_uacs_bir = $result_uacs_bir->fetch_assoc()){
							  $tax_uacs_title=$row_uacs_bir['chart_account_title'];
						  }
					}
					//GET UACS TITLE END
				}else{
					$tax_uacs_title = "No Tax";
				}
				
			?>
			
			
			<tr>
			<td><?php echo $row_disbursement['dv_number'];?></td>
			<td><?php echo $payee;?></td>
			<td><?php echo $project;?></td>
			<td><?php echo $tax_uacs_title;?></td>
			<td>&#8369; <?php echo number_format($row_disbursement['dv_amount_gross'],2);?></td>
			<td>&#8369; <?php echo number_format($row_disbursement['dv_amount_tax'],2);?></td>
			<td> 
				<form action="php_actions/dv_change_status.php" method="POST">
				
					<input type="hidden" value="<?php echo $row_disbursement['dv_id'];?>" name="dv_id">
					<select class="form-control select" name="dv_status" onchange="this.form.submit()">
						<!-- style='<?php //if($row_disbursement['dv_status']=="Done"){echo "color: green;";}else{echo "color: gray;";} ?>' -->
						
						<option value="Pending" <?php if($row_disbursement['dv_status']=="Pending"){echo "Selected";}?>>&#65049; Pending</option>
						
						<option value="Done" <?php if($row_disbursement['dv_status']=="Done"){echo "Selected";}?>>&#9989; Done</option>
						
						
					</select>
				</form>
			</td>
			<td class="d-flex justify-content-center">
		  
			<a href="#" data-toggle="modal" data-target="#dv_delete_modal<?php echo $row_disbursement['dv_id'];?>">
			<button type="button" class="btn btn-danger">Delete</button>
			</a> 
			
			<a href="index.php?o=dv_print_view&q=<?php echo $row_disbursement['dv_id'].'&p='.$row_disbursement['ors_id'];?>">
			<button type="button" class="btn btn-info">View
			</button>
			</a> 
			
			</td>
			</tr>
			
			<!-- DELETE Modal -->
				<div class="modal fade" id="dv_delete_modal<?php echo $row_disbursement['dv_id'];?>" tabindex="-1" aria-labelledby="ors_delete_modal" aria-hidden="true">
				  <div class="modal-dialog">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="ors_delete_modal">Confirm Delete</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
					  
					  <form action="php_actions/dv_delete_function.php" method="POST">
			  
				  <input type="hidden" name="dv_id" value="<?php echo $row_disbursement['dv_id'];?>">
				  <input type="hidden" name="dv_serial_num" value="<?php echo $row_disbursement['dv_number'];?>">
					  <h5>
					  Are you sure you want to delete DV Number:
					  <b><?php echo $row_disbursement['dv_number'];?></b>
					   
					   </h5>
					   
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						<a href="php_actions/dv_delete_function.php?id=<?php echo $row_disbursement['dv_id'];?>">
						<button type="submit" class="btn btn-primary" name="del_btn">Confirm</button></a>
					  </div>
					  
					  </form>
					  
					</div>
					
				  </div>
				</div>
				
				<!-- PRINT VIEW Modal -->
				<div class="modal fade" id="dv_print_view_modal<?php echo $row_disbursement['dv_id'];?>" tabindex="-1" aria-labelledby="dv_print_view_modal" aria-hidden="true">
				  <div class="modal-dialog">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="dv_print_view_modal">Print Preview</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
						<div class="modal-body">
							

						</div>
						
						<div class="modal-footer">
							<button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
							
							<a href="javascript:window.print()"><button type="button" class="btn btn-secondary">Print</button></a>
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
 
<?php 
$connect->close();
?>