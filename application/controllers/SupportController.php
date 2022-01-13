<?php 
if(!defined('BASEPATH')) EXIT('No direct script access allowed');
class SupportController extends MY_Controller {
    public function __construct() {
        parent::__construct();
		$this->load->model('Support_Model');
		$this->load->model("GenericModel");
    }
 public function support_dasboard(){
   		$data['template']='index';
		$data['title'] ='Home';
		$data['page']='Home';
		$data['BUY']=$this->db->query("select ID from  TRADE where  TRADE_TYPE='BUY'")->result();
		$data['SELL']=$this->db->query("select ID from  TRADE where  TRADE_TYPE='SELL'")->result();
		$data['USER']=$this->db->query("select ID from  USERS")->result();
		$data['DEPOSIT']=$this->db->query("select sum(TOTAL_AMOUNT) as totalamt from  GOLD_PARCHASE_MASTER")->result();
                $data['GST']=$this->db->query("select sum(GST_AMOUNT) as gstdeposit from  GOLD_PARCHASE_MASTER")->result();
	        $this->layout_admin($data);
  }
 public function admin_change_password(){
   		$data['template']='change_password';
		$data['title'] ='Support Change Password';
		$data['page']='Support Change Password';
		$this->layout_admin($data);
  }
 public function buy_trade_history(){
   		$data['template']='buy_trade';
		$data['title'] ='Buy Trades';
		$data['page']='Buy Trades';
		$this->layout_admin($data);
  }
  public function sell_trade_admin(){
   		$data['template']='sell_trade';
		$data['title'] ='Sell Trade';
		$data['page']='Sell Trade';
		$this->layout_admin($data);
  }
  public function admin_deposit_history(){
   		$data['template']='deposit_history';
		$data['title'] ='Deposit History';
		$data['page']='Deposit History';
		$this->layout_admin($data);
  }
   public function admin_users_history(){
   		$data['template']='users';
		$data['title'] ='Users History';
		$data['page']='Users History';
		$this->layout_admin($data);
  }
   public function admin_withdraw_history(){
    $data['template']='withdraw_history';
    $data['title'] ='Withdraw History';
    $data['page']='Withdraw History';
    $this->layout_admin($data);
  }
 public function add_new_product_admin(){
    $data['template']='add_new_product';
    $data['title'] ='Add New Product';
    $data['page']='Add New Product';
    $this->layout_admin($data);
  } 
 public function delivery_orders_details(){
    $data['template']='delivery-orders';
    $data['title'] ='Delivery Orders';
    $data['page']='Delivery Orders';
    $this->layout_admin($data);
  }  
  public function fixed_deposit_history(){
    $data['template']='fixed_deposit_history';
    $data['title'] ='Fixed Deposit';
    $data['page']='Fixed Deposit';
    $this->layout_admin($data);
  }  
   public function fixed_deposit_payout(){
    $data['template']='fixed_deposit_payout';
    $data['title'] ='Fixed Deposit Payout';
    $data['page']='Fixed Deposit Payout';
    $this->layout_admin($data);
  }  
public function support_login(){
$this->load->view('admin/site/login');
}
public function login_support_process(){
  echo $this->Support_Model->login_support_process($_POST);
  }
public function support_user_logout(){
  session_destroy();
  redirect('admin-login');
 }
public function support_changed_password_process(){
        $id=$this->session->userdata('ADMIN_ID');
	   $oldpassword=md5($this->input->post('oldPassword'));
	   $newpassword=md5($this->input->post('newPassword'));
      $array=array('password'=>($newpassword));
	  $oldpasswordget=$this->db->query("select PASSWORD from ADMIN where ID='$id'")->result();
	//  echo $this->db->last_query();
	 // exit;
	  if($oldpasswordget[0]->PASSWORD==($oldpassword)){
	    $this->db->where('id',$id);
		$this->db->update('ADMIN',$array);
		$_SESSION['successmsg']='Password Changed Successfully';
		echo 1;
		exit;
	   }else{
	    echo 2;
		exit;
	  }
    }
 public function trade_trnasction_history_buy(){   
         $type='BUY';
        $list = $this->Support_Model->get_datatables_trade($type);
        $data = array();
        $no = $_POST['start'];
		$status='';
		
        foreach ($list as $rows) {
            if($rows->STATUS=='OPEN'){
            $more_details='<a target="_blank" class="btn btn-primary btn-sm" onclick="return cancel_trades_sell('.$rows->ID.')">Cancel Trade</a>';
        }elseif($rows->STATUS=='EXECUTE'){
          $more_details='<span class="btn btn-success btn-sm">EXECUTED</span>';   
        }else{
           $more_details='<span class="btn btn-danger btn-sm">CANCEL</span>';  
        }
            $no++;
            $TOT=$rows->TOTAL_INR+$rows->GST;
            $row = array();
            $row[] = $no;
            $row[] = $rows->EMAIL;
            $row[] = $rows->MOBILE;
            $row[] = $rows->TRADE_ID;
            $row[] = '<i class="fa fa-inr"></i> '.$rows->MARKET_RATE;
            $row[] = $rows->GOLD_WEIGHT;
            $row[] = '<i class="fa fa-inr"></i> '.$TOT;
            $row[] = date('d-m-Y',strtotime($rows->DATES));
            $row[] = $rows->STATUS;
           
            /*$row[] = $more_details;*/
            $data[] = $row;
        }
  $output = array("draw" => $_POST['draw'],"recordsTotal" => $this->Support_Model->count_all_trade($type),
  "recordsFiltered" => $this->Support_Model->count_filtered_trade($type),"data" => $data,);
        //output to json format
        echo json_encode($output);
    } 
    
    public function trade_trnasction_history_sell(){   
         $type='SELL';
        $list = $this->Support_Model->get_datatables_trade($type);
        $data = array();
        $no = $_POST['start'];
		$status='';
		
        foreach ($list as $rows) {
            if($rows->STATUS=='OPEN'){
            $more_details='<a target="_blank" class="btn btn-primary btn-sm" onclick="return cancel_trades_sell('.$rows->ID.')">Cancel Trade</a>';
        }elseif($rows->STATUS=='EXECUTE'){
          $more_details='<span class="btn btn-success btn-sm">EXECUTED</span>';   
        }else{
           $more_details='<span class="btn btn-danger btn-sm">CANCEL</span>';  
        }
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $rows->EMAIL;
            $row[] = $rows->MOBILE;
            $row[] = $rows->TRADE_ID;
            $row[] = '<i class="fa fa-inr"></i> '.$rows->MARKET_RATE;
             $row[] = $rows->GOLD_WEIGHT;
            $row[] = '<i class="fa fa-inr"></i> '.$rows->TOTAL_INR;
            $row[] = date('d-m-Y',strtotime($rows->DATES));
            $row[] = $rows->STATUS;
           
            /*$row[] = $more_details;*/
            $data[] = $row;
        }
  $output = array("draw" => $_POST['draw'],"recordsTotal" => $this->Support_Model->count_all_trade($type),
  "recordsFiltered" => $this->Support_Model->count_filtered_trade($type),"data" => $data,);
        //output to json format
        echo json_encode($output);
    } 
    public function deposit_trnasction_history(){   
        $list = $this->Support_Model->get_datatables_deposit();
        $data = array();
        $no = $_POST['start'];
		$status='';
	
      
                
        foreach ($list as $rows) {
            $more_details='<a target="_blank" class="btn btn-primary btn-sm" href="'.site_url().'buy_invoice?inovice_id='.$rows->ID.'">View Invoice</a>';
            $no++;
             $get_array = array("SUCCESS", "PENDING", "DISSAPPROVE");
           $bank_status='';
            $calss='';
                  if($rows->ORDER_STATUS=='PENDING'){
                  $calss='warning';     
                }elseif($rows->ORDER_STATUS=='SUCCESS'){
                   $calss='success'; 
                }elseif($rows->ORDER_STATUS=='DISSAPPROVE'){
                 $calss='danger';   
                }
               $depsoit_popup='<div class="modal" id="transction_popup'.$no.'">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">NEFT / IMPS Disapprove Note</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
       <form method="post" action="#">
       <div class="form-group">
       <textarea type="text" class="form-control" id="dISAPPROVED_NOTE'.$no.'" name="dISAPPROVED_NOTE'.$no.'" onchange="dISAPPROVED_NOTER('.$no.')" placeholder="Disapprove Note"></textarea>
           <span id="dISAPPROVED_NOTER'.$no.'" style="color:red;"></span>
       </div>
       <div class="form-group">
       <input type="button" class="btn btn-primary"  onclick="return disapproved_actions('.$no.','.$rows->USERID.','.$rows->ID.')" value="submit">
       </div>
       </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div> 
      </div>
    </div>
  </div>';             
               $bank_status.='<div class="dropdown">
    <button class="btn btn-'.$calss.' dropdown-toggle" type="button" data-toggle="dropdown">'.$rows->ORDER_STATUS.'
    <span class="caret"></span></button>';
    $bank_status.='<ul class="dropdown-menu">';
    if($rows->ORDER_STATUS!='DISSAPPROVE' && $rows->ORDER_STATUS!='SUCCESS'){
    foreach($get_array as $bak){  
     if($bak!=$rows->ORDER_STATUS){
          if($bak=='SUCCESS'){
     $bank_status.='<li><a href="#"   onclick="return approved_actions('.$rows->USERID.','.$rows->ID.')">'.$bak.'</a></li>';
      }else if($bak=='DISSAPPROVE'){
     $bank_status.='<li><a href="#" data-toggle="modal"  data-target="#transction_popup'.$no.'">'.$bak.'</a></li>';
      }
     }
    }
    }
    $bank_status.='</ul>
  </div>';
            
            
            $row = array();
            $row[] = $no;
            $row[] = $rows->EMAIL;
            $row[] = $rows->MOBILE; 
            $row[] = $rows->TXTID;
            $row[] = 'INR '.$rows->TOTAL_AMOUNT;
            $row[] = date('d-m-Y',strtotime($rows->DATES));
            $row[] = $bank_status.$depsoit_popup;
           // $row[] = $more_details;
            /*$row[] = $more_details;*/
            $data[] = $row;
        }
  $output = array("draw" => $_POST['draw'],"recordsTotal" => $this->Support_Model->count_all_deposit(),
  "recordsFiltered" => $this->Support_Model->count_filtered_deposit(),"data" => $data,);
        //output to json format
        echo json_encode($output);
    } 
    
    public function users_history_showing(){   
         $type='BUY';
        $list = $this->Support_Model->get_datatables_users($type);
        $data = array();
        $no = $_POST['start'];
		$status='';
		
        foreach ($list as $rows) {
            if($rows->STATUS=='ACTIVE'){
            $more_details='<a href="#" class="btn btn-success btn-sm" onclick="return status_changed('.$rows->ID.',1)"><i class="fa fa-check"></i> Active</a>';
        }else{
          $more_details='<a href="#" onclick="return status_changed('.$rows->ID.',2)" class="btn btn-danger btn-sm" class="btn btn-success btn-sm"><i class="fa fa-times"></i> Inactive</a>';   
        }
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $rows->FULLNAME;
            $row[] = $rows->EMAIL;
            $row[] = $rows->MOBILE;
            $row[] = date('d-m-Y',strtotime($rows->CREATED_DATE));
            $row[] = $more_details;
            $data[] = $row;
        }
         $output = array("draw" => $_POST['draw'],"recordsTotal" => $this->Support_Model->count_all_users(),
  "recordsFiltered" => $this->Support_Model->count_filtered_users(),"data" => $data,);
        //output to json format
        echo json_encode($output);
    }
    public function changed_status_users(){
      $id=trim($this->input->post('id'));
      $type=trim($this->input->post('type'));
      $get='';
      if($type==1){
     $get= $this->db->query("update USERS set STATUS='INACTIVE' WHERE ID='$id'");   
      }else{
     $get= $this->db->query("update USERS set STATUS='ACTIVE' WHERE ID='$id'");         
      }
    if($get==true){
       $_SESSION['successmsg']='Status changed successfully';
       echo 1; exit;
     }else{
         echo 2; exit;
     }  
    }
    public function disapprove_withdraw_amount(){
     $userid=$this->input->post('userid');
     $id=$this->input->post('id');
     $get=$this->db->query("select *from WITHDRAW where ID='$id'")->result();
     if(count($get)>=1){
   $this->db->query("update WITHDRAW set STATUS='Dissapprove' where ID='$id'");
   $amount=$get[0]->AMOUNT+$get[0]->FEES;
   $users=$this->db->query("update USERS_BALANCE set INR_BALANCE=INR_BALANCE+$amount where USERID='$userid'");
   $_SESSION['successmsg']='Withdraw Request Dissapproved Successfully..';
    echo 1; exit;
     }else{
    echo 2; exit;
     }
  }
  public function approve_withdraw_amount(){
    //  exit;
     $userid=$this->input->post('userid');
     $id=$this->input->post('id');
      $transaction_id=$this->input->post('transaction_id');
     $get=$this->db->query("update WITHDRAW set STATUS='Approve',DEPOSIT_TRANSACTION_ID='$transaction_id' where ID='$id'");
     if($get==true){
   $_SESSION['successmsg']='Withdraw Request Approved Successfully..';
    echo 1; exit;
     }else{
    echo 2; exit;
     }
  }
   public function particular_withdraw_all_history(){  
        $list = $this->Support_Model->get_datatables_withdraw();
      //  echo $this->db->last_query();
        $data = array();
        $no = $_POST['start'];
     
        foreach ($list as $rows) {
            $get_array = array("Pending", "Approve", "Dissapprove");
           $bank_status='';
          $calss='';
                  if($rows->STATUS=='Pending'){
                  $calss='warning';     
                }elseif($rows->STATUS=='Approve'){
                   $calss='success'; 
                }elseif($rows->STATUS=='Dissapprove'){
                 $calss='danger';   
                }
              
    
  $depsoit_popup='<div class="modal" id="transction_popup'.$no.'">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">NEFT / IMPS Transaction ID</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
       <form method="post" action="#">
       <div class="form-group">
       <input type="text" class="form-control" id="transaction_id'.$no.'" name="transaction_id'.$no.'" onchange="transaction_idr('.$no.')" placeholder="Transaction ID">
           <span id="transaction_idr'.$no.'" style="color:red;"></span>
       </div>
       <div class="form-group">
       <input type="button" class="btn btn-primary"  onclick="return approved_actions_id_submit('.$no.','.$rows->USERID.','.$rows->ID.')" value="submit">
       </div>
       </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div> 
      </div>
    </div>
  </div>';  
                
               $bank_status.='<div class="dropdown">
    <button class="btn btn-'.$calss.' dropdown-toggle" type="button" data-toggle="dropdown">'.$rows->STATUS.'
    <span class="caret"></span></button>';
    $bank_status.='<ul class="dropdown-menu">';
    if($rows->STATUS!='Dissapprove' && $rows->STATUS!='Approve'){
    foreach($get_array as $bak){  
     if($bak!=$rows->STATUS){
          if($bak=='Approve'){
     $bank_status.='<li><a href="#"  data-toggle="modal"  data-target="#transction_popup'.$no.'">'.$bak.'</a></li>';
      }else if($bak=='Dissapprove'){
     $bank_status.='<li><a href="#" onclick="return disapproved_actions('.$rows->USERID.','.$rows->ID.')">'.$bak.'</a></li>';
      }
     }
    }
    }
    $bank_status.='</ul>
  </div>';
            $amount='';
            $fees='';
            $fiat='';
             if($rows->FIAT_TYPE=='INR'){
              $amount = number_format($rows->AMOUNT, 2, '.', ''); 
              $fees = number_format($rows->FEES, 2, '.', ''); 
              $fiat='INR';
             }elseif($rows->FIAT_TYPE=='TMNK'){
              $amount = number_format($rows->AMOUNT, 8, '.', ''); 
              $fees = number_format($rows->FEES, 8, '.', ''); 
              $fiat='TMNK';    
             }
         
            
            $no++;
            $row = array();
            $row[] = $no;
            $row[] =$rows->FULLNAME;
	    $row[] = $rows->MOBILE;
            $row[] = $rows->REQUEST_ID;
            $row[] = $fiat.' '.$fees;
            $row[] = $fiat.' '.$amount;
	    $row[] = date('d-m-Y',strtotime($rows->CRATED_DATE));
            $row[]=$bank_status.$depsoit_popup;
            $data[] = $row;
        }
        $output = array("draw" => $_POST['draw'],"recordsTotal" => $this->Support_Model->count_filtered_withdraw(),
  "recordsFiltered" => $this->Support_Model->count_all_withdraw(),"data" => $data,);
        //output to json format
        echo json_encode($output);
}
public function approve_deposit_amount(){
     $userid=$this->input->post('userid');
     $id=$this->input->post('id');
     $get=$this->db->query("select *from GOLD_PARCHASE_MASTER where ID='$id'")->result();
     if(count($get)>=1){
         $get_array = array("SUCCESS", "PENDING", "DISSAPPROVE");
   $this->db->query("update GOLD_PARCHASE_MASTER set ORDER_STATUS='SUCCESS' where ID='$id'");
   $amount=$get[0]->TOTAL_AMOUNT;
   $users=$this->db->query("update USERS_BALANCE set INR_BALANCE=INR_BALANCE+$amount where USERID='$userid'");
   $_SESSION['successmsg']='Deposit Request Approved Successfully..';
    echo 1; exit;
     }else{
    echo 2; exit;
     }
  }
  public function disapprov_deposit_amount(){
     $userid=$this->input->post('userid');
     $dISAPPROVED_NOTE=$this->input->post('dISAPPROVED_NOTE');
     $id=$this->input->post('id');
     $get=$this->db->query("update GOLD_PARCHASE_MASTER set ORDER_STATUS='DISSAPPROVE',dISAPPROVED_NOTE='$dISAPPROVED_NOTE' where ID='$id'");
     if($get==true){
   $_SESSION['successmsg']='Deposit Request Dissapprove Successfully..';
    echo 1; exit;
     }else{
    echo 2; exit;
     }
  }
  public function get_temparary_data(){
      $userid=$_SESSION['ADMIN_ID'];
$maincategories=$this->db->query("select *from image where amid='$userid' order by pid desc")->result();
$countrows=count($maincategories);

  $query='';
    $date=date('Y-m-d H:i:s');
	  $images_arr = array();
	  // $totalcount=$usercount+$filecount;
	  $mysql=$this->db->query("select *from image")->result();
	  $count=count($mysql);
	  
   $filecount=count($_FILES['uploadfileone']['name']);
    $totalcount=$count+$filecount;
	if($totalcount<=5){
	  if(!empty($_FILES['uploadfileone']['name'])){
    foreach($_FILES['uploadfileone']['name'] as $key=>$val){
        $target_dir = "assets/gold/";
         $target_file = $target_dir.$_FILES['uploadfileone']['name'][$key];
             move_uploaded_file($_FILES['uploadfileone']['tmp_name'][$key],$target_file);
			$images_arr[] = $target_file;
        $query=$this->db->query("insert into image(image_path,status,amid)values('$val','active',$userid)");
		}
		}
  echo 1;
  exit;
 }else{
  echo 2;
  exit;
 }    
  }
 public function InsertTempImages(){
$data='';
$userid=$_SESSION['ADMIN_ID'];
$maincategories=$this->db->query("select *from image  where amid='$userid' order by pid desc")->result_array();
$countrows=count($maincategories);
                          $data.='';
                                                    $i=1;

                                                  foreach($maincategories as $main){

                                                 $data.='<div class="img-wrap" style="margin-right:10px;">
                                                   <span class="close"  onclick="temimagesdelete('.$main['pid'].')">&times;</span>
                                                 <img src="'.site_url().'assets/gold/'.$main['image_path'].'" class="fileUpload">'
                                                 . '</div>';
                                                  $i++; }  
                                          
                               
                        echo $data;
}
public function update_delivery_gold_product(){
   $GLOD_TITLE=$_POST['GLOD_TITLE'];
$GOLD_Minting_Charges=$_POST['GOLD_Minting_Charges'];
$GOLD_WEIGHT=$_POST['GOLD_WEIGHT'];
$GOLD_Highlight=$_POST['GOLD_Highlight'];
$GOLD_SUMMARY=$_POST['GOLD_SUMMARY'];
$ID=$this->input->post('ID');
$userid=$_SESSION['ADMIN_ID'];
//$date=date('Y-m-d H:i:s');
    $array=array('GLOD_TITLE'=>$GLOD_TITLE,'GOLD_Minting_Charges'=>$GOLD_Minting_Charges,'GOLD_WEIGHT'=>$GOLD_WEIGHT,'GOLD_Highlight'=>$GOLD_Highlight,'GOLD_SUMMARY'=>$GOLD_SUMMARY);
     $this->db->where('ID',$ID);
    $g= $this->db->update('GOLD_PRODUCT',$array); 
 if($g==true){
    $_SESSION['successmsg']="Gold Product updated Successfully";
    redirect('add_new_product_admin');
    exit;
    }else{
      echo 2;
      exit;
    }  
}
public function insert_delivery_gold_product(){

$GLOD_TITLE=$_POST['GLOD_TITLE'];
$GOLD_Minting_Charges=$_POST['GOLD_Minting_Charges'];
$GOLD_WEIGHT=$_POST['GOLD_WEIGHT'];
$GOLD_Highlight=$_POST['GOLD_Highlight'];
$GOLD_SUMMARY=$_POST['GOLD_SUMMARY'];
$userid=$_SESSION['ADMIN_ID'];
$date=date('Y-m-d H:i:s');

        $mysql_query=$this->db->query("select *from image where amid='$userid'")->result_array();
$array=array('GLOD_TITLE'=>$GLOD_TITLE,'GOLD_Minting_Charges'=>$GOLD_Minting_Charges,'GOLD_WEIGHT'=>$GOLD_WEIGHT,'GOLD_Highlight'=>$GOLD_Highlight,'GOLD_SUMMARY'=>$GOLD_SUMMARY,'CREATED_DATE'=>date('Y-m-d'),'STATUS'=>'ACTIVE');
    $g= $this->db->insert('GOLD_PRODUCT',$array);
		$id=$this->db->insert_id();
		foreach($mysql_query as $image){
	    $this->db->query("insert into product_images(product_path,pid)values('".$image['image_path']."','$id')");
                }if($g==true){
	      $this->db->query("delete from image where amid='$userid'");
		$_SESSION['successmsg']="Product Added Successfully";
		redirect('add_new_product_admin');
		//echo 1;
		exit;
		}else{
		  echo 2;
		  exit;
		}
    
  }
  public function delete_images(){
    $id=$_POST['id'];
    $query=$this->db->query("delete from image where pid='$id'");
    if($query==true){
    echo 1;exit;
     }else{
     echo 2;exit;
      }   
      }
      public function delivery_product_history(){   
        
        $list = $this->Support_Model->get_datatables_delivery();
        $data = array();
        $no = $_POST['start'];
		$status='';
		
        foreach ($list as $rows) {
            if($rows->STATUS=='ACTIVE'){
            $more_details='<a href="#" class="btn btn-success btn-sm" onclick="return status_changed('.$rows->ID.',1)"><i class="fa fa-check"></i> Active</a>';
        }else{
          $more_details='<a href="#" onclick="return status_changed('.$rows->ID.',2)" class="btn btn-danger btn-sm" class="btn btn-success btn-sm"><i class="fa fa-times"></i> Inactive</a>';   
        }
        $update='<a href="'. site_url().'add_new_product_admin?update='.$rows->ID.'"  class="btn btn-danger btn-sm" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i> Edit</a>';   
        $view='<a href="'.site_url().'add_new_product_admin?view='.$rows->ID.'" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> View</a>';
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $rows->GLOD_TITLE;
            $row[] = $rows->GOLD_Minting_Charges;
            $row[] = $rows->GOLD_WEIGHT;
            $row[] = date('d-m-Y',strtotime($rows->CREATED_DATE));
            $row[] = $more_details.'&nbsp;'.$update.'&nbsp;'.$view;
            $data[] = $row;
        }
         $output = array("draw" => $_POST['draw'],"recordsTotal" => $this->Support_Model->count_all_delivery(),
  "recordsFiltered" => $this->Support_Model->count_filtered_delivery(),"data" => $data,);
        //output to json format
        echo json_encode($output);
    }
  public function update_delivery_status(){
      $status=$this->input->post('status');
      $ID=$this->input->post('ID');
      $status1='';
      if($status==1){
        $status1='INACTIVE';  
      }else{
       $status1='ACTIVE';    
      }
        $array=array('STATUS'=>$status1);
        $this->db->where('ID',$ID);
       $st=$this->db->update('GOLD_PRODUCT',$array);
     if($st==true){
         $_SESSION['successmsg']="Status Updated Successfully";
         echo 1; exit;
     }else{
         echo 2; exit;
     }
        
  }
  public function delivery_pagination_list(){   
        $list = $this->Support_Model->get_datatables_delivery_order();
         $get_array ='Delivered';
        $bank_status=''; 
      $calss='';
        $data = array();
        $no = $_POST['start'];	
        foreach ($list as $rows) {
        if($rows->STATUS=='Confirm'){
             $calss='success';     
           }elseif($rows->STATUS=='Cancel'){
              $calss='danger'; 
           }elseif($rows->STATUS=='Delivered'){
            $calss='primary';   
           }
 $bank_status.='<div class="dropdown">
    <button class="btn btn-'.$calss.' dropdown-toggle" type="button" data-toggle="dropdown">'.$rows->STATUS.'
    <span class="caret"></span></button>';
    $bank_status.='<ul class="dropdown-menu">';
    if($rows->STATUS!='Cancel' && $rows->STATUS!='Delivered'){
     $bank_status.='<li><a href="#" onclick="return delivery_status_details('.$rows->ID.')">'.$get_array.'</a></li>';
     }
    $bank_status.='</ul></div>';
    
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $rows->FULLNAME;   
            $row[]=$rows->umobile;
            $row[] = $rows->ORDER_ID;   
            $row[]=$rows->PRODUCT_NAME;
            $row[]=$rows->GOLD_WEIGHT;
            $row[]=$rows->INR_AMOUNT;
            $row[]=$rows->NAME.',&nbsp;'.$rows->ADDRESS.',&nbsp;'.$rows->city.',&nbsp;'.$rows->state.'&nbsp;-'.$rows->PINCODE;
            $row[]=$bank_status;
            $row[] = date('d-m-Y',strtotime($rows->CREATED_DATE));
            
            $data[] = $row;
        }
       $output = array("draw" => $_POST['draw'],"recordsTotal" => $this->Support_Model->count_all_delivery_order(),
       "recordsFiltered" => $this->Support_Model->count_filtered_delivery_order(),"data" => $data,);
        echo json_encode($output);
    }
    public function delivery_status_details_changed(){
        $ID=$this->input->post('id');
        $array=array('STATUS'=>'Delivered');
        $this->db->where('ID',$ID);
       $st=$this->db->update('DELIVERY_MASTER',$array);
     if($st==true){
         $_SESSION['successmsg']="Status Updated Successfully";
         echo 1; exit;
     }else{
         echo 2; exit;
     }
        
  }
   public function fixed_deposit_payout_paging(){   
         $referral=$this->session->userdata('USERID');
        $list = $this->Support_Model->get_datatables_payout();
        
        $data = array();
        $no = $_POST['start'];	
        foreach ($list as $rows) {
            $no++;
           $row = array();
           $row[] = $no;
           $row[] = $rows->FULLNAME; 
           $row[] = $rows->MOBILE; 
           $row[] = $rows->GOLD_AMOUNT;        
           $row[] = date('d-m-Y',strtotime($rows->DATES));
            $data[] = $row;
        }
       $output = array("draw" => $_POST['draw'],"recordsTotal" => $this->Support_Model->count_all_payout($referral),
       "recordsFiltered" => $this->Support_Model->count_filtered_payout(),"data" => $data,);
        echo json_encode($output);
    }
    
    public function fixed_deposit_history_shwing(){   
         $referral=$this->session->userdata('USERID');
        $list = $this->Support_Model->get_datatables_fixed($referral);
        
        $data = array();
        $no = $_POST['start'];	
        foreach ($list as $rows) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $rows->FD_ID;
            $row[] = $rows->FULLNAME;
            $row[] = $rows->MOBILE;
            $row[] = $rows->GOLD_AMOUNT;
            $row[] = $rows->perecent;
            $row[]=$rows->STATUS;
            $row[] = date('d-m-Y',strtotime($rows->CRATED_DATE));
            $row[] = date('d-m-Y',strtotime($rows->expiry_date));
            $data[] = $row;
        }
       $output = array("draw" => $_POST['draw'],"recordsTotal" => $this->Support_Model->count_all_fixed($referral),
       "recordsFiltered" => $this->Support_Model->count_filtered_fixed($referral),"data" => $data,);
        echo json_encode($output);
    } 
}
?>