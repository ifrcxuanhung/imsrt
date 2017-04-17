<?php
class Jq_loadtable_model extends CI_Model{
    protected $_lang;
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->_lang = $this->session->userdata_vnefrc('curent_language');
    }
	

	public function getTable($page,$limit,$sord, $sidx, $filter,$filter_get ='',$jq_table){
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
					$sql_count.=" and `$val[name]` = '$val_filter_count' ";
				}else{
					$sql_count.=" and `$val[name]` LIKE '%$val_filter_count%' ";
				}
			}
		}
		
	
		//count filter get tren url
		foreach($table_sys as $val){
			if(isset($filter_get->$val['name'])){
				$val_filter_url = $filter_get->$val['name'];
				$sql_count.=" and `$val[name]` LIKE '%$val_filter_url%' ";
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
					$sql.=" and `$val[name]` = '$val_filter' ";
				}else{
					$sql.=" and `$val[name]` LIKE '%$val_filter%' ";
				}
			}
		}
		//filter get tu trên url xuong
		//count filter get tren url
		foreach($table_sys as $val){
			if(isset($filter_get->$val['name'])){
				$val_filter_url_2 = $filter_get->$val['name'];
				$sql.=" and `$val[name]` LIKE '%$val_filter_url_2%' ";
			}
		}
		
		$sql.="ORDER BY $sidx $sord LIMIT $start , $limit";
		
		$data = array('records'=>$count,'page'=>$page,'total'=>$total_pages,'rows'=>$this->db->query($sql)->result_array());
	//	print_R($data);exit;	  
				
		
			  return $data;
		 }
		 else{
			 $data = array('records'=> 0 ,'page'=> 0 ,'total'=> 0 ,'rows'=> 0);
			return $data; 
		}
	}
	
	
	
	
	
	public function getTableHierarchy($page,$limit,$sord, $sidx, $filter,$filter_get ='',$jq_table){
		
		$array_get = array();
		//echo "<pre>";print_r($jq_table);exit;
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
		$this->load->model('setup_model', 'dash');
        $calculation_date = $this->dash->get_calculation_date();
		
		if(isset($calculation_date['value']) && $calculation_date['value'] != ''){
			if($jq_table == 'stk_div_rt'){
				$sql_count.=" and exdate = '$calculation_date[value]' ";
			}else{
				$sql_count.=" and date = '$calculation_date[value]' ";	
			}
		}
		$sql_count.=" GROUP BY codeint";
		
		$row = $this->db->query($sql_count)->result_array();
		
		$count = count($row);
		//echo "<pre>";print_r($count);exit;
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
	
		if(isset($calculation_date['value']) && $calculation_date['value'] != ''){
			if($jq_table == 'stk_div_rt'){
				$sql.=" and exdate = '$calculation_date[value]' ";
			}else{
				$sql.=" and date = '$calculation_date[value]' ";	
			}
		}
		$sql.=" GROUP BY codeint ";
		$sql.="ORDER BY $sidx $sord LIMIT $start , $limit";
		
		$data = array('records'=>$count,'page'=>$page,'total'=>$total_pages,'rows'=>$this->db->query($sql)->result_array());
			  
				
	
			  return $data;
		 }
		 else{
			 $data = array('records'=> 0 ,'page'=> 0 ,'total'=> 0 ,'rows'=> 0);
			return $data; 
		}
	}
	
	public function getTableHierarchy3($page,$limit,$sord, $sidx, $filter,$filter_get ='',$jq_table){
		
		// begin difirent
		//get tu table idx_ca_rt theo setting
		$this->load->model('setup_model', 'dash');
        $calculation_date = $this->dash->get_calculation_date();
		//$str_ca = "()";	
		if(isset($calculation_date['value']) && $calculation_date['value'] != ''){
			$sql_ca = "SELECT codeint FROM idx_ca_rt WHERE date = '$calculation_date[value]'";
			$result_ca = $this->db->query($sql_ca)->result_array();
			if(!empty($result_ca)){
				$str_ca = "(";
				foreach($result_ca as $r_a){
					$str_ca .= 	"'".$r_a['codeint']."',";
				}
				$str_ca = substr($str_ca,0,-1);
				$str_ca .= ")";
				
			}
		}
		else{
			$str_ca = "()";	
		}
		// get tu table idx_composition_rt theo codeint
		//echo "<pre>";print_r($str_ca);exit;
		$sql_com = "SELECT idx_code FROM idx_composition_rt WHERE codeint IN $str_ca";
		$result_com = $this->db->query($sql_com)->result_array();
		if(!empty($result_com)){
			
			$str_com = "(";
				foreach($result_com as $r_c){
					$str_com .= "'".$r_c['idx_code']."',";
				}
				$str_com = substr($str_com,0,-1);
				$str_com .= ")";
				
		}
		else{
			$str_com = "()";		
		}
		// end difirent
		
		
		
		$array_get = array();
		//echo "<pre>";print_r($jq_table);exit;
		$where = "where idx_code IN $str_com ";
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
				$sql_count.=" and $val[name] LIKE '%$val_filter_url%'";
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
	
		/*if(isset($calculation_date['value']) && $calculation_date['value'] != ''){
			if($jq_table == 'stk_div_rt'){
				$sql.=" and exdate = '$calculation_date[value]' ";
			}else{
				$sql.=" and date = '$calculation_date[value]' ";	
			}
		}*/
		
		$sql.="ORDER BY $sidx $sord LIMIT $start , $limit";
		//echo "<pre>";print_r($sql);exit;
		//echo "<pre>";print_r($sql);exit;
		$data = array('records'=>$count,'page'=>$page,'total'=>$total_pages,'rows'=>$this->db->query($sql)->result_array());
			  
				
	
			  return $data;
		 }
		 else{
			 $data = array('records'=> 0 ,'page'=> 0 ,'total'=> 0 ,'rows'=> 0);
			return $data; 
		}
	}
	
	
	public function getTableHierarchy2($page,$limit,$sord, $sidx, $filter,$filter_get ='',$jq_table,$table){
		$array_get = array();
		// get date in setting_rt is compare
		$this->load->model('setup_model', 'dash');
        $calculation_date = $this->dash->get_calculation_date();
		if($table == 'stk_div_rt'){
			$sql_div_stk =  "SELECT stk_code FROM stk_div_rt WHERE `exdate` = '$calculation_date[value]'";
			$record_dv_stk = $this->db->query($sql_div_stk)->result_array();
			
			if(!empty($record_dv_stk)){
				$arr = "(";
				foreach($record_dv_stk as $val_div){
					$arr .= "'".$val_div['stk_code']."',";	
				}
				$arr = substr($arr,0,-1);
				$arr.=")";
			}else{
				$arr = "";	
			}
			//echo "<pre>";print_r($arr);exit;
			
			$where = "where 1=1";
			$sql_count = "SELECT COUNT(*) AS count FROM $jq_table $where "; 
			//count filter
		
			// get field từ sysformat theo table
			$table_sys = $this->js_sys_format2($jq_table);
		//echo "<pre>";print_r($filter_get);exit;
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
			if($arr != ''){
				$sql_count.= "and stk_code NOT IN $arr";	
			}
			$sql_count.= " and stk_dcap_idx <> 0 GROUP BY stk_code ";
			$row = $this->db->query($sql_count)->result_array();
			//echo "<pre>";print_r(count($row));exit;
			//$count = $row['count'];
			$count = count($row);
		
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
			//echo "<pre>";print_r($sql);exit;
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
			if($arr != ''){
				$sql.= "and stk_code NOT IN $arr";	
			}
			$sql.= " and stk_dcap_idx <> 0";
			
			$sql.=" GROUP BY stk_code ORDER BY $sidx $sord LIMIT $start , $limit";
			
			$data = array('records'=>$count,'page'=>$page,'total'=>$total_pages,'rows'=>$this->db->query($sql)->result_array());
				  
					
		
				  return $data;
			 }
			 else{
				 $data = array('records'=> 0 ,'page'=> 0 ,'total'=> 0 ,'rows'=> 0);
				return $data; 
			}
		}
		else{// thuoc table idx_ca_rt
			$sql_div_stk =  "SELECT stk_code, idx_code, removal, new_shares FROM idx_ca_rt WHERE `date` = '$calculation_date[value]' AND `removal` = 1";
			$record_dv_stk = $this->db->query($sql_div_stk)->result_array();	
			//echo "<pre>";print_r($record_dv_stk);exit;
			if(!empty($record_dv_stk)){
					$arr_stk_code = "(";
					$arr_idx_code = "(";
					foreach($record_dv_stk as $val_div){
						$arr_stk_code .= "'".$val_div['stk_code']."',";
						$arr_idx_code .= "'".$val_div['idx_code']."',";
					}
					$arr_stk_code = substr($arr_stk_code,0,-1);
					$arr_idx_code = substr($arr_idx_code,0,-1);
					
					$arr_stk_code.=")";
					$arr_idx_code.=")";
				}else{
					$arr_stk_code = "('false')";
					$arr_idx_code = "('false')";
				}
				
				$where = "where 1=1";
				$sql_count = "SELECT COUNT(*) AS count FROM $jq_table $where "; 
				//count filter
			
				// get field từ sysformat theo table
				$table_sys = $this->js_sys_format2($jq_table);
			//echo "<pre>";print_r($filter_get);exit;
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
				if($arr_stk_code != ''){
					$sql_count.= "AND stk_code IN $arr_stk_code AND idx_code IN $arr_idx_code";	
				}
				$sql_count.= " GROUP BY stk_code ";
				$row = $this->db->query($sql_count)->result_array();
				//echo "<pre>";print_r(count($row));exit;
				//$count = $row['count'];
				$count = count($row);
			
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
				//echo "<pre>";print_r($sql);exit;
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
				if($arr_stk_code != ''){
					$sql.= "AND stk_code IN $arr_stk_code AND idx_code IN $arr_idx_code";	
				}
				
				$sql.=" GROUP BY stk_code ORDER BY $sidx $sord LIMIT $start , $limit";
				$result = $this->db->query($sql)->result_array();
				
				
				
					
				
				//echo "<pre>";print_r($this->db->query($sql)->result_array());
				//echo "<pre>";print_r($result_finish);exit;
				
					
				}
				
				$sql_div_remove =  "SELECT stk_code, idx_code, removal, new_shares, nxt_float_idx, nxt_capp_idx FROM idx_ca_rt WHERE `date` = '$calculation_date[value]' AND `removal` = 0";
				$record_dv_remove = $this->db->query($sql_div_remove)->result_array();
				
				$sql_div_co =  "SELECT * FROM idx_composition_rt";
				$record_dv_co = $this->db->query($sql_div_co)->result_array();
				//echo "<pre>";print_r($record_dv_remove);
				//echo "<pre>";print_r($record_dv_co);exit;
				$result_finish = array();
				if(empty($result)){
					$result = array();	
				}
				foreach($record_dv_co as $re){
						foreach($record_dv_remove as $reco){
						if($re['stk_code'] == $reco['stk_code'] && $re['idx_code'] == $reco['idx_code']){
							if((($re['stk_shares_idx'] != $reco['new_shares'] && $reco['new_shares'] != NULL) || ($re['stk_float_idx'] != $reco['nxt_float_idx'] &&$reco['nxt_float_idx'] != NULL) || ($re['stk_capp_idx'] != $reco['nxt_capp_idx']) && $reco['nxt_capp_idx'] != NULL) ){
								$result_finish[] = $re;
							}
							
						}	
						}
						
				}//echo "<pre>";print_r($result_finish);exit;
				$result = array_merge($result, $result_finish);
				$data = array('records'=>$count,'page'=>$page,'total'=>$total_pages,'rows'=>$result);
					return $data;
		}
		//echo "<pre>";print_r($record_dv_stk);exit;
		
	}
	
	
	
	public function getTableHierarchyChild($page,$limit,$sord, $sidx, $filter,$filter_get ='',$jq_table){
		$array_get = array();
		//echo "<pre>";print_r($filter_get);exit;
		$where = "where 1=1";
		$sql_count = "SELECT COUNT(*) AS count FROM $jq_table $where "; 
		//count filter
	
		// get field từ sysformat theo table
		$table_sys = $this->js_sys_format("idx_composition_child_rt");
	
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
	
	public function getTableHierarchyChild_ca($page,$limit,$sord, $sidx, $filter,$filter_get ='',$jq_table){
		$array_get = array();
		$where = "where 1=1 AND codeint = '$filter[codeint]'";
		$sql_count = "SELECT COUNT(*) AS count FROM $jq_table $where "; 
		//count filter
	
		// get field từ sysformat theo table
		$table_sys = $this->js_sys_format("idx_ca_child_rt");

		foreach($table_sys as $val){
			if(isset($filter[$val['name']])){
				$val_filter_count = $filter[$val['name']];
				if($val['searchoptions'] == 'select'){
					$sql_count.=" and $val[name] = '$val_filter_count'";
				}else{
					$sql_count.=" and $val[name] LIKE '%$val_filter_count%'";
				}
			}
		}
		
		//count filter get tren url
		foreach($table_sys as $val){
			if(isset($filter_get->$val['name'])){
				$val_filter_url = $filter_get->$val['name'];
				$sql_count.=" and $val[name] LIKE '%$val_filter_url%'";
			}
		}
		//echo "<pre>";print_r($sql_count);exit;
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
					$sql.=" and $val[name] = '$val_filter'";
				}else{
					$sql.=" and $val[name] LIKE '%$val_filter%'";
				}
			}
		}
		//filter get tu trên url xuong
		//count filter get tren url
		foreach($table_sys as $val){
			if(isset($filter_get->$val['name'])){
				$val_filter_url_2 = $filter_get->$val['name'];
				$sql.=" and $val[name] LIKE '%$val_filter_url_2%'";
			}
		}
		
		$sql.="ORDER BY $sidx $sord LIMIT $start , $limit";
		//	echo "<pre>";print_r($sql);exit;
		$data = array('records'=>$count,'page'=>$page,'total'=>$total_pages,'rows'=>$this->db->query($sql)->result_array());
			  
				
	
			  return $data;
		 }
		 else{
			 $data = array('records'=> 0 ,'page'=> 0 ,'total'=> 0 ,'rows'=> 0);
			return $data; 
		}
	}
	
	public function getTableHierarchyChild_ca_compo($page,$limit,$sord, $sidx, $filter,$filter_get ='',$jq_table){
		$array_get = array();
		//echo "<pre>";print_r($filter_get);exit;
		$where = "where 1=1 AND codeint = '$filter[codeint]'";
		$sql_count = "SELECT COUNT(*) AS count FROM $jq_table $where "; 
		//count filter
	
		// get field từ sysformat theo table
		$table_sys = $this->js_sys_format("idx_composition_child2_rt");
		//echo "<pre>"; print_r($table_sys);exit;
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
		//echo "<pre>";print_r($sql_count);exit;
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
		//echo "<pre>";print_r($sql);exit;
		$data = array('records'=>$count,'page'=>$page,'total'=>$total_pages,'rows'=>$this->db->query($sql)->result_array());
			  
				
	
			  return $data;
		 }
		 else{
			 $data = array('records'=> 0 ,'page'=> 0 ,'total'=> 0 ,'rows'=> 0);
			return $data; 
		}
	}
	
	
	
	public function getTableHierarchyChild2($page,$limit,$sord, $sidx, $filter,$filter_get ='',$jq_table){

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
		//echo "<pre>";print_r($sql_count);exit;
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
	
	
	
	public function getTableWebservice($page,$limit,$sord, $sidx, $filter,$filter_get ='',$jq_table){
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
		
		$user_id = $this->session->userdata_vnefrc('user_id');
		$get_webservice_nrg = $this->db->query("SELECT webservice_nrg FROM login_users WHERE user_id = $user_id")->row_array();
		$get_list_ngf = '';
		if(isset($get_webservice_nrg['webservice_nrg'])){
			$get_list_ngf = $this->db->query("SELECT list_nrf FROM idx_webservice_rgt WHERE nrg = $get_webservice_nrg[webservice_nrg]")->row_array();	
		}
		$arr_list_nrf='';
		if($get_list_ngf['list_nrf'] == 'all'){
			$info = $this->db->select('*')->get("idx_webservice_feed")->result_array();
		}
		else{
			$arr_list_nrf = explode(",",$get_list_ngf['list_nrf']);
			$info = $this->db->select('*')->where_in("nrf",$arr_list_nrf)->get("idx_webservice_feed")->result_array();
				
		}
		
		$data = array('records'=>$count,'page'=>$page,'total'=>$total_pages,'rows'=>$info);
			  
				
	
			  return $data;
		 }
		 else{
			 $data = array('records'=> 0 ,'page'=> 0 ,'total'=> 0 ,'rows'=> 0);
			return $data; 
		}
	}
	
	public function getTableOverview($page,$limit,$sord, $sidx, $filter,$filter_get ='',$jq_table){
		$array_get = array();
		
		$where = "where 1=1";
		$sql_count = "SELECT COUNT(*) AS count FROM $jq_table $where "; 
		
		//count filter
	
		// get field từ sysformat theo table
		
		$table_sys = $this->js_sys_format('overview');
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
		$info = $this->db->query($sql)->result_array();
		
		/*foreach($info as $k=>$set_val){
			if($set_val['idx_dvar'] > 0){
				$info[$k]['idx_dvar'] = "<div style='color:red;'>".$set_val['idx_dvar']."</div>";
			}
		}*/
		$data = array('records'=>$count,'page'=>$page,'total'=>$total_pages,'rows'=>$info);
			  
				
	
			  return $data;
		 }
		 else{
			 $data = array('records'=> 0 ,'page'=> 0 ,'total'=> 0 ,'rows'=> 0);
			return $data; 
		}
	}
	
	
	public function getTableCompareComposition($page,$limit,$sord, $sidx, $filter,$filter_get ='',$jq_table){
		$array_get = array();
		
		$where = "where 1=1";
		$sql_count = "SELECT COUNT(*) AS count FROM $jq_table $where "; 
		
		//count filter
	
		// get field từ sysformat theo table
		
		$table_sys = $this->js_sys_format("jq_compare_composition");
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
		$info = $this->db->query($sql)->result_array();
		
		/*foreach($info as $k=>$set_val){
			if($set_val['idx_dvar'] > 0){
				$info[$k]['idx_dvar'] = "<div style='color:red;'>".$set_val['idx_dvar']."</div>";
			}
		}*/
		$data = array('records'=>$count,'page'=>$page,'total'=>$total_pages,'rows'=>$info);
			  
				
	
			  return $data;
		 }
		 else{
			 $data = array('records'=> 0 ,'page'=> 0 ,'total'=> 0 ,'rows'=> 0);
			return $data; 
		}
	}
	
	public function getTableCompareCompositionTwo($page,$limit,$sord, $sidx, $filter,$filter_get ='',$jq_table){
		$array_get = array();
		
		$where = "where 1=1";
		$sql_count = "SELECT COUNT(*) AS count FROM $jq_table $where "; 
		
		//count filter
	
		// get field từ sysformat theo table
		
		$table_sys = $this->js_sys_format("jq_compare_composition");
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
		$info = $this->db->query($sql)->result_array();
		
		/*foreach($info as $k=>$set_val){
			if($set_val['idx_dvar'] > 0){
				$info[$k]['idx_dvar'] = "<div style='color:red;'>".$set_val['idx_dvar']."</div>";
			}
		}*/
		$data = array('records'=>$count,'page'=>$page,'total'=>$total_pages,'rows'=>$info);
			  
				
	
			  return $data;
		 }
		 else{
			 $data = array('records'=> 0 ,'page'=> 0 ,'total'=> 0 ,'rows'=> 0);
			return $data; 
		}
	}
	
	public function getTableCompareSpecs($page,$limit,$sord, $sidx, $filter,$filter_get ='',$jq_table){
		$array_get = array();
		
		$where = "where 1=1";
		$sql_count = "SELECT COUNT(*) AS count FROM $jq_table $where "; 
		
		//count filter
	
		// get field từ sysformat theo table
		
		$table_sys = $this->js_sys_format("jq_compare_specs");
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
		$info = $this->db->query($sql)->result_array();
		
		/*foreach($info as $k=>$set_val){
			if($set_val['idx_dvar'] > 0){
				$info[$k]['idx_dvar'] = "<div style='color:red;'>".$set_val['idx_dvar']."</div>";
			}
		}*/
		$data = array('records'=>$count,'page'=>$page,'total'=>$total_pages,'rows'=>$info);
			  
				
	
			  return $data;
		 }
		 else{
			 $data = array('records'=> 0 ,'page'=> 0 ,'total'=> 0 ,'rows'=> 0);
			return $data; 
		}
	}
	
	
	public function getTableCompareSpecsTwo($page,$limit,$sord, $sidx, $filter,$filter_get ='',$jq_table){
		$array_get = array();
		
		$where = "where 1=1";
		$sql_count = "SELECT COUNT(*) AS count FROM $jq_table $where "; 
		
		//count filter
	
		// get field từ sysformat theo table
		
		$table_sys = $this->js_sys_format("jq_compare_specs");
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
		$info = $this->db->query($sql)->result_array();
		
		/*foreach($info as $k=>$set_val){
			if($set_val['idx_dvar'] > 0){
				$info[$k]['idx_dvar'] = "<div style='color:red;'>".$set_val['idx_dvar']."</div>";
			}
		}*/
		$data = array('records'=>$count,'page'=>$page,'total'=>$total_pages,'rows'=>$info);
			  
				
	
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
	
	public function js_sys_format2($tables){
	
		$this->db->select('*');
		$this->db->where('tables', $tables);
		$this->db->where('active', 1); 
		if($tables == 'idx_composition_rt'){
	
			$this->db->where('active_short', 1);	
		}
		
		$this->db->order_by('order', 'asc'); 
		
		$query = $this->db->get('jq_sys_format');
		$result = $query->result_array();
			
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
   
}

