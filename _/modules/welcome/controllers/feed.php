<?php

class Feed extends Welcome{
    public function __construct() {
        parent::__construct();
		$this->load->model('Dashboard_model', 'dash');	
    }
    
    public function index() {
		$imsrt_status = $this->dash->get_imsrt_status();
		$close_status = $this->dash->get_close_status();
		$after_close_calculation = $this->dash->get_after_close_calculation();
        $auto_download = $this->dash->get_Auto_Download_Feed();
		$frequency = $this->dash->get_auto_download_feed_frequency();	
		$arr_frequency = explode(":",$frequency["value"]);
		$fre = $arr_frequency[0]*60 + $arr_frequency[1];
		$i = 0;
		$k = 60/$fre;
		while ($i<$k) {
			$start_second = microtime(true)*1000;
			$date= date('H:i:s');					
				
		/*$sql = "truncate table cur_feed_rt_temp;";
		$this->db->simple_query($sql);
		$command = "load data infile 'efrc_cur_blg_feed.txt' into table `cur_feed_rt_temp` character set utf8 fields terminated by  '\t'  lines terminated by  '\r\n' (code, currency,tos,curr_conv,date,time);";
		$this->db->query($command);
		$sql_update ="update cur_feed_rt as a INNER JOIN cur_feed_rt_temp as b ON a.`code`=CONCAT('CUR',b.`code`) and ((b.date > a.date) OR (b.date=a.date and b.time > a.time)) AND (a.`status` IS NULL OR a.`status` != 'C')
set a.last=b.curr_conv,a.time=b.time, a.date=b.date, a.updateflag=1;";
		$this->db->query($sql_update);
		$sql_insert ="INSERT INTO cur_feed_rt(`symbol`,`date`,`time`,`last`,`code`,updateflag)
		SELECT 
			b.`code`,b.date,b.time,b.curr_conv, CONCAT('CUR',b.`code`) as codeint,1
		FROM
			cur_feed_rt_temp AS b
		LEFT OUTER JOIN cur_feed_rt as r ON  r.`code` = CONCAT('CUR',b.`code`) 
		left OUTER JOIN ( select `code`,COUNT(*) as total from cur_feed_rt group by `code`) as t ON t.`code` = CONCAT('CUR',b.`code`) 
		where (r.`code` IS NULL and r.`status` IS NULL) OR (r.`status`='C' and t.total =1 ) ;";
		$this->db->query($sql_insert);	*/	
		//feed
		if (file_exists('/var/lib/mysql/imsrt/efrc_stk_inv_feed.txt')) {
				$sql = "truncate table stk_feed_rt_tempt;";		
				$this->db->simple_query($sql);
				$command = "load data infile 'efrc_stk_inv_feed.txt' into table `stk_feed_rt_tempt` character set utf8 fields terminated by  '\t'  lines terminated by  '\r\n' (`symbol`, `date`,`time`,`last`,`code`,`source`);";
				$this->db->query($command);
				/*$sql_update ="update stk_feed_rt_tempt set date = (select `value` from setting_rt where `key`='calculation_date');";
				$this->db->query($sql_update);*/
				
				$sql_update ="update stk_feed_rt as a INNER JOIN stk_feed_rt_tempt as b ON a.`symbol`=b.`symbol` and ((b.date > a.date) OR (b.date=a.date and b.time > a.time) OR (b.date=a.date and b.time = a.time and b.last<>a.last)) AND (a.`status` IS NULL OR a.`status` != 'C') 
	set a.last=b.last,a.time=b.time, a.date=b.date,a.updateflag=1,a.update_time='".$date."', a.`source`=b.`source`";
			$this->db->query($sql_update);
			$sql_insert ="INSERT INTO stk_feed_rt(`symbol`,`date`,`time`,`last`,`code`,updateflag,update_time,`source`)
			SELECT 
				b.`symbol`,b.date,b.time,b.last, b.`code`,1,'".$date."',b.`source`
			FROM
				stk_feed_rt_tempt AS b
			LEFT OUTER JOIN stk_feed_rt as r ON  r.`symbol` = b.`symbol`
			left OUTER JOIN ( select `symbol`,COUNT(*) as total from stk_feed_rt group by `symbol`) as t ON t.`symbol` = b.`symbol`
			where ((r.`symbol` IS NULL and r.`status` IS NULL) OR (r.`status`='C' and t.total =1 )) and (b.date >= curdate()) group by  b.`symbol` ; ";
			$this->db->query($sql_insert);
			$sql = "update stk_feed_rt set `change`=`last`-pclose,percent=100*((last/pclose)-1); ";
			$this->db->query($sql);
		}
		else {
			$sql = "truncate table stk_feed_rt_tempt;";		
			$this->db->simple_query($sql);
		}
		if(($imsrt_status["value"]=='CLOSING')&&(int)$close_status["value"] <= (int)$after_close_calculation["value"]){
			$sql_update ="update stk_prices_rt as a INNER JOIN stk_feed_rt as b ON a.codeint=b.`code` 
set a.stk_last=b.last, a.update_flag=1 where b.`status`='C'";
			$this->db->query($sql_update);	
		}
		else if ($imsrt_status["value"]=='CALCULATING'){
			$sql_update ="update stk_prices_rt as a INNER JOIN stk_feed_rt as b ON a.codeint=b.`code` and ((b.date > a.date) OR (b.date=a.date and b.time > a.time) OR (b.date=a.date and b.time = a.time and b.last<>a.stk_last))
set a.stk_last=b.last,a.time=b.time, a.update_flag=1, a.date=b.date where (b.`status` IS NULL OR b.`status` != 'C') ;";
			$this->db->query($sql_update);	
		}
		//curency global
		/*$sql = "truncate table cur_rates_glb_rt_tm;";
		$this->db->simple_query($sql);
		$command = "load data infile 'efrc_cur_glb_feed2.txt' into table `cur_rates_glb_rt_tm` character set utf8 fields terminated by  '\t'  lines terminated by  '\r\n' (ticker,updated,hst_plastd,hst_plast,hst_lastd,hst_last,hst_vol,rt1_plastd,rt1_plast,rt1_lastd,rt1_lastt,rt1_last);";
		$this->db->query($command);
		$sql_update ="update cur_feed_rt as a INNER JOIN cur_rates_glb_rt_tm as b ON a.`code`=b.ticker and ((b.rt1_lastd > a.date) OR (b.rt1_lastd=a.date and b.rt1_lastt > a.time))
set a.last=b.rt1_last,a.time=b.rt1_lastt, a.date=b.rt1_lastd;";
		$this->db->query($sql_update);*/
		/*$sql_insert ="INSERT INTO cur_feed_rt(`code`,currency,tos,curr_conv,date,time,codeint)
		SELECT 
			b.`code`,b.currency,b.tos,b.curr_conv,b.date,b.time,CONCAT('CUR',b.`code`) as codeint
		FROM
			cur_rates_glb_rt_tm AS b
		LEFT OUTER JOIN cur_feed_rt as r ON  r.`code` = b.`code`
		where r.`code` IS NULL GROUP BY b.`code`;";
		$this->db->query($sql_insert);*/
		//feed global
		/*$sql = "truncate table stk_feed_global_rt;";
		$this->db->simple_query($sql);
		$command = "load data infile 'efrc_stk_glb_feed.txt' into table `stk_feed_global_rt` character set utf8 fields terminated by  '\t'  lines terminated by  '\r\n' (ticker,updated,hst_plastd,hst_plast,hst_lastd,hst_last,hst_vol,rt1_plastd,rt1_plast,rt1_lastd,rt1_lastt,rt1_last);";
		$this->db->query($command);
		$sql_update ="update stk_prices_rt as a INNER JOIN (select ins.`code`,fd.rt1_lastd, fd.rt1_lastt, fd.rt1_last from stk_feed_global_rt as fd INNER JOIN efrc_ins_ref as ins ON fd.ticker=ins.blg) as b ON a.codeint=b.`code` and ((b.rt1_lastd > a.date) OR (b.rt1_lastd=a.date and b.rt1_lastt > a.time))
set a.stk_last=b.rt1_last,a.time=b.rt1_lastt, a.date = b.rt1_lastd,a.update_flag=1;";
		$this->db->query($sql_update);*/
		//cur_feed_intraday
		/*$sql_update_intraday ="INSERT INTO cur_feed_intraday(`symbol`,`date`,`time`,`last`,`code`)
 (SELECT `symbol`,`date`,`time`,`last`,`code` from cur_feed_rt where updateflag=1);";
		$this->db->query($sql_update_intraday);	
		$sql_update_flag ="update cur_feed_rt set updateflag=0 ;";
		$this->db->query($sql_update_flag);*/
		//feed intraday
		$sql_update_intraday ="INSERT INTO stk_feed_intraday(`symbol`,`date`,`time`,`last`,`code`,`update_time`,`source`)
 (SELECT `symbol`,`date`,`time`,`last`,`code`,`update_time`,`source` from stk_feed_rt where updateflag=1);";
		$this->db->query($sql_update_intraday);	
		$sql_update_flag ="update stk_feed_rt set updateflag=0 ;";
		$this->db->query($sql_update_flag);	
		$end_second = microtime(true)*1000;				
		$totaltime = round(($end_second - $start_second)/1000,6);
		$i ++;
		usleep (($fre-$totaltime)*1000000);
	}		
       // var_export($result);
    }
}