<footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright &copy; Suvarnasiddhi 2019</small>
        </div>
      </div>
    </footer>
	
	    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
	<script src="<?php echo base_url(); ?>support_assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>support_assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url(); ?>support_assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
  <!--  <script src="<?php echo base_url(); ?>support_assets/vendor/chart.js/Chart.min.js"></script>-->
    <script src="<?php echo base_url(); ?>support_assets/vendor/datatables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url(); ?>support_assets/vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url(); ?>support_assets/js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="<?php echo base_url(); ?>support_assets/js/sb-admin-datatables.min.js"></script>
<!--    <script src="<?php echo base_url(); ?>support_assets/js/sb-admin-charts.min.js"></script>-->
<div id="loading1" style="display:none;"> <img id="loading-image1" src="<?php echo base_url();?>support_assets/img/recharge_loader2.gif" alt="Loading..." /> </div>
<style>

#loading1 {
 width: 100%;
 height: 100%;
 top: 0px;
 left: 0px;
 position: fixed;
 display: block;
 opacity: 0.7;
 z-index: 99;
 text-align: center;
}
#loading-image1 {
 position: absolute;
 top: 40%;
 left: 30%;
 z-index:99999;
}
</style>
<script type="text/javascript">
var table;
$(document).ready(function() {
    //datatables
    table = $('#buy_trades').DataTable({ 
	    "pageLength": 50,
		"bLengthChange": false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('SupportController/trade_trnasction_history_buy')?>",
            "type": "POST"
        },
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
 
    });

table = $('#sell_trades').DataTable({ 
	    "pageLength": 50,
		"bLengthChange": false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('SupportController/trade_trnasction_history_sell')?>",
            "type": "POST"
        },
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
 
    });
table = $('#deposit_INR_History').DataTable({ 
	    "pageLength": 50,
		"bLengthChange": false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('SupportController/deposit_trnasction_history')?>",
            "type": "POST"
        },
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
 
    });

table = $('#users_history').DataTable({ 
	    "pageLength": 50,
		"bLengthChange": false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('SupportController/users_history_showing')?>",
            "type": "POST"
        },
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
 
    });

table = $('#users_kyc_lists').DataTable({ 
	    "pageLength": 50,
		"bLengthChange": false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('Shoppingwallet/get_kyc_users_list')?>",
            "type": "POST"
        },
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
 
    });

table = $('#particular_withdraw_all_history').DataTable({ 
	    "pageLength": 50,
		"bLengthChange": false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('SupportController/particular_withdraw_all_history')?>",
            "type": "POST"
        },
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
 
    });

table = $('#particulars_products').DataTable({ 
	    "pageLength": 50,
		"bLengthChange": false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('SupportController/delivery_product_history')?>",
            "type": "POST"
        },
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
 
    });


table = $('#delivery_orders').DataTable({ 
	    "pageLength": 50,
		"bLengthChange": false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('SupportController/delivery_pagination_list')?>",
            "type": "POST"
        },
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
 
    });

table = $('#FIXED_DEPOSIT_PAYOUT').DataTable({ 
	    "pageLength": 50,
		"bLengthChange": false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('SupportController/fixed_deposit_payout_paging')?>",
            "type": "POST"
        },
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
 
    });
table = $('#fixed_deposit_history').DataTable({ 
	    "pageLength": 50,
		"bLengthChange": false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('SupportController/fixed_deposit_history_shwing')?>",
            "type": "POST"
        },
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
 
    });

});


// notification loading functionality
/*function update_notifications(){
			$.ajax({
			url: "<?php echo site_url() ?>SupportController/update_notifications_status",
			type: 'POST',
			data: {},
			success: function(data) {
			$("#countgetnotifications").fadeOut().html(data).fadeIn('slow');
			}
	});
}*/
        /* $(document).ready(function() {
                function loadData() {
                    $('#getnotifications').load('<?php echo site_url(); ?>SupportController/get_notifications_details', function() {
                       if (window.reloadData != 0)
                           window.clearTimeout(window.reloadData);
                       window.reloadData = window.setTimeout(loadData,2000)
                   }).fadeIn("slow"); 
				   
				     $('#countgetnotifications').load('<?php echo site_url(); ?>SupportController/count_view_notifications', function() {
                       if (window.reloadData != 0)
                           window.clearTimeout(window.reloadData);
                       window.reloadData = window.setTimeout(loadData,2000)
                   }).fadeIn("slow"); 
                }
             window.reloadData = 0; // store timer load data on page load, which sets timeout to reload again
               loadData();
            }); */

function delete_records(id){
	     con=confirm('Are you sure delete this notification');
		 if(con==true){
	       $.ajax({
			url: "<?php echo site_url() ?>SupportController/support_delete_notifications",
			type: 'POST',
			data: {id:id},
			success: function(data) {
				if(data==1){
				location.reload();
				}else{
				alert('Not Deleted');
				}
			}
	});
 }else{
   return false;
 }
}
$(document).ready(function(){
 setTimeout(function(){ $(".alert-success").hide(); }, 5000);	
});
function reply_descriptionr(){ if($("#reply_description").val()==''){ }else{ $("#reply_descriptionr").html(" ") } }
function add_ticket_reply(){
            var reply_description=document.getElementById('reply_description').value.trim();
			var tickets_id=$("#tickets_id").val();
			var current_status=$("#current_status").val();
			 if(reply_description==""){
			   $("#reply_descriptionr").html("please enter message");
			   $("#reply_description").focus();
			   return false;
			 }
			 $("#loading1").show();
			$.ajax({
			url: "<?php echo site_url() ?>SupportController/support_reply_tickets",
			type: 'POST',
			data: {reply_description:reply_description,tickets_id:tickets_id,current_status:current_status},
			success: function(data) {
			$("#get_ajax_commenting_load").fadeOut().html(data).fadeIn('slow');
			$("#loading1").hide();
			$("#reply_description").val(' ');
			}
	});
}
</script>