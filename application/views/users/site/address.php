<style>
  .form-control{
    color: #b3b3b3;
    background-color: #565656;
    border: 1px solid #7d7a7a;
}
.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
    background-color: #484646;
    opacity: 1;
} 
.modal-content {
    position: relative;
    background-color: #302f2f;
}
.modal-title {
    margin: 0;
    line-height: 1.42857143;
    color: white;
}
</style>
<div class="small-header bg-img4 header_cover" style="background-position: 50% 0px;">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h2>My Addresses</h2>
      </div>
    </div>
  </div>
</div>
<section id="acount" class="section bg-dark2 ng-scope" ng-controller="AddressCtrl">
  <!-- ngIf: isListAddress --><div class="container  ng-scope" ng-if="isListAddress">
        <?php if($this->session->userdata('message')) { ?>
            <div class="alert alert-success"><?php echo $this->session->userdata('message'); ?></div>
            <?php  $this->session->unset_userdata('message'); } ?>
    <div class="row grid-pad">
      <div class="col-sm-6 col-md-4 col-xs-12">
        <div class="add-add bg-dark">
          <div class="panel panel-default">
            <div class="panel-body text-center"><a href="#"  data-toggle="modal" data-target="#add_address_modal"><i class="fa fa-plus fa-4x"></i><br>
              <h5>Add Address</h5>
              </a></div>
          </div>
        </div>
      </div>
      <!-- ngRepeat: address in address_list -->
     <?php if(count($address)>=1){ foreach($address as $row){ ?>
     <?php $tb_state=$this->db->query("select state from tb_state  where state_id='$row->STATE'")->row(); ?>
     <?php $tb_city=$this->db->query("select city from tb_city where city_id='$row->CITY'")->row(); ?>
      <div class="col-sm-6 col-md-4 col-xs-12">
        <div class="add-box">
          <div class="panel panel-default bg-dark">
            <div class="panel-heading bg-dark2">
              <h5 class="no-pad pull-left ng-binding"><?php echo $row->NAME; ?></h5>
              <div class="clearfix"></div>
            </div>
            <div class="panel-body  ng-binding"><?php echo $row->ADDRESS; ?>,
              <?php echo $tb_city->city; ?> ,  <?php echo $tb_state->state; ?> , <?php echo $row->PINCODE; ?> </div>
          <!--  <small class=" pull-right edit-add"><a href="" title="Edit Address" ng-click="changeView('edit',address.id)"><i class="fa fa-pencil-square-o"></i> Edit </a></small> -->
              <small class="delete-add"><a href="" onclick="return deleteAddress(<?php echo $row->ID; ?>)"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></small>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
     <?php  } } ?>
      <!-- end ngRepeat: address in address_list -->
      <!-- ngIf: !address_list.length -->
    </div>
  </div><!-- end ngIf: isListAddress -->
  <!--1st time-->
  <!-- ngIf: isAddAddress -->
  <!--1st time END--> 
</section>
  <?php $tb_state=$this->db->query("select *from tb_state order by state asc")->result(); ?>
   <?php $tb_city=$this->db->query("select *from tb_city order by city asc")->result(); ?>
<div id="add_address_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Address</h4>
      </div>
      <div class="modal-body">
           <div class="alert alert-danger" id="error_message" style="display:none;"></div>
            <div class="alert alert-success" id="success_message" style="display:none;"></div>
            
          <form method="post" id="add_address_details" action="#"  class="form-signin dark-form">
               <div class="form-wrapper form-bg">
              <div class="form-group">
                  <input type="text" class="form-control" name="NAME" value="<?php echo $this->session->userdata('FULLNAME'); ?>" id="NAME" placeholder="Name *">
              </div> 
             <div class="form-group">
                  <input type="text" class="form-control" name="MOBILE" value="<?php echo $this->session->userdata('MOBILE'); ?>" id="MOBILE" placeholder="Mobile *">
              </div> 
             <div class="form-group">
                  <input type="text" class="form-control" name="PINCODE" id="PINCODE" placeholder="Pincode *">
              </div> 
            <div class="form-group">
                <textarea type="text" class="form-control" name="ADDRESS" id="ADDRESS" placeholder="Address *"></textarea>
              </div> 
                <div class="form-group">
                     
                        <select type="text" class="form-control" name="state" id="state" onchange="stater()">
                           <option value="">Select State *</option>  
                            <?php foreach($tb_state as $st){ ?>
                            <option value="<?php echo $st->state_id; ?>"><?php echo $st->state; ?></option> 
                           <?php } ?>
                        </select>
                    </div>
                  
                    <div id="getstate">
                    <div class="form-group">
                       
                        <select type="text" class="form-control" name="city" id="city">
                            <option value="">Select City *</option>
                             <?php foreach($tb_city as $city){ ?>
                            <option value="<?php echo $city->city_id; ?>"><?php echo $city->city; ?></option> 
                           <?php } ?>
                        </select>
                    </div>  
                    </div>
             <div class="submit-button">
                     <button type="submit" id="submit_address" class="btn btn-default btn-gold btn-block">Submit Address</button>
                </div>
               </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>    
    <script>
     function stater() { if($("#state").val()=="") { }else{                  
   var state=$("#state").val();
//$("#loading").show();
if(state!=''){
    $.ajax({  
url:"<?php echo site_url(); ?>Users_controller/getcities_address",  
method:"POST",  
data:{state:state},  
success:function(resp){  
   $('#getstate').hide().html(resp).fadeIn('slow');
   //$("#loading").hide();
   } 
  })
  }
  } 
 }  
    </script>