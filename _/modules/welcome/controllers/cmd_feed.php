<?php

class Cmd_feed extends Welcome{
    public function __construct() {
        parent::__construct();
		$this->load->model('Dashboard_model', 'dash');	
    }
    
    public function index() {
		
		 $list = file_get_contents('http://markets.businessinsider.com/commodities/realtime-list');
                 $abc = strstr($list,'<table class="table instruments">');
                 $abcs = substr( $abc,  strpos($abc,'<table class="table instruments">'), strpos($abc,'</table>'));
                 //$sss = explode('<tr><td class="text_center">',str_replace("\r\n","",str_replace("\t",'',$abcs)));
                 $bac = array_unique(explode('<td >',str_replace("\r\n","",str_replace("\t",'',$abcs))));
                 //print_R($bac);exit;
                 foreach($bac as $key=>$value){
                    if($key == 0){
                        $headers [] = explode('</th>',$value);
                        foreach($headers as $ke=>$val){
                            foreach($val as $k=>$v){
                                if($k==6 || $k==7){
                                    unset($headers[$ke][$k]);
                                }else if($k==0){
                                    unset($headers[$ke][$k]);
                                }
                                else{
                                  $header[$ke][$k]  = strip_tags($val[$k]);  
                                }
                            }
                        }
                    }else{
                        $string = array();
                        $contents[] = explode('</td><td class="text-right">',$value);
                        foreach($contents as $ke=>$val){
                            foreach($val as $k=>$v){
								//var_export($k);
                                if($k==6){
                                    unset($contents[$ke][$k]);
                                }else if($k==0){
                                   if(strip_tags($contents[$ke][$k]) == 'Heating Oil'){
                                        $coded = 'OILH';
                                   }else if (strip_tags($contents[$ke][$k]) == 'Oil (Brent)'){
                                        $coded = 'OILB';
                                   }else if (strip_tags($contents[$ke][$k]) == 'Oil (WTI)'){
                                        $coded = 'OILW';
                                   }else if (strip_tags($contents[$ke][$k]) == 'Natural Gas (Henry Hub)'){
                                        $coded = 'NATURALGAS';
                                   }else{
                                        $coded = strtoupper(str_replace(" ","",strip_tags($contents[$ke][$k])));
                                   }
                                   $content[$ke][$k] = str_replace(" ","",strip_tags($contents[$ke][$k]));
                                }
                                else{
                                    if($k == 5){
										//echo $val[$k-1];
                                       $content[$ke][$k] = $val[$k];
                                       $check_time_1 = explode('/',strip_tags($val[$k]));
									   $check_time_2 = explode('-',strip_tags($val[$k]));
                                       if(isset($check_time_1[1])||isset($check_time_2[1])){
                                          $date = date('Y-m-d',strtotime(strip_tags($val[$k])));  
                                          $time = date('H:i:s',strtotime(strip_tags($val[$k]))+39600);  
                                       }else{
                                          $date = date('Y-m-d');  
                                          $time = date('H:i:s',strtotime(strip_tags($val[$k]))+39600);  
                                       }
                                       //echo $time;
                                       //OLD TIME
                                      // $times = explode('<br/>',$val[$k]);
//                                       $checkDa = explode(' / ',strip_tags($times[1]));
//                                       if(isset($checkDa[1])){
//                                          $date = date('Y-m-d',strtotime(strip_tags($times[0])));
//                                          $time = date('H:i:s',strtotime(strip_tags($times[1]))); 
//                                       }else {
//                                          $date = date('Y-m-d',strtotime(strip_tags($times[1])));
//                                          $time = date('H:i:s',strtotime(strip_tags($times[0]))); 
//                                       }
                                          // print_R($times);exit;
                                       //echo $time;
                                       $content[$ke][$k] = strip_tags($date)."\t".strip_tags($time);
                                      
                                      
                                    }else{
                                        $content[$ke][$k]  = strip_tags($val[$k]);
                                    }
                                    
                                }
                                
                            }
                            $code = $this->db->select('code')->where('symbol',$coded)->get('efrc_ins_ref')->row_array();
                            $CODEINT = isset($code['code']) ? $code['code'] : '';
                            $string[$ke] = $coded. "\t". $content[$ke][0]."\t".$content[$ke][5]."\t".str_replace(',','',$content[$ke][1])."\t".$content[$ke][3]."\t".$content[$ke][4]."\t".str_replace(',','',$content[$ke][2])."\t".$CODEINT."\r\n";  
                            
                        }
                       
                    }
                      
                   //foreach($content as $val){
//                        if(isset($val[7])){
//                            unset($val);
//                        }
                        //array_pop($val);
                }
                //print_R($string);exit;
                //CODE, NAME, DATE, TIME, LAST, PERCENT, CHANGE, PCLOSE, CODEINT
				if($_SERVER['HTTP_HOST'] == 'linux.itvn.fr'){
					$file = '/var/lib/mysql/imsrt/efrc_cmd_quotenet.txt';
				}
				else{
					 $file = 'ftp_upload/efrc_cmd_quotenet.txt';
				} 
                
                file_put_contents($file,$string);
				
       // var_export($result);
    }
    
}