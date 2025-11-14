<?php 
if(isset($_POST['add_dv_btn'])){
	include "database_connect.php";
	
$status="Pending";
$ors_id = $_POST['ors_id'];
$dv_number = $_POST['serial_number'];
$payment_method=$_POST['payment_method'];
$payment_method_uacs="";
$tax_id=$_POST['tax'];
$tax_percent=0;
$tax_uacs="";
$card_number="";
$card_name="";
$bank_name="";
$date_added=date("m/d/Y");
$date_input=$_POST['date'];
$total_dv_amount_gross=0;
$total_dv_amount_tax=0;

$nvat=0;
$payment_method_uacs_title="";
$tax_uacs_title="";

	//TOTAL DV AMOUNT CALCUTATION (SUM OF ALL PARTICULARS)
	$sql_ors_part= "SELECT * FROM ors_particulars WHERE ors_id=$ors_id";
	$result_ors_part = $connect->query($sql_ors_part);

	if($result_ors_part->num_rows > 0){
			// output data of each row
		while($row_ors_part = $result_ors_part->fetch_assoc()) {
			$total_dv_amount_gross+=$row_ors_part['particulars_amount'];
			$total_dv_amount_tax+=$row_ors_part['particulars_amount'];
		}
	}
	
	//IF MDS Payment Method 
	if($payment_method == "MDS"){
		$payment_method_uacs="10104040-00";
		$card_number="None";
		$card_name="None";
		$bank_name="None";
	}
	else if($payment_method == "ADA"){
		$payment_method_uacs="10104040-01";
		$card_number="";
		$card_name="";
		$bank_name="";
	}
	
	//TAX ID GET VALUE and initialize $tax value
	if($tax_id>=1){ //IF TAX is not zero
		$sql_uacs_bir= "SELECT * FROM uacs_bir WHERE uacs_bir_id=$tax_id";
		$result_uacs_bir = $connect->query($sql_uacs_bir);

		if($result_uacs_bir->num_rows > 0){
				// output data of each row
			while($row_uacs_bir = $result_uacs_bir->fetch_assoc()) {
				$tax=$row_uacs_bir['tax'];
				$tax_uacs_title=$row_uacs_bir['chart_account_title'];
			}
		}
	}
	
	//STATUS CHANGE
	if(isset($_POST['status'])){
		$status="Done";
	}
	
	//IF TAXABLE CALCULATE total_dv_amount with Tax
	if($tax>=1){
		$tax_formula = 1 - ($tax/100);
		$nvat = $total_dv_amount_tax*($tax/100);
		$total_dv_amount_tax = $total_dv_amount_tax * $tax_formula;
	}
	
	
$sql_disbursement = "INSERT INTO disbursement (ors_id, dv_number, payment_method, payment_method_uacs, tax_id ,tax_percent, tax_uacs, card_number, card_name, bank_name, dv_status, dv_date, dv_date_added,dv_amount_gross,dv_amount_tax) VALUES ('$ors_id', '$dv_number', '$payment_method', '$payment_method_uacs', '$tax_id','$tax_percent', '$tax_uacs', '$card_number', '$card_name', '$bank_name', '$status', '$date_input', '$date_added', '$total_dv_amount_gross', '$total_dv_amount_tax')";

if ($connect->query($sql_disbursement) === TRUE) {
	
			//ACTIVITY
			$time=date('H:i:s');
			$date=date('Y-m-d');
			$activity="Added DV #: ".$dv_number.". Status: ".$status;
			
			$sql_activity_add ="INSERT INTO activity(activity, activity_time, activity_date, action) VALUES('$activity', '$time', '$date','Add')";
			if($connect->query($sql_activity_add)){
				$connect->close();
			  header("Location: ../index.php?o=dv");
			  exit();
			  
			}
			else{
				echo "Something went wrong.";
			}
			//ACTIVITY END
	
}

else {
			echo "Error: " . $sql_disbursement . "<br>" . $connect->error;
}








echo "GROSS: ".$total_dv_amount_gross."<br>";
echo "NVAT ".$tax."% : ".$nvat."<br><br>";

echo "TOTAL DV: ".$total_dv_amount_tax;

?>


<table border=1>

<tr><td>ACCOUNT NAME</td> <td>UACS Code</td> <td>DEBIT</td> <td>CREDIT</td></tr>

<tr>
	<td></td> 
	<td></td>
	<td><?php echo $total_dv_amount_gross;?></td>
	<td></td>
</tr>

<tr>
	<td><?php echo $payment_method;?></td> 
	<td><?php echo $payment_method_uacs;?></td>
	<td></td>
	<td><?php if($tax>=1){echo $total_dv_amount_tax;}?></td>
	
</tr>

<tr>
	<td><?php echo $tax_uacs_title;?></td> 
	<td><?php echo $tax_uacs;?></td>
	<td></td>
	<td><?php if($tax>=1){echo $nvat;}?></td>
	
</tr>

</table>

<?php
}


?>