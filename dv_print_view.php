<?php
include "php_actions/database_connect.php";

$dv_id = $_GET['q'];

$ors_id=$_GET['p'];
$dv_number="(Blank)";
$payee="(Blank)";
$tin_or_emp_num="(Blank)";
$address="(Blank)";
$tax_title="(Blank)";
$tax_uacs="(Blank)";
$payment_method="(Blank)";
$payment_method_uacs="(Blank)";
$card_number="(Blank)";
$card_name="(Blank)";
$bank_name="(Blank)";
$gross=0;
$nvat=0;
$net=0;
$total_amount=0;

$tax_id=0;
$date="";


		

//DISBURSEMENT
		$sql_disbursement = "SELECT * FROM disbursement INNER JOIN ors ON disbursement.ors_id=ors.ors_id WHERE disbursement.dv_id=".$dv_id;
		$result_disbursement = $connect->query($sql_disbursement);
		
		if ($result_disbursement->num_rows > 0) {
			
			// output data of each row
			while($row_dv = $result_disbursement->fetch_assoc()) {
				
				$payee=$row_dv['payee'];
				//$tin_or_emp_num=$row_dv['tin_emp_num'];
				//$address=$row_dv['address'];
				$tax_uacs=$row_dv['tax_uacs'];
				$payment_method=$row_dv['payment_method'];
				$payment_method_uacs=$row_dv['payment_method_uacs'];
				$card_number=$row_dv['card_number'];
				$card_name=$row_dv['card_name'];
				$bank_name=$row_dv['bank_name'];
				$gross=$row_dv['dv_amount_gross'];
				$nvat=$row_dv['dv_amount_tax'];
				$tax_id=$row_dv['tax_id'];
				$dv_number=$row_dv['dv_number'];
				$date=$row_dv['dv_date'];
			}
		}
//UACS BIR

	if($tax_id>=1){
		$sql_uacs_bir = "SELECT * FROM uacs_bir WHERE uacs_bir_id=".$tax_id;
			$result_uacs_bir = $connect->query($sql_uacs_bir);
			
			if ($result_uacs_bir->num_rows > 0) {
				
				// output data of each row
				while($row_uacs_bir = $result_uacs_bir->fetch_assoc()) {
					$tax_title=$row_uacs_bir['chart_account_title'];
					$tax_uacs=$row_uacs_bir['uacs_number'];
				}
			}

	}
?>

<div id="buttons_row" class="row">

	<a href="index.php?o=dv"><button type="button" class="btn btn-secondary">Back</button></a>

	<a href="javascript:window.print()"><button type="button" class="btn btn-secondary">Print</button></a>
	
	<center class="invisible"> 
		<h1 style="color:red;"> ON PROGRESS</h1>
	</center> 

</div>
<div class="row d-flex justify-content-center">
	<h2> PRINT VIEW </h2>

</div>


<div id="dv_view" class="row" style="padding-left: 50px; padding-right: 50px;">

<table class="table-sm" cellspacing="0" cellpadding="0" border="1">

<!-- TITLE -->
<tr style="text-align:center;">

	<td colspan="6" rowspan="4">
	
		<center>
			<img id="logo" src="_images/ncip_logo1.png" width=100px heigh=100px><br>
		
			Republic of the Philippines<br>
			NATIONAL COMMISION ON INDEGENOUS PEOPLES<br>
			Cordillera Administrative Region<br>
			3rd Flr., Lyman Ogilby Centrum, 358 Magsaysay Ave., Baguio City 2600<br>
			Tel. No. 422-41-73
		</center>
	</td>
</tr>



<tr>
	<td rowspan="1">
	Fund Cluster:<br>
	</td>
</tr>

<tr>
	<td rowspan="1">
	Date:<br> <b><?php echo $date;?></b>
	</td>
</tr>

<tr>
	<td rowspan="1">
	DV #:<br> <b><?php echo $dv_number;?></b>
	</td>
</tr>
<!-- TITLE END-->

<tr style="text-align:center;">
	<td colspan=7>
		<h3>DISBURSEMENT VOUCHER (MDS-REG)</h3>
	</td>
</tr>

<tr style="text-align:center;">
	<td colspan=7>
	<?php $space="&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;";?>
		&#9744; MDS Check 
		
		<?php echo $space.$space.$space;?>
		
		&#9744; Commercial Check 
		
		<?php echo $space.$space.$space;?>
		
		&#9744; ADA 
		
		<?php echo $space.$space.$space;?>
		
		&#9744; Others 
	</td>
</tr>

<tr>
	<th colspan="3">Payee/Office</th>
	<th colspan="3">TIN/Employee No.</th>
	<td colspan="1" rowspan="2"> OR/BUR No.:<br> </td>
</tr>

<tr>
	<td colspan="3"> <h3> <?php echo $payee;?><h3> </td>
	<td colspan="3"> <h3> <?php echo $tin_or_emp_num;?><h3> </td>
</tr>

<tr>
	<th colspan="7">
		<center>
			Address:
		</center>
	</th>
</tr>
<tr>
	<td colspan="7">
		<center>
			<h4> <?php echo $address;?> <h4>
		</center>
	</td>
</tr>

<tr>
	<th colspan="4" style="width: 50%;">Particulars</th>
	<th>Responsibility Center</th>
	<th>MFO/PAP</th>
	<th>AMOUNT</th>
</tr>

<?php 

//DISBURSEMENT
		$sql_particulars = "SELECT * FROM ors_particulars INNER JOIN ors ON ors.ors_id=ors_particulars.ors_id INNER JOIN sub_program ON sub_program.sub_program_id = ors_particulars.sub_program_id WHERE ors_particulars.ors_id=".$ors_id;
		$result_particulars = $connect->query($sql_particulars);
		
		if ($result_particulars->num_rows > 0) {
			
			// output data of each row
			while($row_particulars = $result_particulars->fetch_assoc()) {

?>
		<tr>
			<td colspan="4"><?php echo $row_particulars['project'];?></td>
			<td><?php echo $row_particulars['responsibility_center'];?></td>
			<td><?php echo $row_particulars['sub_program_accronym'];?></td>
			<td><?php echo "&#8369; ".number_format($row_particulars['particulars_amount'],2);?></td>
		</tr>
<?php 		}
		}
?>


<!-- BREAKDOWN & AMOUNT DUE -->
<tr style="text-align:center;">
	<th colspan="4">Breakdown</th>
	<td rowspan=4 ></td>
	<th colspan=1 rowspan=4 style="vertical-align:middle;">Amount Due</th>
	<td rowspan=4 style="vertical-align:middle;"><b>
	<?php if($tax_id>=1){echo "&#8369; ".number_format($nvat,2);}else { echo "&#8369; ".number_format($gross,2); }?>
	</b></td>
</tr>



<!-- BREAKDOWN -->
<tr style="text-align:center;">
	<th colspan=1>Gross</th> <td colspan=3> <?php echo "&#8369; ".number_format($gross,2);?></td>
</tr>
<tr style="text-align:center;"> 
	<th colspan=1>Nvat</th> <td colspan=3><?php echo "&#8369; ".number_format(($gross-$nvat),2);?></td>
</tr>
<tr style="text-align:center;">
	<th colspan=1>NET</th> <td colspan=3>
	
	<?php 
		if($tax_id>=1){
			echo "&#8369; ".number_format($nvat,2);
		}
		else if($tax_id==0){
			echo "&#8369; ".number_format($gross,2);
		}
	?>
	
	</td>
</tr>
</table>

	<div class="invisible">SPACE</div>

<!-- INFO TABLE-->
<table class="table-sm" cellspacing="0" cellpadding="0" border="1">
	<!-- CHIEF ADMIN OFFICER -->
	<tr style="text-align:left;" >
		<td colspan=42>
		<p style="font-size:15px;"><b>
			A. Certified / Cash Advance necessary, lawful and incurred under my direct supervision.
		</b></p>
		</td>
	</tr>

	<tr style="text-align:center;">
		<td colspan=42>
			<br>
			<p style="font-size:25px;"><u><b>
			NORA T. CHULIPA
			</b></u></p>

			<p style="font-size:18px;">CHIEF ADMIN OFFICER</p>

			<p style="font-size:12px;">(Printed Name, Designation and Signature of Supervisor)</p>
		</td>
	</tr>
	<!-- CHIEF ADMIN OFFICER END-->
	
	<!-- ACOUNTING ENTRY -->
	<tr style="text-align:left;">
		<td colspan=42>
		<p style="font-size:15px;"><b>
			B. ACOUNTING ENTRY
		</b></p>
		</td>
	</tr>
	
		<tr style="text-align:center;">
			<th>Account Name</th>
			<th>UACS Code</th>
			<th>Debit</th>
			<th>CREDIT</th>
		</tr>
			<tr style="text-align:center;">
				<td></td>
				<td></td>
				<td><?php echo "&#8369; ".number_format($gross,2);?></td>
				<td></td>
			</tr>
		
			<tr style="text-align:center;">
				<td><?php echo $payment_method;?></td>
				<td><?php echo $payment_method_uacs;?></td>
				<td></td>
				<td><?php if($tax_id>=1){echo "&#8369; ".number_format($nvat,2);}else { echo "&#8369; ".number_format($gross,2); }?></td>
			</tr>
			
			<tr style="text-align:center;">
				<td><?php echo $tax_title;?></td>
				<td><?php echo $tax_uacs;?></td>
				<td></td>
				<td><?php echo "&#8369; ".number_format(($gross-$nvat),2);?></td>
			</tr>
	<!-- ACOUNTING ENTRY END -->
	
	<!-- Certified and Approval -->
	
	<tr style="text-align:left;">
		<td colspan=2 style="width:50%;">
			<p style="font-size:15px;"><b>
				C. Certified
			</b></p>
		</td>
		
		<td colspan=2 style="width:50%;">
			<p style="font-size:15px;"><b>
				D. Approved for Payment
			</b></p>
		</td>
	</tr>
		
		<!--Regional Director and Accountant Details -->
		<tr>
			<td colspan=2 style="width:50%;">
				<p> &#9744; Cash Available </p>
				<p> &#9744; Subject to Authority to Debit Account (When Applicable) </p>
				<p> &#9744; Supporting documents complete and amount claimed proper </p>
			</td>
			
			<td colspan=2 rowspan=3 style="width:50%; text-align:center;">
				
				<p style="font-size:18px;"><u><b>
				ATTY. MARLON P. BOSANTOG
				</b></u></p>

				<p style="font-size:13px;">Regional Director</p>

				<p style="font-size:10px;">Agency Head / Authorized Representative</p>
				
			</td>
			
		</tr>
		
		<tr style="text-align:center;">
			<td colspan=2 style="width:50%;">
			<br><br>
				<p style="font-size:18px;"><u><b>
				JASMIN GAMAY D. LUMIQUED
				</b></u></p>

				<p style="font-size:13px;">Accountant III</p>

				<p style="font-size:10px;">Head, Accounting Unit / Authorized Representative</p>
				
			</td>
			
		</tr>	
	<!-- Regional Director and Accountant Details END -->
	
	
	
</table>

		<div class="invisible">SPACE</div>

<!-- RECEIVED PAYMENTS -->

<table class="table-sm" cellspacing="0" cellpadding="0" border="1">
	<tr style="text-align:left;">
		<td colspan=42>
		<p style="font-size:15px;"><b>
			E. Received Payment
		</b></p>
		</td>
	</tr>
	
		<tr style="text-align:center;">
			<th>Check / ADA #</th>
			<th>Date</th>
			<th>Bank name & Account #</th>
			<th>JEV #</th>
		</tr>
			<tr style="text-align:center;">
				<td>  </td>
				<td>  </td>
				<td> <?php echo $bank_name." - ". $card_number;?> </td>
				<td>  </td>
			</tr>
			
		<tr style="text-align:center;">
			<th>Signature</th>
			<th>Date</th>
			<th>Printed Name</th>
			<th>DATE</th>
		</tr>
			<tr style="text-align:center;">
				<td>  </td>
				<td>  </td>
				<td> <?php echo $payee;?> </td>
				<td> </td>
			</tr>
			
			
			
	<tr style="text-align:left;">
		<td colspan=42>
		<p style="font-size:13px;">
			Official Receipt No. & Date / Other Documents:
		</p>
		</td>
	</tr>
	
	<!-- RECEIVED PAYMENTS END -->
</table>
</div>
