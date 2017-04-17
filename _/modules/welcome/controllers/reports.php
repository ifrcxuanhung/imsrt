<?php
class Reports extends Welcome{

    public function __construct() {
        parent::__construct();
		$this->load->database();
		$this->load->model('Jq_hierarchy_model', 'table');
    }
 
    public function index($tables){
		
        if($tables == 'summary'){
            $tables = 'efrc_'.$tables;
        }
		// export theo tung dinh dang file
		if(isset($_REQUEST['actexport'])&&($_REQUEST['actexport']=='exportCsv'||$_REQUEST['actexport']=='exportTxt')){
			$this->export();
		}
		else if(isset($_REQUEST['actexport'])&&($_REQUEST['actexport']=='exportXls')){
			$this->exportXls();
		}
		//end export theo tung dinh dang file
		$table_two = "idx_composition_rt";
		$this->data->table = $tables;
		$this->data->table2 = $table_two;
		
		$this->load->model('Jq_hierarchy_model');
		/* $this->data->column = str_replace('}]','}',str_replace('[{"','{',str_replace(',"',',',str_replace('":',':',json_encode($this->Jq_hierarchy_model->js_sys_format($tables))))));*/
		$column = $this->Jq_hierarchy_model->js_sys_format($tables);
		$column2 = $this->Jq_hierarchy_model->js_sys_format2($table_two);
		
		$column_child = $this->Jq_hierarchy_model->js_sys_format("idx_composition_child_rt");
		
		foreach($column as $k=>$val_column){
			if($val_column['searchoptions'] == 'select'){
				$column[$k]['stype'] = "select";
				//get select
				$this->db->select($val_column['name']);
				$this->db->distinct();
				$this->db->order_by($val_column['name'],"ASC");
			
				$query = $this->db->get($val_column['tables']);
				$data = $query->result_array();
				$result='';
				
				foreach($data as $key=>$v){
					if($v[$val_column['name']] == ''){
						unset($data[$key]);
					}else{
						
						$result.= $v[$val_column['name']].":".$v[$val_column['name']].";";
						
					}
					
				}
			//echo "<pre>";print_r($result);exit;
				$column[$k]['selectlist'] = json_encode($result);
				//end get select
				
			}
			if($val_column['hidden'] == 'false'){
				unset($column[$k]['hidden']);	
			}
			$column[$k]['headertitles'] = '';
			$column[$k]['format_notedit']='';
			$column[$k]['editable']='false';
			$column[$k]['cellattr'] = "" ;
			
			
			
		}
		
		
		foreach($column_child as $k_child=>$val_column_child){
			if($val_column_child['searchoptions'] == 'select'){
				$column_child[$k_child]['stype'] = "select";
				//get select
				$this->db->select($val_column_child['name']);
				$this->db->distinct();
				$this->db->order_by($val_column_child['name'],"ASC");
			
				$query_child = $this->db->get($val_column_child['tables']);
				$data_child = $query_child->result_array();
				$result_child='';
				
				foreach($data_child as $key_child=>$v_child){
					if($v_child[$val_column_child['name']] == ''){
						unset($data_child[$key_child]);
					}else{
						
						$result_child.= $v_child[$val_column_child['name']].":".$v_child[$val_column_child['name']].";";
						
					}
					
				}
			//echo "<pre>";print_r($result);exit;
				$column_child[$k_child]['selectlist'] = json_encode($result_child);
				//end get select
				
			}
			if($val_column_child['hidden'] == 'false'){
				unset($column_child[$k_child]['hidden']);	
			}
			$column_child[$k_child]['headertitles'] = '';
			$column_child[$k_child]['format_notedit']='';
			$column_child[$k_child]['editable']='false';
			$column_child[$k_child]['cellattr'] = "" ;
			
			
			
		}
		
		
		foreach($column2 as $k2=>$val_column2){
			if($val_column2['searchoptions'] == 'select'){
				$column2[$k2]['stype'] = "select";	
				//get select
				$this->db->select($val_column2['name']);
				$this->db->distinct();
				$this->db->order_by($val_column2['name'],"ASC");
			
				$query2 = $this->db->get($val_column2['tables']);
				$data2 = $query2->result_array();
				$result2='';
				
				foreach($data2 as $key2=>$v2){
					if($v2[$val_column2['name']] == ''){
						unset($data2[$key2]);
					}else{
						$result2.= $v2[$val_column2['name']].":".$v2[$val_column2['name']].";";
					}
					
				}
				$column2[$k2]['selectlist'] = json_encode($result2);
				//end get select
			}
			if($val_column2['hidden'] == 'false'){
				unset($column2[$k2]['hidden']);	
			}
			$column2[$k2]['headertitles'] = "";	
			$column2[$k2]['format_notedit']='';
			$column2[$k2]['editable']='false';
			$column2[$k2]['cellattr'] = "" ;
		}
		
		 $this->data->column =json_encode($column);
		 $this->data->column_child =json_encode($column_child);
		  $this->data->column2 =json_encode($column2);
		  
		 
		 
		 
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
		//echo "<pre>";print_r($this->data->filter_all);exit;
		$this->data->summary_des = $this->Jq_hierarchy_model->get_summary_des($tables);
		$this->data->summary_des2 = $this->Jq_hierarchy_model->get_summary_des($table_two);
		
		
		
		$this->template->write_view('content', 'Jq_hierarchy',$this->data);
		$this->template->render();

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
			$sql = "select sql_calc_found_rows " . str_replace(' , ', ' ', implode(', ', $aColumns)) . "
    					from {$sTable} {$where};"; 
						
			
		}
		else {
			
			//$level = 0;
		//$arrlimit = explode(";",$arr_table_sys['limit_export']);
		//$limit = isset($arrlimit[$level]) ? $arrlimit[$level] :10;
		/*$sql = "select sql_calc_found_rows " . str_replace(' , ', ' ', implode(', ', $aColumns)) . "
                from {$sTable} {$where} {$order_by} limit {$limit};";*/
		$sql = "select sql_calc_found_rows " . str_replace(' , ', ' ', implode(', ', $aColumns)) . "
                from {$sTable} {$where};";
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
        	$sql = "select sql_calc_found_rows " . str_replace(' , ', ' ', implode(', ', $aColumns)) . "
                from {$sTable} {$where};";
		}	
		else {
			
		//$arrlimit = explode(";",$tab['limit_export']);
		//$limit = isset($arrlimit[$level]) ? $arrlimit[$level] :10;
		/*$sql = "select sql_calc_found_rows " . str_replace(' , ', ' ', implode(', ', $aColumns)) . "
                from {$sTable} {$where} {$order_by} limit {$limit};";*/
		$sql = "select sql_calc_found_rows " . str_replace(' , ', ' ', implode(', ', $aColumns)) . "
                from {$sTable} {$where};";
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
		return $content;
	}
 
}
