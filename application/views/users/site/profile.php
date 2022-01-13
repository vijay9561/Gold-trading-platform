<div class="small-header bg-img4 header_cover" style="background-position: 50% 0px;">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h3>My Profile</h3>
      </div>
    </div>
  </div>
</div>
<section id="profile" class="bg-dark2 section-small ng-scope">
  <div class="container">
    <div class="row">
      <div class="col-sm-7">
        <div class="profile-info add-box">
          <h4>Personal Info</h4>
          <div class="profile-details form-signin form-horizontal dark-form">
            <div class="form-group">
              <label for="name" class=" control-label col-sm-3">Name</label>
              <div class="col-sm-9">                 <input type="text" value="<?php echo $USERS->FULLNAME; ?>" disabled="" class="form-control  ">
              </div>
            </div>
            <div class="form-group">
              <label for="name" class=" control-label col-sm-3">Email</label>
              <div class="col-sm-9">                 <input type="text" value="<?php echo $USERS->EMAIL; ?>" disabled="" class="form-control  ">
              </div>
            </div>
       
            <div class="form-group">
              <label for="name" class=" control-label col-sm-3">Mobile Number</label>
              <div class="col-sm-9"> <input type="text" value="<?php echo $USERS->MOBILE; ?>" disabled="" class="form-control  ">
              </div>
            </div>
              <div class="form-group">
              <label for="name" class=" control-label col-sm-3">Referral Code</label>
              <div class="col-sm-8">
                  <button class="btn btn-success"><?php echo $USERS->YOUR_REFERRAL; ?></button>
                   <?php $url= base_url().'register?referral='.$USERS->YOUR_REFERRAL; ?> 
                  <button class="btn btn-danger" onclick="copy('<?php echo $url; ?>')">
                      <i class="fa fa-copy"></i>
                  </button>
                  <input type="hidden" id="reffer_id" name="reffer_id" value="<?php echo $url; ?>">
                
                  <label class="text-success" id="success_copy_msg"></label>
              </div>
            </div>
          </div>
        </div>
        <hr>
      </div>
      <div class="col-sm-4 col-sm-offset-1">
        <h4>My Account</h4>
        <ul class="list-unstyled">
            <li><a href="<?php echo site_url(); ?>my-profile"> My Profile</a></li>
          <li><a href="<?PHP echo site_url(); ?>transaction-history"> My Trade</a></li>
          <li><a href="<?php echo site_url(); ?>addresses-details"> My Addresses</a></li>
          <li><a href="<?php echo site_url(); ?>kyc-verfication"> My KYC Verification</a></li>
          <li><a href="<?php echo site_url(); ?>deposit-and-withdraw"> My Deposit & Withdraw</a></li>
          <li><a href="<?php echo site_url(); ?>My-Referral">My Referral Income</a></li> 
        </ul>
      </div>
    </div>
  </div>
</section>
<script>
function copy(text) {
    var input = document.createElement('input');
    input.setAttribute('value', text);
    document.body.appendChild(input);
    input.select();
    var result = document.execCommand('copy');
    document.body.removeChild(input);
    alert('Copied Successfully')
    return result;
 }

</script>