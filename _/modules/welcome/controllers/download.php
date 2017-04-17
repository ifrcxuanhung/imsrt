<?php

class Download extends Welcome{
    public function __construct() {
        parent::__construct();
		//$this->load->model('Dashboard_model', 'dash');	
    }
    
    public function index() {
		 $list = file_get_contents('http://www.quotenet.com/commodities/realtime-list');
         $this->data->list = $list;
         $this->template->write_view('content', 'download', $this->data);
         $this->template->render();
        
    }
    
     function export(){
        if(isset($_POST['arr'])){
        $array = $_POST['arr'];
            foreach($array as $value){
               if($value[0] != 'undefined' && $value[1] != 'undefined' && $value[2] != 'undefined'){ 
                   $dates = explode('<br>',$value[1]);
                   $checkDa = explode('/',strip_tags($dates[0]));
                   if(isset($checkDa[1])){
                      $date = date('Y-m-d',strtotime(strip_tags($dates[0])));
                      $time = date('H:i:s',strtotime(strip_tags($dates[1]))); 
                   }else {
                      $date = date('Y-m-d',strtotime(strip_tags($dates[1])));
                      $time = date('H:i:s',strtotime(strip_tags($dates[0]))); 
                   }
                   //$time = strip_tags($dates[1]);
                   //print_r($date.' '.$time);exit;
                   
                   if($value[0] == 'Heating Oil'){
                        $coded = 'OILH';
                   }else if ($value[0] == 'Oil (Brent)'){
                        $coded = 'OILB';
                   }else if ($value[0] == 'Oil (WTI)'){
                        $coded = 'OILW';
                   }else if ($value[0] == 'Natural Gas (Henry Hub)'){
                        $coded = 'NATURALGAS';
                   }else{
                        $coded = strtoupper(str_replace(" ","",$value[0]));
                   }
                  // print_R($coded);
                   $codeint = $this->db->select('code')->where('symbol',$coded)->get('efrc_ins_ref')->row_array();
                  // print_R($codeint);exit;
                   $string[] = $coded."\t".$value[0]."\t".$date."\t".$time."\t".str_replace(',','',$value[2])."\t".$value[3]."\t".$value[4]."\t".str_replace(',','',$value[5])."\t".(isset($codeint['code'])?$codeint['code']:'')."\r\n";
               }        
            }   
        };
        //CODE, NAME, DATE, TIME, LAST, PERCENT, CHANGE, PCLOSE, CODEINT 
        $file = 'ftp_upload/efrc_cmd_quotenet.txt';
        file_put_contents($file,$string);
        
    }
}