<?php

//CONNECT DATABASE

include "php_actions/database_connect.php";


$search = "";
$issearch = false;

//GET DATA
if(isset($_POST['search_btn'])){
	$issearch = true;
	$search = $_POST['search_input'];
}

//AGENCY
$agency_num = 1;
$sub_agency = 0;

//SUB AGENCY
if(isset($_GET['a_id'])){
	$sub_agency = $_GET['a_id'];
}

$sql_agency_gas = "SELECT * FROM agency WHERE agency_id=$agency_num";
$result_agency_gas = $connect->query($sql_agency_gas);

$agency_budget=0;//BUDGET

if ($result_agency_gas->num_rows > 0) {
			// output data of each row
			while($row_agency_gas = $result_agency_gas->fetch_assoc()) {
				$agency_budget = $row_agency_gas['agency_budget'];
			}
}




include "php_actions/display_allotment.php";

?>

<div class="container-fluid">

<div class="py-3 text-center">
    <div style="font-size:50px;">General Administration and Support</div>
	

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?o=programs_budget">Programs and Budget</a></li>
    <li class="breadcrumb-item active" aria-current="page">GAS</li>
	<li class="breadcrumb-item"><a href="index.php?o=sto">STO</a></li>
	<li class="breadcrumb-item"><a href="index.php?o=operations">OPERATIONS</a></li>
  </ol>
</nav>

</div>

<div class="row">
	<div class="col-md-12" style="border: 0px solid green; padding: 0px;">

	<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
	
		<li class="nav-item">
			<span class="nav-link" style="border-radius: 40px; background-color: black; color: white;"><h4>GAS</h4></span>
		</li>
	
		<li class="nav-item">
        <a class="nav-link" href="index.php?o=gas&a_id=3">
		<button type="button" class="btn <?php if($sub_agency == 3){ echo "btn-info";} else{ echo "btn-outline-info";}?>">
			All GAS Programs
		</button>
		</a>
		
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?o=gas&a_id=1">
		<button type="button" class="btn <?php if($sub_agency == 1){ echo "btn-info";} else{ echo "btn-outline-info";}?>">
			General Administration and Support
		</button>
		</a>
		
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?o=gas&a_id=2">
		<button type="button" class="btn <?php if($sub_agency == 2){ echo "btn-info";} else{ echo "btn-outline-info";}?>">
			Administration of Personnel Benefits
		</button>
		</a>
		
      </li>
	  
	  
    </ul>
	
    <form class="form-inline my-2 my-lg-0" method="POST" action="index.php?o=gas">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search_input">
	  
      <button class="btn btn-outline-success my-2 my-sm-0" name="search_btn" type="submit">Search</button>
    </form>
  </div>
</nav>	
	<!-- NAVBAR -->
	
	</div>

</div>


 <!-- BALANCE and TOTAL Allotment -->


<div class="row">
		<table class="table">
		<thead class="thead-dark">
			<tr>
			  <th class="th-sm">
			  Balance
			  </th>
			  <td>
			  <b>&#8369; <?php echo number_format($agency_budget,2); ?> </b>
			  </td>
			  <th class="th-sm">
			  Total Allotment
			  </th>
			  <td>
			  <b>&#8369; <?php echo number_format($allotment,2); ?></b></td>

			</tr>
		</thead>
		</table>
	
</div>

<div class="row">
<div class="col-md-9">

<div class="row">
<!-- TABLE FOR GAS PROGRAMS -->

<?php 
if($agency_num == 1 && $sub_agency==1){ //General Administration and Support BUTTON
?>

<table class="table table-sm" cellspacing="0">

	<thead class="thead-dark">
		<tr>
		  <th colspan=8>
		  
	<div class="d-flex justify-content-between">
		
		  <h4 class="align-self-center">General Administration and Support</h4>
		  
		
		
			<a class="nav-link" href="#" data-toggle="modal" data-target="#gas_add_modal" style="float: right;">
				<button class="btn btn-primary btn-lg" style="text-decoration: none;">+ADD PROGRAM</button>
			</a>
		
	</div>
		  
		  </th>

		</tr>
	</thead>
</table>

<table class="table table-bordered table-sm table-hover" cellspacing="0">

	  <thead class="thead-light">
		<tr>
			<th>Program</th>
		  <th>Project</th>
		  <th>UACS</th>
		  <th>RC</th>
		  <th>Allotment</th>
		  <th>Class Category</th>
		  <th>Budget</th>
		  <th>Action</th>
		</tr>
	  </thead>
	  
	  <tbody>
	  
	  <?php 
	  
	  //PROGRAM
		$sql_program_gas = "SELECT * FROM specific_budget INNER JOIN program ON specific_budget.program_id = program.program_id INNER JOIN chart_of_accounts ON chart_of_accounts.chart_account_id = specific_budget.uacs_id WHERE specific_budget.program_id=1 ORDER BY specific_budget_id DESC";
		$result_program_gas = $connect->query($sql_program_gas);
	  
		if ($result_program_gas->num_rows > 0) {
			// output data of each row
			while($row_program_gas = $result_program_gas->fetch_assoc()) {
				
			?>
			<tr>
			<td><?php echo $row_program_gas['program_accronym'];?></td>
			<td><?php echo $row_program_gas['project'];?></td>
			<td><?php echo $row_program_gas['chart_account_title'];?></td>
			<td><?php echo $row_program_gas['responsibility_center'];?></td>
			<td><?php 
				if($row_program_gas['allotment']==0){ echo "GAA"; }
				else if($row_program_gas['allotment']>=1){ echo "SAA ".$row_program_gas['allotment']; }
			?></td>
			<td><?php echo $row_program_gas['class_category'];?></td>
			<td>&#8369; <?php echo number_format($row_program_gas['specific_budget_amount'],2);?></td>
		  
			<td>
		  
			<a href="#" data-toggle="modal" data-target="#gas_delete_modal<?php echo $row_program_gas['specific_budget_id'];?>">DELETE</a> 
			
			|
			
			<a href="#" data-toggle="modal" data-target="#gas_edit_modal<?php echo $row_program_gas['specific_budget_id'];?>">EDIT</a>
			</td>
			</tr>
			
			<!-- EDIT Modal -->
			<div class="modal fade" id="gas_edit_modal<?php echo $row_program_gas['specific_budget_id'];?>" tabindex="-1" aria-labelledby="gas_edit_modal" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="gas_edit_modal">Edit Project</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  
				  
				   <form action="update_function.php" method="POST">
				  
				   <?php include "gas_edit.php"; ?>
				   
				   <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-primary" name="update_btn">Save Changes</button>
				  </div>
				</form>
				  
				</div>
			  </div>
			</div>
			
			<!-- DELETE Modal -->
				<div class="modal fade" id="gas_delete_modal<?php echo $row_program_gas['specific_budget_id'];?>" tabindex="-1" aria-labelledby="gas_delete_modal" aria-hidden="true">
				  <div class="modal-dialog">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="gas_delete_modal">Confirm Delete</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
					  
					  Are you sure you want to delete 
					  <b><?php echo $row_program_gas['project'];?></b> Project?
					   
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						<a href="php_actions/gas_delete_function.php?id=<?php echo $row_program_gas['specific_budget_id'];?>">
						<button type="button" class="btn btn-primary" name="add_btn">Confirm</button></a>
					  </div>
					  
					</div>
				  </div>
				</div>
<?php		}
		}
		
	}
	else if($agency_num == 1 && $sub_agency==2){ // Administration of Personnel Benefits BUTTON
?>

<table class="table table-sm" cellspacing="0">

	<thead class="thead-dark">
		<tr>
		  <th colspan=8>
		  
	<div class="d-flex justify-content-between">
		
		  <h4 class="align-self-center">Administration of Personnel Benefits</h4>
		  
		
		
			<a class="nav-link" href="#" data-toggle="modal" data-target="#gas_add_modal" style="float: right;">
				<button class="btn btn-primary btn-lg" style="text-decoration: none;">+ADD PROGRAM</button>
			</a>
		
	</div>
		  
		  </th>

		</tr>
	</thead>
</table>

<table class="table table-bordered table-sm table-hover" cellspacing="0">

	  <thead class="thead-light">
		<tr>
			<th>Program</th>
		  <th>Project</th>
		  <th>UACS</th>
		  <th>RC</th>
		  <th>Allotment</th>
		  <th>Class Category</th>
		  <th>Budget</th>
		  <th>Action</th>
		</tr>
	  </thead>
	  
	  <tbody>
	  
	  <?php 
	  
	  //PROGRAM
		$sql_program_gas = "SELECT * FROM specific_budget INNER JOIN program ON specific_budget.program_id = program.program_id INNER JOIN chart_of_accounts ON chart_of_accounts.chart_account_id = specific_budget.uacs_id WHERE specific_budget.program_id=2 ORDER BY specific_budget_id DESC";
		$result_program_gas = $connect->query($sql_program_gas);
	  
		if ($result_program_gas->num_rows > 0) {
			// output data of each row
			while($row_program_gas = $result_program_gas->fetch_assoc()) {
				
			?>
			<tr>
			<td><?php echo $row_program_gas['program_accronym'];?></td>
			<td><?php echo $row_program_gas['project'];?></td>
			<td><?php echo $row_program_gas['chart_account_title'];?></td>
			<td><?php echo $row_program_gas['responsibility_center'];?></td>
			<td><?php 
				if($row_program_gas['allotment']==0){ echo "GAA"; }
				else if($row_program_gas['allotment']>=1){ echo "SAA ".$row_program_gas['allotment']; }
			?></td>
			<td><?php echo $row_program_gas['class_category'];?></td>
			<td>&#8369; <?php echo number_format($row_program_gas['specific_budget_amount'],2);?></td>
		  
			<td>
		  
			<a href="#" data-toggle="modal" data-target="#gas_delete_modal<?php echo $row_program_gas['specific_budget_id'];?>">DELETE</a> 
			
			|
			
			<a href="#" data-toggle="modal" data-target="#gas_edit_modal<?php echo $row_program_gas['specific_budget_id'];?>">EDIT</a>
			</td>
			</tr>
			
			<!-- EDIT Modal -->
			<div class="modal fade" id="gas_edit_modal<?php echo $row_program_gas['specific_budget_id'];?>" tabindex="-1" aria-labelledby="gas_edit_modal" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="gas_edit_modal">Edit Project</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  
				  
				   <form action="update_function.php" method="POST">
				  
				   <?php include "gas_edit.php"; ?>
				   
				   <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-primary" name="update_btn">Save Changes</button>
				  </div>
				</form>
				  
				</div>
			  </div>
			</div>
			
			<!-- DELETE Modal -->
				<div class="modal fade" id="gas_delete_modal<?php echo $row_program_gas['specific_budget_id'];?>" tabindex="-1" aria-labelledby="gas_delete_modal" aria-hidden="true">
				  <div class="modal-dialog">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="gas_delete_modal">Confirm Delete</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
					  
					  Are you sure you want to delete 
					  <b><?php echo $row_program_gas['project'];?></b> Project?
					   
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						<a href="php_actions/gas_delete_function.php?id=<?php echo $row_program_gas['specific_budget_id'];?>">
						<button type="button" class="btn btn-primary" name="add_btn">Confirm</button></a>
					  </div>
					  
					</div>
				  </div>
				</div>
	
		
<?php
			}
		}
	}
	
	else if($agency_num == 1 && $sub_agency==3){//ALL PROGRAM BUTTON
	?>
	
	<table class="table table-sm" cellspacing="0">

	<thead class="thead-dark">
		<tr>
		  <th colspan=8>
		  
	<div class="d-flex justify-content-between">
		
		  <h4 class="align-self-center">ALL PROGRAMS</h4>
		  
		
		
			<a class="nav-link" href="#" data-toggle="modal" data-target="#gas_add_modal" style="float: right;">
				<button class="btn btn-primary btn-lg" style="text-decoration: none;">+ADD PROGRAM</button>
			</a>
		
	</div>
		  
		  </th>

		</tr>
	</thead>
</table>
	
	<table class="table table-bordered table-sm table-hover" cellspacing="0">
	
	  <thead class="thead-light">
		<tr>
			<th>Program</th>
		  <th>Project</th>
		  <th>UACS</th>
		  <th>RC</th>
		  <th>Allotment</th>
		  <th>Class Category</th>
		  <th>Budget</th>
		  <th>Action</th>
		</tr>
	  </thead>
	  
	  <tbody>
	  
	  <?php 
	  
	  //PROGRAM
		$sql_program_gas = "SELECT * FROM specific_budget INNER JOIN program ON specific_budget.program_id = program.program_id INNER JOIN chart_of_accounts ON chart_of_accounts.chart_account_id = specific_budget.uacs_id WHERE specific_budget.agency_id=1 ORDER BY specific_budget_id DESC";
		$result_program_gas = $connect->query($sql_program_gas);
	  
		if ($result_program_gas->num_rows > 0) {
			// output data of each row
			while($row_program_gas = $result_program_gas->fetch_assoc()) {
				
			?>
			<tr>
			<td><?php echo $row_program_gas['program_accronym'];?></td>
			<td><?php echo $row_program_gas['project'];?></td>
			<td><?php echo $row_program_gas['chart_account_title'];?></td>
			<td><?php $row_program_gas['responsibility_center']; ?></td>
			<td><?php 
				if($row_program_gas['allotment']==0){ echo "GAA"; }
				else if($row_program_gas['allotment']>=1){ echo "SAA ".$row_program_gas['allotment']; }
			?></td>
			<td><?php echo $row_program_gas['class_category'];?></td>
			<td>&#8369; <?php echo number_format($row_program_gas['specific_budget_amount'],2);?></td>
		  
			<td>
		  
			<a href="#" data-toggle="modal" data-target="#gas_delete_modal<?php echo $row_program_gas['specific_budget_id'];?>">DELETE</a> 
			
			|
			
			<a href="#" data-toggle="modal" data-target="#gas_edit_modal<?php echo $row_program_gas['specific_budget_id'];?>">EDIT</a>
			</td>
			</tr>
			
			<!-- EDIT Modal -->
			<div class="modal fade" id="gas_edit_modal<?php echo $row_program_gas['specific_budget_id'];?>" tabindex="-1" aria-labelledby="gas_edit_modal" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="gas_edit_modal">Edit Project</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  
				  
				   <form action="update_function.php" method="POST">
				  
				   <?php include "gas_edit.php"; ?>
				   
				   <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-primary" name="update_btn">Save Changes</button>
				  </div>
				</form>
				  
				</div>
			  </div>
			</div>
			
			<!-- DELETE Modal -->
				<div class="modal fade" id="gas_delete_modal<?php echo $row_program_gas['specific_budget_id'];?>" tabindex="-1" aria-labelledby="gas_delete_modal" aria-hidden="true">
				  <div class="modal-dialog">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="gas_delete_modal">Confirm Delete</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
					  
					  Are you sure you want to delete 
					  <b><?php echo $row_program_gas['project'];?></b> Project?
					   
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						<a href="php_actions/gas_delete_function.php?id=<?php echo $row_program_gas['specific_budget_id'];?>">
						<button type="button" class="btn btn-primary" name="add_btn">Confirm</button></a>
					  </div>
					  
					</div>
				  </div>
				</div>
	
		
	<?php
			}
		}
	
	}
	
	else if($issearch == true && $search != ""){
	?>
	
	<table class="table table-bordered table-sm table-hover" cellspacing="0">

	<thead class="thead-dark">
		<tr>
		  <th colspan=8>
		  <h4>SEARCH: ' <b><?php echo $search;?></b> ' </h4>
		  </th>

		</tr>
	</thead>


	  <thead class="thead-light">
		<tr>
			<th>Program</th>
		  <th>Project</th>
		  <th>UACS</th>
		  <th>RC</th>
		  <th>Allotment</th>
		  <th>Class Category</th>
		  <th>Budget</th>
		  <th>Action</th>
		</tr>
	  </thead>
	  
	  <tbody>
	  
	  <?php 
	  
	  //PROGRAM
		$sql_program_gas = "SELECT * FROM specific_budget INNER JOIN program ON specific_budget.program_id = program.program_id INNER JOIN chart_of_accounts ON chart_of_accounts.chart_account_id = specific_budget.uacs_id WHERE project LIKE '%".$search."%' AND specific_budget.agency_id=1 ORDER BY specific_budget_id DESC";
		
		//specific_budget.program_id=1 OR specific_budget.program_id=2 AND 
		$result_program_gas = $connect->query($sql_program_gas);
	  
		if ($result_program_gas->num_rows > 0) {
			// output data of each row
			while($row_program_gas = $result_program_gas->fetch_assoc()) {
				
			?>
			<tr>
			<td><?php echo $row_program_gas['program_accronym'];?></td>
			<td><?php echo $row_program_gas['project'];?></td>
			<td><?php echo $row_program_gas['chart_account_title'];?></td>
			<td><?php echo $row_program_gas['responsibility_center'];?></td>
			<td><?php 
				if($row_program_gas['allotment']==0){ echo "GAA"; }
				else if($row_program_gas['allotment']>=1){ echo "SAA ".$row_program_gas['allotment']; }
			?></td>
			<td><?php echo $row_program_gas['class_category'];?></td>
			<td>&#8369; <?php echo number_format($row_program_gas['specific_budget_amount'],2);?></td>
		  
			<td>
		  
			<a href="#" data-toggle="modal" data-target="#gas_delete_modal<?php echo $row_program_gas['specific_budget_id'];?>">DELETE</a> 
			
			|
			
			<a href="#" data-toggle="modal" data-target="#gas_edit_modal<?php echo $row_program_gas['specific_budget_id'];?>">EDIT</a>
			</td>
			</tr>
			
			<!-- EDIT Modal -->
			<div class="modal fade" id="gas_edit_modal<?php echo $row_program_gas['specific_budget_id'];?>" tabindex="-1" aria-labelledby="gas_edit_modal" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="gas_edit_modal">Edit Project</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  
				  
				   <form action="update_function.php" method="POST">
				  
				   <?php include "gas_edit.php"; ?>
				   
				   <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-primary" name="update_btn">Save Changes</button>
				  </div>
				</form>
				  
				</div>
			  </div>
			</div>
			
			<!-- DELETE Modal -->
				<div class="modal fade" id="gas_delete_modal<?php echo $row_program_gas['specific_budget_id'];?>" tabindex="-1" aria-labelledby="gas_delete_modal" aria-hidden="true">
				  <div class="modal-dialog">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="gas_delete_modal">Confirm Delete</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
					  
					  Are you sure you want to delete 
					  <b><?php echo $row_program_gas['project'];?></b> Project?
					   
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						<a href="php_actions/gas_delete_function.php?id=<?php echo $row_program_gas['specific_budget_id'];?>">
						<button type="button" class="btn btn-primary" name="add_btn">Confirm</button></a>
					  </div>
					  
					</div>
				  </div>
				</div>
	
		
	<?php
			}
		}
	}
		
	else{ 
	
	?>
<table class="table table-sm" cellspacing="0">

	<thead class="thead-dark">
		<tr>
		  <th colspan=8>
		  
	<div class="d-flex justify-content-between">
		
		  <h4 class="align-self-center">ALL PROGRAMS</h4>
		  
		
		
			<a class="nav-link" href="#" data-toggle="modal" data-target="#gas_add_modal" style="float: right;">
				<button class="btn btn-primary btn-lg" style="text-decoration: none;">+ADD PROGRAM</button>
			</a>
		
	</div>
		  
		  </th>

		</tr>
	</thead>
</table>
	
	
	<table class="table table-bordered table-sm table-hover" cellspacing="0">

	  <thead class="thead-light">
		<tr>
			<th>Program</th>
		  <th>Project</a></th>
		  <th>UACS</th>
		  <th>RC</th>
		  <th>Allotment</th>
		  <th>Class Category</th>
		  <th>Budget</th>
		  <th>Action</th>
		</tr>
	  </thead>
	  
	  <tbody>
	  
	  <?php 
	  
	  //PROGRAM
	  
	  $sql_program_gas = "SELECT * FROM specific_budget INNER JOIN program ON specific_budget.program_id = program.program_id INNER JOIN chart_of_accounts ON chart_of_accounts.chart_account_id = specific_budget.uacs_id WHERE specific_budget.program_id=1 OR specific_budget.program_id=2 ORDER BY specific_budget_id DESC";
	  
		$result_program_gas = $connect->query($sql_program_gas);
	  
		if ($result_program_gas->num_rows > 0) {
			// output data of each row
			while($row_program_gas = $result_program_gas->fetch_assoc()) {
				
			?>
			<tr>
			<td><?php echo $row_program_gas['program_accronym'];?></td>
			<td><?php echo $row_program_gas['project'];?></td>
			<td><?php echo $row_program_gas['chart_account_title'];?></td>
			<td><?php echo $row_program_gas['responsibility_center'];?></td>
			<td><?php 
				if($row_program_gas['allotment']==0){ echo "GAA"; }
				else if($row_program_gas['allotment']>=1){ echo "SAA ".$row_program_gas['allotment']; }
			?></td>
			<td><?php echo $row_program_gas['class_category'];?></td>
			<td>&#8369; <?php echo number_format($row_program_gas['specific_budget_amount'],2);?></td>
		  
			<td>
		  
			<a href="#" data-toggle="modal" data-target="#gas_delete_modal<?php echo $row_program_gas['specific_budget_id'];?>">DELETE</a> 
			
			|
			
			<a href="#" data-toggle="modal" data-target="#gas_edit_modal<?php echo $row_program_gas['specific_budget_id'];?>">EDIT</a>
			</td>
			</tr>
			
			<!-- EDIT Modal -->
			<div class="modal fade" id="gas_edit_modal<?php echo $row_program_gas['specific_budget_id'];?>" tabindex="-1" aria-labelledby="gas_edit_modal" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="gas_edit_modal">Edit Project</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  
				  
				   <form action="update_function.php" method="POST">
				  
				   <?php include "gas_edit.php"; ?>
				   
				   <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-primary" name="update_btn">Save Changes</button>
				  </div>
				</form>
				  
				</div>
			  </div>
			</div>
			
			<!-- DELETE Modal -->
				<div class="modal fade" id="gas_delete_modal<?php echo $row_program_gas['specific_budget_id'];?>" tabindex="-1" aria-labelledby="gas_delete_modal" aria-hidden="true">
				  <div class="modal-dialog">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="gas_delete_modal">Confirm Delete</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
					  
					  Are you sure you want to delete 
					  <b><?php echo $row_program_gas['project'];?></b> Project?
					   
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						<a href="php_actions/gas_delete_function.php?id=<?php echo $row_program_gas['specific_budget_id'];?>">
						<button type="button" class="btn btn-primary" name="add_btn">Confirm</button></a>
					  </div>
					  
					</div>
				  </div>
				</div>
	
	
	

	<?php
			}
		}
	}
	  
	  ?>
  
	  </tbody>
	  
</table>

</div>
</div>

<div class="col-md-3">

<table class="table table-bordered table-sm table-hover" cellspacing="0">
	<thead class="thead-dark">
		<tr style="height: 75px;">
		<th><center><h3>UACS Allotment<center></h3>
		
		</th>
		</tr>
	</thead>

</table>

<table class="table table-bordered table-sm table-hover">
	<thead class="thead-light">
		<tr>
		<th>UACS</th>
		<th>Total Allotment</th>
		</tr>
	</thead>
	
	<tbody>

	
	<?php
	
	$sql_uacs = "SELECT * FROM chart_of_accounts";
	$result_uacs = $connect->query($sql_uacs);
	
	if ($result_uacs->num_rows > 0) {
			// output data of each row
			while($row_uacs = $result_uacs->fetch_assoc()) {
				
				$total_budget_allotment=0;
				
				$sql_program = "SELECT * FROM specific_budget WHERE agency_id=".$agency_num." AND uacs_id=".$row_uacs['chart_account_id'];
				$result_program = $connect->query($sql_program);
				
				if ($result_program->num_rows > 0) {
					while($row_program = $result_program->fetch_assoc()) {
						$total_budget_allotment+=$row_program['specific_budget_amount'];
					}
					
						echo "<tr><td>";
						echo $row_uacs['chart_account_title'];
						echo "</td>";
						echo "<td>";
						echo "&#8369; ".number_format($total_budget_allotment,2);
						echo "</td></tr>";
				}	
			}
	}
	
	$connect->close();
	?>
	
	
	
	</tbody>

</table>

</div>

</div><!-- END ROW -->


</div><!-- END container-fluid -->