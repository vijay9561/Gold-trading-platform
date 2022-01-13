<!--<div id="preloader">
  <div id="status"></div>
</div>-->
<header> 
  <!-- Navigation-->
  <nav class="navbar navbar-universal navbar-custom navbar-fixed-top"> <!-- Navigation-->
<div class="container">
     <?php $buy=$this->site->get_live_glod_rate(); ?>
    <div class="rate_fixed_header" id="without_refresh_get">
        <span class="buy_rates"> Gold Buy <i class="fa fa-inr"></i> <?php echo $buy['gram_rate']; ?> gm </span>
        <span class="sell_rates"> Gold Sell <i class="fa fa-inr"></i> <?php echo $buy['sell']; ?> gm </span>
    </div>
  <div class="navbar-header">
    <button type="button" data-toggle="collapse" data-target=".navbar-main-collapse" class="navbar-toggle"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
    
    <a style="font-size:24px;" href="<?php echo site_url(); ?>" class="navbar-brand">
    <!-- Text or Image logo-->
    
    <img src="<?php echo base_url(); ?>assets/images/sslogo2.png" alt="suvarnasiddhi" class="logo">
    <img src="<?php echo base_url(); ?>assets/images/sslogo2.png" alt="suvarnasiddhi" class="logodark">
    </a>
        </div>
  <div class="collapse navbar-collapse navbar-main-collapse">
    <ul class="nav navbar-nav navbar-left">
        <li class="hidden"><a href="<?php echo site_url(); ?>#page-top"></a></li> 
        <li><a href="#">About Us</a></li>
        <!--<li><a href="partner-with-us.html">Partner With Us</a></li>-->
      <!--  <li><a href="#">Join Us</a></li>-->
        <li class="menu-divider visible-lg">&nbsp;</li>

       <?php if(!$this->session->userdata('USERID')){ ?>   
        <li><a  href="<?php echo site_url(); ?>login">Login</a></li>
        <li><a  href="<?php echo site_url(); ?>register">Register</a></li>
       <?php }else{ ?>
       <li><a  href="<?php echo site_url(); ?>Limit_Trade">Trade</a></li>
        <li><a  href="<?php echo site_url(); ?>Logout">Logout</a></li>
        <li><a href="#" class="has-submenu" id="sm-1554963799341509-1" aria-haspopup="true" aria-controls="sm-1554963799341509-2" aria-expanded="false"> <i class="fa fa-user"></i> <?php echo substr($this->session->userdata('FULLNAME'),0 ,15); ?> <span class="caret"></span></a>
            <ul class="dropdown-menu sm-nowrap" id="sm-1554963799341509-2" role="group" aria-hidden="true" aria-labelledby="sm-1554963799341509-1" aria-expanded="false" style="width: auto; display: none; top: auto; left: 0px; margin-left: 0px; margin-top: 0px; min-width: 10em; max-width: 20em;">
              <li><a href="<?php echo site_url(); ?>my-profile"> My Profile</a></li>
              <li><a href="<?php echo site_url(); ?>deposit-and-withdraw">Deposit & Withdraw</a></li> 
              <li><a href="<?php echo site_url(); ?>transaction-history"> My Trade</a></li>
              <li><a href="<?php echo site_url(); ?>addresses-details"> My Addresses</a></li>
              <li><a href="<?php echo site_url(); ?>kyc-verfication"> KYC Verification</a></li>
              <li><a href="<?php echo site_url(); ?>My-Referral">My Referral</a></li>
              <li><a href="<?php echo site_url(); ?>gold-fixed-deposit">Fixed Deposit Gold</a></li> 
              <li><a href="<?php echo site_url(); ?>Logout">Logout</a></li>
            </ul>
        </li>   
       <?php } ?>
        
                  </ul>
  </div>
 
</div>
 </nav>
</header> 
<style>
    .header_cover{
    background: url(10.jpg);
    background-size: cover;
    box-shadow: inset 0 0 0 2000px rgba(7, 7, 7, 0.7); 
  }
</style>

<?php if($this->session->userdata('USERID')){  $id=$this->session->userdata('USERID');
                        $id=$this->db->query("select *from USERS_BALANCE where USERID='$id'")->row();
 }
                       ?> 
<div id="fixed_deposit" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">GOLD FIXED DEPOSIT</h4>
      </div>
      <div class="modal-body">
          <div class="alert alert-success" id="fixed_deposit_success" style="display:none;"></div>
          <div class="alert alert-danger" id="fixed_deposit_error" style="display:none;"></div>
            <p class="wallets_csss"><?php echo $id->GOLD_BALANCE; ?><br><b>GOLD WALLET</b></p> 
            <form method="post" id="fixed_deposit_inr_forms">
              <div class="form-group">
                  <label>Gold Amount</label>  
                  <input type="number" id="gold_amount_fixed" class="form-control" name="gold_amount_fixed" value="Gold Amount">
              </div> 
               <div class="form-group">
                  <label>Select Fixed Deposit Duration</label>   
                  <select id="fixed_deposit_duration" name="fixed_deposit_duration" class="form-control">
                      <option value="">Select Duration</option>
                      <option value="6">6 Months 6% Interest</option> 
                      <option value="9">9 Months 13.5% Interest</option> 
                      <option value="12">12 Months 24% Interest</option>   
                  </select>
              </div>  
              <div class="form-group">
                  <button type="submit" name="sub" id="submit_fixed_deposit" class="btn btn-primary btn-block">  Submit Fixed Deposit </button>
              </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5cdaa9e2d07d7e0c6393835d/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>