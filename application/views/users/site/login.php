<section id="login" class="intro intro-fullscreen header_cover"> 
  <!-- Intro Header-->
  <div class="intro-body"> 
    <!-- Login-->
    
    <div class="container">
      <div class="row wow fadeIn">
        <div class="col-md-5 col-xs-12 col-sm-6 col-md-offset-4 col-sm-offset-3">
             <?php if($this->session->userdata('message')) { ?>
            <div class="alert alert-success"><?php echo $this->session->userdata('message'); ?></div>
            <?php  $this->session->unset_userdata('message'); } ?>
          <div class="login-form">
               <div class="alert alert-danger" id="error_message" style="display:none;"></div>
              <div class="alert alert-success" id="success_message" style="display:none;"></div>
            <h1>Login</h1>
            <form action="#" method="POST" name="login_form" id="login_form" class="form-signin dark-form" method="post">
                        <input type="hidden" name="csrf" value=ifpUdZjeFsxQhhA4fH806vjbS3cX9vZnhcvUlYzi />
              <div class="form-group"> 
                  <input type="text" autofocus  name="MOBILE" class="form-control input-lg" placeholder="Enter Mobile. OR Email ID*" required  autocomplete="off">
              </div>
                <div class="form-group"> 
                    <input type="password" autofocus  name="PASSWORD" class="form-control input-lg" placeholder="Enter Password" required  autocomplete="off">
              </div>
                 <div class="submit-button">
                     <button type="submit" class="btn btn-lg btn-gold btn-block" id="login_submit">Login</button>
                 </div>
              <a href="#" data-toggle="modal" data-target="#forgot_popup">Forgot Password</a>
            </form>
            <hr>
            
            <div class="form-elements"><p>Not a Member yet? <a href="<?php echo site_url(); ?>register"><strong>Register</strong></a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


 <div class="modal fade" id="forgot_popup" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Forgot Passowrd</h4>
        </div>
        <div class="modal-body">
              <div class="alert alert-danger" id="error_message_forgot" style="display:none;"></div>
              <div class="alert alert-success" id="success_message_forgot" style="display:none;"></div>
              <form method="post" id="forgot_password_form" name="forgot_password_form">
                <div class="form-group">
                    <input type="email" id="EMAIL" name="EMAIL" placeholder="Email Address" class="form-control">  
                 </div>
                <div class="form-group">
                    <button type="submit" id="forgot_button" name="forgot_button" class="btn btn-success btn-block">Submit</button>  
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>