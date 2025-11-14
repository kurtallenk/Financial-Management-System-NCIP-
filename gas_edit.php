<div class="modal-body">

<div class="row">
    
    <div class="col-md-12 order-md-1">
      <h4 class="mb-3">Project Information</h4>
	  
	  <div class="row">
		<input type="hidden" value="1" name="agency_id">
		 <input type="hidden" name="spec_budget_id" value="<?php echo $row_program_gas['specific_budget_id'];?>">
	  
		<div class="col-md-12 mb-3">
		<label for="program">Program</label>
		<select name="program" class="form-control select">
			<option value=1 <?php if($row_program_gas['program_id'] == 1){echo "selected";}?>>General Management and Supervision</option>
			<option value=2 <?php if($row_program_gas['program_id'] == 2){echo "selected";}?>>Administration of Personnel Benefits</option>
		</select>
            
          </div>
		  
        </div>
		
			  <div class="row">
	  
          <div class="col-md-12 mb-3">
            <label for="project">Project</label>
            <input type="text" class="form-control" name="project" id="project" placeholder="" value="<?php echo $row_program_gas['project']; ?>">

          </div>
		  
        </div>
	  

        <div class="row">
		
          <div class="col-md-6 mb-3">
            <label for="rc">Responsibility Center</label>
            <select class="custom-select d-block w-100" name="rc">
              <option <?php if($row_program_gas['responsibility_center'] == 'Regional Office'){echo "selected";}?>>Regional Office</option>
			  <option <?php if($row_program_gas['responsibility_center'] == 'Abra'){echo "selected";}?>>Abra</option>
			  <option <?php if($row_program_gas['responsibility_center'] == 'Apayao'){echo "selected";}?>>Apayao</option>
			  <option <?php if($row_program_gas['responsibility_center'] == 'Baguio'){echo "selected";}?>>Baguio</option>
			  <option <?php if($row_program_gas['responsibility_center'] == 'Benguet'){echo "selected";}?>>Benguet</option>
			  <option <?php if($row_program_gas['responsibility_center'] == 'Ifugao'){echo "selected";}?>>Ifugao</option>
			  <option <?php if($row_program_gas['responsibility_center'] == 'Kalinga'){echo "selected";}?>>Kalinga</option>
			  <option <?php if($row_program_gas['responsibility_center'] == 'Mountain Province'){echo "selected";}?>>Mountain Province</option>
            </select>
          </div>
		  
          <div class="col-md-6 mb-3">
            <label for="classCategory">Class Category</label>
            <select class="custom-select d-block w-100" name="classCategory">
              <option <?php if($row_program_gas['class_category'] == 'MOOE'){echo "selected";}?>>MOOE</option>
              <option <?php if($row_program_gas['class_category'] == 'PS'){echo "selected";}?>>PS</option>
            </select>

          </div>
        </div>
		
		<div class="row">
		
			
		
			<div class="col-md-6 mb-3">
            <label for="gaasaa">UACS</label>
			
			<select class="custom-select d-block w-100" name="uacs">
			<?php 
			
			$sql_chart_of_accounts = "SELECT * FROM chart_of_accounts";
			$result_chart_of_accounts = $connect->query($sql_chart_of_accounts);
			
			if($result_chart_of_accounts->num_rows > 0){
			// output data of each row
				while($row_chart_of_accounts = $result_chart_of_accounts->fetch_assoc()) {
				?>
				
				<option value="<?php echo $row_chart_of_accounts['chart_account_id'];?>" <?php if($row_program_gas['uacs_id']==$row_chart_of_accounts['chart_account_id']){ echo " selected";} ?>>
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

			<div class="col-md-6 mb-1">
							<label for="class_category">Alloment</label>
							<select class="custom-select d-block w-100" name="allotment">
							  <option value=0 <?php if($row_program_gas['allotment'] == 0){echo "selected";}?>>GAA</option>
							  <option value=9999 <?php if($row_program_gas['allotment'] == 9999){echo "selected";}?>>CA</option>
							 <?php
							 
							 $sql_saa= "SELECT * FROM list_of_sub_allotments";
							 $result_saa = $connect->query($sql_saa);
		  
							if ($result_saa->num_rows > 0) {
								
								$selected="";
								// output data of each row
								while($row_saa = $result_saa->fetch_assoc()) {
									if($row_program_gas['allotment'] == $row_saa['saa_number']){
										$selected="selected";
									}

									
									if($row_saa['saa_number']>=1 and $row_saa['saa_number']<=9998){
										echo "<option value='".$row_saa['saa_number']."'>"."' ".$selected.">";
										echo "SAA ".$row_saa['saa_number'];
										echo "</option>";
									}
									else if($row_saa['saa_number']==9999){
										echo "<option value='".$row_saa['saa_number']."' ".$selected.">";
										echo "CA";
										echo "</option>";
									}
								}
							}
							 ?>

							</select>
			</div>
		  
		</div>
		
		
		<div class="row">
		
         <div class="col-md-12 mb-3">
            <label for="budget_value">Budget Value</label>
            <input type="text" class="form-control" name="budget_value" placeholder="&#8369;" value="<?php echo $row_program_gas['specific_budget_amount']; ?>" required>

          </div>

        </div>
    </div>
  </div>
  
</div>