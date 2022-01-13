<?php
require_once APPPATH."/third_party/instamojo/instamojo.php";
class Api_Controller  extends MY_Controller{
    public function __construct() {
    parent::__construct();
  //   ini_set("allow_url_fopen", 1);
   }
/*public function live_api_rates_glod(){
 ini_set("allow_url_fopen", 1);
 $url='https://www.moneycontrol.com/commodity/gold-price.html';
$html = file_get_contents( $url);
libxml_use_internal_errors( true);
$doc = new DOMDocument;
$doc->loadHTML( $html);
$xpath = new DOMXpath( $doc);
// A name attribute on a <div>???
$node = $xpath->query('//span[@class="gr_30"]')->item(0);
 $gold_rate=$node->textContent+500; // This will print **GET THIS TEXT**
 //exit;
if($node==true){
$quryt=$this->db->query("update GOLD_RATE_MASTER set GOLD_BUY='$gold_rate',dates_timespan='".date('Y-m-d H:i:s')."' where ID=1");
  echo 'Glod Rate Updated Successfully..';
   exit;
}else{
    echo 'Not Updated';
   exit;  
}
if($quryt==true){
 
  }
 }*/

 public function live_api_rates_glod(){
  ini_set("allow_url_fopen", 1);
  ini_set('allow_url_fopen',1);
  $url='https://www.moneycontrol.com/commodity/gold-price.html';
  $ch = curl_init();
 curl_setopt ($ch, CURLOPT_URL, $url);
 curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
 curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
 $html = curl_exec($ch);
 libxml_use_internal_errors( true);
 $doc = new DOMDocument;
 $doc->loadHTML( $html);
 $xpath = new DOMXpath($doc);
 
 $node = $xpath->query('//span[@class="gr_30"]')->item(0);
 if(!empty($node)){
 $value=$node->nodeValue;
 $gold_rate=$value+500; // This will print **GET THIS TEXT**
 $sell_rate1 = (10 / 100) * $gold_rate; 
 $sell_rate=$gold_rate-$sell_rate1;
 if(!empty($value)){
 $quryt=$this->db->query("update GOLD_RATE_MASTER set GOLD_BUY='$gold_rate',GOLD_SELL='$sell_rate',dates_timespan='".date('Y-m-d H:i:s')."' where ID=1");
   echo 'Glod Rate Updated Successfully..';
    exit;
 }else{
     echo 'Not Updated';
    exit;  
 }
}else{
  $node = $xpath->query('//span[@class="rd_30"]')->item(0);
  $value=$node->nodeValue;
 $gold_rate=$value+500; // This will print **GET THIS TEXT**
  $sell_rate1 = (10 / 100) * $gold_rate; 
 $sell_rate=$gold_rate-$sell_rate1;
 if(!empty($value)){
 $quryt=$this->db->query("update GOLD_RATE_MASTER set GOLD_BUY='$gold_rate',GOLD_SELL='$sell_rate',dates_timespan='".date('Y-m-d H:i:s')."' where ID=1");
   echo 'Glod Rate Updated Successfully..';
    exit;
 }else{
     echo 'Not Updated';
    exit;  
 }
}
   curl_close($ch);
  }

public function users_registration(){
   // echo ''
   $FULLNAME=trim($this->input->post('FULLNAME'));
   $EMAIL=trim($this->input->post('EMAIL'));
   $PASSWORD=trim($this->input->post('PASSWORD'));
   $MOBILE=trim($this->input->post('MOBILE'));
   $REFFERAL_CODE=trim($this->input->post('REFFERAL_CODE'));
   $mobile_duplicate=$this->db->query("select MOBILE from USERS where MOBILE='$MOBILE'")->result();
   $email_duplicate=$this->db->query("select EMAIL from USERS where EMAIL='$EMAIL'")->result();
   $array=array();
   $flag='';
   $YOUR_REFERRAL = mt_rand(1000000000, 9999999999);
   if(!empty($REFFERAL_CODE)){
   $REFFERAL_CODE_get=$this->db->query("select YOUR_REFERRAL from USERS WHERE YOUR_REFERRAL='$REFFERAL_CODE'")->result();
   if(count($REFFERAL_CODE_get)==0){ 
   $flag=0;
   }else{
    $flag=1;    
   }
   }else{
    $flag=1;    
   }
  if($flag==0){
  $array=array('code'=>400,'message'=>'Referral Code Invalid'); 
  }elseif(empty($FULLNAME)){
   $array=array('code'=>400,'message'=>'Please enter your fullname'); 
   }elseif(empty($EMAIL)){
   $array=array('code'=>400,'message'=>'Please enter your email address');     
   }elseif(empty($MOBILE)){
   $array=array('code'=>400,'message'=>'Please enter your mobile number');     
   }elseif(empty($PASSWORD)){
   $array=array('code'=>400,'message'=>'Please enter your password');     
   }elseif(count($mobile_duplicate)>=1){
   $array=array('code'=>400,'message'=>'Your entered mobile number already exist');   
   }elseif(count($email_duplicate)>=1){
   $array=array('code'=>400,'message'=>'Your entered email address already exist');   
   }else{
   $insert_array=array('FULLNAME'=>$FULLNAME,'EMAIL'=>$EMAIL,'PASSWORD'=>md5($PASSWORD),'MOBILE'=>$MOBILE,'STATUS'=>'ACTIVE','OTP_VERIFY'=>'0','CREATED_DATE'=>date('Y-m-d H:i:s'),'YOUR_REFERRAL'=>$YOUR_REFERRAL,'REFFERAL_CODE'=>$REFFERAL_CODE);
   $this->db->insert('USERS',$insert_array);
   $ID=$this->db->insert_id();
   $otp = mt_rand(100000, 999999);
   $inert_otp=array('OTP'=>$otp,'USERID'=>$ID,'DATE'=>date('Y-m-d'));
   $USERS_BALANCE=array('USERID'=>$ID,'GOLD_BALANCE'=>'0.00','INR_BALANCE'=>'0.00','CREATED_DATE'=>date('Y-m-d'));
   
   $this->db->insert('USERS_OTP',$inert_otp);
   $this->db->insert('USERS_BALANCE',$USERS_BALANCE);
   
   $this->session->set_userdata('OTP_ID',$ID);
   $array=array('code'=>200,'message'=>'Your Account Registered Successfully and OTP Send your email address','OTP'=>$otp); 
   $subject='Suvarnasiddhi Verify Email OTP';
   $message='Hi ,<br>Use <b>'.$otp.'</b> as One Time Password (OTP) to complete your Suvarnasiddhi account registeration. This OTP is valid for 5 minutes. <br>Please do not share this OTP with anyone for security reasons.';
   $successmsg='';
   $errmsg='';
   $this->GenericModel->sendEmail($EMAIL,"noreplay@suvarnasiddhi.com",$subject, $message, $successmsg, $errmsg);
   }
   echo json_encode($array);
   exit;
  
  }
public function verify_otp_password(){
   $OTP=trim($this->input->post('OTP'));
   $USERID=$this->session->userdata('OTP_ID');
   $checking=$this->db->query("select OTP FROM USERS_OTP WHERE USERID='$USERID' and OTP='$OTP'")->row();
 //  echo $this->db->last_query();
  // exit;
   $array=array();
   if(count($checking)==1){
    $old_otp=$checking->OTP;
    $this->db->query("update USERS set OTP_VERIFY='1' where ID='$USERID'");
    $array=array('code'=>200,'message'=>'Your OTP Submited Successfully'); 
    $this->session->set_userdata('message','Your Account Verify Successfully');
    
    $this->session->unset_userdata('OTP_ID');
  }else{
  $array=array('code'=>400,'message'=>'Your Entered OTP Is Wrong');        
  }
   echo json_encode($array);
   exit;
}
public function login_users(){
     $MOBILE=trim($this->input->post('MOBILE'));
     $PASSWORD=trim($this->input->post('PASSWORD'));  
   $get=$this->db->query("SELECT *FROM USERS WHERE (BINARY EMAIL='".$MOBILE."' OR MOBILE='".$MOBILE."')  AND BINARY PASSWORD='".md5($PASSWORD)."'")->result();  
   $array=array();
   if(empty($MOBILE)){
   $array=array('code'=>400,'message'=>'Please enter email id or mobile number');    
   }elseif(empty($PASSWORD)){
    $array=array('code'=>400,'message'=>'Please enter password');   
   }elseif(count($get)==1){
     if($get[0]->OTP_VERIFY=='0'){
     $array=array('code'=>400,'message'=>'Please verify your email address');     
     }elseif($get[0]->STATUS=='INACTIVE'){
     $array=array('code'=>400,'message'=>'Your account is deactivated');     
     }else{
     $session_data['USERID']=$get[0]->ID;
     $session_data['EMAIL']=$get[0]->EMAIL;
     $session_data['MOBILE']=$get[0]->MOBILE;
     $session_data['FULLNAME']=$get[0]->FULLNAME;
     $session_data['REFERRAL_CODE']=$get[0]->YOUR_REFERRAL;
     $this->session->set_userdata($session_data);
     $array=array('code'=>200,'message'=>'Login Successfully Redirecting');  
     }
   }else{
   $array=array('code'=>400,'message'=>'Password OR Email Address,Mobile Number Incorrect');    
   }
   echo json_encode($array);
   exit;
  }
public function Logout(){
  $this->session->sess_destroy();
  redirect(site_url());
 }
// Forgot Password
 public function reset_password_users(){
   $EMAIL=trim($this->input->post('EMAIL'));
    $array=array();
    $msg='';
   $get=$this->db->query("select ID,EMAIL,FULLNAME FROM USERS WHERE EMAIL='$EMAIL'")->result();
   if(count($get)>=1){
      $successmsg='';
      $errmsg='';
     $subject='Forgot Password Suvarnasiddhi';
    $array=array('code'=>200,'message'=>'Reset Password Link send your email address');   
     $this->session->set_userdata('message','Reset Password Link send your email address');
     $id= base64_encode($get[0]->ID);
     $FULLNAME=$get[0]->FULLNAME;
     $msg.='<b>Dear '.$FULLNAME.' ,</b><br>Please click on the following Button to reset your password<br><br>
       <a href="'.site_url().'resest_password?rest_pass='.$id.'" style="background-color:#2a9b0e;color:white;padding:10px;text-decoration:none;border-radius:5px" target="_blank">
	Reset Password
	</a> <br><br>Please note, this link will expire after 24 hours.<br>
     If you did not request to reset your password, please ignore this email. Your account is secure.';  
  
    $this->GenericModel->sendEmail($EMAIL,"noreplay@suvarnasiddhi.com",$subject, $msg, $successmsg, $errmsg);       
   }else{
   $array=array('code'=>400,'message'=>'Your Entered Email account does not exist');    
   }
    echo json_encode($array);
   exit;
 }
public function reset_password(){
      $PASSWORD=trim($this->input->post('PASSWORD'));
      $ID1=trim($this->input->post('ID'));
      $ID= base64_decode($ID1);
    $query=$this->db->query("update USERS set PASSWORD='".md5($PASSWORD)."' where ID='$ID'");
    $array=array();
    if($query==true){
      $array=array('code'=>200,'message'=>'Your Password Reset Successfully'); 
      $this->session->set_userdata('message','Your Password Reset Successfully');
    }else{
      $array=array('code'=>400,'message'=>'Something Wrong');    
    }
    echo json_encode($array);
   exit;
  }
public function get_live_rate_buy_calculator(){
    $res = $this->site->get_live_glod_rate();
    $type=trim($this->input->post('type'));
     $Base_buy_Amount=$res['gram_rate'];
    $Buy_weight_Gold=trim($this->input->post('Buy_weight_Gold'));
    $Buy_Total_INR=trim($this->input->post('Buy_Total_INR'));
    $onegram_gold= $res['gram_rate'];
    $array=array();
    if($type=='BASE'){
     if(!is_numeric($Base_buy_Amount)){
          $array=array('code'=>400,'message'=>'Please enter amount only digit format');  
         }elseif((!empty($Buy_weight_Gold)) && (!empty($Buy_Total_INR))){
         if((!is_numeric($Buy_weight_Gold)) || (!is_numeric($Buy_Total_INR))){
         $array=array('code'=>400,'message'=>'Please enter amount only digit format');  
        }else{
         //  echo 'Hi 2';
         $rate=number_format($Buy_weight_Gold*$Base_buy_Amount, 2, '.', '');
        $array=array('code'=>200,'Base_Amount'=>$Base_buy_Amount,'Gold_Amount'=>$Buy_weight_Gold,'Total_INR'=>$rate,'Type'=>'BASE');   
         }      
       }else{
     $array=array('code'=>200,'Base_Amount'=>$Base_buy_Amount,'Gold_Amount'=>'','Total_INR'=>'','Type'=>'BASE','HI'=>'');        
       }    
    }elseif($type=='GOLD'){
      if(!empty($Buy_weight_Gold)){
      if((!is_numeric($Buy_weight_Gold)) || (!is_numeric($Base_buy_Amount))){
        $array=array('code'=>400,'message'=>'Please enter amount only digit format');  
       }else{
        $rate=number_format($Buy_weight_Gold*$Base_buy_Amount, 2, '.', '');
       $array=array('code'=>200,'Base_Amount'=>$Base_buy_Amount,'Gold_Amount'=>$Buy_weight_Gold,'Total_INR'=>$rate,'Type'=>'GOLD');   
       }    
       }else{
       $array=array('code'=>200,'Base_Amount'=>0,'Gold_Amount'=>0,'Total_INR'=>$rate,'Type'=>'GOLD');     
       }  
      }elseif($type=='INR'){
      if(!empty($Buy_Total_INR)){
      if((!is_numeric($Buy_Total_INR)) || (!is_numeric($Base_buy_Amount))){
        $array=array('code'=>400,'message'=>'Please enter amount only digit format');  
       }else{
        $rate=number_format((1*$Buy_Total_INR)/$Base_buy_Amount, 4, '.', ''); 
       $array=array('code'=>200,'Base_Amount'=>$Base_buy_Amount,'Gold_Amount'=>$rate,'Total_INR'=>'','Type'=>'INR');   
       }    
       }else{
       $array=array('code'=>200,'Base_Amount'=>0,'Gold_Amount'=>0,'Total_INR'=>0,'Type'=>'INR');     
       }  
      }else{
      $array=array('code'=>400,'message'=>'Something went wrong');    
      }
    
    echo json_encode($array);
   exit;
 }
 // sell rate
 public function get_live_rate_sell_calculator(){
    $res = $this->site->get_live_glod_rate();
    $type=trim($this->input->post('type'));
  //  echo $type;
   // exit;
     $buy=$this->site->get_live_glod_rate();
    $Base_buy_Amount=$res['sell'];
    $Buy_weight_Gold=trim($this->input->post('Buy_weight_Gold'));
    $Buy_Total_INR=trim($this->input->post('Buy_Total_INR'));
    $onegram_gold= $res['buy'];
    $array=array();
    if($type=='BASE'){
     if(!is_numeric($Base_buy_Amount)){
          $array=array('code'=>400,'message'=>'Please enter amount only digit format');  
         }elseif((!empty($Buy_weight_Gold)) && (!empty($Buy_Total_INR))){
         if((!is_numeric($Buy_weight_Gold)) || (!is_numeric($Buy_Total_INR))){
         $array=array('code'=>400,'message'=>'Please enter amount only digit format');  
        }else{
         //  echo 'Hi 2';
         $rate=number_format($Buy_weight_Gold*$Base_buy_Amount, 2, '.', '');
        $array=array('code'=>200,'Base_Amount'=>$Base_buy_Amount,'Gold_Amount'=>$Buy_weight_Gold,'Total_INR'=>$rate,'Type'=>'BASE');   
         }      
       }else{
     $array=array('code'=>200,'Base_Amount'=>$Base_buy_Amount,'Gold_Amount'=>'','Total_INR'=>'','Type'=>'BASE','HI'=>'');        
       }    
    }elseif($type=='GOLD'){
      if(!empty($Buy_weight_Gold)){
      if((!is_numeric($Buy_weight_Gold)) || (!is_numeric($Base_buy_Amount))){
        $array=array('code'=>400,'message'=>'Please enter amount only digit format');  
       }else{
        $rate=number_format($Buy_weight_Gold*$Base_buy_Amount, 2, '.', '');
       $array=array('code'=>200,'Base_Amount'=>$Base_buy_Amount,'Gold_Amount'=>$Buy_weight_Gold,'Total_INR'=>$rate,'Type'=>'GOLD');   
       }    
       }else{
       $array=array('code'=>200,'Base_Amount'=>0,'Gold_Amount'=>0,'Total_INR'=>$rate,'Type'=>'GOLD');     
       }  
      }elseif($type=='INR'){
      if(!empty($Buy_Total_INR)){
      if((!is_numeric($Buy_Total_INR)) || (!is_numeric($Base_buy_Amount))){
        $array=array('code'=>400,'message'=>'Please enter amount only digit format');  
       }else{
        $rate=number_format((1*$Buy_Total_INR)/$Base_buy_Amount, 2, '.', ''); 
       $array=array('code'=>200,'Base_Amount'=>$Base_buy_Amount,'Gold_Amount'=>$rate,'Total_INR'=>'','Type'=>'INR');   
       }    
       }else{
       $array=array('code'=>200,'Base_Amount'=>0,'Gold_Amount'=>0,'Total_INR'=>0,'Type'=>'INR');     
       }  
      }else{
      $array=array('code'=>400,'message'=>'Something went wrong');    
      }
    
    echo json_encode($array);
   exit;
 }
 // Trade Limit
 public function limit_get_live_rate_buy_calculator(){
    $res = $this->site->get_live_glod_rate();
    $type=trim($this->input->post('type'));
     $Base_buy_Amount=trim($this->input->post('Base_buy_Amount'));
    $Buy_weight_Gold=trim($this->input->post('Buy_weight_Gold'));
    $Buy_Total_INR=trim($this->input->post('Buy_Total_INR'));
    $onegram_gold= $res['buy'];
    $array=array();
    if($type=='BASE'){
     if(!is_numeric($Base_buy_Amount)){
          $array=array('code'=>400,'message'=>'Please enter amount only digit format');  
         }elseif((!empty($Buy_weight_Gold)) && (!empty($Buy_Total_INR))){
         if((!is_numeric($Buy_weight_Gold)) || (!is_numeric($Buy_Total_INR))){
         $array=array('code'=>400,'message'=>'Please enter amount only digit format');  
        }else{
         //  echo 'Hi 2';
         $rate=number_format($Buy_weight_Gold*$Base_buy_Amount, 2, '.', '');
        $array=array('code'=>200,'Base_Amount'=>$Base_buy_Amount,'Gold_Amount'=>$Buy_weight_Gold,'Total_INR'=>$rate,'Type'=>'BASE');   
         }      
       }else{
     $array=array('code'=>200,'Base_Amount'=>$Base_buy_Amount,'Gold_Amount'=>'','Total_INR'=>'','Type'=>'BASE','HI'=>'');        
       }    
    }elseif($type=='GOLD'){
      if(!empty($Buy_weight_Gold)){
      if((!is_numeric($Buy_weight_Gold)) || (!is_numeric($Base_buy_Amount))){
        $array=array('code'=>400,'message'=>'Please enter amount only digit format');  
       }else{
        $rate=number_format($Buy_weight_Gold*$Base_buy_Amount, 2, '.', '');
       $array=array('code'=>200,'Base_Amount'=>$Base_buy_Amount,'Gold_Amount'=>$Buy_weight_Gold,'Total_INR'=>$rate,'Type'=>'GOLD');   
       }    
       }else{
       $array=array('code'=>200,'Base_Amount'=>0,'Gold_Amount'=>0,'Total_INR'=>$rate,'Type'=>'GOLD');     
       }  
      }elseif($type=='INR'){
      if(!empty($Buy_Total_INR)){
      if((!is_numeric($Buy_Total_INR)) || (!is_numeric($Base_buy_Amount))){
        $array=array('code'=>400,'message'=>'Please enter amount only digit format');  
       }else{
        $rate=number_format((1*$Buy_Total_INR)/$Base_buy_Amount, 4, '.', ''); 
       $array=array('code'=>200,'Base_Amount'=>$Base_buy_Amount,'Gold_Amount'=>$rate,'Total_INR'=>'','Type'=>'INR');   
       }    
       }else{
       $array=array('code'=>200,'Base_Amount'=>0,'Gold_Amount'=>0,'Total_INR'=>0,'Type'=>'INR');     
       }  
      }else{
      $array=array('code'=>400,'message'=>'Something went wrong');    
      }
    
    echo json_encode($array);
   exit;
 }
 // sell rate
 public function limit_get_live_rate_sell_calculator(){
    $res = $this->site->get_live_glod_rate();
    $type=trim($this->input->post('type'));
  //  echo $type;
   // exit;
     $buy=$this->site->get_live_glod_rate();
    $Base_buy_Amount=trim($this->input->post('Base_buy_Amount'));
    $Buy_weight_Gold=trim($this->input->post('Buy_weight_Gold'));
    $Buy_Total_INR=trim($this->input->post('Buy_Total_INR'));
    $onegram_gold= $res['buy'];
    $array=array();
    if($type=='BASE'){
     if(!is_numeric($Base_buy_Amount)){
          $array=array('code'=>400,'message'=>'Please enter amount only digit format');  
         }elseif((!empty($Buy_weight_Gold)) && (!empty($Buy_Total_INR))){
         if((!is_numeric($Buy_weight_Gold)) || (!is_numeric($Buy_Total_INR))){
         $array=array('code'=>400,'message'=>'Please enter amount only digit format');  
        }else{
         //  echo 'Hi 2';
         $rate=number_format($Buy_weight_Gold*$Base_buy_Amount, 2, '.', '');
        $array=array('code'=>200,'Base_Amount'=>$Base_buy_Amount,'Gold_Amount'=>$Buy_weight_Gold,'Total_INR'=>$rate,'Type'=>'BASE');   
         }      
       }else{
     $array=array('code'=>200,'Base_Amount'=>$Base_buy_Amount,'Gold_Amount'=>'','Total_INR'=>'','Type'=>'BASE','HI'=>'');        
       }    
    }elseif($type=='GOLD'){
      if(!empty($Buy_weight_Gold)){
      if((!is_numeric($Buy_weight_Gold)) || (!is_numeric($Base_buy_Amount))){
        $array=array('code'=>400,'message'=>'Please enter amount only digit format');  
       }else{
        $rate=number_format($Buy_weight_Gold*$Base_buy_Amount, 2, '.', '');
       $array=array('code'=>200,'Base_Amount'=>$Base_buy_Amount,'Gold_Amount'=>$Buy_weight_Gold,'Total_INR'=>$rate,'Type'=>'GOLD');   
       }    
       }else{
       $array=array('code'=>200,'Base_Amount'=>0,'Gold_Amount'=>0,'Total_INR'=>$rate,'Type'=>'GOLD');     
       }  
      }elseif($type=='INR'){
      if(!empty($Buy_Total_INR)){
      if((!is_numeric($Buy_Total_INR)) || (!is_numeric($Base_buy_Amount))){
        $array=array('code'=>400,'message'=>'Please enter amount only digit format');  
       }else{
        $rate=number_format((1*$Buy_Total_INR)/$Base_buy_Amount, 2, '.', ''); 
       $array=array('code'=>200,'Base_Amount'=>$Base_buy_Amount,'Gold_Amount'=>$rate,'Total_INR'=>'','Type'=>'INR');   
       }    
       }else{
       $array=array('code'=>200,'Base_Amount'=>0,'Gold_Amount'=>0,'Total_INR'=>0,'Type'=>'INR');     
       }  
      }else{
      $array=array('code'=>400,'message'=>'Something went wrong');    
      }
    
    echo json_encode($array);
   exit;
 }
 // Add new addres
public function add_new_addresses(){
   $array=array();
 $USERID=$this->session->userdata('USERID');
 $NAME=trim($this->input->post('NAME'));
 $ADDRESS=trim($this->input->post('ADDRESS'));
 $PINCODE=trim($this->input->post('PINCODE'));
 $MOBILE=trim($this->input->post('MOBILE'));
 $CITY=trim($this->input->post('city'));
 $STATE=trim($this->input->post('state'));
 $count_address=$this->db->query("select USERID from ADDRESSES where USERID='$USERID'")->result();
 if(empty($NAME)){
    $array=array('code'=>400,'message'=>'Please enter your name');      
 }elseif(empty($MOBILE)){
  $array=array('code'=>400,'message'=>'Please enter your mobile number');     
  }elseif(empty($PINCODE)){
  $array=array('code'=>400,'message'=>'Please enter your pincode');    
  }elseif(empty($ADDRESS)){
  $array=array('code'=>400,'message'=>'Please enter your address');    
  }elseif(empty($STATE)){
  $array=array('code'=>400,'message'=>'Please select your state');    
  }elseif(empty($CITY)){
  $array=array('code'=>400,'message'=>'Please select your city');    
  }elseif(count($count_address)>=10){
  $array=array('code'=>400,'message'=>'10 addresses limit is exceed');     
  }else{
  $insert_array=array('NAME'=>$NAME,'USERID'=>$USERID,'MOBILE'=>$MOBILE,'PINCODE'=>$PINCODE,'CITY'=>$CITY,'STATE'=>$STATE,'CREATED_DATE'=>date('Y-m-d H:i:s'),'ADDRESS'=>$ADDRESS);
  $true=$this->db->insert('ADDRESSES',$insert_array);
  if($true==true){
   $array=array('code'=>200,'message'=>'Your address added successfully');  
   $this->session->set_userdata('message','Your address added successfully');
  }else{
   $array=array('code'=>400,'message'=>'Somthing went wrong');    
   }
  }
   echo json_encode($array);
   exit;
 }
 public function deleted_addresses(){
   $array=array();
   $id=$this->input->post('id');
   $query=$this->db->query("delete from ADDRESSES where ID='$id'");
   if($query==true){
   $this->session->set_userdata('message','Your address delete successfully'); 
   $array=array('code'=>200,'message'=>'Your Address deleted Successfully');   
   }else{
  $array=array('code'=>400,'message'=>'Somthing went wrong');     
   }
   echo json_encode($array);
   exit;
 }
 public function procced_gold_buy_payment(){
       $ID=$this->session->userdata('USERID');
       $d=$this->db->query("select *from USERS where ID='$ID'")->result();
       if(count($d)>=1){
       $api = new Instamojo\Instamojo('6618940f3c693340ea45a04fe546affa', '00523da9144deee8a5d25feabfeb24a9',' https://www.instamojo.com/api/1.1/');
       try {
    $response = $api->paymentRequestCreate(array(
        "purpose" =>'INR Deposit',
        "amount" =>$this->session->userdata('NETBUYPURCHASE'),
        "send_email" => true,
        "email" => $d[0]->EMAIL,
        "buyer_name" => $d[0]->FULLNAME,
        "phone" =>  $d[0]->MOBILE,
        "send_sms" => true,
        'allow_repeated_payments' => false,
        "redirect_url" => "http://www.suvarnasiddhi.com/thank_you_payment_recived"
       // "webhook" => "http://localhost/instamojopay/webhook.php"
    ));
    $pay_ulr = $response['longurl'];
    header("Location: $pay_ulr");
   // exit();
}
catch (Exception $e) {
    print('Error: ' . $e->getMessage());
     } 
   }else{
       redirect(site_url());   
   }
  }
   public function thank_you_payment_recived(){
      $api = new Instamojo\Instamojo('6618940f3c693340ea45a04fe546affa', '00523da9144deee8a5d25feabfeb24a9',' https://www.instamojo.com/api/1.1/');
      $payid = $_GET["payment_request_id"];            
       try {
    $response = $api->paymentRequestStatus($payid);
  //  print_r($response);
   // exit;
     $payment_id= $response['payments'][0]['payment_id'];
       $currency= $response['payments'][0]['currency'];
       $amount= $response['payments'][0]['amount'];
       $USERID=$this->session->userdata('USERID');
        $res = $this->site->get_live_glod_rate();
        $convert=$res['buy']/10;  
      $rate = number_format($convert, 2, '.', '');
       $txid=$response['id'];
       $status=$response['status'];
    if($response['status']=='Completed'){
        $GOLD_PARCHASE_MASTER=$this->db->query("select *from GOLD_PARCHASE_MASTER where TXTID='$payment_id'")->result();
       if(count($GOLD_PARCHASE_MASTER)==0){
        $TOTAL_AMOUNT=$this->session->userdata('NETBUYPURCHASE');
        $GST_AMOUNT=$this->session->userdata('GSTAMOUNT');
        $TOTAL_AMOUNT1=$TOTAL_AMOUNT-$GST_AMOUNT;
        $PAYMENT_ID1 = rand(1111111111,9999999999);
        $ORDER_TYPE='BUY';
        $STATUS='active';
        $DATES=date('Y-m-d H:i:s');
        $TXTID=$payment_id;
        $this->db->query("update USERS_BALANCE set INR_BALANCE=INR_BALANCE+$TOTAL_AMOUNT where USERID='$USERID'");
      $insert_array=array('USERID'=>$USERID,'TOTAL_AMOUNT'=>$TOTAL_AMOUNT,'ORDER_TYPE'=>$ORDER_TYPE,'STATUS'=>$STATUS,'DATES'=>$DATES,'TXTID'=>$TXTID,'ORDER_STATUS'=>'SUCCESS','PAYMENT_ID'=>$PAYMENT_ID1);   
       $this->db->insert('GOLD_PARCHASE_MASTER',$insert_array); 
       }
    }
 }catch (Exception $e) {
    print('Error: ' . $e->getMessage());
}
$data['payment_id']=$payment_id;
$data['amount']=$response['payments'][0]['amount'];
$data['status']=$response['status'];
$data['template']='thank_you';
$data['title'] ='Thank You Payment Recived';
$data['page']='Thank You Payment Recived';
$this->layout_users($data);
 }
public function purchase_gold(){
    $res = $this->site->get_live_glod_rate();
   $array=array();
  $amountRs_buy=trim($this->input->post('amountRs_buy'));
     
 if(empty($amountRs_buy)){
   $array=array('code'=>400,'message'=>'Please enter buy amount');   
 }elseif(!is_numeric($amountRs_buy)){
 $array=array('code'=>400,'message'=>'Please enter buy amount in numeric format');    
  }else{
   $gst_amount = ($res['buy_gst'] / 100) * $amountRs_buy;
   $total_amount=$gst_amount+$amountRs_buy;
   $session_data['NETBUYPURCHASE']=$amountRs_buy;
   $session_data['GSTAMOUNT']=number_format($gst_amount, 2, '.', '');
   $session_data['TOTALAMOUNT']=number_format($total_amount, 2, '.', '');
   $this->session->set_userdata($session_data);
   $array=array('code'=>200,'message'=>'Please buy gold');  
  }
   echo json_encode($array);
   exit;
 }
public function buy_trade_post(){
   $buy=$this->site->get_live_glod_rate();
 $Base_buy_Amount=$buy['gram_rate'];
 $Buy_weight_Gold=trim($this->input->post('Buy_weight_Gold'));
 $Buy_Total_INR=trim($this->input->post('Buy_Total_INR'));
 $USERID=$this->session->userdata('USERID');
 $USERS_BALANCE=$this->db->query("select *from USERS_BALANCE where USERID='$USERID'")->row();
 $res = $this->site->get_live_glod_rate();
  $GST = (0 / 100) * $Buy_Total_INR; 
// $array=array('code'=>400,'message'=>'Please enter market price','co'=>$GST); 
  //echo json_encode($array);
  $Buy_Total_INR=$Buy_Total_INR-$GST;
  $Buy_weight_Gold=number_format((1*$Buy_Total_INR)/$Base_buy_Amount, 4, '.', ''); 
  $TRADE_ID = $USERID.rand(1111111111,9999999999);
 $market_rate=$res['gram_rate'];
 $Buy_Total_actual=$Buy_Total_INR+$GST;
 $array=array();
 if($Buy_Total_INR<=$USERS_BALANCE->INR_BALANCE){
  if(empty($Base_buy_Amount)){
   $array=array('code'=>400,'message'=>'Please enter market price');   
  }elseif(empty($Buy_weight_Gold)){
   $array=array('code'=>400,'message'=>'Please enter gold weight');   
  }elseif(empty($Buy_Total_INR)){
   $array=array('code'=>400,'message'=>'Please enter total inr amount');   
  }else{
  if((!is_numeric($Base_buy_Amount)) || (!is_numeric($Buy_weight_Gold)) || (!is_numeric($Buy_Total_INR))){
    $array=array('code'=>200,'message'=>'Please enter only numeric values');   
  }else{
    if($Buy_Total_INR>=0.97){
    if($Base_buy_Amount>=$market_rate){
     $TRADE=array('USERID'=>$USERID,'MARKET_RATE'=>$Base_buy_Amount,'EXECUTE_DATE'=>date('Y-m-d H:i:s'),'GOLD_WEIGHT'=>$Buy_weight_Gold,'TOTAL_INR'=>$Buy_Total_INR,'STATUS'=>'EXECUTE','order_type'=>'Direct Order','TRADE_TYPE'=>'BUY','DATES'=>date('Y-m-d H:i:s'),'TRADE_ID'=>$TRADE_ID,'GST'=>$GST); 
      $this->db->query("update USERS_BALANCE set INR_BALANCE=INR_BALANCE-$Buy_Total_actual,GOLD_BALANCE=GOLD_BALANCE+'$Buy_weight_Gold' where USERID='$USERID'");
     $get=$this->db->insert('TRADE',$TRADE);
      $REFER=$this->db->query("select REFFERAL_CODE from USERS where ID='$USERID'")->row();
        if(!empty($REFER->REFFERAL_CODE)){
          $referral=$REFER->REFFERAL_CODE;  
        $get_referr_id=$this->db->query("select YOUR_REFERRAL,ID from USERS where YOUR_REFERRAL='$referral'")->result();
        if(count($get_referr_id)>=1){
           $REFERRAL_ID= $USERID;
           $USERID_From= $get_referr_id[0]->ID;
           $totals = (0.5 / 100) * $Buy_Total_INR;
           $Referral_Income=array('REFERRAL_ID'=>$REFERRAL_ID,'USERID'=>$USERID_From,'INCOME_AMOUNT'=>$totals,'DATES'=>date('Y-m-d')); 
           $this->db->insert('Referral_Income',$Referral_Income);
           $this->db->query("update USERS_BALANCE set INR_BALANCE=INR_BALANCE+$totals where ID='$USERID_From'");
         }
        }
     if($get==true){
      $array=array('code'=>200,'message'=>'Buy Order post successfully'); 
      $this->session->set_userdata('message','Your buy order submited successfully');
     }else{
       $array=array('code'=>400,'message'=>'Please enter total inr amount');   
     }
    }else{
     $TRADE=array('USERID'=>$USERID,'MARKET_RATE'=>$Base_buy_Amount,'GOLD_WEIGHT'=>$Buy_weight_Gold,'TOTAL_INR'=>$Buy_Total_INR,'STATUS'=>'OPEN','order_type'=>'Limit Order','TRADE_TYPE'=>'BUY','DATES'=>date('Y-m-d H:i:s'),'TRADE_ID'=>$TRADE_ID,'GST'=>$GST); 
      $this->db->query("update USERS_BALANCE set INR_BALANCE=INR_BALANCE-$Buy_Total_actual,IN_ORDER_INR=IN_ORDER_INR+$Buy_Total_actual where USERID='$USERID'");
     $get=$this->db->insert('TRADE',$TRADE);
     if($get==true){
      $this->session->set_userdata('message','Your buy order submited successfully');
      $array=array('code'=>200,'message'=>'Buy Order post successfully');    
     }else{
       $array=array('code'=>400,'message'=>'Please enter total inr amount');   
     }   
    }  
   }else{
  $array=array('code'=>400,'message'=>'Please enter minimum 1 INR');      
   } 
  }   
  }
 }else{
 $array=array('code'=>400,'message'=>'Insufficient Balance');    
 }
  echo json_encode($array);
   exit;
} 

// Sell Orders
public function sell_trade_post(){
 $buy=$this->site->get_live_glod_rate();
 $Base_buy_Amount=$buy['gram_rate'];
 $Buy_weight_Gold=trim($this->input->post('Sell_weight_Gold'));
 $Buy_Total_INR=trim($this->input->post('Sell_Total_INR'));
 $USERID=$this->session->userdata('USERID');
 $USERS_BALANCE=$this->db->query("select *from USERS_BALANCE where USERID='$USERID'")->row();
 
  $TRADE_ID = $USERID.rand(1111111111,9999999999);
 $res = $this->site->get_live_glod_rate();
 $market_rate=$res['gram_rate'];
 $array=array();
 if($Buy_weight_Gold<=$USERS_BALANCE->GOLD_BALANCE){
  if(empty($Base_buy_Amount)){
   $array=array('code'=>400,'message'=>'Please enter market price');   
  }elseif(empty($Buy_weight_Gold)){
   $array=array('code'=>400,'message'=>'Please enter gold weight');   
  }elseif(empty($Buy_Total_INR)){
   $array=array('code'=>400,'message'=>'Please enter total inr amount');   
  }else{
  if((!is_numeric($Base_buy_Amount)) || (!is_numeric($Buy_weight_Gold)) || (!is_numeric($Buy_Total_INR))){
    $array=array('code'=>200,'message'=>'Please enter only numeric values');   
  }else{
    if($Buy_Total_INR>=100){
    if($Base_buy_Amount<=$market_rate){ 
     $TRADE=array('USERID'=>$USERID,'MARKET_RATE'=>$Base_buy_Amount,'EXECUTE_DATE'=>date('Y-m-d H:i:s'),'GOLD_WEIGHT'=>$Buy_weight_Gold,'TOTAL_INR'=>$Buy_Total_INR,'STATUS'=>'EXECUTE','order_type'=>'Direct Order','TRADE_TYPE'=>'SELL','DATES'=>date('Y-m-d H:i:s'),'TRADE_ID'=>$TRADE_ID); 
      $this->db->query("update USERS_BALANCE set GOLD_BALANCE=GOLD_BALANCE-$Buy_weight_Gold,INR_BALANCE=INR_BALANCE+$Buy_Total_INR where USERID='$USERID'");
     $get=$this->db->insert('TRADE',$TRADE);
     if($get==true){
      $array=array('code'=>200,'message'=>'Buy Order post successfully'); 
      $this->session->set_userdata('message','Your sell order submited successfully');
     }else{
       $array=array('code'=>400,'message'=>'Please enter total inr amount');   
     }
    }else{
     $TRADE=array('USERID'=>$USERID,'MARKET_RATE'=>$Base_buy_Amount,'GOLD_WEIGHT'=>$Buy_weight_Gold,'TOTAL_INR'=>$Buy_Total_INR,'STATUS'=>'OPEN','order_type'=>'Limit Order','TRADE_TYPE'=>'SELL','DATES'=>date('Y-m-d H:i:s'),'TRADE_ID'=>$TRADE_ID); 
      $this->db->query("update USERS_BALANCE set GOLD_BALANCE=GOLD_BALANCE-$Buy_weight_Gold,IN_ORDER_GOLD=IN_ORDER_GOLD+$Buy_weight_Gold where USERID='$USERID'");
     $get=$this->db->insert('TRADE',$TRADE);
     if($get==true){
      $this->session->set_userdata('message','Your order submited successfully');
      $array=array('code'=>200,'message'=>'Buy sell Order post successfully');    
     }else{
       $array=array('code'=>400,'message'=>'Please enter total inr amount');   
     }   
    }  
   }else{
  $array=array('code'=>400,'message'=>'Please enter minimum 100 INR');      
   } 
  }   
  }
 }else{
 $array=array('code'=>400,'message'=>'Insufficient Balance');    
 }
  echo json_encode($array);
   exit;
} 

// Limit Orders


public function buy_trade_post_limit(){
   $buy=$this->site->get_live_glod_rate();
 $Base_buy_Amount=trim($this->input->post('Base_buy_Amount'));
 $Buy_weight_Gold=trim($this->input->post('Buy_weight_Gold'));
 $Buy_Total_INR=trim($this->input->post('Buy_Total_INR'));
 $USERID=$this->session->userdata('USERID');
 $USERS_BALANCE=$this->db->query("select *from USERS_BALANCE where USERID='$USERID'")->row();
 $res = $this->site->get_live_glod_rate();
  $GST = (0 / 100) * $Buy_Total_INR; 
// $array=array('code'=>400,'message'=>'Please enter market price','co'=>$GST); 
  //echo json_encode($array);
  $Buy_Total_INR=$Buy_Total_INR-$GST;
  $Buy_weight_Gold=number_format((1*$Buy_Total_INR)/$Base_buy_Amount, 4, '.', ''); 
  $TRADE_ID = $USERID.rand(1111111111,9999999999);
 $market_rate=$res['gram_rate'];
 $Buy_Total_actual=$Buy_Total_INR+$GST;
 $array=array();
 if($Buy_Total_INR<=$USERS_BALANCE->INR_BALANCE){
  if(empty($Base_buy_Amount)){
   $array=array('code'=>400,'message'=>'Please enter market price');   
  }elseif(empty($Buy_weight_Gold)){
   $array=array('code'=>400,'message'=>'Please enter gold weight');   
  }elseif(empty($Buy_Total_INR)){
   $array=array('code'=>400,'message'=>'Please enter total inr amount');   
  }else{
  if((!is_numeric($Base_buy_Amount)) || (!is_numeric($Buy_weight_Gold)) || (!is_numeric($Buy_Total_INR))){
    $array=array('code'=>200,'message'=>'Please enter only numeric values');   
  }else{
    if($Buy_Total_INR>=0.97){
    if($Base_buy_Amount>=$market_rate){
     $TRADE=array('USERID'=>$USERID,'MARKET_RATE'=>$Base_buy_Amount,'EXECUTE_DATE'=>date('Y-m-d H:i:s'),'GOLD_WEIGHT'=>$Buy_weight_Gold,'TOTAL_INR'=>$Buy_Total_INR,'STATUS'=>'EXECUTE','order_type'=>'Direct Order','TRADE_TYPE'=>'BUY','DATES'=>date('Y-m-d H:i:s'),'TRADE_ID'=>$TRADE_ID,'GST'=>$GST); 
      $this->db->query("update USERS_BALANCE set INR_BALANCE=INR_BALANCE-$Buy_Total_actual,GOLD_BALANCE=GOLD_BALANCE+'$Buy_weight_Gold' where USERID='$USERID'");
     $get=$this->db->insert('TRADE',$TRADE);
      $REFER=$this->db->query("select REFFERAL_CODE from USERS where ID='$USERID'")->row();
        if(!empty($REFER->REFFERAL_CODE)){
          $referral=$REFER->REFFERAL_CODE;  
        $get_referr_id=$this->db->query("select YOUR_REFERRAL,ID from USERS where YOUR_REFERRAL='$referral'")->result();
        if(count($get_referr_id)>=1){
           $REFERRAL_ID= $USERID;
           $USERID_From= $get_referr_id[0]->ID;
           $totals = (0.5 / 100) * $Buy_Total_INR;
           $Referral_Income=array('REFERRAL_ID'=>$REFERRAL_ID,'USERID'=>$USERID_From,'INCOME_AMOUNT'=>$totals,'DATES'=>date('Y-m-d')); 
           $this->db->insert('Referral_Income',$Referral_Income);
           $this->db->query("update USERS_BALANCE set INR_BALANCE=INR_BALANCE+$totals where ID='$USERID_From'");
         }
        }
     if($get==true){
      $array=array('code'=>200,'message'=>'Buy Order post successfully'); 
      $this->session->set_userdata('message','Your buy order submited successfully');
     }else{
       $array=array('code'=>400,'message'=>'Please enter total inr amount');   
     }
    }else{
     $TRADE=array('USERID'=>$USERID,'MARKET_RATE'=>$Base_buy_Amount,'GOLD_WEIGHT'=>$Buy_weight_Gold,'TOTAL_INR'=>$Buy_Total_INR,'STATUS'=>'OPEN','order_type'=>'Limit Order','TRADE_TYPE'=>'BUY','DATES'=>date('Y-m-d H:i:s'),'TRADE_ID'=>$TRADE_ID,'GST'=>$GST); 
      $this->db->query("update USERS_BALANCE set INR_BALANCE=INR_BALANCE-$Buy_Total_actual,IN_ORDER_INR=IN_ORDER_INR+$Buy_Total_actual where USERID='$USERID'");
     $get=$this->db->insert('TRADE',$TRADE);
     if($get==true){
      $this->session->set_userdata('message','Your buy order submited successfully');
      $array=array('code'=>200,'message'=>'Buy Order post successfully');    
     }else{
       $array=array('code'=>400,'message'=>'Please enter total inr amount');   
     }   
    }  
   }else{
  $array=array('code'=>400,'message'=>'Please enter minimum 1 INR');      
   } 
  }   
  }
 }else{
 $array=array('code'=>400,'message'=>'Insufficient Balance');    
 }
  echo json_encode($array);
   exit;
} 

// Sell Orders
public function sell_trade_post_limit(){
 $buy=$this->site->get_live_glod_rate();
 $Base_buy_Amount=trim($this->input->post('Base_sell_Amount'));
 $Buy_weight_Gold=trim($this->input->post('Sell_weight_Gold'));
 $Buy_Total_INR=trim($this->input->post('Sell_Total_INR'));
 $USERID=$this->session->userdata('USERID');
 $USERS_BALANCE=$this->db->query("select *from USERS_BALANCE where USERID='$USERID'")->row();
 
  $TRADE_ID = $USERID.rand(1111111111,9999999999);
 $res = $this->site->get_live_glod_rate();
 $market_rate=$res['gram_rate'];
 $array=array();
 if($Buy_weight_Gold<=$USERS_BALANCE->GOLD_BALANCE){
  if(empty($Base_buy_Amount)){
   $array=array('code'=>400,'message'=>'Please enter market price');   
  }elseif(empty($Buy_weight_Gold)){
   $array=array('code'=>400,'message'=>'Please enter gold weight');   
  }elseif(empty($Buy_Total_INR)){
   $array=array('code'=>400,'message'=>'Please enter total inr amount');   
  }else{
  if((!is_numeric($Base_buy_Amount)) || (!is_numeric($Buy_weight_Gold)) || (!is_numeric($Buy_Total_INR))){
    $array=array('code'=>200,'message'=>'Please enter only numeric values');   
  }else{
    if($Buy_Total_INR>=100){
    if($Base_buy_Amount<=$market_rate){ 
     $TRADE=array('USERID'=>$USERID,'MARKET_RATE'=>$Base_buy_Amount,'EXECUTE_DATE'=>date('Y-m-d H:i:s'),'GOLD_WEIGHT'=>$Buy_weight_Gold,'TOTAL_INR'=>$Buy_Total_INR,'STATUS'=>'EXECUTE','order_type'=>'Direct Order','TRADE_TYPE'=>'SELL','DATES'=>date('Y-m-d H:i:s'),'TRADE_ID'=>$TRADE_ID); 
      $this->db->query("update USERS_BALANCE set GOLD_BALANCE=GOLD_BALANCE-$Buy_weight_Gold,INR_BALANCE=INR_BALANCE+$Buy_Total_INR where USERID='$USERID'");
     $get=$this->db->insert('TRADE',$TRADE);
     if($get==true){
      $array=array('code'=>200,'message'=>'Buy Order post successfully'); 
      $this->session->set_userdata('message','Your sell order submited successfully');
     }else{
       $array=array('code'=>400,'message'=>'Please enter total inr amount');   
     }
    }else{
     $TRADE=array('USERID'=>$USERID,'MARKET_RATE'=>$Base_buy_Amount,'GOLD_WEIGHT'=>$Buy_weight_Gold,'TOTAL_INR'=>$Buy_Total_INR,'STATUS'=>'OPEN','TRADE_TYPE'=>'SELL','DATES'=>date('Y-m-d H:i:s'),'TRADE_ID'=>$TRADE_ID,'order_type'=>'Limit Order'); 
      $this->db->query("update USERS_BALANCE set GOLD_BALANCE=GOLD_BALANCE-$Buy_weight_Gold,IN_ORDER_GOLD=IN_ORDER_GOLD+$Buy_weight_Gold where USERID='$USERID'");
     $get=$this->db->insert('TRADE',$TRADE);
     if($get==true){
      $this->session->set_userdata('message','Your order submited successfully');
      $array=array('code'=>200,'message'=>'Buy sell Order post successfully');    
     }else{
       $array=array('code'=>400,'message'=>'Please enter total inr amount');   
     }   
    }  
   }else{
  $array=array('code'=>400,'message'=>'Please enter minimum 100 INR');      
   } 
  }   
  }
 }else{
 $array=array('code'=>400,'message'=>'Insufficient Balance');    
 }
  echo json_encode($array);
   exit;
} 


public function cancel_buy_orders(){
    $id=trim($this->input->post('id'));
  $USERID=$this->session->userdata('USERID');
  $TRADE=$this->db->query("select *from TRADE where ID='$id' and USERID='$USERID'")->result();
  if(count($TRADE)==1){
    $this->db->query("update TRADE set STATUS='CANCEL' where ID='$id' and USERID='$USERID'");
    $TOTAL_INR=$TRADE[0]->TOTAL_INR+$TRADE[0]->GST;
 $get= $this->db->query("update USERS_BALANCE set INR_BALANCE=INR_BALANCE+$TOTAL_INR,IN_ORDER_INR=IN_ORDER_INR-$TOTAL_INR where USERID='$USERID'"); 
 if($get==true){
     $this->session->set_userdata('message','Buy order cancel successfully');
      $array=array('code'=>200,'message'=>'Buy sell Order cancel successfully');  
 }else{
   $array=array('code'=>400,'message'=>'Some thing went wrong');      
 }
  }else{
   $array=array('code'=>400,'message'=>'Some thing went wrong   ');    
  }
  echo json_encode($array);
  exit;
}
public function cancel_sell_orders(){
    $id=trim($this->input->post('id'));
  $USERID=$this->session->userdata('USERID');
  $TRADE=$this->db->query("select *from TRADE where ID='$id' and USERID='$USERID'")->result();
  if(count($TRADE)==1){
    $this->db->query("update TRADE set STATUS='CANCEL' where ID='$id' and USERID='$USERID'");
    $GOLD_WEIGHT=$TRADE[0]->GOLD_WEIGHT;
 $get= $this->db->query("update USERS_BALANCE set GOLD_BALANCE=GOLD_BALANCE+$GOLD_WEIGHT,IN_ORDER_GOLD=IN_ORDER_GOLD-$GOLD_WEIGHT where USERID='$USERID'"); 
 if($get==true){
     $this->session->set_userdata('message','Sell order cancel successfully');
      $array=array('code'=>200,'message'=>'Sell sell order cancel successfully');  
 }else{
   $array=array('code'=>400,'message'=>'Some thing went wrong');      
  }
  }else{
   $array=array('code'=>400,'message'=>'Some thing went wrong   ');    
  }
  echo json_encode($array);
  exit;
}
public function cron_for_buy_trades(){
   $res = $this->site->get_live_glod_rate();
   $market_rate=$res['gram_rate'];
   $TRADE=$this->db->query("select *from TRADE where STATUS='OPEN' and TRADE_TYPE='BUY' and MARKET_RATE>='$market_rate'")->result(); 
  // echo $this->db->last_query();
  // exit;
   foreach($TRADE as $row){
      $trade_rates=$row->MARKET_RATE;
    $msg='';
         $TOTAL_INR=$row->TOTAL_INR;
         $USERID=$row->USERID;
         $TRADE_ID=$row->TRADE_ID;
         $ID=$row->ID;
         $GOLD_WEIGHT=$row->GOLD_WEIGHT;
         $this->db->query("update TRADE SET STATUS='EXECUTE',EXECUTE_DATE='".date('Y-m-d H:i:s')."' WHERE ID='$ID'");
         $this->db->query("update USERS_BALANCE SET GOLD_BALANCE=GOLD_BALANCE+$GOLD_WEIGHT,IN_ORDER_INR=IN_ORDER_INR-$TOTAL_INR where USERID='$USERID'");
        $u=$this->db->query("select FULLNAME,EMAIL,MOBILE FROM USERS WHERE ID='$USERID'")->row();
      $REFER=$this->db->query("select REFFERAL_CODE from USERS where ID='$USERID'")->row();
        if(!empty($REFER->REFFERAL_CODE)){
          $referral=$REFER->REFFERAL_CODE;  
        $get_referr_id=$this->db->query("select YOUR_REFERRAL,ID from USERS where YOUR_REFERRAL='$referral'")->result();
        if(count($get_referr_id)>=1){
           $REFERRAL_ID= $USERID;
           $USERID_From= $get_referr_id[0]->ID;
           $totals = (0.5 / 100) * $Buy_Total_INR;
           $Referral_Income=array('REFERRAL_ID'=>$REFERRAL_ID,'USERID'=>$USERID_From,'INCOME_AMOUNT'=>$totals,'DATES'=>date('Y-m-d')); 
           $this->db->insert('Referral_Income',$Referral_Income);
           $this->db->query("update USERS_BALANCE set INR_BALANCE=INR_BALANCE+$totals where ID='$USERID_From'");
         }
        }
         $msg.='<b>Hello '.$u->FULLNAME.' ,</b><br> your buy trade executed successfully. please check the following trade details<br><br>
             <table border="1" style="border-collapse: collapse; width:600px; padding:10px; color:#000; text-align:left; font-size:12px;">
             <tr><th>Trade ID : </th><td>'.$row->TRADE_ID.'</td></tr>
             <tr><th>Fill In Gold Amount : </th><td>'.$row->GOLD_WEIGHT.'</td></tr>
             <tr><th>Market Limit INR : </th><td>'.$row->MARKET_RATE.' gm</td></tr>
             <tr><th>Total INR Amount : </th><td>'.$TOTAL_INR.'</td></tr>
             <tr><th>Trade Execute Date: </th><td>'.date('d-m-Y').'</td></tr>   
             </table>
      <br>';  
         $successmsg='';
         $errmsg='';
          $subject='Suvarnasiddhi Buy Trade Executed successfully';
          $this->GenericModel->sendEmail($u->EMAIL,"noreplay@suvarnasiddhi.com",$subject, $msg, $successmsg, $errmsg); 
     }
   echo 'Trade Executed Successfully';
   exit;
  }
  public function cron_for_sell_trades(){
   $res = $this->site->get_live_glod_rate();
   $market_rate=$res['sell'];
   $TRADE=$this->db->query("select *from TRADE where STATUS='OPEN' and TRADE_TYPE='SELL' and MARKET_RATE<='$market_rate'")->result(); 
   /// echo $this->db->last_query();
  /// exit;
   foreach($TRADE as $row){
      $trade_rates=$row->MARKET_RATE;
       $msg='';
         $TOTAL_INR=$row->TOTAL_INR;
         $USERID=$row->USERID;
         $TRADE_ID=$row->TRADE_ID;
         $ID=$row->ID;
         $GOLD_WEIGHT=$row->GOLD_WEIGHT;
         $this->db->query("update TRADE SET STATUS='EXECUTE',EXECUTE_DATE='".date('Y-m-d H:i:s')."' WHERE ID='$ID'");
         $this->db->query("update USERS_BALANCE SET INR_BALANCE=INR_BALANCE+$TOTAL_INR,IN_ORDER_GOLD=IN_ORDER_GOLD-$GOLD_WEIGHT where USERID='$USERID'");
        $u=$this->db->query("select FULLNAME,EMAIL,MOBILE FROM USERS WHERE ID='$USERID'")->row();
         $msg.='<b>Hello '.$u->FULLNAME.' ,</b><br> your sell trade executed successfully. please check the following trade details<br><br>
             <table border="1" style="border-collapse: collapse; width:600px; padding:10px; color:#000; text-align:left; font-size:12px;">
             <tr><th>Trade ID : </th><td>'.$row->TRADE_ID.'</td></tr>
             <tr><th>Sell Gold Amount : </th><td>'.$row->GOLD_WEIGHT.'</td></tr>
             <tr><th>Market Limit INR : </th><td>'.$row->MARKET_RATE.' gm</td></tr>
             <tr><th>Total INR Amount : </th><td>'.$TOTAL_INR.'</td></tr>
             <tr><th>Trade Execute Date: </th><td>'.date('d-m-Y').'</td></tr>   
             </table>
      <br>';  
         $successmsg='';
         $errmsg='';
          $subject='Suvarnasiddhi Sell Trade Executed successfully';
          $this->GenericModel->sendEmail($u->EMAIL,"noreplay@suvarnasiddhi.com",$subject, $msg, $successmsg, $errmsg); 
     }
   echo 'Trade Executed Successfully';
   exit;
  }
public function get_gram_rates_fetch_ajax(){
    $buy=$this->site->get_live_glod_rate();
    $data='<span class="buy_rates">Gold Buy <i class="fa fa-inr"></i> '.$buy['gram_rate'].' /gm </span>'
            . '<span class="sell_rates">Gold Sell <i class="fa fa-inr"></i> '.$buy['sell'].' /gm </span>';
    echo $data;
  }
public function withdraw_inr_amount(){
    $AMOUNT=trim($this->input->post('AMOUNT'));  
    $USERID=$this->session->userdata('USERID');
    $balance=$this->db->query("select *from USERS_BALANCE where USERID='$USERID'")->result();
    $array=array();
    if($AMOUNT<=$balance[0]->INR_BALANCE){
     $final_amount=$AMOUNT-50;
     $TRADE_ID = rand(1111111111,9999999999);
     $WITHDRAW=array('AMOUNT'=>$final_amount,'FEES'=>50,'FIAT_TYPE'=>'INR','STATUS'=>'Pending','CRATED_DATE'=>date('Y-m-d H:i:s'),'REQUEST_ID'=>$TRADE_ID,'USERID'=>$USERID);
    $this->db->insert('WITHDRAW',$WITHDRAW);
    $this->db->query("update USERS_BALANCE set INR_BALANCE=INR_BALANCE-'$AMOUNT' where USERID='$USERID'");
    $array=array('code'=>200,'message'=>'Withdraw Request Created Successfully');
    $this->session->set_userdata('message','Sell order cancel successfully');    
    }else{
     $array=array('code'=>400,'message'=>'Insufficient INR Balance');    
    }
    echo json_encode($array);
  exit;
  }
public function nft_inr_amount_deposit(){
  
  $res = $this->site->get_live_glod_rate();
  $array=array();
  $AMOUNT=trim($this->input->post('AMOUNT_NFT'));
  $TRANACTION_ID=trim($this->input->post('TRANACTION_ID_NFT'));
  $CRATED_DATE=trim($this->input->post('CRATED_DATE_NFT'));
  $CRATED_DATE=date('Y-m-d', strtotime($CRATED_DATE));
  $ID=$this->session->userdata('USERID');
  $TRADE_ID = rand(1111111111,9999999999);
 $gold=$this->db->query("select *from GOLD_PARCHASE_MASTER where TXTID='$TRANACTION_ID'")->result();
  if(count($gold)==0){
 if($AMOUNT>=100){
 if(empty($AMOUNT)){
   $array=array('code'=>400,'message'=>'Please enter buy amount');   
 }elseif(!is_numeric($AMOUNT)){
 $array=array('code'=>400,'message'=>'Please enter buy amount in numeric format');    
  }else{
   $insert=array('TOTAL_AMOUNT'=>$AMOUNT,'TXTID'=>$TRANACTION_ID,'DATES'=>$CRATED_DATE,'ORDER_STATUS'=>'PENDING','USERID'=>$ID,'PAYMENT_TYPE'=>'INTERNAL');
   $this->db->insert('GOLD_PARCHASE_MASTER',$insert);
   $this->session->set_userdata('message','Deposit Request Created Successfully');
    $array=array('code'=>200,'message'=>'Deposit Request Created Successfully');  
  }
 }else{
 $array=array('code'=>400,'message'=>'Please minimum 100 INR Deposit');    
 }
  }else{
  $array=array('code'=>400,'message'=>'This Transaction id already submited');    
  }
  echo json_encode($array);
  exit;
 }
 public function mail_enquiry_details(){
  $name=trim($this->input->post('name'));
  $email=trim($this->input->post('email'));
  $phone_no=trim($this->input->post('phone_no'));
  $message1=trim($this->input->post('message1'));
  $message='Hi Suvarnasiddhi,<br><br>'
          . 'Following users enquiry details<br><br>'
          . '<table border="1" style="border-collapse: collapse; width:600px; padding:10px; color:#000; text-align:left; font-size:12px;">'
          .'<tr><th>Name</th> <td>'.$name.'</td> </tr>'. ''
           .'<tr><th>Email</th><td> '.$email.' </td></tr>'. ''
          .'<tr><th>Mobile No</th><td> '.$phone_no.'</td> </tr>'
          .'<tr><th>Message</th><td> '.$message1.' </td></tr>'
          . '</table>'; 
  $subject='Suvarnasiddhi Users Enquiry';
  $successmsg='';
   $errmsg='';
   $this->GenericModel->sendEmail('support@suvarnasiddhi.com',"support@suvarnasiddhi.com",$subject, $message, $successmsg, $errmsg);  
   //$array=array('code'=>200,'message'=>'enquiry send successfully');
    $this->session->set_userdata('message','Enquiry Send Successfully..');
    redirect('contact-us');  
 
}
public function place_delivery_orders(){
   $ID=base64_decode($this->input->post('ID'));
   $address= base64_decode($this->input->post('address'));
   $userid=$this->session->userdata('USERID');
   $res = $this->site->get_live_glod_rate();
   
  $addresses=$this->db->query("select *from ADDRESSES where USERID='$userid' and ID='$address'")->row();
   $pincode=$addresses->PINCODE;
  $PINCODE_MASTER=$this->db->query("select *from PINCODE_MASTER where PINCODE='$pincode'")->result(); 
  $GOLD_PRODUCT=$this->db->query("select *from GOLD_PRODUCT where ID='$ID'")->result();
  $USERS_BALANCE=$this->db->query("select  *from USERS_BALANCE where ID='$userid'")->row();
  $array=array();
  
  $GOLD_WEIGHT=$GOLD_PRODUCT[0]->GOLD_WEIGHT;
  $GLOD_TITLE=$GOLD_PRODUCT[0]->GLOD_TITLE;
  
   $inr_equilent = number_format($GOLD_WEIGHT * $res['gram_rate'], 2, '.', '');
   
  $totals = (3 / 100) * $inr_equilent;
  
  $total_inr_charges=$GOLD_PRODUCT[0]->GOLD_Minting_Charges+$totals;
  $total_gold_charges=$GOLD_WEIGHT;
  
  $GOLD_BALANCE=$USERS_BALANCE->GOLD_BALANCE;
  $INR_BALANCE=$USERS_BALANCE->INR_BALANCE;
  if($total_gold_charges<=$GOLD_BALANCE){
  if($total_inr_charges<=$INR_BALANCE){
  if(count($GOLD_PRODUCT)>=1){
  if(count($PINCODE_MASTER)==0){
  $array=array('code'=>400,'message'=>'This address delivery not available');    
  }else{
   $order_id=time().$userid;   
   $DELIVERY_MASTER_ARRAY=array('ORDER_ID'=>$order_id,'USERID'=>$userid,'ADDRESS_ID'=>$address,'PRODUCT_ID'=>$ID,'STATUS'=>'Confirm','CREATED_DATE'=>date('Y-m-d H:i:s'),'GOLD_WEIGHT'=>$total_gold_charges,'INR_AMOUNT'=>$total_inr_charges,'PRODUCT_NAME'=>$GLOD_TITLE);
   $get=$this->db->insert('DELIVERY_MASTER',$DELIVERY_MASTER_ARRAY); 
   $this->db->query("update USERS_BALANCE set GOLD_BALANCE=GOLD_BALANCE-'$total_gold_charges',INR_BALANCE=INR_BALANCE-'$total_inr_charges' where USERID='$userid'");
   if($get==true){
   $array=array('code'=>200,'message'=>'Delivery gold order placed successfully');  
   $this->session->set_userdata('message','Delivery gold order placed successfully');    
   }else{
   $array=array('code'=>400,'message'=>'Some think went wrong');   
   }
  }    
  }else{
   $array=array('code'=>400,'message'=>'Invalid Product Details');    
  }
  }else{
  $array=array('code'=>400,'message'=>'Insufficient INR Balance');    
  }
  }else{
   $array=array('code'=>400,'message'=>'Insufficient Gold Balance');    
  }
  echo json_encode($array);
  exit;
 }

// Fixed deposit functionality
public function fixed_deposit_gold_investement(){
 $gold_amount=$this->input->post('gold_amount_fixed');
 $fixed_deposit_duration=$this->input->post('fixed_deposit_duration');
 $USERID=$this->session->userdata('USERID');
 $durations=$fixed_deposit_duration*30;
 $percent='';
 if($durations==180){
   $percent=1;  
 }elseif($durations==270){
    $percent=1.5; 
 }elseif($durations==360){
  $percent=2.0;   
 }
 $FD_ID= time().$USERID;
 $de=$durations+1;
 $expiry_date=date('Y-m-d H:i:s', strtotime("+$de day"));
 $USERS_BALANCE=$this->db->query("select GOLD_BALANCE FROM USERS_BALANCE WHERE USERID='$USERID'")->result();
 $res = $this->site->get_live_glod_rate();
 $amount_equilent=number_format($gold_amount*$res['gram_rate'], 2, '.', '');
 $array=array();
 if(count($USERS_BALANCE)>=1){
 if(!empty($USERID)){
 if($fixed_deposit_duration==6 || $fixed_deposit_duration==9 || $fixed_deposit_duration==12){
 if(empty($gold_amount)){
  $array=array('code'=>400,'message'=>'Some thing went wrong');   
  }elseif(!is_numeric($gold_amount)){
   $array=array('code'=>400,'message'=>'Enter Gold amount Only Numeric format');    
  }elseif($amount_equilent<1000){
  $array=array('code'=>400,'message'=>'Minimum Gold amount should be Worth of 1000 INR');    
  }elseif($gold_amount<=$USERS_BALANCE[0]->GOLD_BALANCE){
   $insert_array=array('GOLD_AMOUNT'=>$gold_amount,'INR_AMOUNT'=>$amount_equilent,'Months'=>$fixed_deposit_duration,'DURATION'=>$durations,'STATUS'=>'ACTIVE','USERID'=>$USERID,'CRATED_DATE'=>date('Y-m-d H:i:s'),'expiry_date'=>$expiry_date,'perecent'=>$percent,'FD_ID'=>$FD_ID);
  $true=$this->db->insert('FiXED_DEPOSIT_MASTER',$insert_array);
  if($true==true){
  $this->db->query("update USERS_BALANCE set GOLD_BALANCE=GOLD_BALANCE-'$gold_amount' where USERID='$USERID'"); 
  $array=array('code'=>200,'message'=>'Fixed Deposit Gold Investment Successfully..'); 
  $this->session->set_userdata('message','Fixed Deposit Gold Investment Successfully..');
  }else{
  $array=array('code'=>400,'message'=>'Some thing went wrong');
  }
  }else{
    $array=array('code'=>400,'message'=>'Insufficient Gold Balance');   
  }    
 }else{
  $array=array('code'=>400,'message'=>'Some thing went wrong');     
 }    
 }else{
  $array=array('code'=>400,'message'=>'Some thing went wrong');     
 }
}else{
  $array=array('code'=>400,'message'=>'Some thing went wrong');   
  }
  echo json_encode($array);
  exit;
 }
public function daily_payout_cron_generation(){
   
$query=$this->db->query("select GOLD_AMOUNT,INR_AMOUNT,DURATION,USERID,FD_ID,perecent,CRATED_DATE,ID from FiXED_DEPOSIT_MASTER where STATUS='ACTIVE'")->result();   
if(count($query)>=1){
 foreach($query as $row){
 $current_date=date('Y-m-d H:i:s'); 
 $sign_date=$row->CRATED_DATE;
 $t1 = strtotime($current_date);
 $t2 = strtotime($sign_date);
 $diff = $t1 - $t2;
 $hours = $diff / ( 60 * 60 );
 $hours_get=number_format($hours, 2, '.', '');
 if($hours_get>=24){
   $gold_amount=$row->GOLD_AMOUNT;
   $perecent=$row->perecent;
   $FD_ID=$row->ID;
   $USERID=$row->USERID;
   $daily_output = ($gold_amount* ($perecent / 100)) / 30; 
   $date=date('Y-m-d');
   $DUPLICATE_ENTRY=$this->db->query("select ID from DAILY_GOLD_OUTPUT where USERID='$USERID' AND FD_ID='$FD_ID' AND DATE(created_date)='$date'")->result();
   if(count($DUPLICATE_ENTRY)==0){
     $insert_array=array('GOLD_AMOUNT'=>$daily_output,'USERID'=>$USERID,'FD_ID'=>$FD_ID,'created_date'=>date('Y-m-d'),'PAYOUT_STATUS'=>0); 
     $this->db->insert('DAILY_GOLD_OUTPUT',$insert_array);
       }
      }
    }
    echo 'Daily Payout Generated Successfully';
   } 
 }
public function monthly_payout_cron_generation_payout(){
           if(date('d')==01){
             $DATES=date('Y-m-d');
            $date =date('Y-m-d', strtotime('last day of last month'));
             $year=date('Y',strtotime($date));
             $month=date('m',strtotime($date));
             $last_days=cal_days_in_month(CAL_GREGORIAN, date($month), date($year));
             $month_mid_days= date("Y-m-d", mktime(0, 0, 0, $month, 01, $year));
             $month_last_days= date("Y-m-d", mktime(0, 0, 0, $month, $last_days, $year));
      $query=$this->db->query("select GOLD_AMOUNT,INR_AMOUNT,DURATION,USERID,FD_ID,perecent,CRATED_DATE,ID from FiXED_DEPOSIT_MASTER")->result();     
      
        $query1 = "update DAILY_GOLD_OUTPUT set PAYOUT_STATUS=1 where created_date>='" . $month_mid_days . "' and created_date<='" . $month_last_days . "'";
        $r = $this->db->query($query1);
      
    foreach($query as $row){
        $USERID=$row->USERID;
        $this->db->select("SUM(GOLD_AMOUNT) AS GOLD_AMOUNT_OUPTUP");
        $this->db->where('DAILY_GOLD_OUTPUT.created_date >=', $month_mid_days);
        $this->db->where('DAILY_GOLD_OUTPUT.created_date <=', $month_last_days);
        $this->db->where('DAILY_GOLD_OUTPUT.USERID', $USERID);
        $this->db->from('DAILY_GOLD_OUTPUT');
        $lendingtotal = $this->db->get()->result();
        if (empty($lendingtotal[0]->GOLD_AMOUNT_OUPTUP)) {
            $lendingtotal = 0.0000;
        } else {
            $lendingtotal = $lendingtotal[0]->GOLD_AMOUNT_OUPTUP;
        }
        $duplicate_payout=$this->db->query("select ID from MOTHLY_GOLD_PAYOUT where USERID='$USERID' AND DATES='$DATES'")->result();
        if(count($duplicate_payout)==0){
          if($lendingtotal!='0.0000'){
          $insert_array=array('GOLD_AMOUNT'=>$lendingtotal,'USERID'=>$USERID,'DATES'=>$DATES);
          $this->db->insert('MOTHLY_GOLD_PAYOUT',$insert_array);
          $this->db->query("update USERS_BALANCE set GOLD_BALANCE = GOLD_BALANCE + '$lendingtotal' where USERID='$USERID'");
          }  
        }
     }
     echo 'Monthly Payout Generated Successfully';
     exit;
    }
  }
}
?>