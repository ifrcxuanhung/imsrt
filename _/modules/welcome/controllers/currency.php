<?php

class Currency{
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
		$k = 300/$fre_hsx;
		set_time_limit(300);
		$host = "localhost"; // If you don't know what your host is, it's safe to leave it localhost
		$dbName = "imsrt"; // Database name
		$dbUser = "root"; // Username
		$dbPass = "ifrcvn"; // Password

		$dbh = new PDO("mysql:host={$host};dbname={$dbName}", $dbUser, $dbPass,array( PDO::ATTR_PERSISTENT => false, PDO::MYSQL_ATTR_USE_BUFFERED_QUERY=>true, PDO::MYSQL_ATTR_LOCAL_INFILE =>true));
		$dbh->exec("set names utf8");
		$dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
        while (($start_time_hsx<= date('H:i:s')) && ($end_time_hsx>= date('H:i:s')) && $i<$k) {
			$start_second = microtime(true)*1000;
			/*$start_second = microtime(true)*1000;
			$start_hsx = $this->dash->get_start();
			$start_time_hsx = $start_hsx["value"];
			//$start_1_hsx = $this->dash->get_start_1();
			//$start_time_1_hsx = $start_1_hsx["value"];
			$end_hsx = $this->dash->get_end();
			$end_time_hsx = $end_hsx["value"];
			//$end_1_hsx = $this->dash->get_end_1();
			//$end_time_1_hsx = $end_1_hsx["value"];
			$frequency_hsx = $this->dash->get_frequency();
			$arr_frequency_hsx = explode(":",$frequency_hsx["value"]);
			$fre_hsx = $arr_frequency_hsx[0]*60 + $arr_frequency_hsx[1];	
			$k = 300/$fre_hsx;
			//set_time_limit (0);	*/
			$sql = "truncate table cur_feed_rt;";
			$this->db->simple_query($sql);
			$command = "load data infile 'efrc_cur_blg_feed.txt' into table `cur_feed_rt` character set utf8 fields terminated by  '\t'  lines terminated by  '\r\n' (code, currency,tos,curr_conv,date,time);";
			$dbh->query($command);
			$sql = "truncate table stk_feed_rt;";
			$this->db->simple_query($sql);
			$command = "load data infile 'efrc_stk_inv_feed.txt' into table `stk_feed_rt` character set utf8 fields terminated by  '\t'  lines terminated by  '\r\n' (ticker, name,time,stk_last);";
			$dbh->query($command);
			$sql_update ="update stk_feed_last as a INNER JOIN stk_feed_rt as b ON a.ticker=b.ticker and b.time > a.time 
set a.stk_last=b.stk_last,a.time=b.time, a.update_flag=1;";
			$this->db->query($sql_update);	
			$sql_update_intraday ="INSERT INTO stk_feed_intraday(ticker,date,time,stk_last,codeint) (SELECT ticker,date,time,stk_last,codeint from stk_feed_last where update_flag=1 );";
			$this->db->query($sql_update_intraday);	
			$sql_update_flag ="update stk_feed_last set update_flag=0 ;";
			$this->db->query($sql_update_flag);		
			$end_second = microtime(true)*1000;
			$totaltime = round(($end_second - $start_second)/1000,6);
			$i ++;
			usleep (($fre_hsx-$totaltime)*1000000);
		}
		
				
       // var_export($result);
    }
}