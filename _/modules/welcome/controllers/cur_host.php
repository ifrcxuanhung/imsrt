<?php

class Cur_host extends Welcome{
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
				if (file_exists('ftp_upload/efrc_cur_blg_feed.txt')) {
					$sql = "truncate table cur_feed_rt_temp;";
					$this->db->simple_query($sql);
					$command = "LOAD DATA LOCAL INFILE 'ftp_upload/efrc_cur_blg_feed.txt' into table `cur_feed_rt_temp` character set utf8 fields terminated by  '\t'  lines terminated by  '\r\n' (code, currency,tos,curr_conv,date,time);";
					$this->db->query($command);
                    
// INSERT 2 ROWS FOR VND======================================
                $this->db->query("set @USDJPY= (select curr_conv from cur_feed_rt_temp where `code`='USDJPY' group by `code`);");
                $this->db->query("set @USDVND= (select curr_conv from cur_feed_rt_temp where `code`='USDVND' group by `code`);");
                $this->db->query("set @USDEUR= (select curr_conv from cur_feed_rt_temp where `code`='USDEUR' group by `code`);");
                $this->db->query("set @JPYVND= @USDVND/@USDJPY;");
                $this->db->query("set @EURVND= @USDVND/@USDEUR;");
                $this->db->query("insert into cur_feed_rt_temp(`code`,currency,tos,date,time,curr_conv)
                select * from (select 'JPYVND' as `code`,'JPY' as currency,'VND' as tos,CURRENT_DATE() as date,CURRENT_TIME() time, @JPYVND as curr_conv 
                UNION
                select 'EURVND' as `code`,'EUR' as currency,'VND' as tos,CURRENT_DATE() as date,CURRENT_TIME() time, @EURVND as curr_conv) as tmp1 where curr_conv is not null;");
// END======================================================
                    
					$sql_update ="update cur_feed_rt as a INNER JOIN cur_feed_rt_temp as b ON a.`code`=CONCAT('CUR',b.`code`) and ((b.date > a.date) OR (b.date=a.date and b.time > a.time)) AND (a.`status` IS NULL OR a.`status` != 'C')
			set a.last=b.curr_conv,a.time=b.time, a.date=b.date, a.updateflag=1;";
					$this->db->query($sql_update);
					$sql_insert ="INSERT INTO cur_feed_rt(`symbol`,`date`,`time`,`last`,`code`,`updateflag`)
					SELECT 
						b.`code`,b.date,b.time,b.curr_conv, CONCAT('CUR',b.`code`) as codeint,1
					FROM
						cur_feed_rt_temp AS b
					LEFT OUTER JOIN cur_feed_rt as r ON  r.`code` = CONCAT('CUR',b.`code`) 
					left OUTER JOIN ( select `code`,COUNT(*) as total from cur_feed_rt group by `code`) as t ON t.`code` = CONCAT('CUR',b.`code`) 
					where (r.`code` IS NULL and r.`status` IS NULL) OR (r.`status`='C' and t.total =1 ) ;";
					$this->db->query($sql_insert);	
// UPDATE 3 ROWS FOR VND======================================              
                $this->db->query("set @USDJPY= (select last from cur_feed_rt where `symbol`='USDJPY' group by `symbol`);");
                $this->db->query("set @USDVND= (select last from cur_feed_rt where `symbol`='USDVND' group by `symbol`);");
                $this->db->query("set @USDEUR= (select last from cur_feed_rt where `symbol`='USDEUR' group by `symbol`);");
                $this->db->query("set @JPYVND= @USDVND/@USDJPY;");
                $this->db->query("set @EURVND= @USDVND/@USDEUR;");
                $this->db->query("update cur_feed_rt as a,(select 'JPYVND' as `code`,'JPY' as currency,'VND' as tos,(select max(date) from cur_feed_rt)  as date,
                (select time from cur_feed_rt where `symbol`='USDVND' group by `symbol`) time, @JPYVND as last 
                UNION
                select 'EURVND' as `code`,'EUR' as currency,'VND' as tos,(select max(date) from cur_feed_rt) as date,(select time 
                from cur_feed_rt where `symbol`='USDVND' group by `symbol`) time, @EURVND as last) as b 
                set a.last=b.last,a.date=b.date, a.time=b.time where a.symbol=b.`code` and a.`status`!='C';");
// END======================================================  
				}
				else {
					$sql = "truncate table cur_feed_rt_temp;";
					$this->db->simple_query($sql);
				}
				//curency global
				/*$sql = "truncate table cur_rates_glb_rt_tm;";
				$this->db->simple_query($sql);
				$command = "LOAD DATA LOCAL INFILE 'ftp_upload/efrc_cur_glb_feed2.txt' into table `cur_rates_glb_rt_tm` character set utf8 fields terminated by  '\t'  lines terminated by  '\r\n' (ticker,updated,hst_plastd,hst_plast,hst_lastd,hst_last,hst_vol,rt1_plastd,rt1_plast,rt1_lastd,rt1_lastt,rt1_last);";
				$this->db->query($command);
				$sql_update ="update cur_feed_rt as a INNER JOIN cur_rates_glb_rt_tm as b ON a.code=b.ticker and ((b.rt1_lastd > a.date) OR (b.rt1_lastd=a.date and b.rt1_lastt > a.time))
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
				//efrc_ind_vn
				if (file_exists('ftp_upload/efrc_ind_vn_feed.txt')) {
					$sql = "truncate table efrc_ind_vn;";
					$this->db->simple_query($sql);
					$command = "LOAD DATA LOCAL INFILE 'ftp_upload/efrc_ind_vn_feed.txt' into table `efrc_ind_vn` character set utf8 fields terminated by  '\t'  lines terminated by  '\r\n' (`name`,`index`,`percent`,`change`,`codeint`);";
					$this->db->query($command);				
					$sql_update_flag ="update efrc_ind_vn set date='".date('Y-m-d')."' , time= '".date('H:i:s')."';";
					$this->db->query($sql_update_flag);	
					$sql_update ="update ind_feed_rt as a INNER JOIN efrc_ind_vn as b ON a.`code`=b.`codeint` 
		set a.last=b.`index`,a.time=b.time, a.date=b.date, a.`percent`=b.`percent`,a.`change`=b.`change`, a.updateflag=1; ";
					$this->db->query($sql_update);
					$sql_insert ="
					INSERT INTO ind_feed_rt(`symbol`,`date`,`time`,`last`,`percent`, `change`,`code`,`updateflag`)
					SELECT 
						b.`name`,b.date,b.time,b.`index`,b.`percent`,b.`change`,b.`codeint`,1
					FROM
						efrc_ind_vn AS b
					LEFT OUTER JOIN ind_feed_rt as r ON  r.`code` = b.`codeint`
					where r.`code` IS NULL GROUP BY b.`codeint`;";
					$this->db->query($sql_insert);
				}
				else {
					$sql = "truncate table efrc_ind_vn;";
					$this->db->simple_query($sql);
				}
				//cmd
				if (file_exists('ftp_upload/efrc_cmd_quotenet.txt')) {
					$sql = "truncate table cmd_feed_rt_tempt;";
					$this->db->simple_query($sql);
					$command = "LOAD DATA LOCAL INFILE 'ftp_upload/efrc_cmd_quotenet.txt' into table `cmd_feed_rt_tempt` character set utf8 fields terminated by  '\t'  lines terminated by  '\r\n' (`symbol`,`name`,`date`,`time`,`last`,`percent`,`change`,`pclose`,`code`);";
					$this->db->query($command);
					$sql_update ="update cmd_feed_rt as a INNER JOIN cmd_feed_rt_tempt as b ON a.`code`=b.`code` and ((b.date > a.date) OR (b.date=a.date)) 
		set a.last=b.`last`,a.time=b.time, a.date=b.date,a.percent=b.percent,a.`change`=b.`change`, a.updateflag=1;";
					$this->db->query($sql_update);
					$sql_update ="update cmd_feed_rt as a INNER JOIN cmd_feed_rt_tempt as b ON a.`code`=b.`code` and ((b.date > a.date) OR (b.date=a.date)) and (b.pclose<>0) 
		set  a.pclose=b.pclose;";
					$this->db->query($sql_update);
					$sql_insert ="INSERT INTO cmd_feed_rt(`symbol`,`name`,`date`,`time`,`last`,`percent`, `change`,`code`,`pclose`,`updateflag`)
					SELECT 
						b.`symbol`,b.`name`,b.date,b.time,b.`last`,b.`percent`,b.`change`,b.`code`,b.pclose,1
					FROM
						cmd_feed_rt_tempt AS b
					LEFT OUTER JOIN cmd_feed_rt as r ON  r.`code` = b.`code`
					where r.`code` IS NULL GROUP BY b.`code`;";
					$this->db->query($sql_insert);	
				}
				else {
					$sql = "truncate table cmd_feed_rt_tempt;";
					$this->db->simple_query($sql);
				}
				//cur_feed_intraday
				$sql_update_intraday ="INSERT INTO cur_feed_intraday(`symbol`,`date`,`time`,`last`,`code`)
				 (SELECT `symbol`,`date`,`time`,`last`,`code` from cur_feed_rt where updateflag=1);";
						$this->db->query($sql_update_intraday);	
						$sql_update_flag ="update cur_feed_rt set updateflag=0 ;";
						$this->db->query($sql_update_flag);	
				//cmd_feed_intraday
				$sql_update_intraday ="INSERT INTO cmd_feed_intraday(`symbol`,`name`,`date`,`time`,`last`,`percent`, `change`,`code`,`pclose`)
				 (SELECT `symbol`,`name`,`date`,`time`,`last`,`percent`, `change`,`code`,`pclose` from cmd_feed_rt where updateflag=1);";
						$this->db->query($sql_update_intraday);	
						$sql_update_flag ="update cmd_feed_rt set updateflag=0 ;";
						$this->db->query($sql_update_flag);	
				//ind_feed_indaday
				$sql_update_intraday ="INSERT INTO ind_feed_intraday(`symbol`,`date`,`time`,`last`,`percent`, `change`,`code`)
				 (SELECT `symbol`,`date`,`time`,`last`,`percent`, `change`,`code` from ind_feed_rt where updateflag=1);";
						$this->db->query($sql_update_intraday);	
						$sql_update_flag ="update ind_feed_rt set updateflag=0 ;";
						$this->db->query($sql_update_flag);
		//								
			$end_second = microtime(true)*1000;				
			$totaltime = round(($end_second - $start_second)/1000,6);
			$i ++;
			usleep (($fre-$totaltime)*1000000);
		}
    }
    
}