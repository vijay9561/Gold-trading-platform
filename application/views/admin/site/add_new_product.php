<script src="<?php echo base_url(); ?>support_assets/ckeditor2/ckeditor.js"></script>
<style>
    .table-bordered thead th, .table-bordered thead td {
    border-bottom-width: 2px;
    line-height: 18px;
}
</style> 
<script>

 function insertempdata(){
			  
			     var lblError = document.getElementById("uploadfileoner");
				
				var myfile= document.getElementById('uploadfileone').value;
				var ext = myfile.split('.').pop();
				if(ext=="png" || ext=="jpg" || ext=="jpeg" || ext=="gif"){
				// alert('Valid');
				lblError.innerHTML='';
				} else{
				lblError.innerHTML = "Please upload files having extensions: <b> only png,jpg,jpeg,gif</b> only.";
				document.getElementById("temponefilesss").value='';
				return false;
				}
				$("#loading").show(); 
                         var formData = new FormData($("#temponefilesss")[0]);
			 //alert(formData); return false;
			$.ajax({   
				url: "<?php echo site_url(); ?>SupportController/get_temparary_data",
				data : formData,
				processData: false,
				contentType: false,
				type: 'POST',
				success: function(data){
					if(data==1){
					     $.ajax({
					  	url: "<?php echo site_url(); ?>SupportController/InsertTempImages",
						type: 'POST',
						data: {},
						success: function(data) {
						$("#getimagessss").fadeOut().html(data).fadeIn('slow');
						$("#loading").fadeOut("slow");
						}
						});
						return false;
				     	}else {
                        alert('uploaded images limit only 5 images upload at time')
						$("#loading").fadeOut("slow");
					 return false;
					}
					
				}
			});
			return false;  
		
        }
	function temimagesdelete(id) {
        var r=confirm('Are you sure you want to delete this image?');
		if(r==true)
		{
		$("#loading").show(); 
        $.ajax({
            url: "<?php echo site_url(); ?>SupportController/delete_images",
            type: 'POST',
            data: {id: id},
            success: function(data) {
			if(data==1){
                        $.ajax({
                                url: "<?php echo site_url(); ?>SupportController/InsertTempImages",
                                type: 'POST',
                                data: {},
                                success: function(data) {
                                $("#getimagessss").fadeOut().html(data).fadeIn('slow');
                                $("#loading").fadeOut("slow");
                                }
                                });
                            }else{
                            alert("not deleted")
                        }
                    }
                });
            return false;
	} else
	{
        return false;	
     }
    }
	
	
	
	  function myimagesvalidation(id) {
			  var lblError = document.getElementById("lblErrorinserted"+id);
			    var file_size = $('#myinsertedimages'+id)[0].files[0].size;
              myfile= $('#myinsertedimages'+id).val();
				if(file_size>2097152) {
				$("#lblErrorinserted"+id).html("File size must not be more than 2 MB");
				return false;
				$('#myinsertedimages'+id).val('');
				} 
 
    var fileUpload = document.getElementById("myinsertedimages"+id);
                if (typeof (FileReader) != "undefined") {
                    var dvPreview = document.getElementById("tempemptyimage"+id);
                    dvPreview.innerHTML = "";
                    var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
                    for (var i = 0; i < fileUpload.files.length; i++) {
                        var file = fileUpload.files[i];
                        if (regex.test(file.name.toLowerCase())) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                var img = document.createElement("IMG");
                                img.height = "144";
                                img.width = "150";
                                img.src = e.target.result;
								img.class="img-thumbnail";
                                dvPreview.appendChild(img);
								
                            }
                            reader.readAsDataURL(file);
							
							$("#emptyopenimages"+id).hide();
                        } 
						
						else {
                            alert(file.name + " is not a valid image file.");
                            dvPreview.innerHTML = "";
								$('#myinsertedimages'+id).val('');
                            return false;
                        }
                    }
                } else {
                    alert("This browser does not support HTML5 FileReader.");
                }
         
   var ext = myfile.split('.').pop();
   if(ext=="png" || ext=="jpg" || ext=="jpeg" || ext=="gif"){
      // alert('Valid');
	    lblError.innerHTML='';
   } else{
         lblError.innerHTML = "Please upload files having extensions: <b> only png,jpg,jpeg,gif</b> only.";
			document.getElementById('myinsertedimages'+id).value='';
   }
    }
function GLOD_TITLEr(){ if($("#GLOD_TITLE").val()==""){}else{$("#GLOD_TITLEr").html("");}}
function GOLD_Minting_Chargesr(){ if($("#GOLD_Minting_Charges").val()==""){}else{$("#GOLD_Minting_Chargesr").html("");}}
function GOLD_WEIGHTr(){ if($("#GOLD_WEIGHT").val()==""){}else{$("#GOLD_WEIGHTr").html("");}}
function GOLD_Highlightr(){ if($("#GOLD_Highlight").val()==""){}else{$("#GOLD_Highlightr").html("");}}
function GOLD_SUMMARYr(){ if($("#GOLD_SUMMARY").val()==""){ }else{ $("#GOLD_SUMMARYr").html(" "); } }

function addarticals(){

            var uploadfileone=document.getElementById('uploadfileone').value.trim();
            var GLOD_TITLE=document.getElementById('GLOD_TITLE').value.trim();
            var GOLD_Minting_Charges=document.getElementById('GOLD_Minting_Charges').value.trim();
            var GOLD_WEIGHT=document.getElementById('GOLD_WEIGHT').value.trim();
            var GOLD_Highlight=document.getElementById('GOLD_Highlight').value.trim();
            var GOLD_SUMMARY=document.getElementById('GOLD_SUMMARY').value.trim();  

            if(uploadfileone==''){
                  $('#uploadfileoner').html("Please upload gold images");
                  $('#uploadfileone').focus();
                   return false;
            }
             if(GLOD_TITLE==''){
               $('#GLOD_TITLEr').html("Please enter gold title");
               $('#GLOD_TITLE').focus();
                return false;
            }
             /*if(GOLD_SUMMARY==''){
               $('#GOLD_SUMMARYr').html("Please enter gold summary");
               $('#GOLD_SUMMARY').focus();
                return false;
            }*/
              if(GOLD_Minting_Charges==''){
               $('#GOLD_Minting_Chargesr').html("Please enter minting charges");
               $('#GOLD_Minting_Chargesr').focus();
                return false;
              }
             if(GOLD_WEIGHT==''){
               $('#GOLD_WEIGHTr').html("Please enter price");
               $('#GOLD_WEIGHT').focus();
                return false;
            }
            /*if(GOLD_Highlight==''){
              $('#GOLD_Highlightr').html("please enter gold highlight description");
              $("#GOLD_Highlight").focus();
              return false;
              }*/
             $("#loading").show(); 
	}
	
	
	
	function updateimages(){
           
			  var title=document.getElementById('title').value.trim();
			  var description=document.getElementById('description').value.trim();
			    var price=document.getElementById('price').value.trim();
							var quntity=document.getElementById('quntity').value.trim();
			   if(title==''){
			     $('#titler').html("Please enter product name");
				 $('#title').focus();
				 return false;
			  }
			  
			   if(price==''){
			     $('#pricer').html("Please enter price");
				 $('#price').focus();
				 return false;
			  }
			   if(quntity==''){
			    $('#quntityr').html("please enter quantity");
				$("#quntity").focus();
				 return false;
			    }
			   $("#loading").show(); 
	       //var formData = new FormData($("#myproductupdatedd")[0]);
			 //alert(formData); return false;
			/*$.ajax({   
				url: "post.php?action=UpdateProductImages",
				data : formData,
				processData: false,
				contentType: false,
				type: 'POST',
				success: function(data){
					if(data==1){
					    window.location='product.php';
						return false;
				     	}else {
                        alert('uploaded images limit only 4 images upload at time')
					 return false;
					}
					
				}
			});
			return false;
			*/

	}
</script>
    
<div class="container-fluid">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"> <a href="<?php echo  site_url(); ?>support-dashboard">Dashboard</a> </li>
    <li class="breadcrumb-item active">Delivery Product</li>
  </ol>
 <?php if(isset($_GET['new_gold'])){ ?>
      <div class="card mb-3">
      <div class="card-header"> <i class="fa fa-table"></i> Add New Delivery Gold</div>
    <div class="card-body">
    <form method="post" enctype="multipart/form-data" class="form-horizontal form-label-left"  id="temponefilesss">
    <label class="control-label" for="first-name" style="text-align:left ">Upload Gold Images:<span class="required">*</span></label>
    <div class="row">
        <div class="row" id="getimagessss">
            
       </div>
    <div class="col-md-2" style="padding-right:10px;">
    <div class="fileUpload">
    <span class="custom-span">+</span>
    <input id="uploadfileone" name="uploadfileone[]" type="file" class="upload" multiple onChange="insertempdata();"  />
    </div>
    </div>
    </div>
    <span id="uploadfileoner" style="color:red;"></span>
    </form>
        <form role="form" method="post" id="insertmyproducts" action="<?php echo site_url(); ?>SupportController/insert_delivery_gold_product">
							<div class="form-group">
                                                            <br>
									<label>Gold Title<b style="color:red;"> *</b></label>
									<input type="text" id="GLOD_TITLE" name="GLOD_TITLE"  onChange="GLOD_TITLEr();" placeholder="Gold Title" class="form-control">
									<span id="GLOD_TITLEr" style="color:red;"></span>
									</div>
								
								<div class="form-group">
                                                             
								<label> Gold Summary<b style="color:red;"> *</b></label>
									<textarea type="text" id="GOLD_SUMMARY" name="GOLD_SUMMARY" onChange="GOLD_SUMMARYr()" placeholder="Gold Summary" style="resize:none " rows="8" class="form-control ckeditor"></textarea>
									<span id="GOLD_SUMMARYr" style="color:red;"></span>
									</div>
										
				
							          <div class="form-group">
									<label>Minting Charges<b style="color:red;"> *</b></label>
									<input type="text" id="GOLD_Minting_Charges" name="GOLD_Minting_Charges" placeholder="Minting Charges"  onChange="GOLD_Minting_Chargesr()" class="form-control">
									
									<span id="GOLD_Minting_Chargesr" style="color:red;"></span>
									</div>
            
                                                                      <div class="form-group">
									<label>Gold Weight<b style="color:red;"> *</b></label>
                                                                        <input type="number" min="0" maxlength="10" id="GOLD_WEIGHT" name="GOLD_WEIGHT" placeholder="Gold Weight "  onChange="GOLD_WEIGHTr()" class="form-control">
									<span id="GOLD_WEIGHTr" style="color:red;"></span>
									</div>
									
                                                                   <div class="form-group">
									<label>Gold Highlight</label>
									<textarea type="text" id="GOLD_Highlight" name="GOLD_Highlight"  placeholder="Gold Highlight" style="resize:none " rows="8" class="form-control ckeditor"></textarea>
									<span id="GOLD_Highlightr" style="color:red;"></span>
									</div>
							
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <input type="submit" class="btn btn-primary" onClick="return addarticals();" value="Add Gold Product"></div>
                                            </div>
							
				
					</div>
                                      </form>
    </div>
 
 <?php }elseif(isset($_GET['update'])){ 
      $GOLD_PRODUCT=$this->db->query("select *from GOLD_PRODUCT where ID='".$_GET['update']."'")->row();
     ?>
<div class="card mb-3">
      <div class="card-header"> <i class="fa fa-table"></i> Update Delivery Gold</div>
    <div class="card-body">

        <form role="form" method="post" id="insertmyproducts" action="<?php echo site_url(); ?>SupportController/update_delivery_gold_product">
							<div class="form-group">
                                                            <input type="hidden" value="<?php echo $_GET['update']; ?>" id="ID" name="ID">
                                                            <br>
									<label>Gold Title<b style="color:red;"> *</b></label>
                                                                        <input type="text" id="GLOD_TITLE" name="GLOD_TITLE" value="<?php echo $GOLD_PRODUCT->GLOD_TITLE; ?>"  onChange="GLOD_TITLEr();" placeholder="Gold Title" class="form-control">
									<span id="GLOD_TITLEr" style="color:red;"></span>
									</div>
								
								<div class="form-group">
                                                             
								<label> Gold Summary<b style="color:red;"> *</b></label>
									<textarea type="text" id="GOLD_SUMMARY" name="GOLD_SUMMARY"  onChange="GOLD_SUMMARYr()" placeholder="Gold Summary" style="resize:none " rows="8" class="form-control ckeditor"><?php echo $GOLD_PRODUCT->GOLD_SUMMARY; ?></textarea>
									<span id="GOLD_SUMMARYr" style="color:red;"></span>
									</div>
										
				
							          <div class="form-group">
									<label>Minting Charges<b style="color:red;"> *</b></label>
                                                                        <input type="text" id="GOLD_Minting_Charges" value="<?php echo $GOLD_PRODUCT->GOLD_Minting_Charges; ?>" name="GOLD_Minting_Charges" placeholder="Minting Charges"  onChange="GOLD_Minting_Chargesr()" class="form-control">
									
									<span id="GOLD_Minting_Chargesr" style="color:red;"></span>
									</div>
            
                                                                      <div class="form-group">
									<label>Gold Weight<b style="color:red;"> *</b></label>
                                                                        <input type="number" min="0" maxlength="10" id="GOLD_WEIGHT" value="<?php echo $GOLD_PRODUCT->GOLD_WEIGHT; ?>" name="GOLD_WEIGHT" placeholder="Gold Weight "  onChange="GOLD_WEIGHTr()" class="form-control">
									<span id="GOLD_WEIGHTr" style="color:red;"></span>
									</div>
									
                                                                   <div class="form-group">
									<label>Gold Highlight</label>
									<textarea type="text" id="GOLD_Highlight" name="GOLD_Highlight" value=""  placeholder="Gold Highlight" style="resize:none " rows="8" class="form-control ckeditor"><?php echo $GOLD_PRODUCT->GOLD_Highlight; ?></textarea>
									<span id="GOLD_Highlightr" style="color:red;"></span>
									</div>
							
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <input type="submit" class="btn btn-primary" onClick="return addarticals();" value="Update Gold Product"></div>
                                            </div>
							
				
					</div>
                                      </form>
    </div>
 <?php }elseif(isset($_GET['view'])){
       $GOLD_PRODUCT=$this->db->query("select *from GOLD_PRODUCT where ID='".$_GET['view']."'")->row();
       $product_images=$this->db->query("select *from product_images where pid='".$_GET['view']."'")->result();
     ?>
  <div class="card mb-3">
      <div class="card-header"> <i class="fa fa-eye"></i> View Gold Product <a href="<?php echo site_url(); ?>add_new_product_admin" class="btn btn-primary btn-sm"> Back</a></div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" width="100%" cellspacing="0">
             <thead>
                 <tr><th>Gold Title</th><td><?php echo $GOLD_PRODUCT->GLOD_TITLE; ?></td></tr>  
                <tr><th>Gold Minting Charges</th><td><?php echo $GOLD_PRODUCT->GOLD_Minting_Charges; ?></td></tr> 
                <tr><th>Gold Weight</th><td><?php echo $GOLD_PRODUCT->GOLD_WEIGHT; ?> /gm</td></tr> 
                <tr><th>Gold Highlight Description</th><td><?php echo $GOLD_PRODUCT->GOLD_Highlight; ?></td></tr>
                <tr><th>Gold Summary</th><td><?php echo $GOLD_PRODUCT->GOLD_SUMMARY; ?></td></tr>
                <tr><th>Gold Images</th>
                    <td>
                <?php foreach($product_images as $row){ ?>    
                 <img src="<?php echo base_url(); ?>assets/gold/<?php echo $row->product_path; ?>" class="img-thumbnail" style="width:150px;height:100px;"> 
                <?php } ?>      
                    </td>
                </tr>
            </thead>   
            
        
        </table>
      </div>
    </div>
  </div>
 <?php }else{ ?>
  <div class="card mb-3">
      <div class="card-header"> <i class="fa fa-table"></i> Delivery Product <a href="<?php echo site_url(); ?>add_new_product_admin?new_gold=gold" class="btn btn-primary btn-sm"> Add New Gold</a></div>
    <div class="card-body">
	 <?php if(isset($_SESSION['successmsg'])){ ?><div class="alert alert-success"><?php echo $_SESSION['successmsg'];  ?></div><?php unset($_SESSION['successmsg']); } ?>
      <div class="table-responsive">
        <table class="table table-bordered" id="particulars_products" width="100%" cellspacing="0">
             <thead>
                          <th>Sr. No</th>  
                          <th>Gold Title</th>
                          <th>Minting Charges</th>
                          <th>Gold Weight</th>
                          <th>Created Date</th>
                         <th>Action</th>
                         
            </thead>   
        
        </table>
      </div>
    </div>
  </div>
<?php } ?>   
    
</div>
<script>
function status_changed(ID,status){
   con=confirm('are you sure the update status');
   if(con==true){
        $.ajax({ "url":"<?php echo site_url(); ?>SupportController/update_delivery_status",
             "type":"POST",
              data:{ID:ID,status:status},
              success:function(data){
                 if(data==1){
                  window.location='add_new_product_admin';
                   return false;
                 }else{
                   alert();
                 }
             }    
         });
        }else{
       return false;  
    }
}
</script>
