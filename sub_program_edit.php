<form action="update_sub_prog_function.php" method="POST">
				  <div class="modal-body">
				 
				  <input type="hidden" value="3" name="agency_id"/>
				  <!--<input type="hidden" value="<?php echo $sub_agency ?>" name="sub_agency"/>-->
<div class="row">
    
    <div class="col-md-12 order-md-1">
      <h4 class="mb-3">Project Information</h4>
	  
	  <div class="row">
	  
		 <input type="hidden" name="sub_prog_id" value="<?php echo $row_sub_program_operations['sub_program_budget_id'];?>"/>
		 
		 <div class="col-md-12 mb-3">
		<label for="program">Program</label>
		<select name="program" class="form-control select">
			
	<?php 
	$sql_program_select = "SELECT * from program WHERE agency_id=3";
	$result_program_select  = $connect->query($sql_program_select);

	if($result_program_select->num_rows > 0){
		while($row_program_select  = $result_program_select->fetch_assoc()) {
	
	?>
		<option value=<?php echo $row_program_select['program_id']; if($row_sub_program_operations['program_id'] == $row_program_select['program_id']){echo " selected";} ?>>
		<?php echo $row_program_select['program_name']; ?>
		</option>
	<?php 
		}
	}
	
	?>
			
		</select>
            
        </div>
		 
	  
		<div class="col-md-12 mb-3">
		<label for="subprogram">Sub-Program</label>
		<select name="subprogram" class="form-control select">
			
	<?php 
	$sql_sub_program_select = "SELECT * from sub_program WHERE agency_id=3";
	$result_sub_program_select  = $connect->query($sql_sub_program_select);

	if($result_sub_program_select->num_rows > 0){
		while($row_sub_program_select  = $result_sub_program_select->fetch_assoc()) {
	
	?>
		<option value=<?php echo $row_sub_program_select['sub_program_id']; if($row_sub_program_operations['sub_program_id'] == $row_sub_program_select['sub_program_id']){echo " selected";} ?>>
		<?php echo $row_sub_program_select['sub_program_name']; ?>
		</option>
	<?php 
		}
	}
	
	?>
			
		</select>
            
        </div>
		  
        </div>
		
		<div class="row">
	  
          <div class="col-md-6 mb-3">
            <label for="project">Project</label>
            <input type="text" class="form-control" name="project" id="project" placeholder="" value="<?php echo $row_sub_program_operations['project']; ?>">

          </div>
		  
          <div class="col-md-6 mb-3">
            <label for="classCategory">Class Category</label>
            <select class="custom-select d-block w-100" name="classCategory">
              <option <?php if($row_sub_program_operations['class_category'] == 'MOOE'){echo "selected";}?>>MOOE</option>
              <option <?php if($row_sub_program_operations['class_category'] == 'PS'){echo "selected";}?>>PS</option>
            </select>

          </div>
        </div>
		
		<div class="row">
		
			
		
			<div class="col-md-6 mb-3">
            <label for="gaasaa">UACS</label>
			
			<select class="custom-select d-block w-100" name="uacs" required>
			<?php 
			
			include "php_actions/database_connect.php";
			$sql_chart_of_accounts = "SELECT * FROM chart_of_accounts";
			$result_chart_of_accounts = $connect->query($sql_chart_of_accounts);
			
			if($result_chart_of_accounts->num_rows > 0){
			// output data of each row
				while($row_chart_of_accounts = $result_chart_of_accounts->fetch_assoc()) {
				?>
				
				<option value="<?php echo $row_chart_of_accounts['chart_account_id'];?>" <?php if($row_sub_program_operations['uacs_id']==$row_chart_of_accounts['chart_account_id']){ echo " selected";} ?>>
				<?php 
				echo $row_chart_of_accounts['chart_account_title']." - ".$row_chart_of_accounts['chart_account_code'];
				?>
				</option>
					
				<?php
				}
			}
			
			?>
            </select>
          </div>

		<div class="col-md-12 mb-1">
							<label for="class_category">Alloment</label>
							<select class="custom-select d-block w-100" name="allotment">
							  <option value=0 <?php if($row_sub_program_operations['allotment'] == 0){echo "selected";}?>>GAA</option>
							  <option value=9999 <?php if($row_sub_program_operations['allotment'] == 9999){echo "selected";}?>>CA</option>
							 <?php
							 
							 $sql_saa= "SELECT * FROM list_of_sub_allotments";
							 $result_saa = $connect->query($sql_saa);
		  
							if ($result_saa->num_rows > 0) {
								
								$selected="";
								// output data of each row
								while($row_saa = $result_saa->fetch_assoc()) {
									if($row_sub_program_operations['allotment'] == $row_saa['saa_number']){
										$selected="selected";
									}
									
									echo "<option value='".$row_saa['saa_number']."'.".$selected.">";
									echo "SAA ".$row_saa['saa_number'];
									echo "</option>";
								}
							}
							 ?>

							</select>
		</div>
		
		
    </div>
  </div>
  
  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-primary" name="update_btn">Save Changes</button>
					
				  </div>

</form>