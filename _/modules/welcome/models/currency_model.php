<?php
class Currency_model extends CI_Model{
    protected $_lang;
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->_lang = $this->session->userdata_vnefrc('curent_language');
    }
	

	public function getCurrency($page,$limit,$sord, $sidx, $filter){
		
		//echo "<pre>";print_r(count($filter));exit;
		//$where = '';
		//if(count($filter) > 7){
			$where = "where 1=1";	
		//}
		$sql_count = "SELECT COUNT(*) AS count FROM efrc_currency_data_day $where "; 
		//count filter
		if(isset($filter['code'])){
			$sql_count.=" and code LIKE '%$filter[code]%' ";	
		}
		if(isset($filter['date'])){
			$date = date("Y-m-d",strtotime($filter['date']));
			$sql_count.=" and date = '$date' ";		
		}
		if(isset($filter['close'])){
				$sql_count.=" and close LIKE '%$filter[close]%' ";		
		}
		if(isset($filter['type'])){
				$sql_count.=" and type LIKE '%$filter[type]%' ";		
		}
		if(isset($filter['cur_from'])){
				$sql_count.=" and cur_from LIKE '%$filter[cur_from]%' ";		
		}
		if(isset($filter['cur_to'])){
				$sql_count.=" and cur_to LIKE '%$filter[cur_to]%' ";		
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
			
			
			$sql = "SELECT * FROM efrc_currency_data_day $where ";
			//filter
			if(isset($filter['code'])){
				$sql.=" and code LIKE '%$filter[code]%' ";	
			}
			if(isset($filter['date'])){
				$date = date("Y-m-d",strtotime($filter['date']));
				$sql.=" and date = '$date' ";		
			}
			if(isset($filter['close'])){
				$sql.=" and close LIKE '%$filter[close]%' ";		
			}
			if(isset($filter['type'])){
				$sql.=" and type LIKE '%$filter[type]%' ";		
			}
			if(isset($filter['cur_from'])){
				$sql.=" and cur_from LIKE '%$filter[cur_from]%' ";		
		}
		if(isset($filter['cur_to'])){
				$sql.=" and cur_to LIKE '%$filter[cur_to]%' ";		
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


























