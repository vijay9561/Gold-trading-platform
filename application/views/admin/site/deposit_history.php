<div class="container-fluid">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"> <a href="<?php echo  site_url(); ?>support-dashboard">Dashboard</a> </li>
    <li class="breadcrumb-item active">Deposit</li>
  </ol>
  <div class="card mb-3">
   <div class="card-header"> <i class="fa fa-table"></i> Deposit History</div>
    <div class="card-body">
	 <?php if(isset($_SESSION['successmsg'])){ ?><div class="alert alert-success"><?php echo $_SESSION['successmsg'];  ?></div><?php unset($_SESSION['successmsg']); } ?>
      <div class="table-responsive">
        <table class="table table-bordered" id="deposit_INR_History" width="100%" cellspacing="0">
         
                          <thead>
                          <th>Sr. No</th>  
                          <th>Email</th>
                          <th>Mobile No</th>
                          <th>Payment ID</th>
                         <th>Total Amount</th>
                         <th>Deposit Date</th>
                         <th>Payment Status</th>
                         <!--<th>Action</th>-->
                         </thead>   
               
        </table>
      </div>
    </div>
  </div>
</div>

<script>
function approved_actions(userid,id){
        var con=confirm("are you sure received deposit amount");
          if(con==true){
               $("#loading1").show();
                  $.ajax({
                     url: "<?php echo site_url() ?>SupportController/approve_deposit_amount",
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
function dISAPPROVED_NOTER(id){ if($("#dISAPPROVED_NOTE"+id).val()==''){ }else{ $("#dISAPPROVED_NOTER").html(""); } }
function disapproved_actions(no,userid,id){
   
    var dISAPPROVED_NOTE=$("#dISAPPROVED_NOTE"+no).val();
   // alert(dISAPPROVED_NOTE);
     if(dISAPPROVED_NOTE==''){
         $("#dISAPPROVED_NOTER"+no).html("Please enter disapprove note");
         return false;
     }
     var con=confirm("are you sure disapproved deposit amount");
          if(con==true){
               $("#loading1").show();
                  $.ajax({
                     url: "<?php echo site_url() ?>SupportController/disapprov_deposit_amount",
                     type: 'POST',
                     data: {userid: userid, id:id,dISAPPROVED_NOTE:dISAPPROVED_NOTE},
                     success: function(data) {
                     if(data==1){
                         location.reload();
                     }else{
                        $("#loading1").hide();
                        alert('record not deleted');
                        return false;
                      }    
                     }});
         }else{
         return false;
         }
}
</script>
