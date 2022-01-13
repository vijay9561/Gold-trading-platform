<section id="contact " class="bg-dark2">
  <div class="container">
    <div class="row">
      <div class="col-sm-5 col-xs-12 ">
        <h3>Contact Us At</h3>
       <!-- <h5><i class="fa fa-map-marker fa-fw fa-lg"></i> Shop No 3 Vora Ashish Building,<br>
          Pandit Solicitor Road, Malad East, <br>
          Opp Anandpara Hospital, <br>
          Mumbai-400097 </h5>-->
        <h5 style="text-transform:lowercase"><i class="fa fa-envelope fa-fw fa-lg"></i> <a href="mailto:support@suvarnasiddhi.com">support@suvarnasiddhi.com</a> </h5>
        <!--<h5><i class="fa fa-phone fa-fw fa-lg"></i> 888 1000 800 </h5>-->
      </div>
      <div class="col-sm-6 col-xs-12 col-sm-offset-1">
            <?php if($this->session->userdata('message')) { ?>
            <div class="alert alert-success"><?php echo $this->session->userdata('message'); ?></div>
            <?php  $this->session->unset_userdata('message'); } ?>
        <h3>Write To Us:</h3>
        <!-- Contact Form - Enter your email address on line 17 of the mail/contact_me.php file to make this form work. For more information on how to do this please visit the Docs!-->
        <form id="contact_forms" name="sentMessage" method="POST" action="<?php echo site_url(); ?>Api_Controller/mail_enquiry_details" novalidate class="dark-form">
         <input type="hidden" name="csrf" value=esbHSGKPgY8oR0ydveMH1cGFIuEENrGKa4YR8f51 />
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label for="name" class="sr-only control-label">Name</label>
              <input id="name" name="name" type="text" placeholder="Name*" required="" data-validation-required-message="Please enter name" class="form-control input-lg">
              <span class="help-block text-danger"></span> </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label for="email" class="sr-only control-label">Email</label>
              <input id="email" name="email" type="email" placeholder="Email*" required data-validation-required-message="Please enter email" class="form-control input-lg">
              <span class="help-block text-danger"></span> </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label for="phone_no" class="sr-only control-label">Phone</label>
              <input id="phone_no" name="phone_no" type="tel" placeholder="Phone" class="form-control input-lg">
              <span class="help-block text-danger"></span> </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label for="message" class="sr-only control-label">Message</label>
              <textarea id="message" name="message1" rows="3" placeholder="Message"aria-invalid="false" class="form-control input-lg"></textarea>
              <span class="help-block text-danger"></span> </div>
          </div>
          <div id="success"></div>
          <button type="submit" class="btn btn-lg btn-dark">Send</button>
        </form>
      </div>
    </div>
  </div>
</section>