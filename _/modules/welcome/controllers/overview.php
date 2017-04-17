<?php
class Overview extends Welcome{

    public function __construct() {
        parent::__construct();
		
		$this->load->database();
		$this->load->model('Jq_loadtable_model', 'table');
    }
 
    public function index(){
		$tables='overview';
		// export theo tung dinh dang file
		if(isset($_REQUEST['actexport'])&&($_REQUEST['actexport']=='exportCsv'||$_REQUEST['actexport']=='exportTxt')){
			$this->export();
		}
		else if(isset($_REQUEST['actexport'])&&($_REQUEST['actexport']=='exportXls')){
			$this->exportXls();
		}
		//end export theo tung dinh dang file
		
		$this->data->table = $tables;
		 $this->load->model('jq_loadtable_model');
		/* $this->data->column = str_replace('}]','}',str_replace('[{"','{',str_replace(',"',',',str_replace('":',':',json_encode($this->jq_loadtable_model->js_sys_format($tables))))));*/
		$column = $this->jq_loadtable_model->js_sys_format('overview');
		
		$table_common =  "(SELECT idx_ref_rt.idx_bbs, idx_ref_rt.ims_order, idx_ref_rt.idx_code, idx_ref_rt.idx_name_sn as idx_name
			
			,idx_specs_rt.date, idx_specs_rt.time, idx_specs_rt.idx_divisor, idx_specs_rt.idx_mcap, idx_specs_rt.idx_dcap, idx_specs_rt.idx_last, idx_specs_rt.idx_var, idx_specs_rt.idx_dvar, idx_specs_rt.idx_change, idx_specs_rt.provider, idx_specs_rt.type FROM idx_ref_rt
            LEFT JOIN idx_specs_rt
            ON idx_ref_rt.idx_code = idx_specs_rt.idx_code
			
            WHERE idx_ref_rt.calculs = 1
            AND idx_ref_rt.mother = 1 and idx_ref_rt.realtime=1) A ";
		
		
		foreach($column as $k=>$val_column){
			if($val_column['searchoptions'] == 'select'){
				$column[$k]['stype'] = "select";
				//get select
				$this->db->select($val_column['name']);
				$this->db->distinct();
				$this->db->order_by($val_column['name'],"ASC");
			
				$query = $this->db->get($table_common);
				$data = $query->result_array();
				$result='';
				foreach($data as $key=>$v){
					if($v[$val_column['name']] == ''){
						unset($data[$key]);
					}else{
						$result.= $v[$val_column['name']].":".$v[$val_column['name']].";";
					}
					
				}
				$column[$k]['selectlist'] = json_encode($result);
				//end get select	
			}
			if($val_column['hidden'] == 'false'){
				unset($column[$k]['hidden']);	
			}
			$column[$k]['headertitles'] = "";
			$column[$k]['cellattr'] = "" ;
			
			
			
		}
		
		//echo "<pre>";print_r($column);exit;
		 $this->data->column =json_encode($column);
		 
		 // get list neu searchoptions =1 

	
		
		if(isset($_GET))
			$this->data->filter_get_all = json_encode($_GET);
		/*if(isset($_GET['code']))
			$this->data->filter_code = $_GET['code'];
		if(isset($_GET['date']))
			$this->data->filter_date = $_GET['date'];
		if(isset($_GET['close']))
			$this->data->filter_close = $_GET['close'];
		if(isset($_GET['cur_from']))
			$this->data->filter_cur_from = $_GET['cur_from'];
		if(isset($_GET['cur_to']))
			$this->data->filter_cur_to = $_GET['cur_to'];*/
		$this->data->summary_des = $this->jq_loadtable_model->get_summary_des($tables);
		
		$this->template->write_view('content', 'overview',$this->data);
		$this->template->render();

    }
	public function jq_loadtable(){
		//echo "<pre>";print_r($_REQUEST);exit;
		$jq_table =  "(SELECT idx_ref_rt.idx_bbs, idx_ref_rt.ims_order, idx_ref_rt.idx_code, idx_ref_rt.idx_name_sn as idx_name
			
			,idx_specs_rt.date, idx_specs_rt.time, idx_specs_rt.idx_divisor, idx_specs_rt.idx_mcap, idx_specs_rt.idx_dcap, idx_specs_rt.idx_last, idx_specs_rt.idx_var, idx_specs_rt.idx_dvar, idx_specs_rt.idx_dchange, idx_specs_rt.provider, idx_specs_rt.type FROM idx_ref_rt
            LEFT JOIN idx_specs_rt
            ON idx_ref_rt.idx_code = idx_specs_rt.idx_code
			
            WHERE idx_ref_rt.calculs = 1
            AND idx_ref_rt.mother = 1) A ";
		$page = $_REQUEST['page']; 
 
		// get how many rows we want to have into the grid - rowNum parameter in the grid 
		$limit = $_REQUEST['rows']; 
		$sidx = $_REQUEST['sidx'];
		$filter_get = array(); 
		
		if(isset($_REQUEST['filter_get_all'])){
			$filter_get = json_decode($_REQUEST['filter_get_all']);
		}
		// get index row - i.e. user click to sort. At first time sortname parameter -
		// after that the index from colModel 
		// sorting order - at first time sortorder 
	
		if(!$sidx) $sidx =1; 
		//echo "hung";exit;
		 $this->load->model('jq_loadtable_model');
		 $sord = $_REQUEST['sord'];

		$filter = $_REQUEST;
	
		$result = $this->jq_loadtable_model->getTableOverview($page,$limit,$sord,$sidx,$filter,$filter_get,$jq_table);
		//var_export($result);exit;
		echo json_encode($result);
	}
	
	public function edit_del_add_overview(){
		//echo "<pre>";print_r($_REQUEST['jq_table']);exit;
		$jq_table = "idx_specs_rt";
		 $this->load->model('article_model');
		 
		$data = array();
		
		if($_POST['oper'] == 'del'){
			$this->db->delete($jq_table, array('id' => $_POST['id'])); 
			echo "true";
		}
		if($_POST['oper'] == 'add'){
			foreach($_POST as $k=>$v){
				if($k!= 'oper' && $k!= 'id')
					$data[$k] = $v;	
			}exit;
			$this->db->insert($jq_table, $data); 
			echo "true";
			
		}
		 if($_POST['oper'] == 'edit'){
			foreach($_POST as $k=>$v){
				if($k!= 'oper' && $k!= 'id')
					$data[$k] = $v;	
			}

			$this->db->where('id', $_POST['id']);
			$this->db->update($jq_table, $data);
			echo "true";
			
		 }
	}
	function export() {
		$table = isset($_REQUEST['table_name_export'])? $_REQUEST['table_name_export'] :'';
		$arr_table_sys = $this->table->get_tab($table);
		
		$table_sys = isset($arr_table_sys["tables"]) ? $arr_table_sys["tables"] : $table;
		$headers = $this->table->gets_headers($table_sys);
		
        // select columns
        $where = "where 1=1";
        
        $aColumns = array();
		$aColumnsHeader = array();
		foreach ($headers as $item) {
			$aColumnsHeader[]=$item['label'];
			$aColumns[] = $item['name'];
		}
        unset($headers);

        
		$sTable = $table_sys; //$category == 'all' ? "efrc_".$table : "(SELECT * FROM efrc_".$table." where category = '".$category."') as sTable " ;
		
		
		
		 //$order_by = (($arr_table_sys['order']!='') && (!is_null($arr_table_sys['order'])))?('order by '.$arr_table_sys['order']):'';
		if(is_null($arr_table_sys['limit_export'])){
			$sql = "(SELECT idx_ref_rt.idx_bbs, idx_ref_rt.ims_order, idx_ref_rt.idx_code, idx_ref_rt.idx_name_sn as idx_name
			
			,idx_specs_rt.date, idx_specs_rt.time, idx_specs_rt.idx_divisor, idx_specs_rt.idx_mcap, idx_specs_rt.idx_dcap, idx_specs_rt.idx_last, idx_specs_rt.idx_var, idx_specs_rt.idx_dvar, idx_specs_rt.idx_change, idx_specs_rt.provider, idx_specs_rt.type FROM idx_ref_rt
            LEFT JOIN idx_specs_rt
            ON idx_ref_rt.idx_code = idx_specs_rt.idx_code
			
            WHERE idx_ref_rt.calculs = 1
            AND idx_ref_rt.mother = 1 and idx_ref_rt.realtime=1)" ;
						
			
		}
		else {
			
			//$level = 0;
		//$arrlimit = explode(";",$arr_table_sys['limit_export']);
		//$limit = isset($arrlimit[$level]) ? $arrlimit[$level] :10;
		/*$sql = "select sql_calc_found_rows " . str_replace(' , ', ' ', implode(', ', $aColumns)) . "
                from {$sTable} {$where} {$order_by} limit {$limit};";*/
		$sql = "(SELECT idx_ref_rt.idx_bbs, idx_ref_rt.ims_order, idx_ref_rt.idx_code, idx_ref_rt.idx_name_sn as idx_name
			
			,idx_specs_rt.date, idx_specs_rt.time, idx_specs_rt.idx_divisor, idx_specs_rt.idx_mcap, idx_specs_rt.idx_dcap, idx_specs_rt.idx_last, idx_specs_rt.idx_var, idx_specs_rt.idx_dvar, idx_specs_rt.idx_change, idx_specs_rt.provider, idx_specs_rt.type FROM idx_ref_rt
            LEFT JOIN idx_specs_rt
            ON idx_ref_rt.idx_code = idx_specs_rt.idx_code
			
            WHERE idx_ref_rt.calculs = 1
            AND idx_ref_rt.mother = 1 and idx_ref_rt.realtime=1)";
		}
        $this->load->dbutil();
        $query = $this->db->query($sql)->result_array();
		if(isset($_REQUEST['actexport'])&&($_REQUEST['actexport']=='exportCsv')){
		$this->dbutil->export_to_csv("{$table_sys}", $query, $aColumnsHeader, null,",", true);
		}
		else if(isset($_REQUEST['actexport'])&&($_REQUEST['actexport']=='exportTxt')){
			
		$this->dbutil->export_to_txt("{$table_sys}", $query, $aColumnsHeader, null,chr(9), true);
		}		
		die();
		
    }
	public function exportXls(){
		$table = isset($_REQUEST['table_name_export'])? $_REQUEST['table_name_export'] :'';
		
		$content = file_get_contents(base_url().'assets/download/tab_xls.php');
		
		$content = $this->bodyReport($content,$table);
		//echo "<pre>";print_r($content);exit; 
		header ( "Expires: Mon, 1 Apr 1974 05:00:00 GMT");
		header ( "Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT" );
		header ( "Pragma: no-cache" );
		header ( "Content-type: application/msexcel");
		header ( "Content-Disposition: inline; filename=\"{$table}_".date("dmYhi").".xls\"");
		print($content);
		die();
	}
	function bodyReport($content,$tab_name){
		$tab = $this->table->get_tab($tab_name);	
		$table_sys = isset($tab["table_name"]) ? $tab["table_name"] : $tab_name;
		$headers = $this->table->gets_headers($tab['table_name'],$tab['query']);
		
		
		$this->load->dbutil();
		$arrBody = $this->dbutil->PartitionString('<!--s_heading-->', '<!--e_heading-->', $content);
		$rowInfo = '';
        foreach ($headers as $item) {
			$rowInfo .=$arrBody[1];
			$rowInfo = str_replace('{width}', $item['width'], $rowInfo);
			$rowInfo = str_replace('{align}', $item['align'], $rowInfo);
			$rowInfo = str_replace('{title}', $item['label'], $rowInfo);
		}
		$content = $arrBody[0].$rowInfo.$arrBody[2];
		
		$where = "where 1=1";
		foreach ($headers as $item) {
			$aColumns[] = $item['name'];
		}
        
		$sTable = $table_sys; 
		
		// $order_by = (($tab['order']!='') && (!is_null($tab['order'])))?('order by '.$tab['order']):'';
		 
		if(is_null($tab['limit_export'])){
        	$sql = "(SELECT idx_ref_rt.idx_bbs, idx_ref_rt.ims_order, idx_ref_rt.idx_code, idx_ref_rt.idx_name_sn as idx_name
			
			,idx_specs_rt.date, idx_specs_rt.time, idx_specs_rt.idx_divisor, idx_specs_rt.idx_mcap, idx_specs_rt.idx_dcap, idx_specs_rt.idx_last, idx_specs_rt.idx_var, idx_specs_rt.idx_dvar, idx_specs_rt.idx_change,idx_specs_rt.idx_dchange, idx_specs_rt.provider, idx_specs_rt.type FROM idx_ref_rt
            LEFT JOIN idx_specs_rt
            ON idx_ref_rt.idx_code = idx_specs_rt.idx_code
			
            WHERE idx_ref_rt.calculs = 1
            AND idx_ref_rt.mother = 1 and idx_ref_rt.realtime=1)";
		}	
		else {
			
		//$arrlimit = explode(";",$tab['limit_export']);
		//$limit = isset($arrlimit[$level]) ? $arrlimit[$level] :10;
		/*$sql = "select sql_calc_found_rows " . str_replace(' , ', ' ', implode(', ', $aColumns)) . "
                from {$sTable} {$where} {$order_by} limit {$limit};";*/
		$sql = "(SELECT idx_ref_rt.idx_bbs, idx_ref_rt.ims_order, idx_ref_rt.idx_code, idx_ref_rt.idx_name_sn as idx_name
			
			,idx_specs_rt.date, idx_specs_rt.time, idx_specs_rt.idx_divisor, idx_specs_rt.idx_mcap, idx_specs_rt.idx_dcap, idx_specs_rt.idx_last, idx_specs_rt.idx_var, idx_specs_rt.idx_dvar, idx_specs_rt.idx_change,idx_specs_rt.idx_dchange, idx_specs_rt.provider, idx_specs_rt.type FROM idx_ref_rt
            LEFT JOIN idx_specs_rt
            ON idx_ref_rt.idx_code = idx_specs_rt.idx_code
			
            WHERE idx_ref_rt.calculs = 1
            AND idx_ref_rt.mother = 1 and idx_ref_rt.realtime=1)";
		}
        $data = $this->db->query($sql)->result_array();
		
		
		$arrBody = $this->dbutil->PartitionString('<!--s_body-->', '<!--e_body-->', $content);
		$rowInfo = '';
		$i= 0;
		foreach ($data as $key => $value) {
			$rowInfo .='<tr>';
            foreach($headers as $item) {
               
				$rowInfo .=$arrBody[1];
				if ($i % 2) 
				$rowInfo = str_replace('{color}', '#f7f7f7', $rowInfo);
				else
				$rowInfo = str_replace('{color}', '#fffff', $rowInfo);
				
				$rowInfo = str_replace('{body}', '<div'.$item['align'].'>'.$value[strtolower($item['name'])].'</div>', $rowInfo);
				$i ++;
            }
			$rowInfo .='</tr>';
        }
		$content = $arrBody[0].$rowInfo.$arrBody[2];
		//echo "<pre>";print_r($content);exit; 
		return $content;
	}
	
	public function getSelected(){
		$name = $_POST['name'];
		$table =  "(SELECT idx_ref_rt.idx_bbs, idx_ref_rt.ims_order, idx_ref_rt.idx_code, idx_ref_rt.idx_name_sn as idx_name
			
			,idx_specs_rt.date, idx_specs_rt.time, idx_specs_rt.idx_divisor, idx_specs_rt.idx_mcap, idx_specs_rt.idx_dcap, idx_specs_rt.idx_last, idx_specs_rt.idx_var, idx_specs_rt.idx_dvar, idx_specs_rt.idx_change, idx_specs_rt.provider, idx_specs_rt.type FROM idx_ref_rt
            LEFT JOIN idx_specs_rt
            ON idx_ref_rt.idx_code = idx_specs_rt.idx_code
			
            WHERE idx_ref_rt.calculs = 1
            AND idx_ref_rt.mother = 1 and idx_ref_rt.realtime=1) A ";
		
		$this->db->select($name);
		$this->db->distinct();
		$query = $this->db->get($table);
		$data = $query->result_array();
		$result='';
		
		foreach($data as $k=>$v){
			if($v[$name] == ''){
				unset($data[$k]);
			}else{
				$result.= $v[$name].":".$v[$name].";";
			}
			
		}
		echo json_encode($result);
	}
 
}
