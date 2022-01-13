<!--<div class="web-banner">
<div data-background="assets/images/caratlane/white-bg2.jpg" class="sections intro banner">
<div class="container text-center">
<a href="caratlane.html"> <img src="assets/images/caratlane/safegold-caratlane-banner.png" class="hidden-xs"> <img src="assets/images/caratlane/safegold-caratlane-banner-mobile.png" class="img-responsive visible-xs"></a><br>
</div> </div>
</div>-->
<style>
    .nav-tabs>li>a {
    margin-right: 24px;}
</style>
<header    id="banner" class="intro bg-dark header_cover">
  <!-- Intro Header-->
  <div class="container">
    <!-- Intro Header-->

    <div class="banner-content">
      <div class="row">
        <div class="banner-title text-center">
          <h1 data-wow-delay=".4s" class="wow fadeInDown" style="margin-bottom:5px;">Limit Order Gold Buy Sell <i class="fa fa-inr"></i> 1. </h1>
          <h3 class="wow fadeInUp">A safe and simple way to accumulate gold.</h3>
        </div>
        <div class="col-md-6 col-md-offset-0 col-sm-10 col-sm-offset-0">
              <?php if($this->session->userdata('message')) { ?>
            <div class="alert alert-success"><?php echo $this->session->userdata('message'); ?></div>
            <?php  $this->session->unset_userdata('message'); } ?>
          <div class="buy-sell-box text-center"> 
            <!-- Nav tabs-->
            <div align="center" style="margin-left: 133px;">
            <ul role="tablist" id="mytrans" class=" side-box nav nav-tabs hi-icon-wrap hi-icon-effect-8">
                <li role="presentation" class="active"><a href="#"  id="buy_anchor" aria-controls="buy" role="tab" data-toggle="tab"> <span class="hi-icon flaticon-cart-6"></span> <br>
                Buy Limit</a></li>
                <li role="presentation"><a aria-controls="sell" role="tab" id="sell_anchor" data-toggle="tab" href="#"><span class="hi-icon flaticon-get-money"></span><br>
                Sell Limit</a></li>
            </ul>
            </div>
            <!-- Tab panes-->
            <div class="tab-content">
                  <?php $site=$this->site->get_live_glod_rate();   $buy = $site['gram_rate'];  $sell = $site['sell']; ?>
              <div id="buy" role="tabpanel" class="tab-pane fade in active">
                   <?php if($this->session->userdata('USERID')){  $id=$this->session->userdata('USERID');
                        $id=$this->db->query("select *from USERS_BALANCE where USERID='$id'")->row();
                       ?> 
                  <div class="otter-box">
               
                 <div class="bal col-md-6">
                  <h5 style="display:inline" class="ng-binding"><span class="fa fa-inr"></span> <?php echo $id->INR_BALANCE; ?> INR </h5>
                  <small style="display:block"> Your INR Balance </small> 
                </div>
               <div class="bal col-md-6">
                  <h5 style="display:inline" class="ng-binding"><?php echo $id->GOLD_BALANCE; ?> gm </h5>
                  <small style="display:block"> Your Gold Balance </small> 
                </div>
                <div class="clearfix"></div>
              </div>
                  <!--<div class="col-md-12">
                    GST 3% Percent  
                </div>-->
                   <?php } ?>
                  <form class="dark-form" id="buy_glod_trade_limit" method="post">
                <div class="row">
                  <div class="col-sm-4"> 
                    <div class="form-group floating-label-form-group controls">
                      <label>Limit Buy Price </label>
                      <input type="text" name="Base_buy_Amount" value="<?php echo $buy; ?>" autocomplete="off" id="Base_buy_Amount" onkeyup="getequivalentto_Buy_Limit('BASE')" onmouseup="getequivalentto_Buy_Limit('BASE')" class="form-control input-lg number" placeholder="Price (INR)" numbers-only required id="buy_amount_in_rs">
                      </span> </div>
                  </div>
                 <div class="col-sm-4"> 
                    <div class="form-group floating-label-form-group controls">
                      <label>Buy in gram Limit </label>
                      <input type="text" name="Buy_weight_Gold" autocomplete="off" id="Buy_weight_Gold" onkeyup="getequivalentto_Buy_Limit('GOLD')" onmouseup="getequivalentto_Buy_Limit('GOLD')" class="form-control input-lg number" placeholder="Buy in gram" numbers-only required id="buy_amount_in_rs">
                      </span> </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="control-group">
                      <div class="form-group floating-label-form-group controls">
                        <label>Total INR Limit</label>
                        <input type="text" name="Buy_Total_INR" autocomplete="off" id="Buy_Total_INR" onkeyup="getequivalentto_Buy_Limit('INR')" onmouseup="getequivalentto_Buy_Limit('INR')" class="form-control input-lg number" placeholder="Total INR" float-only-for-gm required id="buy_amount_in_gm">
                       
                      </div>
                    </div>
                  </div>
                    <span class="text-danger" id="error_INR_calculator_buy"></span>
                </div>
                <div class="control-group"> </div>
               <?php if($this->session->userdata('USERID')){ ?>
                <button type="submit"   class="btn btn-lg btn-gold"  id="buy_submit_form_gold">Buy Place Order</button>
               <?php }else{ ?>
                <a href="<?php echo site_url(); ?>login"   class="btn btn-lg btn-gold">Buy Place Order</a>
               <?php } ?>
              </form>
              </div>
              <div id="sell" role="tabpanel" class="tab-pane fade in">
                        <?php if($this->session->userdata('USERID')){  $id=$this->session->userdata('USERID');
                        $id=$this->db->query("select *from USERS_BALANCE where USERID='$id'")->row();
                       ?> 
                  <div class="otter-box">
               
                 <div class="bal col-md-6">
                  <h5 style="display:inline" class="ng-binding"><span class="fa fa-inr"></span> <?php echo $id->INR_BALANCE; ?> INR </h5>
                  <small style="display:block"> Your INR Balance </small> 
                </div>
               <div class="bal col-md-6">
                  <h5 style="display:inline" class="ng-binding"><?php echo $id->GOLD_BALANCE; ?> gm </h5>
                  <small style="display:block"> Your Gold Balance </small> 
                </div>
                <div class="clearfix"></div>
               
              </div>
                   <?php } ?>
                <form class="dark-form" id="sell_glod_trade_limit" method="post">
                <div class="row">
                  <div class="col-sm-4"> 
                    <div class="form-group floating-label-form-group controls">
                      <label>Price INR <span class="fa fa-inr"></span></label>
                      <input type="text" name="Base_sell_Amount" value="<?php echo $sell; ?>" autocomplete="off" id="Base_sell_Amount" onkeyup="getequivalentto_Sell_Limit('BASE')" onmouseup="getequivalentto_Buy('BASE')" class="form-control input-lg number" placeholder="Price (INR)" numbers-only required id="buy_amount_in_rs">
                      </span> </div>
                  </div>
                 <div class="col-sm-4"> 
                    <div class="form-group floating-label-form-group controls">
                      <label>Sell in gram </label>
                      <input type="text" name="Sell_weight_Gold" autocomplete="off" id="Sell_weight_Gold" onkeyup="getequivalentto_Sell_Limit('GOLD')" onmouseup="getequivalentto_Sell('GOLD')" class="form-control input-lg number" placeholder="Sell in gram" numbers-only required id="buy_amount_in_rs">
                      </span> </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="control-group">
                      <div class="form-group floating-label-form-group controls">
                        <label>Total INR</label>
                        <input type="text" name="Sell_Total_INR" autocomplete="off" id="Sell_Total_INR" onkeyup="getequivalentto_Sell_Limit('INR')" onmouseup="getequivalentto_Sell('INR')" class="form-control input-lg number" placeholder="Total INR" float-only-for-gm required id="buy_amount_in_gm">
                       
                      </div>
                    </div>
                  </div>
                    <span class="text-danger" id="error_INR_calculator_sell"></span>
                </div>
                <div class="control-group"> </div>
               <?php if($this->session->userdata('USERID')){ ?>
                <button type="submit"   class="btn btn-lg btn-gold"  id="sell_submit_form_gold">Sell Place Order</button>
               <?php }else{ ?>
                <a href="<?php echo site_url(); ?>login"   class="btn btn-lg btn-gold">Sell Place Order</a>
               <?php } ?>
              </form>
              </div>
              <div id="delivery" role="tabpanel" class="tab-pane fade in">
                    <div class="otter-box">
                    
                <div class="current-price"> <span class="fa fa-inr"></span>
                  <h5 style="display:inline" class="ng-binding"><?php echo $buy; ?>/gm</h5>
                  <small style="display:block"> Gold Buy Price</small> 
                </div>
                <!--<div class="bal">
                  <h5 style="display:inline" class="ng-binding">0.0000 gm </h5>
                  <small style="display:block"> Your Gold Balance </small> 
                </div>-->
                <div class="clearfix"></div>
              </div>
                <form name="sellGoldForm" class="dark-form">
                <div class="row">
                  <div class="col-sm-5">
                    <div class="form-group floating-label-form-group controls">
                      <label>Delivery in <span class="fa fa-inr"></span></label>
                      <input type="text" name="amountRs_Delivery" id="amountRs_Delivery" onkeyup="getequivalentto_delivery('INR')" onmouseup="getequivalentto_delivery('INR')" class="form-control input-lg" placeholder="Enter Rs." numbers-only required>
                      </span> </div>
                  </div>
                  <div class="col-sm-2">
                    <p class="or">OR</p>
                  </div>
                  <div class="col-sm-5">
                    <div class="control-group">
                      <div class="form-group floating-label-form-group controls">
                        <label>Delivery in gram</label>
                        <input type="text" name="amountGm_Delivery" id="amountGm_Delivery" onkeyup="getequivalentto_delivery('GOLD')" onmouseup="getequivalentto_delivery('GOLD')" class="form-control input-lg" placeholder="Enter gram " float-only-for-gm required>
                       
                      </div>
                    </div>
                  </div>
                    <span class="text-danger" id="error_Delivery_calculator"></span>
                </div>
                <div class="control-group"> </div>
                <button type="submit" class="btn btn-lg btn-gold" id="sell_submit_form">Delivery Now</button>
              </form>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-md-offset-0 col-sm-12">
          <div id="Carousel-intro" data-ride="carousel" class=" carousel slide carousel-fade">
            <!-- <ol class="carousel-indicators">
            <li data-target="#Carousel-intro" data-slide-to="0" class="active"></li>
          </ol>-->
            <div class="carousel-inner">
              <div class="item active">
                <div class="row hi-icon-wrap hi-icon-effect-2 hi-icon-effect-2a feature-icon-container">
                  <!--<div class=" col-xs-12  col-md-1 col-sm-1"> <span data-wow-delay=".4s"  class=" wow fadeInLeft hi-icon big-icon flaticon-rich"></span></div>
                  <!--<div class=" col-xs-12  col-md-11 col-sm-5">
                    <div  data-wow-delay=".4s" class="wow fadeInLeft feature-text feature-icon-box">
                      <h5>Trusted</h5>
                      <p>We’ve partnered with IDBI Trusteeship Services, so you can be sure that we will always keep your interest at heart. </p>
                    </div>
                  </div>-->
                  <div class="col-xs-12  col-md-1 col-sm-1"><span  data-wow-delay=".6s"  class=" wow fadeInLeft  hi-icon   big-icon flaticon-safebox-3"></span></div>
                  <div class="col-xs-12  col-md-11 col-sm-5">
                    <div  data-wow-delay=".6s" class="wow fadeInLeft feature-text feature-icon-box">
                      <h5>Safe</h5>
                      <p>All our gold is safely stored in a Brink’s vault - the global leaders in gold custody services.</p>
                    </div>
                  </div>
                    <div class="clearfix"></div>
                  <div class="col-xs-12  col-md-1 col-sm-1"><span  data-wow-delay=".8s"  class=" wow fadeInLeft  hi-icon  big-icon flaticon-money"></span></div>
                  <div class="col-xs-12  col-md-11 col-sm-5">
                    <div  data-wow-delay=".8s" class="wow fadeInLeft feature-text feature-icon-box">
                      <h5>Liquid</h5>
                      <p>Sell your gold with one click, from anywhere and at anytime. </p>
                    </div>
                  </div>
                  <div class="col-xs-12  col-md-1 col-sm-1"><span  data-wow-delay="1s"  class=" wow fadeInLeft  hi-icon  big-icon flaticon-delivery-cart-1"></span></div>
                  <div class="col-xs-12  col-md-11 col-sm-5">
                    <div  data-wow-delay="1s" class="wow fadeInLeft feature-text feature-icon-box">
                      <h5>Deliverable</h5>
                      <p>Have your gold delivered to your doorstep with full insurance cover, whenever you choose. </p>
                    </div>
                  </div>
                </div>
              </div>
              
              <!-- Controls--><!--<a href="#Carousel-intro" data-slide="prev" class="left carousel-control"><span class="glyphicon glyphicon-chevron-left"></span></a><a href="index.html#Carousel-intro" data-slide="next" class="right carousel-control"><span class="glyphicon glyphicon-chevron-right"></span></a>--> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
<div class="clearfix"></div>
