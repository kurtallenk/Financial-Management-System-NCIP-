<?php 
			
	include "addon/all_uacs_to_string.php";
	include "addon/all_agency.php";	
?>

<div class="container-fluid">
  <div class="row">
    
    <div class="col-md-12 order-md-1">
      <h4 class="mb-3">Payee Information</h4>
	  
	  <div class="row">
          <div class="col-md-6 mb-3">
            <label for="serialnum">Serial Number</label>
            <input type="text" class="form-control" name="serialnum" placeholder="" value="" required>
            <div class="invalid-feedback">
              Serial Number is required.
            </div>
          </div>
		  
		  <div class="col-md-6 mb-3">
            <label for="date">Date</label>
            <input type="text" class="form-control" name="date" placeholder="<?php echo date("Y/m/d");?>" value="" disabled>
			
			
          </div>
		
		<div class="col-md-12 mb-3">
            <label for="payee">Payee</label>
            <input type="text" class="form-control" name="payee" placeholder="Name or Organization" value="" required>
            <div class="invalid-feedback">
              Valid first name is required.
            </div>
          </div>
		  
		  <div class="col-md-12 mb-3">
            <label for="payee">Project</label>
            <input type="text" class="form-control" name="project" placeholder="Enter Project" value="">
            
          </div>
		  
        </div>
    </div>
  </div>

 </div>
 
<script type="text/javascript">



//DROP DOWN AGENCY FUNCTION to SHOW PROGRAM
		function showProgram(id_val) {
			//document.write(id_val);
		  if (id_val == "") {
			  
			document.getElementById("program").innerHTML = "";
			return;
		  } else {
			var xmlhttp = new XMLHttpRequest();
			var handleRequestStateChange = function() {
			  if (this.readyState == 4 && this.status == 200) {
				document.getElementById("program").innerHTML = this.responseText;
			  }
			};
			
			xmlhttp.open("GET","addon/get_program.php?q="+id_val,true);
			xmlhttp.onreadystatechange = handleRequestStateChange;
			xmlhttp.send();
			
			var xmlhttp2 = new XMLHttpRequest();
			var handleRequestStateChange2 = function() {
			  if (this.readyState == 4 && this.status == 200) {
				document.getElementById("subprogram").innerHTML = this.responseText;
			  }
			};
			
			xmlhttp2.open("GET","addon/get_blank_opt.php",true);
			xmlhttp2.onreadystatechange = handleRequestStateChange2;
			xmlhttp2.send();
			
		  }
		}
		
		
//DROP DOWN PROGRAM FUNCTION to SHOW SUB-PROGRAM
		function showSubProgram(id_val) {
			//document.write(id_val);
		  if (id_val == "") {
			  
			document.getElementById("subprogram").innerHTML = "";
			return;
		  } else {
			var xmlhttp = new XMLHttpRequest();
			var handleRequestStateChange = function() {
			  if (this.readyState == 4 && this.status == 200) {
				document.getElementById("subprogram").innerHTML = this.responseText;
			  }
			};
			
			xmlhttp.open("GET","addon/get_subprogram.php?q="+id_val,true);
			xmlhttp.onreadystatechange = handleRequestStateChange;
			xmlhttp.send();
		  }
		}
</script>

<script type="text/javascript">
         $(function () {
             $('#datetimepicker1').datetimepicker();
         });
      </script>

<?php 

$connect->close();

?>