<?php include "php_actions/database_connect.php"; 

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

<div class="container">
  
  <div class="py-3 text-center">
    <h1>Programs and Budget</h1>
	<h4>Overall Remaining Budget: <b>&#8369; <?php echo number_format($agency_budget,2); ?></h4></b>
    <h3>SELECT AGENCY </h3>

  </div>
<!-- CONTENT -->

  
				<div class="d-flex justify-content-between">
					
					<a href="index.php?o=gas" style="text-decoration: none;">
						<button class="btn btn-outline-primary" style="height:300px; width: 300px;"><h1>GAS</h1></button>
					</a>
					
					<a href="index.php?o=sto" style="text-decoration: none;">
						<button class="btn btn-outline-primary" style="height:300px; width: 300px;"><h1>STO</h1></button>
					</a>
					
					<a href="index.php?o=operations" style="text-decoration: none;">
						<button class="btn btn-outline-primary" style="height:300px; width: 300px;"><h1>OPERATIONS</h1></button>
					</a>
					</div>
  
  
  
</div>