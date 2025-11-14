<?php

//CONNECT DATABASE

include "php_actions/database_connect.php";

//GET DATA
$search = "";
$issearch = false;

if(isset($_POST['search_btn'])){
	$issearch = true;
	$search = $_POST['search_input'];
}

//AGENCY
$agency_num = 3;
$sub_agency = 0;

//SUB AGENCY
if(isset($_GET['a_id'])){
	$sub_agency = $_GET['a_id'];
}

$sql_agency_operations = "SELECT * FROM agency WHERE agency_id=$agency_num";
$result_agency_operations = $connect->query($sql_agency_operations);

$agency_budget=0;//BUDGET

if ($result_agency_operations->num_rows > 0) {
			// output data of each row
			while($row_agency_operations = $result_agency_operations->fetch_assoc()) {
				$agency_budget = $row_agency_operations['agency_budget'];
			}
}

//PROGRAM

$sql_program_operations = "SELECT * FROM specific_budget INNER JOIN program ON specific_budget.program_id = program.program_id INNER JOIN chart_of_accounts ON chart_of_accounts.chart_account_id = specific_budget.uacs_id WHERE specific_budget.program_id=4 OR specific_budget.program_id=5 OR specific_budget.program_id=6 ORDER BY specific_budget_id DESC";
$result_program_operations = $connect->query($sql_program_operations);

include "php_actions/display_allotment.php";

?>

<div class="container-fluid">

<div class="py-3 text-center">
    <div style="font-size:50px;">Operations</div>
	

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?o=programs_budget">Programs and Budget</a></li>
    <li class="breadcrumb-item"><a href="index.php?o=gas">GAS</a></li>
	<li class="breadcrumb-item"><a href="index.php?o=sto">STO</a></li>
	<li class="breadcrumb-item active" aria-current="page">OPERATIONS</li>
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
			<span class="nav-link" style="border-radius: 40px; background-color: black; color: white;"><h4>OPR</h4></span>
		</li>
	
		<li class="nav-item">
        <a class="nav-link" href="index.php?o=operations">
		<button type="button" class="btn <?php if($sub_agency == 0){ echo "btn-info";} else{ echo "btn-outline-info";}?>">
			All OPERATIONS Programs
		</button>
		</a>
		
      </li>
		
      <li class="nav-item">
		<?php include 'includes/operations_btn_1.php'; ?>
		
      </li>
      <li class="nav-item">
        <?php include 'includes/operations_btn_2.php'; ?>
		
      </li>
	  
	  <li class="nav-item">
        <?php include 'includes/operations_btn_3.php'; ?>
		
      </li>
	  
    </ul>
	
    <form class="form-inline my-2 my-lg-0" method="POST" action="index.php?o=operations">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search_input">
	  <center>
      <button class="btn btn-outline-success my-2 my-sm-0" name="search_btn" type="submit">Search</button></center>
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
<!-- -->
<div class="row">
<div class="col-md-9">

<div class="row" id="operations_program">
<!-- TABLE FOR OPERATIONS PROGRAMS -->

<?php 
	if($agency_num == 3 && $sub_agency != 0){
?>

<table class="table table-sm" cellspacing="0">

	<thead class="thead-dark">
		<tr>
		  <th colspan=8>
		  
	<div class="d-flex justify-content-between">
		
		  <h4 class="align-self-center">
		  <?php 
		  if($sub_agency == 4){
			?>
		  PROGRAM I
		  <?php 
		  }
		  else if($sub_agency == 5){
		  ?>
		  PROGRAM II
		  <?php 
		  }
		  else if($sub_agency == 6){
		  ?>
		  PROGRAM III
		  <?php 
		  }
		  ?></h4>
		  
		  <a href="index.php?o=sub_programs" class="align-self-center">
				<button class="btn btn-outline-light btn-lg" style="text-decoration: none;">Go to Sub-Programs</button>
			</a>
		  
		
		<?php if($issearch==false){ ?>
			<a class="nav-link" href="#" data-toggle="modal" data-target="#operations_add_modal" style="float: right;">
				<button class="btn btn-primary btn-lg" style="text-decoration: none;">+ADD PROGRAM</button>
			</a>
		<?php } ?>
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
	  
		$sql_program_operations = "SELECT * FROM specific_budget 
		INNER JOIN program ON specific_budget.program_id = program.program_id 
		INNER JOIN chart_of_accounts ON chart_of_accounts.chart_account_id = specific_budget.uacs_id
		WHERE specific_budget.program_id=$sub_agency ORDER BY specific_budget_id DESC";
		$result_program_operations = $connect->query($sql_program_operations);
	  
	  
		if ($result_program_operations->num_rows > 0) {
			// output data of each row
			while($row_program_operations = $result_program_operations->fetch_assoc()) {
				
			?>
			<tr>
			<td><?php echo $row_program_operations['program_accronym'];?></td>
			<td><?php echo $row_program_operations['project'];?></td>
			<td><?php echo $row_program_operations['chart_account_title'];?></td>
			<td><?php echo $row_program_operations['responsibility_center'];?></td>
			<td><?php 
				if($row_program_operations['allotment']==0){ echo "GAA"; }
				else if($row_program_operations['allotment']>=1){ echo "SAA ".$row_program_operations['allotment']; }
			?></td>
			<td><?php echo $row_program_operations['class_category'];?></td>
			<td>&#8369; <?php echo number_format($row_program_operations['specific_budget_amount'],2);?></td>
		  
			<td style="">
		  
			<a href="#" data-toggle="modal" data-target="#operations_delete_modal<?php echo $row_program_operations['specific_budget_id'];?>">DELETE</a> |
			<a href="#" data-toggle="modal" data-target="#operations_edit_modal<?php echo $row_program_operations['specific_budget_id'];?>">EDIT</a>
			</td>
			</tr>
			
			<!-- EDIT Modal -->
			<div class="modal fade" id="operations_edit_modal<?php echo $row_program_operations['specific_budget_id'];?>" tabindex="-1" aria-labelledby="operations_edit_modal" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="operations_edit_modal">Edit Project</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  
				  <?php include "operations_edit.php"?>
				  
				</div>
			  </div>
			</div>
			
			<!-- DELETE Modal -->
				<div class="modal fade" id="operations_delete_modal<?php echo $row_program_operations['specific_budget_id'];?>" tabindex="-1" aria-labelledby="operations_delete_modal" aria-hidden="true">
				  <div class="modal-dialog">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="operations_delete_modal">Confirm Delete</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
					  
					  Are you sure you want to delete 
					  <b><?php echo $row_program_operations['project'];?></b> Project?
					   
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						<a href="php_actions/operations_delete_function.php?id=<?php echo $row_program_operations['specific_budget_id'];?>">
						<button type="button" class="btn btn-primary" name="add_btn">Confirm</button></a>
					  </div>
					  
					</div>
				  </div>
				</div>
				
<?php		} 
		}
	}
	
	else if($issearch == true && $search != ""){
	?>
	<table class="table table-bordered table-sm table-hover" cellspacing="0">

	<thead class="thead-dark">
		<tr>
		  <th colspan=8>
		  <h4>PROGRAM SEARCH: ' <b><?php echo $search;?></b> ' </h4>
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
	  
		$sql_program_operations = "SELECT * FROM specific_budget 
		INNER JOIN program ON specific_budget.program_id = program.program_id 
		INNER JOIN chart_of_accounts ON chart_of_accounts.chart_account_id = specific_budget.uacs_id
		WHERE project LIKE '%".$search."%' AND specific_budget.agency_id=$agency_num ORDER BY specific_budget_id DESC";
		$result_program_operations = $connect->query($sql_program_operations);

		if ($result_program_operations->num_rows > 0) {
			// output data of each row
			while($row_program_operations = $result_program_operations->fetch_assoc()) {
				
			?>
			<tr>
			<td><?php echo $row_program_operations['program_accronym'];?></td>
			<td><?php echo $row_program_operations['project'];?></td>
			<td><?php echo $row_program_operations['chart_account_title'];?></td>
			<td><?php echo $row_program_operations['responsibility_center'];?></td>
			<td><?php 
				if($row_program_operations['allotment']==0){ echo "GAA"; }
				else if($row_program_operations['allotment']>=1 && $row_program_operations['allotment']<=9998){ echo "SAA ".$row_program_operations['allotment']; }
				else if($row_program_operations['allotment']==9999){ echo "CA"; }
			?></td>
			<td><?php echo $row_program_operations['class_category'];?></td>
			<td>&#8369; <?php echo number_format($row_program_operations['specific_budget_amount'],2);?></td>
		  
			<td style="">
		  
			<a href="#" data-toggle="modal" data-target="#operations_delete_modal<?php echo $row_program_operations['specific_budget_id'];?>">DELETE</a> |
			<a href="#" data-toggle="modal" data-target="#operations_edit_modal<?php echo $row_program_operations['specific_budget_id'];?>">EDIT</a>
			</td>
			</tr>
			
			<!-- EDIT Modal -->
			<div class="modal fade" id="operations_edit_modal<?php echo $row_program_operations['specific_budget_id'];?>" tabindex="-1" aria-labelledby="operations_edit_modal" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="operations_edit_modal">Edit Project</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  
				  <?php include "operations_edit.php"?>
				  
				</div>
			  </div>
			</div>
			
			<!-- DELETE Modal -->
				<div class="modal fade" id="operations_delete_modal<?php echo $row_program_operations['specific_budget_id'];?>" tabindex="-1" aria-labelledby="operations_delete_modal" aria-hidden="true">
				  <div class="modal-dialog">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="operations_delete_modal">Confirm Delete</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
					  
					  Are you sure you want to delete 
					  <b><?php echo $row_program_operations['project'];?></b> Project?
					   
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						<a href="php_actions/operations_delete_function.php?id=<?php echo $row_program_operations['specific_budget_id'];?>">
						<button type="button" class="btn btn-primary" name="add_btn">Confirm</button></a>
					  </div>
					  
					</div>
				  </div>
				</div>
			
	
	<?php
			}
		}
	?>
	</tbody>
</table>
<!-- SUB PROGRAM SEARCH -->
<table class="table table-bordered table-sm table-hover" cellspacing="0">

	<thead class="thead-dark">
		<tr>
		  <th colspan=8>
		  <h4>SUB-PROGRAMS SEARCH: ' <b><?php echo $search;?></b> '</h4>
		  </th>

		</tr>
	  </thead>

	  <thead class="thead-light">
		<tr>
			<th>Sub-Program</th>
		  <th>Project</th>
		  <th>UACS</th>
		  <th>RC</th>
		  <th>Allotment</th>
		  <th>Class Category</th>
		  <th>Budget</th>
		  <th>Action</th>
		</tr>
	  </thead>
	  
	  <tbody id="dataTable">
	  
	  <?php
	  
		$sql_sub_program_operations = "SELECT * FROM sub_program_budget 
INNER JOIN program ON sub_program_budget.program_id = program.program_id 
INNER JOIN sub_program ON sub_program_budget.sub_program_id = sub_program.sub_program_id 
INNER JOIN chart_of_accounts ON chart_of_accounts.chart_account_id = sub_program_budget.uacs_id 
WHERE project LIKE '%".$search."%' AND sub_program_budget.agency_id=$agency_num";
$result_sub_program_operations = $connect->query($sql_sub_program_operations);

		if ($result_sub_program_operations->num_rows > 0) {
			// output data of each row
			while($row_sub_program_operations = $result_sub_program_operations->fetch_assoc()) {
				
			?>
			<tr data-href="index.php?o=sub_programs&c=<?php echo $row_sub_program_operations['sub_program_budget_id'].'&p='.$row_sub_program_operations['project'];?>">
			<td><?php echo $row_sub_program_operations['sub_program_accronym'];?></td>
			<td><?php echo $row_sub_program_operations['project'];?>
				<a href="index.php?o=sub_programs&c=<?php echo $row_sub_program_operations['sub_program_budget_id'].'&p='.$row_sub_program_operations['project'];?>"></a>
			</td>
			<td><?php echo $row_sub_program_operations['chart_account_title'];?></td>
			<td><?php echo $row_sub_program_operations['responsibility_center'];?></td>
			<td><?php 
				if($row_program_operations['allotment']==0){ echo "GAA"; }
				else if($row_program_operations['allotment']>=1){ echo "SAA ".$row_program_operations['allotment']; }
			?></td>
			<td><?php echo $row_sub_program_operations['class_category'];?></td>
			<td>&#8369; <?php echo number_format($row_sub_program_operations['budget'],2);?></td>
		  
			<td style="">
		  
			<a href="#" data-toggle="modal" data-target="#operations_delete_modal<?php echo $row_sub_program_operations['sub_program_budget_id'];?>">DELETE</a> |
			<a href="#" data-toggle="modal" data-target="#operations_edit_modal<?php echo $row_sub_program_operations['sub_program_budget_id'];?>">EDIT</a>
			</td>
			</tr>
			
			<!-- EDIT Modal -->
			<div class="modal fade" id="operations_edit_modal<?php echo $row_sub_program_operations['sub_program_budget_id'];?>" tabindex="-1" aria-labelledby="operations_edit_modal" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="operations_edit_modal">Edit Project</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  
				  <?php include "sub_program_edit.php"?>
				  
				</div>
			  </div>
			</div>
			
			<!-- DELETE Modal -->
				<div class="modal fade" id="operations_delete_modal<?php echo $row_sub_program_operations['sub_program_budget_id'];?>" tabindex="-1" aria-labelledby="operations_delete_modal" aria-hidden="true">
				  <div class="modal-dialog">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="operations_delete_modal">Confirm Delete</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
					  
					  Are you sure you want to delete 
					  <b><?php echo $row_sub_program_operations['project'];?></b> Project?
					   
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						<a href="php_actions/operations_delete_function.php?id=<?php echo $row_sub_program_operations['sub_program_budget_id'];?>">
						<button type="button" class="btn btn-primary" name="add_btn">Confirm</button></a>
					  </div>
					  
					</div>
				  </div>
				</div>
	
	<?php
			}
			}
	}	
	else { // ALL PROGRAMS
	?>
	
	<table class="table table-sm" cellspacing="0">

	<thead class="thead-dark">
		<tr>
		  <th colspan=8>
		  
	<div class="d-flex justify-content-between">
		
		  <h4 class="align-self-center">ALL OPERATIONS PROGRAMS</h4>
		  
		  
		  <a href="index.php?o=sub_programs" class="align-self-center">
				<button class="btn btn-outline-light btn-lg" style="text-decoration: none;">Go to Sub-Programs</button>
			</a>
		
			<a class="nav-link" href="#" data-toggle="modal" data-target="#operations_add_modal" style="float: right;">
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
	  

		if ($result_program_operations->num_rows > 0) {
			// output data of each row
			while($row_program_operations = $result_program_operations->fetch_assoc()) {
				
			?>
			<tr>
			<td><?php echo $row_program_operations['program_accronym'];?></td>
			<td><?php echo $row_program_operations['project'];?></td>
			<td><?php echo $row_program_operations['chart_account_title'];?></td>
			<td><?php echo $row_program_operations['responsibility_center'];?></td>
			<td><?php 
				if($row_program_operations['allotment']==0){ echo "GAA"; }
				else if($row_program_operations['allotment']>=1){ echo "SAA ".$row_program_operations['allotment']; }
			?></td>
			<td><?php echo $row_program_operations['class_category'];?></td>
			<td>&#8369; <?php echo number_format($row_program_operations['specific_budget_amount'],2);?></td>
		  
			<td style="">
		  
			<a href="#" data-toggle="modal" data-target="#operations_delete_modal<?php echo $row_program_operations['specific_budget_id'];?>">DELETE</a> |
			<a href="#" data-toggle="modal" data-target="#operations_edit_modal<?php echo $row_program_operations['specific_budget_id'];?>">EDIT</a>
			</td>
			</tr>
			
			<!-- EDIT Modal -->
			<div class="modal fade" id="operations_edit_modal<?php echo $row_program_operations['specific_budget_id'];?>" tabindex="-1" aria-labelledby="operations_edit_modal" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="operations_edit_modal">Edit Project</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  
				  <?php include "operations_edit.php"?>
				  
				</div>
			  </div>
			</div>
			
			<!-- DELETE Modal -->
				<div class="modal fade" id="operations_delete_modal<?php echo $row_program_operations['specific_budget_id'];?>" tabindex="-1" aria-labelledby="operations_delete_modal" aria-hidden="true">
				  <div class="modal-dialog">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="operations_delete_modal">Confirm Delete</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
					  
					  Are you sure you want to delete 
					  <b><?php echo $row_program_operations['project'];?></b> Project?
					   
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						<a href="php_actions/operations_delete_function.php?id=<?php echo $row_program_operations['specific_budget_id'];?>">
						<button type="button" class="btn btn-primary" name="add_btn">Confirm</button></a>
					  </div>
					  
					</div>
				  </div>
				</div>
<?php		} 
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
	
	
	?>
	
	
	
	</tbody>

</table>


</div>
</div>
</div>
<?php 
$connect->close();
?>