<div class="container">

<div class="row d-flex justify-content-between">

	<div class="">
		<h3>Disbursement Voucher</h3>
		<h4 style="color:red;" class="invisible"> ON PROGRESS </h4>
	</div>

	<div class="">
		<h5>Status</h5> 
		<input class="border rounded" type="checkbox" data-toggle="toggle" data-onstyle="success" data-width="100" data-on="Done" data-off="Pending" name="status">
	</div>
</div>


<div class="row">
<div class="col-md-6">

<div class="row">

	<!-- SELECT ORS -->
	<div class="col-md-8">
		<label for="ors_id">Select ORS</label>
		<select class="form-control select" name="ors_id" onchange="showORS(this.value)" required>
			<option id="choose_option" value="">Choose...</option>
			<?php 
				  
				include "php_actions/database_connect.php";
				  
				
				$sql_ors = "SELECT * FROM ors";
				$result_ors = $connect->query($sql_ors);
				  
				if($result_ors->num_rows > 0){
					while($row_ors = $result_ors->fetch_assoc()){
			?>
					  
					<option value="<?php echo $row_ors['ors_id']; ?>"><?php echo $row_ors['payee']." - ".$row_ors['serial_number']; ?></option>
					  
			<?php  
					}
				}
			?>
		</select>
	</div>
	
	<!-- DATE -->
	<div class="col-md-4">
		<label for="date">Date</label>
		<input type="text" class="form-control" name="date" id="datepicker" value="<?php echo date("Y/m/d");?>" readonly>
	</div>

	<!-- PAYMENT METHOD -->
	<div class="col-md-6" style="padding-top: 10px;">	
		<div class="border rounded mx-auto" style="padding: 5px;">
		<div class="col-md-12">
			<label for="payment_method"><h6>Payment Method</h6></label>
		</div>
		
		<div class=""><center>
			<div>
				<input type="radio" checked name="payment_method" id="payment_method_mds" value="MDS" onclick="showCardForm()"> MDS
			</div>
			
			<div>
				<input type="radio" name="payment_method" id="payment_method_ada" value="ADA" onclick="showCardForm()"> ADA
			</div>
			
			</center>
		</div>
		</div>
	</div>
	
	<!-- TAX -->
	<div class="col-md-6" style="padding-top: 10px;">
		<div class="border rounded mx-auto" style="padding: 5px;">
			<div class="col-md-12">
				<label for="payment_method"><h6>Tax</h6></label>
			</div>
			
			<div class="">
				<select class="form-control select" name="tax"required>
			<option value=0>No Tax</option>
			<?php 			  
				
				$sql_uacs_bir = "SELECT * FROM uacs_bir";
				$result_uacs_bir = $connect->query($sql_uacs_bir);
				  
				if($result_uacs_bir->num_rows > 0){
					while($row_uacs_bir = $result_uacs_bir->fetch_assoc()){
			?>
					  
					<option value="<?php echo $row_uacs_bir['uacs_bir_id']; ?>"><?php echo $row_uacs_bir['chart_account_title']." - ".$row_uacs_bir['uacs_number']; ?></option>
					  
			<?php  
					}
				}
			?>
		</select>
				
			</div>
			
		</div>
	</div>
	
	<!-- ADA - BANK INFO -->
	<div id="credit_card_form" style="display: none;">
	
		<?php include 'addon/display_card_input_form.php';
		
		?>
	</div>
</div>

</div>

	<div class="col-md-6">
	
		<div class="row" id="ors_details">
	
			<div class="col-md-6">
				<label for="serial_number">Serial Number</label>
				<input type="text" class="form-control" name="serial_number" id="serial_number" placeholder="" value="" disabled>

			</div>
			  
			<div class="col-md-6">
				<label for="project">Payee</label>
				<input type="text" class="form-control" name="payee" id="payee" placeholder="" value="" disabled>

			</div>
			
			<div class="col-md-12 tableFixHead2">
			<br>
				<table class="table">
						
						<thead>
						
							<tr>
								<th>Particulars</th>
								<th>RC</th>
								<th>Amount</th>
								<th></th>
							</tr>		
						</thead>
						
						<tbody>
							<tr>
								<td colspan=4><center>Select ORS</center></td>
							</tr>
						</tbody>
				</table>
			</div>
	
		</div>
		
			

	</div>

</div>

  <?php include 'includes/footer.php';?>
  
 </div>
 
 
 <script type="text/javascript">
		function showORS(id_val) {
			//document.write(id_val);
		  if (id_val == "") {
			  
			document.getElementById("ors_details").innerHTML = "";
			return;
		  } else {
			  document.getElementById("choose_option").disabled = true;
			var xmlhttp = new XMLHttpRequest();
			var handleRequestStateChange = function() {
			  if (this.readyState == 4 && this.status == 200) {
				document.getElementById("ors_details").innerHTML = this.responseText;
			  }
			};
			
			xmlhttp.open("GET","addon/get_ors_details.php?q="+id_val,true);
			xmlhttp.onreadystatechange = handleRequestStateChange;
			xmlhttp.send();
		  }
		}
		
		
		function showCardForm() {
			var chkADA = document.getElementById("payment_method_ada");
			var dvCardForm = document.getElementById("credit_card_form");
			
			dvCardForm.style.display = chkADA.checked ? "block" : "none";
		}
		
</script>