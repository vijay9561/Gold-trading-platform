<div class="small-header bg-img4 header_cover" style="background-position: 50% -8px;">
  <div class="container">
      <div class="row"><div class="col-xs-12 col-sm-6"><h2>My Fixed Deposit Gold </h2></div> <div class="col-xs-12 col-sm-6"><div class="pull-right" style="margin-top:10px; font-weight:700"><a href="#" class="btn btn-success" style="color:#FFF;" data-toggle="modal" data-target="#fixed_deposit">Create Fixed Deposit</a></div></div></div>
  </div>
</div>
<section id="shop" class="section-small bg-gray ng-scope" ng-controller="TransactionCtrl">
  <div class="container">
    <div class="row">
        
              <?php if($this->session->userdata('message')) { ?>
            <div class="alert alert-success"><?php echo $this->session->userdata('message'); ?></div>
            <?php  $this->session->unset_userdata('message'); } ?>
      <div class="tab" role="tabpanel"> 
          <ul id="mytrans" class="nav nav-tabs hi-icon-wrap hi-icon-effect-8" role="tablist">
          <li role="presentation" class="active"><a href="#Section2" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="true"><i class="hi-icon fa fa-suitcase"></i> FD Gold </a></li>
          <li role="presentation" class=""><a href="#Section3" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><i class="hi-icon fa fa-diamond"></i> FD Gold Payout </a></li>
         <!-- <li role="presentation" class=""><a href="#Section4" aria-controls="delivery" role="tab" data-toggle="tab" aria-expanded="false"><i class="hi-icon flaticon-coins-1"></i> Delivery</a></li>
         <li role="presentation" class=""><a href="#Section5" aria-controls="jeweller" role="tab" data-toggle="tab" aria-expanded="false"><i class="hi-icon fa fa-inr"></i> INR Deposit</a></li>-->
        </ul>
        <!-- Tab panes -->
        <div class="tab-content tabs">
            
          <div class="tranc-loader" data-loading="" style="display: none;"><div id="loader"></div></div>
         <div role="tabpanel" class="tab-pane fade active in" id="Section2">
   
            <!-- ngIf: !buyTxs.length -->
              <div class="add-box">
                <div class="table-responsive">
                      <table class="table table-bordered" id="fixed_deposit_table">
                         <thead>
                         <th>FD ID</th>
                         <th>Gold Amount</th>
                       
                          <th>Interest</th>
                         <th>Status</th>
                         <th>Sign Date</th>
                         <th>Expiry Date</th> 
                         <th>Action</th>
                         </thead>   
                      </table>   
                  </div>
              </div>
         </div>
          <div role="tabpanel" class="tab-pane fade" id="Section3">
                <div class="add-box">
               <div class="table-responsive">
                   <table class="table table-bordered" id="gold_payout_amount" style="width:100%;">
                          <thead>
                         <th>Sr. No</th>  
                         <th>Gold Payout Amount</th>
                         <th>Payout Date</th>
                        <!-- <th>Action</th>-->
                          </thead>   
                      </table>   
                  </div>
              </div>
          </div>  
        </div>
      </div>
    </div>
  </div>
</section>