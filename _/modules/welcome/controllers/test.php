<?php
class Test extends Welcome{
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
		/*$sql1 ="TRUNCATE TABLE efrc_obs_data;";
				$this->db->query($sql1);
		//$tt ="/assets/download/EFRC_OBS_DATA.TXT";
		$sql="LOAD DATA LOCAL INFILE '/home/efrcuser/public_html/assets/download/EFRC_OBS_DATA.TXT' INTO TABLE `efrc_obs_data` CHARACTER SET UTF8 FIELDS TERMINATED BY  '\t'  LINES TERMINATED BY  '\r\n' IGNORE 1 LINES(`code`, `date`, `close`, `source`, `id`);";
        $data = $this->db->query($sql)->result_array();
		die();
            //$this->template->write_view('content', 'test');
            //$this->template->render();*/
		set_time_limit(600);
		ini_set("auto_detect_line_endings", true);
		 ini_set('memory_limit', '-1');
		/* Number of 'insert' statements per file */
		$max_lines_per_split = 10000;
		 
		//$dump_file ="/home/efrcuser/public_html/download/efrc_obs_data_test.sql";
		//file dung
		/*$dump_file ="/home/efrcuser/public_html/download/efrc_obs_data_test.sql";
		$split_file = "dump-split-%d.sql";
		$dump_directory = "/home/efrcuser/public_html/sql-dump/";*/
		$dump_file ="/assets/upload/EFRC_IND_DATAx.txt";
		$split_file = "dump-split-%d.sql";
		$dump_directory = "/assets/upload/sql-dump/";
		$line_count = 0;
		$file_count = 1;
		$total_lines = 0;
		
		$handle = @fopen($dump_file, "r") or die("can't open file log.txt");
		
		var_export($handle) ;
		$buffer = "";
		 
		if ($handle) {
			while(($line = fgets($handle)) !== false) {
				/* Only read 'insert' statements */
				if(!preg_match("/insert/i", $line)) continue;
				$buffer .= $line;
				$line_count++;
		 
				/* Copy buffer to the split file */
				if($line_count >= $max_lines_per_split) {
					$file_name = $dump_directory . sprintf($split_file, $file_count);
					$out_write = @fopen($file_name, "w+");
					fputs($out_write, $buffer);
					fclose($out_write);
					$buffer = '';
					$line_count = 0;
					$file_count++;
				}
			}
		 
			if($buffer) {
				/* Write out the remaining buffer */
				$file_name = $dump_directory . sprintf($split_file, $file_count);
				$out_write = @fopen($file_name, "w+");
				fputs($out_write, $buffer);
				fclose($out_write);
			}
		 
			fclose($handle);
			echo "done.";
		}	

    }
	
	public function test_upload(){
		$host = "localhost"; // If you don't know what your host is, it's safe to leave it localhost
		$dbName = "imsrt"; // Database name
		$dbUser = "root"; // Username
		$dbPass = "ifrcvn"; // Password

		$dbh = new PDO("mysql:host={$host};dbname={$dbName}", $dbUser, $dbPass,array( PDO::ATTR_PERSISTENT => false, PDO::MYSQL_ATTR_USE_BUFFERED_QUERY=>true, PDO::MYSQL_ATTR_LOCAL_INFILE =>true));
		$dbh->exec("set names utf8");
		$dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
        $sql1 ="TRUNCATE TABLE test;";
		$this->db->query($sql1);
		$command = "LOAD DATA LOCAL INFILE 'ftp_upload/efrc_cur_blg_feed.txt' into table `test` character set utf8 fields terminated by  '\t'  lines terminated by  '\r\n' (code, currency,tos,curr_conv,date,time);";
		$dbh->query($command);
	}
	public function test_upload_mysql(){
		$sql = "truncate table stk_feed_rt_tempt_copy;";		
			$this->db->simple_query($sql);
			$command = "LOAD DATA LOCAL INFILE 'ftp_upload/efrc_stk_inv_feed.txt' into table `stk_feed_rt_tempt_copy` character set utf8 fields terminated by  '\t'  lines terminated by  '\r\n' (symbol, name,time,last,code);";
			$this->db->query($command);
	}
	private function array_merge_custom($array1,$array2) {
    $mergeArray = array();
    $array1Keys = array_keys($array1);
    $array2Keys = array_keys($array2);
    $keys = array_merge($array1Keys,$array2Keys);

    foreach($keys as $key) {
        $mergeArray[$key] = array_merge_recursive(isset($array1[$key])?$array1[$key]:array(),isset($array2[$key])?$array2[$key]:array());
		
    }

    return $mergeArray;

}
	public function merge_array(){
		

$ips = array(
    array('Camera1' => '192.168.101.71'),
    array('Camera2' => '192.168.101.72'),
    array('Camera3' => '192.168.101.74'),
);
$names = array(
    array('Camera1' => 'VT'),
    array('Camera2' => 'UB'),
    array('Camera3' => 'FX'),
);
$output = array();
    while ($ip = array_shift($ips)) {
        $ident = key($ip);
        foreach ($names as $key => $name) {
            if (key($name) === $ident) {
                $output[$ident] = array(
                    'name' => array_shift($name),
                    'ip' => array_shift($ip),
                );
                unset($names[$key]);
            }
        }
    }
echo '<pre>';
print_r($output);
	}
	
	public function test_download(){
		 $url = 'https://www.hsx.vn/Modules/Listed/Web/TriIndex?date=18.02.2016&_=1456202516871';
               // $url = "http://hsx.vn/hsx/Default.aspx";
              $response = (file_get_contents($url)); //Converting in json string
             $n = strpos($response, "[");
            $response = substr_replace($response,"",0,$n+1);
            $response = substr_replace($response, "" , -2,1);
			$array = explode("}",$response);
           // $array = explode("}",$response);
            //$array=explode('', $response, -1);
			//$arrayOfEmails=json_decode($response);
			$result = array();
           foreach($array as $value){
			   //$value = str_replace("{","",$value); 
			   //$str_value = explode(",",$value);
			   
			    $ar= ($value.'}');
				var_export((json_decode($ar)),false);
			   //ar_export( $ar);
		   }
	}
	public function test_time(){
		echo date('H:i:s', time()+3600);
		if("16:08:00" <= date('H:i:s', time()+3600)) echo "nho";
	}
	
	public function compare_price() {
		$result = $this->db->query("select * from stk_prices_rt")->result_array();
		$compare = array("stk_last","exc","scb","stp","vst");
		foreach ($result as $key => $value) {
			$diff =0;
			$last = (!is_null($value["stk_last"]) && $value["stk_last"]!=0) ? $value["stk_last"] : (!is_null($value["exc"]&&$value["exc"]!=0)  ? $value["exc"] : (!is_null($value["scb"]&&$value["scb"]!=0)  ? $value["scb"]: (!is_null($value["stp"]&& $value["stp"]!=0)  ? $value["stp"]:(!is_null($value["vst"]&&$value["vst"]!=0)  ? $value["vst"]:null))));
			if(!is_null($value["stk_last"])&& $value["stk_last"]!=0 &&$value["stk_last"]!=$last)$diff =1;
			else if (!is_null($value["exc"])&&$value["exc"]!=0&&$value["exc"]!=$last)$diff =1;
			else if(!is_null($value["scb"])&&$value["scb"]!=0&&$value["scb"]!=$last)$diff =1;
			else if(!is_null($value["stp"])&&$value["stp"]!=0&&$value["stp"]!=$last)$diff =1;
			else if(!is_null($value["vst"])&&$value["vst"]!=0&&$value["vst"]!=$last)$diff =1;
			$this->db->query("update stk_prices_rt set diff=$diff where stk_code='".$value["stk_code"]."'");
			
		}
	}
 	public function diff() {
		$a = 1293.43 ;
		$b = 1679.78;
		echo $a/$b;
		
	}
}
