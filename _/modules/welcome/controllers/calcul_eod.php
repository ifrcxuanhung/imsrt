<?php
require('_/modules/welcome/controllers/block.php');

class Calcul_eod extends Welcome{
    public function __construct() {
        parent::__construct();
        
    }
    
   
    public function index()
    {   
	
    }
    public function import_data()
    {
   	    $sql ="truncate idx_composition_ed;";
		$this->db->query($sql);  
        
        $sql ="load data local infile 'ftp_upload/idx_composition_ed.txt' into table 
 `idx_composition_ed` character set utf8 fields terminated by  '\t'  lines terminated by  '\r\n'
  ( date,time,idx_code,idx_curr,stk_code,stk_name,stk_curr,stk_mult,stk_shares_idx,stk_float_idx,stk_capp_idx ,
 stk_price,curr_conv,stk_curr_conv,stk_mcap_idx,stk_dprice_nr,stk_dcurr_conv,stk_dprice,stk_dcap_idx,stk_dcap_nr,stk_wgt,stk_tr,
stk_pr,stk_nr,nstk_curr_conv,nstk_mcap_idx,specs_id,adjcoeff,codeint,stk_pclose,dvar );";
		$this->db->query($sql); 

        $sql ="truncate stk_prices_ed ;";
		$this->db->query($sql); 
        
        $sql ="load data local infile 'ftp_upload/stk_prices_ed.txt' into table 
 `stk_prices_ed` character set utf8 fields terminated by  '\t'  lines terminated by  '\r\n'
 ( `stk_code`,`stk_name`,`stk_rlast`,`stk_last`,`stk_price`,`date`,`time`,`ticker`,`id`,`stk_rlast_date`,`stk_adjcls_date`,`codeint`);";
		$this->db->query($sql); 

        $sql ="truncate idx_specs_ed;";
		$this->db->query($sql); 
        
        $sql ="load data local infile 'ftp_upload/idx_specs_ed.txt' into table 
 `idx_specs_ed` character set utf8 fields terminated by  '\t'  lines terminated by  '\r\n'
 ( `idx_code`,`idx_name`,`idx_curr`,`idx_base`,`idx_type`,`idx_mother`,`idx_divisor`,`idx_mcap`,`idx_last`,`date`,`time`,`records`,
 `calculs`,`publications`,`idx_plast`,`idx_dcap` , `to_adjust`,`idx_mcap_nxt`,`idx_divisor_nxt`,`idx_bbs`,`idx_conv` ,`idx_pclose`,`idx_group`,`idx_var`,
 `ip_last`,`ip_plast`,`idx_dvar`,`nxt_date`,`idx_change`,`idx_dchange`,`next_divisor_adjust`,`final_divisor` , `id`,`temp_plast`,`provider`,`type`,`codeint`);";
		$this->db->query($sql); 
        
        $sql ="truncate cur_feed_rts;" ;
		$this->db->query($sql); 
        
        $sql ="load data local infile 'ftp_upload/cur_rates_ed.txt' into table `cur_feed_rts` character set utf8 fields terminated by  '\t'  lines terminated by  '\r\n'
         ( `code`,  date ,`open`, high , low , `close`);";
        $this->db->query($sql);
        
        $sql ="drop table if exists tmp_cur;";
        $this->db->query($sql);
        
        $sql ="create table  tmp_cur  select `code` , left(`code`,3) as currency, right(`code`,3) as tos, `close` as curr_conv , date 
        from cur_feed_rts order by date desc;";
        $this->db->query($sql);
        
        $sql ="truncate cur_rates_ed ;";
        $this->db->query($sql);
        
        $sql ="insert into cur_rates_ed (code , currency , tos,curr_conv,   date) ( select * from tmp_cur group by `code` );";
        $this->db->query($sql);
        
        $sql ="truncate stk_prices_ed2;";
        $this->db->query($sql);
        $sql ="load data local infile 'ftp_upload/stk_feed_ed.txt' into table `stk_prices_ed2` character set utf8 fields terminated by  '\t' 
         lines terminated by  '\r\n' ( ticker, updated, hst_plastd, hst_plast, hst_lastd, hst_last, hst_vol, rt1_plastd, rt1_plast, rt1_lastd, 
         rt1_lastt, rt1_last);";
        $this->db->query($sql);
        $sql ="drop table if exists tmp_feed;";
        $this->db->query($sql);
        $sql ="create table tmp_feed select  ticker,hst_lastd as date,hst_last as stk_last,code as codeint from stk_prices_ed2 order by date desc;";
        $this->db->query($sql);
        $sql ="truncate stk_feed_ed ;";
        $this->db->query($sql);
        $sql ="insert into stk_feed_ed (`ticker`,`date`,stk_last,codeint) ( select * from tmp_feed group by `ticker` );";
        $this->db->query($sql);
        $sql ="update stk_feed_ed set codeint = null;";
        $this->db->query($sql);
        $sql ="update stk_feed_ed as a, efrc_ins_ref as b set a.codeint=b.`code` where a.ticker=b.blg;";
        $this->db->query($sql);
        $sql="update stk_prices_ed set stk_last= null;";
        $this->db->query($sql);
        $sql="update stk_prices_ed as a, stk_feed_ed as b set a.stk_last=b.stk_last where a.codeint=b.codeint and b.stk_last <>0 and b.stk_last is not null;";
        $this->db->query($sql);
        $sql="update stk_prices_ed set stk_price=if(stk_last<>0 and stk_last is not null, stk_last, stk_rlast);";
        $this->db->query($sql);

        $sql ="update cur_rates_ed set curr_conv=1 where currency=tos;";
		$this->db->query($sql); 
        $sql ="update idx_composition_ed set curr_conv=0,stk_curr_conv=0,stk_mcap_idx=0;";
		$this->db->query($sql);
        
        $sql ="update idx_specs_ed set idx_mcap=0,idx_dvar=0,idx_dchange=0;";
		$this->db->query($sql);  
 redirect(base_url().'jq_loadtable/idx_specs_ed', 'refresh');  
    }
    public function calculation()
    {
		// UPDATE DATA FOR IDX_COMPOSITION_ED
        $sql ="update idx_composition_ed set stk_price=0,curr_conv=0,stk_curr_conv=0,stk_mcap_idx=0;";
		$this->db->query($sql); 
        
        $sql ="update idx_composition_ed as a, stk_prices_ed as b set a.stk_price=b.stk_price where a.codeint=b.codeint;";
		$this->db->query($sql); 
        
        $sql ="update idx_composition_ed as a, cur_rates_ed as b set a.curr_conv=b.curr_conv where concat(a.idx_curr,a.stk_curr)=b.`code`;";
		$this->db->query($sql); 
        
        $sql ="update idx_composition_ed set stk_curr_conv=stk_price/curr_conv;";
		$this->db->query($sql); 
        
        $sql ="update idx_composition_ed set stk_mcap_idx = stk_shares_idx * (stk_float_idx/100)*(stk_capp_idx/100)*(1/stk_mult)* stk_curr_conv;";
		$this->db->query($sql); 
// UPDATE DATA FOR IDX_SPECS_ED
        $sql ="update idx_specs_ed set idx_mcap=0;";
        $this->db->query($sql); 
        $sql ="update idx_specs_ed as a,(select idx_code, sum(stk_mcap_idx) as idx_mcap from idx_composition_ed group by idx_code) as b
        set a.idx_mcap=b.idx_mcap where a.idx_mother=a.idx_code and a.idx_code=b.idx_code;";
        $this->db->query($sql); 
        
        $sql ="update cur_rates_ed set curr_conv=1 where currency=tos;";
        $this->db->query($sql); 
        $sql ="update idx_specs_ed set idx_conv=0; ";
        $this->db->query($sql); 
        $sql ="update idx_specs_ed set idx_conv=1 where idx_curr=right(idx_mother,3) ;";
        $this->db->query($sql); 
        $sql ="update idx_specs_ed as a, cur_rates_ed as b set a.idx_conv=b.curr_conv where concat(a.idx_curr,right(idx_mother,3))=b.code;";
        $this->db->query($sql); 
        
        $sql ="drop table if exists tmp_ed;";
        $this->db->query($sql); 
        $sql ="create table tmp_ed select * from idx_specs_ed where idx_code=idx_mother;";
        $this->db->query($sql); 
        $sql ="update idx_specs_ed as a, tmp_ed as b set a.idx_mcap=b.idx_mcap where a.idx_mother=b.idx_mother ;";
        $this->db->query($sql); 
        
        $sql ="update idx_specs_ed set idx_mcap=idx_mcap/idx_conv;";
        $this->db->query($sql); 
        
        $sql ="update idx_specs_ed set idx_last=0;";
        $this->db->query($sql); 
        $sql ="update idx_specs_ed set idx_last=(idx_mcap*idx_base)/idx_divisor;";
        $this->db->query($sql); 
        $sql ="update idx_specs_ed set idx_dvar=100*((idx_last/idx_pclose)-1), idx_dchange=idx_last-idx_pclose;";
        $this->db->query($sql); 
 		redirect(base_url().'jq_loadtable/idx_specs_ed', 'refresh'); 
        
        
        
        
        
    }
}