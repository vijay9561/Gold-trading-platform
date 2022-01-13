<header id="banner" class="intro bg-dark header_cover">
  <!-- Intro Header-->
  <div class="container">
    <!-- Intro Header-->

    <div class="banner-content">
      <div class="row">
        <div class="banner-title text-center">
          <h1 data-wow-delay=".4s" class="wow fadeInDown" style="margin-bottom:5px;">Buy gold as low as <i class="fa fa-inr"></i> 1. </h1>
          <h3 class="wow fadeInUp">A safe and simple way to accumulate gold.</h3>
        </div>
        <div class="col-md-6 col-md-offset-0 col-sm-10 col-sm-offset-0">
              <?php if($this->session->userdata('message')) { ?>
            <div class="alert alert-success"><?php echo $this->session->userdata('message'); ?></div>
            <?php  $this->session->unset_userdata('message'); } ?>
          <div class="buy-sell-box text-center"> 
            <!-- Nav tabs-->
            <ul role="tablist" id="mytrans" class=" side-box nav nav-tabs hi-icon-wrap hi-icon-effect-8">
                <li role="presentation" class="active"><a href="#"  id="buy_anchor" aria-controls="buy" role="tab" data-toggle="tab"> <span class="hi-icon flaticon-cart-6"></span> <br>
                Buy</a></li>
                <li role="presentation"><a aria-controls="sell" role="tab" id="sell_anchor" data-toggle="tab" href="#"><span class="hi-icon flaticon-get-money"></span><br>
                Sell</a></li>
               <?php if($this->session->userdata('USERID')){ ?>
                <li role="presentation"><a aria-controls="delivery" role="tab"  id="delivery_anchor"  href="<?php echo site_url(); ?>Delivery"><span class="hi-icon flaticon-coins-1"></span><br>
                Delivery</a></li>
               <?php }else{ ?>
               <li role="presentation"><a aria-controls="delivery" role="tab"  id="delivery_anchor"  href="<?php echo site_url(); ?>login"><span class="hi-icon flaticon-coins-1"></span><br>
                Delivery</a></li> 
               <?php } ?>
                <li role="presentation"><a aria-controls="trade" role="tab" href="<?php echo site_url(); ?>Limit_Trade"><span class="hi-icon fa fa-list"></span><br>
                Trade</a></li>
               <?php if($this->session->userdata('USERID')){ ?>
                 <li role="presentation"><a aria-controls="trade" role="tab" href="#" data-toggle="modal" data-target="#fixed_deposit"><span class="hi-icon fa fa-money"></span><br>
                Fixed Deposit</a></li>     
               <?php } ?>
            </ul>
            <!-- Tab panes-->
            <div class="tab-content">
                  <?php $site=$this->site->get_live_glod_rate();   $buy = $site['gram_rate']; ?>
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
                 <!-- <div class="col-md-12">
                    GST 3% Percent  
                </div>-->
                   <?php } ?>
                  <form class="dark-form" id="buy_glod_trade" method="post">
                <div class="row">
                 <div class="col-sm-6"> 
                    <div class="form-group floating-label-form-group controls">
                      <label>Buy in gram </label>
                      <input type="text" name="Buy_weight_Gold" autocomplete="off" id="Buy_weight_Gold" onkeyup="getequivalentto_Buy('GOLD')" onmouseup="getequivalentto_Buy('GOLD')" class="form-control input-lg number" placeholder="Buy in gram" numbers-only required id="buy_amount_in_rs">
                      </span> </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="control-group">
                      <div class="form-group floating-label-form-group controls">
                        <label>Total INR</label>
                        <input type="text" name="Buy_Total_INR" autocomplete="off" id="Buy_Total_INR" onkeyup="getequivalentto_Buy('INR')" onmouseup="getequivalentto_Buy('INR')" class="form-control input-lg number" placeholder="Total INR" float-only-for-gm required id="buy_amount_in_gm">
                      </div>
                    </div>
                  </div>
                    <span class="text-danger" id="error_INR_calculator_buy"></span>
                </div>
                <div class="control-group"> </div>
               <?php if($this->session->userdata('USERID')){ ?>
                <button type="submit"   class="btn btn-lg btn-gold"  id="buy_submit_form_gold">Buy Now</button>
               <?php }else{ ?>
                <a href="<?php echo site_url(); ?>login"   class="btn btn-lg btn-gold">Buy Now</a>
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
                <form class="dark-form" id="sell_glod_trade" method="post">
                <div class="row">
                  
                 <div class="col-sm-6"> 
                    <div class="form-group floating-label-form-group controls">
                      <label>Sell in gram </label>
                      <input type="text" name="Sell_weight_Gold" autocomplete="off" id="Sell_weight_Gold" onkeyup="getequivalentto_Sell('GOLD')" onmouseup="getequivalentto_Sell('GOLD')" class="form-control input-lg number" placeholder="Sell in gram" numbers-only required id="buy_amount_in_rs">
                      </span> </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="control-group">
                      <div class="form-group floating-label-form-group controls">
                        <label>Total INR</label>
                        <input type="text" name="Sell_Total_INR" autocomplete="off" id="Sell_Total_INR" onkeyup="getequivalentto_Sell('INR')" onmouseup="getequivalentto_Sell('INR')" class="form-control input-lg number" placeholder="Total INR" float-only-for-gm required id="buy_amount_in_gm">
                      </div>
                    </div>
                  </div>
                    <span class="text-danger" id="error_INR_calculator_sell"></span>
                </div>
                <div class="control-group"> </div>
               <?php if($this->session->userdata('USERID')){ ?>
                <button type="submit"   class="btn btn-lg btn-gold"  id="sell_submit_form_gold">Sell Now</button>
               <?php }else{ ?>
                <a href="<?php echo site_url(); ?>login"   class="btn btn-lg btn-gold">Sell Now</a>
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

<section id="who-we-are" class="section bg-dark2">
  <div class="container">
    <div class="row">
      <div  data-wow-delay=".2s"  class="col-md-12 text-center wow fadeInUp">
        <h2 class="no-pad">VAULT STORED GOLD YOU CAN BUY, SELL AND UTILISE</h2>
        <h4>It’s simple. We want to help you get the most out of gold. All through the click of a button.</h4>
        <br>
        <a href="#" class="btn btn-gold">Read More</a></div>
      <div data-wow-duration="2s" data-wow-delay=".2s" class="col-lg-5 col-lg-offset-1 wow zoomIn"> </div>
    </div>
  </div>
</section>

<!-- Slider-->
<section class="bg-img2" id="how-to-works">
  <div class="overlay"></div>
  <div class="container">
    <h3 class="no-pad">How It Works</h3>
    <div class="row">
      <div class="col-sm-5">
        <div class="work-banner hidden-xs">
          <h2 class="no-pad wow fadeInLeft"  data-wow-delay=".4s" >Buy Gold.</h2>
        </div>
      </div>
      <div class="col-sm-6 col-sm-offset-1">
        <div class="hi-icon-wrap hi-icon-effect-8 how-it-works-icon"  style="padding-top:0px">
          <div class="how-it-works">
            <div class="col-xs-12  col-sm-2 col-md-1"> <span data-wow-delay=".4s"  class=" wow fadeInLeft hi-icon big-icon flaticon-rich"></span></div>
            <div class="col-xs-12  col-sm-10 col-md-11">
              <div  data-wow-delay=".4s" class="wow feature-text fadeInLeft feature-icon-box">
                <h5 style="color:white">BUY</h5>
                <p>Buy 24K gold starting from ₹1. </p>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-5">
        <div class="work-banner hidden-xs">
          <h2 class="no-pad wow fadeInLeft"  data-wow-delay=".6s" style="color: #a2a2a2;">Sell Gold.</h2>
        </div>
      </div>
      <div class="col-sm-6 col-sm-offset-1">
        <div class="hi-icon-wrap hi-icon-effect-8 how-it-works-icon"  style="padding-top:0px">
          <div class="how-it-works">
            <div class="col-xs-12  col-sm-2 col-md-1"><span  data-wow-delay=".6s"  class=" wow fadeInLeft  hi-icon   big-icon flaticon-safebox-3"></span></div>
            <div class="col-xs-12  col-sm-10 col-md-11">
              <div  data-wow-delay=".6s" class="wow fadeInLeft feature-text feature-icon-box">
                <h5 style="color: #a2a2a2;">SELL </h5>
                <p>Sell as much or as little of your gold at anytime, from anywhere.</p>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-5">
        <div class="work-banner hidden-xs">
          <h2 class="no-pad wow fadeInLeft"  data-wow-delay=".8s" style="color: rgba(254, 227, 72, 0.52);">Get it Delivered.</h2>
        </div>
      </div>
      <div class="col-sm-6 col-sm-offset-1">
        <div class="hi-icon-wrap hi-icon-effect-8 how-it-works-icon"  style="padding-top:0px">
          <div class="how-it-works">
            <div class="col-xs-12  col-sm-2 col-md-1"><span  data-wow-delay=".8s"  class=" wow fadeInLeft  hi-icon  big-icon flaticon-money"></span></div>
            <div class="col-xs-12  col-sm-10 col-md-11">
              <div  data-wow-delay=".8s" class="wow fadeInLeft feature-text feature-icon-box">
                <h5 style="color: rgba(254, 227, 72, 0.52);">DELIVER </h5>
                <p>Take delivery at your doorstep from as little as 1 gram. </p>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
        <br>
        <a href="#" class="btn btn-gold">Find Out More</a> </div>
    </div>
  </div>
</section>

<!-- faq-->
<section id="faq" class="bg-dark2">
  <div class="container">
    <div class="row wow fadeIn">
      <h3 class="text-center">FAQ's</h3>
      <div class="col-md-8 col-md-offset-2">
        <div id="accordion" role="tablist" aria-multiselectable="true" class="panel-group">
          <div class="panel panel-default">
            <div id="headingOne" role="tab" class="panel-heading bg-dark">
              <h4 class="panel-title"><a role="button" data-toggle="collapse" data-parent="#accordion" href="index.html#collapseOne1" aria-expanded="true" aria-controls="collapseOne1">What is Suvarna Siddhi?</a></h4>
            </div>
            <div id="collapseOne1" role="tabpanel" aria-labelledby="headingOne" class="panel-collapse collapse in">
              <div class="panel-body bg-dark3">Suvarna Siddhi is an organised and transparent method of buying 24 carat gold in compliance with all applicable laws and regulations. Suvarna Siddhi is neither a financial product nor a deposit but a method of purchasing gold for the personal needs of the customer. Customer can buy the gold under this plan according to his wish. The customer has complete freedom to seek physical delivery of gold or bars anytime and on as many occasions as (s)he wants. Since it is not physically possible to deliver a fractional quantity of gold, minimum quantity for which the delivery is proposed to be made has been kept as low as 1 gram and in multiples of 1 gram. The gold on behalf of the customer would be purchased including GST as and when his/her clear funds are available. Gold in grams up to 4 decimal places shall be credited to the customer's account on receipt of funds.<br>
                <a href="faq.html">Read More</a></div>
            </div>
          </div>
          <div class="panel panel-default">
            <div id="headingOne1" role="tab" class="panel-heading bg-dark">
              <h4 class="panel-title"><a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne2" aria-expanded="true" aria-controls="collapseOne2">Is the gold associated with my accumulations kept in safe custody?</a></h4>
            </div>
            <div id="collapseOne2" role="tabpanel" aria-labelledby="headingOne1" class="panel-collapse collapse">
              <div class="panel-body bg-dark3">The gold purchased on behalf of the customer shall be stored with a reputed custodian on a consolidated basis i.e. daily purchase across all the customers. An independent auditor/ trustee will confirm the balances with the custodian each quarter and reconcile the amounts with customer balances. </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div id="headingOne2" role="tab" class="panel-heading bg-dark">
              <h4 class="panel-title"><a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne3" aria-expanded="true" aria-controls="collapseOne3">Where can I find the invoice for each order?</a></h4>
            </div>
            <div id="collapseOne3" role="tabpanel" aria-labelledby="headingOne2" class="panel-collapse collapse ">
              <div class="panel-body bg-dark3">An invoice is emailed to the customer after each transaction. It is also available in the order history section on the Company's website as well as the distributor platform.</div>
            </div>
          </div>
          <div class="panel panel-default">
            <div id="headingOne3" role="tab" class="panel-heading bg-dark">
              <h4 class="panel-title"><a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne4" aria-expanded="true" aria-controls="collapseOne4">How do I sell my gold?</a></h4>
            </div>
            <div id="collapseOne4" role="tabpanel" aria-labelledby="headingOne3" class="panel-collapse collapse ">
              <div class="panel-body bg-dark3">The Company will provide a sell price quote on its website as well as distributor platforms. Customers can choose to sell any amount starting with a minimum of Re. 1 to a maximum of the amount of gold that they own. Proceeds will be sent within 2 days to the customer's bank account after deducting any applicable transaction charges(which will be disclosed in advance). The sell quote may be temporarily unavailable in the unlikely event of a disruption in the bullion market.</div>
            </div>
          </div>
        </div>
          <div class="text-center"> <a href="<?php echo site_url(); ?>faq" class="btn btn-gold-border btn-lg">View All</a></div>
      </div>
    </div>
  </div>
</section>

<!-- Contact Section-->
<!--<section id="contact" class="bg-img5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-5">
        <h3>Contact Us</h3>
        <h4 style="margin-bottom:0px">Retail Outlet Address</h4>
        <h5><i class="fa fa-map-marker fa-fw fa-lg"></i>Shop No 3 Vora Ashish Building, 
          Pandit Solicitor Road, Malad East, 
          Opp Anandpara Hospital, 
          Mumbai-400097<br>
          <a class="btn btn-gold-border" href="https://goo.gl/maps/DcvijCPKz8z" target="_blank" >View on map</a> </h5>
        <h5 style="text-transform:lowercase"><i class="fa fa-envelope fa-fw fa-lg"></i> <a href="mailto:care@safegold.in">care@safegold.in</a> </h5>
        <h5><i class="fa fa-phone fa-fw fa-lg"></i> 888 1000 800 </h5>
      </div>
      <div class="col-md-5 col-md-offset-2">
        <h3>Write To Us</h3>
        
      
        <form  action="/contact-us" name="sentMessage" method="POST" novalidate class="dark-form">
                              <input type="hidden" name="csrf" value= />
          <div class="row">
            <div class="col-sm-6 col-xs-12 col-md-12">
              <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                  <label for="name" class="sr-only control-label">Name</label>
                  <input id="name" name="name" type="text" placeholder="Name*" required="" data-validation-required-message="Please enter name" class="form-control input-lg">
                  <span class="help-block text-danger"></span> </div>
              </div>
              <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                  <label for="email" class="sr-only control-label">Email</label>
                  <input id="email" name="email" type="email" placeholder="Email*" required data-validation-required-message="Please enter email" class="form-control input-lg">
                  <span class="help-block text-danger"></span> </div>
              </div>
              <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                  <label for="phone_no" class="sr-only control-label">Phone</label>
                  <input id="phone_no" name="phone_no" type="number" placeholder="Phone" class="form-control input-lg">
                  <span class="help-block text-danger"></span> </div>
              </div>
            </div>
            <div class="col-sm-6 col-xs-12 col-md-12">
              <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                  <label for="message" class="sr-only control-label">Message</label>
                  <textarea id="message" name="message" rows="3" placeholder="Message" aria-invalid="false" class="form-control input-lg"></textarea>
                  <span class="help-block text-danger"></span> </div>
              </div>
            </div>
          </div>
          <div id="success"></div>
          <button type="submit" class="btn btn-lg btn-gold">Send</button>
        </form>
      </div>
    </div>
  </div>
</section>-->


