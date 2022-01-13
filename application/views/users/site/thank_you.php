<section id="conf" class="section bg-dark2 ng-scope header_cover" ng-controller="GoldPurchaseCtrl">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
       <?php if($status=='Completed'){ ?>
        <h3 class="text-center">INR Deposited Success</h3>
       <?php }else{ ?>
      <h3 class="text-center">INR Deposited Faild</h3>   
       <?php } ?> 
           <?php if($status=='Completed'){ ?>
     <div class="swal-icon swal-icon--success">
    <span class="swal-icon--success__line swal-icon--success__line--long"></span>
    <span class="swal-icon--success__line swal-icon--success__line--tip"></span>

    <div class="swal-icon--success__ring"></div>
    <div class="swal-icon--success__hide-corners"></div>
  </div>
     <?php }else{ ?>
    <div class="swal-icon swal-icon--error">
    <div class="swal-icon--error__x-mark">
      <span class="swal-icon--error__line swal-icon--error__line--left"></span>
      <span class="swal-icon--error__line swal-icon--error__line--right"></span>
    </div>
  </div>
     <?php } ?>
        
        <table class="table" style="border:  1px solid;">
          <thead>
            <tr>
              <th colspan="3" class="bg-dark" style="text-align:center"><h4 style="margin-bottom:0px">Transaction Details</h4></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><strong>TXTID</strong></td>
              <td style="text-align:center">:</td>
              <td><?php echo $payment_id; ?></td>
            </tr>
            <tr>
              <td><strong>Payment Status</strong></td>
              <td style="text-align:center">:</td>
              <td><?php echo $status; ?></td>
            </tr>
            <tr>
              <td class="bg-dark"><h5 style="margin-bottom:0px">Total amount</h5></td>
              <td class=" bg-dark" style="text-align:center">:</td>
              <td class="ng-binding bg-dark"><h5 style="margin-bottom:0px"><?php echo $amount; ?></h5></td>
            </tr>
          </tbody>
        </table>
        <br>
        <div class="text-center">
            <a href="<?php echo site_url(); ?>deposit-and-withdraw" class="btn btn-gold btn-lg" id="buy_gold_continue">Clik Here To Confirm Deposit</a>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
</section>