<style>
    .panel-primary>.panel-heading {
        color: #fff;
        background-color: #202121;
        border-color: #8a8a8a;
    }
    .panel-primary {
        border-color: #828588;
    }
</style>
<section id="shop" class="section bg-gray2 ng-scope">
    <?php
    $id = $Delivery->ID;
    $product_images = $this->db->query("select *from product_images where pid='$id' order by piid asc")->row();
    ?>   
    <div class="container">
        <div class="row"> 
            <!-- shop carousel-->
            <div id="carousel-shop" class="carousel slide">
                <div class="col-sm-5 carousel-outer"> 
                    <!-- Wrapper for slides-->
                    <div class="carousel-inner">
                        <?php $counter = 1;
                        foreach ($product_images as $row) { ?>
                            <div class="item <?php if ($counter <= 1) {
                            echo " active";
                        } ?>"><img alt="" src="<?php echo base_url(); ?>assets/gold/<?php echo $product_images->product_path; ?>"></div>
                            <?php $counter++;
                        } ?>
                    </div>
                    <!-- Controls--><a href="#carousel-shop" data-slide="prev" class="left carousel-control"><span class="glyphicon glyphicon-menu-left"></span></a><a href="#carousel-shop" data-slide="next" class="right carousel-control"><span class="glyphicon glyphicon-menu-right"></span></a>
                    <ol class="carousel-indicators mCustomScrollbar">
<?php $i = 0;
foreach ($product_images as $row) { ?>
                            <li data-target="#carousel-shop" data-slide-to="<?php echo $i; ?>" class="active"><img alt="" src="<?php echo base_url(); ?>assets/gold/<?php echo $product_images->product_path; ?>"></li>
    <?php $i = $i + 1;
} ?>
                    </ol>
                    <br>
                </div>
                <div class="col-sm-7 slide bg-white">
                    <h2 class="no-pad"><?php echo $Delivery->GLOD_TITLE; ?></h2>
                    <small>Minting Charges</small>
                    <form class="form-inline ng-pristine ng-valid">
                        <div class="form-group">
                            <h2 class="no-pad"><i class="fa fa-inr"></i> <?php echo $Delivery->GOLD_Minting_Charges; ?>/-</h2>
                        </div>
                        <a href="#" data-toggle="modal" data-target="#delivery_gold">
                            <button class="btn btn-dark btn-lg" id="4_buy_now">Buy Now</button>
                        </a> <br>
                    </form>
                    <br>
                    <!-- Nav tabs-->
                    <ul role="tablist" class="nav nav-tabs">
                        <li role="presentation" class="active"><a href="#tab1" aria-controls="tab1" id="4_highlights" role="tab" data-toggle="tab" aria-expanded="true">Highlights</a></li>
                        <li role="presentation" class=""><a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab" id="4_gold_summary" aria-expanded="false">Gold Summary</a></li>
                    </ul>
                    <!-- Tab panes-->
                    <div class="tab-content">
                        <div id="tab1" role="tabpanel" class="tab-pane fade active in">
                            <ul class="product-short-details">
                                    <?php echo $Delivery->GOLD_Highlight; ?>                       
                            </ul>
                        </div>
                        <div id="tab2" role="tabpanel" class="tab-pane fade">
                            <div class="summary">
                                <h5>Gold Summary</h5>
                                <div class="table-responsive">
<?PHP echo $Delivery->GOLD_SUMMARY; ?> 
                                </div>
                                <br>

                            </div>
                        </div>
                    </div>
                    <h5>Shipping &amp; delivery</h5>
                    <table width="" class="table">
                        <tbody>
                            <tr>
                                <th scope="row">Cash On Delivery (COD)</th>
                                <td>No</td>
                            </tr>
                            <tr>
                                <th scope="row">Shipping Charges</th>
                                <td> Free</td>
                            </tr>
                            <tr>
                                <th scope="row">GST Charges</th>
                                <td> 3% perecent</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



</section>

<div class="modal fade" id="delivery_gold" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="background-color:#eb852c;color: white;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $Delivery->GLOD_TITLE; ?></h4>
            </div>
            <div class="modal-body">
<?php if (count($address) >= 1) { ?>
                    <div class="panel panel-primary">
                        <div class="panel panel-heading" style="padding: 4px 15px;"><p style="margin:unset;font-weight:bold;text-align:center;">Delivery Order Details</p></div>
                        <div class="panel-body">     
                            <div class="alert alert-danger" id="alert-address-error" style="display:none;"></div>
                            <div class="alert alert-success" id="alert-address-success" style="display:none;"></div>
                            <form method="post" action="#" id="delivery_address_form"> 
                                <table class="table table-bordered">
                                    <tr><th colspan="2" style="text-align: center;background-color: #000;color: white;">Pay Gold and INR Amount Details</th></tr>
                                    <tr><th>Gold Amount</th><td><?php echo $Delivery->GOLD_WEIGHT; ?> gm</td></tr>
                                    <tr><th>GST TAX and Minting Charges</th><td><?php
                                        $res = $this->site->get_live_glod_rate();
                                        $amount_equilent = number_format($Delivery->GOLD_WEIGHT * $res['gram_rate'], 2, '.', '');
                                        $totals = (3 / 100) * $amount_equilent;
                                        $total_inr=$Delivery->GOLD_Minting_Charges+$totals;
                                        echo $total_inr;
                                        ?> INR</td></tr>
                                </table>
                                <input type="hidden" value="<?php echo $_GET['delivery']; ?>" id="ID" name="ID">
                                <div class="form-group">  
                                    <ul style="list-style: none;">
    <?php
    foreach ($address as $row) {
        $citites = $this->db->query("select *from tb_city where city_id='" . $row->CITY . "'")->row();
        $tb_state = $this->db->query("select *from tb_state where state_id='" . $row->STATE . "'")->row();
        ?>
                                            <li class="address_list"><input type="radio" name="address" value="<?php echo base64_encode($row->ID); ?>"> <span class="name_padding"><?php echo $row->NAME; ?>   <?php echo $row->MOBILE; ?></span><br>
                                                <span class="address_padding"><?php echo $row->ADDRESS; ?>, <?php echo $citites->city; ?>,  <?php echo $tb_state->state; ?> - <?php echo $row->PINCODE; ?></span>
                                            </li>
                    <?php } ?>
                                    </ul>
                                    <p><label id="address-error" class="error" for="address"></label></p> 
                                    <a href="<?php echo site_url(); ?>addresses-details" class="btn btn-default btn-sm btn-block"><i class="fa fa-plus"></i> Add New Address</a>   
                                </div>
                                <div class="form-group">
                                    <button type="submit" id="submit_delivery_address" class="btn btn-primary btn-sm btn-block">Place Delivery Order</button>
                                </div>
                            </form>   </div></div>
<?php } else { ?>
                    <p class="deliver_notification">Update your address first, then only you can make it deliver</p>
                    <a href="<?php echo site_url(); ?>addresses-details" class="btn btn-primary btn-block">Update You Deliver Address</a>
<?php } ?> 
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>