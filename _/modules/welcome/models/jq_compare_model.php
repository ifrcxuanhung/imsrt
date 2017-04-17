<?php
class Jq_compare_model extends CI_Model{
    protected $_lang;
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->_lang = $this->session->userdata_vnefrc('curent_language');
    }
	

	public function getTable($page,$limit,$sord, $sidx, $filter,$filter_get ='',$jq_table){
		
		
		$array_get = array();
		//echo "<pre>";print_r($filter_get);exit;
		$where = "where 1=1";
		$sql_count = "SELECT COUNT(*) AS count FROM $jq_table $where "; 
		//count filter
	
		// get field từ sysformat theo table
		$table_sys = $this->js_sys_format($jq_table);
	
		foreach($table_sys as $val){
			if(isset($filter[$val['name']])){
				$val_filter_count = $filter[$val['name']];
				if($val['searchoptions'] == 'select'){
					$sql_count.=" and $val[name] = '$val_filter_count' ";
				}else{
					$sql_count.=" and $val[name] LIKE '%$val_filter_count%' ";
				}
			}
		}
		
	
		//count filter get tren url
		foreach($table_sys as $val){
			if(isset($filter_get->$val['name'])){
				$val_filter_url = $filter_get->$val['name'];
				$sql_count.=" and $val[name] LIKE '%$val_filter_url%' ";
			}
		}
		
		$row = $this->db->query($sql_count)->row_array();
		$count = $row['count'];
		
		// calculate the total pages for the query 
		
		if( $count > 0 && $limit > 0) { 
					  $total_pages = ceil($count/$limit); 
		} else { 
					  $total_pages = 0; 
		} 
		 if($count != 0){
			// if for some reasons the requested page is greater than the total 
			// set the requested page to total page 
			if ($page > $total_pages) $page=$total_pages;
			 
			// calculate the starting position of the rows 
			$start = $limit*$page - $limit;
			
			
		$sql = "SELECT * FROM $jq_table $where ";
		
		//filter
		foreach($table_sys as $val){
			if(isset($filter[$val['name']])){
				$val_filter = $filter[$val['name']];
				if($val['searchoptions'] == 'select'){
					$sql.=" and $val[name] = '$val_filter' ";
				}else{
					$sql.=" and $val[name] LIKE '%$val_filter%' ";
				}
			}
		}
		//filter get tu trên url xuong
		//count filter get tren url
		foreach($table_sys as $val){
			if(isset($filter_get->$val['name'])){
				$val_filter_url_2 = $filter_get->$val['name'];
				$sql.=" and $val[name] LIKE '%$val_filter_url_2%' ";
			}
		}
		
		$sql.="ORDER BY $sidx $sord LIMIT $start , $limit";
		$data = array('records'=>$count,'page'=>$page,'total'=>$total_pages,'rows'=>$this->db->query($sql)->result_array());
			  
				
	
			  return $data;
		 }
		 else{
			 $data = array('records'=> 0 ,'page'=> 0 ,'total'=> 0 ,'rows'=> 0);
			return $data; 
		}
	}
	
	
	
	public function get_summary_des($tables){
		$this->db->select('description,order_by,user_level');
		$this->db->where('table_name', $tables); 
		$query = $this->db->get('efrc_summary');
		$result = $query->row_array();
		return $result;
	}
	
	public function js_sys_format($tables){
		
		$this->db->select('*');
		$this->db->where('tables', $tables);
		$this->db->where('active', 1); 
		$this->db->order_by('order', 'asc'); 
		$query = $this->db->get('jq_sys_format');
		$result = $query->result_array();
		/*$array = array('name'=>'action','index'=>'action','searchoptions'=>'','hidden'=>'','sortable'=>'false', 'formatter'=>'displayButtons','width'=>170);
		array_unshift($result,$array);*/
		//echo "<pre>";print_r($result);exit;
		return $result;
	}
	public function get_tab($tab='') {
		$sql = "select *
                from efrc_summary 
				where table_name = '$tab'";
                //where tab = '$tab' and user_level <=".$this->session->userdata_vnefrc('user_level');
		 return $this->db->query($sql)->row_array();       
    }
	function gets_headers($table='',$field='') {
        $ids = array($table);
        $sql = "select *
                from jq_sys_format 
                where `tables` ='".$table."' order by `order` asc ";
         return $this->db->query($sql)->result_array();
    }
	
	public function getCommontable(){
		$sql ="TRUNCATE jq_compare_composition;";
		$this->db->query($sql);        
		$sql="";
        $this->db->query($sql);        
       	
	}
	public function insert_top_comporation($com,$stt,$num,$per,$max){
		$this->db->set('number', $num);
		$this->db->set('percent', $per);
		$this->db->set('max_change', $max);
		$this->db->where('composition', $com);
		$this->db->where('stt', $stt);
		$this->db->update('top_composition');
	}
	public function insert_top_specs($com,$stt,$num,$per,$max){
		$this->db->set('number', $num);
		$this->db->set('percent', $per);
		$this->db->set('max_change', $max);
		$this->db->where('specs', $com);
		$this->db->where('stt', $stt);
		$this->db->update('top_specs');
	}
   public function count_top_composition($table_common){
		 $this->db->where('stt1', 0);
	  $num_rows_share_zero = $this->db->count_all_results($table_common);
	  $this->db->where('stt1', 1);
	  $num_rows_share_one = $this->db->count_all_results($table_common);
	  $percent_share_zero = round(($num_rows_share_zero*100)/($num_rows_share_one+$num_rows_share_zero),2)."%";
	  $percent_share_one = (100-$percent_share_zero)."%";
	  
	  $this->db->select_max('diff1');
	  $this->db->where('stt1', 0);
	  $max_share_change_zero = $this->db->get($table_common)->row_array();
	  
	  $this->db->select_max('diff1');
	  $this->db->where('stt1', 1);
	  $max_share_change_one = $this->db->get($table_common)->row_array();
	 
	 // echo "<pre>";print_r($max_share_change_one);exit;
	  
	  $this->db->where('stt2', 0);
	  $num_rows_mcap_zero = $this->db->count_all_results($table_common);
	  $this->db->where('stt2', 1);
	  $num_rows_mcap_one = $this->db->count_all_results($table_common);
	  
	  $percent_mcap_zero = round(($num_rows_mcap_zero*100)/($num_rows_mcap_one+$num_rows_mcap_zero),2)."%";
	  $percent_mcap_one = (100-$percent_mcap_zero)."%";
	  
	  $this->db->select_max('diff2');
	  $this->db->where('stt2', 0);
	  $max_mcap_change_zero = $this->db->get($table_common)->row_array();
	  
	  $this->db->select_max('diff2');
	  $this->db->where('stt2', 1);
	  $max_mcap_change_one = $this->db->get($table_common)->row_array();
	  
	  
	 
	  
	  $this->db->where('stt3', 0);
	  $num_rows_dcap_zero = $this->db->count_all_results($table_common);
	  $this->db->where('stt3', 1);
	  $num_rows_dcap_one = $this->db->count_all_results($table_common);
	  $percent_dcap_zero = round(($num_rows_dcap_zero*100)/($num_rows_dcap_one+$num_rows_dcap_zero),2)."%";
	  $percent_dcap_one = (100-$percent_dcap_zero)."%";
	  
	  $this->db->select_max('diff3');
	  $this->db->where('stt3', 0);
	  $max_dcap_change_zero = $this->db->get($table_common)->row_array();
	  
	  $this->db->select_max('diff3');
	  $this->db->where('stt3', 1);
	  $max_dcap_change_one = $this->db->get($table_common)->row_array();
	  
	 // echo "<pre>";print_r($max_dcap_change_one);exit;
	  
	   $this->db->where('stt4', 0);
	  $num_rows_price_zero = $this->db->count_all_results($table_common);
	  $this->db->where('stt4', 1);
	  $num_rows_price_one = $this->db->count_all_results($table_common);
	  $percent_price_zero = round(($num_rows_price_zero*100)/($num_rows_price_one+$num_rows_price_zero),2)."%";
	  $percent_price_one = (100-$percent_price_zero)."%";
	  
	   $this->db->select_max('diff4');
	  $this->db->where('stt4', 0);
	  $max_price_change_zero = $this->db->get($table_common)->row_array();
	 
	  
	  $this->db->select_max('diff4');
	  $this->db->where('stt4', 1);
	  $max_price_change_one = $this->db->get($table_common)->row_array();
	  //insert
	  $this->insert_top_comporation($com = "stk_shares_idx", $stt = 0,$num_rows_share_zero,$percent_share_zero, $max_share_change_zero['diff1']);
	  $this->insert_top_comporation($com = "stk_shares_idx", $stt = 1,$num_rows_share_one,$percent_share_one, $max_share_change_one['diff1']);
	  
	  $this->insert_top_comporation($com = "stk_mcap_idx", $stt = 0,$num_rows_mcap_zero,$percent_mcap_zero, $max_mcap_change_zero['diff2']);
	  $this->insert_top_comporation($com = "stk_mcap_idx", $stt = 1,$num_rows_mcap_one,$percent_mcap_one, $max_mcap_change_one['diff2']);
	  
	   $this->insert_top_comporation($com = "stk_dcap_idx", $stt = 0,$num_rows_dcap_zero,$percent_dcap_zero, $max_dcap_change_zero['diff3']);
	  $this->insert_top_comporation($com = "stk_dcap_idx", $stt = 1,$num_rows_dcap_one,$percent_dcap_one, $max_dcap_change_one['diff3']);
	  
	   $this->insert_top_comporation($com = "stk_price_idx", $stt = 0,$num_rows_price_zero,$percent_price_zero, $max_price_change_zero['diff4']);
	  $this->insert_top_comporation($com = "stk_price_idx", $stt = 1,$num_rows_price_one,$percent_price_one, $max_price_change_one['diff4']);	   
	}
	
	
	 public function count_top_specs($table_common){
		 $this->db->where('stt1', 0);
	  $num_rows_divisor_zero = $this->db->count_all_results($table_common);
	  
	  $this->db->where('stt1', 1);
	  $num_rows_divisor_one = $this->db->count_all_results($table_common);

	  $percent_divisor_zero = round(($num_rows_divisor_zero*100)/($num_rows_divisor_one+$num_rows_divisor_zero),2)."%";
	  $percent_divisor_one = (100-$percent_divisor_zero)."%";
	  
	  $this->db->select_max('diff1');
	  $this->db->where('stt1', 0);
	  $max_divisor_change_zero = $this->db->get($table_common)->row_array();
	  
	  $this->db->select_max('diff1');
	  $this->db->where('stt1', 1);
	  $max_divisor_change_one = $this->db->get($table_common)->row_array();
	 
	  
	  $this->db->where('stt2', 0);
	  $num_rows_mcap_zero = $this->db->count_all_results($table_common);
	  $this->db->where('stt2', 1);
	  $num_rows_mcap_one = $this->db->count_all_results($table_common);
	  
	  $percent_mcap_zero = round(($num_rows_mcap_zero*100)/($num_rows_mcap_one+$num_rows_mcap_zero),2)."%";
	  $percent_mcap_one = (100-$percent_mcap_zero)."%";
	  
	  $this->db->select_max('diff2');
	  $this->db->where('stt2', 0);
	  $max_mcap_change_zero = $this->db->get($table_common)->row_array();
	  
	  $this->db->select_max('diff2');
	  $this->db->where('stt2', 1);
	  $max_mcap_change_one = $this->db->get($table_common)->row_array();
	  
	  
	  $this->db->where('stt3', 0);
	  $num_rows_last_zero = $this->db->count_all_results($table_common);
	  $this->db->where('stt3', 1);
	  $num_rows_last_one = $this->db->count_all_results($table_common);
	  $percent_last_zero = round(($num_rows_last_zero*100)/($num_rows_last_one+$num_rows_last_zero),2)."%";
	  $percent_last_one = (100-$percent_last_zero)."%";
	  
	  $this->db->select_max('diff3');
	  $this->db->where('stt3', 0);
	  $max_last_change_zero = $this->db->get($table_common)->row_array();
	  
	  $this->db->select_max('diff3');
	  $this->db->where('stt3', 1);
	  $max_last_change_one = $this->db->get($table_common)->row_array();
	  
	  
	 
	  
	  $this->db->where('stt4', 0);
	  $num_rows_dcap_zero = $this->db->count_all_results($table_common);
	  $this->db->where('stt4', 1);
	  $num_rows_dcap_one = $this->db->count_all_results($table_common);
	  $percent_dcap_zero = round(($num_rows_dcap_zero*100)/($num_rows_dcap_one+$num_rows_dcap_zero),2)."%";
	  $percent_dcap_one = (100-$percent_dcap_zero)."%";
	  
	  $this->db->select_max('diff4');
	  $this->db->where('stt4', 0);
	  $max_dcap_change_zero = $this->db->get($table_common)->row_array();
	  
	  $this->db->select_max('diff4');
	  $this->db->where('stt4', 1);
	  $max_dcap_change_one = $this->db->get($table_common)->row_array();
	  
	 // echo "<pre>";print_r($max_dcap_change_one);exit;
	  
	   $this->db->where('stt5', 0);
	  $num_rows_pclose_zero = $this->db->count_all_results($table_common);
	  $this->db->where('stt5', 1);
	  $num_rows_pclose_one = $this->db->count_all_results($table_common);
	  $percent_pclose_zero = round(($num_rows_pclose_zero*100)/($num_rows_pclose_one+$num_rows_pclose_zero),2)."%";
	  $percent_pclose_one = (100-$percent_pclose_zero)."%";
	  
	   $this->db->select_max('diff5');
	  $this->db->where('stt5', 0);
	  $max_pclose_change_zero = $this->db->get($table_common)->row_array();
	 
	  
	  $this->db->select_max('diff5');
	  $this->db->where('stt5', 1);
	  $max_pclose_change_one = $this->db->get($table_common)->row_array();
	  //insert
	  $this->insert_top_specs($com = "idx_divisor", $stt = 0,$num_rows_divisor_zero,$percent_divisor_zero, $max_divisor_change_zero['diff1']);
	  $this->insert_top_specs($com = "idx_divisor", $stt = 1,$num_rows_divisor_one,$percent_divisor_one, $max_divisor_change_one['diff1']);
	  
	  $this->insert_top_specs($com = "idx_mcap", $stt = 0,$num_rows_mcap_zero,$percent_mcap_zero, $max_mcap_change_zero['diff2']);
	  $this->insert_top_specs($com = "idx_mcap", $stt = 1,$num_rows_mcap_one,$percent_mcap_one, $max_mcap_change_one['diff2']);
	  
	   $this->insert_top_specs($com = "idx_last", $stt = 0,$num_rows_last_zero,$percent_last_zero, $max_last_change_zero['diff3']);
	  $this->insert_top_specs($com = "idx_last", $stt = 1,$num_rows_last_one,$percent_last_one, $max_last_change_one['diff3']);
	  
	   $this->insert_top_specs($com = "idx_dcap", $stt = 0,$num_rows_dcap_zero,$percent_dcap_zero, $max_dcap_change_zero['diff4']);
	  $this->insert_top_specs($com = "idx_dcap", $stt = 1,$num_rows_dcap_one,$percent_dcap_one, $max_dcap_change_one['diff4']);
	  
	  $this->insert_top_specs($com = "idx_pclose", $stt = 0,$num_rows_pclose_zero,$percent_pclose_zero, $max_pclose_change_zero['diff5']);
	  $this->insert_top_specs($com = "idx_pclose", $stt = 1,$num_rows_pclose_one,$percent_pclose_one, $max_pclose_change_one['diff5']);	   
	}
	
	public function getTableCompare3($page,$limit,$sord, $sidx, $filter,$filter_get ='',$jq_table){

		$array_get = array();
		$where = "where 1=1";
		$sql_count = "SELECT COUNT(*) AS count FROM $jq_table $where "; 
		//count filter
	
		// get field từ sysformat theo table
		$table_sys = $this->js_sys_format($jq_table);
		foreach($table_sys as $val){
			if(isset($filter[$val['name']])){
				$val_filter_count = $filter[$val['name']];
				if($val['searchoptions'] == 'select'){
					$sql_count.=" and $val[name] = '$val_filter_count' ";
				}else{
					$sql_count.=" and $val[name] LIKE '%$val_filter_count%' ";
				}
			}
		}
	
		
		$row = $this->db->query($sql_count)->row_array();
		$count = $row['count'];
		
		// calculate the total pages for the query 
		
		if( $count > 0 && $limit > 0) { 
					  $total_pages = ceil($count/$limit); 
		} else { 
					  $total_pages = 0; 
		} 
		 if($count != 0){
			// if for some reasons the requested page is greater than the total 
			// set the requested page to total page 
			if ($page > $total_pages) $page=$total_pages;
			 
			// calculate the starting position of the rows 
			$start = $limit*$page - $limit;
			
			
		$sql = "SELECT * FROM $jq_table $where ";
		
		//filter
		//filter
		foreach($table_sys as $val){
			if(isset($filter[$val['name']])){
				$val_filter = $filter[$val['name']];
				if($val['searchoptions'] == 'select'){
					$sql.=" and $val[name] = '$val_filter' ";
				}else{
					$sql.=" and $val[name] LIKE '%$val_filter%' ";
				}
			}
		}
	
		$sql.="ORDER BY $sidx $sord LIMIT $start , $limit";
		//echo "<pre>";print_r($sql);exit; 
		$data = array('records'=>$count,'page'=>$page,'total'=>$total_pages,'rows'=>$this->db->query($sql)->result_array());
			  
				
	
			  return $data;
		 }
		 else{
			 $data = array('records'=> 0 ,'page'=> 0 ,'total'=> 0 ,'rows'=> 0);
			return $data; 
		}
	}
	
	
	public function getTableCompare3Two($page,$limit,$sord, $sidx, $filter,$filter_get ='',$jq_table){

		$array_get = array();
		$where = "where 1=1";
		$sql_count = "SELECT COUNT(*) AS count FROM $jq_table $where "; 
		//count filter
	
		// get field từ sysformat theo table
		$table_sys = $this->js_sys_format($jq_table);
		foreach($table_sys as $val){
			if(isset($filter[$val['name']])){
				$val_filter_count = $filter[$val['name']];
				if($val['searchoptions'] == 'select'){
					$sql_count.=" and $val[name] = '$val_filter_count' ";
				}else{
					$sql_count.=" and $val[name] LIKE '%$val_filter_count%' ";
				}
			}
		}
	
		
		$row = $this->db->query($sql_count)->row_array();
		$count = $row['count'];
		
		// calculate the total pages for the query 
		
		if( $count > 0 && $limit > 0) { 
					  $total_pages = ceil($count/$limit); 
		} else { 
					  $total_pages = 0; 
		} 
		 if($count != 0){
			// if for some reasons the requested page is greater than the total 
			// set the requested page to total page 
			if ($page > $total_pages) $page=$total_pages;
			 
			// calculate the starting position of the rows 
			$start = $limit*$page - $limit;
			
			
		$sql = "SELECT * FROM $jq_table $where ";
		
		//filter
		//filter
		foreach($table_sys as $val){
			if(isset($filter[$val['name']])){
				$val_filter = $filter[$val['name']];
				if($val['searchoptions'] == 'select'){
					$sql.=" and $val[name] = '$val_filter' ";
				}else{
					$sql.=" and $val[name] LIKE '%$val_filter%' ";
				}
			}
		}
	
		$sql.="ORDER BY $sidx $sord LIMIT $start , $limit";

		$data = array('records'=>$count,'page'=>$page,'total'=>$total_pages,'rows'=>$this->db->query($sql)->result_array());
			  
				
	
			  return $data;
		 }
		 else{
			 $data = array('records'=> 0 ,'page'=> 0 ,'total'=> 0 ,'rows'=> 0);
			return $data; 
		}
	}
	
	public function getTableCompare4($page,$limit,$sord, $sidx, $filter,$filter_get ='',$jq_table){

		$array_get = array();
		$where = "where 1=1";
		$sql_count = "SELECT COUNT(*) AS count FROM $jq_table $where "; 
		//count filter
	
		// get field từ sysformat theo table
		$table_sys = $this->js_sys_format($jq_table);
		foreach($table_sys as $val){
			if(isset($filter[$val['name']])){
				$val_filter_count = $filter[$val['name']];
				if($val['searchoptions'] == 'select'){
					$sql_count.=" and $val[name] = '$val_filter_count' ";
				}else{
					$sql_count.=" and $val[name] LIKE '%$val_filter_count%' ";
				}
			}
		}
	
		
		$row = $this->db->query($sql_count)->row_array();
		$count = $row['count'];
		
		// calculate the total pages for the query 
		
		if( $count > 0 && $limit > 0) { 
					  $total_pages = ceil($count/$limit); 
		} else { 
					  $total_pages = 0; 
		} 
		 if($count != 0){
			// if for some reasons the requested page is greater than the total 
			// set the requested page to total page 
			if ($page > $total_pages) $page=$total_pages;
			 
			// calculate the starting position of the rows 
			$start = $limit*$page - $limit;
			
			
		$sql = "SELECT * FROM $jq_table $where ";
		
		//filter
		//filter
		foreach($table_sys as $val){
			if(isset($filter[$val['name']])){
				$val_filter = $filter[$val['name']];
				if($val['searchoptions'] == 'select'){
					$sql.=" and $val[name] = '$val_filter' ";
				}else{
					$sql.=" and $val[name] LIKE '%$val_filter%' ";
				}
			}
		}
	
		$sql.="ORDER BY $sidx $sord LIMIT $start , $limit";

		$data = array('records'=>$count,'page'=>$page,'total'=>$total_pages,'rows'=>$this->db->query($sql)->result_array());
			  
				
	
			  return $data;
		 }
		 else{
			 $data = array('records'=> 0 ,'page'=> 0 ,'total'=> 0 ,'rows'=> 0);
			return $data; 
		}
	}
}

