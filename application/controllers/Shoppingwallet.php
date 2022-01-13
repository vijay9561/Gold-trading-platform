<?php

class Shoppingwallet extends MY_Controller {

    var $current_date;
    var $current_timestamp;

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('date');
        $current_date = date('Y-m-d');
        $current_timestamp = date('Y-m-d h:m:s');
        $this->load->model("GenericModel");
    }           
public function kyc_users_list(){
$this->data['title']='KYC Users List';
$this->data['template']='kyc_users_list';
$this->data['page']='KYC Users List';
$this->layout_admin($this->data);
 }

 
  public function get_kyc_users_list(){
                $list = $this->Support_Model->get_datatables_kyc();
                $data = array();
                $no = $_POST['start']+1;
                // echo $_GET['from_date'];
                 // exit;
                $Lo_kyc_master=$this->db->query("select *from Lo_kyc_master")->result();
                $addhar_status='';
                $pan_status='';
                $bank_status='';
                $bank_status='';
                $rejected_popup_adhar='';
                $rejected_popup_pan='';
                $rejected_popup_bank='';
                $adhar_class='';
                $pan_class='';
                $bank_class='';
                
                foreach ($list as $rows) {
                    $no++;
                 // addhar status
                if($rows->aadhar_status=='approved'){
                  $adhar_class='success';     
                }elseif($rows->aadhar_status=='pending'){
                   $adhar_class='warning'; 
                }elseif($rows->aadhar_status=='reject'){
                 $adhar_class='danger';   
                }elseif($rows->aadhar_status=='unverified'){
                 $adhar_class='danger';   
                }
                
                if($rows->pan_card_status=='approved'){
                  $pan_class='success';     
                }elseif($rows->pan_card_status=='pending'){
                   $pan_class='warning'; 
                }elseif($rows->pan_card_status=='reject'){
                 $pan_class='danger';   
                }elseif($rows->pan_card_status=='unverified'){
                 $pan_class='danger';   
                }
                
                 if($rows->bank_statement_status=='approved'){
                  $bank_class='success';     
                }elseif($rows->bank_statement_status=='pending'){
                   $bank_class='warning'; 
                }elseif($rows->bank_statement_status=='reject'){
                 $bank_class='danger';   
                }elseif($rows->bank_statement_status=='unverified'){
                 $bank_class='danger';   
                }
                
                $addhar_status='<div class="dropdown">
    <button class="btn btn-'.$adhar_class.' dropdown-toggle" type="button" data-toggle="dropdown">'.$rows->aadhar_status.'
    <span class="caret"></span></button>';
    $addhar_status.='<ul class="dropdown-menu">';
    foreach($Lo_kyc_master as $ad){  
     if($ad->name!=$rows->aadhar_status){
      if($ad->name=='reject'){
     $addhar_status.='<li><a href="#" data-toggle="modal" data-target="#adhar'.$no.'">'.$ad->name.'</a></li>';
      }else{
     $addhar_status.='<li><a href="#" onclick="return bank_status('.$ad->id.','.$rows->userid.',1)">'.$ad->name.'</a></li>';      
      }
     }
    }
    $addhar_status.='</ul>
  </div>';
    
     $pan_status='<div class="dropdown">
    <button class="btn btn-'.$pan_class.' dropdown-toggle" type="button" data-toggle="dropdown">'.$rows->pan_card_status.'
    <span class="caret"></span></button>';
    $pan_status.='<ul class="dropdown-menu">';
    foreach($Lo_kyc_master as $pan){  
     if($pan->name!=$rows->pan_card_status){
         if($pan->name=='reject'){
     $pan_status.='<li><a href="#" data-toggle="modal" data-target="#pan'.$no.'">'.$pan->name.'</a></li>';
      }else{
     $pan_status.='<li><a href="#" onclick="return bank_status('.$pan->id.','.$rows->userid.',2)">'.$pan->name.'</a></li>';
     }
     }
    }
    $pan_status.='</ul>
  </div>';
          
   $bank_status='<div class="dropdown">
    <button class="btn btn-'.$bank_class.' dropdown-toggle" type="button" data-toggle="dropdown">'.$rows->bank_statement_status.'
    <span class="caret"></span></button>';
    $bank_status.='<ul class="dropdown-menu">';
    foreach($Lo_kyc_master as $bak){  
     if($bak->name!=$rows->bank_statement_status){
          if($bak->name=='reject'){
     $bank_status.='<li><a href="#" data-toggle="modal" data-target="#bank'.$no.'">'.$bak->name.'</a></li>';
      }else{
     $bank_status.='<li><a href="#" onclick="return bank_status('.$bak->id.','.$rows->userid.',3)">'.$bak->name.'</a></li>';
      }
     }
    }
    $bank_status.='</ul>
  </div>';
    $rejected_popup_adhar='<div class="modal fade" id="adhar'.$no.'" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          
          <h4 class="modal-title">Reject Note</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
         <div class="form-group">
      <textarea class="form-control" name="cancel_adhar_note" id="cancel_adhar_note'.$no.'"></textarea>     
    </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="return update_status_addhar(2,'.$rows->userid.',1,'.$no.')">Submit</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
</div>';
    
     $rejected_popup_bank='<div class="modal fade" id="bank'.$no.'" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
         
          <h4 class="modal-title">Reject Note</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
         <div class="form-group">
      <textarea class="form-control" name="cancel_adhar_note" id="cancel_bank_note'.$no.'"></textarea>     
    </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="return update_status_bank(2,'.$rows->userid.',3,'.$no.')">Submit</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
</div>';
     
     
    
     
     
      $rejected_popup_pan='<div class="modal fade" id="pan'.$no.'" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
         
          <h4 class="modal-title">Reject Note</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
         <div class="form-group">
      <textarea class="form-control" name="cancel_adhar_note" id="cancel_pan_note'.$no.'"></textarea>     
    </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="return update_status_pan(2,'.$rows->userid.',2,'.$no.')">Submit</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
</div>';
      
      
   $frant='<div class="modal fade" id="frant'.$no.'" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
         
          <h4 class="modal-title">Verify Image</h4>
           <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
         <div class="form-group">
      <img src="'. base_url().'kyc/adhar/'.$rows->aadhar_frant_side.'" class="img-thumbnail" style="width:100%;"/>  
    </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
</div>';
   
   
   $baki='<div class="modal fade" id="back'.$no.'" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
         
          <h4 class="modal-title">Verify Image</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
         <div class="form-group">
      <img src="'. base_url().'kyc/adhar/'.$rows->aadhar_back_side.'" class="img-thumbnail" style="width:100%;"/>  
    </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
</div>';
   
   $pani='<div class="modal fade" id="pani'.$no.'" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          
          <h4 class="modal-title">Verify Image</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
         <div class="form-group">
      <img src="'.base_url().'kyc/pan/'.$rows->pan_card.'" class="img-thumbnail" style="width:100%;"/>  
    </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
</div>';
   
   
    $banki='<div class="modal fade" id="banki'.$no.'" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
         
          <h4 class="modal-title">Verify Image</h4>
           <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
         <div class="form-group">
      <img src="'.base_url().'kyc/bank/'.$rows->bank_statement.'" class="img-thumbnail" style="width:100%;"/>  
    </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
</div>';
                    $row = array();
                    $row[] = $no;
                    $row[] = $rows->FULLNAME;
                    $row[] =$rows->MOBILE;
                    $row[] =$rows->account_no;
                    $row[] =$rows->ifsc_code;
                    $row[] =$rows->acount_holder;
                    if(!empty($rows->aadhar_frant_side)){
                    $row[] ='<a href="#" data-toggle="modal" data-target="#frant'.$no.'"><img src="'. base_url().'kyc/adhar/'.$rows->aadhar_frant_side.'" class="img-thumbnail" style="width:120px;height:80px"/></a>'.$frant;
                    }else{
                    $row[] ='<b style="color:red;">NA</b>';    
                    }
                    
                    if(!empty($rows->aadhar_back_side)){
                    $row[] ='<a href="#" data-toggle="modal" data-target="#back'.$no.'"><img src="'. base_url().'kyc/adhar/'.$rows->aadhar_back_side.'" class="img-thumbnail" style="width:120px;height:80px"/></a>'.$baki;
                    }else{
                    $row[] ='<b style="color:red;">NA</b>';    
                    }
                    $row[]=$addhar_status.$rejected_popup_adhar;
                 
                    if(!empty($rows->bank_statement)){
                    $row[] ='<a href="#" data-toggle="modal" data-target="#banki'.$no.'"><img src="'. base_url().'kyc/bank/'.$rows->bank_statement.'" class="img-thumbnail" style="width:120px;height:80px"/></a>'.$banki;
                    }else{
                    $row[] ='<b style="color:red;">NA</b>';    
                    }
                    $row[]=$bank_status.$rejected_popup_bank;
                    $row[] ='<i class="fa fa-calendar"></i> '. $rows->created_date; 
                    $data[] = $row;
              
                }
                         $output = array("draw" => $_POST['draw'],
                                      "recordsTotal" => $this->Support_Model->count_all_admin_kyc(),
                                      "recordsFiltered" => $this->Support_Model->count_filtered_kyc(),
                                       "data" => $data,);
                //output to json format
                echo json_encode($output);
            } 
public function bank_status_update(){
   $id=$this->input->post('id');
   $userid=$this->input->post('userid');
   $type=$this->input->post('type');
   $b_array='';
   $get=$this->db->query("select name from Lo_kyc_master  where id='$id'")->row();
   if($type==1){
   $b_array=array('aadhar_status'=>$get->name);
   
   }elseif($type==2){
   $b_array=array('pan_card_status'=>$get->name);    
   }elseif($type==3){
    $b_array=array('bank_statement_status'=>$get->name);   
   }
   $this->db->where('userid',$userid);
  $q=$this->db->update('Lo_kyc_verification',$b_array);
   if($q==true){
       $this->session->set_userdata('success','Status Updated Successfully..');
       
    //
   $ur=$this->db->query("select u.FULLNAME,u.EMAIL,u.MOBILE  from Lo_kyc_verification l inner join USERS u on u.ID=l.userid  where l.aadhar_status='approved' and l.bank_statement_status='approved' and l.userid='$userid'")->row();  
  
    if(count($ur)>=1){        
     $messagebody='<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--[if !mso]><!-->
<!--<![endif]-->
<title></title>
<link href="https://fonts.googleapis.com/css?family=Droid+Serif" rel="stylesheet" type="text/css">
</head><body style="background-color:#edeff0">
<table class="nl-container" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #edeff0;width: 100%; padding-top:20px; padding-bottom:20px;" cellpadding="0" cellspacing="0">
  <tbody>
    <tr style="vertical-align: top">
      <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top; padding-top: 20px;padding-bottom: 20px;"><!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color: #FADDBB;"><![endif]-->
        <div style="background-color:transparent;">
          <div style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #FFFFFF;" class="block-grid ">
            <div style="border-collapse: collapse;display: table;width: 100%;background-color:#FFFFFF;">
              <div class="col num12" style="min-width: 320px;max-width: 600px;display: table-cell;vertical-align: top;">
                <div style="background-color: transparent; width: 100% !important;">
                  <!--[if (!mso)&(!IE)]><!-->
                  <div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:0px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
                    <!--<![endif]-->
                    <div align="center" class="img-container center  autowidth  fullwidth " style="padding-right: 0px;  padding-left: 0px;background-color: #2b2a2a;">
                      <div style="line-height:15px;font-size:1px">&#160;</div>
                      <img class="center  autowidth  fullwidth" align="center" border="0" src="http://suvarnasiddhi.com/assets/images/sslogo2.png" alt="Image" title="Image" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: 0;float: none;width: 320px;max-width: 600px;width:10%;" width="600">
                      <div style="line-height:15px;font-size:1px">&#160;</div>
                      <!--[if mso]></td></tr></table><![endif]-->
                    </div>
                    <!--[if (!mso)&(!IE)]><!-->
                  </div>
                  <!--<![endif]-->
                </div>
              </div>
              <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
            </div>
          </div>
        </div>
        <div style="background-color:transparent;">
          <div style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #FFFFFF;" class="block-grid ">
            <div style="border-collapse: collapse;display: table;width: 100%;background-color:#FFFFFF;">
              <div class="col num12" style="min-width: 320px;max-width: 600px;display: table-cell;vertical-align: top;">
                <div style="background-color: transparent; width: 100% !important;">
                  <!--[if (!mso)&(!IE)]><!-->
                  <div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:5px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
                    <!--<![endif]-->
                    <div class="">
             <div style="line-height:120%;color:#febc11;font-family:Droid Serif, Georgia, Times, Times New Roman, serif; padding-right: 10px; padding-left: 10px; padding-top: 0px;
padding-bottom: 3px;">
                        <div style="font-size:12px;line-height:14px;font-family:Droid Serif, Georgia, Times, Times New Romanserif;color:#f39229;text-align:left;">
                          <p style="margin: 0;font-size: 14px;line-height: 17px;text-align: center"><span style="font-size: 36px; line-height:20px;"><strong><span style="line-height:20px; font-size:20px;">
                          Welcome To Suvarnasiddhi</span></strong></span></p>
                        </div>
                      </div>
                      <!--[if mso]></td></tr></table><![endif]-->
                    </div>
                    <div >
                    </div>
                    <div>
             <div style="color:#555555;font-family:Droid SerifGeorgia, Times,Times New Roman,serif; padding-right: 10px; padding-left: 10px; padding-top: 10px; margin-top:-50px;">
                        <div style="font-size:12px;line-height:24px;color:#555555;font-family:Droid SerifGeorgia, Times,Times New Roman,serif;text-align:left;">
                          <span style="font-size:16px; line-height:19px; margin-left:20px;">
						    <p style="font-size: 14px;text-align:left;"><strong><span style="font-size:18px;">Hello '.$ur->FULLNAME.',</strong></p>
                          <p style="color: #000000; text-align:justify; font-size:16px;">
                          Your KYC Document Verified successfully
						
                        </div>
                      </div>
                    </div>
					<br>
					
              <br /><br />
					<div style="margin-left:10px; margin-bottom:10px;"><strong style="font-size:16px;font-style: italic;">Thanks & Regards</strong><br />
					<span style="padding-top:20px; margin-top:10px;">suvarnasiddhi Team</span><br />
					<span style="padding-top:20px; margin-top:10px;">Visit us at   <a target="_blank" href="http://www.suvarnasiddhi.com/"> http://www.suvarnasiddhi.com/</a></span>
					</div>
                    <div style="background-color: #4e4646;">
                      <div class="">
                     
                        <div style="line-height:120%;color:#F99495;font-family:Droid SerifGeorgia, Times,Times New Roman,serif; padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 25px;">
                          <div style="font-size:12px;line-height:14px;color:#fff;font-family:Droid SerifGeorgia, Times,Times New Roman,serif;text-align:left;">
                            <p style="margin: 0;font-size:18px;line-height: 17px;text-align: center"><span style="font-size:14px; line-height: 13px;"> 
							Please do not reply to this email. Emails sent to this address will not be answered.
							<br />Note: If it wasn&#39;t you please immediately contact  <a href="mailto:support@suvarnasiddhi.com" style="color:#fab029;" target="_blank">support@suvarnasiddhi.com</a>.
                              Once again, we thank you for using Suvarnasiddhi Gold trusted products.
                              </span>
                            </p>
                          </div>
                        </div>
                        <!--[if mso]></td></tr></table><![endif]-->
                      </div>
                      <div align="center" style="padding-right: 10px; padding-left: 10px; padding-bottom:10px;" class="">
                        <div style="line-height:10px;font-size:1px">&#160;</div>
                        <div style="display: table;">
                          <table align="left" border="0" cellspacing="0" cellpadding="0" tyle="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;Margin-right: 5px">
                            <tbody>
                              <tr style="vertical-align: top">
                              
							
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </td>
    </tr>
  </tbody>
</table>
</body>
</html>';
 $subject='Suvarnasiddhi KYC Document Verified Successfully';
$successmsg='';
$errmsg='';
    $response = $this->GenericModel->sendEmail($ur->EMAIL, "noreplay@suvarnasiddhi.com", $subject, $messagebody, $successmsg, $errmsg);
    }  
       echo 1;
       exit;
       
   }else{
       echo 2;
       exit;
   }
  } 
  
  public function bank_status_update_note(){
   $id=$this->input->post('id');
   $userid=$this->input->post('userid');
   $type=$this->input->post('type');
   $note=$this->input->post('note');
   $b_array='';
   $get=$this->db->query("select name from Lo_kyc_master  where id='$id'")->row();
   if($type==1){
   $b_array=array('aadhar_status'=>$get->name,'cancel_adhar_note'=>$note);
   }elseif($type==2){
   $b_array=array('pan_card_status'=>$get->name,'cancel_pan_note'=>$note);    
   }elseif($type==3){
    $b_array=array('bank_statement_status'=>$get->name,'cancel_bank_note'=>$note);   
   }
   $this->db->where('userid',$userid);
  $q=$this->db->update('Lo_kyc_verification',$b_array);
  
  $ur=$this->db->query("select u.FULLNAME,u.EMAIL,u.MOBILE  from Lo_kyc_verification l inner join USERS u on u.ID=l.userid  where l.aadhar_status='reject' or l.bank_statement_status='reject' and l.userid='$userid'")->row();  
  
    if(count($ur)>=1){        
     $messagebody='<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--[if !mso]><!-->
<!--<![endif]-->
<title></title>
<link href="https://fonts.googleapis.com/css?family=Droid+Serif" rel="stylesheet" type="text/css">
</head><body style="background-color:#edeff0">
<table class="nl-container" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #edeff0;width: 100%; padding-top:20px; padding-bottom:20px;" cellpadding="0" cellspacing="0">
  <tbody>
    <tr style="vertical-align: top">
      <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top; padding-top: 20px;padding-bottom: 20px;"><!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color: #FADDBB;"><![endif]-->
        <div style="background-color:transparent;">
          <div style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #FFFFFF;" class="block-grid ">
            <div style="border-collapse: collapse;display: table;width: 100%;background-color:#FFFFFF;">
              <div class="col num12" style="min-width: 320px;max-width: 600px;display: table-cell;vertical-align: top;">
                <div style="background-color: transparent; width: 100% !important;">
                  <!--[if (!mso)&(!IE)]><!-->
                  <div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:0px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
                    <!--<![endif]-->
                    <div align="center" class="img-container center  autowidth  fullwidth " style="padding-right: 0px;  padding-left: 0px;background-color: #2b2a2a;">
                      <div style="line-height:15px;font-size:1px">&#160;</div>
                      <img class="center  autowidth  fullwidth" align="center" border="0" src="http://suvarnasiddhi.com/assets/images/sslogo2.png" alt="Image" title="Image" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: 0;float: none;width: 320px;max-width: 600px;width:10%;" width="600">
                      <div style="line-height:15px;font-size:1px">&#160;</div>
                      <!--[if mso]></td></tr></table><![endif]-->
                    </div>
                    <!--[if (!mso)&(!IE)]><!-->
                  </div>
                  <!--<![endif]-->
                </div>
              </div>
              <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
            </div>
          </div>
        </div>
        <div style="background-color:transparent;">
          <div style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #FFFFFF;" class="block-grid ">
            <div style="border-collapse: collapse;display: table;width: 100%;background-color:#FFFFFF;">
              <div class="col num12" style="min-width: 320px;max-width: 600px;display: table-cell;vertical-align: top;">
                <div style="background-color: transparent; width: 100% !important;">
                  <!--[if (!mso)&(!IE)]><!-->
                  <div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:5px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
                    <!--<![endif]-->
                    <div class="">
             <div style="line-height:120%;color:#febc11;font-family:Droid Serif, Georgia, Times, Times New Roman, serif; padding-right: 10px; padding-left: 10px; padding-top: 0px;
padding-bottom: 3px;">
                        <div style="font-size:12px;line-height:14px;font-family:Droid Serif, Georgia, Times, Times New Romanserif;color:#f39229;text-align:left;">
                          <p style="margin: 0;font-size: 14px;line-height: 17px;text-align: center"><span style="font-size: 36px; line-height:20px;"><strong><span style="line-height:20px; font-size:20px;">
                          Welcome To Suvarnasiddhi</span></strong></span></p>
                        </div>
                      </div>
                      <!--[if mso]></td></tr></table><![endif]-->
                    </div>
                    <div >
                    </div>
                    <div>
             <div style="color:#555555;font-family:Droid SerifGeorgia, Times,Times New Roman,serif; padding-right: 10px; padding-left: 10px; padding-top: 10px; margin-top:-50px;">
                        <div style="font-size:12px;line-height:24px;color:#555555;font-family:Droid SerifGeorgia, Times,Times New Roman,serif;text-align:left;">
                          <span style="font-size:16px; line-height:19px; margin-left:20px;">
						    <p style="font-size: 14px;text-align:left;"><strong><span style="font-size:18px;">Hello '.$ur->FULLNAME.',</strong></p>
                          <p style="color: #000000; text-align:justify; font-size:16px;">
                          Your KYC Document Rejected<br>
                          <p>'.$note.'</p>
		 
                        </div>
                      </div>
                    </div>
					<br>
					
              <br /><br />
					<div style="margin-left:10px; margin-bottom:10px;"><strong style="font-size:16px;font-style: italic;">Thanks & Regards</strong><br />
					<span style="padding-top:20px; margin-top:10px;">suvarnasiddhi Team</span><br />
					<span style="padding-top:20px; margin-top:10px;">Visit us at   <a target="_blank" href="http://www.suvarnasiddhi.com/"> http://www.suvarnasiddhi.com/</a></span>
					</div>
                    <div style="background-color: #4e4646;">
                      <div class="">
                     
                        <div style="line-height:120%;color:#F99495;font-family:Droid SerifGeorgia, Times,Times New Roman,serif; padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 25px;">
                          <div style="font-size:12px;line-height:14px;color:#fff;font-family:Droid SerifGeorgia, Times,Times New Roman,serif;text-align:left;">
                            <p style="margin: 0;font-size:18px;line-height: 17px;text-align: center"><span style="font-size:14px; line-height: 13px;"> 
							Please do not reply to this email. Emails sent to this address will not be answered.
							<br />Note: If it wasn&#39;t you please immediately contact  <a href="mailto:support@suvarnasiddhi.com" style="color:#fab029;" target="_blank">support@suvarnasiddhi.com</a>.
                              Once again, we thank you for using Suvarnasiddhi trusted products.
                              </span>
                            </p>
                          </div>
                        </div>
                        <!--[if mso]></td></tr></table><![endif]-->
                      </div>
                      <div align="center" style="padding-right: 10px; padding-left: 10px; padding-bottom:10px;" class="">
                        <div style="line-height:10px;font-size:1px">&#160;</div>
                        <div style="display: table;">
                          <table align="left" border="0" cellspacing="0" cellpadding="0" tyle="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;Margin-right: 5px">
                            <tbody>
                              <tr style="vertical-align: top">
                              		
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </td>
    </tr>
  </tbody>
</table>
</body>
</html>';
 $subject='Suvarnasiddhi KYC Document Rejected';
$successmsg='';
$errmsg='';
    $response = $this->GenericModel->sendEmail($ur->EMAIL, "noreplay@suvarnasiddhi.com", $subject, $messagebody, $successmsg, $errmsg);
    }
   if($q==true){
       $this->session->set_userdata('success','Status Updated Successfully..');
       echo 1;
       exit;
   }else{
       echo 2;
       exit;
   }
  } 
  
 
}
