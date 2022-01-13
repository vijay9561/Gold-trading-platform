<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Support_Model extends CI_Model {

    
    var $table_trade = 'TRADE T';
    var $column_order_trade = array(null, 'U.EMAIL','U.MOBILE','T.ID','T.USERID','T.TRADE_ID','T.MARKET_RATE','T.GOLD_WEIGHT','T.TOTAL_INR','T.FEES','T.STATUS','T.TRADE_TYPE','T.DATES','T.GST'); 
    var $column_search_trade = array('U.EMAIL','U.MOBILE','T.ID','T.USERID','T.TRADE_ID','T.MARKET_RATE','T.GOLD_WEIGHT','T.TOTAL_INR','T.FEES','T.STATUS','T.TRADE_TYPE','T.DATES','T.GST');  
    var $order_trade = array('T.ID' => 'desc');
    
    var $table_deposit = 'GOLD_PARCHASE_MASTER G';
    var $column_order_deposit = array(null,'U.EMAIL','U.MOBILE','G.ID','G.USERID','G.PER_GRAM_RATE','G.TOTAL_AMOUNT','G.GST_AMOUNT','G.QTY','G.ORDER_TYPE','G.STATUS','G.DATES','G.TXTID','G.PAYMENT_ID','G.ORDER_STATUS'); 
    var $column_search_deposit = array('U.EMAIL','U.MOBILE','G.ID','G.USERID','G.PER_GRAM_RATE','G.TOTAL_AMOUNT','G.GST_AMOUNT','G.QTY','G.ORDER_TYPE','G.STATUS','G.DATES','G.TXTID','G.PAYMENT_ID','G.ORDER_STATUS');  
    var $order_deposit = array('G.ID' => 'desc');
    
    var $table_users = 'USERS';
    var $column_order_users = array(null,'FULLNAME','EMAIL','ID','MOBILE','STATUS','CREATED_DATE','OTP_VERIFY'); 
    var $column_search_users = array('FULLNAME','EMAIL','ID','MOBILE','STATUS','CREATED_DATE','OTP_VERIFY');  
    var $order_users = array('ID' => 'desc');
    
    var $table_kyc = 'Lo_kyc_verification l';
    var $column_order_kyc= array(null,'l.userid','l.aadhar_frant_side','l.aadhar_back_side','l.pan_card','l.bank_statement','l.aadhar_status','l.pan_card_status','l.bank_statement_status','l.created_date','u.FULLNAME','u.MOBILE','l.account_no','l.ifsc_code','l.acount_holder','l.bank_date'); //set column database for datatable orderable
    var $column_search_kyc = array('l.userid','l.aadhar_frant_side','l.aadhar_back_side','l.pan_card','l.bank_statement','l.aadhar_status','l.pan_card_status','l.bank_statement_status','l.created_date','u.FULLNAME','u.MOBILE','l.account_no','l.ifsc_code','l.acount_holder','l.bank_date');  //set column field database for datatable searchable
    var $order_kyc = array('l.id' => 'desc');
    
    var $table_withdraw = 'WITHDRAW l';
    var $column_order_withdraw= array(null,'l.ID','l.USERID','l.AMOUNT','l.FEES','l.FIAT_TYPE','l.STATUS','l.CRATED_DATE','l.REQUEST_ID','u.FULLNAME','u.MOBILE'); //set column database for datatable orderable
    var $column_search_withdraw = array('l.ID','l.USERID','l.AMOUNT','l.FEES','l.FIAT_TYPE','l.STATUS','l.CRATED_DATE','l.REQUEST_ID','u.FULLNAME','u.MOBILE');  //set column field database for datatable searchable
    var $order_withdraw = array('l.ID' => 'desc');
    
    var $table_delivery = 'GOLD_PRODUCT';
    var $column_order_delivery = array(null,'GLOD_TITLE','GOLD_Minting_Charges','GOLD_WEIGHT','GOLD_Highlight','GOLD_SUMMARY','CREATED_DATE','STATUS','ID'); 
    var $column_search_delivery = array('GLOD_TITLE','GOLD_Minting_Charges','GOLD_WEIGHT','GOLD_Highlight','GOLD_SUMMARY','CREATED_DATE','STATUS','ID');  
    var $order_delivery = array('ID' => 'desc');
    
    var $table_delivery_order = 'DELIVERY_MASTER d';
    var $column_order_delivery_order = array(null, 'd.ORDER_ID','d.USERID','d.ID','d.ADDRESS_ID','d.PRODUCT_ID','d.STATUS','d.CREATED_DATE','d.PRODUCT_NAME','d.INR_AMOUNT','d.GOLD_WEIGHT','a.NAME','a.ADDRESS','a.PINCODE','a.MOBILE','c.city','s.state','u.FULLNAME','u.MOBILE as umobile'); 
    var $column_search_delivery_order = array('d.ORDER_ID','d.USERID','d.ID','d.ADDRESS_ID','d.PRODUCT_ID','d.STATUS','d.CREATED_DATE','d.PRODUCT_NAME','d.INR_AMOUNT','d.GOLD_WEIGHT','a.NAME','a.ADDRESS','a.PINCODE','a.MOBILE','c.city','s.state','u.MOBILE as umobile','u.FULLNAME');  
    var $order_delivery_order = array('ID' => 'desc');
    
    
    var $table_payout = 'MOTHLY_GOLD_PAYOUT p';
    var $column_order_payout = array(null, 'p.ID','GOLD_AMOUNT','p.USERID','p.DATES','u.FULLNAME','u.MOBILE'); 
    var $column_search_payout = array('p.ID','p.GOLD_AMOUNT','p.USERID','p.DATES');  
    var $order_payout = array('p.ID' => 'desc');
    
    var $table_fixed = 'FiXED_DEPOSIT_MASTER f';
    var $column_order_fixed = array(null, 'f.ID','f.GOLD_AMOUNT','f.INR_AMOUNT','f.DURATION','f.STATUS','f.CRATED_DATE','f.Months','f.expiry_date','f.FD_ID','f.perecent','u.FULLNAME','u.MOBILE'); 
    var $column_search_fixed = array('f.ID','f.GOLD_AMOUNT','f.INR_AMOUNT','f.DURATION','f.STATUS','f.CRATED_DATE','f.Months','f.expiry_date','f.FD_ID','f.perecent','u.FULLNAME','u.MOBILE');  
    var $order_fixed = array('f.ID' => 'desc');
	
    public function __construct() {
        parent::__construct();
    }
    
    // Fixed deposit payout history showing
    
      // Payout History
        private function _get_datatables_query_fixed(){
        $this->db->select($this->column_order_fixed);	
        $this->db->from($this->table_fixed);
        $this->db->join('USERS u','u.ID=f.USERID','inner');
       
        $i = 0;
        foreach ($this->column_search_fixed as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {   
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if(count($this->column_search_fixed) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order_fixed[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order_fixed)){
            $order = $this->order_fixed;
            $this->db->order_by(key($order), $order[key($order)]);
        }
      }
        function get_datatables_fixed() {
        $this->_get_datatables_query_fixed();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered_fixed(){
        $this->_get_datatables_query_fixed();
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function count_all_fixed(){
        $this->db->from($this->table_fixed);
        $this->db->join('USERS u','u.ID=f.USERID','inner');
       return $this->db->count_all_results();
    } 
    
    // Payout History
        private function _get_datatables_query_payout(){
        $this->db->select($this->column_order_payout);	
        $this->db->from($this->table_payout);
        $this->db->join('USERS u','u.ID=p.USERID','inner');
       
        $i = 0;
        foreach ($this->column_search_payout as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {   
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if(count($this->column_search_payout) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order_payout[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order_payout)){
            $order = $this->order_payout;
            $this->db->order_by(key($order), $order[key($order)]);
        }
      }
        function get_datatables_payout() {
        $this->_get_datatables_query_payout();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered_payout(){
        $this->_get_datatables_query_payout();
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function count_all_payout(){
        $this->db->from($this->table_payout);
        $this->db->join('USERS u','u.ID=p.USERID','inner');
       return $this->db->count_all_results();
    } 
    
    // Delivery Order pagining
    private function _get_datatables_query_delivery_order(){
        $this->db->select($this->column_order_delivery_order);	
        $this->db->from($this->table_delivery_order);
        $this->db->join('ADDRESSES a','a.ID=d.ADDRESS_ID','inner');
        $this->db->join('tb_city c','c.city_id=a.CITY','inner');
        $this->db->join('tb_state s','s.state_id=a.STATE','inner');
        $this->db->join('USERS u','u.ID=d.USERID','inner');
       
        $i = 0;
        foreach ($this->column_search_delivery_order as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {   
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if(count($this->column_search_delivery_order) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order_delivery_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order_delivery_order)){
            $order = $this->order_delivery_order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
      }
        function get_datatables_delivery_order() {
        $this->_get_datatables_query_delivery_order();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered_delivery_order(){
        $this->_get_datatables_query_delivery_order();
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function count_all_delivery_order(){
        $this->db->from($this->table_delivery_order);
        $this->db->join('ADDRESSES a','a.ID=d.ADDRESS_ID','inner');
        $this->db->join('tb_city c','c.city_id=a.CITY','inner');
        $this->db->join('tb_state s','s.state_id=a.STATE','inner');
        $this->db->join('USERS u','u.ID=d.USERID','inner');
       
       return $this->db->count_all_results();
    }  
    
    // Delivery pagining
    
          private function _get_datatables_query_delivery(){
        $this->db->select($this->column_order_delivery);	
        $this->db->from($this->table_delivery);
     
        $i = 0;
        foreach ($this->column_search_delivery as $item) // loop column 
        {
         if($_POST['search']['value']) // if datatable send POST for search
            {   
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else{
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search_delivery) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order_delivery[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order_delivery))
        {
            $order = $this->order_delivery;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables_delivery() {
        $this->_get_datatables_query_delivery();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered_delivery(){
        $this->_get_datatables_query_delivery();
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function count_all_delivery(){
          $this->db->from($this->table_delivery);
          return $this->db->count_all_results();
    } 
    
    // Withdraw Request Listing
       private function _get_datatables_query_withdraw(){
        $this->db->select($this->column_order_withdraw);	
        $this->db->join('USERS u','u.ID=l.USERID','inner');
        $this->db->from($this->table_withdraw);
     
        $i = 0;
        foreach ($this->column_search_withdraw as $item) // loop column 
        {
         if($_POST['search']['value']) // if datatable send POST for search
            {   
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else{
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search_withdraw) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order_withdraw[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order_withdraw))
        {
            $order = $this->order_withdraw;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables_withdraw() {
        $this->_get_datatables_query_withdraw();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered_withdraw(){
        $this->_get_datatables_query_withdraw();
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function count_all_withdraw(){
          $this->db->from($this->table_withdraw);
          $this->db->join('USERS u','u.ID=l.USERID','inner');
          return $this->db->count_all_results();
    }
    
    // KYC Users List
    
       private function _get_datatables_query_kyc(){
        $this->db->select($this->column_order_kyc);	
       $this->db->join('USERS u','u.ID=l.userid','inner');
        $this->db->from($this->table_kyc);
     
        $i = 0;
        foreach ($this->column_search_kyc as $item) // loop column 
        {
         if($_POST['search']['value']) // if datatable send POST for search
            {   
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else{
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search_kyc) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order_kyc[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order_kyc))
        {
            $order = $this->order_kyc;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables_kyc() {
        $this->_get_datatables_query_kyc();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered_kyc(){
        $this->_get_datatables_query_kyc();
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function count_all_admin_kyc(){
          $this->db->from($this->table_kyc);
         $this->db->join('USERS u','u.ID=l.userid','inner');
          return $this->db->count_all_results();
    }
    // Users Get History
    
    private function _get_datatables_query_users()
            {    
                 $this->db->select($this->column_order_users);
                 $this->db->from($this->table_users);
		
        $i = 0;
        foreach ($this->column_search_users as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {   
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search_users) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order_users[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order_users))
        {
            $order1 = $this->order_users;
            $this->db->order_by(key($order1), $order1[key($order1)]);
        }
    }
 
    function get_datatables_users() {
        $this->_get_datatables_query_users();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered_users(){
        $this->_get_datatables_query_users();
        $query = $this->db->get();
	//	echo $this->db->last_query();
        return $query->num_rows();
    }
    public function count_all_users(){
                $this->db->from($this->table_users);
                return $this->db->count_all_results();
    }
	/*---------------------------notification paginations-------------------------------------------------------------*/
	/*support team paginations*/
	
	/**/
	 private function _get_datatables_query_trade($type)
            {    
                 $this->db->select($this->column_order_trade);
                 $this->db->from($this->table_trade);
		$this->db->where('T.TRADE_TYPE',$type);
		$this->db->join('USERS U', 'U.ID = T.USERID','inner');
        $i = 0;
        foreach ($this->column_search_trade as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {   
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search_trade) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order_trade[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order_trade))
        {
            $order1 = $this->order_trade;
            $this->db->order_by(key($order1), $order1[key($order1)]);
        }
    }
 
    function get_datatables_trade($type) {
        $this->_get_datatables_query_trade($type);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered_trade($type){
        $this->_get_datatables_query_trade($type);
        $query = $this->db->get();
	//	echo $this->db->last_query();
        return $query->num_rows();
    }
    public function count_all_trade($type){
                $this->db->from($this->table_trade);
		$this->db->where('T.TRADE_TYPE',$type);
		$this->db->join('USERS U', 'U.ID = T.USERID','inner');
               
        return $this->db->count_all_results();
    }
	
 private function _get_datatables_query_deposit()
            {    
                 $this->db->select($this->column_order_deposit);
                 $this->db->from($this->table_deposit);
		$this->db->join('USERS U', 'U.ID = G.USERID','inner');
        $i = 0;
        foreach ($this->column_search_deposit as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {   
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search_deposit) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order_deposit[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order_deposit))
        {
            $order1 = $this->order_deposit;
            $this->db->order_by(key($order1), $order1[key($order1)]);
        }
    }
 
    function get_datatables_deposit() {
        $this->_get_datatables_query_deposit();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered_deposit(){
        $this->_get_datatables_query_deposit();
        $query = $this->db->get();
	//	echo $this->db->last_query();
        return $query->num_rows();
    }
    public function count_all_deposit(){
                $this->db->from($this->table_deposit);
		$this->db->join('USERS U', 'U.ID = G.USERID','inner');
               
        return $this->db->count_all_results();
    }
    public function login_support_process($data) {
	    $username=$data['username'];
	    $password=md5($data['password']);
        $login=$this->db->query("select ID,USERNAME,PASSWORD,EMAIL from ADMIN where USERNAME='$username' and PASSWORD='$password'")->row();
		//echo $this->db->last_query();
        //exit;
        
		if(count($login)==1){
        $session_data['ADMIN_ID']=$login->ID;
		$session_data['SUPPORT_USRNAME']=$login->USERNAME;
        $session_data['SUPPORT_EMAIL']=$login->EMAIL;
        $this->session->set_userdata($session_data);
		return 1;
		//echo 'Hii'; exit;
		}else{
		$_SESSION['errormsg']='Username or Password Incorrect?';
		return 0;
		}    
	
  }
}
