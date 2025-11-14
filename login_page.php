<?php 
include "includes/header.php";

$notice="";
if(isset($_GET['loginfailed'])){
	
	$notice="<font color=red>Login Failed. Please Check Login Details.</font>";
	
}

if(count($_COOKIE) > 0) {
	header('Location: index.php?o=home');
	exit;
}
?>



 <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container">
      <div class="card login-card">
        <div class="row no-gutters">
          <div class="col-md-5">
            <img src="_images/background.jpg" alt="login" class="login-card-img">

          </div>
          <div class="col-md-7">
            <div class="card-body">
              <div class="brand-wrapper">
                <img src="_images/ncip_logo1.png" alt="logo" class="logo">
              </div>
              <p class="login-card-description">Sign into your account</p>
              <form action="login_check.php" method="POST">
                  <div class="form-group">
                    <label for="username" class="sr-only">Username</label>
                    <input type="username" name="username" id="username" class="form-control" placeholder="Username">
                  </div>
                  <div class="form-group mb-4">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="***********">
                  </div>
                  <input name="login" id="login" class="btn btn-block login-btn mb-4" type="submit" value="Login">
				  
				  <br>
				  
				  <?php echo $notice; ?>
				  
                </form>

            </div>
          </div>
        </div>
      </div>

    </div>
  </main>

<?php
include "includes/footer.php";
?>