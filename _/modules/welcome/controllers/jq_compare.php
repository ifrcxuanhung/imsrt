<?php
class Jq_compare extends Welcome{

    public function __construct() {
        parent::__construct();
		$this->load->database();
		$this->db3 = $this->load->database('database3', TRUE);//connect local
		$this->load->model('Jq_compare_model', 'table');
    }
 
    public function index(){
		set_time_limit(300);
		$tables = "jq_compare_composition";
		$tables2 = "jq_compare_specs";
		$table_three = "top_composition";
		$table_four = "top_specs";
		$sql_truncate = "truncate idx_composition_temp_local;";
		$this->db->query($sql_truncate);
		$sql_truncate2 = "truncate idx_specs_temp_local;";
		$this->db->query($sql_truncate2);
		$sql_drop1 = "DROP TABLE IF EXISTS idx_composition_compare_close;";
		$this->db->query($sql_drop1);
		$sql_drop2 = "DROP TABLE IF EXISTS idx_specs_compare_close;";
		$this->db->query($sql_drop2);
		$sql =' Select * from setting_rt where `key` in ("max_diff_shares","max_diff_mcap","max_diff_dcap","max_diff_price","max_diff_divisor","max_diff_last","max_diff_pclose","max_diff_conv") ';
		$arr_key = $this->db->query($sql)->result_array();
		$keys = array();
		foreach($arr_key as $item){
			$keys[$item["key"]] = $item["value"];
		}		
		// export theo tung dinh dang file
		if(isset($_REQUEST['actexport'])&&($_REQUEST['actexport']=='exportCsv'||$_REQUEST['actexport']=='exportTxt')){
			$this->export();
			
		}
		else if(isset($_REQUEST['actexport'])&&($_REQUEST['actexport']=='exportXls')){
			$this->exportXls();
		}
		
		
		if(isset($_REQUEST['actexport2'])&&($_REQUEST['actexport2']=='exportCsv2'||$_REQUEST['actexport2']=='exportTxt2')){
			$this->export2();
			exit;
		}
		else if(isset($_REQUEST['actexport2'])&&($_REQUEST['actexport2']=='exportXls2')){
			$this->exportXls2();
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
		
		//end export theo tung dinh dang file
		
		$this->data->table = $tables;
		$this->data->table2 = $tables2;
		$this->data->table3 = $table_three;
		$this->data->table4 = $table_four;
		$this->load->model('Jq_compare_model');
		/* $this->data->column = str_replace('}]','}',str_replace('[{"','{',str_replace(',"',',',str_replace('":',':',json_encode($this->Jq_compare_model->js_sys_format($tables))))));*/
		$column = $this->Jq_compare_model->js_sys_format($tables);
		$column2 = $this->Jq_compare_model->js_sys_format($tables2);
		$column3 = $this->Jq_compare_model->js_sys_format($table_three);
		$column4 = $this->Jq_compare_model->js_sys_format($table_four);
		$composition_database_other = $this->db3->select("idx_code,stk_code,stk_shares_idx,stk_mcap_idx,stk_dcap_idx,stk_price")->get("idx_composition")->result_array();
		
		$specs_database_other = $this->db3->select("idx_code,idx_divisor,idx_mcap,idx_last,idx_dcap,idx_pclose,idx_conv")->get("idx_specs")->result_array();
		
		$this->db->insert_batch('idx_composition_temp_local', $composition_database_other);
		$this->db->insert_batch('idx_specs_temp_local', $specs_database_other);
		
		$table_common ="create table idx_composition_compare_close (SELECT a.idx_code,a.stk_code, a.stk_shares_idx, b.stk_shares_idx as stk_shares_idx_rt, ABS(a.stk_shares_idx - b.stk_shares_idx) as diff1,(CASE 
         WHEN ABS(a.stk_shares_idx - b.stk_shares_idx) <= ".$keys["max_diff_shares"]." THEN 0
         ELSE 1
      END) AS stt1, a.stk_mcap_idx, b.stk_mcap_idx as stk_mcap_idx_rt, ABS(a.stk_mcap_idx - b.stk_mcap_idx) as diff2,(CASE 
         WHEN ABS(a.stk_mcap_idx - b.stk_mcap_idx) <= ".$keys["max_diff_mcap"]." THEN 0
         ELSE 1
      END) AS stt2, a.stk_dcap_idx, b.stk_dcap_idx as stk_dcap_idx_rt,  ABS(a.stk_dcap_idx - b.stk_dcap_idx) as diff3,(CASE 
         WHEN ABS(a.stk_dcap_idx - b.stk_dcap_idx) <= ".$keys["max_diff_dcap"]." THEN 0
         ELSE 1
      END) AS stt3, a.stk_price,b.stk_price as stk_price_rt , ABS(a.stk_price - b.stk_price) as diff4,(CASE 
         WHEN ABS(a.stk_price - b.stk_price) <= ".$keys["max_diff_price"]." THEN 0
         ELSE 1
      END) AS stt4, a.date FROM idx_composition_temp_local as a INNER JOIN idx_composition_rt as b ON a.idx_code=b.idx_code and a.stk_code=b.stk_code); ";
	  $this->db->query($table_common);
	  //echo "<pre>";print_r($table_common);exit;
	  
	  
	 /* $table_common ="(SELECT a.idx_code,a.stk_code, a.stk_shares_idx, b.stk_shares_idx as stk_shares_idx_ims, ABS(a.stk_shares_idx - b.stk_shares_idx) as diff1,(CASE 
         WHEN (a.stk_shares_idx - b.stk_shares_idx) = 0 THEN 0
         ELSE 1
      END) AS stt1, a.stk_mcap_idx, b.stk_mcap_idx as stk_mcap_idx_ims, ABS(a.stk_mcap_idx - b.stk_mcap_idx) as diff2,(CASE 
         WHEN (a.stk_mcap_idx - b.stk_mcap_idx) = 0 THEN 0
         ELSE 1
      END) AS stt2, a.stk_dcap_idx, b.stk_dcap_idx as stk_dcap_idx_ims,  ABS(a.stk_dcap_idx - b.stk_dcap_idx) as diff3,(CASE 
         WHEN (a.stk_dcap_idx - b.stk_dcap_idx) = 0 THEN 0
         ELSE 1
      END) AS stt3, a.stk_price,b.stk_price as stk_price_ims , ABS(a.stk_price - b.stk_price) as diff4,(CASE 
         WHEN (a.stk_price - b.stk_price) = 0 THEN 0
         ELSE 1
      END) AS stt4, a.date FROM idx_composition_temp_local as a INNER JOIN idx_composition_rt as b ON a.idx_code=b.idx_code and a.stk_code=b.stk_code) A";*/
	  
	  $table_common2 ="create table idx_specs_compare_close (SELECT a.idx_code, a.date, a.idx_divisor, b.idx_divisor as idx_divisor_rt, ABS(a.idx_divisor - b.idx_divisor) as diff1,(CASE 
         WHEN ABS(a.idx_divisor - b.idx_divisor) <= ".$keys["max_diff_divisor"]." THEN 0
         ELSE 1
      END) AS stt1, a.idx_mcap, b.idx_mcap as idx_mcap_rt, ABS(a.idx_mcap - b.idx_mcap) as diff2,(CASE 
         WHEN ABS(a.idx_mcap - b.idx_mcap) <= ".$keys["max_diff_mcap"]." THEN 0
         ELSE 1
      END) AS stt2, a.idx_last, b.idx_last as idx_last_rt, ABS(a.idx_last - b.idx_last) as diff3,(CASE 
         WHEN ABS(a.idx_last - b.idx_last) <= ".$keys["max_diff_last"]." THEN 0
         ELSE 1
      END) AS stt3, a.idx_dcap,b.idx_dcap as idx_dcap_rt , ABS(a.idx_dcap - b.idx_dcap) as diff4,(CASE 
         WHEN ABS(a.idx_dcap - b.idx_dcap) <= ".$keys["max_diff_dcap"]." THEN 0
         ELSE 1
      END) AS stt4, a.idx_pclose,b.idx_pclose as pclose_rt , ABS(a.idx_pclose - b.idx_pclose) as diff5,(CASE 
         WHEN ABS(a.idx_pclose - b.idx_pclose) <= ".$keys["max_diff_pclose"]." THEN 0
         ELSE 1
      END) AS stt5, a.idx_conv,b.idx_conv as idx_conv_rt , ABS(a.idx_conv - b.idx_conv) as diffconv,(CASE 
         WHEN ABS(a.idx_conv - b.idx_conv) <= ".$keys["max_diff_conv"]." THEN 0
         ELSE 1
      END) AS stt6 FROM idx_specs_temp_local as a INNER JOIN idx_specs_rt as b ON a.idx_code=b.idx_code ) ";
	  //print_r($table_common2);
	  $this->db->query($table_common2);
	   /*$table_common2 ="(SELECT a.idx_code, a.date, a.idx_divisor, b.idx_divisor as idx_divisor_ims, ABS(a.idx_divisor - b.idx_divisor) as diff1,(CASE 
         WHEN (a.idx_divisor - b.idx_divisor) = 0 THEN 0
         ELSE 1
      END) AS stt1, a.idx_mcap, b.idx_mcap as idx_mcap_ims, ABS(a.idx_mcap - b.idx_mcap) as diff2,(CASE 
         WHEN (a.idx_mcap - b.idx_mcap) = 0 THEN 0
         ELSE 1
      END) AS stt2, a.idx_last, b.idx_last as idx_last_ims,  ABS(a.idx_last - b.idx_last) as diff3,(CASE 
         WHEN (a.idx_last - b.idx_last) = 0 THEN 0
         ELSE 1
      END) AS stt3, a.idx_dcap,b.idx_dcap as idx_dcap_ims , ABS(a.idx_dcap - b.idx_dcap) as diff4,(CASE 
         WHEN (a.idx_dcap - b.idx_dcap) = 0 THEN 0
         ELSE 1
      END) AS stt4, a.idx_pclose,b.idx_pclose as pclose_ims , ABS(a.idx_pclose - b.idx_pclose) as diff5,(CASE 
         WHEN (a.idx_pclose - b.idx_pclose) = 0 THEN 0
         ELSE 1
      END) AS stt5 FROM idx_specs_temp_local as a INNER JOIN idx_specs_rt as b ON a.idx_code=b.idx_code ) A";*/
	  
	 
		
		foreach($column as $k=>$val_column){
			if($val_column['searchoptions'] == 'select'){
				
				$column[$k]['stype'] = "select";
				//get select
				$this->db->select($val_column['name']);
				$this->db->distinct();
				$this->db->order_by($val_column['name'],"ASC");
				
				$query = $this->db->get("idx_composition_compare_close");
				
				$data = $query->result_array();
				//var_export($query);exit;
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
		
		
		foreach($column2 as $k2=>$val_column2){
			if($val_column2['searchoptions'] == 'select'){
				
				$column2[$k2]['stype'] = "select";
				//get select
				$this->db->select($val_column2['name']);
				$this->db->distinct();
				$this->db->order_by($val_column2['name'],"ASC");
				
				$query2 = $this->db->get("idx_specs_compare_close");
				
				$data2 = $query2->result_array();
				//var_export($query);exit;
				$result2='';
				
				foreach($data2 as $key2=>$v2){
					if($v2[$val_column2['name']] == ''){
						unset($data2[$key2]);
					}else{
						
						$result2.= $v2[$val_column2['name']].":".$v2[$val_column2['name']].";";
						
					}
					
				}
			//echo "<pre>";print_r($result);exit;
				$column2[$k2]['selectlist'] = json_encode($result2);
				//end get select
				
			}
			if($val_column2['hidden'] == 'false'){
				unset($column2[$k2]['hidden']);	
			}
			$column2[$k2]['headertitles'] = '';
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
					if($v3[$val_column4['name']] == ''){
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
		
		 $this->data->column =json_encode($column);
		 $this->data->column2 =json_encode($column2);
		 $this->data->column3 =json_encode($column3);
		 $this->data->column4 =json_encode($column4);
		 
		 // get list neu searchoptions =1 

	
		
		if(isset($_GET))
			$this->data->filter_get_all = json_encode($_GET);
			
		$this->data->summary_des = $this->Jq_compare_model->get_summary_des($tables);
		$this->data->summary_des2 = $this->Jq_compare_model->get_summary_des($tables2);
		$this->data->summary_des3 = $this->Jq_compare_model->get_summary_des($table_three);
		$this->data->summary_des4 = $this->Jq_compare_model->get_summary_des($table_four);
		
		
		//count top composition
		//echo "<pre>";print_r($table_common2);exit; 
		
		$this->table->count_top_composition("idx_composition_compare_close");
		$this->table->count_top_specs("idx_specs_compare_close");
	
	 

		
		$this->template->write_view('content', 'jq_compare',$this->data);
		$this->template->render();

    }
	
	
	
	public function edit_del_add_jq_compare(){
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
			/*$sql = "select sql_calc_found_rows " . str_replace(' , ', ' ', implode(', ', $aColumns)) . "
    					from {$sTable} {$where};"; */
			$sql="(SELECT a.idx_code,a.stk_code, a.stk_shares_idx, b.stk_shares_idx as stk_shares_idx_ims, ABS(a.stk_shares_idx - b.stk_shares_idx) as diff1,(CASE 
         WHEN (a.stk_shares_idx - b.stk_shares_idx) = 0 THEN 0
         ELSE 1
      END) AS stt1, a.stk_mcap_idx, b.stk_mcap_idx as stk_mcap_idx_ims, ABS(a.stk_mcap_idx - b.stk_mcap_idx) as diff2,(CASE 
         WHEN (a.stk_mcap_idx - b.stk_mcap_idx) = 0 THEN 0
         ELSE 1
      END) AS stt2, a.stk_dcap_idx, b.stk_dcap_idx as stk_dcap_idx_ims,  ABS(a.stk_dcap_idx - b.stk_dcap_idx) as diff3,(CASE 
         WHEN (a.stk_dcap_idx - b.stk_dcap_idx) = 0 THEN 0
         ELSE 1
      END) AS stt3, a.stk_price,b.stk_price as stk_price_ims , ABS(a.stk_price - b.stk_price) as diff4,(CASE 
         WHEN (a.stk_price - b.stk_price) = 0 THEN 0
         ELSE 1
      END) AS stt4, a.date FROM idx_composition_temp_local as a INNER JOIN idx_composition_rt as b ON a.idx_code=b.idx_code and a.stk_code=b.stk_code)";
						
			
		}
		else {
			
			//$level = 0;
		//$arrlimit = explode(";",$arr_table_sys['limit_export']);
		//$limit = isset($arrlimit[$level]) ? $arrlimit[$level] :10;
		/*$sql = "select sql_calc_found_rows " . str_replace(' , ', ' ', implode(', ', $aColumns)) . "
                from {$sTable} {$where} {$order_by} limit {$limit};";*/
		/*$sql = "select sql_calc_found_rows " . str_replace(' , ', ' ', implode(', ', $aColumns)) . "
                from {$sTable} {$where};";*/
			$sql="(SELECT a.idx_code,a.stk_code, a.stk_shares_idx, b.stk_shares_idx as stk_shares_idx_ims, ABS(a.stk_shares_idx - b.stk_shares_idx) as diff1,(CASE 
         WHEN (a.stk_shares_idx - b.stk_shares_idx) = 0 THEN 0
         ELSE 1
      END) AS stt1, a.stk_mcap_idx, b.stk_mcap_idx as stk_mcap_idx_ims, ABS(a.stk_mcap_idx - b.stk_mcap_idx) as diff2,(CASE 
         WHEN (a.stk_mcap_idx - b.stk_mcap_idx) = 0 THEN 0
         ELSE 1
      END) AS stt2, a.stk_dcap_idx, b.stk_dcap_idx as stk_dcap_idx_ims,  ABS(a.stk_dcap_idx - b.stk_dcap_idx) as diff3,(CASE 
         WHEN (a.stk_dcap_idx - b.stk_dcap_idx) = 0 THEN 0
         ELSE 1
      END) AS stt3, a.stk_price,b.stk_price as stk_price_ims , ABS(a.stk_price - b.stk_price) as diff4,(CASE 
         WHEN (a.stk_price - b.stk_price) = 0 THEN 0
         ELSE 1
      END) AS stt4, a.date FROM idx_composition_temp_local as a INNER JOIN idx_composition_rt as b ON a.idx_code=b.idx_code and a.stk_code=b.stk_code)";
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
        	$sql="(SELECT a.idx_code,a.stk_code, a.stk_shares_idx, b.stk_shares_idx as stk_shares_idx_ims, ABS(a.stk_shares_idx - b.stk_shares_idx) as diff1,(CASE 
         WHEN (a.stk_shares_idx - b.stk_shares_idx) = 0 THEN 0
         ELSE 1
      END) AS stt1, a.stk_mcap_idx, b.stk_mcap_idx as stk_mcap_idx_ims, ABS(a.stk_mcap_idx - b.stk_mcap_idx) as diff2,(CASE 
         WHEN (a.stk_mcap_idx - b.stk_mcap_idx) = 0 THEN 0
         ELSE 1
      END) AS stt2, a.stk_dcap_idx, b.stk_dcap_idx as stk_dcap_idx_ims,  ABS(a.stk_dcap_idx - b.stk_dcap_idx) as diff3,(CASE 
         WHEN (a.stk_dcap_idx - b.stk_dcap_idx) = 0 THEN 0
         ELSE 1
      END) AS stt3, a.stk_price,b.stk_price as stk_price_ims , ABS(a.stk_price - b.stk_price) as diff4,(CASE 
         WHEN (a.stk_price - b.stk_price) = 0 THEN 0
         ELSE 1
      END) AS stt4, a.date FROM idx_composition_temp_local as a INNER JOIN idx_composition_rt as b ON a.idx_code=b.idx_code and a.stk_code=b.stk_code)";
		}	
		else {
			
		//$arrlimit = explode(";",$tab['limit_export']);
		//$limit = isset($arrlimit[$level]) ? $arrlimit[$level] :10;
		/*$sql = "select sql_calc_found_rows " . str_replace(' , ', ' ', implode(', ', $aColumns)) . "
                from {$sTable} {$where} {$order_by} limit {$limit};";*/
		$sql="(SELECT a.idx_code,a.stk_code, a.stk_shares_idx, b.stk_shares_idx as stk_shares_idx_ims, ABS(a.stk_shares_idx - b.stk_shares_idx) as diff1,(CASE 
         WHEN (a.stk_shares_idx - b.stk_shares_idx) = 0 THEN 0
         ELSE 1
      END) AS stt1, a.stk_mcap_idx, b.stk_mcap_idx as stk_mcap_idx_ims, ABS(a.stk_mcap_idx - b.stk_mcap_idx) as diff2,(CASE 
         WHEN (a.stk_mcap_idx - b.stk_mcap_idx) = 0 THEN 0
         ELSE 1
      END) AS stt2, a.stk_dcap_idx, b.stk_dcap_idx as stk_dcap_idx_ims,  ABS(a.stk_dcap_idx - b.stk_dcap_idx) as diff3,(CASE 
         WHEN (a.stk_dcap_idx - b.stk_dcap_idx) = 0 THEN 0
         ELSE 1
      END) AS stt3, a.stk_price,b.stk_price as stk_price_ims , ABS(a.stk_price - b.stk_price) as diff4,(CASE 
         WHEN (a.stk_price - b.stk_price) = 0 THEN 0
         ELSE 1
      END) AS stt4, a.date FROM idx_composition_temp_local as a INNER JOIN idx_composition_rt as b ON a.idx_code=b.idx_code and a.stk_code=b.stk_code)";
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
	
	
	function bodyReport2($content,$tab_name){
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
        	$sql="(SELECT a.idx_code, a.date, a.idx_divisor, b.idx_divisor as idx_divisor_ims, ABS(a.idx_divisor - b.idx_divisor) as diff1,(CASE 
         WHEN (a.idx_divisor - b.idx_divisor) = 0 THEN 0
         ELSE 1
      END) AS stt1, a.idx_mcap, b.idx_mcap as idx_mcap_ims, ABS(a.idx_mcap - b.idx_mcap) as diff2,(CASE 
         WHEN (a.idx_mcap - b.idx_mcap) = 0 THEN 0
         ELSE 1
      END) AS stt2, a.idx_last, b.idx_last as idx_last_ims,  ABS(a.idx_last - b.idx_last) as diff3,(CASE 
         WHEN (a.idx_last - b.idx_last) = 0 THEN 0
         ELSE 1
      END) AS stt3, a.idx_dcap,b.idx_dcap as idx_dcap_ims , ABS(a.idx_dcap - b.idx_dcap) as diff4,(CASE 
         WHEN (a.idx_dcap - b.idx_dcap) = 0 THEN 0
         ELSE 1
      END) AS stt4, a.idx_pclose,b.idx_pclose as pclose_ims , ABS(a.idx_pclose - b.idx_pclose) as diff5,(CASE 
         WHEN (a.idx_pclose - b.idx_pclose) = 0 THEN 0
         ELSE 1
      END) AS stt5 FROM idx_specs_temp_local as a INNER JOIN idx_specs_rt as b ON a.idx_code=b.idx_code )";
		}	
		else {
			
		//$arrlimit = explode(";",$tab['limit_export']);
		//$limit = isset($arrlimit[$level]) ? $arrlimit[$level] :10;
		/*$sql = "select sql_calc_found_rows " . str_replace(' , ', ' ', implode(', ', $aColumns)) . "
                from {$sTable} {$where} {$order_by} limit {$limit};";*/
		$sql="(SELECT a.idx_code, a.date, a.idx_divisor, b.idx_divisor as idx_divisor_ims, ABS(a.idx_divisor - b.idx_divisor) as diff1,(CASE 
         WHEN (a.idx_divisor - b.idx_divisor) = 0 THEN 0
         ELSE 1
      END) AS stt1, a.idx_mcap, b.idx_mcap as idx_mcap_ims, ABS(a.idx_mcap - b.idx_mcap) as diff2,(CASE 
         WHEN (a.idx_mcap - b.idx_mcap) = 0 THEN 0
         ELSE 1
      END) AS stt2, a.idx_last, b.idx_last as idx_last_ims,  ABS(a.idx_last - b.idx_last) as diff3,(CASE 
         WHEN (a.idx_last - b.idx_last) = 0 THEN 0
         ELSE 1
      END) AS stt3, a.idx_dcap,b.idx_dcap as idx_dcap_ims , ABS(a.idx_dcap - b.idx_dcap) as diff4,(CASE 
         WHEN (a.idx_dcap - b.idx_dcap) = 0 THEN 0
         ELSE 1
      END) AS stt4, a.idx_pclose,b.idx_pclose as pclose_ims , ABS(a.idx_pclose - b.idx_pclose) as diff5,(CASE 
         WHEN (a.idx_pclose - b.idx_pclose) = 0 THEN 0
         ELSE 1
      END) AS stt5 FROM idx_specs_temp_local as a INNER JOIN idx_specs_rt as b ON a.idx_code=b.idx_code )";
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
			$sql = "(SELECT a.idx_code, a.date, a.idx_divisor, b.idx_divisor as idx_divisor_ims, ABS(a.idx_divisor - b.idx_divisor) as diff1,(CASE 
         WHEN (a.idx_divisor - b.idx_divisor) = 0 THEN 0
         ELSE 1
      END) AS stt1, a.idx_mcap, b.idx_mcap as idx_mcap_ims, ABS(a.idx_mcap - b.idx_mcap) as diff2,(CASE 
         WHEN (a.idx_mcap - b.idx_mcap) = 0 THEN 0
         ELSE 1
      END) AS stt2, a.idx_last, b.idx_last as idx_last_ims,  ABS(a.idx_last - b.idx_last) as diff3,(CASE 
         WHEN (a.idx_last - b.idx_last) = 0 THEN 0
         ELSE 1
      END) AS stt3, a.idx_dcap,b.idx_dcap as idx_dcap_ims , ABS(a.idx_dcap - b.idx_dcap) as diff4,(CASE 
         WHEN (a.idx_dcap - b.idx_dcap) = 0 THEN 0
         ELSE 1
      END) AS stt4, a.idx_pclose,b.idx_pclose as pclose_ims , ABS(a.idx_pclose - b.idx_pclose) as diff5,(CASE 
         WHEN (a.idx_pclose - b.idx_pclose) = 0 THEN 0
         ELSE 1
      END) AS stt5 FROM idx_specs_temp_local as a INNER JOIN idx_specs_rt as b ON a.idx_code=b.idx_code )"; 
						
			
		}
		else {
			
			//$level = 0;
		//$arrlimit = explode(";",$arr_table_sys['limit_export']);
		//$limit = isset($arrlimit[$level]) ? $arrlimit[$level] :10;
		/*$sql = "select sql_calc_found_rows " . str_replace(' , ', ' ', implode(', ', $aColumns)) . "
                from {$sTable} {$where} {$order_by} limit {$limit};";*/
		$sql = "(SELECT a.idx_code, a.date, a.idx_divisor, b.idx_divisor as idx_divisor_ims, ABS(a.idx_divisor - b.idx_divisor) as diff1,(CASE 
         WHEN (a.idx_divisor - b.idx_divisor) = 0 THEN 0
         ELSE 1
      END) AS stt1, a.idx_mcap, b.idx_mcap as idx_mcap_ims, ABS(a.idx_mcap - b.idx_mcap) as diff2,(CASE 
         WHEN (a.idx_mcap - b.idx_mcap) = 0 THEN 0
         ELSE 1
      END) AS stt2, a.idx_last, b.idx_last as idx_last_ims,  ABS(a.idx_last - b.idx_last) as diff3,(CASE 
         WHEN (a.idx_last - b.idx_last) = 0 THEN 0
         ELSE 1
      END) AS stt3, a.idx_dcap,b.idx_dcap as idx_dcap_ims , ABS(a.idx_dcap - b.idx_dcap) as diff4,(CASE 
         WHEN (a.idx_dcap - b.idx_dcap) = 0 THEN 0
         ELSE 1
      END) AS stt4, a.idx_pclose,b.idx_pclose as pclose_ims , ABS(a.idx_pclose - b.idx_pclose) as diff5,(CASE 
         WHEN (a.idx_pclose - b.idx_pclose) = 0 THEN 0
         ELSE 1
      END) AS stt5 FROM idx_specs_temp_local as a INNER JOIN idx_specs_rt as b ON a.idx_code=b.idx_code )"; 
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
		$content = $this->bodyReport2($content,$table);
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
 
}
