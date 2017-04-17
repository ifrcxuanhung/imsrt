<?php

class Stk_feed extends Welcome{
    public function __construct() {
        parent::__construct();
		$this->load->model('Dashboard_model', 'dash');	
    }
    
    public function index() {
		$auto_download = $this->dash->get_Auto_Download_Feed();
		$frequency = $this->dash->get_auto_download_feed_frequency();	
		$arr_frequency = explode(":",$frequency["value"]);
		$fre = $arr_frequency[0]*60 + $arr_frequency[1];
		set_time_limit(300);
		$i = 0;
		$k = 60/$fre;
		while ($i<$k) {
			$start_second = microtime(true)*1000;
			if((int)$auto_download["value"]=='1'){
				$empty = 0;
				for($j = 1; $j<=9; $j++){
					if(in_array($j, array(1,2,9))) {
						if($j==1) $source ='HSX';
						else if($j==2) $source ='HNX';
						else $source ='UPCOM';
						$homepage = file_get_contents('http://banggia.cafef.vn/stockhandler.ashx?center='.$j);
						/*$ch = curl_init();
						$timeout = 0;
						curl_setopt ($ch, CURLOPT_URL, 'http://banggia.cafef.vn/stockhandler.ashx?center='.$j);
						curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
						curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
						$homepage = curl_exec($ch);
						curl_close($ch);*/
						
					
						$array_cafef = json_decode($homepage,true);
						//echo "<pre>";print_r($array_cafef);exit;
						
						foreach($array_cafef as $val){
							if($val['l'] != 0){
								$empty ++;
								//echo $empty;
								$date_time = explode(" ",$val['Time']);
								if(!isset($date_time[0]))
									$date_time[0]='';
								if(!isset($date_time[1])){
									$date_time[1]='';
								}else{
									$plit_date = explode("/",$date_time[1]);
									$date_time[1] = $plit_date[2]."-".$plit_date[1]."-".$plit_date[0];
								}
								$codeint = 'STKVN'.$val['a'];
								$number = $val['l']*1000;
							$get_file[] = $val['a']."\t".$date_time[1]."\t".$date_time[0]."\t".$number."\t".$codeint."\t".$source."\r\n";
								
							}
						}
					}
				}
				if($empty!=0) {
					file_put_contents("ftp_upload/efrc_stk_inv_feed.txt",$get_file);
				}
				else {
					file_put_contents("ftp_upload/efrc_stk_inv_feed.txt",array());
				}
			}
			$end_second = microtime(true)*1000;				
			$totaltime = round(($end_second - $start_second)/1000,6);
			$i ++;
			usleep (($fre-$totaltime)*1000000);
		}
		
    }
}