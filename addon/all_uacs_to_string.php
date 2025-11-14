<?php 
			
			include "php_actions/database_connect.php";
			$sql_chart_of_accounts = "SELECT * FROM chart_of_accounts ORDER BY chart_account_title ASC";
			$result_chart_of_accounts = $connect->query($sql_chart_of_accounts);
			
		
			$all_uacs = "";
			$all_uacs .= '<option>Choose...</option>';
			
			if($result_chart_of_accounts->num_rows > 0){
			// output data of each row
				while($row_chart_of_accounts = $result_chart_of_accounts->fetch_assoc()) {
					
					$all_uacs .= "<option value=".$row_chart_of_accounts['chart_account_id'].">".$row_chart_of_accounts['chart_account_title']." - ".$row_chart_of_accounts['chart_account_code']."</option>";
				}
				
			
			}
			$connect->close();
			
?>