<?php

class Hsx extends Welcome{
    public function __construct() {
        parent::__construct();
		$this->load->model('Dashboard_model', 'dash');	
    }
    
    public function index() {
		$pre_opening_hsx = $this->dash->get_pre_opening();
		$pre_closing_hsx = $this->dash->get_pre_closing();
		$start_hsx = $this->dash->get_start();
		$start_time_hsx = $start_hsx["value"];
		$start_1_hsx = $this->dash->get_start_1();
		$start_time_1_hsx = $start_1_hsx["value"];
		$end_hsx = $this->dash->get_end();
		$end_time_hsx = $end_hsx["value"];
		$end_1_hsx = $this->dash->get_end_1();
		$end_time_1_hsx = $end_1_hsx["value"];
		$frequency_hsx = $this->dash->get_frequency();
		//set_time_limit (0);	
		$arr_frequency_hsx = explode(":",$frequency_hsx["value"]);
		$fre_hsx = $arr_frequency_hsx[0]*60 + $arr_frequency_hsx[1];		
		$value_time_hsx = date('H:i:s',microtime(true)*1000);
		//var_export( time());die();
		$i = 0;
		set_time_limit(300);
        while (($start_time_hsx<= date('H:i:s')) && ($end_time_hsx>= date('H:i:s'))) {
					
			$result = array();
			curl_setopt($curl = curl_init(), CURLOPT_URL, 'http://123.30.23.116:1001/wsr/IdxDat.asmx/GetSvrByNm?svrNm=RealPrice');
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			$data = curl_exec($curl);
			curl_close($curl);
			$xml = simplexml_load_string($data);
			$xml = str_replace(array("NewDataSet", "Table", "Code", "Price", "Last", "Time"), array("table", "tr", "td", "td", "", "td"), $xml);
			$dom = new DOMDocument;
			libxml_use_internal_errors(false);
			$dom->loadHTML($xml);
			$key = 0;
			foreach ($dom->getElementsByTagName('tr') as $child) {
				$dataFeed = explode("\n", $child->nodeValue);
				if (count($dataFeed) == 5) {
					/* get 3 first elements */
					$result[$key]['ticker'] = isset($dataFeed[0]) ? trim($dataFeed[0]) : '';
					$result[$key]['date'] = date("Y-m-d");
					$result[$key]['time'] = isset($dataFeed[3]) ? trim($dataFeed[3]) : '';
					$result[$key]['stk_last'] = isset($dataFeed[1]) ? trim($dataFeed[1]) : '';
					$query = $this->db->query("SELECT * FROM stk_feed_last WHERE ticker =  '". $result[$key]['ticker']."' and time='".$result[$key]['time']."'");
					$rows = $query->num_rows();
				
					  if(!$rows)
					  {
						  $this->db->insert('stk_feed_last', $result[$key]);
					   // No record has been found so here you would write the code to insert the data
					  }
				}
				
				$key++;
			}
			usleep(1000000);
			unset($result);
			unset($curl);
			unset($data);
			unset($xml);
			unset($dom);
			unset($key);
			unset($dataFeed);
			unset($rows);
        }
		
				
       // var_export($result);
    }
}