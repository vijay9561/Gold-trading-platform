<section data-background="<?php echo base_url(); ?>assets/images/header/10.jpg" id="login" class="intro intro-fullscreen"> 
  <!-- Intro Header-->
  <div class="intro-body"> 
    <!-- Login-->
    
    <div class="container">
      <div class="row wow fadeIn">
        <div class="col-md-5 col-xs-12 col-sm-6 col-md-offset-4 col-sm-offset-3">
          <div class="login-form">
               <div class="alert alert-danger" id="error_message" style="display:none;"></div>
              <div class="alert alert-success" id="success_message" style="display:none;"></div>
            <h1>Reset Password</h1>
            <form action="#" method="POST" name="reset_password" id="reset_password" class="form-signin dark-form" method="post">
                        <input type="hidden" name="csrf" value=ifpUdZjeFsxQhhA4fH806vjbS3cX9vZnhcvUlYzi />
              <div class="form-group">
                  <input type="hidden" id="ID" name="ID" value="<?php echo $_GET['rest_pass']; ?>">
                  <input type="password" autofocus  name="PASSWORD" class="form-control input-lg" placeholder="Password" required  autocomplete="off">
              </div>
                <div class="form-group"> 
                    <input type="password" autofocus  name="CONFIRM_PASSWORD" class="form-control input-lg" placeholder="Confirm Password" required  autocomplete="off">
              </div>
                 <div class="submit-button">
                     <button type="submit" class="btn btn-lg btn-gold btn-block" id="reset_passwor_button">Reset Password</button>
              </div>
            </form>
          <!--  <hr>-->
          </div>
        </div>
      </div>
    </div>
  </div>
</section>