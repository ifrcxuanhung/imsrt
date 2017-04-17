<?php
class Jq_loadtable extends Welcome{

    public function __construct() {
        parent::__construct();
		$this->load->database();
		$this->load->model('Jq_loadtable_model', 'table');
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
		
		$this->data->table = $tables;
		$this->load->model('jq_loadtable_model');
		/* $this->data->column = str_replace('}]','}',str_replace('[{"','{',str_replace(',"',',',str_replace('":',':',json_encode($this->jq_loadtable_model->js_sys_format($tables))))));*/
		$column = $this->jq_loadtable_model->js_sys_format($tables);
		
		foreach($column as $k=>$val_column){
			if($val_column['searchoptions'] == 'select'){
				$column[$k]['stype'] = "select";
				//get select
				$this->db->select($val_column['name']);
				$this->db->distinct();
				$this->db->order_by($val_column['name'],"ASC");
			
				$query = $this->db->get($val_column['tables']);
				$data = $query->result_array();
				//$this->db->last_query(); show sql active_recode
				
				
				//select update
				$result_update='';
				
				foreach($data as $key=>$v){
					$result_update.= $v[$val_column['name']].":".$v[$val_column['name']].";";
				}
				
				//select list
				$result='';
				
				foreach($data as $key=>$v){
					if($v[$val_column['name']] == ''){
						unset($data[$key]);
					}else{
						
						$result.= $v[$val_column['name']].":".$v[$val_column['name']].";";
						
					}
					
				}
				// 
			//echo "<pre>";print_r($result);exit;
				$column[$k]['selectlist'] = json_encode($result);
				$column[$k]['selectupdate'] = json_encode($result_update);
				//echo "<pre>";print_r($column[$k]['selectupdate']);exit;	
				//end get select
			}
			if($val_column['hidden'] == 'false'){
				unset($column[$k]['hidden']);	
			}
			$column[$k]['headertitles'] = '';
			$column[$k]['format_notedit']='';
			$column[$k]['editable']='false';
			$column[$k]['cellattr'] = "" ;
			
			/*if(isset($column[$k]['selectlist'])){
				if($column[$k]['formatter'] == 'time'){
					$dropstring = str_replace('"','',$column[$k]['selectlist']);
					$ex = explode(";",$dropstring);	
					$arr_time='"';
					foreach($ex as $value_time){
						echo strpos($value_time,":")."<br>";
						$arr_time .= str_replace(":","-",$value_time).";";
				
					}
					$arr_time .='"';
					$column[$k]['selectlist'] = $arr_time;
				}
			}*/
		
			
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
		//echo "<pre>";print_r($this->data->filter_all);exit;
		$this->data->summary_des = $this->jq_loadtable_model->get_summary_des($tables);
		
		
		
		$this->template->write_view('content', 'jq_loadtable',$this->data);
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
			$aColumns[] = '`'.$item['name'].'`';
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
			$aColumns[] = '`'.$item['name'].'`';
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
