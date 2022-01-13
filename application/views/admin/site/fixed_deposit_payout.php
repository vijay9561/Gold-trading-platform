<div class="container-fluid">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"> <a href="<?php echo  site_url(); ?>support-dashboard">Dashboard</a> </li>
    <li class="breadcrumb-item active">Fixed Deposit Payout History</li>
  </ol>
  <div class="card mb-3">
   <div class="card-header"> <i class="fa fa-table"></i> Fixed Deposit Payout History</div>
    <div class="card-body">
	 <?php if(isset($_SESSION['successmsg'])){ ?><div class="alert alert-success"><?php echo $_SESSION['successmsg'];  ?></div><?php unset($_SESSION['successmsg']); } ?>
      <div class="table-responsive">
        <table class="table table-bordered" id="FIXED_DEPOSIT_PAYOUT" width="100%" cellspacing="0">
             <thead>
                          <th>Sr. No</th>  
                          <th>FULLNAME</th>
                          <th>Mobile No</th> 
                         <th>Gold Payout Amount</th>
                         <th>Payout Date</th>
                         
            </thead>   
        </table>
      </div>
    </div>
  </div>
</div>

<script>
function delivery_status_details(id){
       con=confirm('Are you sure to the deliver orders')
       if(con==true){
             $.ajax({url:"<?php echo site_url(); ?>SupportController/delivery_status_details_changed",
                  "type":"POST",
               data:{id:id},
               success:function(data){
                 if(data==1){
                   //alert(data);
                  // return false;
                  window.location='delivery_orders_details';
                   return false;
                 }else{
                   alert();
                 }
             }
        
    })
    }else{
        return false;
    }
}
</script>
