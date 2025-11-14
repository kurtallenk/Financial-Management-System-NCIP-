<div class="row">
    
    <div class="col-md-12 order-md-1">
      <h4 class="mb-3">Project Information</h4>
	  
	  <div class="row">
	  
		 <input type="hidden" name="id" value="<?php echo $row_program_gas['specific_budget_id'];?>">
	  
		<div class="col-md-6 mb-3">
		<label for="program">Program</label>
		<select name="program" class="form-control select">
			<option value=1 <?php if($row_program_gas['program_id'] == 1){echo "selected";}?>>General Management and Supervision</option>
			<option value=2 <?php if($row_program_gas['program_id'] == 2){echo "selected";}?>>Administration of Personnel Benefits</option>
		</select>
            
          </div>
	  
          <div class="col-md-6 mb-3">
            <label for="project">Project</label>
            <input type="text" class="form-control" name="project" id="project" placeholder="" value="<?php echo $row_program_gas['project']; ?>">

          </div>
		  
        </div>
	  

        <div class="row">
		
          <div class="col-md-4 mb-3">
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
		  
		  <div class="col-md-4 mb-3">
            <label for="gaasaa">GAA/SAA</label>
            <select class="custom-select d-block w-100" name="gaasaa" required>
              <option <?php if($row_program_gas['gaasaa'] == 'GAA'){echo "selected";}?>>GAA</option>
              <option <?php if($row_program_gas['gaasaa'] == 'SAA'){echo "selected";}?>>SAA</option>
            </select>
          </div>
		  
          <div class="col-md-4 mb-3">
            <label for="classCategory">Class Category</label>
            <select class="custom-select d-block w-100" name="classCategory">
              <option <?php if($row_program_gas['class_category'] == 'MOOE'){echo "selected";}?>>MOOE</option>
              <option <?php if($row_program_gas['class_category'] == 'PS'){echo "selected";}?>>PS</option>
            </select>

          </div>
        </div>
		
		<div class="row">
		
         <div class="col-md-6 mb-3">
            <label for="budget_value">Budget Value</label>
            <input type="text" class="form-control" name="budget_value" placeholder="&#8369;" value="<?php echo $row_program_gas['specific_budget_amount']; ?>" required>

          </div>

        </div>
    </div>
  </div>