<?php 
			
	include "addon/all_uacs_to_string.php";
	include "addon/all_agency.php";	
?>

<div class="container-fluid">
  <div class="row">
    
    <div class="col-md-12 order-md-1">
      <h4 class="mb-3">Obligation Status and Request Information</h4>
	  
	  <div class="row">
          <div class="col-md-6 mb-3">
            <label for="serialnum">Serial Number</label>
            <input type="text" class="form-control" name="serialnum" placeholder="" value="<?php echo $row_ors['serial_number'];?>" required>
            <div class="invalid-feedback">
              Serial Number is required.
            </div>
          </div>
		  
        </div>
	  

        <div class="row">
		
		<div class="col-md-12 mb-3">
            <label for="payee">Payee</label>
            <input type="text" class="form-control" name="payee" placeholder="" value="<?php echo $row_ors['payee'];?>" required>
            <div class="invalid-feedback">
              Valid first name is required.
            </div>
          </div>
		  
		 <div class="col-md-12 mb-3">
            <label for="payee">Project</label>
            <input type="text" class="form-control" name="project" placeholder="Enter Project" value="<?php echo $row_ors['project'];?>">
            
          </div>
	  

        </div>
    </div>
  </div>

 </div>