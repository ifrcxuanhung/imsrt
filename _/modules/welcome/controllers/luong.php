<?php
require('_/modules/welcome/controllers/block.php');

class Luong extends Welcome{
    public function __construct() {
        parent::__construct();
		
    }
    public function index()
    {  
		/*$path = "smb://IFRCCloud.local/WORKS/INDEXES/DAILY/";
		if (is_file('/var/lib/mysql/imsrt/idx_specs_research_daily.txt')) {
				unlink('/var/lib/mysql/imsrt/idx_specs_research_daily.txt');
		}*/
		if (is_file('/var/lib/mysql/imsrt/idx_specs_research_daily.txt')) {
				unlink('/var/lib/mysql/imsrt/idx_specs_research_daily.txt');
		}
		$sql_1 = "select date,idx_code, idx_last, 0 as perform 
		from idx_specs_rt where provider in ('IFRCRESEARCH','PROVINCIAL') and right(idx_code,5)='PRVND' ORDER BY IDX_CODE ASC
		INTO OUTFILE 'idx_specs_research_daily.txt'
		FIELDS TERMINATED BY '\t'
		LINES TERMINATED BY '\r\n';";
		$this->db->query($sql_1);
		/*$file_contents = file_get_contents('/var/lib/mysql/imsrt/idx_specs_research_daily.txt');
		$handle =  fopen($path.'idx_specs_research_daily.txt',"w");
	   fwrite($handle,$file_contents);
	   fclose($handle);  
		die();*/
		if (is_file('/var/lib/mysql/imsrt/idx_specs_lab_daily.txt')) {
				unlink('/var/lib/mysql/imsrt/idx_specs_lab_daily.txt');
		}
		$sql_2 = "select date,idx_code, idx_last, 0 as perform 
		from idx_specs_rt where provider in ('IFRCLAB') and right(idx_code,5)='PRVND' ORDER BY IDX_CODE ASC
		INTO OUTFILE 'idx_specs_lab_daily.txt'
		FIELDS TERMINATED BY '\t'
		LINES TERMINATED BY '\r\n';";
		$this->db->query($sql_2);
		if (is_file('/var/lib/mysql/imsrt/stk_prices_rt.txt')) {
				unlink('/var/lib/mysql/imsrt/stk_prices_rt.txt');
		}
		$sql_3 = "select 'stk_code' stk_code, 'date' date, 'stk_price' stk_price
		UNION
		select stk_code, date, stk_price from stk_prices_rt 
		INTO OUTFILE 'stk_prices_rt.txt'
		FIELDS TERMINATED BY '\t'
		LINES TERMINATED BY '\r\n';";
		$this->db->query($sql_3);
		
		echo "done";	
		
    }

	
}