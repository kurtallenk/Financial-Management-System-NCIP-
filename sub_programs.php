<?php

$clicked=0;
$sub_prog_name="";
if(isset($_GET['c']) && isset($_GET['p'])){
	$clicked=$_GET['c'];
	$sub_prog_name = $_GET['p'];

}

//CONNECT DATABASE

include "php_actions/database_connect.php";

//GET DATA

//AGENCY

$agency_num = 3;

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

$sql_sub_program_operations = "SELECT * FROM sub_program_budget 
INNER JOIN program ON sub_program_budget.program_id = program.program_id 
INNER JOIN sub_program ON sub_program_budget.sub_program_id = sub_program.sub_program_id 
INNER JOIN chart_of_accounts ON chart_of_accounts.chart_account_id = sub_program_budget.uacs_id 
WHERE sub_program_budget.program_id=4 OR sub_program_budget.program_id=5 OR sub_program_budget.program_id=6 ORDER BY sub_program_budget_id  DESC";
$result_sub_program_operations = $connect->query($sql_sub_program_operations);

$sql_allotment = "SELECT SUM(specific_budget_amount) as total_allotment FROM specific_budget WHERE agency_id=$agency_num;";
$result_allotment = $connect->query($sql_allotment);

$allotment=0;

if($result_allotment->num_rows > 0){
	while($row_allotment = $result_allotment->fetch_assoc()) {
		$allotment = $row_allotment['total_allotment'];
	}
	
}

include "php_actions/display_allotment.php";

?>

<div class="container-fluid">

<!-- TITLE and BREADCRAMB Nav -->
<div class="py-3 text-center">
    <div style="font-size:50px;">Operations Sub-Program</div>
	

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?o=programs_budget">Programs and Budget</a></li>
    <li class="breadcrumb-item"><a href="index.php?o=gas">GAS</a></li>
	<li class="breadcrumb-item"><a href="index.php?o=sto">STO</a></li>
	<li class="breadcrumb-item"><a href="index.php?o=operations">OPERATIONS</a></li>
	<li class="breadcrumb-item active" aria-current="page">Operations Sub-Program</li>
  </ol>
</nav>

 </div> 
 
 <!-- BALANCE and TOTAL Allotment -->
 
<div class="row">
	<div class="col-md-12">
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
</div>

<!-- EDIT Modal 
			<div class="modal fade" id="operations_budget_edit_modal" tabindex="-1" aria-labelledby="operations_budget_edit_modal" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="operations_budget_edit_modal">Edit OPERATIONS Budget</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  
				  <form action="php_actions/operations_budget_update_function.php" method="POST">
				  <div class="modal-body">
				   <div class="col-md-6 mb-3">
            <label for="project">Enter New Budget</label>
            <input type="text" class="form-control" name="budget" id="budget" placeholder="" value="<?php echo $agency_budget;?>">

          </div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-primary" name="update_btn">Save Changes</button>
				  </div>
				  </form>
				  
				</div>
			  </div>
			</div>-->

<!-- GOTO PROGRAMS BUTTON and ADD BUTTON
<div class="row">

<div class="col-md">
<a href="index.php?o=operations" style="text-decoration: none;">
	<button type="button" class="btn btn-outline-primary btn-lg btn-block" style="height: 50px;">Go to Programs</button>
  </a> 

</div>

<div class="col-md" style="float: right;">
	  <a class="nav-link" href="#" data-toggle="modal" data-target="#sub_prog_add_modal" style="float: right;">
				  <h3>+ADD</h3>
	   </a>   
</div>

</div>-->


<!-- TABLE FOR OPERATIONS PROGRAMS -->
<div class="row" id="operations_sub_program_table">


<div class="col-md-8">
<div class="row">

	<div class="col-md-6"><h2>SUB PROGRAMS</h2></div>
	
	<div class="col-md-6">
		<div style="float: right;">
	
		<a class="nav-link" href="#" data-toggle="modal" data-target="#sub_prog_add_modal">
				  <button class="btn btn-primary btn-lg" style="text-decoration: none;">+ADD</button>
	   </a>
	   </div>
	</div>
	
</div>

<div class="tableFixHead border">
<table id="rowClick" class="table table-bordered table-sm table-hover" cellspacing="0"
  width="100%">

	  <thead class="thead-dark" style="height: 50px;">
		<tr>
		<th class="th-sm">Program</th>
		<th class="th-sm">Sub-Program</th>
		  <th class="th-sm">Project</th>
		  <th class="th-sm">UACS</th>
		  <th class="th-sm">Allotment</th>
		  <th class="th-sm">Class Category</th>
		  <th class="th-sm">Action</th>
		</tr>
	  </thead>

	  <tbody>
	  
	  <?php 
	  
		if ($result_sub_program_operations->num_rows > 0) {
			// output data of each row
			while($row_sub_program_operations = $result_sub_program_operations->fetch_assoc()) {
				
			?>
			<tr data-href='#' onclick="showSubProg_RC(<?php echo $row_sub_program_operations['sub_program_budget_id'].",'".$row_sub_program_operations['project']."'";?>)">
			<td><?php echo $row_sub_program_operations['program_accronym'];?></td>
			<td><?php echo $row_sub_program_operations['sub_program_accronym'];?></td>
			<td><?php echo $row_sub_program_operations['project'];?></td>
			<td><?php echo $row_sub_program_operations['chart_account_title'];?></td>

			<td><?php 
				if($row_sub_program_operations['allotment']==0){ echo "GAA"; }
				else if($row_sub_program_operations['allotment']>=1){ echo "SAA ".$row_sub_program_operations['allotment']; }
			?></td>
			<td><?php echo $row_sub_program_operations['class_category'];?></td>
		  
			<td style="">
		  
			<a href="#" data-toggle="modal" data-target="#sub_prog_delete_modal<?php echo $row_sub_program_operations['sub_program_budget_id'];?>">DELETE</a> |
			<a href="#" data-toggle="modal" data-target="#sub_prog_edit_modal<?php echo $row_sub_program_operations['sub_program_budget_id'];?>">EDIT</a>
			</td>
			</tr>
			
			<!-- EDIT Modal -->
			<div class="modal fade" id="sub_prog_edit_modal<?php echo $row_sub_program_operations['sub_program_budget_id'];?>" tabindex="-1" aria-labelledby="sub_prog_edit_modal" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="sub_prog_edit_modal">Edit Project</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  
				  <?php include "sub_program_edit.php"?>
				  
				</div>
			  </div>
			</div>
			
			<!-- DELETE Modal -->
				<div class="modal fade" id="sub_prog_delete_modal<?php echo $row_sub_program_operations['sub_program_budget_id'];?>" tabindex="-1" aria-labelledby="sub_prog_delete_modal" aria-hidden="true">
				  <div class="modal-dialog">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="sub_prog_delete_modal">Confirm Delete</h5>
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
						<a href="php_actions/subprog_delete_function.php?id=<?php echo $row_sub_program_operations['sub_program_budget_id'];?>">
						<button type="button" class="btn btn-primary" name="add_btn">Confirm</button></a>
					  </div>
					  
					</div>
				  </div>
				</div>
<?php		} 
		}
	  
	  ?>
  
	  </tbody>
	  
</table>
</div>

</div>



<div id="rc_table" class="col-md-4">

<?php 
			
			if(isset($_GET['c']) && isset($_GET['p'])){
				include "get_subprogram_rc_isset.php";
			}
			else{
?>
	<div class="row">

		<div class="col-md-8"><h2>RCs</h2></div>
		
		<div class="col-md-4 invisible">
			<div style="float: right;">
			<a class="nav-link" href="#" data-toggle="modal" data-target="#sub_prog_rc_add_modal">
					  <button class="btn btn-primary btn-lg" style="text-decoration: none;">+ADD</button>
		   </a>
		   </div>
		</div>
		
	</div>

	<div class="tableFixHead border">
	<table class="table table-bordered table-sm table-hover" cellspacing="0"
	  width="100%" style="border: 1px solid black;">
	  
	<thead class="thead-dark" style="height: 50px;">
		<tr>
			<th class="th-sm" style="width: 40%">RC</th>
			<th class="th-sm" style="width: 30%">Budget</th>
			<th class="th-sm">Action</th>
		</tr>
	</thead>
		  <tbody>
		  
		  <!---->

		  <tr>
			<td colspan=3><center style="font-size: 15px; color: red;">Select Sub Program</center></td>
		  </tr>

			<!---->
		  
		  </tbody>
	  
	</table>
	</div>
	<?php } ?>
</div>
			

</div>

</div>

<!-- OPERATIONS Modal -->
			<div class="modal fade" id="sub_prog_add_modal" tabindex="-1" aria-labelledby="operations_add_modal" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="sub_prog_add_modal">Add Project to <b>OPERATIONS SUB PROGRAM</b></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  
				  <form action="add_subprog_function.php" method="POST">
				  <div class="modal-body">
				  
				  
				   <?php include "sub_program_add.php"?>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary" name="add_btn">Add Project</button>
				  </div>
				  </form>
				  
				</div>
			  </div>
			</div>
<!-- / OPERATIONS Modal -->

<script>
		function showSubProg_RC(id_val,p_name) {
			//document.write(id_val);
		  if (id_val == "") {
			  
			document.getElementById("rc_table").innerHTML = "";
			return;
		  } else {
			var xmlhttp = new XMLHttpRequest();
			var handleRequestStateChange = function() {
			  if (this.readyState == 4 && this.status == 200) {
				document.getElementById("rc_table").innerHTML = this.responseText;
			  }
			};
			
			xmlhttp.open("GET","addon/get_subprogram_rc.php?q="+id_val+"&p="+p_name,true);
			xmlhttp.onreadystatechange = handleRequestStateChange;
			xmlhttp.send();
		  }
		}
  </script>