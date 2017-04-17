<?php

class Feed_host extends Welcome{
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
		set_time_limit(300);
		$i = 0;
		$k = 60/$fre;
		while ($i<$k) {
			$start_second = microtime(true)*1000;
			$date= date('H:i:s');
		/*$sql = "truncate table cur_feed_rt_temp;";
		$this->db->simple_query($sql);
		$command = "LOAD DATA LOCAL INFILE 'ftp_upload/efrc_cur_blg_feed.txt' into table `cur_feed_rt_temp` character set utf8 fields terminated by  '\t'  lines terminated by  '\r\n' (code, currency,tos,curr_conv,date,time);";
		$dbh->query($command);
		$sql_update ="update cur_feed_rt as a INNER JOIN cur_feed_rt_temp as b ON a.`code`=CONCAT('CUR',b.`code`) and ((b.date > a.date) OR (b.date=a.date and b.time > a.time)) AND (a.`status` IS NULL OR a.`status` != 'C')
set a.last=b.curr_conv,a.time=b.time, a.date=b.date;";
		$this->db->query($sql_update);
		$sql_insert ="INSERT INTO cur_feed_rt(`symbol`,`date`,`time`,`last`,`code`)
		SELECT 
			b.`code`,b.date,b.time,b.curr_conv, CONCAT('CUR',b.`code`) as codeint
		FROM
			cur_feed_rt_temp AS b
		LEFT OUTER JOIN cur_feed_rt as r ON  r.`code` = CONCAT('CUR',b.`code`) 
		left OUTER JOIN ( select `code`,COUNT(*) as total from cur_feed_rt group by `code`) as t ON t.`code` = CONCAT('CUR',b.`code`) 
		where (r.`code` IS NULL and r.`status` IS NULL) OR (r.`status`='C' and t.total =1 ) ;";
		$this->db->query($sql_insert);	*/	
		//feed
		if (file_exists('ftp_upload/efrc_stk_inv_feed.txt')) {
				$sql = "truncate table stk_feed_rt_tempt;";		
				$this->db->simple_query($sql);
				$command = "LOAD DATA LOCAL INFILE 'ftp_upload/efrc_stk_inv_feed.txt' into table `stk_feed_rt_tempt` character set utf8 fields terminated by  '\t'  lines terminated by  '\r\n' (symbol, date,time,last,code,`source`);";
				$this->db->query($command);
				/*$sql_update ="update stk_feed_rt_tempt set date = (select `value` from setting_rt where `key`='calculation_date');";
				$this->db->query($sql_update);*/
				
				$sql_update ="update stk_feed_rt as a INNER JOIN stk_feed_rt_tempt as b ON a.`code`=b.`code` and ((b.date > a.date) OR (b.date=a.date and b.time > a.time) OR (b.date=a.date and b.time = a.time and b.last<>a.last)) AND (a.`status` IS NULL OR a.`status` != 'C') 
	set a.last=b.last,a.time=b.time, a.date=b.date,a.updateflag=1,a.update_time='".$date."',a.`source`=b.`source` ";
			$this->db->query($sql_update);
			$sql_insert ="INSERT INTO stk_feed_rt(`symbol`,`date`,`time`,`last`,`code`,`updateflag`,`update_time`,`source`)
			SELECT 
				b.`symbol`,b.date,b.time,b.last, b.`code`,1,'".$date."', b.`source`
			FROM
				stk_feed_rt_tempt AS b
			LEFT OUTER JOIN stk_feed_rt as r ON  r.`code` = b.`code`
			left OUTER JOIN ( select `code`,COUNT(*) as total from stk_feed_rt group by `code`) as t ON t.`code` = b.`code`
			where ((r.`code` IS NULL and r.`status` IS NULL) OR (r.`status`='C' and t.total =1 )) and (b.date >= curdate()) group by  b.`symbol`; ";
			$this->db->query($sql_insert);
			$sql = "update stk_feed_rt set `change`=`last`-pclose,percent=100*((last/pclose)-1); ";
			$this->db->query($sql);
		}
		else {
			$sql = "truncate table stk_feed_rt_tempt;";		
			$this->db->simple_query($sql);
		}
		if(($imsrt_status["value"]=='CLOSING')&&((int)$close_status["value"] <= (int)$after_close_calculation["value"])){
			$sql_update ="update stk_prices_rt as a INNER JOIN stk_feed_rt as b ON a.codeint=b.`code` 
set a.stk_last=b.last, a.update_flag=1 where b.`status`='C'";
			$this->db->query($sql_update);	
			/*$sql = "update stk_prices_rt set dvar=100*((stk_price/stk_rlast)-1); ";
			$this->db->query($sql);*/
		}
		else if ($imsrt_status["value"]=='CALCULATING'){
			$sql_update ="update stk_prices_rt as a INNER JOIN stk_feed_rt as b ON a.codeint=b.`code` and ((b.date > a.date) OR (b.date=a.date and b.time > a.time) OR (b.date=a.date and b.time = a.time and b.last<>a.stk_last))
set a.stk_last=b.last,a.time=b.time, a.update_flag=1, a.date=b.date where (b.`status` IS NULL OR b.`status` != 'C') ;";
			$this->db->query($sql_update);	
			/*$sql = "update stk_prices_rt set dvar=100*((stk_price/stk_rlast)-1); ";
			$this->db->query($sql);*/
		}
		
		//feed intraday
		$sql_update_intraday ="INSERT INTO stk_feed_intraday(`symbol`,`date`,`time`,`last`,`code`,`update_time`,`source`)
 (SELECT `symbol`,`date`,`time`,`last`,`code`,`update_time`,`source` from stk_feed_rt where updateflag=1);";
		$this->db->query($sql_update_intraday);	
		$sql_update_flag ="update stk_feed_rt set updateflag=0 ;";
		$this->db->query($sql_update_flag);
		$end_second = microtime(true)*1000;				
		$totaltime = round(($end_second - $start_second)/1000,6);
		$i ++;
		usleep (($fre-$totaltime)*1000000);// cho ngu de du 30s, vi du neu chay 20s thi ngu 10s, neu chay 5s thi ngu 25s
	}
				
       // var_export($result);
    }
    
}