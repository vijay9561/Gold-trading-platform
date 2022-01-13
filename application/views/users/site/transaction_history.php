<div class="small-header bg-img4 header_cover" style="background-position: 50% -8px;">
  <div class="container">
   <div class="row"><div class="col-xs-12 col-sm-6"><h2>My Transactions</h2></div> <div class="col-xs-12 col-sm-6"><div class="pull-right" style="margin-top:10px; font-weight:700"><a style="color:#ffe448" href="#">Buy or Sell Gold</a> / <a style="color:#ffe448" href="#">Get Delivery</a></div></div></div>
  </div>
</div>
<section id="shop" class="section-small bg-gray ng-scope" ng-controller="TransactionCtrl">
  <div class="container">
     
    <div class="row">
        
              <?php if($this->session->userdata('message')) { ?>
            <div class="alert alert-success"><?php echo $this->session->userdata('message'); ?></div>
            <?php  $this->session->unset_userdata('message'); } ?>
      <div class="tab" role="tabpanel"> 
        <!-- Nav tabs -->
        <ul id="mytrans" class="nav nav-tabs hi-icon-wrap hi-icon-effect-8" role="tablist">
          <li role="presentation" class="active"><a href="#Section2" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="true"><i class="hi-icon flaticon-cart-6"></i> Buy</a></li>
          <li role="presentation" class=""><a href="#Section3" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><i class="hi-icon flaticon-get-money"></i> Sell</a></li>
          <li role="presentation" class=""><a href="#Section4" aria-controls="delivery" role="tab" data-toggle="tab" aria-expanded="false"><i class="hi-icon flaticon-coins-1"></i> Delivery</a></li>
         <!--<li role="presentation" class=""><a href="#Section5" aria-controls="jeweller" role="tab" data-toggle="tab" aria-expanded="false"><i class="hi-icon fa fa-inr"></i> INR Deposit</a></li>-->
        </ul>
        <!-- Tab panes -->
        <div class="tab-content tabs">
          <div class="tranc-loader" data-loading="" style="display: none;"><div id="loader"></div></div>
         
          <div role="tabpanel" class="tab-pane fade active in" id="Section2">
            <div class="panel-group acc-transaction" id="buy-trac">
              <!-- ngRepeat: tx in buyTxs | orderBy:'-tx_id' -->
            </div>
            <!-- ngIf: !buyTxs.length -->
              <div class="add-box">
                <div class="table-responsive">
                      <table class="table table-bordered" id="trade_buy_history">
                          <thead>
                          <th>Sr. No</th>  
                          <th>Trade ID</th>
                          <th>Market Rate</th>
                         <th>Gold (gm)</th>
                         <th>GST Amount</th>
                         <th>Net Amount</th>
                         <th>Total  Amount</th>
                         <th>Order Type</th>
                         <th>Date</th>
                         <th>View PDF</th>
                         <th>Action</th>
                          </thead>   
                      </table>   
                  </div>
              </div>
          </div>
          <div role="tabpanel" class="tab-pane fade" id="Section3">
            <div class="panel-group acc-transaction" id="sell">
              <!-- ngRepeat: tx in sellTxs | orderBy:'-tx_id' -->
            </div>
           <div class="col-sm-12">
              <div class="add-box">
               <div class="table-responsive">
                      <table class="table table-bordered" id="trade_sell_history">
                          <thead>
                          <th>Sr. No</th>  
                          <th>Trade ID</th>
                          <th>Market Rate</th>
                         <th>Gold Amount(gm)</th>
                         <th>Total INR Amount</th>
                         <th>Created Date</th>
                         <th>Order Type</th>
                         <th>View PDF</th>
                         <th>Action</th>
                          </thead>   
                      </table>   
                  </div>
              </div>
            </div><!-- end ngIf: !sellTxs.length -->
          </div>
          <div role="tabpanel" class="tab-pane fade" id="Section4">
              <div class="col-md-12">
                 <div class="add-box">
               <div class="table-responsive">
                      <table class="table table-bordered" id="delivery_page_table">
                          <thead>
                         <th>Sr. No</th>  
                         <th>Order ID</th>
                         <th>Product Title</th>
                         <th>Gold Amount(gm)</th>
                         <th>Minting & GST Tax</th>
                         <th>Address Details</th>
                         <th>Status</th>
                         <th>Order Date</th>
                          </thead>   
                      </table>   
                  </div>
              </div>   
              </div>
          </div>
<div role="tabpanel" class="tab-pane fade" id="Section5">
            <div class="panel-group acc-transaction" id="sell">
              <!-- ngRepeat: tx in sellTxs | orderBy:'-tx_id' -->
            </div>
            <!-- ngIf: !sellTxs.length --><div class="col-sm-6 col-sm-offset-3 ng-scope" ng-if="!sellTxs.length">
              <div class="add-box">
                <h4 style="margin-top:100px;text-align:center">No Sell Transactions 5</h4>
              </div>
            </div><!-- end ngIf: !sellTxs.length -->
          </div>
                 
          

        </div>
      </div>
    </div>
  </div>
</section>