<?php

class Cur_feed extends Welcome{
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
		//BEGIN
                $list = file_get_contents(base_url().'ftp_upload/TIMER_CUR_LIST.txt');
                $cur_list = explode("\r\n",$list);
                //print_R($cur_list);exit;
               
				$string = array();
                foreach($cur_list as $key=>$value){   
                $cur = explode("\t",$value);
                    if(isset($cur[1])){ 
                        $current = trim($cur[0]).trim($cur[1]);
                        //$current = 'VNDVND';
						//print_r('http://www.bloomberg.com/apps/data?pid=webpxta&Securities='.$current.':CUR&TimePeriod=1D&Outfields=ITIME,PR005-I');die();
                        //$download = file_get_contents('http://www.bloomberg.com/apps/data?pid=webpxta&Securities='.$current.':CUR&TimePeriod=1D&Outfields=ITIME,PR005-I');
						$download = file_get_contents('http://www.bloomberg.com/markets/api/bulk-time-series/price/'.$current.':CUR?timeFrame=1_DAY');
						//print_r('http://www.bloomberg.com/markets/api/bulk-time-series/price/'.$current.':CUR?timeFrame=1_DAY');
						//die();
						$array_down = json_decode($download,true);
						//var_export($array_down[0]["lastUpdateUTC"]);
						//var_export($array[0]["lastPrice"]);
						//var_export($array["price"]["lastPrice"]);die();
						//var_export(json_decode($download,true));die();
                          $array = array();
						     
                            if($current!=''){
                                if(isset($array_down)&&!is_null($array_down)){                                    
                                    if(isset($array_down[0]["lastPrice"])&&isset($array_down[0]["lastPrice"])&&isset($array_down[0]["lastPrice"])){
                                        //print_R($times);exit;
										$last_update=$array_down[0]['lastUpdateUTC'];
										$dt = new DateTime("@$last_update");
										if($array_down[0]["lastPrice"] >0)      
                                        $string[] = trim($current)."\t".trim($cur[0])."\t".trim($cur[1])."\t".$array_down[0]["lastPrice"]."\t".$dt->format('Y-m-d')."\t". $dt->format('H:i:s')."\r\n";
                                    }else{
										if(trim($cur[0])==trim($cur[1]))
                                        $string[] = trim($current)."\t".trim($cur[0])."\t".trim($cur[1])."\t".'1'."\r\n";
                                    }
                                    
                                }
                            }
                           // print_r($string);exit;
                    }
						
                   
                } 
                //print_r($string);exit;
				if($_SERVER['HTTP_HOST'] == 'linux.itvn.fr'){
					$file = '/var/lib/mysql/imsrt/efrc_cur_blg_feed.txt';
				}
				else{
					 $file = 'ftp_upload/efrc_cur_blg_feed.txt';
				}
				
                //var_dump();
                file_put_contents($file,$string);
		
			}
			$end_second = microtime(true)*1000;				
			$totaltime = round(($end_second - $start_second)/1000,6);
			$i ++;
			if(($fre-$totaltime)>0)
			usleep (($fre-$totaltime)*1000000);
       // var_export($result);
    	}
	}
    //$CODE, $CURTO, $CURFR, $LAST, $TIME
     function setdownload($string){
        //print_R();exit; 
        //$file = 'ftp_upload/efrc_cur_blg_feed.txt';
        
    }
}