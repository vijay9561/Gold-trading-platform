<div class="small-header bg-img4 header_cover" style="background-position: 50% -8px;">
  <div class="container">
   <div class="row"><div class="col-xs-12 col-sm-6"><h2>My Deposit & Withdraw</h2></div> <div class="col-xs-12 col-sm-6"><div class="pull-right" style="margin-top:10px; font-weight:700"><a style="color:#ffe448" href="#">Deposit & Withdraw</a> / <a style="color:#ffe448" href="#">Quick Deposit</a></div></div></div>
  </div>
</div>
<section id="shop" class="section-small bg-gray ng-scope" ng-controller="TransactionCtrl">
  <div class="container">
            <?php if($this->session->userdata('message')) { ?>
            <div class="alert alert-success"><?php echo $this->session->userdata('message'); ?></div>
        <?php  $this->session->unset_userdata('message'); } ?>
      <div class="row">
          <div class="col-md-4">
                  <a href="#" data-toggle="modal" data-target="#Deposit_INR_Modal_NFT" class="btn btn-info">Make Deposit Via IMPS/NEFT</a>
          </div>  
          <div class="col-md-4">
               <a href="#" data-toggle="modal" data-target="#Deposit_INR_Modal" class="btn btn-primary">Make Deposit Via Online</a>
          </div>
          <div class="col-md-4">
               <a href="#" class="btn btn-dark" data-toggle="modal" data-target="#Withdraw_INR_Modal">Withdraw INR</a>
          </div>
      </div>
    <div class="row">
      <div class="tab" role="tabpanel"> 
        <!-- Nav tabs -->
        <ul id="mytrans" class="nav nav-tabs hi-icon-wrap hi-icon-effect-8" role="tablist">
          <li role="presentation" class="active"><a href="#Section2" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="true"><i class="hi-icon fa fa-inr"></i> Deposit INR History</a></li>
          <li role="presentation" class=""><a href="#Section3" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><i class="hi-icon flaticon-get-money"></i> Withdraw INR History</a></li>
         <!-- <li role="presentation" class=""><a href="#Section4" aria-controls="delivery" role="tab" data-toggle="tab" aria-expanded="false"><i class="hi-icon flaticon-coins-1"></i> Delivery</a></li>
         <li role="presentation" class=""><a href="#Section5" aria-controls="jeweller" role="tab" data-toggle="tab" aria-expanded="false"><i class="hi-icon fa fa-inr"></i> INR Deposit</a></li>-->
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
                      <table class="table table-bordered" id="deposit_INR_History">
                          <thead>
                          <th>Sr. No</th>  
                          <th>Payment ID</th>
                     
                         <th>Amount</th>
                          <th>Disapprove Note</th>
                         <th>Deposit Date</th>
                         <th>Payment Status</th>
                        <!-- <th>Action</th>-->
                          </thead>   
                      </table>   
                  </div>
              </div>
          </div>
          <div role="tabpanel" class="tab-pane fade" id="Section3">
            <div class="panel-group acc-transaction" id="sell">
              <!-- ngRepeat: tx in sellTxs | orderBy:'-tx_id' -->
            </div>
            <!-- ngIf: !sellTxs.length -->
              <div class="add-box">
               <div class="table-responsive">
                   <table class="table table-bordered" id="withdraws_historys" style="width:100%;">
                          <thead>
                         <th>Sr. No</th>  
                         <th>Request ID</th>
                         <th>Amount</th>
                         <th>Fees</th>
                         <th>Withdraw Date</th>
                         <th>Status</th>
                        <!-- <th>Action</th>-->
                          </thead>   
                      </table>   
                  </div>
              </div>
           <!-- end ngIf: !sellTxs.length -->
          </div>
          <div role="tabpanel" class="tab-pane fade" id="Section4">
            <div class="panel-group acc-transaction" id="del">
              <!-- ngRepeat: tx in redeemTxs | orderBy:'-tx_id' -->
            </div>
            <!-- ngIf: !redeemTxs.length --><div class="col-sm-6 col-sm-offset-3 ng-scope" ng-if="!redeemTxs.length">
              <div class="add-box">
                <h4 style="margin-top:100px;text-align:center">No Delivery Transactions 3</h4>
              </div>
            </div><!-- end ngIf: !redeemTxs.length -->
          </div>
<div role="tabpanel" class="tab-pane fade" id="Section5">
            <div class="panel-group acc-transaction" id="sell">
              <!-- ngRepeat: tx in sellTxs | orderBy:'-tx_id' -->
            </div>
            <!-- ngIf: !sellTxs.length --><div class="col-sm-6 col-sm-offset-3 ng-scope" ng-if="!sellTxs.length">
              <div class="add-box">
                
              </div>
            </div><!-- end ngIf: !sellTxs.length -->
          </div>
                 
          

        </div>
      </div>
    </div>
  </div>
</section>

 <div class="modal fade" id="Deposit_INR_Modal"  role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Deposit Your INR</h4>
        </div>
        <div class="modal-body">
            <div class="alert alert-danger" id="error_INR_calculator" style="display:none;"></div>
            <form method="post" id="deposit_inr_forms">
                <div class="form-group">
                    <input type="text" class="form-control" id="amountRs_buy" placeholder="Please enter Amount" name="amountRs_buy">
                </div>
                <div class="form-group">
                    <input type="submit" id="INR_submit_button" class="btn btn-primary" value="Deposit INR">   
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


<!--Withdraw Trade History-->

<div class="modal fade" id="Withdraw_INR_Modal"  role="dialog">
    <div class="modal-dialog">
    <?php
   $userid=$this->session->userdata('USERID'); 
    $USERS_BALANCE=$this->db->query("select *from USERS_BALANCE where  USERID='$userid'")->row();
    ?>
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Withdraw Your INR</h4>
        </div>
        <div class="modal-body">
            <div class="alert alert-danger" id="error_withdraw_calculator" style="display:none;"></div>
            <form method="post" id="witdraw_inr_forms">
                <p class="wallets_csss"><?php echo $USERS_BALANCE->INR_BALANCE; ?><br><b>INR Wallet</b></p> 
                <div class="form-group">
                    <input type="text" class="form-control" id="AMOUNT" placeholder="Please enter Amount" name="AMOUNT">
                </div>
                <div class="form-group">
                    <input type="submit" id="widthdraw_submit_button_inr" class="btn btn-primary" value="Withdraw INR">   
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


 <div class="modal fade" id="Deposit_INR_Modal_NFT"  role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Deposit Your INR</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <table  class="table table-bordered">
                        <thead>
                            <tr><th colspan="2" align="center">Suvarnasiddhi Bank Details</th></tr>
                            <tr><th>Beneficiary:</th><td>SUVARNASANKALP PRIVATE LIMITED</td></tr>  
                             <tr><th>Bank:</th><td> AXIS BANK</td></tr> 
                            <tr><th>Account Number:</th><td>919020035457830</td></tr>
                             <tr><th>IFSC Code:</th><td>UTIB0003831</td></tr>
                            
                        </thead>   
                    </table>   
                </div>    
            </div>
            <div class="alert alert-danger" id="error_INR_calculator_NFT" style="display:none;"></div>
            <form method="post" id="deposit_inr_forms_NFT">
                  <div class="form-group">
                    <input type="text" class="form-control" id="TRANACTION_ID_NFT" placeholder="TXN Ref" name="TRANACTION_ID_NFT">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="AMOUNT_NFT" placeholder="Amount In INR" name="AMOUNT_NFT">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="CRATED_DATE_NFT" placeholder="Date" name="CRATED_DATE_NFT">
                </div>
                <div class="form-group">
                    <input type="submit" id="INR_submit_button_NFT" class="btn btn-primary" value="Deposit INR">   
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>