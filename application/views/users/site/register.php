<section id="login" class="intro intro-fullscreen header_cover"> 
  <!-- Intro Header-->
  <div class="intro-body"> 
    <!-- Register-->
    <div class="container">
      <div class="row wow fadeIn">
        <div class="col-md-6 col-xs-12 col-sm-6 col-md-offset-3 col-sm-offset-3">
          <div class="login-form">
            <h1> Get Started</h1>
            <?php if($this->session->userdata('message')) { ?>
            <div class="alert alert-success"><?php echo $this->session->userdata('message'); ?></div>
            <?php  $this->session->unset_userdata('message'); } ?>
            
            <div class="alert alert-danger" id="error_message" style="display:none;"></div>
            
            <div class="alert alert-success" id="success_message" style="display:none;"></div>
             
            <div class="registration_id" id="registration_id">
            <form name="registerform" id="registerform" class="form-signin dark-form" method="post">
              <div class="row">
                <div class="err-mark alert alert-black" ng-if="errorMessagebool ">
                </div>
              </div>
              <div class="form-wrapper form-bg">
                <div class="form-group">
                    <input type="text" autofocus  name="FULLNAME" id="FULLNAME" class="form-control input-lg err" placeholder="Full Name  *" text-only-for-customer-name required autocomplete="off">
                   </div>
                
                <div class="form-group">
                    <input type="tel" name="MOBILE" id="MOBILE" class="form-control input-lg  err" placeholder="10 Digit Mobile No. *" numbers-only maxlength="10" minlength="10" required isphoneno autocomplete="off">
                   </div>
               <div class="form-group">
                   <input type="email"   name="EMAIL" class="form-control input-lg  err" placeholder="Email *"  id="EMAIL" autocomplete="off">
                   </div>
                <div class="form-group">
                    <input type="password"   name="PASSWORD" class="form-control input-lg" placeholder="Password *" id="PASSWORD"  autocomplete="off">
                   </div>
                  <div class="form-group">
                      <input type="password"  name="Confirm_Password" id="Confirm_Password" class="form-control input-lg" placeholder="Confirm Password *">
                   </div>
                  <div class="form-group">
                      <input type="text"  name="REFFERAL_CODE" value="<?php if(isset($_GET['referral'])){ echo $_GET['referral']; } ?>" id="REFFERAL_CODE" class="form-control input-lg" placeholder="Referral Code (Optional)">
                   </div>
                  <div class="form-group">
                      <p><input id="agree" type="checkbox"  name="agree"  value="agree" required>
                      <label style="display:inline" for="agree">I agree to the Terms and Conditions <a target="_blank" href="#"> Terms & Conditions</a></label> </p>
                </div>
                <div class="submit-button">
                    <button type="submit" id="submt_register" class="btn btn-default btn-gold btn-block">Register</button>
                </div>
              </div>
            </form>
            </div>
            <div id="verify_otp_div" style="display:none;">
                  <form name="verify_form" id="verify_form" class="form-signin dark-form" method="post">
                <div class="form-group">
                    <input type="password" autofocus  name="OTP" id="OTP" class="form-control input-lg err" placeholder="Enter Your OTP" text-only-for-customer-name required autocomplete="off">
                   </div> 
                 <div class="submit-button">
                     <button type="submit" id="submit_opt" class="btn btn-default btn-gold btn-block">Submit OTP</button>
                </div>
                  </form>
            </div>
            <hr>
            <div class="form-elements">
                <p>Already Registered ?<a href="<?php echo site_url(); ?>login"><strong>Login</strong></a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>