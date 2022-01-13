<?php 
 class Datatables_Model extends CI_Model {
    var $table_buy = 'GOLD_PARCHASE_MASTER';
    var $column_order_buy = array(null, 'ID','USERID','PER_GRAM_RATE','TOTAL_AMOUNT','GST_AMOUNT','QTY','ORDER_TYPE','STATUS','DATES','TXTID','PAYMENT_ID','ORDER_STATUS','PAYMENT_TYPE','dISAPPROVED_NOTE'); 
    var $column_search_buy = array('ID','USERID','PER_GRAM_RATE','TOTAL_AMOUNT','GST_AMOUNT','QTY','ORDER_TYPE','STATUS','DATES','TXTID','PAYMENT_ID','ORDER_STATUS','PAYMENT_TYPE','dISAPPROVED_NOTE');  
    var $order_buy = array('ID' => 'desc');
    
    var $table_trade = 'TRADE';
    var $column_order_trade = array(null, 'ID','USERID','TRADE_ID','MARKET_RATE','GOLD_WEIGHT','TOTAL_INR','FEES','STATUS','TRADE_TYPE','DATES','GST','order_type'); 
    var $column_search_trade = array('ID','USERID','TRADE_ID','MARKET_RATE','GOLD_WEIGHT','TOTAL_INR','FEES','STATUS','TRADE_TYPE','DATES','GST','order_type');  
    var $order_trade = array('ID' => 'desc');
    
    
    var $table_withdraw = 'WITHDRAW';
    var $column_order_withdraw = array(null, 'ID','USERID','AMOUNT','FEES','FIAT_TYPE','STATUS','CRATED_DATE','REQUEST_ID'); 
    var $column_search_withdraw = array('ID','USERID','AMOUNT','FEES','FIAT_TYPE','STATUS','CRATED_DATE','REQUEST_ID');  
    var $order_withdraw = array('ID' => 'desc');
    
    var $table_referral = 'USERS';
    var $column_order_referral = array(null, 'ID','FULLNAME','MOBILE','EMAIL','CREATED_DATE','REFFERAL_CODE'); 
    var $column_search_referral = array('ID','FULLNAME','EMAIL','MOBILE','CREATED_DATE','REFFERAL_CODE');  
    var $order_referral = array('ID' => 'desc');
    
    var $table_income = 'Referral_Income';
    var $column_order_income = array(null, 'ID','REFERRAL_ID','USERID','INCOME_AMOUNT','DATES'); 
    var $column_search_income = array('ID','REFERRAL_ID','USERID','INCOME_AMOUNT','DATES');  
    var $order_income = array('ID' => 'desc');
    
   
    var $table_fixed = 'FiXED_DEPOSIT_MASTER';
    var $column_order_fixed = array(null, 'ID','GOLD_AMOUNT','INR_AMOUNT','DURATION','STATUS','CRATED_DATE','Months','expiry_date','FD_ID','perecent'); 
    var $column_search_fixed = array('ID','GOLD_AMOUNT','INR_AMOUNT','DURATION','STATUS','CRATED_DATE','Months','expiry_date','FD_ID','perecent');  
    var $order_fixed = array('ID' => 'desc');
    
    var $table_payout = 'MOTHLY_GOLD_PAYOUT';
    var $column_order_payout = array(null, 'ID','GOLD_AMOUNT','USERID','DATES'); 
    var $column_search_payout = array('ID','GOLD_AMOUNT','USERID','DATES');  
    var $order_payout = array('ID' => 'desc');
    
    var $table_payout_daily = 'DAILY_GOLD_OUTPUT';
    var $column_order_payout_daily = array(null, 'ID','GOLD_AMOUNT','USERID','created_date','FD_ID'); 
    var $column_search_payout_daily = array('ID','GOLD_AMOUNT','USERID','created_date','FD_ID');  
    var $order_payout_daily = array('ID' => 'desc');
    
    var $table_delivery = 'DELIVERY_MASTER d';
    var $column_order_delivery = array(null, 'd.ORDER_ID','d.USERID','d.ID','d.ADDRESS_ID','d.PRODUCT_ID','d.STATUS','d.CREATED_DATE','d.PRODUCT_NAME','d.INR_AMOUNT','d.GOLD_WEIGHT','a.NAME','a.ADDRESS','a.PINCODE','a.MOBILE','c.city','s.state'); 
    var $column_search_delivery = array('d.ORDER_ID','d.USERID','d.ID','d.ADDRESS_ID','d.PRODUCT_ID','d.STATUS','d.CREATED_DATE','d.PRODUCT_NAME','d.INR_AMOUNT','d.GOLD_WEIGHT','a.NAME','a.ADDRESS','a.PINCODE','a.MOBILE','c.city','s.state');  
    var $order_delivery = array('ID' => 'desc');
    
    
   	public function __construct() {
        parent::__construct();
        $this->load->helper('date');
    }
    
  // Delivery Address Details
        private function _get_datatables_query_delivery($useird){
        $this->db->select($this->column_order_delivery);	
        $this->db->from($this->table_delivery);
        $this->db->join('ADDRESSES a','a.ID=d.ADDRESS_ID','inner');
        $this->db->join('tb_city c','c.city_id=a.CITY','inner');
        $this->db->join('tb_state s','s.state_id=a.STATE','inner');
        $this->db->where('d.USERID',$useird);
       
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
                else
                {
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
        else if(isset($this->order_delivery)){
            $order = $this->order_delivery;
            $this->db->order_by(key($order), $order[key($order)]);
        }
      }
        function get_datatables_delivery($useird) {
        $this->_get_datatables_query_delivery($useird);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered_delivery($useird){
        $this->_get_datatables_query_delivery($useird);
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function count_all_delivery($useird){
        $this->db->from($this->table_delivery);
        $this->db->join('ADDRESSES a','a.ID=d.ADDRESS_ID','inner');
        $this->db->join('tb_city c','c.city_id=a.CITY','inner');
        $this->db->join('tb_state s','s.state_id=a.STATE','inner');
        $this->db->where('d.USERID',$useird);
       return $this->db->count_all_results();
    } 
    
    // Daily Fixed deposit payout history
    
      private function _get_datatables_query_payout_daily($fd_id,$useird){
        $this->db->select($this->column_order_payout_daily);	
         $this->db->from($this->table_payout_daily);
        $this->db->where('FD_ID',$fd_id);
        $this->db->where('USERID',$useird);
       
        $i = 0;
        foreach ($this->column_search_payout_daily as $item) // loop column 
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
                if(count($this->column_search_payout_daily) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order_payout_daily[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order_payout_daily)){
            $order = $this->order_payout_daily;
            $this->db->order_by(key($order), $order[key($order)]);
        }
      }
    function get_datatables_referral_payout_daily($fd_id,$useird) {
        $this->_get_datatables_query_payout_daily($fd_id,$useird);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered_referral_payout_daily($fd_id,$useird){
        $this->_get_datatables_query_payout_daily($fd_id,$useird);
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function count_all_referral_payout_daily($fd_id,$useird){
       $this->db->from($this->table_payout_daily);
       $this->db->where('FD_ID',$fd_id);
       $this->db->where('USERID',$useird);
       return $this->db->count_all_results();
    } 
      
    
    private function _get_datatables_query_payout($referral){
        $this->db->select($this->column_order_payout);	
        $this->db->from($this->table_payout);
        $this->db->where('USERID',$referral);
       
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
    function get_datatables_referral_payout($referral) {
        $this->_get_datatables_query_payout($referral);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered_referral_payout($referral){
        $this->_get_datatables_query_payout($referral);
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function count_all_referral_payout($referral){
       $this->db->from($this->table_payout);
       $this->db->where('USERID',$referral);
       return $this->db->count_all_results();
    }  
    
    // Fixed Deposit List Getting
       private function _get_datatables_query_fixed($referral){
        $this->db->select($this->column_order_fixed);	
        $this->db->from($this->table_fixed);
        $this->db->where('USERID',$referral);
       
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
    function get_datatables_referral_fixed($referral) {
        $this->_get_datatables_query_fixed($referral);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered_referral_fixed($referral){
        $this->_get_datatables_query_fixed($referral);
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function count_all_referral_fixed($referral){
       $this->db->from($this->table_fixed);
       $this->db->where('USERID',$referral);
       return $this->db->count_all_results();
    }   
    
    // Referral Income Details
    private function _get_datatables_query_referral_income($referral)
         {
        $this->db->select($this->column_order_income);	
        $this->db->from($this->table_income);
        $this->db->where('REFERRAL_ID',$referral);
       
        $i = 0;
        foreach ($this->column_search_income as $item) // loop column 
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
                if(count($this->column_search_income) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order_income[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order_income)){
            $order = $this->order_income;
            $this->db->order_by(key($order), $order[key($order)]);
        }
      }
    function get_datatables_referral_income($referral) {
        $this->_get_datatables_query_referral_income($referral);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered_referral_income($referral){
        $this->_get_datatables_query_referral_income($referral);
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function count_all_referral_income($referral){
       $this->db->from($this->table_income);
       $this->db->where('REFERRAL_ID',$referral);
       return $this->db->count_all_results();
    }  
    // Referral Users List
   private function _get_datatables_query_referral($referral)
         {
        $userid=$this->session->userdata('USERID');
        $this->db->select($this->column_order_referral);	
        $this->db->from($this->table_referral);
        $this->db->where('REFFERAL_CODE',$referral);
       
        $i = 0;
        foreach ($this->column_search_referral as $item) // loop column 
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
                if(count($this->column_search_referral) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order_referral[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order_referral)){
            $order = $this->order_referral;
            $this->db->order_by(key($order), $order[key($order)]);
        }
      }
    function get_datatables_referral($referral) {
        $this->_get_datatables_query_referral($referral);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered_referral($referral){
        $this->_get_datatables_query_referral($referral);
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function count_all_referral($referral){
       $this->db->from($this->table_referral);
       $this->db->where('REFFERAL_CODE',$referral);
       return $this->db->count_all_results();
    }   
    
    //Withdraw History
   private function _get_datatables_query_withdraw()
         {
        $userid=$this->session->userdata('USERID');
        $this->db->select($this->column_order_withdraw);	
        $this->db->from($this->table_withdraw);
        $this->db->where('USERID',$userid);
       
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
                else
                {
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
        else if(isset($this->order_withdraw)){
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
       $userid=$this->session->userdata('USERID');
       $this->db->from($this->table_withdraw);
       $this->db->where('USERID',$userid);
       return $this->db->count_all_results();
    }
 // Deposit History
private function _get_datatables_query_buy()
         {
        $userid=$this->session->userdata('USERID');
        $this->db->select($this->column_order_buy);	
        $this->db->from($this->table_buy);
        $this->db->where('USERID',$userid);
       
        $i = 0;
        foreach ($this->column_search_buy as $item) // loop column 
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
                if(count($this->column_search_buy) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order_buy[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order_buy)){
            $order = $this->order_buy;
            $this->db->order_by(key($order), $order[key($order)]);
        }
      }
    function get_datatables_buy() {
        $this->_get_datatables_query_buy();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered_buy(){
        $this->_get_datatables_query_buy();
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function count_all_buy(){
       $userid=$this->session->userdata('USERID');
        $this->db->from($this->table_buy);
       $this->db->where('USERID',$userid);
        return $this->db->count_all_results();
    }
  // Trade History
    
 private function _get_datatables_query_trade($type)
         {
        $userid=$this->session->userdata('USERID');
        $this->db->select($this->column_order_trade);	
        $this->db->from($this->table_trade);
        $this->db->where('USERID',$userid);
        $this->db->where('TRADE_TYPE',$type);
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
        else if(isset($this->order_trade)){
            $order = $this->order_trade;
            $this->db->order_by(key($order), $order[key($order)]);
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
        return $query->num_rows();
    }
    public function count_all_trade($type){
        $this->db->from($this->table_trade);
        $this->db->where('TRADE_TYPE',$type);
        return $this->db->count_all_results();
    }
  }