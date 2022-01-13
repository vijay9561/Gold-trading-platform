<div class="small-header bg-img4 header_cover" style="background-position: 50% -8px;">
  <div class="container">
      <div class="row"><div class="col-xs-12 col-sm-12"><h2>My Fixed Deposit Gold Earnings </h2></div> <div class="col-xs-12 col-sm-6"><div class="pull-right" style="margin-top:10px; font-weight:700"></div></div></div>
  </div>
</div>
<section id="shop" class="section-small bg-gray ng-scope" ng-controller="TransactionCtrl">
  <div class="container">
    <div class="row">
        
              <?php if($this->session->userdata('message')) { ?>
            <div class="alert alert-success"><?php echo $this->session->userdata('message'); ?></div>
            <?php  $this->session->unset_userdata('message'); } ?>
      <div class="tab" role="tabpanel"> 
        
        <!-- Tab panes -->
        <div class="tab-content tabs">
            
          <div class="tranc-loader" data-loading="" style="display: none;"><div id="loader"></div></div>
         <div role="tabpanel" class="tab-pane fade active in" id="Section2">
   
            <!-- ngIf: !buyTxs.length -->
              <div class="add-box">
                <div class="table-responsive">
                      <table class="table table-bordered" id="gold_payout_amount_daily">
                         <thead>
                         <th>Sr. No</th>  
                         <th>Gold Amount</th> 
                         <th>Date</th>
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