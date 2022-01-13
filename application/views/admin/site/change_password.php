<div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item"> <a href="<?php echo  site_url(); ?>support-dashboard">Dashboard</a> </li>
    <li class="breadcrumb-item active">Change Password </li>
  </ol>
  <!-- Icon Cards-->
  <div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-body">
        <form class="form-horizontal" id="addyourdocumentfile"  enctype="multipart/form-data" method="post">
          <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
			<?php if(isset($_SESSION['successmsg'])) { ?><div class="alert alert-success"><?php echo $_SESSION['successmsg']; ?></div><?php unset($_SESSION['successmsg']); } ?>
              <div id="passwordSuccess" class="alert alert-success"  style="display:none;"></div>
              <div class="form-group">
                <label class="">Old Password <b style="color:red;">*</b></label>
                <input type="password" class="form-control"  maxlength="10"  onChange="remove_error_oldpassword()" ng-model="user.oldPassword" id="oldPassword" name="oldPassword">
                <span id="oldPasswordError" style="color:red; font-size: 15px;"></span> </div>
              <div class="form-group">
                <label class="">Enter New Password <b style="color:red;">*</b></label>
                <input type="password" class="form-control" onChange="remove_error_newpassword()" onKeyUp="CheckPasswordStrength(this.value)"  maxlength="10"  ng-model="user.newPassword" id="newPassword" name="newPassword">
                <span id="password_strength"></span> 
                <span id="newPasswordError" style="color:red; font-size: 15px;"></span> </div>
              <div class="form-group">
                <label class="">Re-Enter New Password <b style="color:red;">*</b></label>
                <input type="password" class="form-control"  maxlength="10" onChange="remove_errror_renpassword()"  ng-model="user.newPassword1" id="newPassword1" name="newPassword1">
                <span id="newPasswordError1" style="color:red; font-size: 15px;"></span> </div>
				<div class="form-group">
			  <input type="button"  class="btn btn-primary" value="Change Password" onClick="return changePassword();">
			</div>
            </div>
			
            <div class="col-md-3"></div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
<script>
function remove_errror_renpassword (){ if($("#newPassword1").val()=='') { } else { $('#newPasswordError1').html(' '); } }
	function remove_error_newpassword (){ if($("#newPassword").val()=='') { } else { $('#newPasswordError').html(' '); $('#password_strength').html(' '); } 
	 var regularExpression = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/;
	  var password=document.getElementById('newPassword').value.trim();
			 var regularExpression = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/;
        if (!(password.match(regularExpression))) {
           // alert("Password must contain at least six character,one digit,one special character");
			 $('#newPasswordError').html('Password Must Contain At Least Six Character,One Digit,One Special Character');
              password.focus()
            return false;
        }  else {
		$('#newPasswordError').html(' ');
		}
	}
		function remove_error_oldpassword (){ if($("#oldPassword").val()=='') { } else { $('#oldPasswordError').html(' '); } }

		function changePassword(){
			if(document.getElementById('oldPassword').value==""){
				$("#oldPasswordError").html('Please Enter Old Password');
				$('#oldPassword').focus();
				return false;
			}
			if(document.getElementById('newPassword').value==""){
				$("#newPasswordError").html('Please Enter New Password');
				$('#newPassword').focus();
				return false;
			}
			 var password=document.getElementById('newPassword').value.trim();
			 var regularExpression = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/;
        if (!(password.match(regularExpression))) {
           // alert("Password must contain at least six character,one digit,one special character");
			 $('#newPasswordError').html('Password Must Contain At Least Six Character,One Digit,One Special Character');
              password.focus()
            return false;
        }  
			if(document.getElementById('newPassword1').value==""){
				$("#newPasswordError1").html('Please Re-enter new password');
				$('#newPassword1').focus();
				return false;
			}
			var oldPassword=document.getElementById('oldPassword').value.trim();
			var newPassword=document.getElementById('newPassword').value.trim();
			var newPassword1=document.getElementById('newPassword1').value.trim();
			if(newPassword!=newPassword1){
				$("#newPasswordError1").html('Password Does Not Match');
				return false;
			}
			var postTo = '<?php echo site_url();?>supportcontroller/support_changed_password_process';
			var data = {
				oldPassword: oldPassword,
				newPassword: newPassword
			};
			jQuery.post(postTo, data,
			function(data) {
				if(data==1){
				   // $("#passwordSuccess").show();
					//$("#passwordSuccess").html('<b>Password Changed Successfully</b>');
					document.getElementById('oldPassword').value="";
					document.getElementById('newPassword').value="";
					document.getElementById('newPassword1').value="";
					window.location='admin_change_password';
					$('#passwordError').hide();
				}else{
					$("#oldPasswordError").html('<b>Incorrect Old Password</b>');
				}
			});
		}
		
		function CheckPasswordStrength(password) {
        var password_strength = document.getElementById("password_strength");
 
        //TextBox left blank.
        if (password.length == 0) {
            password_strength.innerHTML = "";
            return;
        }
 
        //Regular Expressions.
        var regex = new Array();
        regex.push("[A-Z]"); //Uppercase Alphabet.
        regex.push("[a-z]"); //Lowercase Alphabet.
        regex.push("[0-9]"); //Digit.
        regex.push("[$@$!%*#?&]"); //Special Character.
 
        var passed = 0;
 
        //Validate for each Regular Expression.
        for (var i = 0; i < regex.length; i++) {
            if (new RegExp(regex[i]).test(password)) {
                passed++;
            }
        }
 
        //Validate for length of Password.
        if (passed > 2 && password.length > 8) {
            passed++;
        }
 
        //Display status.
        var color = "";
        var strength = "";
        switch (passed) {
            case 0:
            case 1:
                strength = "Weak";
                color = "red";
                break;
            case 2:
                strength = "Good";
                color = "darkorange";
                break;
            case 3:
            case 4:
                strength = "Strong";
                color = "green";
                break;
            case 5:
                strength = "Very Strong";
                color = "darkgreen";
                break;
        }
        password_strength.innerHTML = strength;
        password_strength.style.color = color;
    }
$(document).ready(function(){
		$('.pull-right').click(function(){
		$('.bg-success').hide();
		});
		});
	 
</script>
<!-- Area Chart Example-->
<!--<div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-area-chart"></i> Area Chart Example</div>
        <div class="card-body">
          <canvas id="myAreaChart" width="100%" height="30"></canvas>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div>-->
<!-- Example DataTables Card-->
</div>
