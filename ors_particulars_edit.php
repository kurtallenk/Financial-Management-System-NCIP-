

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
					  
					  <option value="<?php echo $row_sub_program['sub_program_id']; ?>" <?php if($row_ors_part['sub_program_id'] == $row_sub_program['sub_program_id']){echo "selected";}?>><?php echo $row_sub_program['sub_program_accronym']; ?></option>
					  
					  <?php  
						}
				  }
				  
				  
				  ?> 
							</select>
						</div>

						  <div class="col-md-12 mb-1">
							<label for="Project">Particulars</label>
							<input type="text" class="form-control" name="particular" placeholder="Project" value="<?php echo $row_ors_part['particulars'];?>">
						  </div>
						  
						  <div class="col-md-12 mb-1">
							<label for="rc">Responsibility Center</label>
							<select class="custom-select d-block w-100" name="rc">
							  <option <?php if($row_ors_part['responsibility_center'] == "Regional Office"){echo "selected";}?>>Regional Office</option>
							  <option <?php if($row_ors_part['responsibility_center'] == "Abra"){echo "selected";}?>>Abra</option>
							  <option <?php if($row_ors_part['responsibility_center'] == "Apayao"){echo "selected";}?>>Apayao</option>
							  <option <?php if($row_ors_part['responsibility_center'] == "Baguio"){echo "selected";}?>>Baguio</option>
							  <option <?php if($row_ors_part['responsibility_center'] == "Benguet"){echo "selected";}?>>Benguet</option>
							  <option <?php if($row_ors_part['responsibility_center'] == "Ifugao"){echo "selected";}?>>Ifugao</option>
							  <option <?php if($row_ors_part['responsibility_center'] == "Kalinga"){echo "selected";}?>>Kalinga</option>
							  <option <?php if($row_ors_part['responsibility_center'] == "Mountain Province"){echo "selected";}?>>Mountain Province</option>
							</select>
						  </div>
						  
						  <div class="col-md-12 mb-1">
							<label for="class_category">Class Category</label>
							<select class="custom-select d-block w-100" name="class_category">
							  <option <?php if($row_ors_part['class_category'] == "MOOE"){echo "selected";}?>>MOOE</option>
							  <option <?php if($row_ors_part['class_category'] == "PS"){echo "selected";}?>>PS</option>

							</select>
						  </div>
						  
						  <div class="col-md-12 mb-1">
							<label for="class_category">Alloment</label>
							<select class="custom-select d-block w-100" name="allotment">
							  <option value=0 <?php if($row_ors_part['allotment'] == 0){echo "selected";}?>>GAA</option>
							  <option value=9999 <?php if($row_ors_part['allotment'] == 9999){echo "selected";}?>>CA</option>
							 <?php
							 
							 $sql_saa= "SELECT * FROM list_of_sub_allotments";
							 $result_saa = $connect->query($sql_saa);
		  
							if ($result_saa->num_rows > 0) {
								
								$selected="";
								// output data of each row
								while($row_saa = $result_saa->fetch_assoc()) {
									if($row_ors_part['allotment'] == $row_saa['saa_number']){
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
						  
						  <div class="col-md-6 mb-1">
							<label for="uacs">UACS</label>
							<select class="custom-select d-block w-100" name="uacs" required>
							
							<?php 
							
							$sql_chart_of_accounts = "SELECT * FROM chart_of_accounts";
							$result_chart_of_accounts = $connect->query($sql_chart_of_accounts);
							
							if($result_chart_of_accounts->num_rows > 0){
							// output data of each row
								while($row_chart_of_accounts = $result_chart_of_accounts->fetch_assoc()) {
								?>
								
								<option value="<?php echo $row_chart_of_accounts['chart_account_id'];?>" <?php if($row_ors_part['uacs_id']==$row_chart_of_accounts['chart_account_id']){ echo " selected";} ?>>
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
							<label for="orsAmount">ORS Amount</label>
							<input type="text" class="form-control" name="particularAmount" placeholder="&#8369; Amount" value="<?php echo $row_ors_part['particulars_amount'];?>" required>
						  </div>
					  
</div>