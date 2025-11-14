
				 <input type="hidden" value="<?php echo $id; ?>" name="sub_prog_id">
				 
				  <input type="hidden" value="<?php echo $row_subprogram_rc['sub_program_rc_id']; ?>" name="sub_prog_rc_id">
				  
				  <input type="hidden" value="<?php echo $projectName; ?>" name="projectName">
				  
				  <input type="hidden" value="<?php echo $row_subprogram_rc['rc_budget']; ?>" name="current_budget">
				  
				  <div class="row">
		
					  <div class="col-md-12 mb-3">
						<label for="rc">Responsibility Center</label>
						<select class="custom-select d-block w-100" name="rc">
						  <option <?php if($row_subprogram_rc['rc'] == "Regional Office" ){echo "selected";}?>>Regional Office</option>
						  <option <?php if($row_subprogram_rc['rc'] == "Abra" ){echo "selected";}?>>Abra</option>
						  <option <?php if($row_subprogram_rc['rc'] == "Apayao" ){echo "selected";}?>>Apayao</option>
						  <option <?php if($row_subprogram_rc['rc'] == "Baguio" ){echo "selected";}?>>Baguio</option>
						  <option <?php if($row_subprogram_rc['rc'] == "Benguet" ){echo "selected";}?>>Benguet</option>
						  <option <?php if($row_subprogram_rc['rc'] == "Ifugao" ){echo "selected";}?>>Ifugao</option>
						  <option <?php if($row_subprogram_rc['rc'] == "Kalinga" ){echo "selected";}?>>Kalinga</option>
						  <option <?php if($row_subprogram_rc['rc'] == "Mountain Province" ){echo "selected";}?>>Mountain Province</option>
						</select>
					  </div>
					</div>
		
		<div class="row">
		
         <div class="col-md-12 mb-3">
            <label for="budget_value">Budget Value</label>
            <input type="text" class="form-control" name="rc_budget_value" placeholder="&#8369; Amount" value="<?php echo $row_subprogram_rc['rc_budget'];?>" required>

          </div>
		  </div>
        </div>
