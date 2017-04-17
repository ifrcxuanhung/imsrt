<?php
class Manual extends Welcome{
    public function __construct() {
        parent::__construct();
    }
    
    public function open() {
// CREATE DATA FOR PVN
		$sql ="truncate idx_ref_rt;";
		$this->db->query($sql);
        
		$sql="insert into idx_ref_rt(idx_code,idx_name,idx_name_sn,idx_curr,idx_base,idx_dtbase,idx_type,idx_mother,
idx_bbs,calculs,publications,idx_start_date,idx_end_date,idx_frequency,calcul_types,
idx_capp,idx_qlf,idx_compo_rev,idx_shares_rev,idx_frev,idx_fbanding,idx_ftreproduct,idx_oproduct,
idx_etfproduct,idx_c_mech,idx_histo,idx_launch,idx_web,idx_isin,idx_reuters,idx_bl,idx_yh,idx_ggl,idx_igs,idx_es,idx_sel,
idx_inconnect,idx_capfrev,idx_sg,idx_last,idx_divisor_nxt,idx_ncompo,idx_wgt_type,idx_base_capi,start_time,end_time,frequency,
mother,ims_order,idx_name_vn,date)
 select idx_code,idx_name,idx_name_sn,idx_curr,idx_base,idx_dtbase,idx_type,idx_mother,
idx_bbs,calculs,publications,idx_start_date,idx_end_date,idx_frequency,calcul_types,
idx_capp,idx_qlf,idx_compo_rev,idx_shares_rev,idx_frev,idx_fbanding,idx_ftreproduct,idx_oproduct,
idx_etfproduct,idx_c_mech,idx_histo,idx_launch,idx_web,idx_isin,idx_reuters,idx_bl,idx_yh,idx_ggl,idx_igs,idx_es,idx_sel,
idx_inconnect,idx_capfrev,idx_sg,idx_last,idx_divisor_nxt,idx_ncompo,idx_wgt_type,idx_base_capi,start_time,end_time,frequency,
mother,ims_order,idx_name_vn,date from vnxindex_data.idx_ref where (left(idx_code,3)='VNX' or left(idx_code,3)='PVN') AND
idx_code not in ('VNXWM20PRVND','VNXGTCTPRVND','VNXGTCPRVND','VNX25HVPRVND','VNXHC10PRVND','VNXGTCEPRVND');";
        $this->db->query($sql);
        
        $sql="update idx_ref_rt set realtime=1 , calculs=1;";
        $this->db->query($sql);
        
        $sql="update idx_ref_rt set mother= 1 where idx_code=idx_mother;";
        $this->db->query($sql);
        
		$sql="truncate idx_compo_rt;";
        $this->db->query($sql);
        
         $sql="insert into idx_compo_rt (stk_code,stk_name,stk_shares_idx,stk_float_idx,stk_capp_idx,idx_code,date,start_date,end_date,stk_curr)
 select stk_code,stk_name,stk_shares_idx,stk_float_idx,stk_capp_idx,idx_code,date,start_date,end_date,stk_curr from pvn.idx_compo;";
        $this->db->query($sql);

        $sql="truncate idx_specs_rt;";
        $this->db->query($sql);
        
        $sql="insert into idx_specs_rt (idx_code,idx_name,idx_curr,idx_base,idx_type,idx_mother,idx_divisor,idx_mcap,idx_last,date,time,records,calculs,publications,idx_plast,idx_dcap,to_adjust,idx_mcap_nxt,idx_divisor_nxt,idx_bbs,idx_conv,idx_pclose,idx_group,idx_var,ip_last,ip_plast,idx_dvar,nxt_date,idx_change,idx_dchange,next_divisor_adjust,final_divisor
)select idx_code,idx_name,idx_curr,idx_base,idx_type,idx_mother,idx_divisor,idx_mcap,idx_last,date,time,records,calculs,publications,idx_plast,idx_dcap,to_adjust,idx_mcap_nxt,idx_divisor_nxt,idx_bbs,idx_conv,idx_pclose,idx_group,idx_var,ip_last,ip_plast,idx_dvar,nxt_date,idx_change,idx_dchange,next_divisor_adjust,final_divisor
 from pvn.idx_specs;";
        $this->db->query($sql);
        
        $sql="truncate idx_composition_rt;";
        $this->db->query($sql);
        
        $sql="insert into idx_composition_rt(date,time,idx_code,idx_curr,stk_code,stk_name,stk_curr,stk_mult,stk_shares_idx,stk_float_idx,stk_capp_idx,
stk_price,curr_conv,stk_curr_conv,stk_mcap_idx,stk_dprice_nr,stk_dcurr_conv,stk_dprice,stk_dcap_idx,stk_dcap_nr,stk_wgt,stk_tr,
stk_pr,stk_nr,nstk_curr_conv,nstk_mcap_idx,specs_id,adjcoeff) select nxt_date,time,idx_code,idx_curr,nxt_stk_code,stk_name,nxt_stk_curr,nxt_stk_mult,nxt_shares_idx,nxt_float_idx,
nxt_capp_idx,nxt_price as stk_price,nstk_curr_conv,stk_curr_conv,
nstk_mcap_idx,stk_dprice_nr,stk_dcurr_conv,stk_dprice,
stk_dcap_idx,stk_dcap_nr,stk_wgt,stk_tr,stk_pr,stk_nr,nstk_curr_conv,nstk_mcap_idx,specs_id,adjcoeff from pvn.idx_composition;";
        $this->db->query($sql);
        
        $sql="update idx_composition_rt set codeint=concat('STKVN',stk_code);";
        $this->db->query($sql);
        
        $sql="truncate stk_prices_rt;";
        $this->db->query($sql);
        
        $sql="insert into stk_prices_rt (stk_code,stk_name,stk_rlast,stk_last,stk_price,date,stk_rlast_date)
select stk_code,stk_name,stk_rlast,stk_last,stk_price,date,stk_rlast_date from ims.stk_prices ;";
        $this->db->query($sql);
        
         $sql="update stk_prices_rt set codeint=concat('stkvn',stk_code);";
        $this->db->query($sql);
        
        $sql="TRUNCATE  stk_div_rt;";
        $this->db->query($sql);
        
        $sql="insert into stk_div_rt (stk_code,stk_name, stk_divnet, stk_divgross,exdate) select stk_code,stk_name, stk_divnet, stk_divgross,exdate from ims.stk_div order by exdate desc;";
        $this->db->query($sql);
        
        $sql="update stk_div_rt set codeint=concat('STKVN',stk_code);";
        $this->db->query($sql);
        
// create data for vnxindexes

        $sql="insert into idx_specs_rt (idx_code,idx_name,idx_curr,idx_base,idx_type,idx_mother,idx_divisor,idx_mcap,idx_last,date,time,records,calculs,publications,idx_plast,idx_dcap,to_adjust,idx_mcap_nxt,idx_divisor_nxt,idx_bbs,idx_conv,idx_pclose,idx_group,idx_var,ip_last,ip_plast,idx_dvar,nxt_date,idx_change,idx_dchange,next_divisor_adjust,final_divisor
)select idx_code,idx_name,idx_curr,idx_base,idx_type,idx_mother,idx_divisor,idx_mcap,idx_last,date,time,records,calculs,publications,idx_plast,idx_dcap,to_adjust,idx_mcap_nxt,idx_divisor_nxt,idx_bbs,idx_conv,idx_pclose,idx_group,idx_var,ip_last,ip_plast,idx_dvar,nxt_date,idx_change,idx_dchange,next_divisor_adjust,final_divisor
 from ims.idx_specs;";
        $this->db->query($sql);
        
        $sql="insert into idx_composition_rt(date,time,idx_code,idx_curr,stk_code,stk_name,stk_curr,stk_mult,stk_shares_idx,stk_float_idx,stk_capp_idx,
stk_price,curr_conv,stk_curr_conv,stk_mcap_idx,stk_dprice_nr,stk_dcurr_conv,stk_dprice,stk_dcap_idx,stk_dcap_nr,stk_wgt,stk_tr,
stk_pr,stk_nr,nstk_curr_conv,nstk_mcap_idx,specs_id,adjcoeff) select nxt_date,time,idx_code,idx_curr,nxt_stk_code,stk_name,nxt_stk_curr,nxt_stk_mult,nxt_shares_idx,nxt_float_idx,
nxt_capp_idx,nxt_price as stk_price,nstk_curr_conv,stk_curr_conv, nstk_mcap_idx,stk_dprice_nr,stk_dcurr_conv,stk_dprice,
stk_dcap_idx,stk_dcap_nr,stk_wgt,stk_tr,stk_pr,stk_nr,nstk_curr_conv,nstk_mcap_idx,specs_id,adjcoeff from ims.idx_composition;";
        $this->db->query($sql);
        
        $sql="insert into idx_compo_rt(stk_code,stk_name,stk_shares_idx,stk_float_idx,stk_capp_idx,idx_code,date,start_date,end_date,stk_curr)
select stk_code,stk_name,stk_shares_idx,stk_float_idx,stk_capp_idx,idx_code,date,start_date,end_date,stk_curr 
from ims.idx_compo ;";
        $this->db->query($sql);
        
        $sql="truncate stk_prices_rt;";
        $this->db->query($sql);
        
        $sql="insert into stk_prices_rt (stk_code,stk_name,stk_rlast,stk_last,stk_price,date,time,ticker,stk_rlast_date,stk_adjcls_date)
select stk_code,stk_name,stk_rlast,stk_last,stk_price,date,time,ticker,stk_rlast_date,stk_adjcls_date from ims.stk_prices ;";
        $this->db->query($sql);
        
// create data for RESEARCH   
        $sql='load data local infile "u://research//idx_spec.txt" into table idx_specs_rt
character set utf8 fields terminated by  "\t"  lines terminated by  "\r\n" ignore 1 lines (`idx_code`,`idx_name`,`idx_curr`,`idx_base`,`idx_type`,
`idx_mother`,`idx_divisor`,`idx_mcap`,`idx_last`,`date`,`time`,`records`,`calculs`,`publications`,`idx_plast`,`idx_dcap`,`to_adjust`,`idx_mcap_nxt`,
`idx_divisor_nxt`,`idx_bbs`,`idx_conv`,`idx_pclose`,`idx_group`,`idx_var`,`ip_last`,`ip_plast`,`idx_dvar`,`nxt_date`,`idx_change`,`idx_dchange`,
`next_divisor_adjust`,`final_divisor`,`temp_plast`,`provider`,`type`);';
        $this->db->query($sql);
        
        $sql='load data local infile "u://research//idx_composition.txt" into table idx_composition_rt
character set utf8 fields terminated by  "\t"  lines terminated by  "\r\n" ignore 1 lines (`date`,`time`,`idx_code`,`idx_curr`,`stk_code`,
`stk_name`,`stk_curr`,`stk_mult`,`stk_shares_idx`,`stk_float_idx`,`stk_capp_idx`,`stk_price`,`curr_conv`,`stk_curr_conv`,`stk_mcap_idx`,
`stk_dprice_nr`,`stk_dcurr_conv`,`stk_dprice`,`stk_dcap_idx`,`stk_dcap_nr`,`stk_wgt`,`stk_tr`,`stk_pr`,`stk_nr`,`nstk_curr_conv`,`nstk_mcap_idx`,
`specs_id`,`adjcoeff`,`codeint`,`stk_pclose`);';
        $this->db->query($sql);
// Steps Update Data
        $sql="update stk_prices_rt set codeint=concat('STKVN',stk_code);";
        $this->db->query($sql);
        
        $sql="update idx_specs_rt as a, idx_sample as b set a.type=b.sub_type where a.idx_code=b.code;";
        $this->db->query($sql);
        
        $sql="update idx_specs_rt as a, idx_ref_rt as b set a.idx_type=b.idx_type where a.idx_code=b.idx_code;";
        $this->db->query($sql);
        
        $sql="update idx_specs_rt as a, idx_sample as b set a.provider=b.provider where a.idx_code=b.code;";
        $this->db->query($sql);
        
        $sql="update idx_composition_rt as a,ims.idx_composition as b set a.stk_pclose=b.nxt_price where a.stk_code=b.stk_code;";
        $this->db->query($sql);
        
        $sql="update idx_composition_rt set date= (select DISTINCT max(date) from idx_compo_rt);";
        $this->db->query($sql);
        
        $sql="update idx_composition_rt set codeint=concat('STKVN',stk_code);";
        $this->db->query($sql);
        
        $sql="update idx_compo_rt set codeint=concat('STKVN',stk_code);";
        $this->db->query($sql);

        $sql=" TRUNCATE stk_feed_last;";
        $this->db->query($sql);
        
        $sql="insert into stk_feed_last (ticker,`name`,date,stk_last,codeint) select stk_code,stk_name,date, stk_price, concat('STKVN',stk_code) as codeint  from ims.stk_prices;";
        $this->db->query($sql);
        
        $sql="update stk_feed_last set date= (select distinct date from idx_compo_rt);";
        $this->db->query($sql);
        
        $sql="update stk_feed_last set time='00:00:00';";
        $this->db->query($sql);
        
        $sql="update idx_composition_rt set time='00:00:00';";
        $this->db->query($sql);
        
        $sql="update idx_composition_rt set dvar=stk_price/stk_pclose;";
        $this->db->query($sql);
        
        $sql="UPDATE idx_specs_rt set idx_last=idx_plast;";
        $this->db->query($sql);
        
        $sql="truncate idx_specs_rt_intraday;";
        $this->db->query($sql);
        
        $sql="truncate idx_composition_rt_intraday;";
        $this->db->query($sql);

       //echo "<pre>"; print_r($list_data); die();
        
        redirect(base_url().'setup');
	
    }
    
    public function close() {
        $sql="truncate stk_feed_last;";
        $this->db->query($sql);
        
        $sql="insert into stk_feed_last (ticker,`name`,date,stk_last,codeint) select stk_code,stk_name,date, stk_price, concat('STKVN',stk_code) as codeint  from ims.stk_prices;";
        $this->db->query($sql);
        
        $sql="update stk_feed_last set time='23:59:00';";
        $this->db->query($sql);
        
        $sql="update stk_feed_last set date= (select DISTINCT max(date) from idx_compo_rt);";
        $this->db->query($sql);
        
         $sql="update idx_composition_rt set time='23:59:00';";
        $this->db->query($sql);
        
        redirect(base_url().'setup');
     }
        
}
