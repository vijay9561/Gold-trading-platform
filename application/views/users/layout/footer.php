<footer> 
  <!-- footer small-->
  <div class=" footer-small bg-dark text-center">
    <div class="container">
      <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <p data-wow-iteration="999" data-wow-duration="3s" class="wow flash"><a href="#page-top" class="page-scroll"><i class="fa fa-angle-up fa-2x" aria-hidden="true"></i></a></p>
          <p style="text-align:center">
              <img src="<?php echo base_url(); ?>assets/images/sslogo2.png" alt="safeGold-logo" width="180" style="height: 88px;width: 80px;" class="logo">
        <!-- SUVARNASIDDHI-->
            </p>
          <hr>
          <ul class="list-inline">
                <li><a href="<?php echo site_url(); ?>contact-us">Contact US</a></li>
              <li style="border:0px"><a href="<?php echo site_url(); ?>privacy-policy">PRIVACY POLICY </a></li>
              <li><a href="<?php echo site_url(); ?>refund-policy"> REFUND POLICY </a></li>
           
              <li><a href="<?php echo site_url(); ?>terms-of-use"> TERMS OF USE </a></li>
              <li><a href="<?php echo site_url();?>faq"> FAQ </a></li>
            <!--<li><a href="#"> SITEMAP </a></li>-->
          </ul>
           <ul class="list-inline">
               <li style="border-left: none;" class="facebook-social"><a href="https://www.facebook.com/suvarnasiddhi/" target="_blank"><i style="color:white;" class="fa fa-facebook"></i> </a></li>  
               <li style="border-left: none;" class="twitters"><a href="https://twitter.com/suvarnasiddhi" target="_blank"><i style="color:white;" class="fa fa-twitter"></i> </a></li>  
               <li style="border-left: none;" class="instragram"><a href="https://www.instagram.com/suvarnasiddhi/" target="_blank"><i style="color:white;" class="fa fa-instagram"></i> </a></li>  
               
          </ul>
          <p class="small" style="margin-bottom:5px">Product By SUVARNASANKALP PRIVATE LIMITED</a></p>
         
        </div>
      </div>
    <!--  <div class="row patner-list">
          <div class="col-xs-6 text-center"><img src="<?php echo base_url(); ?>assets/images/logos/idbi.png" alt="SafeGold-IDBI" width="150" height="43"></div>
        <div class="col-xs-6 text-center"><img src="<?php echo base_url(); ?>assets/images/logos/brinks.png" alt="SafeGold-BRINKS " width="150" height="43"></div>
        
      </div>-->
    </div>
  </div>
</footer>
 
<!--footer end--> 
<!-- jQuery--> 
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
 <script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bost/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bost/dataTables.bootstrap4.min.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<!-- Plugin JavaScript--> 
<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/additional-methods.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/main.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/device.min.js" defer></script>  

<script src="<?php echo base_url(); ?>assets/js/wow.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/universal.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/select2.min.js" defer></script>
<script src="<?php echo base_url(); ?>assets/js/sweetalert.min.js" defer></script>

<script src="<?php echo base_url(); ?>assets/js/jquery.smartmenus.js" async></script>
<!--<script src="/assets/js/jquery.easing.min.js" defer></script>--> 
<script src="<?php echo base_url(); ?>assets/js/jquery.shuffle.min.js"></script> 
<!--<script src="/assets/js/jquery.placeholder.min.js"></script>-->
<!--<script src="/assets/js/jquery.swipebox.min.js"></script> -->
<!-- <script src="/assets/js/smoothscroll.min.js"></script> -->
<!--<script src="/assets/js/jquery.parallax.min.js"></script> -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

<script type="text/javascript">window.NREUM||(NREUM={});NREUM.info={"beacon":"bam.nr-data.net","licenseKey":"b02a6de899","applicationID":"98372222","transactionName":"blQGMEdQVhEABxcLX1ceJQdBWFcMTiwMD1V6XgoQR15UDgQWIwVVTX0FClFYVgUxBQQH","queueTime":0,"applicationTime":24,"atts":"QhMFRg9KRR8=","errorBeacon":"bam.nr-data.net","agent":""}</script>
<script>
   // var j = jQuery.noConflict();  
           var maxBirthdayDate = new Date();
maxBirthdayDate.setFullYear( maxBirthdayDate.getFullYear() - 10,11,31)
    $(document).ready(function() {
    $("#CRATED_DATE_NFT").datepicker({
        changeMonth: true, 
       changeYear: true
       
    });
  });

</script>

<script>
var table;
$(document).ready(function() {
    table = $('#deposit_INR_History').DataTable({ 
	"pageLength": 50,
	"bLengthChange": false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('Datatables_Controller/buy_trnasction_history')?>",
            "type": "POST"
        },
        //Set column definition initialisation properties.
        "columnDefs": [{ 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
 
    });
 
});

$(document).ready(function() {
    table = $('#trade_buy_history').DataTable({ 
	"pageLength": 50,
	"bLengthChange": false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('Datatables_Controller/trade_trnasction_history_buy')?>",
            "type": "POST"
        },
        //Set column definition initialisation properties.
        "columnDefs": [{ 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
 
    });

table = $('#trade_sell_history').DataTable({ 
	"pageLength": 50,
	"bLengthChange": false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('Datatables_Controller/trade_trnasction_history_sell')?>",
            "type": "POST"
        },
        //Set column definition initialisation properties.
        "columnDefs": [{ 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
 
    });


table = $('#withdraws_historys').DataTable({ 
	"pageLength": 50,
	"bLengthChange": false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('Datatables_Controller/withdraws_trnasction_history')?>",
            "type": "POST"
        },
        //Set column definition initialisation properties.
        "columnDefs": [{ 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
 
    });

table = $('#referral_users_lists').DataTable({ 
	"pageLength": 50,
	"bLengthChange": false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('Datatables_Controller/referral_users_list')?>",
            "type": "POST"
        },
        //Set column definition initialisation properties.
        "columnDefs": [{ 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
 
    });

table = $('#referral_income_tables').DataTable({ 
	"pageLength": 50,
	"bLengthChange": false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('Datatables_Controller/referral_income_users')?>",
            "type": "POST"
            },
        //Set column definition initialisation properties.
        "columnDefs": [{ 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
 
    });

table = $('#fixed_deposit_table').DataTable({ 
	"pageLength": 50,
	"bLengthChange": false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('Datatables_Controller/fixed_deposit_history_shwing')?>",
            "type": "POST"
            },
        //Set column definition initialisation properties.
        "columnDefs": [{ 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
 
    });



table = $('#gold_payout_amount').DataTable({ 
	"pageLength": 50,
	"bLengthChange": false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('Datatables_Controller/fixed_deposit_payout_paging')?>",
            "type": "POST"
            },
        //Set column definition initialisation properties.
        "columnDefs": [{ 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
 
    });

table = $('#delivery_page_table').DataTable({ 
	"pageLength": 50,
	"bLengthChange": false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('Datatables_Controller/delivery_pagination_list')?>",
            "type": "POST"
            },
        //Set column definition initialisation properties.
        "columnDefs": [{ 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
 
    });
<?php if(isset($_GET['details_fd'])){ ?>
var fd_id='<?php echo $_GET['details_fd']; ?>';
table = $('#gold_payout_amount_daily').DataTable({ 
	"pageLength": 50,
	"bLengthChange": false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('Datatables_Controller/particular_details_fixed_deposit_contract')?>",
            "type": "POST",
            'data':{fd_id:fd_id}
            },
        //Set column definition initialisation properties.
        "columnDefs": [{ 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
 
    });
<?php } ?>
 
});
</script>
 