  <div class="row">
    
    <div class="col-md-12 order-md-1">
      <h4 class="mb-3">Project Information</h4>
	  
	  <div class="row">
	  
		<input type="hidden" value="3" name="agency_id">
		<!--<input type="hidden" value="<?php echo $sub_agency ?>" name="sub_agency">-->
		
		<div class="col-md-6 mb-3">
		<label for="program">Program</label>
		<select name="program" class="form-control select" onchange="showSubProg(this.value)" required>
		<option disabled selected value> Select Program  </option>
			
	<?php 
	$sql_program_select = "SELECT * from program WHERE agency_id=3";
	$result_program_select  = $connect->query($sql_program_select);

	if($result_program_select->num_rows > 0){
		while($row_program_select  = $result_program_select->fetch_assoc()) {
	
	?>
		<option value=<?php echo $row_program_select['program_id'];?>>
		<?php echo $row_program_select['program_name']; ?>
		</option>
	<?php 
		}
	}
	
	?>
			
		</select>
            
        </div>
		
		<div class="col-md-6 mb-3">
		<label for="subprogram">Sub-Program</label>
		<select name="subprogram" class="form-control select" id="operations_sub_program" required>
			<option disabled selected value> <i>Select Program First</i> </option>
	
			
		</select>
            
        </div>
		  
        </div>
	  
		<div class="row">
	  
          <div class="col-md-6 mb-3">
            <label for="project">Project</label>
            <input type="text" class="form-control" name="project" id="project" placeholder="" value="">

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
        
    </div>
  </div>
  
  
  
<script>
		function showSubProg(id_val) {
			//document.write(id_val);
		  if (id_val == "") {
			  
			document.getElementById("operations_sub_program").innerHTML = "";
			return;
		  } else {
			var xmlhttp = new XMLHttpRequest();
			var handleRequestStateChange = function() {
			  if (this.readyState == 4 && this.status == 200) {
				document.getElementById("operations_sub_program").innerHTML = this.responseText;
			  }
			};
			
			xmlhttp.open("GET","addon/get_subprogram.php?q="+id_val,true);
			xmlhttp.onreadystatechange = handleRequestStateChange;
			xmlhttp.send();
		  }
		}
</script>