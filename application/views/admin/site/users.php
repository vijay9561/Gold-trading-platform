<div class="container-fluid">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"> <a href="<?php echo  site_url(); ?>support-dashboard">Dashboard</a> </li>
    <li class="breadcrumb-item active">Users</li>
  </ol>
  <div class="card mb-3">
   <div class="card-header"> <i class="fa fa-table"></i> Users History</div>
    <div class="card-body">
	 <?php if(isset($_SESSION['successmsg'])){ ?><div class="alert alert-success"><?php echo $_SESSION['successmsg'];  ?></div><?php unset($_SESSION['successmsg']); } ?>
      <div class="table-responsive">
        <table class="table table-bordered" id="users_history" width="100%" cellspacing="0">
            
                          <thead>
                          <th>Sr. No</th>  
                          <th>Full Name</th>
                          <th>Email ID</th>
                          <th>Mobile No</th>
                          <th>Created Date</th>
                          <th>Action</th>
                        
                         </thead>   
               
        </table>
      </div>
    </div>
  </div>
</div>
<script>
function status_changed(id,type){
  con=confirm('are you sure the changed status');
  if(con==true){
       $.ajax({
    url: "<?php echo site_url() ?>SupportController/changed_status_users",
    type: 'POST',
    data: {id:id,type:type},
    success: function(data) {
            if(data==1){
            location.reload();
            }else{
            alert('Not changed');
            }
         }
	}); 
  }else{
      return false;
  }
}
</script>

