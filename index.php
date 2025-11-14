<?php 
include "includes/header.php";
include "php_actions/database_connect.php";


$name="";
$username="";
$position="";
$auth_id="";
//CHECK COOKIES
if(count($_COOKIE) > 0) {
	if(isset($_COOKIE['user'])) {
		$user_id = $_COOKIE['user'];
		
		$sql_user = "SELECT * FROM user WHERE user_id='$user_id';";
		$result_user = $connect->query($sql_user);
		if($result_user -> num_rows > 0){
			while($row_user = $result_user->fetch_assoc()){
				$username = $row_user['username'];
				$position = $row_user['position'];
				$name = $row_user['name'];
				$auth_id=$row_user['authorization_id'];
			}
		}
	}
	else{ 
		header('Location: login_page.php'); 
		exit; 
	}  
}
else {
	header('Location: login_page.php');
	exit;
}


//AGENCY
$sql_agency_budget = "SELECT SUM(agency_budget) AS budget_sum FROM agency";
$result_agency_budget = $connect->query($sql_agency_budget);

$agency_budget=0;//BUDGET

if ($result_agency_budget->num_rows > 0) {
			// output data of each row
			while($row_agency_budget = $result_agency_budget->fetch_assoc()) {
				$agency_budget = $row_agency_budget['budget_sum'];
			}
}
?>

    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#"><center>NCIP-CAR</center></a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <ul class="navbar-nav px-3"> 
  
	<li class="nav-item text-nowrap">
		<a href="#"><?php 
			//CHECK COOKIES
			if(count($_COOKIE) > 0) {
			  echo $name." [".$position."]";
			} else {
			  echo "Cookies are disabled.";
			}
		?>
	</li>
    <li class="nav-item text-nowrap">
		
      <a class="nav-link" href="sign_out.php">Sign out</a>
    </li>
  </ul>
</nav>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="sidebar-sticky pt-3">
	  
		<img class="d-block mx-auto mb-4" src="_images/ncip_logo1.png" alt="" width="150" height="150">
		
		<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          
		  <table class="table">
		  
			<thead><tr><td style="text-align:center">
				<b>Overall Balance</b>
			</td></tr></thead>
			<tbody><tr><td style="text-align:center" class="user-select-all">
				&#8369; <?php echo number_format($agency_budget,2); ?>
			</td></tr></tbody>
		  
		  </table>
		  
          <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
            
          </a>
        </h6>
	  
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link <?php isActive('home'); ?>" href="index.php?o=home">
              <span data-feather="home"></span>
              NCIP Dashboard <span class="sr-only">(current)</span>
            </a>
          </li>
		  <?php 
		  if($auth_id==1 || $auth_id==2){
		  ?>
		  <li class="nav-item">
            <a class="nav-link <?php isActive('programs_budget'); ?>" href="index.php?o=programs_budget">
              <span data-feather="trello"></span>
              Programs
            </a>
          </li>
		  <li class="nav-item">
            <a class="nav-link <?php isActive('sub_programs'); ?>" href="index.php?o=sub_programs">
              <span data-feather="trello"></span>
              Sub-Programs
            </a>
          </li>
		  <li class="nav-item">
            <a class="nav-link <?php isActive('sub_allotment'); ?>" href="index.php?o=sub_allotment">
              <span data-feather="git-pull-request"></span>
              Sub-Allotment
            </a>
          </li>
		  <?php } 
		  if($auth_id==1 || $auth_id==3){
		  ?>
		  
          <li class="nav-item">
            <a class="nav-link <?php isActive('ors'); ?>" href="index.php?o=ors">
              <span data-feather="git-pull-request"></span>
              ORS
            </a>
          </li>
		  
		  <li class="nav-item">
            <a class="nav-link <?php isActive('dv'); ?>" href="index.php?o=dv">
              <span data-feather="git-pull-request"></span>
              DV
            </a>
          </li>
          <?php } ?>
          <li class="nav-item invisible">
            <a class="nav-link" href="#">
              <span data-feather="bar-chart-2"></span>
              Reports
            </a>
          </li>

        </ul>
		
		<?php if($auth_id==1 || $auth_id==2){ 
		?>
		<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Add Projects</span>
          <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
            
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="modal" data-target="#gas_add_modal">
              <span data-feather="plus-circle"></span>
              GAS
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="modal" data-target="#sto_add_modal">
              <span data-feather="plus-circle"></span>
              STO
            </a>
          </li>
		  <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="modal" data-target="#operations_add_modal">
              <span data-feather="plus-circle"></span>
              OPERATIONS
            </a>
          </li>
        </ul>
		<?php }
		if($auth_id==1 || $auth_id==3){
		?>
		<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Add ORS / DV</span>
          <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
            
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="modal" data-target="#ors_add_modal">
              <span data-feather="file-text"></span>
              Add ORS
            </a>
          </li>
          <li class="nav-item"> 
            <a class="nav-link" href="#" data-toggle="modal" data-target="#dv_add_modal">
              <span data-feather="file-text"></span>
              Add DV
            </a>
          </li>

        </ul>
		<?php } ?>
        
      </div>
    </nav>
<!-- CONTENT -->
<main id="main_page" role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">

<?php
if(isset($_GET['o'])){
	if($_GET['o'] == 'home') {
	
		include 'home.php';
	}
	else if($_GET['o'] == 'programs_budget') {
	
		include 'programs_budget.php';
	}
	
	else if($_GET['o'] == 'sub_programs') {
	
		include 'sub_programs.php';
	}
	
	else if($_GET['o'] == 'gas') {
	
		include 'gas.php';
	}
	
	else if($_GET['o'] == 'sub_allotment') {
	
		include 'sub_allotment.php';
	}
	
	else if($_GET['o'] == 'gas_add') {
	
		include 'gas_add.php';
	}
	
	else if($_GET['o'] == 'sto') {
	
		include 'sto.php';
	}
	
	else if($_GET['o'] == 'operations') {
	
		include 'operations.php';
	}
	
	else if($_GET['o'] == 'ors') {
	
		include 'ors.php';
	}
	
	else if($_GET['o'] == 'dv') {
	
		include 'dv.php';
	}
	else if($_GET['o'] == 'dv_print_view') {
	
		include 'dv_print_view.php';
	}
	
	else if($_GET['o'] == 'ors_particulars') {
	
		include 'ors_particulars.php';
	}
	
	else if($_GET['o'] == 'ors_add') {
	
		include 'ors_add.php';
	}
	
	else if($_GET['o'] == 'dv_add') {
	
		include 'dv_add.php';
	}
	else{
		include 'home.php';
	}
}

else{
include 'home.php';

}
?>


</main>
<!-- CONTENT -->
  
  </div>
</div>
<?php 

include "includes/footer.php";


function isActive($menu_name){
	if(isset($_GET['o'])){ 
		if($menu_name==$_GET['o']){
			echo "active";
		}
	} 
}
?>

<!-- GAS Modal -->
			<div class="modal fade" id="gas_add_modal" tabindex="-1" aria-labelledby="gas_add_modal" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="gas_add_modal">Add Project to <b>GAS</b></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  
				  <form action="add_function.php" method="POST">
				  <div class="modal-body">
				  <input type="hidden" value="1" name="id">
				   <?php include "gas_add.php"?>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary" name="add_btn">Add Project</button>
				  </div>
				  </form>
				  
				</div>
			  </div>
			</div>
			
<!-- STO Modal -->
			<div class="modal fade" id="sto_add_modal" tabindex="-1" aria-labelledby="sto_add_modal" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="sto_add_modal">Add Project to <b>STO</b></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  
				  <form action="add_function.php" method="POST">
				  <div class="modal-body">
				  <input type="hidden" value="2" name="id">
				   <?php include "sto_add.php"?>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary" name="add_btn">Add Project</button>
				  </div>
				  </form>
				  
				</div>
			  </div>
			</div>
			
<!-- OPERATIONS Modal -->
			<div class="modal fade" id="operations_add_modal" tabindex="-1" aria-labelledby="operations_add_modal" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="operations_add_modal">Add Project to <b>OPERATIONS</b></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  
				  <form action="add_function.php" method="POST">
				  <div class="modal-body">
				  
				  <input type="hidden" value="3" name="id">
				   <?php include "operations_add.php"?>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary" name="add_btn">Add Project</button>
				  </div>
				  </form>
				  
				</div>
			  </div>
			</div>
			
			
<!-- ORS Modal -->
			<div class="modal fade" id="ors_add_modal" tabindex="-1" aria-labelledby="ors_add_modal" aria-hidden="true">
			  <div class="modal-dialog modal-sm">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="ors_add_modal">Add ORS</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  
				  <form action="php_actions/ors_add_function.php" method="POST">
				  <div class="modal-body">

				   <?php include "ors_add.php"?>
				  </div>
				  <div class="modal-footer">
					<button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<!-- <button type="button" class="btn btn-primary" name="save_ors_btn">Save Draft</button> -->
					<button type="submit" class="btn btn-primary" name="save_print_ors_btn" id="submit">Add</button>
				  </div>			  
				  </form>
				  
				</div>
			  </div>
			</div>
			
<!-- DV Modal -->
			<div class="modal fade" id="dv_add_modal" tabindex="-1" aria-labelledby="dv_add_modal" aria-hidden="true">
			  <div class="modal-dialog modal-lg">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="dv_add_modal">Add DV</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  
				  <form action="php_actions/dv_add_function.php" method="POST">
				  <div class="modal-body">

				   <?php include "dv_add.php"?>
				  </div>
				  <div class="modal-footer">
					<button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>

					<button type="submit" class="btn btn-primary" name="add_dv_btn" id="submit">Add</button>
				  </div>			  
				  </form>
				  
				</div>
			  </div>
			</div>
