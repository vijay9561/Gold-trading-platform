<style>
.header-logo{ width:11%;}
</style>
<nav  class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
<a class="navbar-brand" href="<?php echo  site_url(); ?>support-dashboard"> <img class="header-logo" src="<?php echo base_url(); ?>assets/images/sslogo2.png" />  UVARNASIDDHI ADMIN</a>
<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
<div class="collapse navbar-collapse" id="navbarResponsive">
  <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
    <li class="nav-item <?php if($page=='Home') { echo 'active'; }?>" data-toggle="tooltip" data-placement="right" title="Dashboard"> <a class="nav-link" href="<?php echo site_url(); ?>support-dashboard"> <i class="fa fa-fw fa-dashboard"></i> <span class="nav-link-text"> Dashboard</span> </a> </li>
    <li class="nav-item <?php if($page=='Deposit History') { echo 'active'; }?>" data-toggle="tooltip" data-placement="right" title="Deposit History"> <a class="nav-link" href="<?php echo site_url(); ?>admin_deposit_history"> <i class="fa fa-inr" aria-hidden="true"></i> <span class="nav-link-text"> Deposit INR</span> <span class="badge badge-pill badge-danger"></span></a> </li>
    <li class="nav-item <?php if($page=='Users History') { echo 'active'; }?>" data-toggle="tooltip" data-placement="right" title="Close Tickets"> <a class="nav-link" href="<?php echo site_url(); ?>admin_users_history"> <i class="fa fa-users" aria-hidden="true"></i> <span class="nav-link-text"> Users</span> <span class="badge badge-pill badge-success"></span> </a> </li>
    <li class="nav-item <?php if($page=='KYC Users List') { echo 'active'; }?>" data-toggle="tooltip" data-placement="right" title="Kyc Users List"> <a class="nav-link" href="<?php echo site_url(); ?>kyc_users_list"><i class="fa fa-file" aria-hidden="true"></i> <span class="nav-link-text"> KYC User List</span> <span class="badge badge-pill badge-primary"></span></a></li>
    <li class="nav-item <?php if($page=='Withdraw History') { echo 'active'; }?>" data-toggle="tooltip" data-placement="right" title="Withdraw History"> <a class="nav-link" href="<?php echo site_url(); ?>admin_withdraw_history"> <i class="fa fa-inr" aria-hidden="true"></i><span class="nav-link-text"> Withdraw Request </span> </a> </li>
     <li class="nav-item <?php if($page=='Buy Trades' || $page=='Sell Trade') { echo 'active';}else{echo '0';} ?>" data-toggle="tooltip" data-placement="right" title="Trade">
            <a class="nav-link nav-link-collapse <?php if($page=='Buy Trades' || $page=='Sell Trade') { echo 'show';}else{echo 'collapsed';} ?>" data-toggle="collapse" href="#sale-trade" data-parent="#exampleAccordion">
             <i class="fa fa-list" aria-hidden="true"></i>
              <span class="nav-link-text">
                Trade</span>
            </a>
            <ul class="sidenav-second-level collapse <?php if($page=='Buy Trades' || $page=='Sell Trade') { echo 'show';}else{echo '0';} ?>" id="sale-trade">
              <li>
                <a href="<?php echo site_url(); ?>buy_trade_history">Buy Trade</a>
              </li>
              <li>
                <a href="<?php echo site_url(); ?>sell_trade_admin">Sell Trade</a>
              </li>
	
	      </ul>
         </li>
           <li class="nav-item <?php if($page=='Add New Product') { echo 'active'; }?>" data-toggle="tooltip" data-placement="right" title="Add Gold"> <a class="nav-link" href="<?php echo site_url(); ?>add_new_product_admin"> <i class="fa fa-fw fa-diamond"></i> <span class="nav-link-text"> Add Gold Product</span> </a> </li>
 <li class="nav-item <?php if($page=='Delivery Orders') { echo 'active'; }?>" data-toggle="tooltip" data-placement="right" title="Delivery Orders"> <a class="nav-link" href="<?php echo site_url(); ?>delivery_orders_details"> <i class="fa fa-fw fa-cart-plus"></i> <span class="nav-link-text"> Delivery Orders</span> </a> </li>
 
 <li class="nav-item <?php if($page=='Fixed Deposit' || $page=='Fixed Deposit Payout') { echo 'active';}else{echo '0';} ?>" data-toggle="tooltip" data-placement="right" title="Trade">
            <a class="nav-link nav-link-collapse <?php if($page=='Fixed Deposit Payout' || $page=='Fixed Deposit') { echo 'show';}else{echo 'collapsed';} ?>" data-toggle="collapse" href="#deposit-fixed" data-parent="#exampleAccordion">
             <i class="fa fa-diamond" aria-hidden="true"></i>
              <span class="nav-link-text">
                FD Gold</span>
            </a>
            <ul class="sidenav-second-level collapse <?php if($page=='Fixed Deposit' || $page=='Fixed Deposit Payout') { echo 'show';}else{echo '0';} ?>" id="deposit-fixed">
              <li>
                <a href="<?php echo site_url(); ?>fixed_deposit_history">Fixed Deposit Gold</a>
              </li>
              <li>
                <a href="<?php echo site_url(); ?>fixed_deposit_payout">Fixed Deposit Payout</a>
              </li>
		
	      </ul>
         </li>
  </ul>
  <ul class="navbar-nav sidenav-toggler">
    <li class="nav-item"> <a class="nav-link text-center" id="sidenavToggler"> <i class="fa fa-fw fa-angle-left"></i> </a> </li>
  </ul>
  <ul class="navbar-nav ml-auto" style="margin-right: 117px;">
 <!--   <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" onclick="return update_notifications()" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-fw fa-bell"></i> <span class="d-lg-show" id="countgetnotifications"> </span> <span class="indicator text-warning d-none d-lg-block"> </span> </a>
      <div class="dropdown-menu" aria-labelledby="alertsDropdown" style="padding-top: 0px;border: 1px solid #4c5259;">
        <div id="getnotifications"> </div>
      </div>
    </li>-->
    <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" data-toggle="dropdown"><span class="caret"></span><?php echo ucfirst($_SESSION['SUPPORT_USRNAME']); ?></a>
      <ul class="dropdown-menu">
        <li><i class="fa fa-fw fa-sign-out"></i><a href="<?php echo site_url(); ?>support-user-logout"> Logout</a></li>
        <li>
          <div class="dropdown-divider"></div>
        </li>
        <li><i class="fa fa-pencil"></i><a href="<?php echo site_url(); ?>admin_change_password"> Change Password</a></li>
      </ul>
    </li>
    <li class="nav-item">
	<div class="col-md-4"> &nbsp;&nbsp;
      <form class="form-inline my-2 my-lg-0 mr-lg-2">
        <div class="input-group" style="display:none;">
          <input class="form-control" type="text" placeholder="Search for...">
          <span class="input-group-append">
          <button class="btn btn-primary" type="button"> <i class="fa fa-search"></i> </button>
          </span> </div>
      </form>
	  </div>
    </li>
  </ul>
</div>
</nav>
