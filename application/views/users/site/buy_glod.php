<section id="conf" class="section bg-dark2 ng-scope" ng-controller="GoldPurchaseCtrl">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <h3 class="text-center">Confirm Deposit INR </h3>
       
        <table class="table" style="    border:  1px solid;">
          <thead>
            <tr>
              <th colspan="3" class="bg-dark" style="text-align:center"><h4 style="margin-bottom:0px">Transaction Details</h4></th>
            </tr>
          </thead>
          <tbody> 
            
            <tr>
              <td><strong>Net purchase amount</strong></td>
              <td style="text-align:center">:</td>
                            <td><?php echo $this->session->userdata('NETBUYPURCHASE'); ?></td>
            </tr>
            <tr>
              <td class="bg-dark"><h5 style="margin-bottom:0px">Total purchase amount</h5></td>
              <td class=" bg-dark" style="text-align:center">:</td>
              <td class="ng-binding bg-dark"><h5 style="margin-bottom:0px"><?php echo $this->session->userdata('NETBUYPURCHASE'); ?></h5></td>
            </tr>
          </tbody>
        </table>
        <br>
        <div class="text-center">
            <a  href="<?php echo site_url(); ?>procced_gold_buy_payment" class="btn btn-gold btn-lg" id="buy_gold_continue">Continue</a>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
</section>