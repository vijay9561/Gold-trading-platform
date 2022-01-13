<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Admin Login</title>
  <!-- Bootstrap core CSS-->
  <link href="<?php echo base_url(); ?>support_assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url(); ?>support_assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="<?php echo base_url(); ?>support_assets/css/sb-admin.css" rel="stylesheet">
</head>
<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header" style="background-color:#007bff; color:#FFFFFF; text-align:center;">Admin Login</div>
      <div class="card-body">
	  <?php if(isset($_SESSION['errormsg'])) { ?> <div class="alert alert-danger"><?php echo $_SESSION['errormsg']; ?></div> <?php unset($_SESSION['errormsg']);  } ?>
	  <?php if(isset($_SESSION['successmsg'])) { ?> <div class="alert alert-success"><?php echo $_SESSION['successmsg']; ?></div> <?php unset($_SESSION['successmsg']);  } ?>
        <form method="post" id="submit_login">
          <div class="form-group">
            <label for="exampleInputEmail1">Username</label>
            <input class="form-control"  id="username" name="username" onChange="usernamer()" type="text" aria-describedby="emailHelp" placeholder="Username">
			<span id="usernamer" style="color:red;"></span>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input class="form-control" id="password" name="password"  onChange="passwordr()" type="password" placeholder="Password">
			<span id="passwordr" style="color:red;"></span>
          </div>
          <input type="submit" class="btn btn-primary btn-block" onClick="return submit_login_data();" value="Login">
		  
        </form>
        <div class="text-center">
          <!--<a class="small" href="<?php echo site_url(); ?>support-registration" style="float:left;">Register an Account</a>-->
         <!-- <a class="small" href="<?php echo site_url(); ?>support-forgot-password" style="float:right;">Forgot Password?</a>-->
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url(); ?>support_assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>support_assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url(); ?>support_assets/vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>

<script>
function usernamer(){if($('#username').val()==''){}else{ $('#usernamer').html(' '); }}
function passwordr(){if($('#password').val()==''){}else{ $('#passwordr').html(' '); }}
function submit_login_data(){
		var mobilenovalidation=/^\d{10}$/;
		var pat1=/^\d{6}$/;
		var emailpattern = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/;
			var  username=document.getElementById('username').value.trim();
			var  password=document.getElementById('password').value.trim();
			if(username==''){
				$("#usernamer").html('Please enter username');
				$("#username").focus();
				 return false;
			}
          if(password==''){
				$("#passwordr").html('Please enter password');
				$("#password").focus();
				 return false;
			}			
		$("#submit_login").unbind('submit').bind('submit',function() {
			var formData = new FormData($(this)[0]);
			$.ajax({   
				url: "<?php site_url(); ?>SupportController/login_support_process",
				type: "POST",
				data : formData,
				async: true,
				cache: false,
				contentType: false,
				processData: false,
				success: function(data){
					if(data==1){
					  window.location='support-dashboard';
						return false;
						}else {
				        window.location="admin-login";
						}
					
				}
			});
			return false;  
		});
				
	}
</script>


