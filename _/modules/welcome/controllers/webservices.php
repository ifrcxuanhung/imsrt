<?php

class Webservices extends Welcome{

    public function __construct() {
        parent::__construct();
		$this->load->database();
		$this->load->model('Jq_realtime_model', 'table');
    }
 
    public function index(){
	
		$table_one = "idx_webservice_feed";
        
		$this->data->tables = $table_one;
		$this->load->model('jq_realtime_model');
		/* $this->data->column = str_replace('}]','}',str_replace('[{"','{',str_replace(',"',',',str_replace('":',':',json_encode($this->jq_loadtable_model->js_sys_format($tables))))));*/
		$column = $this->jq_realtime_model->js_sys_format($table_one);
		
		foreach($column as $k1=>$val_column1){
			if($val_column1['searchoptions'] == 'select'){
				$column[$k1]['stype'] = "select";
				//get select
				$this->db->select($val_column1['name']);
				$this->db->distinct();
				$this->db->order_by($val_column1['name'],"ASC");
			
				$query = $this->db->get($table_one);
				$data = $query->result_array();
				$result='';
				
				foreach($data as $key=>$v){
					if($v[$val_column1['name']] == ''){
						unset($data[$key]);
					}else{
						$result.= $v[$val_column1['name']].":".$v[$val_column1['name']].";";
					}
					
				}
				$column[$k1]['selectlist'] = json_encode($result);
				//end get select
			}
			if($val_column1['hidden'] == 'false'){
				unset($column[$k1]['hidden']);	
			}
			$column[$k1]['headertitles'] = "";
		}
		//echo "<pre>";print_r($column5);exit;
		 $this->data->column =json_encode($column);

		 // get list neu searchoptions =1 

		$this->data->filter_get_all = '';
		
		//$this->data->codeint = json_encode($this->db->select('*')
//         ->get('idx_webservice_feed')->result_array());
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
		$this->data->summary_des = $this->jq_realtime_model->get_summary_des($table_one);
		//print_R($this->jq_realtime_model->get_summary_des($table_one));exit;
		
		$this->template->write_view('content', 'webservices',$this->data);
		$this->template->render();

    }
	
}
