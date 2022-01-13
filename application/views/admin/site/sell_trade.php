<div class="container-fluid">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"> <a href="<?php echo  site_url(); ?>support-dashboard">Dashboard</a> </li>
    <li class="breadcrumb-item active">Buy Trade</li>
  </ol>
  <div class="card mb-3">
   <div class="card-header"> <i class="fa fa-table"></i> Sell Trade History</div>
    <div class="card-body">
	 <?php if(isset($_SESSION['successmsg'])){ ?><div class="alert alert-success"><?php echo $_SESSION['successmsg'];  ?></div><?php unset($_SESSION['successmsg']); } ?>
      <div class="table-responsive">
        <table class="table table-bordered" id="sell_trades" width="100%" cellspacing="0">
             <thead>
                          <th>Sr. No</th>  
                          <th>Email ID</th>
                          <th>Mobile No</th>
                          <th>Trade ID</th>
                          <th>Market Rate</th>
                         <th>Gold Amount(gm)</th>
                         <th>Total INR Amount</th>
                         <th>Created Date</th>
                         <th>Trade Status</th>
                         
            </thead>   
        
        </table>
      </div>
    </div>
  </div>
</div>

