<div class="row">
	  
          <div class="col-md-12 mb-3">
            <label for="project">Project</label>
            <input type="text" class="form-control" name="project" id="project" placeholder="" value="">

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
            <label for="classCategory">Class Category</label>
            <select class="custom-select d-block w-100" name="classCategory">
              <option>MOOE</option>
              <option>PS</option>
            </select>

          </div>
        </div>
		
		<div class="row">
		
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

		  
		  <div class="col-md-6 mb-1">
							<label for="class_category">Alloment</label>
							<select class="custom-select d-block w-100" name="allotment">
							  <option value=0>GAA</option>
							  <option value=9999>CA</option>
							 <?php
							 
							 $sql_saa= "SELECT * FROM list_of_sub_allotments";
							 $result_saa = $connect->query($sql_saa);
		  
							if ($result_saa->num_rows > 0) {
								
								$selected="";
								// output data of each row
								while($row_saa = $result_saa->fetch_assoc()) {
																		
									echo "<option value='".$row_saa['saa_number']."'.".$selected.">";
									echo "SAA ".$row_saa['saa_number'];
									echo "</option>";
								}
							}
							 ?>

							</select>
			</div>

        </div>
		
		<div class="row">
		
         <div class="col-md-12 mb-3">
            <label for="budget_value">Budget Value</label>
            <input type="text" class="form-control" name="budget_value" placeholder="&#8369; Amount" required>

          </div>

        </div>