<?php

class Jq_stockpage extends Welcome{

    public function __construct() {
        parent::__construct();
		$this->load->database();
		$this->load->model('Jq_stockpage_model', 'table');
    }
 
    public function index($stock_code){
	
		$table_one = "stk_feed_intraday";
		$table_two = "idx_composition_rt";
		$table_three = "stk_div_rt";
		$table_four = "idx_ca_rt";
		$table_five = "stk_feed_histoday";
		// export theo tung dinh dang file
		if(isset($_REQUEST['actexport2'])&&($_REQUEST['actexport2']=='exportCsv2'||$_REQUEST['actexport2']=='exportTxt2')){
			$this->export2();
			exit;
		}
		else if(isset($_REQUEST['actexport2'])&&($_REQUEST['actexport2']=='exportXls2')){
			$this->exportXls2();
			exit;
		}
		
		if(isset($_REQUEST['actexport1'])&&($_REQUEST['actexport1']=='exportCsv1'||$_REQUEST['actexport1']=='exportTxt1')){
			$this->export1();
			exit;
		}
		else if(isset($_REQUEST['actexport1'])&&($_REQUEST['actexport1']=='exportXls1')){
			$this->exportXls1();
			exit;
		}
		
		if(isset($_REQUEST['actexport3'])&&($_REQUEST['actexport3']=='exportCsv3'||$_REQUEST['actexport3']=='exportTxt3')){
			$this->export3();
			exit;
		}
		else if(isset($_REQUEST['actexport3'])&&($_REQUEST['actexport3']=='exportXls3')){
			$this->exportXls3();
			exit;
		}
		
		if(isset($_REQUEST['actexport4'])&&($_REQUEST['actexport4']=='exportCsv4'||$_REQUEST['actexport4']=='exportTxt4')){
			$this->export4();
			exit;
		}
		else if(isset($_REQUEST['actexport4'])&&($_REQUEST['actexport4']=='exportXls4')){
			$this->exportXls4();
			exit;
		}
		
		if(isset($_REQUEST['actexport5'])&&($_REQUEST['actexport5']=='exportCsv5'||$_REQUEST['actexport5']=='exportTxt5')){
			$this->export5();
			exit;
		}
		else if(isset($_REQUEST['actexport5'])&&($_REQUEST['actexport5']=='exportXls5')){
			$this->exportXls5();
			exit;
		}
		//end export theo tung dinh dang file
		
		$this->data->table1 = $table_one;
		$this->data->table2 = $table_two;
		$this->data->table3 = $table_three;
		$this->data->table4 = $table_four;
		$this->data->table5 = $table_five;
		 $this->load->model('jq_stockpage_model');
		/* $this->data->column = str_replace('}]','}',str_replace('[{"','{',str_replace(',"',',',str_replace('":',':',json_encode($this->jq_loadtable_model->js_sys_format($tables))))));*/
		$column1 = $this->jq_stockpage_model->js_sys_format($table_one);
		$column2 = $this->jq_stockpage_model->js_sys_format($table_two);
		$column3 = $this->jq_stockpage_model->js_sys_format($table_three);
		$column4 = $this->jq_stockpage_model->js_sys_format($table_four);
		$column5 = $this->jq_stockpage_model->js_sys_format($table_five);
		
		foreach($column1 as $k1=>$val_column1){
			if($val_column1['searchoptions'] == 'select'){
				$column1[$k1]['stype'] = "select";	
				//get select
				$this->db->select($val_column1['name']);
				$this->db->distinct();
				$this->db->order_by($val_column1['name'],"ASC");
			
				$query1 = $this->db->get($val_column1['tables']);
				$data1 = $query1->result_array();
				$result1='';
				
				foreach($data1 as $key1=>$v1){
					if($v1[$val_column1['name']] == ''){
						unset($data1[$key1]);
					}else{
						$result1.= $v1[$val_column1['name']].":".$v1[$val_column1['name']].";";
					}
					
				}
				$column1[$k1]['selectlist'] = json_encode($result1);
				//end get select
			}
			if($val_column1['hidden'] == 'false'){
				unset($column1[$k1]['hidden']);	
			}
			$column1[$k1]['headertitles'] = "";
			$column1[$k1]['format_notedit']='';
			$column1[$k1]['editable']='false';
			$column1[$k1]['cellattr'] = "" ;
			
			
			
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
		foreach($column3 as $k3=>$val_column3){
			if($val_column3['searchoptions'] == 'select'){
				$column3[$k3]['stype'] = "select";
				//get select
				$this->db->select($val_column3['name']);
				$this->db->distinct();
				$this->db->order_by($val_column3['name'],"ASC");
			
				$query3 = $this->db->get($val_column3['tables']);
				$data3 = $query3->result_array();
				$result3='';
				
				foreach($data3 as $key3=>$v3){
					if($v3[$val_column3['name']] == ''){
						unset($data3[$key3]);
					}else{
						$result3.= $v3[$val_column3['name']].":".$v3[$val_column3['name']].";";
					}
					
				}
				$column3[$k3]['selectlist'] = json_encode($result3);
				//end get select	
			}
			if($val_column3['hidden'] == 'false'){
				unset($column3[$k3]['hidden']);	
			}
			$column3[$k3]['headertitles'] = "";
			$column3[$k3]['format_notedit']='';
			$column3[$k3]['editable']='false';
			$column3[$k3]['cellattr'] = "" ;
		}
		
		foreach($column4 as $k4=>$val_column4){
			if($val_column4['searchoptions'] == 'select'){
				$column4[$k4]['stype'] = "select";
				//get select
				$this->db->select($val_column4['name']);
				$this->db->distinct();
				$this->db->order_by($val_column4['name'],"ASC");
			
				$query4 = $this->db->get($val_column4['tables']);
				$data4 = $query4->result_array();
				$result4='';
				
				foreach($data4 as $key4=>$v4){
					if($v4[$val_column4['name']] == ''){
						unset($data4[$key4]);
					}else{
						$result4.= $v4[$val_column4['name']].":".$v4[$val_column4['name']].";";
					}
					
				}
				$column4[$k4]['selectlist'] = json_encode($result4);
				//end get select	
			}
			if($val_column4['hidden'] == 'false'){
				unset($column4[$k4]['hidden']);	
			}
			$column4[$k4]['headertitles'] = "";
			$column4[$k4]['format_notedit']='';
			$column4[$k4]['editable']='false';
			$column4[$k4]['cellattr'] = "" ;
		}
		
		foreach($column5 as $k5=>$val_column5){
			if($val_column5['searchoptions'] == 'select'){
				$column5[$k5]['stype'] = "select";
				//get select
				$this->db->select($val_column5['name']);
				$this->db->distinct();
				$this->db->order_by($val_column5['name'],"ASC");
			
				$query5 = $this->db->get($val_column5['tables']);
				$data5 = $query5->result_array();
				$result5='';
				
				foreach($data5 as $key5=>$v5){
					if($v5[$val_column5['name']] == ''){
						unset($data5[$key5]);
					}else{
						$result5.= $v5[$val_column5['name']].":".$v5[$val_column5['name']].";";
					}
					
				}
				$column5[$k5]['selectlist'] = json_encode($result5);
				//end get select	
			}
			if($val_column5['hidden'] == 'false'){
				unset($column5[$k5]['hidden']);	
			}
			$column5[$k5]['headertitles'] = "";
			$column5[$k5]['format_notedit']='';
			$column5[$k5]['editable']='false';
			$column5[$k5]['cellattr'] = "" ;
		}
		//echo "<pre>";print_r($column5);exit;
		 $this->data->column1 =json_encode($column1);
		 $this->data->column2 =json_encode($column2);
		 $this->data->column3 =json_encode($column3);
		 $this->data->column4 =json_encode($column4);
		 $this->data->column5 =json_encode($column5);
		 
		 // get list neu searchoptions =1 

		$this->data->filter_get_all = $stock_code;
		
		//$this->data->codeint = json_encode($this->db->select('codeint')->where('idx_code',$stock_code)
         //->get('idx_composition_rt')->result_array());
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
		$this->data->summary_des1 = $this->jq_stockpage_model->get_summary_des($table_one);
		$this->data->summary_des2 = $this->jq_stockpage_model->get_summary_des($table_two);
		$this->data->summary_des3 = $this->jq_stockpage_model->get_summary_des($table_three);
		$this->data->summary_des4 = $this->jq_stockpage_model->get_summary_des($table_four);
		$this->data->summary_des5 = $this->jq_stockpage_model->get_summary_des($table_five);
		
		
		$this->template->write_view('content', 'jq_stockpage',$this->data);
		$this->template->render();

    }
	
	
	function export2() {
		$table = isset($_REQUEST['table_name_export2'])? $_REQUEST['table_name_export2'] :'';
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
		if(isset($_REQUEST['actexport2'])&&($_REQUEST['actexport2']=='exportCsv2')){
		$this->dbutil->export_to_csv("{$table_sys}", $query, $aColumnsHeader, null,",", true);
		}
		else if(isset($_REQUEST['actexport2'])&&($_REQUEST['actexport2']=='exportTxt2')){
			
		$this->dbutil->export_to_txt("{$table_sys}", $query, $aColumnsHeader, null,chr(9), true);
		}		
		die();
		
    }
	public function exportXls2(){
		$table = isset($_REQUEST['table_name_export2'])? $_REQUEST['table_name_export2'] :'';
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
	
	
	function export1() {
		$table = isset($_REQUEST['table_name_export1'])? $_REQUEST['table_name_export1'] :'';
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
		if(isset($_REQUEST['actexport1'])&&($_REQUEST['actexport1']=='exportCsv1')){
		$this->dbutil->export_to_csv("{$table_sys}", $query, $aColumnsHeader, null,",", true);
		}
		else if(isset($_REQUEST['actexport1'])&&($_REQUEST['actexport1']=='exportTxt1')){
			
		$this->dbutil->export_to_txt("{$table_sys}", $query, $aColumnsHeader, null,chr(9), true);
		}		
		die();
		
    }
	public function exportXls1(){
		$table = isset($_REQUEST['table_name_export1'])? $_REQUEST['table_name_export1'] :'';
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
	
	
	function export3() {
		$table = isset($_REQUEST['table_name_export3'])? $_REQUEST['table_name_export3'] :'';
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
		if(isset($_REQUEST['actexport3'])&&($_REQUEST['actexport3']=='exportCsv3')){
		$this->dbutil->export_to_csv("{$table_sys}", $query, $aColumnsHeader, null,",", true);
		}
		else if(isset($_REQUEST['actexport3'])&&($_REQUEST['actexport3']=='exportTxt3')){
			
		$this->dbutil->export_to_txt("{$table_sys}", $query, $aColumnsHeader, null,chr(9), true);
		}		
		die();
		
    }
	public function exportXls3(){
		$table = isset($_REQUEST['table_name_export3'])? $_REQUEST['table_name_export3'] :'';
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
	
	function export4() {
		$table = isset($_REQUEST['table_name_export4'])? $_REQUEST['table_name_export4'] :'';
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
		if(isset($_REQUEST['actexport4'])&&($_REQUEST['actexport4']=='exportCsv4')){
		$this->dbutil->export_to_csv("{$table_sys}", $query, $aColumnsHeader, null,",", true);
		}
		else if(isset($_REQUEST['actexport4'])&&($_REQUEST['actexport4']=='exportTxt4')){
			
		$this->dbutil->export_to_txt("{$table_sys}", $query, $aColumnsHeader, null,chr(9), true);
		}		
		die();
		
    }
	public function exportXls4(){
		$table = isset($_REQUEST['table_name_export4'])? $_REQUEST['table_name_export4'] :'';
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
	
	
	function export5() {
		$table = isset($_REQUEST['table_name_export5'])? $_REQUEST['table_name_export5'] :'';
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
		if(isset($_REQUEST['actexport5'])&&($_REQUEST['actexport5']=='exportCsv5')){
		$this->dbutil->export_to_csv("{$table_sys}", $query, $aColumnsHeader, null,",", true);
		}
		else if(isset($_REQUEST['actexport5'])&&($_REQUEST['actexport5']=='exportTxt5')){
			
		$this->dbutil->export_to_txt("{$table_sys}", $query, $aColumnsHeader, null,chr(9), true);
		}		
		die();
		
    }
	public function exportXls5(){
		$table = isset($_REQUEST['table_name_export5'])? $_REQUEST['table_name_export5'] :'';
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
