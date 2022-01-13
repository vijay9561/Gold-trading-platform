<div class="container-fluid">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"> <a href="<?php echo  site_url(); ?>support-dashboard">Dashboard</a> </li>
    <li class="breadcrumb-item active">Deposit</li>
  </ol>
  <div class="card mb-3">
   <div class="card-header"> <i class="fa fa-table"></i> Withdraw INR Request</div>
    <div class="card-body">
	 <?php if(isset($_SESSION['successmsg'])){ ?><div class="alert alert-success"><?php echo $_SESSION['successmsg'];  ?></div><?php unset($_SESSION['successmsg']); } ?>
      <div class="table-responsive">
        <table class="table table-bordered" id="particular_withdraw_all_history" width="100%" cellspacing="0">
         
                          <thead>
                         <th>Sr. No</th>  
                         <th>Email</th>
                         <th>Mobile No</th>
                         <th>Request ID</th>
                         <th>Fees</th>
                         <th>Total INR</th>
                         <th>Withdraw Date</th>
                         <th>Withdraw Status</th>
                         </thead>   
               
        </table>
      </div>
    </div>
  </div>
</div>


<script>
    function transaction_idr(id){ if($("#transaction_id"+id).val()==""){ }else{ $("#transaction_idr"+id).html(" ") } }
function approved_actions_id_submit(no,userid,id){
  // alert();
    transaction_id=$("#transaction_id"+no).val();
    if(transaction_id==""){
     $("#transaction_idr"+no).html("Please enter transaction id");
     return false;
 }
       var con=confirm("are you sure approve withdraw request");
          if(con==true){
               $("#loading1").show();
                  $.ajax({
                     url: "<?php echo site_url() ?>SupportController/approve_withdraw_amount",
                     type: 'POST',
                     data: {userid: userid, id:id,transaction_id:transaction_id},
                     success: function(data) {
                     if(data==1){
                         location.reload();
                     }else{
                        $("#loading1").hide();
                        alert('record not deleted');
                        return false;
                      }    
                     }
               })
         }else{
         return false;
    }
}
function approved_actions(userid,id){
        var con=confirm("are you sure received deposit amount");
          if(con==true){
               $("#loading1").show();
                  $.ajax({
                     url: "<?php echo site_url() ?>SupportController/approve_withdraw_amount",
                     type: 'POST',
                     data: {userid: userid, id:id},
                     success: function(data) {
                     if(data==1){
                         location.reload();
                     }else{
                        $("#loading1").hide();
                        alert('record not deleted');
                        return false;
                      }    
                     }
         })
         
         }else{
         return false;
         }
} 
function disapproved_actions(userid,id){
     var con=confirm("are you sure disapproved withdraw request");
          if(con==true){
               $("#loading1").show();
                  $.ajax({
                     url: "<?php echo site_url() ?>SupportController/disapprove_withdraw_amount",
                     type: 'POST',
                     data: {userid: userid, id:id},
                     success: function(data) {
                     if(data==1){
                         location.reload();
                     }else{
                        $("#loading1").hide();
                        alert('record not deleted');
                        return false;
                      }    
                     }
           })
         
         }else{
         return false;
         }
}
</script>


