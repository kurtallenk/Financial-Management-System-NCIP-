<div class="modal-body">

<div class="row">
    
    <div class="col-md-12 order-md-1">
      <h4 class="mb-3">SAA Information</h4>
	  
	  <div class="row">
		<input type="hidden" value="<?php echo $row_sub_allot['sub_allot_id']; ?>" name="id">
	  
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
								<option value=<?php echo $row_program_select['sub_program_id']; if($row_program_select['sub_program_id'] == $row_sub_allot['sub_program_id']){ echo " selected"; }?>>
								<?php echo $row_program_select['sub_program_name'];?>

								</option>
							<?php 
								}
							}
							
							?>
							
						</select>
							
						  </div>
		  
        </div>
		
			  <div class="row">
			  
			  <div class="col-md-12 mb-3">
            <label for="project">SAA #</label>
            <input type="text" class="form-control" name="saa_num" id="project" placeholder="Enter SAA Number" value="<?php echo $row_sub_allot['saa_number']; ?>">

          </div>
	  
          <div class="col-md-12 mb-3">
            <label for="project">Description</label>
            <input type="text" class="form-control" name="project" id="project" placeholder="Description" value="<?php echo $row_sub_allot['project']; ?>">

          </div>
		  
        </div>
	  

        <div class="row">
		
          <div class="col-md-6 mb-3">
            <label for="rc">Responsibility Center</label>
            <select class="custom-select d-block w-100" name="rc">
              <option <?php if($row_sub_allot['responsibility_center'] == 'Regional Office'){echo "selected";}?>>Regional Office</option>
			  <option <?php if($row_sub_allot['responsibility_center'] == 'Abra'){echo "selected";}?>>Abra</option>
			  <option <?php if($row_sub_allot['responsibility_center'] == 'Apayao'){echo "selected";}?>>Apayao</option>
			  <option <?php if($row_sub_allot['responsibility_center'] == 'Baguio'){echo "selected";}?>>Baguio</option>
			  <option <?php if($row_sub_allot['responsibility_center'] == 'Benguet'){echo "selected";}?>>Benguet</option>
			  <option <?php if($row_sub_allot['responsibility_center'] == 'Ifugao'){echo "selected";}?>>Ifugao</option>
			  <option <?php if($row_sub_allot['responsibility_center'] == 'Kalinga'){echo "selected";}?>>Kalinga</option>
			  <option <?php if($row_sub_allot['responsibility_center'] == 'Mountain Province'){echo "selected";}?>>Mountain Province</option>
            </select>
          </div>
		 
			
		
			<div class="col-md-6 mb-3">
            <label for="gaasaa">UACS</label>
			
			<select class="custom-select d-block w-100" name="uacs">
			<?php 
			
			$sql_chart_of_accounts = "SELECT * FROM chart_of_accounts ORDER BY chart_account_title ASC";
			$result_chart_of_accounts = $connect->query($sql_chart_of_accounts);
			
			if($result_chart_of_accounts->num_rows > 0){
			// output data of each row
				while($row_chart_of_accounts = $result_chart_of_accounts->fetch_assoc()) {
				?>
				
				<option value="<?php echo $row_chart_of_accounts['chart_account_id'];?>" <?php if($row_sub_allot['uacs_id']==$row_chart_of_accounts['chart_account_id']){ echo " selected";} ?>>
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
		  
		</div>
		
		
		<div class="row">
		
         <div class="col-md-12 mb-3">
            <label for="budget_value">Budget Value</label>
            <input type="text" class="form-control" name="budget_value" placeholder="&#8369;" value="<?php echo $row_sub_allot['budget']; ?>" required>

          </div>

        </div>
    </div>
  </div>
  
</div>