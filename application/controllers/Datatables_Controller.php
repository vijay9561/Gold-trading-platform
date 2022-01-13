<?php
class Datatables_Controller  extends MY_Controller{
    public function __construct() {
    parent::__construct();
   }
   public function buy_trnasction_history(){   
        $list = $this->Datatables_Model->get_datatables_buy();
        $data = array();
        $no = $_POST['start'];
		$status='';
	$status_note='';	
        foreach ($list as $rows) {
           if($rows->ORDER_STATUS=='DISSAPPROVE'){
              $status_note= $rows->dISAPPROVED_NOTE;
           }else{
            $status_note='NA';   
           }
            $more_details='<a target="_blank" class="btn btn-primary btn-sm" href="'.site_url().'buy_invoice?inovice_id='.$rows->ID.'">View Invoice</a>';
            $no++;
            $NET_AMT=$rows->TOTAL_AMOUNT-$rows->GST_AMOUNT;
            $row = array();
            $row[] = $no;
            $row[] = $rows->TXTID;
            $row[] = 'INR '.$rows->TOTAL_AMOUNT;
            $row[] =$status_note;
            $row[] = date('d-m-Y',strtotime($rows->DATES)); 
            $row[] =$rows->ORDER_STATUS;
         //   $row[] = $more_details;
            /*$row[] = $more_details;*/
            $data[] = $row;
        }
  $output = array("draw" => $_POST['draw'],"recordsTotal" => $this->Datatables_Model->count_all_buy(),
  "recordsFiltered" => $this->Datatables_Model->count_filtered_buy(),"data" => $data,);
        //output to json format
        echo json_encode($output);
    } 
    
     public function trade_trnasction_history_buy(){   
         $type='BUY';
        $list = $this->Datatables_Model->get_datatables_trade($type);
        $data = array();
        $no = $_POST['start'];
		$status='';
		
        foreach ($list as $rows) {
            if($rows->STATUS=='OPEN'){
            $more_details='<a target="_blank" class="btn btn-primary btn-sm" onclick="return cancel_trades_buy('.$rows->ID.')">Cancel Trade</a>';
        }elseif($rows->STATUS=='EXECUTE'){
          $more_details='<span class="btn btn-success btn-sm">EXECUTED</span>';   
        }else{
           $more_details='<span class="btn btn-danger btn-sm">CANCEL</span>';  
        }
        $more_details1='<a target="_blank" class="btn btn-primary btn-sm" href="'.site_url().'buy_trades_pdf?inovice_id='.$rows->ID.'">View Invoice</a>';
        $NET_AMOUNT=$rows->TOTAL_INR+$rows->GST;
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $rows->TRADE_ID;
            $row[] = 'INR '.$rows->MARKET_RATE;
            $row[] = $rows->GOLD_WEIGHT;
            $row[] = 'INR '.$rows->GST;  
            $row[] = 'INR '.$rows->TOTAL_INR;
            $row[] = 'INR '.$NET_AMOUNT;
            if(!empty($rows->order_type)){
            $row[]=$rows->order_type;
            }else{
             $row[]='<b>NA</b>';    
            }
            $row[] = date('d-m-Y',strtotime($rows->DATES));
            $row[] = $more_details1;
            $row[] = $more_details;
            /*$row[] = $more_details;*/
            $data[] = $row;
        }
  $output = array("draw" => $_POST['draw'],"recordsTotal" => $this->Datatables_Model->count_all_trade($type),
  "recordsFiltered" => $this->Datatables_Model->count_filtered_trade($type),"data" => $data,);
        //output to json format
        echo json_encode($output);
    }
  
  public function trade_trnasction_history_sell(){   
         $type='SELL';
        $list = $this->Datatables_Model->get_datatables_trade($type);
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
          $more_details1='<a target="_blank" class="btn btn-primary btn-sm" href="'.site_url().'sell_trades_pdf?inovice_id='.$rows->ID.'">View Invoice</a>';
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $rows->TRADE_ID;
            $row[] = 'INR '.$rows->MARKET_RATE;
             $row[] = $rows->GOLD_WEIGHT;
            $row[] = 'INR '.$rows->TOTAL_INR;
            $row[] = date('d-m-Y',strtotime($rows->DATES));
           if(!empty($rows->order_type)){
            $row[]=$rows->order_type;
            }else{
             $row[]='<b>NA</b>';    
            }
            $row[] = $more_details1;
            $row[] = $more_details;
            /*$row[] = $more_details;*/
            $data[] = $row;
        }
  $output = array("draw" => $_POST['draw'],"recordsTotal" => $this->Datatables_Model->count_all_trade($type),
  "recordsFiltered" => $this->Datatables_Model->count_filtered_trade($type),"data" => $data,);
        //output to json format
        echo json_encode($output);
    } 
    
    
       public function withdraws_trnasction_history(){   
        $list = $this->Datatables_Model->get_datatables_withdraw();
        $data = array();
        $no = $_POST['start'];
		$status='';
		
        foreach ($list as $rows) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $rows->REQUEST_ID;
            $row[] = 'INR '.$rows->AMOUNT;
            $row[] = 'INR '.$rows->FEES;
            $row[] = date('d-m-Y',strtotime($rows->CRATED_DATE));
            $row[] = $rows->STATUS;
            $data[] = $row;
        }
  $output = array("draw" => $_POST['draw'],"recordsTotal" => $this->Datatables_Model->count_all_withdraw(),
  "recordsFiltered" => $this->Datatables_Model->count_filtered_withdraw(),"data" => $data,);
        //output to json format
        echo json_encode($output);
    } 
    
  // Referral Code
  public function referral_users_list(){   
         $referral=$this->session->userdata('REFERRAL_CODE');
        $list = $this->Datatables_Model->get_datatables_referral($referral);
        
        $data = array();
        $no = $_POST['start'];	
        foreach ($list as $rows) {
            $action='<a href="'. site_url().'view_referral_income?details='.$rows->ID.'" class="btn btn-primary">View Income</a>';
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $rows->FULLNAME;
            $row[] = $rows->EMAIL;
            $row[] = date('d-m-Y',strtotime($rows->CREATED_DATE));
            $row[] =$action;
            $data[] = $row;
        }
       $output = array("draw" => $_POST['draw'],"recordsTotal" => $this->Datatables_Model->count_all_referral($referral),
       "recordsFiltered" => $this->Datatables_Model->count_filtered_referral($referral),"data" => $data,);
        echo json_encode($output);
    } 
    
     public function referral_income_users(){   
         $referral=$this->session->userdata('Referral_Income');
        $list = $this->Datatables_Model->get_datatables_referral_income($referral);
        
        $data = array();
        $no = $_POST['start'];	
        foreach ($list as $rows) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $rows->INCOME_AMOUNT;
            $row[] = date('d-m-Y',strtotime($rows->DATES));
            $data[] = $row;
        }
       $output = array("draw" => $_POST['draw'],"recordsTotal" => $this->Datatables_Model->count_all_referral_income($referral),
       "recordsFiltered" => $this->Datatables_Model->count_filtered_referral_income($referral),"data" => $data,);
        echo json_encode($output);
    } 
    
     public function fixed_deposit_history_shwing(){   
         $referral=$this->session->userdata('USERID');
        $list = $this->Datatables_Model->get_datatables_referral_fixed($referral);
        
        $data = array();
        $no = $_POST['start'];	
        foreach ($list as $rows) {
            $no++;
            $row = array();
            $view_earning='<a href="'. site_url().'fd-daily-earning-payout?details_fd='.$rows->ID.'" class="btn btn-primary"><i class="fa fa-eye"></i> Earning Gold</a>';
            $row[] = $rows->FD_ID;
            $row[] = $rows->GOLD_AMOUNT;
           
            $row[] = $rows->perecent;
            $row[]=$rows->STATUS;
            $row[] = date('d-m-Y',strtotime($rows->CRATED_DATE));
            $row[] = date('d-m-Y',strtotime($rows->expiry_date));
            $row[]=$view_earning;
            $data[] = $row;
        }
       $output = array("draw" => $_POST['draw'],"recordsTotal" => $this->Datatables_Model->count_all_referral_fixed($referral),
       "recordsFiltered" => $this->Datatables_Model->count_filtered_referral_fixed($referral),"data" => $data,);
        echo json_encode($output);
    } 
    
     public function fixed_deposit_payout_paging(){   
         $referral=$this->session->userdata('USERID');
        $list = $this->Datatables_Model->get_datatables_referral_payout($referral);
        
        $data = array();
        $no = $_POST['start'];	
        foreach ($list as $rows) {
            $no++;
            $row = array();
           $row[] = $no;
            $row[] = $rows->GOLD_AMOUNT;        
            $row[] = date('d-m-Y',strtotime($rows->DATES));
            $data[] = $row;
        }
       $output = array("draw" => $_POST['draw'],"recordsTotal" => $this->Datatables_Model->count_all_referral_payout($referral),
       "recordsFiltered" => $this->Datatables_Model->count_filtered_referral_payout($referral),"data" => $data,);
        echo json_encode($output);
    }
    
    
    public function particular_details_fixed_deposit_contract(){   
        $fd_id=$this->input->post('fd_id');
        $userid=$this->session->userdata('USERID');
        $list = $this->Datatables_Model->get_datatables_referral_payout_daily($fd_id,$userid);
       
        $data = array();
        $no = $_POST['start'];	
        foreach ($list as $rows) {
            $no++;
            $row = array();
           $row[] = $no;
            $row[] = $rows->GOLD_AMOUNT;        
            $row[] = date('d-m-Y',strtotime($rows->created_date));
            $data[] = $row;
        }
       $output = array("draw" => $_POST['draw'],"recordsTotal" => $this->Datatables_Model->count_all_referral_payout_daily($fd_id,$userid),
       "recordsFiltered" => $this->Datatables_Model->count_filtered_referral_payout_daily($fd_id,$userid),"data" => $data,);
        echo json_encode($output);
    }
    
   public function delivery_pagination_list(){   
          $userid=$this->session->userdata('USERID');
        $list = $this->Datatables_Model->get_datatables_delivery($userid);
       
        $data = array();
        $no = $_POST['start'];	
        foreach ($list as $rows) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $rows->ORDER_ID;   
            $row[]=$rows->PRODUCT_NAME;
            $row[]=$rows->GOLD_WEIGHT;
            $row[]=$rows->INR_AMOUNT;
            $row[]=$rows->NAME.',&nbsp;'.$rows->ADDRESS.',&nbsp;'.$rows->city.',&nbsp;'.$rows->state.'&nbsp;-'.$rows->PINCODE;
            $row[]=$rows->STATUS;
            $row[] = date('d-m-Y',strtotime($rows->CREATED_DATE));
            $data[] = $row;
        }
       $output = array("draw" => $_POST['draw'],"recordsTotal" => $this->Datatables_Model->count_all_delivery($userid),
       "recordsFiltered" => $this->Datatables_Model->count_filtered_delivery($userid),"data" => $data,);
        echo json_encode($output);
    }  
}
?>