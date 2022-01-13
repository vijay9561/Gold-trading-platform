<?php
class Users_controller  extends MY_Controller{
    public function __construct() {
    parent::__construct();
   }
   public function index(){
   $data['template']='index';
   $data['title']='Glod';
   $data['page']='Glod';
   $this->layout_users($data);
   }
 public function reister(){
   $data['template']='register';
   $data['title']='Register';
   $data['page']='Register';
   $this->layout_users($data);
   }
   
   public function login(){
   $data['template']='login';
   $data['title']='Login';
   $data['page']='Login';
   $this->layout_users($data);
   }
   public function privacy_policy(){
   $data['template']='privacy-policy';
   $data['title']='Privacy Policy';
   $data['page']='Privacy Policy';
   $this->layout_users($data);
   }
    public function refund_policy(){
   $data['template']='refund-policy';
   $data['title']='Refund Policy';
   $data['page']='Refund Policy';
   $this->layout_users($data);
   }
    public function terms_of_use(){
   $data['template']='terms-of-use';
   $data['title']='Terms Of Use';
   $data['page']='Terms Of Use';
   $this->layout_users($data);
   }
   public function faq(){
   $data['template']='faq';
   $data['title']='FAQ';
   $data['page']='FAQ';
   $this->layout_users($data);
   }
    public function contact_us(){
   $data['template']='contactus';
   $data['title']='Contact Us';
   $data['page']='Contact Us';
   $this->layout_users($data);
   }
   public function Limit_Trade(){
   $data['template']='trade';
   $data['title']='Limit Trade';
   $data['page']='Limit Trade';
   $this->layout_users($data);
   }
   public function resest_password(){
   $data['template']='forgot_password';
   $data['title']='Reset Password';
   $data['page']='Reset Password';
   $this->layout_users($data);
   }
   public function kyc_verfication(){
   if($this->session->userdata('USERID')){
   $data['template']='users_kyc_details';
   $data['title']='KYC Verification';
   $data['page']='KYC Verification';
   $this->layout_users($data);
   }else{
      redirect(site_url());    
   }
   }
   public function Delivery(){
   if($this->session->userdata('USERID')){
   $data['template']='delivery-product';
   $data['title']='Delivery Product';
   $data['Delivery']=$this->db->query("select *from GOLD_PRODUCT order by ID desc")->result();
   $data['page']='Delivery Product';
   $this->layout_users($data);
   }else{
      redirect(site_url());    
   }
   }
   public function Delivery_Details(){
   if($this->session->userdata('USERID')){
    $get_id=''; 
    if(isset($_GET['delivery'])){
     $get_id=base64_decode($_GET['delivery']);    
     }else{
    $get_id=base64_decode($_GET['delivery']);     
     }
   $data['template']='checkout_details';
   $data['title']='Deliver Product Details';
   $data['address']=$this->db->query("select *from ADDRESSES where USERID='".$this->session->userdata('USERID')."'")->result();
   $data['Delivery']=$this->db->query("select *from GOLD_PRODUCT where ID='$get_id' order by ID desc")->row();
   $data['page']='Delivery Product';
   $this->layout_users($data);
   }else{
      redirect(site_url());    
   }
   }
   public function transaction_history(){
  if($this->session->userdata('USERID')){
   $data['template']='transaction_history';
   $data['title']='Transaction History';
   $data['page']='Transaction History';
   $this->layout_users($data);
  }else{
      redirect(site_url());    
   }
   }
   
     public function fd_daily_earning_payout(){
  if($this->session->userdata('USERID')){
   $data['template']='gold-fixed_deposit_earning';
   $data['title']='FD Daily Payout Earning';
   $data['page']='FD Daily Payout Earning';
   $this->layout_users($data);
  }else{
      redirect(site_url());    
   }
   }
    public function gold_fixed_deposit(){
  if($this->session->userdata('USERID')){
   $data['template']='gold-fixed-deposit';
   $data['title']='Gold Fixed Deposit';
   $data['page']='Gold Fixed Deposit';
   $this->layout_users($data);
  }else{
      redirect(site_url());    
   }
   }
   public function deposit_and_witdraw(){
  if($this->session->userdata('USERID')){
   $data['template']='deposit_and_withdraw';
   $data['title']='Deposit & Withdraw';
   $data['page']='Deposit & Withdraw';
   $this->layout_users($data);
  }else{
      redirect(site_url());    
   }
   } 
   public function my_referral(){
   if($this->session->userdata('USERID')){
   $data['template']='referral_users_list';
   $data['title']='My Referral';
   $data['page']='My Referral';
   $this->layout_users($data);
   }else{
      redirect(site_url());    
   }
   }
   public function view_referral_income(){
   if($this->session->userdata('USERID')){
   $data['template']='view_referral_income';
   $data['title']='My Referral Income';
   $data['page']='My Referral Income';
   $this->session->set_userdata('Referral_Income',$_GET['details']);
   $this->layout_users($data);
   }else{
      redirect(site_url());    
   }
   }
    public function addresses(){
   if($this->session->userdata('USERID')){
    $USERID=$this->session->userdata('USERID');
   $data['template']='address';
   $data['title']='Addresses Details';
   $data['page']='Addresses Details';
   $data['address']=$this->db->query("select *from ADDRESSES where USERID='$USERID'")->result();
   $this->layout_users($data);
   }else{
       redirect(site_url());   
    }
   }
    public function buy_glod(){
  if($this->session->userdata('NETBUYPURCHASE')){
   $data['template']='buy_glod';
   $data['title']='Buy Glod';
   $data['page']='Buy Glod';
   $this->layout_users($data);
    }else{
     redirect(site_url());    
   }
   }
   
    public function my_profile(){
  if($this->session->userdata('USERID')){
   $data['template']='profile';
   $data['USERS']=$this->db->query("select *from USERS WHERE ID='".$this->session->userdata('USERID')."'")->row();
   $data['title']='My Profile';
   $data['page']='My Profile';
   $this->layout_users($data);
    }else{
     redirect(site_url());    
   }
   }
   
  public function getcities_address(){
     $state=$this->input->post('state');
   $tb_city=$this->db->query("select *from tb_city where state_id='$state'")->result();
   $data='';
   
   $data=' <div class="form-group">
   
   <select type="text" class="form-control" name="city" id="city" onchange="cityr()">
    <option value=""> Select location</option>';
    if(count($tb_city)>=1){
foreach($tb_city as $row1)
{
 $data.='<option value="'.$row1->city_id.'">'.$row1->city.'</option>';
}  $data.='<option value="other" >Other</option>';
   }else{
    $data.='<option value="" >Not Found City</option>';
   }
   $data.='</select></div>';
   echo $data; 
  } 
    public function getcities(){
   $state=$this->input->post('state');
   $tb_city=$this->db->query("select *from tb_city where state_id='$state'")->result();
   $data='';
   
   $data=' <div class="col-md-6 form-group">
    <label>Select City</label>  
   <select type="text" class="form-control" name="city" id="city" onchange="cityr()">
    <option value=""> Select location</option>';
    if(count($tb_city)>=1){
foreach($tb_city as $row1)
{
 $data.='<option value="'.$row1->city_id.'">'.$row1->city.'</option>';
}  $data.='<option value="other" >Other</option>';
   }else{
    $data.='<option value="" >Not Found City</option>';
   }
   $data.='</select></div>';
   echo $data;
  }
  
    public function submit_aadhar_card(){
      error_reporting(0);
   $aadhar_frant_side='';
   $aadhar_back_side='';
$query='';  
$userid=$this->session->userdata('USERID');
 if(!empty($_FILES["aadhar_frant_side"]["name"])){
  $string=explode('.',$_FILES["aadhar_frant_side"]["name"]);
  $aadhar_frant_side =  $string[0].'_'. rand(0, 10000) . '.' . end(explode(".", $_FILES["aadhar_frant_side"]["name"]));
   move_uploaded_file($_FILES["aadhar_frant_side"]["tmp_name"], "kyc/adhar/" . $aadhar_frant_side);
   }   
    if(!empty($_FILES["aadhar_back_side"]["name"])){
  $string=explode('.',$_FILES["aadhar_back_side"]["name"]);
  $aadhar_back_side =  $string[0].'_'. rand(0, 10000) . '.' . end(explode(".", $_FILES["aadhar_back_side"]["name"]));
   move_uploaded_file($_FILES["aadhar_back_side"]["tmp_name"], "kyc/adhar/" . $aadhar_back_side);
   }   
  $current_checking=$this->db->query("select id from Lo_kyc_verification where userid='$userid'")->row();
 $array=array('');
  if(count($current_checking)==0){
  $array=array('userid'=>$userid,'aadhar_frant_side'=>$aadhar_frant_side,'aadhar_back_side'=>$aadhar_back_side,'created_date'=>date('Y-m-d'),'adhar_date'=>date('Y-m-d'),'aadhar_status'=>'pending'); 
  $query=$this->db->insert('Lo_kyc_verification',$array);
   }else{
   $array=array('aadhar_frant_side'=>$aadhar_frant_side,'aadhar_back_side'=>$aadhar_back_side,'adhar_date'=>date('Y-m-d'),'aadhar_status'=>'pending'); 
   $this->db->where('userid',$userid);
   $query=$this->db->update('Lo_kyc_verification',$array);
   }
 if($query==TRUE){
     $this->session->set_userdata('success','Your Aadhar card submited successfully..');
     echo 1; exit;
   }else{
     echo 2;
     exit;
   }
  } 

  
  public function submit_pan_card(){
    error_reporting(0);
   $pan_card='';
   $aadhar_back_side='';
$query='';  
$userid=$this->session->userdata('USERID');
 if(!empty($_FILES["pan_card"]["name"])){
  $string=explode('.',$_FILES["pan_card"]["name"]);
  $pan_card =  $string[0].'_'. rand(0, 10000) . '.' . end(explode(".", $_FILES["pan_card"]["name"]));
   move_uploaded_file($_FILES["pan_card"]["tmp_name"], "kyc/pan/" . $pan_card);
   }   
  $current_checking=$this->db->query("select id from Lo_kyc_verification where userid='$userid'")->row();
 $array=array('');
  if(count($current_checking)==0){
  $array=array('userid'=>$userid,'pan_card'=>$pan_card,'created_date'=>date('Y-m-d'),'pan_date'=>date('Y-m-d'),'pan_card_status'=>'pending'); 
  $query=$this->db->insert('Lo_kyc_verification',$array);
   }else{
   $array=array('pan_card'=>$pan_card,'pan_date'=>date('Y-m-d'),'pan_card_status'=>'pending'); 
   $this->db->where('userid',$userid);
   $query=$this->db->update('Lo_kyc_verification',$array);
   }
 if($query==TRUE){
     $this->session->set_userdata('success','Your Pan card submited successfully..');
     echo 1; exit;
   }else{
     echo 2;
     exit;
   }
  } 
  
   public function submit_bank_statement(){
    error_reporting(0);
   $pan_card='';
   $aadhar_back_side='';
$query='';  
$userid=$this->session->userdata('USERID');
$account_no=$this->input->post('account_no');
$ifsc_code=$this->input->post('ifsc_code');
$acount_holder=$this->input->post('acount_holder');
$swift_code=$this->input->post('swift_code');

 if(!empty($_FILES["bank_statement"]["name"])){
  $string=explode('.',$_FILES["bank_statement"]["name"]);
  $bank_statement =  $string[0].'_'. rand(0, 10000) . '.' . end(explode(".", $_FILES["bank_statement"]["name"]));
   move_uploaded_file($_FILES["bank_statement"]["tmp_name"], "kyc/bank/" . $bank_statement);
   }   
  $current_checking=$this->db->query("select id from Lo_kyc_verification where userid='$userid'")->row();
 $array=array('');
  if(count($current_checking)==0){
  $array=array('userid'=>$userid,'bank_statement'=>$bank_statement,'created_date'=>date('Y-m-d'),'bank_date'=>date('Y-m-d'),'bank_statement_status'=>'pending','account_no'=>$account_no,'acount_holder'=>$acount_holder,'ifsc_code'=>$ifsc_code,'swift_code'=>$swift_code); 
  $query=$this->db->insert('Lo_kyc_verification',$array);
   }else{
   $array=array('bank_statement'=>$bank_statement,'bank_date'=>date('Y-m-d'),'bank_statement_status'=>'pending','account_no'=>$account_no,'acount_holder'=>$acount_holder,'ifsc_code'=>$ifsc_code,'swift_code'=>$swift_code); 
   $this->db->where('userid',$userid);
   $query=$this->db->update('Lo_kyc_verification',$array);
   }
 if($query==TRUE){
     $this->session->set_userdata('success','Your Bank Statement submited successfully..');
     echo 1; exit;
   }else{
     echo 2;
     exit;
   }
  } 
    public function submit_your_profile_details(){
      
  $userid=$this->session->userdata('USERID');
  $current_checking=$this->db->query("select id from Lo_kyc_verification where userid='$userid'")->row();
 $array=array('');
 $name=$this->input->post('name');
 $dob1=$this->input->post('dob');
 $dob=date('Y-m-d', strtotime($dob1));
 $gender=$this->input->post('gender');
 $phone_no=$this->input->post('phone_no');
 $country=$this->input->post('country');
 $city=$this->input->post('city');
 $state=$this->input->post('state');
 $address=$this->input->post('address');
 $query='';
  if(count($current_checking)==0){ 
   $array=array('userid'=>$userid,'name'=>$name,'created_date'=>date('Y-m-d'),'dob'=>$dob,'gender'=>$gender,'phone_no'=>$phone_no,'country'=>$country,'city'=>$city,'state'=>$state,'address'=>$address); 
  $query=$this->db->insert('Lo_kyc_verification',$array);    
  }else{
   $array=array('userid'=>$userid,'name'=>$name,'dob'=>$dob,'gender'=>$gender,'phone_no'=>$phone_no,'country'=>$country,'city'=>$city,'state'=>$state,'address'=>$address); 
   $this->db->where('userid',$userid);
  $query=$this->db->update('Lo_kyc_verification',$array);    
  }
  if($query==TRUE){
     $this->session->set_userdata('success','Your Profile & Address submited successfully..');
     echo 1; exit;
   }else{
     echo 2;
     exit;
   }
 }
 public function mypdf() {
        $this->load->helper('pdf_helper');
        $this->load->view('pdf');
    }
 public function buy_trades_pdf() {
        $this->load->helper('pdf_helper');
        $this->load->view('buy_trade');
    }
     public function sell_trades_pdf() {
        $this->load->helper('pdf_helper');
        $this->load->view('sell_trade_pdf');
    }
}
?>