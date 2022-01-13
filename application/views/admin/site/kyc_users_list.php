<div class="container-fluid">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"> <a href="<?php echo  site_url(); ?>support-dashboard">Dashboard</a> </li>
    <li class="breadcrumb-item active">KYC User</li>
  </ol>
  <div class="card mb-3">
   <div class="card-header"> <i class="fa fa-table"></i>KYC Users List</div>
    <div class="card-body">
                 <?php if($this->session->userdata('success')){ ?>
                      <div class="alert alert-success"><?php echo $this->session->userdata('success'); ?></div>
                 <?php $this->session->unset_userdata('success'); } ?>
                      <div class="table-responsive">
                                  <table class="table table-bordered" id="users_kyc_lists">
                                      <thead>
                                          <tr>
                                               <th>Sr.No</th> 
                                              <th>Username</th>
                                              <th>Mobile No</th>
                                              <th>Account No</th>
                                              <th>IFSC Code</th>
                                              <th>Account Holder Name</th>
                                              <th>National ID Front Image</th>
                                              <th>National ID Back Image</th>
                                              <th>Verify Status</th>
                                              <th>Account Image</th> 
                                               <th>Verify Status</th>
                                              <th>Date</th> 
                                            
                                          </tr>
                                      </thead>
                                  </table> 
                                  
                              </div>  
                          </div>    
                      </div>
                  </div>
                
       
<script>
 function bank_status(bank,userid,type){
     con=confirm("Are you sure to update status");
     if(con==true){
        $.ajax({ "url":"<?php echo site_url(); ?>shoppingwallet/bank_status_update",
             "type":"POST",
             data:{id:bank,userid:userid,type:type},
             success:function(data){
                 if(data==1){
                   //alert(data);
                  // return false;
                  window.location='kyc_users_list';
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
function update_status_addhar(bank,userid,type,no){
var cancel_adhar_note=$("#cancel_adhar_note"+no).val();
if(cancel_adhar_note==""){
    alert("Please enter reject note");
    $("#cancel_adhar_note"+no).focus();
    return false;
}
 $.ajax({ "url":"<?php echo site_url(); ?>shoppingwallet/bank_status_update_note",
             "type":"POST",
             data:{id:bank,userid:userid,type:type,note:cancel_adhar_note},
             success:function(data){
                 if(data==1){
                   //alert(data);
                  // return false;
                  window.location='kyc_users_list';
                   return false;
                 }else{
                   alert();
                 }
             }
        
    })
}

function update_status_bank(bank,userid,type,no){
var cancel_adhar_note=$("#cancel_bank_note"+no).val();
if(cancel_adhar_note==""){
    alert("Please enter reject note");
    $("#cancel_bank_note"+no).focus();
    return false;
}
 $.ajax({ "url":"<?php echo site_url(); ?>shoppingwallet/bank_status_update_note",
             "type":"POST",
             data:{id:bank,userid:userid,type:type,note:cancel_adhar_note},
             success:function(data){
                 if(data==1){
                   //alert(data);
                  // return false;
                  window.location='kyc_users_list';
                   return false;
                 }else{
                   alert();
                 }
             }
        
    })
}
function update_status_pan(bank,userid,type,no){
var cancel_adhar_note=$("#cancel_pan_note"+no).val();
if(cancel_adhar_note==""){
    alert("Please enter reject note");
    $("#cancel_pan_note"+no).focus();
    return false;
}
 $.ajax({ "url":"<?php echo site_url(); ?>shoppingwallet/bank_status_update_note",
             "type":"POST",
             data:{id:bank,userid:userid,type:type,note:cancel_adhar_note},
             success:function(data){
                 if(data==1){
                   //alert(data);
                  // return false;
                  window.location='kyc_users_list';
                   return false;
                 }else{
                   alert();
                 }
             }
        
    })
}
var j = jQuery.noConflict();
j(document).ready(function(){
    j("#from_date").datepicker({
        numberOfMonths: 1,
        changeMonth: true,
         changeYear: true,
        onSelect: function(selected) {
          j("#end_date").datepicker("option","minDate", selected)
        }
    });
    j("#end_date").datepicker({ 
        numberOfMonths: 1,
		changeMonth: true,
        changeYear: true,
        onSelect: function(selected) {
           j("#from_date").datepicker("option","maxDate", selected)
        }
    });  
});

  </script>
