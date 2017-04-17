<?php
require('_/modules/welcome/controllers/block.php');

class Setup extends Welcome{
    public function __construct() {
        
        parent::__construct();
        $this->load->database();
       // $this->db2 = $this->load->database('database6', true); //connect LINUX IMSRT
        //$this->db4 = $this->load->database('database2', true); // connect LINUX VNDMI
        //$this->db5 = $this->load->database('database8', true); // connect LINUX VNEFRC
        //$this->db3 = $this->load->database('database6', true); //connect IMSRT
        //$this->db3 = $this->load->database('database7', true); //connect IMSREALTIME      
    }
    
  
    public function index()
    {   
		$this->load->model('setup_model', 'dash');
		$start = $this->dash->get_start();
		$this->data->start_time_1 = $start["value"];
		$end = $this->dash->get_end();
		$this->data->end_time_1 = $end["value"];
		$frequency = $this->dash->get_frequency();
		$this->data->frequency = $frequency["value"];		
        $calculation_date = $this->dash->get_calculation_date();
       	$this->data->calculation_date = $calculation_date["value"];
        $next_date = $this->dash->get_next_date();
       	$this->data->next_date = $next_date["value"];
		$feed_frequency = $this->dash->get_auto_download_feed_frequency();
		$this->data->feed_frequency = $feed_frequency["value"];
		$auto_download_feed = $this->dash->get_Auto_Download_Feed();
		$this->data->auto_download_feed = $auto_download_feed["value"];
		$after_close_calculation = $this->dash->get_after_close_calculation();
		$this->data->after_close_calculation = $after_close_calculation["value"];
		// get time khi nhan nut
		$settup_process = $this->dash->getSettupProcess();
		foreach($settup_process as $key=>$sp){
			$process[$sp['id']] =  $sp;
		}
		$sql =' Select * from setting_rt where `key` in ("max_diff_shares","max_diff_mcap","max_diff_dcap","max_diff_price","max_diff_divisor","max_diff_last","max_diff_pclose","max_diff_conv") ';
		$arr_key = $this->db->query($sql)->result_array();
		$keys = array();
		foreach($arr_key as $item){
			$keys[$item["key"]] = $item["value"];
		}
		$this->data->keys = $keys;
		$this->data->settup_process = $process;
        
        $this->template->write_view('content', 'setup', $this->data);
		
        $this->template->render();   
    }
	function save_setup()
    {
		$sql = "Update setting_rt set `value` = '". $_POST["start_time_1"]."' where `key` = 'start'";
        $status = $this->db->query($sql);
		$sql = "Update setting_rt set `value` = '". $_POST["end_time_1"]."' where `key` = 'end'";
        $status = $this->db->query($sql);
		$sql = "Update setting_rt set `value` = '". $_POST["frequency"]."' where `key` = 'frequency'";
        $status = $this->db->query($sql);
        $sql = "Update setting_rt set `value` = '". $_POST["calculation_date"]."' where `key` = 'calculation_date'";
        $status = $this->db->query($sql);
         $sql = "Update setting_rt set `value` = '".$_POST["next_date"]."' where `key` = 'nxt_date'";
        $status = $this->db->query($sql);
		$sql = "Update setting_rt set `value` = '". $_POST["feed_frequency"]."' where `key` = 'auto_download_feed_frequency'";
        $status = $this->db->query($sql);
		$sql = "Update setting_rt set `value` = '". $_POST["auto_download_feed"]."' where `key` = 'auto_download_feed'";
        $status = $this->db->query($sql);
		$sql = "Update setting_rt set `value` = '". $_POST["after_close_calculation"]."' where `key` = 'after_close_calculation'";
        $status = $this->db->query($sql);
		$sql = "Update setting_rt set `value` = '". $_POST["max_diff_shares"]."' where `key` = 'max_diff_shares'";
        $status = $this->db->query($sql);
		$sql = "Update setting_rt set `value` = '". $_POST["max_diff_mcap"]."' where `key` = 'max_diff_mcap'";
        $status = $this->db->query($sql);
		$sql = "Update setting_rt set `value` = '". $_POST["max_diff_dcap"]."' where `key` = 'max_diff_dcap'";
        $status = $this->db->query($sql);
		$sql = "Update setting_rt set `value` = '". $_POST["max_diff_price"]."' where `key` = 'max_diff_price'";
        $status = $this->db->query($sql);
		$sql = "Update setting_rt set `value` = '". $_POST["max_diff_divisor"]."' where `key` = 'max_diff_divisor'";
        $status = $this->db->query($sql);
		$sql = "Update setting_rt set `value` = '". $_POST["max_diff_last"]."' where `key` = 'max_diff_last'";
        $status = $this->db->query($sql);
		$sql = "Update setting_rt set `value` = '". $_POST["max_diff_pclose"]."' where `key` = 'max_diff_pclose'";
        $status = $this->db->query($sql);
		$sql = "Update setting_rt set `value` = '". $_POST["max_diff_conv"]."' where `key` = 'max_diff_conv'";
        $status = $this->db->query($sql);
		echo json_encode($status);
	}
     public function initialisation() { 
        $sql="update settup_process set times = null;";
        $this->db->query($sql); 
        $sql="update upload_process set times = null;";
        $this->db->query($sql); 
        $sql="update idx_process set date = (select `value` from setting_rt where `key`='calculation_date');";
        $this->db->query($sql); 
        $sql="update idx_process set `status` = null;";
        $this->db->query($sql);
		// luu lai thoi gian nhan nut
		$time = date('Y-m-d H:i:s');
		$sql_time="UPDATE settup_process SET `times` = '$time' WHERE id=1";
        $this->db->query($sql_time); 
         echo 1;
    }
	  public function open() {
	  // echo $_POST['truncate']; die();
	   $truncate = $_POST['truncate']; 
// INSERT DATA TODAY   
        $sql="update setting_rt set value='OPENING' where `key`='imsrt_status';";
        $this->db->query($sql);    
        $sql="delete from stk_feed_rt where left(code,5)='STKVN';";
        $this->db->query($sql);
        
        $sql="delete from cur_feed_rt where `status`='C';";
        $this->db->query($sql);
        
        $sql="truncate table idx_composition_rt;";
        $this->db->query($sql);
        $sql="insert into idx_composition_rt (`date`,`time`,`idx_code`,`idx_curr`,`stk_code`,`stk_name`,`stk_curr`,`stk_mult`,`stk_shares_idx`,`stk_float_idx`,`stk_capp_idx`,`stk_price`,`curr_conv`,`stk_curr_conv`,`stk_mcap_idx`,`stk_dprice_nr`,`stk_dcurr_conv`,`stk_dprice`,`stk_dcap_idx`,`stk_dcap_nr`,`stk_wgt`,`stk_tr`,`stk_pr`,`stk_nr`,`nstk_curr_conv`,`nstk_mcap_idx`,`specs_id`,`adjcoeff`,`codeint`,`stk_pclose`,`dvar`)
         select `date`,`time`,`idx_code`,`idx_curr`,`stk_code`,upper(`stk_name`) `stk_name`,`stk_curr`,`stk_mult`,`stk_shares_idx`,`stk_float_idx`,`stk_capp_idx`,`stk_price`,`curr_conv`,`stk_curr_conv`,`stk_mcap_idx`,`stk_dprice_nr`,`stk_dcurr_conv`,`stk_dprice`,`stk_dcap_idx`,`stk_dcap_nr`,`stk_wgt`,`stk_tr`,`stk_pr`,`stk_nr`,`nstk_curr_conv`,`nstk_mcap_idx`,`specs_id`,`adjcoeff`,`codeint`,`stk_pclose`,`dvar` from nxt_idx_composition; ";
        $this->db->query($sql);
        $sql="truncate table idx_specs_rt;";
        $this->db->query($sql);
        $sql="insert into idx_specs_rt (`idx_code`,`idx_name`,`idx_curr`,`idx_base`,`idx_type`,`idx_mother`,`idx_divisor`,`idx_mcap`,`idx_last`,`date`,`time`,`records`,`calculs`,`publications`,`idx_plast`,`idx_dcap`,`to_adjust`,`idx_mcap_nxt`,`idx_divisor_nxt`,`idx_bbs`,`idx_conv`,`idx_pclose`,`idx_group`,`idx_var`,`ip_last`,`ip_plast`,`idx_dvar`,`nxt_date`,`idx_change`,`idx_dchange`,`next_divisor_adjust`,`final_divisor`,`temp_plast`,`provider`,`type`)
         select `idx_code`,upper(`idx_name`) `idx_name`,`idx_curr`,`idx_base`,`idx_type`,`idx_mother`,`idx_divisor`,`idx_mcap`,`idx_last`,`date`,`time`,`records`,`calculs`,`publications`,`idx_plast`,`idx_dcap`,`to_adjust`,`idx_mcap_nxt`,`idx_divisor_nxt`,`idx_bbs`,`idx_conv`,`idx_pclose`,`idx_group`,`idx_var`,`ip_last`,`ip_plast`,`idx_dvar`,`nxt_date`,`idx_change`,`idx_dchange`,`next_divisor_adjust`,`final_divisor`,`temp_plast`,`provider`,`type` from nxt_idx_specs; ";
        $this->db->query($sql);
        $sql="truncate table stk_prices_rt;";
        $this->db->query($sql);
        $sql="insert into stk_prices_rt (`stk_code`,`stk_name`,`stk_rlast`,`stk_last`,`stk_price`,`date`,`time`,`ticker`,`stk_rlast_date`,`stk_adjcls_date`,`codeint`)
         select `stk_code`,`stk_name`,`stk_rlast`,`stk_last`,`stk_price`,`date`,`time`,`ticker`,`stk_rlast_date`,`stk_adjcls_date`,`codeint` from nxt_stk_prices group by stk_code; ";
        $this->db->query($sql);
        $sql="update stk_prices_rt set time='00:00:00',`stk_last` = null, `stk_price`=null;";
        $this->db->query($sql); 

/*********************************
/* UPDATE DATA CHO CÁC CH? S? MOTHER RESERCH
/*
/*********************************/
        $sql="truncate idx_irs_correct;";
        $this->db->query($sql);
        
        $sql='LOAD DATA LOCAL INFILE "ftp_upload/idx_irs_correct.txt" into table idx_irs_correct character set utf8 fields terminated by  "\t"  lines terminated by  "\r\n" (`idx_code`,`idx_mcap`,`idx_divisor`);';
        $this->db->query($sql);
        
        $sql="update idx_specs_rt as a, idx_specs_correct as b set a.idx_mother=b.idx_mother where a.idx_code=b.idx_code;";
        $this->db->query($sql);
        
        $sql="update idx_specs_rt as a, idx_irs_correct as b set a.idx_mcap=b.idx_mcap, a.idx_divisor=b.idx_divisor where a.idx_code=b.idx_code;";
        $this->db->query($sql);
/*********************************/

        $sql="update idx_specs_rt as a, idx_sample as b set a.type=b.sub_type, a.provider=b.provider where a.idx_code=b.code;";
        $this->db->query($sql);
        
        $sql="update idx_specs_rt as a, idx_ref_rt as b set a.idx_type=b.idx_type where a.idx_code=b.idx_code;";
        $this->db->query($sql);
        
        $sql="update idx_specs_rt set  time='00:00:00',date = (select `value` from setting_rt where `key`='calculation_date');";
        $this->db->query($sql);
        
        $sql="update idx_specs_rt set idx_plast = 0,idx_last= 0;";
        $this->db->query($sql);
        
        $sql="update idx_specs_rt set idx_plast = idx_pclose, idx_last = idx_pclose;";
        $this->db->query($sql);

        $sql="update idx_specs_rt set idx_var=null, idx_dvar= null, idx_dchange= null;";
        $this->db->query($sql);
      
// Update cho chi so con       
        $sql="drop table if exists tmpx;";
        $this->db->query($sql);
        
        $sql="create table tmpx select * from idx_specs_rt where idx_code=idx_mother;";
        $this->db->query($sql);
        
        $sql="update idx_specs_rt as a, tmpx as b set a.idx_mcap=b.idx_mcap where a.idx_mother=b.idx_mother and a.idx_type=b.idx_type;";
        $this->db->query($sql);
        
        $sql="update idx_specs_rt set idx_mcap=idx_mcap/idx_conv;";
        $this->db->query($sql);
        
         $sql="update idx_specs_rt,(select `idx_curr`, `idx_last`, `idx_pclose`, `idx_type`, `idx_mother`
                from idx_specs_rt where `idx_type` = 'P') as `temp`
                set idx_specs_rt.`idx_last` = idx_specs_rt.`idx_pclose` / `temp`.`idx_pclose` * (`temp`.`idx_last` + (idx_specs_rt.`idx_base` * idx_specs_rt.`idx_dcap` / idx_specs_rt.`idx_divisor`))
                where idx_specs_rt.`idx_type` = 'R'
                and idx_specs_rt.`idx_mother` = `temp`.`idx_mother`
                and idx_specs_rt.`idx_curr` = `temp`.`idx_curr`;";
        $this->db->query($sql);
        
         $sql="drop table if exists tmpx;";
        $this->db->query($sql);
        
         $sql="create table tmpx select * from idx_specs_rt where idx_type='P';";
        $this->db->query($sql);
        
         $sql="update idx_specs_rt as a, tmpx as b set a.idx_mcap=b.idx_mcap where a.idx_mother=b.idx_mother and a.idx_curr=b.idx_curr and a.idx_type='R';";
        $this->db->query($sql);
        
        $sql="update idx_specs_rt as a, efrc_ins_ref as b set a.codeint=b.code where a.idx_code=b.codeifrc;";
        $this->db->query($sql);
        
 // ================================================================================       
        $sql="update stk_prices_rt set codeint=concat('STKVN',stk_code),date = (select `value` from setting_rt where `key`='calculation_date');";
        $this->db->query($sql);
        
        $sql="update idx_composition_rt set codeint=concat('STKVN',stk_code),date = (select `value` from setting_rt where `key`='calculation_date');";
        $this->db->query($sql);
        
        $sql="update idx_compo_rt set codeint=concat('STKVN',stk_code), date = (select `value` from setting_rt where `key`='calculation_date');";
        $this->db->query($sql);
        
        $sql="delete from stk_feed_rt where left(code,5)='STKVN';";
        $this->db->query($sql); 
        
        $sql="delete from stk_feed_rt where `status`='C' and date < (select `value` from setting_rt where `key`='calculation_date');";
        $this->db->query($sql);
                
        $sql="insert into stk_feed_rt (`symbol`,`name`,`date`,`last`,`code`,pclose) select stk_code,stk_name,date,stk_rlast as stk_price, 
        concat('STKVN',stk_code) as codeint, stk_rlast  from stk_prices_rt;";
        $this->db->query($sql);
        
        $sql="update stk_feed_rt set time='00:00:00';";
        $this->db->query($sql);
        
        $sql="update stk_feed_rt set `change`=`last`-pclose,percent=100*((last/pclose)-1) ;";
        $this->db->query($sql);

        $sql="update idx_composition_rt set stk_pclose=stk_price ;";
        $this->db->query($sql);
        
        $sql="update idx_composition_rt set dvar=100*((stk_price/stk_pclose)-1), time='00:00:00';";
        $this->db->query($sql);
        if($truncate==1){
            $sql="truncate table idx_specs_intraday;";
            $this->db->query($sql);
            $sql="truncate table idx_composition_intraday;";
            $this->db->query($sql);
            $sql="truncate table ind_feed_intraday;";
            $this->db->query($sql);
            $sql="truncate table cmd_feed_intraday;";
            $this->db->query($sql);
        }
        else {
            $sql="drop table if exists spects_temp;";
            $this->db->query($sql);
            $sql="create table spects_temp like idx_specs_intraday;";
            $this->db->query($sql);
            $sql="insert into spects_temp select * from idx_specs_intraday where date=(select `value` from setting_rt where `key`='calculation_date');";
            $this->db->query($sql);
            $sql="truncate table idx_specs_intraday;";
            $this->db->query($sql);
            $sql="insert idx_specs_intraday select * from spects_temp;";
            $this->db->query($sql); 
            //-------------------------------------------------------        
            $sql="drop table if exists compo_temp;";
            $this->db->query($sql);
            $sql="create table compo_temp like idx_composition_intraday;";
            $this->db->query($sql);
            $sql="insert into compo_temp select * from idx_composition_intraday where date=(select `value` from setting_rt where `key`='calculation_date');";
            $this->db->query($sql);
            $sql="truncate table idx_composition_intraday;";
            $this->db->query($sql);
            $sql="insert idx_composition_intraday select * from compo_temp;";
            $this->db->query($sql);
            // ---------------------------------------------------------
            $sql="drop table if exists ind_feed_temp;";
            $this->db->query($sql);
            $sql="create table ind_feed_temp like ind_feed_intraday;";
            $this->db->query($sql);
            $sql="insert into ind_feed_temp select * from ind_feed_intraday where date=(select `value` from setting_rt where `key`='calculation_date');";
            $this->db->query($sql);
            $sql="truncate table ind_feed_intraday;";
            $this->db->query($sql);
            $sql="insert ind_feed_intraday select * from ind_feed_temp;";
            $this->db->query($sql); 
           // ---------------------------------------------------------
            $sql="drop table if exists cmd_feed_temp;";
            $this->db->query($sql);
            $sql="create table cmd_feed_temp like cmd_feed_intraday;";
            $this->db->query($sql);
            $sql="insert into cmd_feed_temp select * from cmd_feed_intraday where date=(select `value` from setting_rt where `key`='calculation_date');";
            $this->db->query($sql);
            $sql="truncate table cmd_feed_intraday;";
            $this->db->query($sql);
            $sql="insert cmd_feed_intraday select * from cmd_feed_temp;";
            $this->db->query($sql);   

        }
        $sql="delete from stk_prices_intraday where date <>(select `value` from setting_rt where `key`='calculation_date');";
        $this->db->query($sql);
               
        $sql="delete from stk_feed_intraday where date <>(select `value` from setting_rt where `key`='calculation_date');";
        $this->db->query($sql);
        $sql="delete from cur_feed_intraday where date <>(select `value` from setting_rt where `key`='calculation_date');";
        $this->db->query($sql);
                
        $sql="update idx_specs_rt set idx_var=0, idx_dvar= 0, idx_dchange= 0;";
        $this->db->query($sql); 
              
        $sql="update setting_rt set value='OPENED' where `key`='imsrt_status';";
        $this->db->query($sql);
		$sql = 'UPDATE setting_rt
					SET `value` = "0"
					where `key`="close_status" and `group`="setting"';
					$this->db->simple_query($sql);
					
		// luu lai thoi gian nhan nut
		$time = date('Y-m-d H:i:s');
		$sql_time="UPDATE settup_process SET `times` = '$time' WHERE id=2";
        $this->db->query($sql_time);

        echo 1;
    }
    
    public function close() {
        $sql="delete from stk_feed_rt where `status`='C' and date < (select `value` from setting_rt where `key`='calculation_date');";
        $this->db->query($sql);
        $sql="delete from cur_feed_rt where `status`='C';";
        $this->db->query($sql);
        
       
        $sql=" update stk_prices_rt set stk_last=null,stk_price=null ;";
        $this->db->query($sql);
        
        $sql=" update stk_prices_rt as a, stk_feed_rt as b set a.stk_last=b.last where a.codeint=b.code ;";
        $this->db->query($sql);
        
        $sql="update stk_prices_rt set stk_price=if((stk_last <>0 or stk_last is not null), stk_last, stk_rlast);";
        $this->db->query($sql);
        
        $sql="truncate cur_rates_close;";
        $this->db->query($sql);
        
        $sql='LOAD DATA LOCAL INFILE "ftp_upload/cur_rates_close.txt" into table cur_rates_close character set utf8 fields terminated by  "\t"  lines terminated by  "\r\n"
ignore 1 lines (`code`,`currency`,`tos`,`curr_conv`,`date`);';
        $this->db->query($sql);
        
        $sql="insert into cur_feed_rt (symbol,`code`,last,date,`status`,`updateflag`) select code as symbol, concat('CUR',currency,tos) as code, curr_conv last,date, 'C' as status,1 as `updateflag` from cur_rates_close;";
        $this->db->query($sql);
		
		 $sql='LOAD DATA LOCAL INFILE "ftp_upload/stk_feed_close.txt" into table stk_feed_rt character set utf8 fields terminated by  "\t"  
        lines terminated by  "\r\n" ignore 1 lines (`symbol`,`name`,`date`,`last`,`code`) set status="C", `updateflag`=1;';
        $this->db->query($sql);
        

        $sql="update setting_rt set value='CLOSING' where `key`='imsrt_status';";
        $this->db->query($sql);
		$sql = 'UPDATE setting_rt
					SET `value` = "0"
					where `key`="close_status" and `group`="setting"';
					$this->db->simple_query($sql);
		// luu lai thoi gian nhan nut
        //$this->update_pclose_stk();
		$time = date('Y-m-d H:i:s');
		$sql_time="UPDATE settup_process SET `times` = '$time' WHERE id=3";
        $this->db->query($sql_time);
        echo 1;
     }
     
    public function switch_next_day() {
       // luu lai thoi gian nhan nut
		$time = date('Y-m-d H:i:s');
		$sql_time="UPDATE settup_process SET `times` = '$time' WHERE id=4";
        $this->db->query($sql_time);
        echo 1;
     }
     
     
     public function open_new() {
// CREATE DATA FOR PVN
       
        $sql="update idx_ref_rt set realtime=1 , calculs=1,date = (select `value` from setting_rt where `key`='calculation_date');";
        $this->db->query($sql);
        
        $sql="update idx_ref_rt set mother= 1 where idx_code=idx_mother;";
        $this->db->query($sql);
        
		$sql="truncate idx_compo_rt;";
        $this->db->query($sql);

         $sql='LOAD DATA LOCAL INFILE "ftp_upload/idx_compo_pvn.txt" into table idx_compo_rt character set utf8 fields terminated by  "\t"  lines 
    terminated by  "\r\n" (stk_code,stk_name,stk_shares_idx,stk_float_idx,stk_capp_idx,idx_code,date,start_date,end_date,stk_curr); ';
        $this->db->query($sql);

        $sql="truncate idx_specs_rt;";
        $this->db->query($sql);
        
        $sql='LOAD DATA LOCAL INFILE "ftp_upload/idx_specs_pvn.txt" into table idx_specs_rt character set utf8 fields terminated by  "\t"  lines 
    terminated by  "\r\n" (idx_code,idx_name,idx_curr,idx_base,idx_type,idx_mother,idx_divisor,idx_mcap,idx_last,date,time,records,calculs,publications,
    idx_plast,idx_dcap,to_adjust,idx_mcap_nxt,idx_divisor_nxt,idx_bbs,idx_conv,idx_pclose,idx_group,idx_var,ip_last,ip_plast,idx_dvar,nxt_date,idx_change,idx_dchange,next_divisor_adjust,final_divisor);';
        $this->db->query($sql);
        
        $sql="truncate idx_composition_rt;";
        $this->db->query($sql);
        
        $sql='LOAD DATA LOCAL INFILE "ftp_upload/idx_composition_pvn.txt" into table idx_composition_rt character set utf8 fields terminated by  "\t"  lines 
    terminated by  "\r\n" (date,time,idx_code,idx_curr,stk_code,stk_name,stk_curr,stk_mult,stk_shares_idx,stk_float_idx,stk_capp_idx,
stk_price,curr_conv,stk_curr_conv,stk_mcap_idx,stk_dprice_nr,stk_dcurr_conv,stk_dprice,stk_dcap_idx,stk_dcap_nr,stk_wgt,stk_tr, stk_pr,stk_nr,nstk_curr_conv,nstk_mcap_idx,specs_id,adjcoeff);';
        $this->db->query($sql);
        
        $sql="update idx_composition_rt set codeint=concat('STKVN',stk_code);";
        $this->db->query($sql);
        
// create data for vnxindexes

        $sql='LOAD DATA LOCAL INFILE "ftp_upload/idx_specs_vnx.txt" into table idx_specs_rt character set utf8 fields terminated by  "\t"  lines 
    terminated by  "\r\n" (idx_code,idx_name,idx_curr,idx_base,idx_type,idx_mother,idx_divisor,idx_mcap,idx_last,date,time,records,calculs,
publications,idx_plast,idx_dcap,to_adjust,idx_mcap_nxt,idx_divisor_nxt,idx_bbs,idx_conv,idx_pclose,idx_group,idx_var,ip_last,ip_plast,idx_dvar,nxt_date,
idx_change,idx_dchange,next_divisor_adjust,final_divisor);';
        $this->db->query($sql);

        $sql='LOAD DATA LOCAL INFILE "ftp_upload/idx_composition_vnx.txt" into table idx_composition_rt character set utf8 fields terminated by  "\t"  lines 
    terminated by  "\r\n" (date,time,idx_code,idx_curr,stk_code,stk_name,stk_curr,stk_mult,stk_shares_idx,stk_float_idx,stk_capp_idx,
stk_price,curr_conv,stk_curr_conv,stk_mcap_idx,stk_dprice_nr,stk_dcurr_conv,stk_dprice,stk_dcap_idx,stk_dcap_nr,stk_wgt,stk_tr,
stk_pr,stk_nr,nstk_curr_conv,nstk_mcap_idx,specs_id,adjcoeff);';
        $this->db->query($sql);
        
        $sql='LOAD DATA LOCAL INFILE "ftp_upload/idx_compo_vnx.txt" into table idx_compo_rt character set utf8 fields terminated by  "\t"  lines 
    terminated by  "\r\n" (stk_code,stk_name,stk_shares_idx,stk_float_idx,stk_capp_idx,idx_code,date,start_date,end_date,stk_curr);';
        $this->db->query($sql);
        
        $sql="truncate stk_prices_rt;";
        $this->db->query($sql);
        
        $sql='LOAD DATA LOCAL INFILE "ftp_upload/stk_prices_rt.txt" into table stk_prices_rt character set utf8 fields terminated by  "\t"  lines 
    terminated by  "\r\n" (stk_code,stk_name,stk_rlast,stk_last,stk_price,date,time,ticker,stk_rlast_date,stk_adjcls_date);';
        $this->db->query($sql);

// create data for RESEARCH   
        $sql='LOAD DATA LOCAL INFILE "ftp_upload/idx_specs_rt.txt" into table idx_specs_rt
character set utf8 fields terminated by  "\t"  lines terminated by  "\r\n" (`idx_code`,`idx_name`,`idx_curr`,`idx_base`,`idx_type`,
`idx_mother`,`idx_divisor`,`idx_mcap`,`idx_last`,`date`,`time`,`records`,`calculs`,`publications`,`idx_plast`,`idx_dcap`,`to_adjust`,`idx_mcap_nxt`,
`idx_divisor_nxt`,`idx_bbs`,`idx_conv`,`idx_pclose`,`idx_group`,`idx_var`,`ip_last`,`ip_plast`,`idx_dvar`,`nxt_date`,`idx_change`,`idx_dchange`,
`next_divisor_adjust`,`final_divisor`,`temp_plast`,`provider`,`type`);';
        $this->db->query($sql);
        
        $sql="update idx_specs_rt set idx_var=null, idx_dvar= null, idx_dchange= null;";
        $this->db->query($sql);
                
        $sql='LOAD DATA LOCAL INFILE "ftp_upload/idx_composition_rt.txt" into table idx_composition_rt
character set utf8 fields terminated by  "\t"  lines terminated by  "\r\n" (`date`,`time`,`idx_code`,`idx_curr`,`stk_code`,
`stk_name`,`stk_curr`,`stk_mult`,`stk_shares_idx`,`stk_float_idx`,`stk_capp_idx`,`stk_price`,`curr_conv`,`stk_curr_conv`,`stk_mcap_idx`,
`stk_dprice_nr`,`stk_dcurr_conv`,`stk_dprice`,`stk_dcap_idx`,`stk_dcap_nr`,`stk_wgt`,`stk_tr`,`stk_pr`,`stk_nr`,`nstk_curr_conv`,`nstk_mcap_idx`,
`specs_id`,`adjcoeff`,`codeint`,`stk_pclose`);';
        $this->db->query($sql);
        
        $sql='LOAD DATA LOCAL INFILE "ftp_upload/idx_compo_rt.txt" into table idx_compo_rt character set utf8 fields terminated by  "\t"  lines 
    terminated by  "\r\n" (`stk_code`,`stk_name`,`stk_shares_idx`,`stk_float_idx`,
`stk_capp_idx`,`idx_code`,`date`,`start_date`,`end_date`,`stk_curr`,`codeint`);';
        $this->db->query($sql);
        
/*********************************
/* UPDATE DATA CHO CÁC CH? S? MOTHER RESERCH
/*
/*********************************/
        $sql="truncate idx_irs_correct;";
        $this->db->query($sql);
        
        $sql='LOAD DATA LOCAL INFILE "ftp_upload/idx_irs_correct.txt" into table idx_irs_correct character set utf8 fields terminated by  "\t"  lines terminated by  "\r\n" (`idx_code`,`idx_mcap`,`idx_divisor`);';
        $this->db->query($sql);
        
        $sql="update idx_specs_rt as a, idx_specs_correct as b set a.idx_mother=b.idx_mother where a.idx_code=b.idx_code;";
        $this->db->query($sql);
        
        $sql="update idx_specs_rt as a, idx_irs_correct as b set a.idx_mcap=b.idx_mcap, a.idx_divisor=b.idx_divisor where a.idx_code=b.idx_code;";
        $this->db->query($sql);
/*********************************/

        $sql="update idx_specs_rt as a, idx_sample as b set a.type=b.sub_type, a.provider=b.provider where a.idx_code=b.code;";
        $this->db->query($sql);
        
        $sql="update idx_specs_rt as a, idx_ref_rt as b set a.idx_type=b.idx_type where a.idx_code=b.idx_code;";
        $this->db->query($sql);
        
        $sql="update idx_specs_rt set  time='00:00:00',date = (select `value` from setting_rt where `key`='calculation_date');";
        $this->db->query($sql);
        
        $sql="update idx_specs_rt set idx_plast = 0,idx_last= 0;";
        $this->db->query($sql);
        
        $sql="update idx_specs_rt set idx_plast = idx_pclose, idx_last = idx_pclose;";
        $this->db->query($sql);

        $sql="update idx_specs_rt set idx_var=null, idx_dvar= null, idx_dchange= null;";
        $this->db->query($sql);
      
// Update cho chi so con       
        $sql="drop table if exists tmp;";
        $this->db->query($sql);
        
        $sql="create table tmp select * from idx_specs_rt where idx_code=idx_mother;";
        $this->db->query($sql);
        
        $sql="update idx_specs_rt as a, tmp as b set a.idx_mcap=b.idx_mcap where a.idx_mother=b.idx_mother and a.idx_type=b.idx_type;";
        $this->db->query($sql);
        
        $sql="update idx_specs_rt set idx_mcap=idx_mcap/idx_conv;";
        $this->db->query($sql);
        
         $sql="update idx_specs_rt,(select `idx_curr`, `idx_last`, `idx_pclose`, `idx_type`, `idx_mother`
                from idx_specs_rt where `idx_type` = 'P') as `temp`
                set idx_specs_rt.`idx_last` = idx_specs_rt.`idx_pclose` / `temp`.`idx_pclose` * (`temp`.`idx_last` + (idx_specs_rt.`idx_base` * idx_specs_rt.`idx_dcap` / idx_specs_rt.`idx_divisor`))
                where idx_specs_rt.`idx_type` = 'R'
                and idx_specs_rt.`idx_mother` = `temp`.`idx_mother`
                and idx_specs_rt.`idx_curr` = `temp`.`idx_curr`;";
        $this->db->query($sql);
        
         $sql="drop table if exists tmp;";
        $this->db->query($sql);
        
         $sql="create table tmp select * from idx_specs_rt where idx_type='P';";
        $this->db->query($sql);
        
         $sql="update idx_specs_rt as a, tmp as b set a.idx_mcap=b.idx_mcap where a.idx_mother=b.idx_mother and a.idx_curr=b.idx_curr and a.idx_type='R';";
        $this->db->query($sql);
 // ================================================================================       
        $sql="update stk_prices_rt set codeint=concat('STKVN',stk_code),date = (select `value` from setting_rt where `key`='calculation_date');";
        $this->db->query($sql);
        
        $sql="update idx_composition_rt set codeint=concat('STKVN',stk_code),date = (select `value` from setting_rt where `key`='calculation_date');";
        $this->db->query($sql);
        
        $sql="update idx_compo_rt set codeint=concat('STKVN',stk_code), date = (select `value` from setting_rt where `key`='calculation_date');";
        $this->db->query($sql);

        $sql=" TRUNCATE stk_feed_last;";
        $this->db->query($sql);
        
        $sql="insert into stk_feed_last (ticker,`name`,date,stk_last,codeint) select stk_code,stk_name,date, stk_price, concat('STKVN',stk_code) as codeint  from stk_prices_rt;";
        $this->db->query($sql);
        
        $sql="update stk_feed_last set date = (select `value` from setting_rt where `key`='calculation_date'), time='00:00:00';";
        $this->db->query($sql);
        
        /*$sql="update cur_feed_rt set time='00:00:00', date = (select `value` from setting_rt where `key`='calculation_date');";
        $this->db->query($sql);*/

        $sql="update idx_composition_rt as a,stk_feed_last as b set a.stk_pclose=b.stk_last, a.stk_price= b.stk_last where a.stk_code=b.ticker;";
        $this->db->query($sql);
        
        $sql="update idx_composition_rt set dvar=100*((stk_price/stk_pclose)-1), time='00:00:00';";
        $this->db->query($sql);
     
        $sql="update idx_composition_rt as a, stk_div_rt as b set a.stk_dcurr_conv=b.stk_divnet, a.stk_dprice=b.stk_divnet  where a.codeint=b.codeint 
and a.date=b.exdate and a.stk_code=b.stk_code;";
        $this->db->query($sql);

        $sql="delete from idx_specs_intraday where date <>(select `value` from setting_rt where `key`='calculation_date');";
        $this->db->query($sql);
        
        $sql="delete from idx_composition_intraday where date <>(select `value` from setting_rt where `key`='calculation_date');";
        $this->db->query($sql);
        
        $sql="delete from stk_feed_intraday where date <>(select `value` from setting_rt where `key`='calculation_date');";
        $this->db->query($sql);
        
        $sql="update idx_specs_rt set idx_var=0, idx_dvar= 0, idx_dchange= 0;";
        $this->db->query($sql);
        
        $sql="update setting_rt set value='OPENED' where `key`='imsrt_status';";
        $this->db->query($sql);
		$sql = 'UPDATE setting_rt
					SET `value` = "0"
					where `key`="close_status" and `group`="setting"';
					$this->db->simple_query($sql);
		// luu lai thoi gian nhan nut
		$time = date('Y-m-d H:i:s');
		$sql_time="UPDATE settup_process SET `times` = '$time' WHERE id=6";
        $this->db->query($sql_time);

        echo 1;
//redirect(base_url().'overview');
    }
	public function test_nxt_idx_specs_pvn(){
		 $sql='LOAD DATA LOCAL INFILE "ftp_upload/nxt_idx_specs_pvn.txt" into table nxt_idx_specs_copy character set utf8 fields terminated by  "\t"  lines 
    terminated by  "\r\n" (idx_code,idx_name,idx_curr,idx_base,idx_type,idx_mother,idx_divisor,idx_mcap,idx_last,date,time,records,calculs,publications,
    idx_plast,idx_dcap,to_adjust,idx_mcap_nxt,idx_divisor_nxt,idx_bbs,idx_conv,idx_pclose,idx_group,idx_var,ip_last,ip_plast,idx_dvar,nxt_date,idx_change,idx_dchange,next_divisor_adjust,final_divisor);';
        $this->db->query($sql);	
		 $sql='LOAD DATA LOCAL INFILE "ftp_upload/nxt_idx_specs_vnx.txt" into table nxt_idx_specs_copy character set utf8 fields terminated by  "\t"  lines 
    terminated by  "\r\n" (idx_code,idx_name,idx_curr,idx_base,idx_type,idx_mother,idx_divisor,idx_mcap,idx_last,date,time,records,calculs,publications,
    idx_plast,idx_dcap,to_adjust,idx_mcap_nxt,idx_divisor_nxt,idx_bbs,idx_conv,idx_pclose,idx_group,idx_var,ip_last,ip_plast,idx_dvar,nxt_date,idx_change,idx_dchange,next_divisor_adjust,final_divisor);';
        $this->db->query($sql);
		 $sql='LOAD DATA LOCAL INFILE "ftp_upload/nxt_idx_specs_irs.txt" into table nxt_idx_specs_copy character set utf8 fields terminated by  "\t"  lines 
    terminated by  "\r\n" (idx_code,idx_name,idx_curr,idx_base,idx_type,idx_mother,idx_divisor,idx_mcap,idx_last,date,time,records,calculs,publications,
    idx_plast,idx_dcap,to_adjust,idx_mcap_nxt,idx_divisor_nxt,idx_bbs,idx_conv,idx_pclose,idx_group,idx_var,ip_last,ip_plast,idx_dvar,nxt_date,idx_change,idx_dchange,next_divisor_adjust,final_divisor);';
        $this->db->query($sql);
	}
    public function create_nxt_data() {
        // PVN
        $sql="truncate nxt_idx_specs;";
        $this->db->query($sql);  
        $sql='LOAD DATA LOCAL INFILE "ftp_upload/nxt_idx_specs_pvn.txt" into table nxt_idx_specs character set utf8 fields terminated by  "\t"  lines 
    terminated by  "\r\n" (idx_code,idx_name,idx_curr,idx_base,idx_type,idx_mother,idx_divisor,idx_mcap,idx_last,date,time,records,calculs,publications,
    idx_plast,idx_dcap,to_adjust,idx_mcap_nxt,idx_divisor_nxt,idx_bbs,idx_conv,idx_pclose,idx_group,idx_var,ip_last,ip_plast,idx_dvar,nxt_date,idx_change,idx_dchange,next_divisor_adjust,final_divisor);';
        $this->db->query($sql);
        $sql="truncate nxt_idx_composition;";
        $this->db->query($sql);
        $sql='LOAD DATA LOCAL INFILE "ftp_upload/nxt_idx_composition_pvn.txt" into table nxt_idx_composition character set utf8 fields terminated by  "\t"  lines 
    terminated by  "\r\n" (date,time,idx_code,idx_curr,stk_code,stk_name,stk_curr,stk_mult,stk_shares_idx,stk_float_idx,stk_capp_idx,
stk_price,curr_conv,stk_curr_conv,stk_mcap_idx,stk_dprice_nr,stk_dcurr_conv,stk_dprice,stk_dcap_idx,stk_dcap_nr,stk_wgt,stk_tr, stk_pr,stk_nr,nstk_curr_conv,nstk_mcap_idx,specs_id,adjcoeff);';
        $this->db->query($sql);
        // VNX
        $sql="truncate nxt_stk_prices;";
        $this->db->query($sql);
        $sql='LOAD DATA LOCAL INFILE "ftp_upload/nxt_stk_prices_pvn.txt" into table nxt_stk_prices character set utf8 fields terminated by  "\t"  lines 
    terminated by  "\r\n" (stk_code,stk_name,stk_rlast,stk_last,stk_price,date,time,ticker,stk_rlast_date,stk_adjcls_date);';
        $this->db->query($sql);
        /*$sql='load data infile "nxt_stk_prices_correct.txt" into table nxt_stk_prices character set utf8 fields terminated by  "\t"  lines 
    terminated by  "\r\n" (stk_code,stk_name,stk_rlast,stk_last,stk_price,date,time,ticker,stk_rlast_date,stk_adjcls_date);';
        $this->db->query($sql);*/
        $sql='LOAD DATA LOCAL INFILE "ftp_upload/nxt_stk_prices_vnx.txt" into table nxt_stk_prices character set utf8 fields terminated by  "\t"  lines 
    terminated by  "\r\n" (stk_code,stk_name,stk_rlast,stk_last,stk_price,date,time,ticker,stk_rlast_date,stk_adjcls_date);';
        $this->db->query($sql);
          
        
        $sql="truncate nxt_stk_prices_correct;";
        $this->db->query($sql);
        $sql='LOAD DATA LOCAL INFILE "ftp_upload/nxt_stk_prices_correct.txt" into table nxt_stk_prices_correct character set utf8 fields terminated by  "\t"  lines 
    terminated by  "\r\n" (stk_code,stk_name,stk_rlast,stk_last,stk_price,date,time,ticker,stk_rlast_date,stk_adjcls_date);';
        $this->db->query($sql);
        $sql='insert into nxt_stk_prices (stk_code,stk_name,stk_rlast,stk_last,stk_price,date,time,ticker,stk_rlast_date,stk_adjcls_date,codeint)
select stk_code,stk_name,stk_rlast,stk_last,stk_price,date,time,ticker,stk_rlast_date,stk_adjcls_date,codeint
 from nxt_stk_prices_correct where stk_code not in(select distinct stk_code from nxt_stk_prices);';
        $this->db->query($sql);


        $sql='LOAD DATA LOCAL INFILE "ftp_upload/nxt_idx_specs_vnx.txt" into table nxt_idx_specs character set utf8 fields terminated by  "\t"  lines 
    terminated by  "\r\n" (idx_code,idx_name,idx_curr,idx_base,idx_type,idx_mother,idx_divisor,idx_mcap,idx_last,date,time,records,calculs,publications,
    idx_plast,idx_dcap,to_adjust,idx_mcap_nxt,idx_divisor_nxt,idx_bbs,idx_conv,idx_pclose,idx_group,idx_var,ip_last,ip_plast,idx_dvar,nxt_date,idx_change,idx_dchange,next_divisor_adjust,final_divisor);';
        $this->db->query($sql);
        
         $sql='LOAD DATA LOCAL INFILE "ftp_upload/nxt_idx_composition_vnx.txt" into table nxt_idx_composition character set utf8 fields terminated by  "\t"  lines 
    terminated by  "\r\n" (date,time,idx_code,idx_curr,stk_code,stk_name,stk_curr,stk_mult,stk_shares_idx,stk_float_idx,stk_capp_idx,
stk_price,curr_conv,stk_curr_conv,stk_mcap_idx,stk_dprice_nr,stk_dcurr_conv,stk_dprice,stk_dcap_idx,stk_dcap_nr,stk_wgt,stk_tr, stk_pr,stk_nr,nstk_curr_conv,nstk_mcap_idx,specs_id,adjcoeff);';
        $this->db->query($sql);
        
        $sql="truncate nxt_idx_spnext;";
        $this->db->query($sql);  
        $sql='LOAD DATA LOCAL INFILE "ftp_upload/nxt_idx_specs_vnx.txt" into table nxt_idx_spnext character set utf8 fields terminated by  "\t"  lines 
    terminated by  "\r\n" (idx_code,idx_name,idx_curr,idx_base,idx_type,idx_mother,idx_divisor,idx_mcap,idx_last,date,time,records,calculs,publications,
    idx_plast,idx_dcap,to_adjust,idx_mcap_nxt,idx_divisor_nxt,idx_bbs,idx_conv,idx_pclose,idx_group,idx_var,ip_last,ip_plast,idx_dvar,nxt_date,idx_change,idx_dchange,next_divisor_adjust,final_divisor);';
        $this->db->query($sql);
        
        $sql="truncate nxt_idx_cpnext;";
        $this->db->query($sql);
        $sql='LOAD DATA LOCAL INFILE "ftp_upload/nxt_idx_composition_vnx.txt" into table nxt_idx_cpnext character set utf8 fields terminated by  "\t"  lines 
    terminated by  "\r\n" (date,time,idx_code,idx_curr,stk_code,stk_name,stk_curr,stk_mult,stk_shares_idx,stk_float_idx,stk_capp_idx,
stk_price,curr_conv,stk_curr_conv,stk_mcap_idx,stk_dprice_nr,stk_dcurr_conv,stk_dprice,stk_dcap_idx,stk_dcap_nr,stk_wgt,stk_tr, stk_pr,stk_nr,nstk_curr_conv,nstk_mcap_idx,specs_id,adjcoeff);';
        $this->db->query($sql);
        
    // RESEARCH    
        $sql='LOAD DATA LOCAL INFILE "ftp_upload/nxt_idx_specs_irs.txt" into table nxt_idx_specs character set utf8 fields terminated by  "\t"  lines 
    terminated by  "\r\n" (idx_code,idx_name,idx_curr,idx_base,idx_type,idx_mother,idx_divisor,idx_mcap,idx_last,date,time,records,calculs,publications,
    idx_plast,idx_dcap,to_adjust,idx_mcap_nxt,idx_divisor_nxt,idx_bbs,idx_conv,idx_pclose,idx_group,idx_var,ip_last,ip_plast,idx_dvar,nxt_date,idx_change,idx_dchange,next_divisor_adjust,final_divisor);';
        $this->db->query($sql);
        
         $sql='LOAD DATA LOCAL INFILE "ftp_upload/nxt_idx_composition_irs.txt" into table nxt_idx_composition character set utf8 fields terminated by  "\t"  lines 
    terminated by  "\r\n" (date,time,idx_code,idx_curr,stk_code,stk_name,stk_curr,stk_mult,stk_shares_idx,stk_float_idx,stk_capp_idx,
stk_price,curr_conv,stk_curr_conv,stk_mcap_idx,stk_dprice_nr,stk_dcurr_conv,stk_dprice,stk_dcap_idx,stk_dcap_nr,stk_wgt,stk_tr, stk_pr,stk_nr,nstk_curr_conv,nstk_mcap_idx,specs_id,adjcoeff);';
        $this->db->query($sql);
        
        $sql="insert into stk_div_rt (stk_code,stk_name, stk_divnet, stk_divgross,exdate) select stk_code,stk_name, stk_divnet, stk_divgross,exdate from stk_div order by exdate desc;";
        $this->db->query($sql);
        $sql="drop table if exists temp;";
        $this->db->query($sql);
        $sql="create table temp select stk_code,stk_name, stk_divnet, stk_divgross,exdate from stk_div_rt group by stk_code,exdate;";
        $this->db->query($sql);
        $sql="truncate table stk_div_rt;";
        $this->db->query($sql);
        $sql="insert into stk_div_rt (stk_code,stk_name, stk_divnet, stk_divgross,exdate)select stk_code,stk_name, stk_divnet, stk_divgross,exdate from temp;";
        $this->db->query($sql);
        $sql="update stk_div_rt set codeint=concat('STKVN',stk_code);";
        $this->db->query($sql);
        
        $sql="update stk_div_rt as a, stk_ref as b set a.stk_name=upper(b.stk_name_sn) where a.stk_code=b.stk_code;";
        $this->db->query($sql);
        
        $sql="insert into idx_ca_rt (`stk_code`,`idx_code`,`date`,`new_shares`,`nxt_float_idx`,`nxt_capp_idx`,`adj_close`,`intro`,`removal`,`exdate`,
`effective_date`,`title`,`description`,`author`,`poster`,`active`,`date_cre`,`date_update`,`files`,`language`,`id_pvnca`,`to_adjust`,`id_ca`,
`time`,`idx_sg`,`event_name`,`stk_split`,`id_event_insert`,`evt_code`) select `stk_code`,`idx_code`,`date`,`new_shares`,`nxt_float_idx`,`nxt_capp_idx`,`adj_close`,`intro`,`removal`,`exdate`,
`effective_date`,`title`,`description`,`author`,`poster`,`active`,`date_cre`,`date_update`,`files`,`language`,`id_pvnca`,`to_adjust`,`id_ca`,
`time`,`idx_sg`,`event_name`,`stk_split`,`id_event_insert`,`evt_code` from idx_ca;";
        $this->db->query($sql);
        
         $sql="drop table if exists temp;";
         $this->db->query($sql);
         
        $sql="create table temp select `stk_code`,`idx_code`,`date`,`new_shares`,`nxt_float_idx`,`nxt_capp_idx`,`adj_close`,`intro`,`removal`,`exdate`,
`effective_date`,`title`,`description`,`author`,`poster`,`active`,`date_cre`,`date_update`,`files`,`language`,`id_pvnca`,`to_adjust`,`id_ca`,
`time`,`idx_sg`,`event_name`,`stk_split`,`id_event_insert`,`evt_code` from idx_ca_rt group by stk_code,idx_code,date;";
        $this->db->query($sql);
        
        $sql="truncate table idx_ca_rt;";
        $this->db->query($sql);
        
        $sql="insert into idx_ca_rt (`stk_code`,`idx_code`,`date`,`new_shares`,`nxt_float_idx`,`nxt_capp_idx`,`adj_close`,`intro`,`removal`,`exdate`,
`effective_date`,`title`,`description`,`author`,`poster`,`active`,`date_cre`,`date_update`,`files`,`language`,`id_pvnca`,`to_adjust`,`id_ca`,
`time`,`idx_sg`,`event_name`,`stk_split`,`id_event_insert`,`evt_code`) select `stk_code`,`idx_code`,`date`,`new_shares`,`nxt_float_idx`,`nxt_capp_idx`,`adj_close`,`intro`,`removal`,`exdate`,
`effective_date`,`title`,`description`,`author`,`poster`,`active`,`date_cre`,`date_update`,`files`,`language`,`id_pvnca`,`to_adjust`,`id_ca`,
`time`,`idx_sg`,`event_name`,`stk_split`,`id_event_insert`,`evt_code` from temp;";
        $this->db->query($sql);
        
        $sql="update idx_ca_rt set codeint=concat('STKVN',stk_code);";
        $this->db->query($sql);

      /**************UPDATE DATA****************/
        $sql="truncate idx_irs_correct;";
        $this->db->query($sql);
        
        $sql='LOAD DATA LOCAL INFILE "ftp_upload/idx_irs_correct.txt" into table idx_irs_correct character set utf8 fields terminated by  "\t"  lines terminated by  "\r\n" (`idx_code`,`idx_mcap`,`idx_divisor`);';
        $this->db->query($sql);
        
        $sql="update nxt_idx_specs as a, idx_specs_correct as b set a.idx_mother=b.idx_mother where a.idx_code=b.idx_code;";
        $this->db->query($sql);
        
        $sql="update nxt_idx_specs as a, idx_irs_correct as b set a.idx_mcap=b.idx_mcap, a.idx_divisor=b.idx_divisor where a.idx_code=b.idx_code;";
        $this->db->query($sql);
/*********************************/

        $sql="update nxt_idx_specs as a, idx_sample as b set a.type=b.sub_type, a.provider=b.provider where a.idx_code=b.code;";
        $this->db->query($sql);
        
        $sql="update nxt_idx_specs as a, idx_ref_rt as b set a.idx_type=b.idx_type, a.idx_name=upper(b.idx_name_sn) where a.idx_code=b.idx_code;";
        $this->db->query($sql);

        $sql="update nxt_idx_specs set  time='00:00:00',nxt_date = (select `value` from setting_rt where `key`='nxt_date'),date = (select `value` from setting_rt where `key`='nxt_date');";
        $this->db->query($sql);
        
        $sql="update nxt_idx_specs set idx_plast = idx_pclose, idx_last = idx_pclose;";
        $this->db->query($sql);

        $sql="update nxt_idx_specs set idx_var=null, idx_dvar= null, idx_dchange= null;";
        $this->db->query($sql);
      
// Update cho chi so con       
        $sql="drop table if exists tmp1;";
        $this->db->query($sql);
        
        $sql="create table tmp1 select * from nxt_idx_specs where idx_code=idx_mother;";
        $this->db->query($sql);
        
        $sql="update nxt_idx_specs as a, tmp1 as b set a.idx_mcap=b.idx_mcap where a.idx_mother=b.idx_mother and a.idx_type=b.idx_type;";
        $this->db->query($sql);
        
        $sql="update nxt_idx_specs set idx_mcap=idx_mcap/idx_conv;";
        $this->db->query($sql);
        
         $sql="update  nxt_idx_specs ,(select `idx_curr`, `idx_last`, `idx_pclose`, `idx_type`, `idx_mother`
                from nxt_idx_specs where `idx_type` = 'P') as `temp`
                set  nxt_idx_specs .`idx_last` =  nxt_idx_specs .`idx_pclose` / `temp`.`idx_pclose` * (`temp`.`idx_last` + ( nxt_idx_specs .`idx_base` *  nxt_idx_specs .`idx_dcap` /  nxt_idx_specs .`idx_divisor`))
                where  nxt_idx_specs .`idx_type` = 'R'
                and  nxt_idx_specs .`idx_mother` = `temp`.`idx_mother`
                and  nxt_idx_specs .`idx_curr` = `temp`.`idx_curr`;";
        $this->db->query($sql);

        $sql="drop table if exists tmp1;";
        $this->db->query($sql);
        
         $sql="create table tmp1 select * from nxt_idx_specs where idx_type='P';";
        $this->db->query($sql);
        
         $sql="update nxt_idx_specs as a, tmp1 as b set a.idx_mcap=b.idx_mcap where a.idx_mother=b.idx_mother and a.idx_curr=b.idx_curr and a.idx_type='R';";
        $this->db->query($sql);
 // ================================================================================       
        $sql="update nxt_stk_prices set codeint=concat('STKVN',stk_code),date = (select `value` from setting_rt where `key`='nxt_date');";
        $this->db->query($sql);
        
        $sql="update nxt_idx_composition set codeint=concat('STKVN',stk_code),date = (select `value` from setting_rt where `key`='nxt_date');";
        $this->db->query($sql);

        $sql="update nxt_idx_composition set dvar=100*((stk_price/stk_pclose)-1), time='00:00:00';";
        $this->db->query($sql);
        $sql="update nxt_idx_specs set idx_var=0, idx_dvar= 0, idx_dchange= 0;";
        $this->db->query($sql);
		
		// luu lai thoi gian nhan nut
		$time = date('Y-m-d H:i:s');
		$sql_time="UPDATE settup_process SET `times` = '$time' WHERE id=7";
        $this->db->query($sql_time);
        echo 1;
        
    }
    
     public function update_stat() {
/* INSERT INTO TABLE HISTORY*/
        $sql="drop table if EXISTS tmp_history;";
        $this->db->query($sql);
        
         $sql="create table tmp_history like idx_history;";
        $this->db->query($sql);
        
        $sql="insert into tmp_history (`code`,date, `open`,high,low,`close`,perform)
        select `code`,date, `open`,high,low,`close`,perform  from idx_history where date <> (select `value` from setting_rt where `key`='calculation_date');";
        $this->db->query($sql);
        
        $sql="insert into tmp_history (`code`,date,`close`,perform)
        select `codeint` as code,date,`idx_last` as close,idx_dvar as perform  from idx_specs_rt ;";
        $this->db->query($sql);
        
        $sql="insert into tmp_history (`code`,date,`close`,perform)
        select `codeint` as code,date,`idx_last` as close,idx_dvar as perform  from idx_specs_ed ;";
        $this->db->query($sql);
        
       $sql=" update tmp_history as a,(select concat('IND',idx_code) codeint, date, max(idx_last) as high, min(idx_last) as low  
        from idx_specs_intraday group by codeint,date) as b set a.high=b.high, a.low=b.low 
        where a.`code`=b.codeint and a.date=b.date;";
       $this->db->query($sql);
       
        $sql="update tmp_history as a,(select concat('IND',idx_code) codeint, date, idx_last as `open`, min(time) as time from idx_specs_intraday group by codeint,date) as b
        set a.`open`=b.open where  a.`code`=b.codeint and a.date=b.date;";
        $this->db->query($sql);
        
        $sql="truncate idx_history;";
        $this->db->query($sql);
        
        $sql="insert into idx_history (`code`,date, `open`,high,low,`close`,perform)
        select `code`,date, `open`,high,low,`close`,perform from tmp_history group by code,date;";
        $this->db->query($sql);

 //------------------------------------------------------------------------------------------- 
        $sql="drop table if EXISTS tmp_specs;";
        $this->db->query($sql);
        
        $sql="create table tmp_specs like idx_specs_history;";
        $this->db->query($sql);
        
        $sql="insert into tmp_specs (`idx_code`,`idx_name`,`idx_curr`,`idx_base`,`idx_type`,`idx_mother`,`idx_divisor`,`idx_mcap`,`idx_last`,`date`,`time`,`records`,`calculs`,`publications`,`idx_plast`,`idx_dcap`,`to_adjust`,`idx_mcap_nxt`,`idx_divisor_nxt`,`idx_bbs`,`idx_conv`,`idx_group`,`idx_var`,`idx_pclose`,`ip_last`,`ip_plast`,`idx_dvar`,`nxt_date`,`idx_change`,`idx_dchange`)
        select `idx_code`,`idx_name`,`idx_curr`,`idx_base`,`idx_type`,`idx_mother`,`idx_divisor`,`idx_mcap`,`idx_last`,`date`,`time`,`records`,`calculs`,`publications`,`idx_plast`,`idx_dcap`,`to_adjust`,`idx_mcap_nxt`,`idx_divisor_nxt`,`idx_bbs`,`idx_conv`,`idx_group`,`idx_var`,`idx_pclose`,`ip_last`,`ip_plast`,`idx_dvar`,`nxt_date`,`idx_change`,`idx_dchange` 
        from idx_specs_history where date <> (select `value` from setting_rt where `key`='calculation_date');";
        $this->db->query($sql);
        
        $sql="insert into tmp_specs (`idx_code`,`idx_name`,`idx_curr`,`idx_base`,`idx_type`,`idx_mother`,`idx_divisor`,`idx_mcap`,`idx_last`,`date`,`time`,`records`,`calculs`,`publications`,`idx_plast`,`idx_dcap`,`to_adjust`,`idx_mcap_nxt`,`idx_divisor_nxt`,`idx_bbs`,`idx_conv`,`idx_group`,`idx_var`,`idx_pclose`,`ip_last`,`ip_plast`,`idx_dvar`,`nxt_date`,`idx_change`,`idx_dchange`)
        select `idx_code`,`idx_name`,`idx_curr`,`idx_base`,`idx_type`,`idx_mother`,`idx_divisor`,`idx_mcap`,`idx_last`,`date`,`time`,`records`,`calculs`,`publications`,`idx_plast`,`idx_dcap`,`to_adjust`,`idx_mcap_nxt`,`idx_divisor_nxt`,`idx_bbs`,`idx_conv`,`idx_group`,`idx_var`,`idx_pclose`,`ip_last`,`ip_plast`,`idx_dvar`,`nxt_date`,`idx_change`,`idx_dchange` 
        from idx_specs_rt;";
        $this->db->query($sql);
        
        $sql="insert into tmp_specs (`idx_code`,`idx_name`,`idx_curr`,`idx_base`,`idx_type`,`idx_mother`,`idx_divisor`,`idx_mcap`,`idx_last`,`date`,`time`,`records`,`calculs`,`publications`,`idx_plast`,`idx_dcap`,`to_adjust`,`idx_mcap_nxt`,`idx_divisor_nxt`,`idx_bbs`,`idx_conv`,`idx_group`,`idx_var`,`idx_pclose`,`ip_last`,`ip_plast`,`idx_dvar`,`nxt_date`,`idx_change`,`idx_dchange`)
        select `idx_code`,`idx_name`,`idx_curr`,`idx_base`,`idx_type`,`idx_mother`,`idx_divisor`,`idx_mcap`,`idx_last`,`date`,`time`,`records`,`calculs`,`publications`,`idx_plast`,`idx_dcap`,`to_adjust`,`idx_mcap_nxt`,`idx_divisor_nxt`,`idx_bbs`,`idx_conv`,`idx_group`,`idx_var`,`idx_pclose`,`ip_last`,`ip_plast`,`idx_dvar`,`nxt_date`,`idx_change`,`idx_dchange` 
        from idx_specs_ed;";
        $this->db->query($sql);
        
        $sql="truncate idx_specs_history;";
        $this->db->query($sql);
        
        $sql="insert into idx_specs_history (`idx_code`,`idx_name`,`idx_curr`,`idx_base`,`idx_type`,`idx_mother`,`idx_divisor`,`idx_mcap`,`idx_last`,`date`,`time`,`records`,`calculs`,`publications`,`idx_plast`,`idx_dcap`,`to_adjust`,`idx_mcap_nxt`,`idx_divisor_nxt`,`idx_bbs`,`idx_conv`,`idx_group`,`idx_var`,`idx_pclose`,`ip_last`,`ip_plast`,`idx_dvar`,`nxt_date`,`idx_change`,`idx_dchange`)
        select `idx_code`,`idx_name`,`idx_curr`,`idx_base`,`idx_type`,`idx_mother`,`idx_divisor`,`idx_mcap`,`idx_last`,`date`,`time`,`records`,`calculs`,`publications`,`idx_plast`,`idx_dcap`,`to_adjust`,`idx_mcap_nxt`,`idx_divisor_nxt`,`idx_bbs`,`idx_conv`,`idx_group`,`idx_var`,`idx_pclose`,`ip_last`,`ip_plast`,`idx_dvar`,`nxt_date`,`idx_change`,`idx_dchange` 
        from tmp_specs group by `idx_code`,`date`;";
        $this->db->query($sql);
 //-------------------------------------------------------------------------------------------       
        $sql="drop table if EXISTS tmp_composition;";
        $this->db->query($sql);
        
        $sql="create table tmp_composition like idx_composition_history;";
        $this->db->query($sql);
        
        $sql="insert into tmp_composition (`date`,`time`,`idx_code`,`idx_curr`,`stk_code`,`stk_name`,`stk_curr`,`stk_mult`,`stk_shares_idx`,`stk_float_idx`,
        `stk_capp_idx`,`stk_price`,`curr_conv`,`stk_curr_conv`,`stk_mcap_idx`,`stk_dprice_nr`,`stk_dcurr_conv`,`stk_dprice`,`stk_dcap_idx`,`stk_dcap_nr`,
        `stk_wgt`,`stk_tr`,`stk_pr`,`stk_nr`,`nstk_curr_conv`,`nstk_mcap_idx`,`specs_id`,`adjcoeff`,`codeint`)
        select `date`,`time`,`idx_code`,`idx_curr`,`stk_code`,`stk_name`,`stk_curr`,`stk_mult`,`stk_shares_idx`,`stk_float_idx`,`stk_capp_idx`,`stk_price`,
        `curr_conv`,`stk_curr_conv`,`stk_mcap_idx`,`stk_dprice_nr`,`stk_dcurr_conv`,`stk_dprice`,`stk_dcap_idx`,`stk_dcap_nr`,`stk_wgt`,`stk_tr`,`stk_pr`,
        `stk_nr`,`nstk_curr_conv`,`nstk_mcap_idx`,`specs_id`,`adjcoeff`,`codeint` from idx_composition_history
        where date <> (select `value` from setting_rt where `key`='calculation_date');";
        $this->db->query($sql);
        
        $sql="insert into tmp_composition (`date`,`time`,`idx_code`,`idx_curr`,`stk_code`,`stk_name`,`stk_curr`,`stk_mult`,`stk_shares_idx`,`stk_float_idx`,
        `stk_capp_idx`,`stk_price`,`curr_conv`,`stk_curr_conv`,`stk_mcap_idx`,`stk_dprice_nr`,`stk_dcurr_conv`,`stk_dprice`,`stk_dcap_idx`,`stk_dcap_nr`,
        `stk_wgt`,`stk_tr`,`stk_pr`,`stk_nr`,`nstk_curr_conv`,`nstk_mcap_idx`,`specs_id`,`adjcoeff`,`codeint`)
        select `date`,`time`,`idx_code`,`idx_curr`,`stk_code`,`stk_name`,`stk_curr`,`stk_mult`,`stk_shares_idx`,`stk_float_idx`,`stk_capp_idx`,`stk_price`,
        `curr_conv`,`stk_curr_conv`,`stk_mcap_idx`,`stk_dprice_nr`,`stk_dcurr_conv`,`stk_dprice`,`stk_dcap_idx`,`stk_dcap_nr`,`stk_wgt`,`stk_tr`,`stk_pr`,
        `stk_nr`,`nstk_curr_conv`,`nstk_mcap_idx`,`specs_id`,`adjcoeff`,`codeint` from idx_composition_rt;";
        $this->db->query($sql);
        
        $sql="insert into tmp_composition (`date`,`time`,`idx_code`,`idx_curr`,`stk_code`,`stk_name`,`stk_curr`,`stk_mult`,`stk_shares_idx`,`stk_float_idx`,
        `stk_capp_idx`,`stk_price`,`curr_conv`,`stk_curr_conv`,`stk_mcap_idx`,`stk_dprice_nr`,`stk_dcurr_conv`,`stk_dprice`,`stk_dcap_idx`,`stk_dcap_nr`,
        `stk_wgt`,`stk_tr`,`stk_pr`,`stk_nr`,`nstk_curr_conv`,`nstk_mcap_idx`,`specs_id`,`adjcoeff`,`codeint`)
        select `date`,`time`,`idx_code`,`idx_curr`,`stk_code`,`stk_name`,`stk_curr`,`stk_mult`,`stk_shares_idx`,`stk_float_idx`,`stk_capp_idx`,`stk_price`,
        `curr_conv`,`stk_curr_conv`,`stk_mcap_idx`,`stk_dprice_nr`,`stk_dcurr_conv`,`stk_dprice`,`stk_dcap_idx`,`stk_dcap_nr`,`stk_wgt`,`stk_tr`,`stk_pr`,
        `stk_nr`,`nstk_curr_conv`,`nstk_mcap_idx`,`specs_id`,`adjcoeff`,`codeint` from idx_composition_ed;";
        $this->db->query($sql);
        
        $sql="truncate idx_composition_history;";
        $this->db->query($sql);
        
        $sql="insert into idx_composition_history (`date`,`time`,`idx_code`,`idx_curr`,`stk_code`,`stk_name`,`stk_curr`,`stk_mult`,`stk_shares_idx`,`stk_float_idx`,
        `stk_capp_idx`,`stk_price`,`curr_conv`,`stk_curr_conv`,`stk_mcap_idx`,`stk_dprice_nr`,`stk_dcurr_conv`,`stk_dprice`,`stk_dcap_idx`,`stk_dcap_nr`,
        `stk_wgt`,`stk_tr`,`stk_pr`,`stk_nr`,`nstk_curr_conv`,`nstk_mcap_idx`,`specs_id`,`adjcoeff`,`codeint`)
        select `date`,`time`,`idx_code`,`idx_curr`,`stk_code`,`stk_name`,`stk_curr`,`stk_mult`,`stk_shares_idx`,`stk_float_idx`,`stk_capp_idx`,`stk_price`,
        `curr_conv`,`stk_curr_conv`,`stk_mcap_idx`,`stk_dprice_nr`,`stk_dcurr_conv`,`stk_dprice`,`stk_dcap_idx`,`stk_dcap_nr`,`stk_wgt`,`stk_tr`,`stk_pr`,
        `stk_nr`,`nstk_curr_conv`,`nstk_mcap_idx`,`specs_id`,`adjcoeff`,`codeint` from tmp_composition group by `idx_code`,`date`;";
        $this->db->query($sql);
 //-------------------------------------------------------------------------------------------  
         $sql="drop table if EXISTS tmp_feed;";
        $this->db->query($sql);
        
        $sql="create table tmp_feed like stk_feed_history;";
        $this->db->query($sql);
        
        $sql="insert into tmp_feed  (`symbol`,`name`,`date`,`time`,`last`,`percent`,`change`,`pclose`,`code`,`updateflag`,`source`,`status`)
        select  `symbol`,`name`,`date`,`time`,`last`,`percent`,`change`,`pclose`,`code`,`updateflag`,`source`,`status`
        from stk_feed_history where date <> (select `value` from setting_rt where `key`='calculation_date');";
        $this->db->query($sql);
        
        $sql="insert into tmp_feed (`symbol`,`name`,`date`,`time`,`last`,`percent`,`change`,`pclose`,`code`,`updateflag`,`source`,`status`)
        select  `symbol`,`name`,`date`,`time`,`last`,`percent`,`change`,`pclose`,`code`,`updateflag`,`source`,`status`  from stk_feed_rt;";
        $this->db->query($sql);
        
        $sql="truncate stk_feed_history;";
        $this->db->query($sql);
        
        $sql="insert into stk_feed_history (`symbol`,`name`,`date`,`time`,`last`,`percent`,`change`,`pclose`,`code`,`updateflag`,`source`,`status`)
        select  `symbol`,`name`,`date`,`time`,`last`,`percent`,`change`,`pclose`,`code`,`updateflag`,`source`,`status` from tmp_feed group by `symbol`,`date`;";
        $this->db->query($sql);

		// luu lai thoi gian nhan nut
		$time = date('Y-m-d H:i:s');
		$sql_time="UPDATE settup_process SET `times` = '$time' WHERE id=5";
        $this->db->query($sql_time);
         echo 1;
    }
    public function backup_old1() {

       $sql="drop table if EXISTS tmp_specs;";
        $this->db->query($sql);
        
        $sql="create table tmp_specs like idx_specs_histoday;";
        $this->db->query($sql);
        
        $sql="insert into tmp_specs (`idx_code`,`idx_name`,`idx_curr`,`idx_base`,`idx_type`,`idx_mother`,`idx_divisor`,`idx_mcap`,`idx_last`,`date`,`time`,`records`,`calculs`,`publications`,`idx_plast`,`idx_dcap`,`to_adjust`,`idx_mcap_nxt`,`idx_divisor_nxt`,`idx_bbs`,`idx_conv`,`idx_group`,`idx_var`,`idx_pclose`,`ip_last`,`ip_plast`,`idx_dvar`,`nxt_date`,`idx_change`,`idx_dchange`)
        select `idx_code`,`idx_name`,`idx_curr`,`idx_base`,`idx_type`,`idx_mother`,`idx_divisor`,`idx_mcap`,`idx_last`,`date`,`time`,`records`,`calculs`,`publications`,`idx_plast`,`idx_dcap`,`to_adjust`,`idx_mcap_nxt`,`idx_divisor_nxt`,`idx_bbs`,`idx_conv`,`idx_group`,`idx_var`,`idx_pclose`,`ip_last`,`ip_plast`,`idx_dvar`,`nxt_date`,`idx_change`,`idx_dchange` 
        from idx_specs_histoday where date <> (select `value` from setting_rt where `key`='calculation_date');";
        $this->db->query($sql);
        
        $sql="insert into tmp_specs (`idx_code`,`idx_name`,`idx_curr`,`idx_base`,`idx_type`,`idx_mother`,`idx_divisor`,`idx_mcap`,`idx_last`,`date`,`time`,`records`,`calculs`,`publications`,`idx_plast`,`idx_dcap`,`to_adjust`,`idx_mcap_nxt`,`idx_divisor_nxt`,`idx_bbs`,`idx_conv`,`idx_group`,`idx_var`,`idx_pclose`,`ip_last`,`ip_plast`,`idx_dvar`,`nxt_date`,`idx_change`,`idx_dchange`)
        select `idx_code`,`idx_name`,`idx_curr`,`idx_base`,`idx_type`,`idx_mother`,`idx_divisor`,`idx_mcap`,`idx_last`,`date`,`time`,`records`,`calculs`,`publications`,`idx_plast`,`idx_dcap`,`to_adjust`,`idx_mcap_nxt`,`idx_divisor_nxt`,`idx_bbs`,`idx_conv`,`idx_group`,`idx_var`,`idx_pclose`,`ip_last`,`ip_plast`,`idx_dvar`,`nxt_date`,`idx_change`,`idx_dchange` 
        from idx_specs_intraday;";
        $this->db->query($sql);
        
        $sql="truncate idx_specs_histoday;";
        $this->db->query($sql);
        
        $sql="insert into idx_specs_histoday (`idx_code`,`idx_name`,`idx_curr`,`idx_base`,`idx_type`,`idx_mother`,`idx_divisor`,`idx_mcap`,`idx_last`,`date`,`time`,`records`,`calculs`,`publications`,`idx_plast`,`idx_dcap`,`to_adjust`,`idx_mcap_nxt`,`idx_divisor_nxt`,`idx_bbs`,`idx_conv`,`idx_group`,`idx_var`,`idx_pclose`,`ip_last`,`ip_plast`,`idx_dvar`,`nxt_date`,`idx_change`,`idx_dchange`)
        select `idx_code`,`idx_name`,`idx_curr`,`idx_base`,`idx_type`,`idx_mother`,`idx_divisor`,`idx_mcap`,`idx_last`,`date`,`time`,`records`,`calculs`,`publications`,`idx_plast`,`idx_dcap`,`to_adjust`,`idx_mcap_nxt`,`idx_divisor_nxt`,`idx_bbs`,`idx_conv`,`idx_group`,`idx_var`,`idx_pclose`,`ip_last`,`ip_plast`,`idx_dvar`,`nxt_date`,`idx_change`,`idx_dchange` 
        from tmp_specs;";
        $this->db->query($sql);
  //-------------------------------------------------------------------------------------------          
        $sql="drop table if EXISTS tmp_composition;";
        $this->db->query($sql);
        
        $sql="create table tmp_composition like idx_composition_histoday;";
        $this->db->query($sql);
        
        $sql="insert into tmp_composition (`date`,`time`,`idx_code`,`idx_curr`,`stk_code`,`stk_name`,`stk_curr`,`stk_mult`,`stk_shares_idx`,`stk_float_idx`,
        `stk_capp_idx`,`stk_price`,`curr_conv`,`stk_curr_conv`,`stk_mcap_idx`,`stk_dprice_nr`,`stk_dcurr_conv`,`stk_dprice`,`stk_dcap_idx`,`stk_dcap_nr`,
        `stk_wgt`,`stk_tr`,`stk_pr`,`stk_nr`,`nstk_curr_conv`,`nstk_mcap_idx`,`specs_id`,`adjcoeff`,`codeint`)
        select `date`,`time`,`idx_code`,`idx_curr`,`stk_code`,`stk_name`,`stk_curr`,`stk_mult`,`stk_shares_idx`,`stk_float_idx`,`stk_capp_idx`,`stk_price`,
        `curr_conv`,`stk_curr_conv`,`stk_mcap_idx`,`stk_dprice_nr`,`stk_dcurr_conv`,`stk_dprice`,`stk_dcap_idx`,`stk_dcap_nr`,`stk_wgt`,`stk_tr`,`stk_pr`,
        `stk_nr`,`nstk_curr_conv`,`nstk_mcap_idx`,`specs_id`,`adjcoeff`,`codeint` from idx_composition_histoday
        where date <> (select `value` from setting_rt where `key`='calculation_date');";
        $this->db->query($sql);
        
        $sql="insert into tmp_composition (`date`,`time`,`idx_code`,`idx_curr`,`stk_code`,`stk_name`,`stk_curr`,`stk_mult`,`stk_shares_idx`,`stk_float_idx`,
        `stk_capp_idx`,`stk_price`,`curr_conv`,`stk_curr_conv`,`stk_mcap_idx`,`stk_dprice_nr`,`stk_dcurr_conv`,`stk_dprice`,`stk_dcap_idx`,`stk_dcap_nr`,
        `stk_wgt`,`stk_tr`,`stk_pr`,`stk_nr`,`nstk_curr_conv`,`nstk_mcap_idx`,`specs_id`,`adjcoeff`,`codeint`)
        select `date`,`time`,`idx_code`,`idx_curr`,`stk_code`,`stk_name`,`stk_curr`,`stk_mult`,`stk_shares_idx`,`stk_float_idx`,`stk_capp_idx`,`stk_price`,
        `curr_conv`,`stk_curr_conv`,`stk_mcap_idx`,`stk_dprice_nr`,`stk_dcurr_conv`,`stk_dprice`,`stk_dcap_idx`,`stk_dcap_nr`,`stk_wgt`,`stk_tr`,`stk_pr`,
        `stk_nr`,`nstk_curr_conv`,`nstk_mcap_idx`,`specs_id`,`adjcoeff`,`codeint` from idx_composition_intraday;";
        $this->db->query($sql);
        
        $sql="truncate idx_composition_histoday;";
        $this->db->query($sql);
        
        $sql="insert into idx_composition_histoday (`date`,`time`,`idx_code`,`idx_curr`,`stk_code`,`stk_name`,`stk_curr`,`stk_mult`,`stk_shares_idx`,`stk_float_idx`,
        `stk_capp_idx`,`stk_price`,`curr_conv`,`stk_curr_conv`,`stk_mcap_idx`,`stk_dprice_nr`,`stk_dcurr_conv`,`stk_dprice`,`stk_dcap_idx`,`stk_dcap_nr`,
        `stk_wgt`,`stk_tr`,`stk_pr`,`stk_nr`,`nstk_curr_conv`,`nstk_mcap_idx`,`specs_id`,`adjcoeff`,`codeint`)
        select `date`,`time`,`idx_code`,`idx_curr`,`stk_code`,`stk_name`,`stk_curr`,`stk_mult`,`stk_shares_idx`,`stk_float_idx`,`stk_capp_idx`,`stk_price`,
        `curr_conv`,`stk_curr_conv`,`stk_mcap_idx`,`stk_dprice_nr`,`stk_dcurr_conv`,`stk_dprice`,`stk_dcap_idx`,`stk_dcap_nr`,`stk_wgt`,`stk_tr`,`stk_pr`,
        `stk_nr`,`nstk_curr_conv`,`nstk_mcap_idx`,`specs_id`,`adjcoeff`,`codeint` from tmp_composition;";
        $this->db->query($sql);
//================================================================================================
        $sql="delete from stk_prices_histoday where date=(select `value` from setting_rt where `key`='calculation_date');";
        $this->db->query($sql);
        
        $sql="insert into stk_prices_histoday (stk_code,stk_name,stk_rlast,stk_last,stk_price,date,time,ticker,stk_rlast_date,stk_adjcls_date,codeint)
        select stk_code,stk_name,stk_rlast,stk_last,stk_price,date,time,ticker,stk_rlast_date,stk_adjcls_date,codeint from stk_prices_intraday;";
        $this->db->query($sql);
//================================================================================================                
        $sql="delete from stk_feed_histoday where date=(select `value` from setting_rt where `key`='calculation_date');";
        $this->db->query($sql);
        
        $sql="insert into stk_feed_histoday (`symbol`,`name`,`date`,`time`,`last`,`percent`,`change`,`pclose`,`code`,`updateflag`,`source`,`status`)
        select `symbol`,`name`,`date`,`time`,`last`,`percent`,`change`,`pclose`,`code`,`updateflag`,`source`,`status` from stk_feed_intraday;";
        $this->db->query($sql);
		// luu lai thoi gian nhan nut
		$time = date('Y-m-d H:i:s');
		$sql_time="UPDATE settup_process SET `times` = '$time' WHERE id=8";
        $this->db->query($sql_time);
         echo 1;  
    }
    
        public function backup_old() {
        $sql="truncate idx_specs_histoday ;";
        $this->db->query($sql);
       
        $sql="insert into idx_specs_histoday (`idx_code`,`idx_name`,`idx_curr`,`idx_base`,`idx_type`,`idx_mother`,`idx_divisor`,`idx_mcap`,`idx_last`,`date`,`time`,`records`,`calculs`,`publications`,`idx_plast`,`idx_dcap`,`to_adjust`,`idx_mcap_nxt`,`idx_divisor_nxt`,`idx_bbs`,`idx_conv`,`idx_group`,`idx_var`,`idx_pclose`,`ip_last`,`ip_plast`,`idx_dvar`,`nxt_date`,`idx_change`,`idx_dchange`)
        select `idx_code`,`idx_name`,`idx_curr`,`idx_base`,`idx_type`,`idx_mother`,`idx_divisor`,`idx_mcap`,`idx_last`,`date`,`time`,`records`,`calculs`,`publications`,`idx_plast`,`idx_dcap`,`to_adjust`,`idx_mcap_nxt`,`idx_divisor_nxt`,`idx_bbs`,`idx_conv`,`idx_group`,`idx_var`,`idx_pclose`,`ip_last`,`ip_plast`,`idx_dvar`,`nxt_date`,`idx_change`,`idx_dchange` 
        from idx_specs_intraday;";
        $this->db->query($sql);
  //-------------------------------------------------------------------------------------------          
        $sql="truncate idx_composition_histoday;";
        $this->db->query($sql);
        
        $sql="insert into idx_composition_histoday (`date`,`time`,`idx_code`,`idx_curr`,`stk_code`,`stk_name`,`stk_curr`,`stk_mult`,`stk_shares_idx`,`stk_float_idx`,
        `stk_capp_idx`,`stk_price`,`curr_conv`,`stk_curr_conv`,`stk_mcap_idx`,`stk_dprice_nr`,`stk_dcurr_conv`,`stk_dprice`,`stk_dcap_idx`,`stk_dcap_nr`,
        `stk_wgt`,`stk_tr`,`stk_pr`,`stk_nr`,`nstk_curr_conv`,`nstk_mcap_idx`,`specs_id`,`adjcoeff`,`codeint`)
        select `date`,`time`,`idx_code`,`idx_curr`,`stk_code`,`stk_name`,`stk_curr`,`stk_mult`,`stk_shares_idx`,`stk_float_idx`,`stk_capp_idx`,`stk_price`,
        `curr_conv`,`stk_curr_conv`,`stk_mcap_idx`,`stk_dprice_nr`,`stk_dcurr_conv`,`stk_dprice`,`stk_dcap_idx`,`stk_dcap_nr`,`stk_wgt`,`stk_tr`,`stk_pr`,
        `stk_nr`,`nstk_curr_conv`,`nstk_mcap_idx`,`specs_id`,`adjcoeff`,`codeint` from idx_composition_intraday;";
        $this->db->query($sql);
//================================================================================================
        $sql="truncate stk_prices_histoday;";
        $this->db->query($sql);
        
        $sql="insert into stk_prices_histoday (stk_code,stk_name,stk_rlast,stk_last,stk_price,date,time,ticker,stk_rlast_date,stk_adjcls_date,codeint)
        select stk_code,stk_name,stk_rlast,stk_last,stk_price,date,time,ticker,stk_rlast_date,stk_adjcls_date,codeint from stk_prices_intraday;";
        $this->db->query($sql);
//================================================================================================                
        $sql="delete from stk_feed_histoday where date=(select `value` from setting_rt where `key`='calculation_date');";
        $this->db->query($sql);
        
        $sql="insert into stk_feed_histoday (`symbol`,`name`,`date`,`time`,`last`,`percent`,`change`,`pclose`,`code`,`updateflag`,`source`,`status`)
        select `symbol`,`name`,`date`,`time`,`last`,`percent`,`change`,`pclose`,`code`,`updateflag`,`source`,`status` from stk_feed_intraday;";
        $this->db->query($sql);
 //================================================================================================         
        $sql="delete from cur_feed_histoday where date=(select `value` from setting_rt where `key`='calculation_date');";
        $this->db->query($sql);
        
        $sql="insert into cur_feed_histoday (`symbol`,`name`,`date`,`time`,`last`,`percent`,`change`,`pclose`,`code`,`updateflag`,`source`,`status`)
        select `symbol`,`name`,`date`,`time`,`last`,`percent`,`change`,`pclose`,`code`,`updateflag`,`source`,`status` cur_feed_intraday;";
        $this->db->query($sql);
 //================================================================================================                
         $sql="truncate table ind_feed_histoday;";
         $sql="insert into ind_feed_histoday (symbol,`name`,date,time,last,percent,`change`,pclose,`code`,updateflag,source,`status`)
            select symbol,`name`,date,time,last,percent,`change`,pclose,`code`,updateflag,source,`status` from ind_feed_intraday ;";
         $this->db->query($sql);
//================================================================================================  
        $sql="truncate table cmd_feed_histoday;";
        $sql="insert into cmd_feed_histoday (symbol,`name`,date,time,last,percent,`change`,pclose,`code`,updateflag,source,`status`)
        select symbol,`name`,date,time,last,percent,`change`,pclose,`code`,updateflag,source,`status` from cmd_feed_intraday;"; 
        $this->db->query($sql);
        
		// luu lai thoi gian nhan nut
		$time = date('Y-m-d H:i:s');
		$sql_time="UPDATE settup_process SET `times` = '$time' WHERE id=8";
        $this->db->query($sql_time);
         echo 1;  
    }
     public function backup(){
        $this->db->query("drop table if exists idx_specs_histoday;");
        $this->db->query("alter table idx_specs_intraday rename to idx_specs_histoday;");
        $this->db->query("create table idx_specs_intraday like idx_specs_histoday;");
//================================================================================================    
        $this->db->query("drop table if exists idx_composition_histoday;");
        $this->db->query("alter table idx_composition_intraday rename to idx_composition_histoday;");
        $this->db->query("create table idx_composition_intraday like idx_composition_histoday;");
//================================================================================================    
        $this->db->query("drop table if exists stk_prices_histoday;");
        $this->db->query("alter table stk_prices_intraday rename to stk_prices_histoday;");
        $this->db->query("create table stk_prices_intraday like stk_prices_histoday;");
//================================================================================================                
        $sql="delete from stk_feed_histoday where date=(select `value` from setting_rt where `key`='calculation_date');";
        $this->db->query($sql);
        
        $sql="insert into stk_feed_histoday (`symbol`,`name`,`date`,`time`,`last`,`percent`,`change`,`pclose`,`code`,`updateflag`,`source`,`status`)
        select `symbol`,`name`,`date`,`time`,`last`,`percent`,`change`,`pclose`,`code`,`updateflag`,`source`,`status` from stk_feed_intraday;";
        $this->db->query($sql);
 //================================================================================================         
        $sql="delete from cur_feed_histoday where date=(select `value` from setting_rt where `key`='calculation_date');";
        $this->db->query($sql);
        
        $sql="insert into cur_feed_histoday (`symbol`,`name`,`date`,`time`,`last`,`percent`,`change`,`pclose`,`code`,`updateflag`,`source`,`status`)
        select `symbol`,`name`,`date`,`time`,`last`,`percent`,`change`,`pclose`,`code`,`updateflag`,`source`,`status` cur_feed_intraday;";
        $this->db->query($sql);
 //================================================================================================                
         $sql="truncate table ind_feed_histoday;";
         $sql="insert into ind_feed_histoday (symbol,`name`,date,time,last,percent,`change`,pclose,`code`,updateflag,source,`status`)
            select symbol,`name`,date,time,last,percent,`change`,pclose,`code`,updateflag,source,`status` from ind_feed_intraday ;";
         $this->db->query($sql);
//================================================================================================  
        $sql="truncate table cmd_feed_histoday;";
        $sql="insert into cmd_feed_histoday (symbol,`name`,date,time,last,percent,`change`,pclose,`code`,updateflag,source,`status`)
        select symbol,`name`,date,time,last,percent,`change`,pclose,`code`,updateflag,source,`status` from cmd_feed_intraday;"; 
        $this->db->query($sql);
        // luu lai thoi gian nhan nut
		$time = date('Y-m-d H:i:s');
		$sql_time="UPDATE settup_process SET `times` = '$time' WHERE id=8";
        $this->db->query($sql_time);
         echo 1;  
     }
    
	public function exporttxt(){
		
		$sql_index_vnx = "select '' as id, idx_code,date, idx_mother, idx_last, idx_mcap, idx_divisor, idx_curr, 0 as nb 
from idx_specs_rt where provider in ('ifrclab','ifrcresearch','provincial') order by idx_code asc;";

		$sql_compo_vnx = "select '' as id, date as start_date, idx_code , stk_code, stk_name, stk_shares_idx, stk_price as pcls, stk_float_idx,
		 stk_capp_idx, date as end_date,stk_curr, date, stk_wgt  from idx_composition_rt where idx_code in (select idx_mother from idx_specs_rt where provider in 
		('ifrclab','ifrcresearch','provincial') group by idx_mother)";

		$result_index_vnx = $this->db->query($sql_index_vnx)->result_array();
		$result_compo_vnx = $this->db->query($sql_compo_vnx)->result_array();	
	}
	
	function export(){
		
        $this->load->dbutil();
        $query = $this->db->query($sql)->result_array();
			
		$this->dbutil->export_to_txt("{$table_sys}", $query, $aColumnsHeader, null,chr(9), true);	
		die();
		
    }
    
     public function synlinux_host()
    {
		 $this->db2 = $this->load->database('database6', true); //connect LINUX IMSRT
        $start_time = $_POST['start_time']; 
        $end_time = $_POST['end_time'];
         
        $data_specs = $this->db2->query("select idx_code,idx_name,idx_curr,idx_base,idx_type,idx_mother,idx_divisor,idx_mcap,idx_last,date,time,records,calculs,publications,idx_plast,idx_dcap,
to_adjust,idx_mcap_nxt,idx_divisor_nxt,idx_bbs,idx_conv,idx_group,idx_var,idx_pclose,ip_last,ip_plast,idx_dvar,nxt_date,idx_change,idx_dchange 
from idx_specs_intraday where time >='{$start_time}' and time <='{$end_time}';")->result_array();
        $this->db->query("delete from idx_specs_intraday where time >='{$start_time}' and time <='{$end_time}';");
        $this->db->insert_batch('idx_specs_intraday', $data_specs);
//=====================COMPOSITION================================================ 
          $data_compo = $this->db2->query("select date,time,idx_code,idx_curr,stk_code,stk_name,stk_curr,stk_mult,stk_shares_idx,stk_float_idx,stk_capp_idx,stk_price,curr_conv,stk_curr_conv,
stk_mcap_idx,stk_dprice_nr,stk_dcurr_conv,stk_dprice,stk_dcap_idx,stk_dcap_nr,stk_wgt,stk_tr,stk_pr,stk_nr,nstk_curr_conv,nstk_mcap_idx,specs_id,
adjcoeff,codeint from idx_composition_intraday where time >='{$start_time}' and time <='{$end_time}';")->result_array();
        $this->db->query("delete from idx_composition_intraday where time >='{$start_time}' and time <='{$end_time}';");
        $this->db->insert_batch('idx_composition_intraday', $data_compo); 
        //$this->db2->query("truncate idx_composition_clean;");
        //$this->db2->insert_batch('idx_composition_clean', $data_compo);
//====================PRICES=====================================================
		$data_compo = $this->db2->query("select stk_code,stk_name,stk_rlast,stk_last,stk_price,date,time,ticker,stk_rlast_date,stk_adjcls_date,codeint from stk_prices_intraday where time >'{$start_time}' and time <'{$end_time}';")->result_array();
        $this->db->query("delete from stk_prices_intraday where time >'{$start_time}' and time <'{$end_time}';");
        $this->db->insert_batch('stk_prices_intraday', $data_compo);  
        echo "Done!";
        
    }
    public function compare_index_last()
    {
		 $this->db2 = $this->load->database('database6', true); //connect LINUX IMSRT
        $this->db->query("truncate compare_last; ");
        $this->db->query("truncate compare_imsrealtime; ");
        $this->db->query("truncate compare_linux; ");
        
        $period = $this->db->query("select `value` from setting_rt where `key`='period_compare'; ")->row_array();
        $data= $this->db->query("select idx_code, `date`,`time`, idx_last as last1, idx_mcap as capi1, idx_divisor as divisor1 from idx_specs_intraday 
        where time >= time(now() - interval ".$period['value']." minute); ")->result_array();
            if(count($data)>0)
            {
                $this->db->insert_batch('compare_last', $data);  
            }
            else
            {
                echo "Không tìm th?y data nào.";
            }
        $data_linux= $this->db2->query("select idx_code, `date`,`time`, idx_last as last,idx_mcap as capi, idx_divisor as divisor from idx_specs_intraday 
        where time >= time(now() - interval ".$period['value']." minute); ")->result_array();
            if(count($data_linux)>0)
           {
                 $this->db->insert_batch('compare_linux', $data_linux);  
            }
        $data_realtime= $this->db3->query("select idx_code, `date`,`time`, idx_last as last,idx_mcap as capi, idx_divisor as divisor from idx_specs_intraday 
        where time >= time(now() - interval ".$period['value']." minute); ")->result_array();
            if(count($data_realtime)>0)
           {
                 $this->db->insert_batch('compare_imsrealtime', $data_realtime);  
            } 
        $this->db->query("update compare_last as a, compare_linux as b set a.last2=b.last, a.divisor2=b.divisor, a.capi2=b.capi
 where a.idx_code=b.idx_code and a.time=b.time and a.date=b.date; ");
        $this->db->query("update compare_last as a, compare_imsrealtime as b set a.last3=b.last, a.divisor3=b.divisor, a.capi3=b.capi
 where a.idx_code=b.idx_code and a.time=b.time and a.date=b.date; ");
        $this->db->query("update compare_last set last12=if((last1-last2)<>0,1,0), last13=if((last1-last3)<>0,1,0),
         last23=if((last2-last3)<>0,1,0), capi12=if((capi1-capi2)<>0,1,0), capi13=if((capi1-capi3)<>0,1,0),capi23=if((capi2-capi3)<>0,1,0),
				 div12=if((divisor1-divisor2)<>0,1,0),div13=if((divisor1-divisor3)<>0,1,0),div23=if((divisor2-divisor3)<>0,1,0);");
     echo "Done!";
        
    }
    
     public function update_pclose_vndmi()
    {      
		$this->db4 = $this->load->database('database2', true);
		$this->db5 = $this->load->database('database8', true);
        $this->db4->query("truncate table vdm_underlying_pclose;");
        $vndmi_cur= $this->db->query("select `code`,date,last as close from (select * from cur_feed_rt order by `date` desc, `status` desc) as a  group by `code` ;")->result_array();
        if(count($vndmi_cur)>0)
       {
         $this->db4->insert_batch('vdm_underlying_pclose', $vndmi_cur);  
         $this->db4->query("delete a from vdm_underlying_close a left join vdm_underlying_pclose b on a.`code`=b.`code` and a.`date`=b.`date` where a.`code`=b.`code` and a.`date`=b.`date`;;");
         $this->db4->query("insert into vdm_underlying_close(`code`,date,`close`)
    select s.`code`,s.date,s.`close` from vdm_underlying_pclose as s left join vdm_underlying_close as n  on n.`code` = s.`code` 
    and n.date=s.date where (n.`code` is null or n.date is null) and left(s.code,3)='CUR';");
    }
// ------------------------------------------------------------------------------
        $this->db4->query("truncate table vdm_underlying_pclose;");
        $vndmi_stk= $this->db->query("select `code`,date,last as close from (select * from stk_feed_rt order by `date` desc,`status` desc) as a  group by `code`; ")->result_array();
        if(count($vndmi_stk)>0)
       {
         $this->db4->insert_batch('vdm_underlying_pclose', $vndmi_stk);  
         $this->db4->query("delete a from vdm_underlying_close a left join vdm_underlying_pclose b on a.`code`=b.`code` and a.`date`=b.`date` where a.`code`=b.`code` and a.`date`=b.`date`;;");
         $this->db4->query("insert into vdm_underlying_close(`code`,date,`close`)
select s.`code`,s.date,s.`close` from vdm_underlying_pclose as s left join vdm_underlying_close as n  on n.`code` = s.`code` 
and n.date=s.date where (n.`code` is null or n.date is null) and left(s.code,3)='STK';");
         
      }  
// ------------------------------------------------------------------------------
        $this->db4->query("truncate table vdm_underlying_pclose;");
        $vndmi_cmd= $this->db->query("select `code`,date,last as close from (select * from cmd_feed_rt order by `date` desc,`status` desc) as a  group by `code`; ")->result_array();
        if(count($vndmi_cmd)>0)
       {
         $this->db4->insert_batch('vdm_underlying_pclose', $vndmi_cmd);  
         $this->db4->query("delete a from vdm_underlying_close a left join vdm_underlying_pclose b on a.`code`=b.`code` and a.`date`=b.`date` where a.`code`=b.`code` and a.`date`=b.`date`;;");
         $this->db4->query("insert into vdm_underlying_close(`code`,date,`close`)
select s.`code`,s.date,s.`close` from vdm_underlying_pclose as s left join vdm_underlying_close as n  on n.`code` = s.`code` 
and n.date=s.date where (n.`code` is null or n.date is null) and left(s.code,3)='CMD';"); 
      } 
// ------------------------------------------------------------------------------
        $this->db4->query("truncate table vdm_underlying_pclose;");
        $vndmi_idx= $this->db->query("select codeint `code`,date,idx_last as close from (select * from idx_specs_rt order by `date` desc) as a  group by `code` ; ")->result_array();
        if(count($vndmi_idx)>0)
       {
         $this->db4->insert_batch('vdm_underlying_pclose', $vndmi_idx);  
         $this->db4->query("delete a from vdm_underlying_close a left join vdm_underlying_pclose b on a.`code`=b.`code` and a.`date`=b.`date` where a.`code`=b.`code` and a.`date`=b.`date`;;");
         $this->db4->query("insert into vdm_underlying_close(`code`,date,`close`)
select s.`code`,s.date,s.`close` from vdm_underlying_pclose as s left join vdm_underlying_close as n  on n.`code` = s.`code` 
and n.date=s.date where (n.`code` is null or n.date is null) and left(s.code,3)='IND';"); 
      } 
// ------------------------------------------------------------------------------
        $this->db4->query("truncate table vdm_underlying_pclose;");
        $vndmi_ind= $this->db->query("select `code`,date,`last` as `close` from (select * from ind_feed_rt order by `date` desc) as a  group by `code`; ")->result_array();
        if(count($vndmi_ind)>0)
       {
         $this->db4->insert_batch('vdm_underlying_pclose', $vndmi_ind);  
         $this->db4->query("delete a from vdm_underlying_close a left join vdm_underlying_pclose b on a.`code`=b.`code` and a.`date`=b.`date` where a.`code`=b.`code` and a.`date`=b.`date`;;");
         $this->db4->query("insert into vdm_underlying_close(`code`,date,`close`)
select s.`code`,s.date,s.`close` from vdm_underlying_pclose as s left join vdm_underlying_close as n  on n.`code` = s.`code` 
and n.date=s.date where (n.`code` is null or n.date is null) and left(s.code,3)='IND';"); 
      }  
// ------------------------------------------------------------------------------
        $this->db4->query("truncate table vdm_underlying_pclose;");
        $vnefrc_cmd= $this->db5->query("select `code`,date,`close` from (select * from efrc_cmd_data order by `date` desc) as a  group by `code`;  ")->result_array();
        if(count($vnefrc_cmd)>0)
       {
         $this->db4->insert_batch('vdm_underlying_pclose', $vnefrc_cmd);  
         $this->db4->query("delete a from vdm_underlying_close a left join vdm_underlying_pclose b on a.`code`=b.`code` and a.`date`=b.`date` where a.`code`=b.`code` and a.`date`=b.`date`;;");
         $this->db4->query("insert into vdm_underlying_close(`code`,date,`close`)
select s.`code`,s.date,s.`close` from vdm_underlying_pclose as s left join vdm_underlying_close as n  on n.`code` = s.`code` 
and n.date=s.date where (n.`code` is null or n.date is null) and left(s.code,3)='CMD';"); 
      }   
        $this->db4->query("drop table if EXISTS phuong_close ;");
        $this->db4->query("create table phuong_close select `code`,date,`close` from (select `code`,date,`close` from vdm_underlying_close order by `code` desc, `date` desc) as b group by `code`;");
        $this->db4->query("truncate table vdm_underlying_close;");
        $this->db4->query("insert into vdm_underlying_close (`code`,date,`close`) select `code`,date,`close` from phuong_close;  ");
         
      // luu lai thoi gian nhan nut
		$time = date('Y-m-d H:i:s');
		$sql_time="UPDATE settup_process SET `times` = '$time' WHERE id=9";
        $this->db->query($sql_time);
         echo 1;      
        
    }
     public function backup_eod()
    {  
	
        $date_number = $this->db->query("select DISTINCT date from idx_specs_rt_history;")->result_array();
         if (count($date_number)>= 10) {
            $date_delete = $this->db->query("select min(date) date from idx_specs_rt_history where date<> '0000-00-00';")->row_array();
            $this->db->query("delete from idx_specs_rt_history where date='0000-00-00' or date='" . $date_delete['date']."';");
        }
        $date_sp = $this->db->query("select distinct date from idx_specs_rt; ")->row_array();
        $idx_specs_rt = $this->db->select("idx_code,idx_name,idx_curr,idx_base,idx_type,idx_mother,idx_divisor,idx_mcap,idx_last,date,time,records,calculs,
publications,idx_plast,idx_dcap,to_adjust,idx_mcap_nxt,idx_divisor_nxt,idx_bbs,idx_conv,idx_pclose,idx_group,idx_var,ip_last,ip_plast,idx_dvar,nxt_date,
idx_change,idx_dchange,next_divisor_adjust,final_divisor,temp_plast,provider,type,codeint")->get("idx_specs_rt")->result_array();
         $this->db->query("delete from idx_specs_rt_history where date='" . $date_sp['date']."';");
         $this->db->insert_batch('idx_specs_rt_history', $idx_specs_rt);
		 
//====================================================================================
    $date_number = $this->db->query("select DISTINCT date from idx_composition_rt_history;")->result_array();
         if (count($date_number)>= 10) {
            $date_delete = $this->db->query("select min(date) date from idx_composition_rt_history where date<> '0000-00-00';")->row_array();
            $this->db->query("delete from idx_composition_rt_history where date='0000-00-00' or date='" . $date_delete['date']."';");
        }       
        $date_cp = $this->db->query("select distinct date from idx_composition_rt; ")->row_array();
        $idx_compo_rt = $this->db->select("date,time,idx_code,idx_curr,stk_code,stk_name,stk_curr,stk_mult,stk_shares_idx,stk_float_idx,stk_capp_idx,stk_price,
curr_conv,stk_curr_conv,stk_mcap_idx,stk_dprice_nr,stk_dcurr_conv,stk_dprice,stk_dcap_idx,stk_dcap_nr,stk_wgt,stk_tr,stk_pr,stk_nr,nstk_curr_conv,
nstk_mcap_idx,specs_id,adjcoeff,codeint,stk_pclose,dvar")->get("idx_composition_rt")->result_array();
         $this->db->query("delete from idx_composition_rt_history where date='" . $date_cp['date']."';");
         $this->db->insert_batch('idx_composition_rt_history', $idx_compo_rt);
		
//====================================================================================
    $date_number = $this->db->query("select DISTINCT date from stk_prices_rt_history;")->result_array();
         if (count($date_number)>= 10) {
            $date_delete = $this->db->query("select min(date) date from stk_prices_rt_history where date<> '0000-00-00';")->row_array();
            $this->db->query("delete from stk_prices_rt_history where date='0000-00-00' or date='" . $date_delete['date']."';");
        }       
        $date_price = $this->db->query("select distinct date from stk_prices_rt; ")->row_array();
        $idx_prics_rt = $this->db->select("stk_code,stk_name,stk_rlast,stk_last,stk_price,date,time,ticker,stk_rlast_date,stk_adjcls_date,codeint,update_flag")->get("stk_prices_rt")->result_array();
         $this->db->query("delete from stk_prices_rt_history where date='" . $date_price['date']."';");
         $this->db->insert_batch('stk_prices_rt_history', $idx_prics_rt);
		// echo "<pre>";print_r('hungdaica5');exit;  
//====================================================================
	    $sql="delete from stk_feed_histoday where date=(select `value` from setting_rt where `key`='calculation_date');";
        $this->db->query($sql);
        $sql="insert into stk_feed_histoday (`symbol`,`name`,`date`,`time`,`last`,`percent`,`change`,`pclose`,`code`,`updateflag`,`source`,`status`)
        select `symbol`,`name`,`date`,`time`,`last`,`percent`,`change`,`pclose`,`code`,`updateflag`,`source`,`status` from stk_feed_intraday;";
        $this->db->query($sql);
		
     // luu lai thoi gian nhan nut
		$time = date('Y-m-d H:i:s');
		$sql_time="UPDATE settup_process SET `times` = '$time' WHERE id=10";
        $this->db->query($sql_time);
         echo 1;      
        
    }

}
























