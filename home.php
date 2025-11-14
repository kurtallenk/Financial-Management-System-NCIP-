<?php

include "php_actions/database_connect.php";


$sql_gas = "SELECT * FROM specific_budget WHERE agency_id=1";
$sql_sto = "SELECT * FROM specific_budget WHERE agency_id=2";
$sql_operations = "SELECT * FROM specific_budget WHERE agency_id=3";
$sql_sub_operations = "SELECT * FROM sub_program_budget WHERE agency_id=3";
$sql_ors = "SELECT * FROM ors";
$sql_dv = "SELECT * FROM disbursement";

$gas_num=0;
$sto_num=0;
$opr_num_all=0;
$ors_num=0;
$dv_num=0;

//GAS
	$result_gas = $connect->query($sql_gas);
		  
	if ($result_gas->num_rows > 0) {
	// output data of each row
		$gas_num = $result_gas->num_rows;
	}
//STO
	$result_sto = $connect->query($sql_sto);
		  
	if ($result_sto->num_rows > 0) {
	// output data of each row
		$sto_num = $result_sto->num_rows;
	}
	
//OPERATIONS
	$result_opr = $connect->query($sql_operations);
		  
	if ($result_opr->num_rows > 0) {
	// output data of each row
		$opr_num_all = $result_opr->num_rows;
		
		//SUB OPERATIONS
		$result_sub_opr = $connect->query($sql_sub_operations);
		  
		if ($result_sub_opr->num_rows > 0) {
		// output data of each row
			$opr_num_all += $result_sub_opr->num_rows;
		}
	}
	
//ORS
	$result_ors = $connect->query($sql_ors);
		  
	if ($result_ors->num_rows > 0) {
	// output data of each row
		$ors_num = $result_ors->num_rows;
	}
	
//DV
	$result_dv = $connect->query($sql_dv);
		  
	if ($result_dv->num_rows > 0) {
	// output data of each row
		$dv_num = $result_dv->num_rows;
	}
?>




<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Financial Transaction Management System</h1>

      </div>
		<br>
		
<div class="container-fluid">
		
	<?php 
		if($auth_id==1 || $auth_id == 2){ ?>
		<!-- PROJECTS -->
	<div class="row border rounded" style="padding: 10px;">
			<h2>PROJECTS</h2>
		
		
		<div class="col-md-12 d-flex justify-content-between">
			
			<!-- GAS -->
			<div class="row mx-md-n10 rounded" style="background-color:#DCDCDC; height: 130px; width: 23%;">
			
				  <div class="col px-md-10">
				  <div class="p-3 h3"><img src="icon/025-conference-2.png" class="img-fluid" alt="Responsive image"></div>
				  </div>
				  <div class="col px-md-10">
				  <div class="">
				  
					<table class="table">
				  
						<thead><tr><td colspan=2 style="text-align:center">
							<a href="index.php?o=gas" style="text-decoration: none;">
								<b class="h3">GAS</b>
							</a>
						</td></tr></thead>
						<tbody>
						<tr>
						<td style="text-align:center" class="user-select-all h5">
							<?php echo $gas_num;?>
						</td>
						<td style="text-align:center" class="user-select-all h5">
							<?php 
							if($auth_id==1 || $auth_id==2){
							?>	
							<a href="#" data-toggle="modal" data-target="#gas_add_modal"><button type="button" class="btn btn-success">+</button></a>
							<?php } ?>
						</td>
						
						
						</tr>
						
						</tbody>
				  
					</table>
				  
				  </div>
				  </div>
			</div>
			
			<!-- GAS END -->
			
			
			<!-- STO -->
			
			<div class="row mx-md-n10 rounded" style="background-color:#DCDCDC; height: 130px; width: 23%;">
			
				<div class="col px-md-10">
				  <div class="p-3 h3 mx-auto"><img src="icon/029-box.png" class="img-fluid" alt="Responsive image"></div>
				  </div>
				  <div class="col px-md-10">
				  <div class="">
				  
					<table class="table">
				  
						<thead><tr><td colspan=2 style="text-align:center">
							<a href="index.php?o=sto" style="text-decoration: none;">
								<b class="h3">STO</b>
							</a>
						</td></tr></thead>
						<tbody><tr><td style="text-align:center" class="user-select-all h5">
							<?php echo $sto_num;?>
						</td>
						
						<td style="text-align:center" class="user-select-all h5">
							<?php 
							if($auth_id==1 || $auth_id==2){
							?>	
							<a href="#" data-toggle="modal" data-target="#sto_add_modal"><button type="button" class="btn btn-success">+</button></a>
							<?php } ?>
						</td>
						
						</tr></tbody>
				  
					</table>
				  
				  </div>
				  </div>
			
			</div>
			<!-- STO END -->
			
			<!-- OPERATIONS -->
			<div class="row mx-md-n10 rounded" style="background-color:#DCDCDC; height: 130px; width: 23%;">
			
				<div class="col px-md-10">
				  <div class="p-3 h3"><img src="icon/021-browser.png" class="img-fluid" alt="Responsive image"></div>
				  </div>
				  <div class="col px-md-10">
				  <div class="">
				  
					<table class="table">
				  
						<thead><tr><td colspan=2 style="text-align:center">
							<a href="index.php?o=operations" style="text-decoration: none;">
								<b class="h3">OPR</b>
							</a>
						</td></tr></thead>
						<tbody><tr><td style="text-align:center" class="user-select-all h5">
							<?php echo $opr_num_all;?>
						</td>
						
						<td style="text-align:center" class="user-select-all h5">
							<?php 
							if($auth_id==1 || $auth_id==2){
							?>	
							<a href="#" data-toggle="modal" data-target="#operations_add_modal"><button type="button" class="btn btn-success">+</button></a>
							<?php } ?>
						</td>
						
						</tr></tbody>
				  
					</table>
				  
				  </div>
				  </div>
			
			</div>
			<!-- OPERATIONS END -->
			
			<!-- ALL -->
			<div class="row mx-md-n10 rounded" style="background-color:#DCDCDC; height: 130px; width: 23%;">
			
				<div class="col px-md-10">
				  <div class="p-3 h3"><img src="icon/065-podium.png" class="img-fluid"></div>
				  </div>
				  <div class="col px-md-10">
				  <div class="">
				  
					<table class="table">
				  
						<thead><tr><td style="text-align:center">
							<b class="h3">ALL</b>
						</td></tr></thead>
						<tbody><tr><td style="text-align:center" class="user-select-all h5">
							<?php echo $opr_num_all+$sto_num+$gas_num;?>
						</td></tr></tbody>
				  
					</table>
				  
				  </div>
				  </div>
			
			</div>
			<!-- ALL END -->
			
			
		</div>
	
	
		
		
	</div>
	<?php } ?>
	<!-- PROJECTS END-->
	
	<?php if($auth_id==1){?><hr class="invisible"> <?php } ?> <!-- SPACE -->
	
	<?php 
		 
		if($auth_id==1 || $auth_id == 3){
	?>
	
	<div class="row border rounded" style="padding: 10px;">
	
	<h2>ORS / DV</h2>
		
		<!-- ORS DV -->
		
		<div class="col-md-12 d-flex justify-content-around">
			
			<!-- ORS -->
			<div class="row mx-md-n10 rounded" style="background-color:#DCDCDC; height: 130px; width: 23%;">
			
				<div class="col px-md-10">
				  <div class="p-3 h3"><img src="icon/032-document-1.png" class="img-fluid" alt="Responsive image"></div>
				  </div>
				  <div class="col px-md-10">
				  <div class="">
				  
					<table class="table">
				  
						<thead><tr><td colspan=2 style="text-align:center">
							<a href="index.php?o=ors" style="text-decoration: none;">
								<b class="h3">ORS</b>
							</a>
						</td></tr></thead>
						<tbody><tr><td style="text-align:center" class="user-select-all h5">
							<?php echo $ors_num;?>
						</td>
						
						<td style="text-align:center" class="user-select-all h5">
							<?php 
							if($auth_id==1 || $auth_id==3){
							?>	
							<a href="#" data-toggle="modal" data-target="#ors_add_modal"><button type="button" class="btn btn-success">+</button></a>
							<?php } ?>
						</td>
						
						</tr></tbody>
				  
					</table>
				  
				  </div>
				  </div>
			
			</div>
			<!-- ORS END -->
			
			<!-- DV -->
			<div class="row mx-md-n10 rounded" style="background-color:#DCDCDC; height: 130px; width: 23%;">
			
				<div class="col px-md-10">
				  <div class="p-3 h3"><img src="icon/005-checklist-2.png" class="img-fluid" alt="Responsive image"></div>
				  </div>
				  <div class="col px-md-10">
				  <div class="">
				  
					<table class="table">
				  
						<thead><tr><td colspan=2 style="text-align:center">
							<a href="index.php?o=dv" style="text-decoration: none;">
								<b class="h3">DV</b>
							</a>
						</td></tr></thead>
						<tbody><tr><td style="text-align:center" class="user-select-all h5">
							<?php echo $dv_num;?>
						</td>
						
						<td style="text-align:center" class="user-select-all h5">
							<?php 
							if($auth_id==1 || $auth_id==3){
							?>	
							<a href="#" data-toggle="modal" data-target="#dv_add_modal"><button type="button" class="btn btn-success">+</button></a>
							<?php } ?>
						</td>
						
						</tr></tbody>
				  
					</table>
				  
				  </div>
				  </div>
			
			</div>
			<!-- DV END -->
		</div>
		
		<!-- ORS DV END -->
	</div>
	<?php 
		}
	?>
	
	<br>
	
	<div class="row">
		<div class="col-md-12 d-flex justify-content-between">
			
			<div class="row mx-md-n10 rounded d-flex justify-content-around" style="background-color:#DCDCDC; height: 300px; width: 50%;">
			
				

			</div>
			
			<div class="row mx-md-n10 rounded" style="background-color:#DCDCDC; height: 300px; width: 50%;">
			
				<div class="mx-auto" style="font-size:20px; padding: 5px;">
					Recent Activity
				</div>
				
				<div class="mx-auto rounded" style="background-color:white; height:80%; width: 95%; overflow:scroll;">
				
				<?php 
				
				$sql_activity = "SELECT * FROM activity ORDER BY activity_id DESC";
				
				
				$result_activity = $connect->query($sql_activity);
		  
				if ($result_activity->num_rows > 0) {
				// output data of each row
					while($row_activity = $result_activity->fetch_assoc()){
				?>
				
					<div class="mx-auto border-bottom" style="font-size:15px; padding: 5px; <?php if($row_activity['action']=="Delete"){ echo "color: red;";} else if($row_activity['action']=="Add"){echo "color: green;";} else if($row_activity['action']=="Edit"){echo "color: blue;";} ?>">
						<?php 
						echo  $row_activity['activity']; 
						echo "<span style='float:right;'>".$row_activity['activity_time']." / ".$row_activity['activity_date']."</span>";
						?>	
					</div>
				<?php
					}
				}
				?>
				
				</div>
			
			</div>
		</div>
		
	</div>
	
</div>


		
<?php
	$connect->close();
?>