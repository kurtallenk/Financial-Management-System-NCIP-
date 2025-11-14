  
<div class="row">

			<div class="col-md-12 mb-3">
            <label for="description">SAA #</label>
            <input type="text" class="form-control" name="saa_num" placeholder="Enter #" required>

          </div>
		
			<div class="col-md-12 mb-3">
            <label for="description">Description</label>
            <input type="text" class="form-control" name="description" placeholder="Enter Description">

          </div>
		

        </div>
		
        <div class="row">
		
          <div class="col-md-6 mb-3">
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
		  
		  <div class="col-md-6 mb-3">
            <label for="gaasaa">UACS</label>
			
			<select class="custom-select d-block w-100" name="uacs" required>
			<?php 
			
			include "php_actions/database_connect.php";
			$sql_chart_of_accounts = "SELECT * FROM chart_of_accounts ORDER BY chart_account_title ASC";
			$result_chart_of_accounts = $connect->query($sql_chart_of_accounts);
			
			if($result_chart_of_accounts->num_rows > 0){
			// output data of each row
				while($row_chart_of_accounts = $result_chart_of_accounts->fetch_assoc()) {
				?>
				
				<option value="<?php echo $row_chart_of_accounts['chart_account_id'];?>">
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
            <input type="text" class="form-control" name="budget_value" placeholder="&#8369;" required>

          </div>

        </div>