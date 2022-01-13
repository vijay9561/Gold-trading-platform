<style>
    .panel-group .panel {
    border-radius: 0;
    border-bottom: 1px solid #605d5a;
    overflow: hidden;
    -webkit-box-shadow: none;
    box-shadow: none;
}
.panel-default > .panel-heading + .panel-collapse > .panel-body, .panel-default > form > .panel-heading + .panel-collapse > .panel-body {
    border-top-color: #605d5a;
}
.panel-default > .panel-heading, .panel-default > form > .panel-heading {
    color: #f3ebeb;
    background-color: #0c0c0c;
    border-color: #605d5a;
}
.panel-group .panel .panel-heading a.collapsed:active, .panel-group .panel .panel-heading a.collapsed:hover {
    color: #f5ebeb;
    background: #2b2c2d;
}
.panel-group .panel .panel-heading a.collapsed {
    background: #101011;
    color: #f8f3f3;
}
.img_h{ height:280px;width:100%;}
.panel_body_bg{background-color: rgba(12,13,15,.97)!important;}
.form-control{
    color: #b3b3b3;
    background-color: #565656;
    border: 1px solid #7d7a7a;
}
.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
    background-color: #484646;
    opacity: 1;
}
</style>
<script>
function aadhar_frant_sider(){
			var lblError = document.getElementById("aadhar_frant_sider");
			     myfile= $('#aadhar_frant_side').val();
				   var ext = myfile.split('.').pop();
 if(ext=="png" || ext=="PNG" || ext=="jpg" || ext=="jpeg" || ext=="JPEG" || ext=="JPG" || ext=="gif" ||  ext=="BMP" ||  ext=="bmp"  ||  ext=="PPM" ||  ext=="ppm" ||  ext=="PGM" ||  ext=="Exif" ||  ext=="PNM" ||  ext=="PBM" || ext=="JFIF"){
      // alert('Valid');
	    lblError.innerHTML='';
   } else{
         lblError.innerHTML = "Please upload files having extensions: <b> only png,jpg,jpeg,gif</b> only.";
			document.getElementById('aadhar_frant_side').value='';
			return false;
   }
    var uploadedFile = document.getElementById('aadhar_frant_side');
    var file_size = uploadedFile.files[0].size;
    if(file_size>4000000) {
     lblError.innerHTML = "Image can not be grater then 500 KB"; 
      $('#aadhar_frant_side').val('');
    return false;    
    }
    
    var fileUpload = document.getElementById("aadhar_frant_side");
                if (typeof (FileReader) != "undefined") {
                    var dvPreview = document.getElementById("aadhar_frant_sidet");
                    dvPreview.innerHTML = "";
                    var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
                    for (var i = 0; i < fileUpload.files.length; i++) {
                        var file = fileUpload.files[i];
                        if (regex.test(file.name.toLowerCase())) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                var img = document.createElement("IMG");
                                img.height = "150";
                                img.width = "150";
                                img.src = e.target.result;
			        img.class="img-thumbnail";
                                dvPreview.appendChild(img);				
                            }
                            reader.readAsDataURL(file);
							
                         } 			
			 else {
                            alert(file.name + " is not a valid image file.");
                            dvPreview.innerHTML = "";
			   $('#aadhar_frant_side').val('');
                            return false;
                        }
                    }
                } else {
                    alert("This browser does not support HTML5 FileReader.");
                }
         
	}
        
        function aadhar_back_sider(){
			var lblError = document.getElementById("aadhar_back_sider");
			     myfile= $('#aadhar_back_side').val();
				   var ext = myfile.split('.').pop();
 if(ext=="png" || ext=="PNG" || ext=="jpg" || ext=="jpeg" || ext=="JPEG" || ext=="JPG" || ext=="gif" ||  ext=="BMP" ||  ext=="bmp"  ||  ext=="PPM" ||  ext=="ppm" ||  ext=="PGM" ||  ext=="Exif" ||  ext=="PNM" ||  ext=="PBM" || ext=="JFIF"){
      // alert('Valid');
	    lblError.innerHTML='';
   } else{
         lblError.innerHTML = "Please upload files having extensions: <b> only png,jpg,jpeg,gif</b> only.";
			document.getElementById('aadhar_back_side').value='';
			return false;
   }
    var uploadedFile = document.getElementById('aadhar_back_side');
    var file_size = uploadedFile.files[0].size;
    if(file_size>4000000) {
      lblError.innerHTML = "Image can not be grater then 500 KB"; 
      $('#aadhar_back_side').val('');
    return false;    
    }
    var fileUpload = document.getElementById("aadhar_back_side");
                if (typeof (FileReader) != "undefined") {
                    var dvPreview = document.getElementById("aadhar_back_sidet");
                    dvPreview.innerHTML = "";
                    var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
                    for (var i = 0; i < fileUpload.files.length; i++) {
                        var file = fileUpload.files[i];
                        if (regex.test(file.name.toLowerCase())) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                var img = document.createElement("IMG");
                                img.height = "150";
                                img.width = "150";
                                img.src = e.target.result;
			        img.class="img-thumbnail";
                                dvPreview.appendChild(img);				
                            }
                            reader.readAsDataURL(file);
							
                         } 			
			 else {
                            alert(file.name + " is not a valid image file.");
                            dvPreview.innerHTML = "";
			   $('#aadhar_back_side').val('');
                            return false;
                        }
                    }
                } else {
                    alert("This browser does not support HTML5 FileReader.");
                }
         
	}


function pan_cardr(){
			var lblError = document.getElementById("pan_cardr");
			     myfile= $('#pan_card').val();
				   var ext = myfile.split('.').pop();
 if(ext=="png" || ext=="PNG" || ext=="jpg" || ext=="jpeg" || ext=="JPEG" || ext=="JPG" || ext=="gif" ||  ext=="BMP" ||  ext=="bmp"  ||  ext=="PPM" ||  ext=="ppm" ||  ext=="PGM" ||  ext=="Exif" ||  ext=="PNM" ||  ext=="PBM" || ext=="JFIF"){
      // alert('Valid');
	    lblError.innerHTML='';
   } else{
         lblError.innerHTML = "Please upload files having extensions: <b> only png,jpg,jpeg,gif</b> only.";
			document.getElementById('pan_card').value='';
			return false;
   }
    var uploadedFile = document.getElementById('pan_card');
    var file_size = uploadedFile.files[0].size;
    if(file_size>4000000) {
      lblError.innerHTML = "Image can not be grater then 500 KB";  
      $('#pan_card').val('');
    return false;    
    }
    var fileUpload = document.getElementById("pan_card");
                if (typeof (FileReader) != "undefined") {
                    var dvPreview = document.getElementById("pan_cardt");
                    dvPreview.innerHTML = "";
                    var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
                    for (var i = 0; i < fileUpload.files.length; i++) {
                        var file = fileUpload.files[i];
                        if (regex.test(file.name.toLowerCase())) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                var img = document.createElement("IMG");
                                img.height = "150";
                                img.width = "150";
                                img.src = e.target.result;
			        img.class="img-thumbnail";
                                dvPreview.appendChild(img);				
                            }
                            reader.readAsDataURL(file);
							
                         } 			
			 else {
                            alert(file.name + " is not a valid image file.");
                            dvPreview.innerHTML = "";
			   $('#pan_card').val('');
                            return false;
                        }
                    }
                } else {
                    alert("This browser does not support HTML5 FileReader.");
                }
         
	}




function bank_statementr(){
			var lblError = document.getElementById("bank_statementr");
			     myfile= $('#bank_statement').val();
				   var ext = myfile.split('.').pop();
 if(ext=="png" || ext=="PNG" || ext=="jpg" || ext=="jpeg" || ext=="JPEG" || ext=="JPG" || ext=="gif" ||  ext=="BMP" ||  ext=="bmp"  ||  ext=="PPM" ||  ext=="ppm" ||  ext=="PGM" ||  ext=="Exif" ||  ext=="PNM" ||  ext=="PBM" || ext=="JFIF"){
      // alert('Valid');
	    lblError.innerHTML='';
   } else{
         lblError.innerHTML = "Please upload files having extensions: <b> only png,jpg,jpeg,gif</b> only.";
			document.getElementById('bank_statement').value='';
			return false;
   }
    var uploadedFile = document.getElementById('bank_statement');
    var file_size = uploadedFile.files[0].size;
    if(file_size>4000000) {
     lblError.innerHTML = "Image can not be grater then 500 KB"; 
      $('#bank_statement').val('');
    return false;    
    }
    var fileUpload = document.getElementById("bank_statement");
                if (typeof (FileReader) != "undefined") {
                    var dvPreview = document.getElementById("bank_statementt");
                    dvPreview.innerHTML = "";
                    var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
                    for (var i = 0; i < fileUpload.files.length; i++) {
                        var file = fileUpload.files[i];
                        if (regex.test(file.name.toLowerCase())) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                var img = document.createElement("IMG");
                                img.height = "150";
                                img.width = "150";
                                img.src = e.target.result;
			        img.class="img-thumbnail";
                                dvPreview.appendChild(img);				
                            }
                            reader.readAsDataURL(file);
							
                         } 			
			 else {
                            alert(file.name + " is not a valid image file.");
                            dvPreview.innerHTML = "";
			   $('#bank_statement').val('');
                            return false;
                        }
                    }
                } else {
                    alert("This browser does not support HTML5 FileReader.");
                }
         
	}
        
        function submit_addhar_card_forms() {
        var aadhar_frant_side = $("#aadhar_frant_side").val();
        var aadhar_back_side = $("#aadhar_back_side").val();
        if (aadhar_frant_side == "") {
            $("#aadhar_frant_sider").html("Please upload aadhar card frant side image");
            $("#aadhar_frant_side").focus();
            return false;
        }
        if (aadhar_back_side == "") {
            $("#aadhar_back_sider").html("Please upload aadhar card back side image");
            $("#aadhar_back_side").focus();
            return false;
        }
        $('#loading1').show();
        $("#addhar_card_form").unbind('submit').bind('submit', function () {
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: "<?php echo site_url(); ?>Users_controller/submit_aadhar_card",
                type: "POST",
                data: formData,
                async: true,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data == 1) {
                    window.location ='kyc-verfication';
                     return false;
                    }else {
                    alert('Some thing wrong');   
                 }
                }
            });
            return false;
        });

    }
    
       function submit_pan_card_forms() {
        var pan_card = $("#pan_card").val();
       
        if (pan_card == "") {
            $("#pan_cardr").html("Please upload aadhar card frant side image");
            $("#pan_card").focus();
            return false;
        }
        $('#loading1').show();
        $("#pan_card_form").unbind('submit').bind('submit', function () {
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: "<?php echo site_url(); ?>Users_controller/submit_pan_card",
                type: "POST",
                data: formData,
                async: true,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data == 1) {
                    window.location ='kyc-verfication';
                     return false;
                    }else {
                    alert('Some thing wrong');   
                 }
                }
            });
            return false;
        });

    }
    
    function account_nor(){ if($("#account_no").val()==""){ }else{ $("#account_nor").html(' ') } }
    function ifsc_coder(){ if($("#ifsc_code").val()==""){ }else{ $("#ifsc_coder").html(' ') } }
    function acount_holderr(){ if($("#acount_holder").val()==""){ }else{ $("#acount_holderr").html(' ') } }  
    
     function submit_bankstatement_forms() {
       var bank_statement = $("#bank_statement").val();
       var account_no=$("#account_no").val();
       var ifsc_code=$("#ifsc_code").val();
       var acount_holder=$("#acount_holder").val();
       var swift_code=$("#swift_code").val();
       
        if (bank_statement == "") {
            $("#bank_statementr").html("Please upload bank account details");
            $("#bank_statement").focus();
            return false;
        }
        if(account_no==""){
          $("#account_nor").html("Please enter account number");
          $("#account_no").focus();
          return false;
        }
        if(ifsc_code==""){
          $("#ifsc_coder").html("Please enter IFSC code");
          $("#ifsc_code").focus();
          return false;
        }
         if(acount_holder==""){
          $("#acount_holderr").html("Please enter holder name");
          $("#acount_holder").focus();
          return false;
        }
        $('#loading1').show();
        $("#bank_statement_forms").unbind('submit').bind('submit', function () {
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: "<?php echo site_url(); ?>Users_controller/submit_bank_statement",
                type: "POST",
                data: formData,
                async: true,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data == 1) {
                    window.location ='kyc-verfication';
                     return false;
                    }else {
                    alert('Some thing wrong');   
                 }
                }
            });
            return false;
        });

    }
</script>
<section id="login" class="intro intro-fullscreen header_cover"> 
  <!-- Intro Header-->
  <div class="intro-body"> 
    <!-- Register-->
    <div class="container">
     <div class="page-content">

    <div class="" ng-controller="lendwithdrawal" class="commong_background">
        <div class="page-heading page-heading-md commong_background">
            <h2>
                KYC Verification</h2>
            <?php if ($this->session->userdata('error')) { ?>
                <span style="color:red;font-size:14px;" id="errors"><?php echo $this->session->userdata('error'); ?></span>
                <?php $this->session->unset_userdata('error');
            } ?>

            <?php if ($this->session->userdata('success')) { ?>
                <div class="alert alert-success"><?php echo $this->session->userdata('success'); ?></div>
    <?php $this->session->unset_userdata('success');
}
$userid=$this->session->userdata('USERID');
$data=$this->db->query("select *from Lo_kyc_verification where userid='$userid'")->row();
?>

                <script>
             
                 function namer() { if($("#name").val()=="") { }else{ $("#namer").html(" ") } }
                 function dobr() { if($("#dob").val()=="") { }else{ $("#dobr").html(" ") } }
                 function genderr() { if($("#gender").val()=="") { }else{ $("#genderr").html(" ") } }
                 function phone_nor() { if($("#phone_no").val()=="") { }else{ $("#phone_nor").html(" ") } }
                 function countryr() { if($("#country").val()=="") { }else{ $("#countryr").html(" ") } }
                 function cityr() { if($("#city").val()=="") { }else{ $("#cityr").html(" ") } }
                 function stater() { if($("#state").val()=="") { }else{
                         
            $("#stater").html(" ") 
   var state=$("#state").val();
//$("#loading").show();
if(state!=''){
    $.ajax({  
url:"<?php echo site_url(); ?>Users_controller/getcities",  
method:"POST",  
data:{state:state},  
success:function(resp){  
   $('#getstate').hide().html(resp).fadeIn('slow');
   //$("#loading").hide();
   } 
  })
  }
  } 
 }  
                 function addressr() { if($("#address").val()=="") { }else{ $("#addressr").html(" ") } }  
                 
                function save_informations(){
                 var name=$("#name").val();
                 var dob=$("#dob").val();
                 var gender=$("#gender").val();
                 var phone_no=$("#phone_no").val();
                 var country=$("#country").val();
                 var city=$("#city").val();
                 var state=$("#state").val();
                 var address=$("#address").val();
                 var mobilenovalidation=/^\d{10}$/;
                 if(name==""){
                  $("#namer").html("Please enter your full name");
                  $("#name").focus();
                  return false;
                 } if(dob==""){
                  $("#dobr").html("Please select your date of birth");
                  $("#dob").focus();
                  return false;
                 } 
                 if(gender==""){
                  $("#genderr").html("Please select your gender");
                  $("#gender").focus();
                  return false;
                 }
                 if(phone_no==""){
                  $("#phone_nor").html("Please enter your mobile no");
                  $("#phone_no").focus();
                  return false;
                 }
                 if (!(phone_no.match(mobilenovalidation))) {
	             $("#phone_nor").html("Please enter 10 digit mobile number");
                      $("#phone_no").focus();
		     return false;
		}
                 if(country==""){
                  $("#countryr").html("Please enter your country");
                  $("#country").focus();
                  return false;
                 }
                 if(state==""){
                  $("#stater").html("Please enter your state");
                  $("#state").focus();
                  return false;
                 }
                 if(city==""){
                  $("#cityr").html("Please enter your city");
                  $("#city").focus();
                  return false;
                 }
                 if(address==""){
                  $("#addressr").html("Please enter your address details");
                  $("#address").focus();
                  return false;
                 }
                  $('#loading1').show();
        $("#profile_details").unbind('submit').bind('submit', function () {
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: "<?php echo site_url(); ?>Users_controller/submit_your_profile_details",
                type: "POST",
                data: formData,
                async: true,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data == 1) {
                    window.location ='kyc-verfication';
                     return false;
                    }else {
                    alert('Some thing wrong');   
                 }
                }
            });
            return false;
        });
       }
                </script>

        </div>

        <!--new design statrt and withdrawal controller start here-->
        <div class="container-fluid-md commong_background" style="margin-left:0px;">
            <!-- <hr style="border-color: gray;">-->
            <div class="row">
<div class="container">
    <div class="panel-group" id="accordion" style="border: 1px solid #605d5a;">
       
        
         <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse11" class="">Profile & Address Details  
          </a>
        
        </h4>
      </div>
      <div id="collapse11" class="panel-collapse collapse in">
        <div class="panel-body panel_body_bg">
           <?php if(empty($data->name)){ ?>
            <form method="post" action="#" id="profile_details">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Full Name</label>  
                        <input type="text" class="form-control" readonly="true" value="<?php echo $this->session->userdata('FULLNAME'); ?>" name="name" id="name" onchange="namer()" />
                         <span style="color:red;" id="namer"></span>
                    </div>  
                     <div class="col-md-6 form-group">
                        <label>Date Of Birth</label>  
                         <input type="text" class="form-control" name="dob" id="dob" onchange="dobr()" />
                         <span style="color:red;" id="dobr"></span>
                    </div>
                </div>
                
                 <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Select Gender</label>  
                        <select type="text" class="form-control" name="gender" id="gender" onchange="genderr()">
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>  
                            <option value="Female">Female</option> 
                        </select>
                        
                         <span style="color:red;" id="genderr"></span>
                    </div>  
                     <div class="col-md-6 form-group">
                        <label>Mobile No</label>  
                        <input type="text" class="form-control" readonly="true" value="<?php echo $this->session->userdata('MOBILE'); ?>" name="phone_no" id="phone_no" onchange="phone_nor()" />
                         <span style="color:red;" id="phone_nor"></span>
                    </div>
                </div>
                   <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Select Country</label>  
                        <select type="text" class="form-control" name="country" id="country" onchange="countryr()">
                            <option value="">Select Country</option>
                            <option value="India">India</option> 
                        </select>
                         <span style="color:red;" id="countryr"></span>
                    </div>  
                     <?php $tb_state=$this->db->query("select *from tb_state order by state asc")->result(); ?>
                     <div class="col-md-6 form-group">
                        <label>Select State</label>  
                        <select type="text" class="form-control" name="state" id="state" onchange="stater()">
                           <option value="">Select State</option>  
                            <?php foreach($tb_state as $st){ ?>
                            <option value="<?php echo $st->state_id; ?>"><?php echo $st->state; ?></option> 
                           <?php } ?>
                        </select>
                         <span style="color:red;" id="stater"></span>
                    </div>
                </div>
                <div class="row">
                 <?php $tb_city=$this->db->query("select *from tb_city order by city asc")->result(); ?>
                    
                    <div id="getstate">
                    <div class="col-md-6 form-group">
                        <label>Select City</label>  
  
                        <select type="text" class="form-control" name="city" id="city" onchange="cityr()">
                            <option value="">Select City</option>
                             <?php foreach($tb_city as $city){ ?>
                            <option value="<?php echo $city->city_id; ?>"><?php echo $city->city; ?></option> 
                           <?php } ?>
                        </select>
                         <span style="color:red;" id="cityr"></span>
                    </div>  
                    </div>
                     <div class="col-md-6 form-group">
                        <label>Address</label>  
                         <input type="text" class="form-control" name="address" id="address" onchange="addressr()" />
                         <span style="color:red;" id="addressr"></span>
                    </div>
                </div>
                 <div class="row">
                     <div class="col-md-4 form-group">
                     </div>
                      <div class="col-md-4 form-group">
                          <input type="submit" value="Save Change" onclick="return save_informations()" class="btn btn-success btn-block">
                     </div>
                     </div>
               </form>
           <?php }else{ ?>
              <?php $tb_city=$this->db->query("select *from tb_city where  city_id='$data->city'")->row(); ?>
               <?php $tb_state=$this->db->query("select *from tb_state where state_id='$data->state'")->row(); ?>
            <table  class="table table-bordered">
                <tbody>
                    <tr><th>Full Name</th><td><?php echo $data->name; ?></td></tr>
                    <tr><th>Date Of Birth</th><td><?php echo date('d-m-Y', strtotime($data->dob)); ?></td></tr>
                    <tr><th>Gender</th><td><?php echo $data->gender; ?></td></tr>
                    <tr><th>Mobile No</th><td><?php echo $data->phone_no; ?></td></tr>
                    <tr><th>Country</th><td><?php echo $data->country; ?></td></tr>
                    <tr><th>State</th><td><?php echo $tb_state->state; ?></td></tr>
                    <tr><th>City</th><td><?php echo $tb_city->city; ?></td></tr>
                    <tr><th>Address</th><td><?php echo $data->address; ?></td></tr>
                </tbody>   
            </table>
           <?php } ?>
        </div>
      </div>
    </div>
        
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" class="">Aadhar Card Image 
         <?php if((count($data)==0) || ($data->aadhar_status=='unverified')){ ?>
        <span class="btn btn-danger" style="float:right;margin-top: -9px;"><i class="fa fa-times" aria-hidden="true"></i> Unverified</span>
        <?php }elseif($data->aadhar_status=='pending'){ ?>
      <span class="btn btn-warning" style="float:right;margin-top: -9px;"><i class="fa fa-tasks" aria-hidden="true"></i>  Approval Pending</span>   
         <?php }elseif($data->aadhar_status=='approved'){ ?>
      <span class="btn btn-success" style="float:right;margin-top: -9px;"><i class="fa fa-check" aria-hidden="true"></i> Approved</span>   
       <?php }elseif($data->aadhar_status=='reject'){ ?>
       <span class="btn btn-danger" style="float:right;margin-top: -9px;"><i class="fa fa-times" aria-hidden="true"></i> Approval Cancel</span>
         <?php } ?>
          </a>
        
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse">
        <div class="panel-body panel_body_bg">
            <?php if((count($data)==0) || ($data->aadhar_status=='unverified')){ ?>
            <form method="post" action="#" id="addhar_card_form">
               
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Upload National ID Card Front Side Image </label>  
                        <div id="aadhar_frant_sidet"></div>
                         <input type="file" name="aadhar_frant_side" id="aadhar_frant_side" onchange="aadhar_frant_sider()" />
                         <span style="color:red;" id="aadhar_frant_sider"></span>
                    </div>  
                     <div class="col-md-6 form-group">
                        <label>Upload National ID Card Back Side Image </label>  
                        <div id="aadhar_back_sidet"></div>
                         <input type="file" name="aadhar_back_side" id="aadhar_back_side" onchange="aadhar_back_sider()" />
                         <span style="color:red;" id="aadhar_back_sider"></span>
                    </div>
                </div>
               
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4"><input type="submit" class="btn btn-primary" onclick="return submit_addhar_card_forms();" value="Submit" /></div>
                </div> 
                 </form>
            <?php }elseif($data->aadhar_status=='reject') { ?>
              <form method="post" action="#" id="addhar_card_form">
               
                <div class="row">
                    <div class="col-md-12">
                         <label>Reject Note:</label>
                        <p><?php echo $data->cancel_adhar_note; ?></p>
                    </div>
                    <div class="col-md-6 form-group">
                       
                        <label>Upload National ID Card Front Side Image </label>  
                        <div id="aadhar_frant_sidet"></div>
                         <input type="file" name="aadhar_frant_side" id="aadhar_frant_side" onchange="aadhar_frant_sider()" />
                         <span style="color:red;" id="aadhar_frant_sider"></span>
                    </div>  
                     <div class="col-md-6 form-group">
                        <label>Upload National ID Card Back Side Image </label>  
                        <div id="aadhar_back_sidet"></div>
                         <input type="file" name="aadhar_back_side" id="aadhar_back_side" onchange="aadhar_back_sider()" />
                         <span style="color:red;" id="aadhar_back_sider"></span>
                    </div>
                </div>
               
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4"><input type="submit" class="btn btn-primary" onclick="return submit_addhar_card_forms();" value="Submit" /></div>
                </div> 
                 </form>
               <?php }else{ ?>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>National ID Card Front Side Image </label>  
                        <img src="<?php echo base_url(); ?>kyc/adhar/<?php echo $data->aadhar_frant_side; ?>" class="img-thumbnail img_h">
                    </div>  
                     <div class="col-md-6 form-group">
                        <label>National ID Card Front Side Image </label>  
                      <img src="<?php echo base_url(); ?>kyc/adhar/<?php echo $data->aadhar_back_side; ?>" class="img-thumbnail img_h">  
                    </div>
                </div>
               <?php } ?>
           
        </div>
      </div>
    </div>
   <!-- <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Pan Card Verification  
              <?php if((count($data)==0) || ($data->pan_card_status=='unverified')){ ?>
        <span class="btn btn-danger" style="float:right;margin-top: -9px;"><i class="fa fa-times" aria-hidden="true"></i> Unverified</span>
        <?php }elseif($data->pan_card_status=='pending'){ ?>
      <span class="btn btn-warning" style="float:right;margin-top: -9px;"><i class="fa fa-tasks" aria-hidden="true"></i>  Approval Pending</span>   
         <?php }elseif($data->pan_card_status=='approved'){ ?>
      <span class="btn btn-success" style="float:right;margin-top: -9px;"><i class="fa fa-check" aria-hidden="true"></i> Approved</span>   
       <?php }elseif($data->pan_card_status=='reject'){ ?>
       <span class="btn btn-danger" style="float:right;margin-top: -9px;"><i class="fa fa-times" aria-hidden="true"></i> Approval Cancel</span>
         <?php } ?></a>
        </h4>
      </div>
      <div id="collapse2" class="panel-collapse collapse">
        <div class="panel-body">
            <?php if((count($data)==0) || ($data->pan_card_status=='unverified')){ ?>
            <form method="post" action="#" id="pan_card_form">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Upload Pan Card Image</label>  
                        <div id="pan_cardt"></div>
                         <input type="file" name="pan_card" id="pan_card" onchange="pan_cardr()" />
                         <span style="color:red;" id="pan_cardr"></span>
                    </div>  
                    
                </div>    
            <div class="row">
                   
                    <div class="col-md-4"><input type="submit" class="btn btn-primary" onclick="return submit_pan_card_forms();" value="Submit" /></div>
                </div> 
          </form>
             <?php }elseif($data->pan_card_status=='reject') { ?>
             <form method="post" action="#" id="pan_card_form">
                <div class="row">
                    <div class="col-md-6 form-group">
                         <label>Reject Note:</label>
                        <p><?php echo $data->cancel_pan_note; ?></p>
                        <label>Upload Pan Card Image</label>  
                        <div id="pan_cardt"></div>
                         <input type="file" name="pan_card" id="pan_card" onchange="pan_cardr()" />
                         <span style="color:red;" id="pan_cardr"></span>
                    </div>  
                    
                </div>    
            <div class="row">
             <div class="col-md-4"><input type="submit" class="btn btn-primary" onclick="return submit_pan_card_forms();" value="Submit" /></div>
            </div> 
          </form>
            <?php }else{ ?>
             <div class="col-md-12 form-group">
                        <label>Pan Card Image</label>  
                      <img src="<?php echo base_url(); ?>kyc/pan/<?php echo $data->pan_card; ?>" class="img-thumbnail img_h">  
                    </div>
            <?php } ?>
      </div>
      </div>
    </div>-->
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Bank Detail Verification  
            <?php if((count($data)==0) || ($data->bank_statement_status=='unverified')){ ?>
        <span class="btn btn-danger" style="float:right;margin-top: -9px;"><i class="fa fa-times" aria-hidden="true"></i> Unverified</span>
        <?php }elseif($data->bank_statement_status=='pending'){ ?>
      <span class="btn btn-warning" style="float:right;margin-top: -9px;"><i class="fa fa-tasks" aria-hidden="true"></i>  Approval Pending</span>   
         <?php }elseif($data->bank_statement_status=='approved'){ ?>
      <span class="btn btn-success" style="float:right;margin-top: -9px;"><i class="fa fa-check" aria-hidden="true"></i> Approved</span>   
       <?php }elseif($data->bank_statement_status=='reject'){ ?>
       <span class="btn btn-danger" style="float:right;margin-top: -9px;"><i class="fa fa-times" aria-hidden="true"></i> Approval Cancel</span>
         <?php } ?>
            </a>
        </h4>
      </div>
      <div id="collapse3" class="panel-collapse collapse">
        <div class="panel-body panel_body_bg"> 
             <?php if((count($data)==0) || ($data->bank_statement_status=='unverified')){ ?>
            <form method="post" action="#" id="bank_statement_forms">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Upload Bank Statement Image</label>  
                        <div id="bank_statementt"></div>
                         <input type="file" name="bank_statement" id="bank_statement" onchange="bank_statementr()" />
                         <span style="color:red;" id="bank_statementr"></span>
                    </div>  
                    
                </div>   
                   
                <div class="row">
                    <div class="col-md-6">
                        <label>Account No</label>
                        <input type="text" class="form-control" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" maxlength="100" name="account_no" id="account_no" onchange="account_nor()" placeholder="Account No">
                    <label id="account_nor" style="color:red"></label>
                    </div>  
                     <div class="col-md-6">
                        <label>IFSC Code</label>
                        <input type="text" class="form-control" maxlength="100" name="ifsc_code" id="ifsc_code" onchange="ifsc_coder()" placeholder="IFSC Code">
                        <label id="ifsc_coder" style="color:red"></label>
                    </div>  
                </div>
                
                 <div class="row">
                    <div class="col-md-6">
                        <label>Account Holder Name</label>
                        <input type="text" class="form-control"  name="acount_holder" id="acount_holder" onchange="acount_holderr()" placeholder="Account Holder Name">
                        <label id="acount_holderr" style="color:red"></label>
                    </div>  
                     <div class="col-md-6">
                        <label>Swift Code (Optional)</label>
                        <input type="text" class="form-control" name="swift_code" id="swift_code"  placeholder="Swift Code">
                    </div>  
                </div>
                <div class="row">
                    <div class="col-md-4"><input type="submit" class="btn btn-primary" onclick="return submit_bankstatement_forms();" value="Submit" /></div>
                </div>
          </form>
             <?php }elseif($data->bank_statement_status=='reject') {?>
             <form method="post" action="#" id="bank_statement_forms">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Reject Note:</label>
                        <p><?php echo $data->cancel_bank_note; ?></p>
                        <label>Upload Bank Statement Image</label>  
                        <div id="bank_statementt"></div>
                         <input type="file" name="bank_statement" id="bank_statement" onchange="bank_statementr()" />
                         <span style="color:red;" id="bank_statementr"></span>
                    </div>  
                    
                </div>   
                     
                <div class="row">
                    <div class="col-md-6">
                        <label>Account No</label>
                        <input type="text" value="<?php echo $data->account_no; ?>" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="form-control" name="account_no" id="account_no" onchange="account_nor()" placeholder="Account No">
                    </div>  
                     <div class="col-md-6">
                        <label>IFSC Code</label>
                        <input type="text" class="form-control" value="<?php echo $data->ifsc_code; ?>" name="ifsc_code" id="ifsc_code" onchange="ifsc_coder()" placeholder="IFSC Code">
                        <label id="acount_holderr" style="color:red"></label>
                    </div>  
                </div>
                
                 <div class="row">
                    <div class="col-md-6">
                        <label>Account Holder Name</label>
                        <input type="text"  class="form-control" name="acount_holder" value="<?php echo $data->acount_holder; ?>" id="acount_holder" maxlength="100" onchange="acount_holderr()" placeholder="Account Holder Name">
                        <label id="acount_holderr" style="color:red"></label>
                        
                    </div>  
                     <div class="col-md-6">
                        <label>Swift Code (Optional)</label>
                        <input type="text" class="form-control" name="swift_code"  value="<?php echo $data->swift_code; ?>" id="swift_code"  maxlength="100" placeholder="Swift Code">
                    </div>  
                </div>
                 
                  <div class="row">
                   
                    <div class="col-md-4"><input type="submit" class="btn btn-primary" onclick="return submit_bankstatement_forms();" value="Submit" /></div>
                </div> 
          </form>
             <?php }else{ ?>
            <table   class="table table-bordered"><tr><th>Account No:</th> <td><?php echo $data->account_no;  ?></td></tr>
                <tr><th>IFSC Code:</th> <td><?php echo $data->ifsc_code;  ?></td></tr>
                <tr><th>Account Holder Name:</th><td> <?php echo $data->acount_holder;  ?></td></tr>
                <tr><th>Swift Code:</th> <td><?php echo $data->swift_code;  ?></td></tr>
            </table>
             <div class="col-md-12 form-group">
                        <label>Bank Statement Image</label>  
                      <img src="<?php echo base_url(); ?>kyc/bank/<?php echo $data->bank_statement; ?>" class="img-thumbnail img_h">  
                    </div>
             <?php } ?>
        </div>
      </div>
    </div>
  </div> 
</div>
            </div>
        </div>
    </div>
</div>
    </div>
  </div>
</section>

