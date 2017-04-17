<?php
require('_/modules/welcome/controllers/block.php');

class Compare extends Welcome{
    public function __construct() {
        
        parent::__construct();
        $this->load->database();    
    }
    
   
    public function index()
    {   
        $this->template->write_view('content', 'overview', $this->data);
        $this->template->render();   
    }

     public function compare_feed_sources() { 
        $this->db->query("update stk_prices_rt as a, stk_ref as b set a.market=b.stk_market where a.stk_code=b.stk_code;"); 
        $this->db->query("truncate table `efrc_stk_var_feed`;"); 

        $this->db->query('load data  infile "efrc_stk_stp_feed.txt" into table efrc_stk_var_feed
character set utf8 fields terminated by  "\t"  lines terminated by  "\r\n" ignore 1 lines (source, market,`code`,date,time,last,volume) set source="STP";');

        $this->db->query('load data  infile "efrc_stk_scb_feed.txt" into table efrc_stk_var_feed
character set utf8 fields terminated by  "\t"  lines terminated by  "\r\n" (source, market,`code`,date,time,last,volume) set source="SCB";'); 

        $this->db->query('load data  infile "efrc_stk_vst_feed.txt" into table efrc_stk_var_feed
character set utf8 fields terminated by  "\t"  lines terminated by  "\r\n" (source, market,`code`,date,time,last,volume) set source="VST" ;');

        $this->db->query('load data  infile "efrc_stk_hsx_feed.txt" into table efrc_stk_var_feed
character set utf8 fields terminated by  "\t"  lines terminated by  "\r\n" (source, market,`code`,date,time,last,volume) set source="EXC" ;');
        $this->db->query('load data  infile "efrc_stk_hnx_feed.txt" into table efrc_stk_var_feed
character set utf8 fields terminated by  "\t"  lines terminated by  "\r\n" (source, market,`code`,date,time,last,volume) set source="EXC" ;');
        $this->db->query('load data  infile "efrc_stk_upc_feed.txt" into table efrc_stk_var_feed
character set utf8 fields terminated by  "\t"  lines terminated by  "\r\n" (source, market,`code`,date,time,last,volume) set source="EXC";');

        $this->db->query('update stk_prices_rt set stp= null, vst = null,exc = null,scb = null,diff = null;');
        $this->db->query('update stk_prices_rt as a, efrc_stk_var_feed as b set a.stp=b.last where a.stk_code=b.`code` and  a.date=b.`date` and b.source="STP";');
        $this->db->query('update stk_prices_rt as a, efrc_stk_var_feed as b set a.scb=b.last where a.stk_code=b.`code` and  a.date=b.`date` and b.source="SCB";');
        $this->db->query('update stk_prices_rt as a, efrc_stk_var_feed as b set a.vst=b.last where a.stk_code=b.`code` and  a.date=b.`date` and b.source="VST" and  b.volume >=10;');
        $this->db->query('update stk_prices_rt as a, efrc_stk_var_feed as b set a.exc=b.last where a.stk_code=b.`code` and  a.date=b.`date` and b.source="EXC" and  b.volume >=10;');
        
        //$this->db->query("update stk_prices_rt set diff=if(concat(stk_last=scb and stk_last=exc and stk_last=vst,if( stp <>0 and stp is not null,'and stk_last=stp','')) ,0,1);");
        $this->compare_price();

      redirect(base_url().'jq_loadtable/compare_summary', 'refresh');  
        
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
         $this->db->query('truncate compare_summary;');
        foreach ($compare as $key1 => $value1) {  
		  foreach ($compare as $key2 => $value2) {
		      if($value1<>$value2){
		      $sql="select a.*, b.equal,i.group_code from (select '$value1 - $value2' as `between`,'$value2' as sources,count(*) as diff from stk_prices_rt where $value1 <> $value2 and $value1 is not null  and ($value2 is not null and $value2 <>0)) as a
                left join
                (select '$value2' as sources,count(*) as equal from stk_prices_rt where $value1 = $value2 and $value1 is not null) as b
                on a.sources=b.sources
                right join 
                (select '$value2' as sources,group_concat(distinct t3.stk_code  order by t3.stk_code asc separator ' , ') as group_code from stk_prices_rt as t3
                where $value1 <> $value2 and $value1 is not null and ($value2 is not null and $value2 <>0)) as i
                on a.sources=i.sources ";
            $data = $this->db->query($sql)->result_array();
            $this->db->insert_batch('compare_summary', $data); 
            }
  
          }
        }
        $this->db->query("update compare_summary set link= if(diff<>0,'http://imsrealtime.ifrcdata.com/jq_loadtable/stk_prices_rt?diff=1','');");
	}
    public function compare_summary() {
        $this->db->query('truncate compare_summary;');
        //$result = $this->db->query("select * from stk_prices_rt")->result_array();
        $compare = array("stk_last","exc","scb","stp","vst");
		foreach ($compare as $key1 => $value1) {  
		  foreach ($compare as $key2 => $value2) {
		      $sql="select a.*, b.equal,i.group_code from (select '$value1 - $value2' as `between`,'$value2' as sources,count(*) as diff from stk_prices_rt where $value1 <> $value2 and $value1 is not null  and ($value2 is not null and $value2 <>0)) as a
                left join
                (select '$value2' as sources,count(*) as equal from stk_prices_rt where $value1 = $value2 and $value1 is not null) as b
                on a.sources=b.sources
                right join 
                (select '$value2' as sources,group_concat(distinct t3.stk_code  order by t3.stk_code asc separator ' , ') as group_code from stk_prices_rt as t3
                where $value1 <> $value2 and $value1 is not null and ($value2 is not null and $value2 <>0)) as i
                on a.sources=i.sources ";
            $data = $this->db->query($sql)->result_array();
            $this->db->insert_batch('compare_summary', $data); 
		      
          }

        }
      echo "done";
}
}
























