<div class="small-header bg-img4" style="padding-top: 6em; background-position: 50% 0px;">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h2 style="margin-bottom:15px">Delivery</h2>
      </div>
    </div>
  </div>
</div>
<section id="product-shop" class="section-small bg-gray2 ng-scope" ng-controller="RedeemGoldCtrl">
  <div class="container text-center">
        <div class="row grid-pad">
      <!-- ngRepeat: product in products -->
    <?php if(count($Delivery)>=1){
          foreach($Delivery as $row){
              $pid=$row->ID;
           $product_images=$this->db->query("select *from product_images where pid='$pid' order by piid asc")->row();   
        ?>
      <div class="col-lg-3 col-sm-6 col-md-4 col-xs-6 ng-scope" ng-repeat="product in products">
         <div class="shop-item">
              <div class="badge price ng-binding">Minting Charge  Rs. <?php echo $row->GOLD_Minting_Charges; ?>
             </div>
             <div class="badge price"></div>
             <a href="<?php echo site_url(); ?>Delivery-Details?delivery=<?php echo base64_encode($row->ID); ?>"><img width="300" src="<?php echo base_url(); ?>assets/gold/<?php echo $product_images->product_path; ?>" id="16_coin_img" alt="" class="img-responsive center-block"></a>
          </div>
             <a href="<?php echo site_url(); ?>Delivery-Details?delivery=<?php echo base64_encode($row->ID); ?>"> <h5 class="ng-binding"><?php echo $row->GLOD_TITLE; ?></h5></a>
             
         </div><!-- end ngRepeat: product in products -->
          <?php  } }else{ ?> 
    <?php } ?>    
  </div>
</div>
</section>