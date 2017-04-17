<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Daily_calculation_model extends CI_Model {

    public $setting = 'setting_rt';
    public $idx_composition = 'idx_composition_rt';
    public $idx_compo = 'idx_compo_rt';
    public $idx_calendar = 'idx_calendar_rt';
    public $idx_specs = 'idx_specs_rt';
    public $stk_ref = 'stk_ref';
    public $stk_prices = 'stk_prices_rt';
    public $idx_ref = 'idx_ref_rt';
    public $stk_feed = 'stk_feed_rt';
    public $stk_div = 'stk_div';
    //public $idx_ca = 'idx_ca';
    public $temp_idx_composition = 'temp_idx_composition';
    public $cur_rates = 'cur_feed_rt';
    public $mar_ref = 'mar_ref';
    public $sec_ref = 'sec_ref';
    //public $table = 'tables';
    /* history table */
    public $idx_composition_histoday = 'idx_composition_histoday';
    public $idx_specs_histoday = 'idx_specs_histoday';
    public $idx_intraday = 'idx_intraday';
    public $idx_composition_intraday = 'idx_composition_intraday';
    public $cur_feed_intraday = 'cur_feed_intraday';
   // public $idx_mstats_intraday = 'idx_mstats_intraday';
    public $idx_specs_intraday = 'idx_specs_intraday';
    public $stk_prices_intraday = 'stk_prices_intraday';

    /* end history table */

    function __construct() {
        parent::__construct();
    }
	//step 1 of realtime

    public function updateTimesOnIDX_composition($time='') {
		/*$sql = "INSERT INTO {$this->idx_composition_intraday} (date,time,idx_code,idx_curr,stk_code,stk_name,stk_curr,stk_mult,stk_shares_idx,stk_float_idx,stk_capp_idx,stk_price,curr_conv,
				stk_curr_conv,stk_mcap_idx,stk_dprice_nr,stk_dcurr_conv,stk_dprice,stk_dcap_idx,stk_dcap_nr,stk_wgt,stk_tr,stk_pr,stk_nr,nstk_curr_conv,nstk_mcap_idx,specs_id,adjcoeff,codeint) 
                SELECT date,time,idx_code,idx_curr,stk_code,stk_name,stk_curr,stk_mult,stk_shares_idx,stk_float_idx,stk_capp_idx,stk_price,curr_conv,
				stk_curr_conv,stk_mcap_idx,stk_dprice_nr,stk_dcurr_conv,stk_dprice,stk_dcap_idx,stk_dcap_nr,stk_wgt,stk_tr,stk_pr,stk_nr,nstk_curr_conv,nstk_mcap_idx,specs_id,adjcoeff,codeint FROM {$this->idx_composition} WHERE idx_code IN (select idx_code From  {$this->idx_ref} WHERE realtime =1);";
        $status = $this->db->query($sql);*/
        $sql = "UPDATE {$this->idx_composition}
                SET {$this->idx_composition}.time = '".$time."' 
				";
        return $this->db->simple_query($sql);
    }
	public function updateIDX_compositionintraday($time='') {
		$sql = "INSERT INTO {$this->idx_composition_intraday} (date,time,idx_code,idx_curr,stk_code,stk_name,stk_curr,stk_mult,stk_shares_idx,stk_float_idx,stk_capp_idx,stk_price,curr_conv,
				stk_curr_conv,stk_mcap_idx,stk_dprice_nr,stk_dcurr_conv,stk_dprice,stk_dcap_idx,stk_dcap_nr,stk_wgt,stk_tr,stk_pr,stk_nr,nstk_curr_conv,nstk_mcap_idx,specs_id,adjcoeff,codeint) 
                SELECT date,time,idx_code,idx_curr,stk_code,stk_name,stk_curr,stk_mult,stk_shares_idx,stk_float_idx,stk_capp_idx,stk_price,curr_conv,
				stk_curr_conv,stk_mcap_idx,stk_dprice_nr,stk_dcurr_conv,stk_dprice,stk_dcap_idx,stk_dcap_nr,stk_wgt,stk_tr,stk_pr,stk_nr,nstk_curr_conv,nstk_mcap_idx,specs_id,adjcoeff,codeint FROM {$this->idx_composition} ;";
        $status = $this->db->query($sql);
        
    }
	//step 2 of realtime old
    public function update_calculs_basevalue_idxtype_idx_specs_from_idx_ref() {
        $this->db->query('DROP TEMPORARY TABLE IF EXISTS temp_idx_ref');
        $this->db->query("CREATE TEMPORARY TABLE temp_idx_ref AS (select idx_mother,calculs from {$this->idx_ref}  where idx_code=idx_mother and realtime =1)");
        $this->db->query("update {$this->idx_ref} re set re.calculs=1 where re.realtime =1 and re.idx_mother in (SELECT idx_mother FROM temp_idx_ref where calculs=1)");
        $this->db->query("update {$this->idx_ref} re set re.calculs=0 where re.realtime =1 and re.idx_mother in (SELECT idx_mother FROM temp_idx_ref where calculs=0)");
        $this->db->query('DROP TEMPORARY TABLE IF EXISTS temp_idx_ref');

        $sql = "UPDATE {$this->idx_specs}, {$this->idx_ref}
                SET {$this->idx_specs}.calculs = {$this->idx_ref}.calculs, {$this->idx_specs}.idx_base = {$this->idx_ref}.idx_base,
                {$this->idx_specs}.idx_type = {$this->idx_ref}.idx_type,
                    {$this->idx_specs}.publications={$this->idx_ref}.publications,{$this->idx_specs}.idx_bbs={$this->idx_ref}.idx_bbs 
                WHERE {$this->idx_specs}.idx_code = {$this->idx_ref}.idx_code and  {$this->idx_ref}.realtime =1";
        $this->db->query($sql);
        $this->db->query("DROP TEMPORARY TABLE IF EXISTS temp_idx_specs");
        $this->db->query("CREATE TEMPORARY TABLE temp_idx_specs AS(SELECT sp.idx_code FROM {$this->idx_ref} re , {$this->idx_specs} sp WHERE re.realtime =1 and sp.idx_code=re.idx_code AND re.calculs=1 AND re.calculs=sp.calculs)");
        $this->db->query("DELETE FROM {$this->idx_specs} WHERE idx_code NOT IN (SELECT idx_code FROM temp_idx_specs)");
        $this->db->query("DROP TEMPORARY TABLE IF EXISTS temp_idx_specs");
        return;
    }
	//step 2 realtime
    public function updateSTK_priceFromSTK_feed($time='') {
		/*$sql = "INSERT INTO {$this->stk_prices_intraday} (stk_code,stk_name,stk_rlast,stk_last,stk_price,date,time,ticker,stk_rlast_date,stk_adjcls_date,codeint)
                SELECT stk_code,stk_name,stk_rlast,stk_last,stk_price,date,time,ticker,stk_rlast_date,stk_adjcls_date,codeint
FROM {$this->stk_prices} WHERE codeint IN (select com.codeint From  {$this->idx_composition} com LEFT JOIN  {$this->idx_ref} ref ON com.idx_code = ref.idx_code  LEFT JOIN {$this->stk_ref} sref ON sref.codeint=com.codeint LEFT JOIN  {$this->stk_feed} feed ON feed.codeint = sref.codeint  WHERE ref.realtime =1) ;";
        $status = $this->db->query($sql);*/
		
		/*$sql = "UPDATE " . $this->stk_prices ."
				INNER JOIN {$this->stk_feed} as c ON c.codeint={$this->stk_prices}.codeint
				SET {$this->stk_prices}.date = c.date, {$this->stk_prices}.stk_last =c.stk_last, {$this->stk_prices}.time ='".$time."' ";*/
				
        //$this->db->simple_query($sql);
        /*$sql = "UPDATE " . $this->stk_prices . "
                SET " . $this->stk_prices . ".stk_rlast_date = " . $this->stk_prices . ".date
                WHERE " . $this->stk_prices . ".stk_last >0 ;";
				*/
				
        //return $this->db->simple_query($sql);
    }
	public function updateSTK_priceFromIntraday() {
		$sql_update_intraday ="INSERT INTO stk_prices_intraday(stk_code,stk_name,stk_rlast,stk_last,stk_price,date,time,ticker,stk_rlast_date,stk_adjcls_date,codeint)
 (SELECT stk_code,stk_name,stk_rlast,stk_last,stk_price,date,time,ticker,stk_rlast_date,stk_adjcls_date,codeint from stk_prices_rt where update_flag=1 );";
		$this->db->query($sql_update_intraday);	
		$sql_update_flag ="update stk_prices_rt set update_flag=0 ;";
		$this->db->query($sql_update_flag);	
		
		/*$sql = "INSERT INTO {$this->stk_prices_intraday} (stk_code,stk_name,stk_rlast,stk_last,stk_price,date,time,ticker,stk_rlast_date,stk_adjcls_date,codeint)
                SELECT stk_code,stk_name,stk_rlast,stk_last,stk_price,date,time,ticker,stk_rlast_date,stk_adjcls_date,codeint
FROM {$this->stk_prices} WHERE codeint IN (select com.codeint From  {$this->idx_composition} com LEFT JOIN  {$this->idx_ref} ref ON com.idx_code = ref.idx_code  LEFT JOIN {$this->stk_ref} sref ON sref.codeint=com.codeint LEFT JOIN  {$this->stk_feed} feed ON feed.code = sref.codeint  WHERE ref.realtime =1) ;";
        $status = $this->db->query($sql);*/
    }
	//step 3
	 public function setIDX_lastOnIDX_specs() {
		$sql = "UPDATE     {$this->idx_specs} AS CR
                SET         temp_plast = IF((idx_last IS NOT NULL) and (idx_last <>0),idx_last,idx_plast) 
				;";
				
		$this->db->simple_query($sql);
        /*$sql = "UPDATE " . $this->idx_specs . "
                SET idx_last = 0, idx_mcap = 0, idx_dcap = 0 
				Where idx_code IN (select idx_code From  {$this->idx_ref} WHERE realtime =1);";
        return $this->db->simple_query($sql);*/
    }
   //step 4
    public function updateFieldsOfSTK_prices() {
        $sql = "UPDATE " . $this->stk_prices . "
                SET stk_price = IF(stk_last <> 0, stk_last, stk_rlast) 
				;";
				
        return $this->db->simple_query($sql);
    }
	//step 5
    public function updateIDX_compositionFromSTK_prices() {
        $sql = "UPDATE " . $this->idx_composition . "," . $this->stk_prices . "
                SET " . $this->idx_composition . ".stk_price = " . $this->stk_prices . ".stk_price
                WHERE " . $this->idx_composition . ".codeint = " . $this->stk_prices . ".codeint 
				;";
        return $this->db->simple_query($sql);
    }
	//step 6
    public function updateOfIDX_compositionFromCURR_dates() {
        /* update 20130523: Anh Nguyen */
        $sql = "UPDATE {$this->idx_composition}
                SET curr_conv = IF(stk_curr = idx_curr, 1, NULL)  
				;";
				
        $this->db->simple_query($sql);

        /*$sql = "UPDATE {$this->idx_composition}, {$this->cur_rates}
                SET {$this->idx_composition}.curr_conv = {$this->cur_rates}.cur_conv
                WHERE CONCAT({$this->idx_composition}.stk_curr, {$this->idx_composition}.idx_curr) = {$this->cur_rates}.code ;";
        $this->db->simple_query($sql);*/
		$sql = "SELECT * FROM setting_rt WHERE `key` ='imsrt_status'";
        $data = $this->db->query($sql)->row_array();
		if( $data["value"]=='CLOSING' || $data["value"]=='CLOSED') {

			$sql = "UPDATE {$this->idx_composition}, {$this->cur_rates}
					SET {$this->idx_composition}.curr_conv = 1 / {$this->cur_rates}.last
					WHERE CONCAT({$this->idx_composition}.idx_curr, {$this->idx_composition}.stk_curr) = {$this->cur_rates}.`symbol` and  {$this->cur_rates}.`status`='C' ;";
		}
		else {
			$sql = "UPDATE {$this->idx_composition}, {$this->cur_rates}
					SET {$this->idx_composition}.curr_conv = 1 / {$this->cur_rates}.last
					WHERE CONCAT({$this->idx_composition}.idx_curr, {$this->idx_composition}.stk_curr) = {$this->cur_rates}.`symbol` AND ({$this->cur_rates}.`status` IS NULL OR {$this->cur_rates}.`status` != 'C');";
		}
        /* end update */
		
		 //dont update time
        /*$sql = "update {$this->cur_rates}
                set time = (select time from {$this->idx_composition} limit 1);";*/
        return $this->db->simple_query($sql);
    }
	 public function updateCURR_datesIntraday() {
		 $sql = "INSERT INTO {$this->cur_feed_intraday} (symbol,date,time,last,`code`) 
                SELECT symbol,date,time,last,`code` FROM {$this->cur_rates} ;";
				 $status = $this->db->query($sql);
	 }
	
	//step 7
    public function caculateSTK_curr_convSTK_mcap_idxOnIDX_compositon() {
        $sql = "UPDATE {$this->idx_composition}
                SET stk_curr_conv = stk_price * curr_conv ,stk_mcap_idx = stk_shares_idx * (stk_float_idx/100)*(stk_capp_idx/100)*(1/stk_mult)*(stk_price * curr_conv), stk_dcurr_conv = stk_dprice * curr_conv, dvar=100 *((stk_price/stk_pclose)-1 ), stk_dcap_idx = stk_shares_idx*(stk_float_idx/100)*(stk_capp_idx/100)*(1/stk_mult)*(stk_dprice * curr_conv)
				";
        /*$this->db->simple_query($sql);

       /* $sql = "UPDATE {$this->idx_composition}
                SET stk_mcap_idx = stk_shares_idx * (stk_float_idx/100)*(stk_capp_idx/100)*(1/stk_mult)*stk_curr_conv 
				";*/
        return $this->db->simple_query($sql);
    }
	//step 9
    public function caculateSTK_dcurr_convSTK_dcap_idxOnIDX_composition() {
        $sql = "UPDATE {$this->idx_composition}
                SET stk_dcurr_conv = stk_dprice * curr_conv, dvar=100 *((stk_price/stk_pclose)-1 ) ;
				";
        $this->db->simple_query($sql);

        $sql = "UPDATE {$this->idx_composition}
                SET stk_dcap_idx = stk_shares_idx*(stk_float_idx/100)*(stk_capp_idx/100)*(1/stk_mult)*stk_dcurr_conv 
				 ";
        return $this->db->simple_query($sql);
    }
	//step 9
    public function updateIDX_specsFromIDX_composition() {
        $sql = "UPDATE {$this->idx_specs}, {$this->idx_composition}
                SET {$this->idx_specs}.date = {$this->idx_composition}.date, {$this->idx_specs}.time = {$this->idx_composition}.time
                WHERE {$this->idx_specs}.idx_mother = {$this->idx_composition}.idx_code ";
        $this->db->simple_query($sql);

       /* $sql = "UPDATE {$this->idx_specs}, {$this->idx_composition}
              SET {$this->idx_specs}.idx_mcap = (SELECT SUM({$this->idx_composition}.stk_mcap_idx) FROM {$this->idx_composition} where {$this->idx_composition}.idx_code ={$this->idx_specs}.idx_code)/{$this->idx_specs}.idx_conv,
                  {$this->idx_specs}.idx_dcap = ((SELECT SUM({$this->idx_composition}.stk_dcap_idx) FROM {$this->idx_composition} where {$this->idx_composition}.idx_code ={$this->idx_specs}.idx_code)/ {$this->idx_specs}.idx_conv)
              WHERE {$this->idx_specs}.idx_mother = {$this->idx_composition}.idx_code ";
		 /*$this->db->simple_query($sql);
		$sql ="update {$this->idx_specs},
(SELECT LEFT(idx_code,LENGTH(idx_code)-5) as code_2,idx_mcap as mcap_2 from  {$this->idx_specs} WHERE idx_curr='VND' GROUP BY code_2) as b 
set {$this->idx_specs}.idx_mcap=b.mcap_2/{$this->idx_specs}.idx_conv
where LEFT({$this->idx_specs}.idx_code,LENGTH( {$this->idx_specs}.idx_code)-5)=b.code_2 ;";*/
        /*$sql = "UPDATE {$this->idx_specs}, {$this->idx_composition}
              SET {$this->idx_specs}.idx_mcap = (SELECT SUM({$this->idx_composition}.stk_mcap_idx) FROM {$this->idx_composition} where {$this->idx_composition}.idx_code ={$this->idx_specs}.idx_code)/{$this->idx_specs}.idx_conv, 
			  {$this->idx_specs}.idx_dcap = (SELECT SUM({$this->idx_composition}.stk_dcap_idx) FROM {$this->idx_composition} where {$this->idx_composition}.idx_code ={$this->idx_specs}.idx_code)/ {$this->idx_specs}.idx_conv
              WHERE {$this->idx_specs}.idx_mother = {$this->idx_composition}.idx_code ";
         $this->db->simple_query($sql);*/
         
         $sql = "UPDATE {$this->idx_specs}, (SELECT idx_code,SUM({$this->idx_composition}.stk_mcap_idx) idx_mcap FROM {$this->idx_composition} group by idx_code) as b
set {$this->idx_specs}.idx_mcap = b.idx_mcap WHERE {$this->idx_specs}.idx_mother = b.idx_code ; ";
     $this->db->simple_query($sql);
     
      $sql = "update {$this->idx_specs} set idx_mcap=idx_mcap/idx_conv; ";
    $this->db->simple_query($sql);
     
         
         $sql = "UPDATE {$this->idx_specs}, (SELECT idx_code,SUM({$this->idx_composition}.stk_dcap_idx) dcap_idx FROM {$this->idx_composition} group by idx_code) as b
set {$this->idx_specs}.idx_dcap = b.dcap_idx WHERE {$this->idx_specs}.idx_mother = b.idx_code ; ";
     $this->db->simple_query($sql);
     
      $sql = "update {$this->idx_specs} set idx_dcap=idx_dcap/idx_conv; ";
     return $this->db->simple_query($sql);
         
    }
	 public function updateIDX_specsIntraday() {
		 $sql = "INSERT INTO {$this->idx_specs_intraday} (idx_code,idx_name,idx_curr,idx_base,idx_type,idx_mother,idx_divisor,idx_mcap,idx_last,date,time,records,calculs,publications,idx_plast,idx_dcap,to_adjust,idx_mcap_nxt,idx_divisor_nxt,idx_bbs,idx_conv,idx_group,idx_var,idx_pclose,ip_last,ip_plast,idx_dvar,nxt_date,idx_change,idx_dchange) 
                SELECT idx_code,idx_name,idx_curr,idx_base,idx_type,idx_mother,idx_divisor,idx_mcap,idx_last,date,time,records,calculs,publications,idx_plast,idx_dcap,to_adjust,idx_mcap_nxt,idx_divisor_nxt,idx_bbs,idx_conv,idx_group,idx_var,idx_pclose,ip_last,ip_plast,idx_dvar,nxt_date,idx_change,idx_dchange FROM {$this->idx_specs} WHERE idx_mother IN (select idx_code From  {$this->idx_ref} WHERE realtime =1) ;";
        $status = $this->db->query($sql);
	 }
	 public function updateIDX_specsAbnormal() {
		$sql = "SELECT * FROM setting_rt WHERE `key` ='idx_abnormal'";
		$data = $this->db->query($sql)->row_array();
		$idx_abnormal = $data["value"];
		$this->db->query("TRUNCATE idx_specs_abnormal;" );
		$sql = "INSERT INTO idx_specs_abnormal
                SELECT  idx_specs_rt.* FROM idx_ref_rt
            LEFT JOIN idx_specs_rt
            ON idx_ref_rt.idx_code = idx_specs_rt.idx_code
			
            WHERE idx_ref_rt.calculs = 1
            AND idx_ref_rt.mother = 1 and ABS(idx_specs_rt.idx_dvar) >= {$idx_abnormal};";
        $status = $this->db->query($sql);
	 }
	//step 8
    public function updateIDX_specsFromCUR_rates() {
        /* update 20130524: Anh Nguyen (convert currency idx_specs) */
        $sql = "UPDATE {$this->idx_specs}
                SET idx_conv = 1
                WHERE idx_code = idx_mother ;";
        $this->db->simple_query($sql);

        /*$sql = "UPDATE {$this->idx_specs}, {$this->cur_rates}
                SET {$this->idx_specs}.`idx_conv` = {$this->cur_rates}.`curr_conv`
                WHERE CONCAT({$this->idx_specs}.`idx_curr`, (SELECT DISTINCT `idx_curr` FROM (SELECT `idx_curr`, `idx_code` FROM {$this->idx_specs}) AS `temp` WHERE `temp`.`idx_code` = {$this->idx_specs}.`idx_mother`)) = {$this->cur_rates}.`code`
                AND {$this->idx_specs}.`idx_code` != {$this->idx_specs}.`idx_mother` ;";
        $this->db->simple_query($sql);*/
		$sql = "SELECT * FROM setting_rt WHERE `key` ='imsrt_status'";
        $data = $this->db->query($sql)->row_array();
		if( $data["value"]=='CLOSING' || $data["value"]=='CLOSED') {
		$sql ="update {$this->idx_specs} as a, {$this->cur_rates} as b
set a.idx_conv=b.last where concat(a.idx_curr, right(a.idx_mother,3)) = b.`symbol` and  b.`status`='C' ;";
		}
		else {
			$sql ="update {$this->idx_specs} as a, {$this->cur_rates} as b
set a.idx_conv=b.last where concat(a.idx_curr, right(a.idx_mother,3)) = b.`symbol` AND (b.`status` IS NULL OR b.`status` != 'C');";
		}

        return $this->db->simple_query($sql);
    }
	//step 10
    public function caculateIDX_lastOnIDX_specs() {
        $sql = "UPDATE     {$this->idx_specs} AS CR
                SET         idx_last = idx_base*idx_mcap/idx_divisor
                WHERE      idx_type='P' ";
        $this->db->simple_query($sql);

        /* update Anh Nguyen 20130521: ip_last */
        $sql = "UPDATE {$this->idx_specs},
                (SELECT `idx_curr`, `idx_last`, `idx_type`, `idx_mother`
                FROM {$this->idx_specs}
                WHERE `idx_type` = 'P') AS `temp`
                SET {$this->idx_specs}.`ip_last` = `temp`.`idx_last`
                WHERE {$this->idx_specs}.`idx_type` = 'R'
                AND {$this->idx_specs}.`idx_mother` = `temp`.`idx_mother`
                AND {$this->idx_specs}.`idx_curr` = `temp`.`idx_curr`  
				; ";

        $this->db->simple_query($sql);

        /* update Anh Nguyen 20130521: ip_plast */
        $sql = "UPDATE {$this->idx_specs},
                (SELECT `idx_curr`, `idx_plast`, `idx_type`, `idx_mother`
                FROM {$this->idx_specs}
                WHERE `idx_type` = 'P') AS `temp`
                SET {$this->idx_specs}.`ip_plast` = `temp`.`idx_plast`
                WHERE {$this->idx_specs}.`idx_type` = 'R'
                AND {$this->idx_specs}.`idx_mother` = `temp`.`idx_mother`
                AND {$this->idx_specs}.`idx_curr` = `temp`.`idx_curr` 
				;";
        $this->db->simple_query($sql);

        /* update Anh Nguyen 20130521: idx_last */
        /*$sql = "UPDATE {$this->idx_specs},
                (SELECT `idx_curr`, `idx_plast`, `idx_pclose`, `idx_type`, `idx_mother`,`idx_last`
                FROM {$this->idx_specs}
                WHERE `idx_type` = 'P') AS `temp`
                SET {$this->idx_specs}.`idx_last` = {$this->idx_specs}.`idx_plast` / `temp`.`idx_plast` * (`temp`.`idx_last` + ({$this->idx_specs}.`idx_base` * {$this->idx_specs}.`idx_dcap` / {$this->idx_specs}.`idx_divisor`))
                WHERE {$this->idx_specs}.`idx_type` = 'R'
                AND {$this->idx_specs}.`idx_mother` = `temp`.`idx_mother`
                AND {$this->idx_specs}.`idx_curr` = `temp`.`idx_curr`  
				;";
		$this->db->simple_query($sql);	*/	
		 $sql = "UPDATE     {$this->idx_specs} AS CR
                SET         idx_plast = temp_plast";
        return $this->db->simple_query($sql);
    }
	//step 11
	 public function caculateIDX_lastOnIDX_specs_2() {
		 $sql = "drop table if EXISTS tmpy;";
        $this->db->simple_query($sql);
		$sql = "create table tmpy select * from idx_specs_rt where idx_code=idx_mother;";
        $this->db->simple_query($sql);
		$sql = "update idx_specs_rt as a, tmpy as b set a.idx_mcap=b.idx_mcap where a.idx_mother=b.idx_mother and a.idx_type=b.idx_type;";
        $this->db->simple_query($sql);
		$sql = "update idx_specs_rt set idx_mcap=idx_mcap/idx_conv;";
        $this->db->simple_query($sql);
		$sql = "update idx_specs_rt set idx_last=(idx_mcap*idx_base)/idx_divisor;";
        $this->db->simple_query($sql);
		$sql = "update idx_specs_rt set idx_dcap=0 where idx_dcap is null;";
        $this->db->simple_query($sql);
		$sql = "UPDATE idx_specs_rt,(SELECT `idx_curr`, `idx_last`, `idx_pclose`, `idx_type`, `idx_mother`
                FROM idx_specs_rt
                WHERE `idx_type` = 'P') AS `temp`
                SET idx_specs_rt.`idx_last` = idx_specs_rt.`idx_pclose` / `temp`.`idx_pclose` * (`temp`.`idx_last` + (idx_specs_rt.`idx_base` * idx_specs_rt.`idx_dcap` / idx_specs_rt.`idx_divisor`))
                WHERE idx_specs_rt.`idx_type` = 'R'
                AND idx_specs_rt.`idx_mother` = `temp`.`idx_mother`
                AND idx_specs_rt.`idx_curr` = `temp`.`idx_curr`;";
        $this->db->simple_query($sql);
		$sql = "update idx_specs_rt set idx_dvar = 100*((idx_last/idx_pclose)-1);";
        $this->db->simple_query($sql);
		$sql = "update idx_specs_rt set idx_dchange = idx_last-idx_pclose; ";
        $this->db->simple_query($sql);
		$sql = "drop table if EXISTS tmpy;";
        $this->db->simple_query($sql);
		$sql = "create table tmpy select * from idx_specs_rt where idx_type='P';";
        $this->db->simple_query($sql);
		$sql = "update idx_specs_rt as a, tmpy as b set a.idx_mcap=b.idx_mcap where a.idx_mother=b.idx_mother and a.idx_curr=b.idx_curr and a.idx_type='R';";
        $this->db->simple_query($sql);
		 
	 }
	//step 12
    public function calculateIdx_dvarIdx_varRecordsOnIdx_specs() {
        $sql = "UPDATE {$this->idx_specs}, {$this->idx_composition}
              SET {$this->idx_specs}.records  = (SELECT count({$this->idx_composition}.codeint) FROM {$this->idx_composition} where idx_code = {$this->idx_specs}.idx_mother)
              WHERE {$this->idx_specs}.idx_mother = {$this->idx_composition}.idx_code ;";
        $this->db->simple_query($sql);

        $sql = "UPDATE {$this->idx_specs}
                SET idx_change = idx_last - idx_plast,
                idx_dchange = idx_last - idx_pclose,
                idx_var = 100 * (idx_last - idx_plast) / idx_plast,
                idx_dvar = 100 * (idx_last - idx_pclose) / idx_pclose
				;";
        return $this->db->simple_query($sql);
    }
	//step 13
    public function calculateStk_wgtOnIdx_composition() {
        $sql = "UPDATE {$this->idx_composition},
                (SELECT idx_code, SUM(stk_mcap_idx) AS sum_stk_mcap_idx
                FROM {$this->idx_composition}
                GROUP BY idx_code) AS temp
                SET {$this->idx_composition}.stk_wgt = {$this->idx_composition}.stk_mcap_idx / temp.sum_stk_mcap_idx * 100
                WHERE {$this->idx_composition}.idx_code = temp.idx_code ;";
        return $this->db->simple_query($sql);
    }

    
    
}