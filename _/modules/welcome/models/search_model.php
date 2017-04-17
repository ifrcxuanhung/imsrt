<?php
class Search_model extends CI_Model{
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
	
		// get field t? sysformat theo table
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
		 // print_r($filter_get);exit;
		      if(isset($filter_get->query)){
		          $val_filter_url = $filter_get->query;
  				  $sql_count.=" AND `code` LIKE '%$val_filter_url%' OR `name` LIKE '%$val_filter_url%' ";
		    }else{
    			if(isset($filter_get->$val['name'])){
    				$val_filter_url = $filter_get->$val['name'];
    				$sql_count.=" or $val[name] LIKE '%$val_filter_url%' ";
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
		    if(isset($filter_get->query)){
		         $val_filter_url_2 = $filter_get->query;
  				  $sql.=" AND `code` LIKE '%$val_filter_url_2%' OR `name` LIKE '%$val_filter_url_2%' ";
		    }else{
    			if(isset($filter_get->$val['name'])){
    				$val_filter_url_2 = $filter_get->$val['name'];
    				$sql.=" OR $val[name] LIKE '%$val_filter_url_2%' ";
    			}
            }
		}
		
		$sql.="ORDER BY $sidx $sord LIMIT $start , $limit";
        $datas = $this->db->query($sql)->result_array();
        foreach($datas as $key=>$value){
            if($value['link_ims'] != '' || $value['link_ims'] != NULL){
                $datas[$key]['link_ims'] = '<a href="'.base_url().$value['link_ims'].'" class="btn btn-sm blue"><i class="fa fa-globe"></i></a>';
            }else{
                $datas[$key]['link_ims'] = '';
            }
        }
       // print_R($datas);exit;
		$data = array('records'=>$count,'page'=>$page,'total'=>$total_pages,'rows'=>$datas);
			  
				
	
			  return $data;
		 }
		 else{
			 $data = array('records'=> 0 ,'page'=> 0 ,'total'=> 0 ,'rows'=> 0);
			return $data; 
		}
	}
	
	
	
	public function getTableHierarchy($page,$limit,$sord, $sidx, $filter,$filter_get ='',$jq_table){
		$array_get = array();
		//echo "<pre>";print_r($filter_get);exit;
		$where = "where 1=1";
		$sql_count = "SELECT COUNT(*) AS count FROM $jq_table $where "; 
		//count filter
	
		// get field t? sysformat theo table
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
		$this->load->model('setup_model', 'dash');
        $next_date = $this->dash->get_next_date();
		if(isset($next_date['value']) && $next_date['value'] != ''){
			$sql.=" and exdate = '$next_date[value]' ";
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
	
	
	public function getTableHierarchy2($page,$limit,$sord, $sidx, $filter,$filter_get ='',$jq_table){
		$array_get = array();
		//echo "<pre>";print_r($filter_get);exit;
		// get date in setting_rt is compare
		$this->load->model('setup_model', 'dash');
        $next_date = $this->dash->get_next_date();
		//echo "<pre>";print_r($next_date);exit;
		//$sql_div_stk =  
		
		
		$where = "where 1=1";
		$sql_count = "SELECT COUNT(*) AS count FROM $jq_table $where "; 
		//count filter
	
		// get field t? sysformat theo table
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
		
		$sql.=" GROUP BY stk_code ORDER BY $sidx $sord LIMIT $start , $limit";
		
		$data = array('records'=>$count,'page'=>$page,'total'=>$total_pages,'rows'=>$this->db->query($sql)->result_array());
			  
				
	
			  return $data;
		 }
		 else{
			 $data = array('records'=> 0 ,'page'=> 0 ,'total'=> 0 ,'rows'=> 0);
			return $data; 
		}
	}
	
	
	
	public function getTableHierarchyChild($page,$limit,$sord, $sidx, $filter,$filter_get ='',$jq_table){
		$array_get = array();
		//echo "<pre>";print_r($filter_get);exit;
		$where = "where 1=1";
		$sql_count = "SELECT COUNT(*) AS count FROM $jq_table $where "; 
		//count filter
	
		// get field t? sysformat theo table
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
	
	
	
	public function getTableWebservice($page,$limit,$sord, $sidx, $filter,$filter_get ='',$jq_table){
		$array_get = array();
		//echo "<pre>";print_r($filter_get);exit;
		$where = "where 1=1";
		$sql_count = "SELECT COUNT(*) AS count FROM $jq_table $where "; 
		//count filter
	
		// get field t? sysformat theo table
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
	
		// get field t? sysformat theo table
		
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
	
		// get field t? sysformat theo table
		
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
	
		// get field t? sysformat theo table
		
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

