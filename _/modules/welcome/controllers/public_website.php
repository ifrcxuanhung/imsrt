<?php
require ('_/modules/welcome/controllers/block.php');

class Public_website extends Welcome
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        
      
        //$this->db3 = $this->load->database('database6', true); //connect IMSRT

    }

    public function index()
    {
        $this->load->model('setup_model', 'dash');
		$upload_process = $this->dash->getUploadProcess();
        foreach($upload_process as $key=>$sp){
			$process[$sp['id']] =  $sp;
		}
		$this->data->upload_process = $process;
        
        $this->template->write_view('content', 'public_website', $this->data);
        $this->template->render();
    }
    public function update_imsrt_day()
    {
        $date_dl = $this->db->query("select distinct date from idx_specs_rt; ")->row_array();
        $idx_specs_rt = $this->db->select("idx_code as code,date,idx_last as close,idx_dvar as perform, provider")->get("idx_specs_rt")->result_array();

        $this->db->query("delete from imsrt_day where date='" . $date_dl['date'] .
            "' and provider in ('PVN','IFRC','IFRCRESEARCH','PROVINCIAL','IFRCLAB','HOSE','HNX');");
        $this->db->insert_batch('imsrt_day', $idx_specs_rt);
        
        $this->db->query("update imsrt_day set  high = close, low = close where high is null and low is null;");

        // Dành riêng cho GLOBALWOMENCEO================================================
        $date_dl = $this->db->query("select distinct date from idx_specs_ed; ")->
            row_array();
        $idx_specs_rt = $this->db->select("idx_code as code,date,idx_last as close,idx_dvar as perform, provider")->
            get("idx_specs_ed")->result_array();
        $this->db->query("delete from imsrt_day where date='" . $date_dl['date'] .
            "' and provider='IFRCGWC';");
        $this->db->insert_batch('imsrt_day', $idx_specs_rt);
        $this->db->query("update imsrt_day set  high = close, low = close where high is null and low is null;");

    
        $idx_composition_rt = $this->db->select("idx_code, stk_code, UPPER(stk_name) as stk_name,idx_curr,stk_shares_idx,stk_float_idx, stk_capp_idx,stk_price,date,stk_wgt")->
            get("idx_composition_ed")->result_array();
		
        $this->db->query("delete from imsrt_day where date='0000-00-00';");
        // ================================================ H?t ph?n GLOBALWOMENCEO

        echo "Done!";
    }
	
	public function daily_local()
    {
		
		$this->db2 = $this->load->database('database5', true); //connect local vnxindex
		//echo "<pre>";print_r(11111);exit; 
        // var_export($result);
        $date_dl = $this->db->query("select distinct date from idx_specs_rt; ")->row_array();
        $idx_specs_rt = $this->db->select("idx_code as code,date,idx_last as close,idx_dvar as perform, provider")->get("idx_specs_rt")->result_array();

        $idx_hnx = $this->db2->query("select idx_code as code, date, open, high, low, close, `change` as perform from ifrcdata_db.vndb_hnx_index 
       where date='" . $date_dl['date'] . "' ")->result_array();
        $idx_hsx = $this->db2->query("select idx_code as code, date, open, high, low, close, `change` as perform from ifrcdata_db.vndb_hsx_index 
       where date='" . $date_dl['date'] . "' ")->result_array();

        $this->db2->query("delete from idx_day where date='" . $date_dl['date'] .
            "' and provider in ('PVN','IFRC','IFRCRESEARCH','PROVINCIAL','IFRCLAB','HOSE','HNX');");
        $this->db2->insert_batch('idx_day', $idx_specs_rt);
        $this->db2->insert_batch('idx_day', $idx_hnx);
        $this->db2->insert_batch('idx_day', $idx_hsx);
        $this->db2->query("update idx_day set  high = close, low = close where high is null and low is null;");

       	/*$this->db2->query("truncate table idx_composition;");
        $this->db2->query("drop table if exists idx_compo_;");
        $this->db2->query("create table idx_compo_ like idx_compo;");
        $this->db2->query("insert into idx_compo_ (`code`,`isin`,`name`,`curr`,`shares`,`floats`,`capping`,`last`,`date`,`weight`,`provider`) select `code`,`isin`,`name`,`curr`,`shares`,`floats`,`capping`,`last`,`date`,`weight`,`provider` from idx_compo;");
        $idx_composition_rt = $this->db->select("idx_code, stk_code, UPPER(stk_name) as stk_name,idx_curr,stk_shares_idx,stk_float_idx, stk_capp_idx,stk_price,date,stk_wgt")->
            get("idx_composition_rt")->result_array();
			
       	$this->db2->insert_batch('idx_composition', $idx_composition_rt);
        $this->db2->query("drop table if exists cp_daily_undo;");
        $this->db2->query("create table cp_daily_undo select * from idx_compo where provider in ('PVN','IFRC','IFRCRESEARCH','PROVINCIAL','IFRCLAB');");

        $this->db2->query("delete from idx_compo where provider in ('PVN','IFRC','IFRCRESEARCH','PROVINCIAL','IFRCLAB');");
        $idx_composition_rt1 = $this->db2->select("idx_code as `code`, stk_code isin, UPPER(stk_name) as `name`,idx_curr curr,stk_shares_idx as shares
       ,stk_float_idx `floats`,stk_capp_idx capping,stk_price last,date,stk_wgt weight")->
            get("idx_composition")->result_array();
        $this->db2->insert_batch('idx_compo', $idx_composition_rt1);
        $this->db2->query("update `idx_compo` a, `idx_sample` b set a.provider = b.provider where a.`code` = b.`code` ;");
        $this->db2->query("update `idx_day` a, `idx_sample` b set a.provider = b.provider where a.`code` = b.`code` and (a.provider is null or a.provider='');");*/

        // Dành riêng cho GLOBALWOMENCEO================================================
        $date_dl = $this->db->query("select distinct date from idx_specs_ed; ")->
            row_array();
        $idx_specs_rt = $this->db->select("idx_code as code,date,idx_last as close,idx_dvar as perform, provider")->
            get("idx_specs_ed")->result_array();
        $this->db2->query("delete from idx_day where date='" . $date_dl['date'] .
            "' and provider='IFRCGWC';");
        $this->db2->insert_batch('idx_day', $idx_specs_rt);
        $this->db2->query("update idx_day set  high = close, low = close where high is null and low is null;");

       // $this->db2->query("truncate table idx_composition;");
        $idx_composition_rt = $this->db->select("idx_code, stk_code, UPPER(stk_name) as stk_name,idx_curr,stk_shares_idx,stk_float_idx, stk_capp_idx,stk_price,date,stk_wgt")->
            get("idx_composition_ed")->result_array();
			//echo "<pre>";print_r($idx_composition_rt);exit; 
       // $this->db2->insert_batch('idx_composition', $idx_composition_rt);
       /* $this->db2->query("drop table if exists cp_gwc_undo;");
        $this->db2->query("create table cp_gwc_undo select * from idx_compo where provider in ('IFRCGWC') ;");

        $this->db2->query("delete from idx_compo where provider ='IFRCGWC';");
        $idx_composition_rt1 = $this->db2->select("idx_code as `code`, stk_code isin, UPPER(stk_name) as `name`,idx_curr curr,stk_shares_idx as shares
       ,stk_float_idx `floats`,stk_capp_idx capping,stk_price last,date,stk_wgt weight")->
            get("idx_composition")->result_array();
        $this->db2->insert_batch('idx_compo', $idx_composition_rt1);
        $this->db2->query("update `idx_compo` a, `idx_sample` b set a.provider = b.provider where a.`code` = b.`code` ;");*/
        $this->db2->query("delete from idx_day where date='0000-00-00';");
        // ================================================ H?t ph?n GLOBALWOMENCEO

        /****************************
        *   Create by: Ms.Phuong       *
        *   Ph?n update chung       *
        *****************************/
        //$this->womenceo_local();
        $this->idx_month();
        $this->idx_year();

        /*$dataCodeDay = $this->db2->query('SELECT DISTINCT(code) FROM `idx_day` WHERE provider IN ("VNX","IFRC","IFRCLAB","IFRCGWC","IFRCRESEARCH","PROVINCIAL")')->
            result_array();
        foreach ($dataCodeDay as $code) {
            $checkOBS = $this->db2->query('SELECT * FROM `obs_home` WHERE code = "' . $code['code'] .
                '"')->num_rows();
            if ($checkOBS == 0) {
                $this->db2->query('INSERT INTO `obs_home` (`code`) VALUES ("' . $code['code'] .
                    '")');
            }
        }
        $this->db2->query('UPDATE `obs_home` A, (SELECT A.*, B.perform as varmonth, C.perform as varyear, 
D.idx_dvar as dvar FROM (SELECT code, date, CONCAT(YEAR(date),MONTH(date)) as yyyymm, YEAR(date) as `year`, close 
FROM `idx_day` WHERE date = (SELECT MAX(date) as date FROM `idx_day`)) A
LEFT JOIN (SELECT code, date, perform FROM `idx_month`) B ON A.date = B.date AND A.code = B.code
LEFT JOIN (SELECT code, date, perform FROM `idx_year`) C ON A.date = C.date AND A.code = C.code
LEFT JOIN (SELECT idx_code, date, idx_dvar FROM `ifrcdata_db`.`idx_specs`) D ON A.date = D.date AND A.code = D.idx_code) B 
SET A.date = B.date, A.yyyymm = B.yyyymm, A.yyyy = B.year, A.close = B.close, A.varmonth = B.varmonth, A.varyear = B.varyear, 
A.dvar = B.dvar WHERE A.code = B.code;');
        $this->db2->query('UPDATE `obs_home` as A, `idx_day` as B SET A.`dvar`=B.`perform` WHERE A.`code`=B.`code` AND A.`date`=B.`date` AND A.`dvar` = 0;');*/
        
        $time = date('Y-m-d H:i:s');
		$sql_time="UPDATE upload_process SET `times` = '$time' WHERE id=1";
        $this->db->query($sql_time); 
        echo "Done!";
        // redirect(base_url().'jq_loadtable/idx_specs_ed', 'refresh');
    }
	
	public function idx_day_to_obs_home_hung(){
		$this->db2 = $this->load->database('database5', true); //connect local vnxindex
		$dataCodeDay = $this->db2->query('SELECT DISTINCT(code) FROM `idx_day` WHERE provider IN ("VNX","IFRC","IFRCLAB","IFRCGWC","IFRCRESEARCH","PROVINCIAL")')->result_array();
        foreach ($dataCodeDay as $code) {
            $checkOBS = $this->db2->query('SELECT * FROM `obs_home` WHERE code = "' . $code['code'] .
                '"')->num_rows();
            if ($checkOBS == 0) {
                $this->db2->query('INSERT INTO `obs_home` (`code`) VALUES ("' . $code['code'] .
                    '")');
            }
        }
        $this->db2->query('UPDATE `obs_home` A, (SELECT A.*, B.perform as varmonth, C.perform as varyear, 
D.idx_dvar as dvar FROM (SELECT code, date, CONCAT(YEAR(date),MONTH(date)) as yyyymm, YEAR(date) as `year`, close 
FROM `idx_day` WHERE date = (SELECT MAX(date) as date FROM `idx_day`)) A
LEFT JOIN (SELECT code, date, perform FROM `idx_month`) B ON A.date = B.date AND A.code = B.code
LEFT JOIN (SELECT code, date, perform FROM `idx_year`) C ON A.date = C.date AND A.code = C.code
LEFT JOIN (SELECT idx_code, date, idx_dvar FROM `ifrcdata_db`.`idx_specs`) D ON A.date = D.date AND A.code = D.idx_code) B 
SET A.date = B.date, A.yyyymm = B.yyyymm, A.yyyy = B.year, A.close = B.close, A.varmonth = B.varmonth, A.varyear = B.varyear, 
A.dvar = B.dvar WHERE A.code = B.code;');

        $this->db2->query('UPDATE `obs_home` as A, `idx_day` as B SET A.`dvar`=B.`perform` WHERE A.`code`=B.`code` AND A.`date`=B.`date` AND A.`dvar` = 0;');
		
        
        $time = date('Y-m-d H:i:s');
		$sql_time="UPDATE upload_process SET `times` = '$time' WHERE id=1";
        $this->db->query($sql_time); 
        echo "Done!";	
	}
	
	public function update_idx_compo(){
		$this->db2 = $this->load->database('database5', true); //connect local vnxindex
		$this->db2->query("delete from idx_compo where provider in ('PVN','IFRC','IFRCRESEARCH','PROVINCIAL','IFRCLAB');");
        $idx_composition_rt1 = $this->db2->select("idx_code as `code`, stk_code isin, UPPER(stk_name) as `name`,idx_curr curr,stk_shares_idx as shares
       ,stk_float_idx `floats`,stk_capp_idx capping,stk_price last,date,stk_wgt weight")->
            get("idx_composition")->result_array();
        $this->db2->insert_batch('idx_compo', $idx_composition_rt1);
		 $this->db2->query("update `idx_compo` a, `idx_sample` b set a.provider = b.provider where a.`code` = b.`code` ;");
		 $this->db2->query("delete from idx_compo where provider ='IFRCGWC';");
        $this->db2->query("update `idx_compo` a, `idx_sample` b set a.provider = b.provider where a.`code` = b.`code` ;");
	}
	/*public function test_daily_local(){
		 $dataCodeDay = $this->db2->query('SELECT DISTINCT(code) FROM `idx_day` WHERE provider IN ("VNX","IFRC","IFRCLAB","IFRCGWC")')->
            result_array();
        foreach ($dataCodeDay as $code) {
            $checkOBS = $this->db2->query('SELECT * FROM `obs_home` WHERE code = "' . $code['code'] .
                '"')->num_rows();
            if ($checkOBS == 0) {
                $this->db2->query('INSERT INTO `obs_home` (`code`) VALUES ("' . $code['code'] .
                    '")');
            }
        }
        $this->db2->query('UPDATE `obs_home` A, (SELECT A.*, B.perform as varmonth, C.perform as varyear, 
D.idx_dvar as dvar FROM (SELECT code, date, CONCAT(YEAR(date),MONTH(date)) as yyyymm, YEAR(date) as `year`, close 
FROM `idx_day` WHERE date = (SELECT MAX(date) as date FROM `idx_day`)) A
LEFT JOIN (SELECT code, date, perform FROM `idx_month`) B ON A.date = B.date AND A.code = B.code
LEFT JOIN (SELECT code, date, perform FROM `idx_year`) C ON A.date = C.date AND A.code = C.code
LEFT JOIN (SELECT idx_code, date, idx_dvar FROM `ifrcdata_db`.`idx_specs`) D ON A.date = D.date AND A.code = D.idx_code) B 
SET A.date = B.date, A.yyyymm = B.yyyymm, A.yyyy = B.year, A.close = B.close, A.varmonth = B.varmonth, A.varyear = B.varyear, 
A.dvar = B.dvar WHERE A.code = B.code;');
        $this->db2->query('UPDATE `obs_home` as A, `idx_day` as B SET A.`dvar`=B.`perform` WHERE A.`code`=B.`code` AND A.`date`=B.`date` AND A.`dvar` = 0;');
        
        $time = date('Y-m-d H:i:s');
		$sql_time="UPDATE upload_process SET `times` = '$time' WHERE id=1";
        $this->db->query($sql_time);
	}*/
    public function womenceo_local()
    {
		$this->db2 = $this->load->database('database5', true); //connect local vnxindex
        // var_export($result);
        $date_dl = $this->db->query("select distinct date from idx_specs_ed; ")->
            row_array();
        $idx_specs_rt = $this->db->select("idx_code as code,date,idx_last as close,idx_dvar as perform, provider")->
            get("idx_specs_ed")->result_array();
        $this->db2->query("delete from idx_day where date='" . $date_dl['date'] .
            "' and provider='IFRCGWC';");
        $this->db2->insert_batch('idx_day', $idx_specs_rt);
        $this->db2->query("update idx_day set  high = close, low = close where high is null and low is null;");

        $this->db2->query("truncate table idx_composition;");
        $this->db2->query("drop table if exists idx_compo_;");
        $this->db2->query("create table idx_compo_ like idx_compo;");
        $this->db2->query("insert into idx_compo_ (`code`,`isin`,`name`,`curr`,`shares`,`floats`,`capping`,`last`,`date`,`weight`,`provider`) select `code`,`isin`,`name`,`curr`,`shares`,`floats`,`capping`,`last`,`date`,`weight`,`provider` from idx_compo;");
        $idx_composition_rt = $this->db->select("idx_code, stk_code, UPPER(stk_name) as stk_name,idx_curr,stk_shares_idx,stk_float_idx, stk_capp_idx,stk_price,date,stk_wgt")->
            get("idx_composition_ed")->result_array();
        $this->db2->insert_batch('idx_composition', $idx_composition_rt);

        $this->db2->query("delete from idx_compo where provider ='IFRCGWC';");
        $idx_composition_rt1 = $this->db2->select("idx_code as `code`, stk_code isin, UPPER(stk_name) as `name`,idx_curr curr,stk_shares_idx as shares
       ,stk_float_idx `floats`,stk_capp_idx capping,stk_price last,date,stk_wgt weight")->
            get("idx_composition")->result_array();
        $this->db2->insert_batch('idx_compo', $idx_composition_rt1);
        $this->db2->query("update `idx_compo` a, `idx_sample` b set a.provider = b.provider where a.`code` = b.`code` ;");

        $this->idx_month();
        $this->idx_year();

        $dataCodeDay = $this->db2->query('SELECT DISTINCT(code) FROM `idx_day` WHERE provider= "IFRCGWC"')->
            result_array();
        foreach ($dataCodeDay as $code) {
            $checkOBS = $this->db2->query('SELECT * FROM `obs_home` WHERE code = "' . $code['code'] .
                '"')->num_rows();
            if ($checkOBS == 0) {
                $this->db2->query('INSERT INTO `obs_home` (`code`) VALUES ("' . $code['code'] .
                    '")');
            }
        }
        $this->db2->query('UPDATE `obs_home` A, (SELECT A.*, B.perform as varmonth, C.perform as varyear, 
D.idx_dvar as dvar FROM (SELECT code, date, CONCAT(YEAR(date),MONTH(date)) as yyyymm, YEAR(date) as `year`, close 
FROM `idx_day` WHERE date = (SELECT MAX(date) as date FROM `idx_day`)) A
LEFT JOIN (SELECT code, date, perform FROM `idx_month`) B ON A.date = B.date AND A.code = B.code
LEFT JOIN (SELECT code, date, perform FROM `idx_year`) C ON A.date = C.date AND A.code = C.code
LEFT JOIN (SELECT idx_code, date, idx_dvar FROM `ifrcdata_db`.`idx_specs`) D ON A.date = D.date AND A.code = D.idx_code) B 
SET A.date = B.date, A.yyyymm = B.yyyymm, A.yyyy = B.year, A.close = B.close, A.varmonth = B.varmonth, A.varyear = B.varyear, 
A.dvar = B.dvar WHERE A.code = B.code');
        $this->db2->query('UPDATE `obs_home` as A, `idx_day` as B SET A.`dvar`=B.`perform` WHERE A.`code`=B.`code` AND A.`date`=B.`date` AND A.`dvar` = 0');
       
       $time = date('Y-m-d H:i:s');
		$sql_time="UPDATE upload_process SET `times` = '$time' WHERE id=2";
        $this->db->query($sql_time); 
        echo "Done!";
        // redirect(base_url().'jq_loadtable/idx_specs_ed', 'refresh');
    }


    public function idx_month()
    {
		$this->db2 = $this->load->database('database5', true); //connect local vnxindex
        $this->db2->query('truncate table `idx_month`');
        $this->db2->query('insert into `idx_month` (`date`,`high`,`low`,`code`,`provider`,`close`) 
            select a.*, b.close from
                (select max(date) as date, max(close) as high, min(close) as low, code, provider 
                    from `idx_day` group by code, year(`date`), month(`date`)) a,
                (select close, code, date from `idx_day`) b
            where a.code = b.code and a.date = b.date');

        // calculate perform
        $this->db2->query('set @runtot = 0');
        $this->db2->query('set @runtot1 = 0');
        $this->db2->query('set @plr = null');
        $this->db2->query('set @plr1 = null');
        $this->db2->query('drop table if exists tmp');
        $this->db2->query('create temporary table tmp select * from `idx_month` order by code, date');
        $this->db2->query('drop table if exists tmp2');
        $this->db2->query('create temporary table tmp2
        select code, date, close,
        if(@plr = code,(@runtot := ((a.close/ @runtot)-1)*100),null) as perform,
        (@runtot := a.close ) p, (@runtot1 := a.close ) p1, @plr := code as dummy, @plr1 := code as dummy1 
        from tmp a');
        $this->db2->query('alter table tmp2 add index codedate using btree (code, date)');
        $this->db2->query('update `idx_month` a, tmp2 b set a.perform = b.perform 
            where a.code = b.code and a.date = b.date;');
    }

    public function idx_year()
    {
		$this->db2 = $this->load->database('database5', true); //connect local vnxindex
        $this->db2->query('truncate table `idx_year`');
        $this->db2->query('insert into `idx_year` (`date`,`high`,`low`,`code`,`provider`,`close`) 
            select a.*, b.close from
                (select max(date) as date, max(close) as high, min(close) as low, code, provider 
                    from `idx_day` group by code, year(`date`)) a,
                (select close, code, date from `idx_day`) b
            where a.code = b.code and a.date = b.date');

        // calculate perform
        $this->db2->query('set @runtot = 0');
        $this->db2->query('set @runtot1 = 0');
        $this->db2->query('set @plr = null');
        $this->db2->query('set @plr1 = null');
        $this->db2->query('drop table if exists tmp');
        $this->db2->query('create temporary table tmp select * from `idx_year` order by code, date');
        $this->db2->query('drop table if exists tmp2');
        $this->db2->query('create temporary table tmp2
        select code, date, close,
        if(@plr = code,(@runtot := ((a.close/ @runtot)-1)*100),null) as perform,
        (@runtot := a.close ) p, (@runtot1 := a.close ) p1, @plr := code as dummy, @plr1 := code as dummy1 
        from tmp a');
        $this->db2->query('alter table tmp2 add index codedate using btree (code, date)');
        $this->db2->query('update `idx_year` a, tmp2 b set a.perform = b.perform 
            where a.code = b.code and a.date = b.date;');
    }

    public function update_all()
    {
		$this->db2 = $this->load->database('database5', true); //connect local vnxindex
        // $from = microtime(true);
        $this->db2->query("drop table if EXISTS obs_year");
        $this->db2->query("create table obs_year like idx_year");
        $this->db2->query("insert into obs_year(date,open,high,low,close,volume,adjclose,code,perform,volat,provider)
select date,open,high,low,close,volume,adjclose,code,perform,volat,provider from idx_year;");
        $this->db2->query("drop table if EXISTS tmp;");
        $this->db2->query("create table tmp select * from obs_year group by code, date order by code, date;");
        $this->db2->query("drop table if EXISTS obs_year;");
        $this->db2->query("create table obs_year select id,date,open,high,low,close,volume,adjclose,code,perform,volat,provider from tmp;");
        //========================OBS_YEAR =====================================================
        $this->db2->query("TRUNCATE TABLE idx_month_chart;");
        $this->db2->query("insert into idx_month_chart ( date, open,high, low, `close`,code, perform, provider)
select REPLACE(date,'-','/') as date, open,high, low, `close`,code, perform, provider from idx_month where provider in ('IFRC', 'IFRCLAB', 'PVN', 'VNX','HOSE','HNX','IFRCGWC','PROVINCIAL') order by date desc;");
        //========================================
        $this->db2->query("drop table if EXISTS tmp");
        $this->db2->query("create table tmp select * from idx_month_chart group by date, code;");
        $this->db2->query("TRUNCATE table idx_month_chart;");
        $this->db2->query("insert into idx_month_chart (date,open,high,low,close,volume,adjclose,code,perform,provider)
         select date,open,high,low,close,volume,adjclose,code,perform,provider from tmp;");
        $this->db2->query("insert into idx_month_chart (date, open, high, low, close, code, perform, provider) 
(select REPLACE(a.date,'-','/') as date, a.open, a.high, a.low,a.close,a.code, a.perform,a.provider from idx_month as a, idx_sample as b 
where a.code=b.code and b.place='Vietnam' and a.provider not in('VNX','IFRC','IFRCLAB','PVN','HOSE','HNX'))");
        $this->db2->query("insert into idx_month_chart (date, open, high, low, close, adjclose,code, perform, provider) 
(select REPLACE(a.date,'-','/') as date, a.open, a.high, a.low,a.close,a.adjclose,a.code, a.perform,a.provider 
from index_ifrc.idx_month as a where code in ('IFRCAWASEAN','IFRCTASEAN40','IFRCBLWITHA','IFRCBLACMAL','IFRCBLACPHL','IFRCBLACSGP'));");
        // ========================OBS_HOME ==========================================
        $this->db2->query("drop table if EXISTS tmp;");
        $this->db2->query("create table tmp
select a.date, a.open, a.high, a.low,a.close,a.code, a.perform,a.provider from idx_day as a, idx_sample as b where a.code=b.code and( b.place='Vietnam' OR b.PROVIDER='IFRCGWC') 
and (a.provider not in('VNX','IFRC','IFRCLAB','PVN','HOSE','HNX','PROVINCIAL') OR (a.code not in (select DISTINCT code from obs_home))) order by a.date desc;
");
        $this->db2->query("delete from obs_home where provider not in('VNX','IFRC','IFRCLAB','HOSE','HNX','PROVINCIAL');");
        $this->db2->query("insert obs_home(close,dvar, code, date, yyyymm,yyyy, provider )
select close,perform as dvar,code, max(date) as date,concat(substr(max(date),1,4), substr(max(date),6,2)) as yyyymm, substr(max(date),1,4) as yyyy, provider 
from tmp group by code;");
        $this->db2->query("update obs_home a, idx_month b set a.varmonth=b.perform where a.code=b.code and a.date=b.date and a.varmonth=0;");
        $this->db2->query("update obs_home a, idx_year b set a.varyear=b.perform where a.code=b.code and a.date=b.date and a.varyear=0;");
        $this->db2->query("update obs_home a, idx_sample b set a.provider=b.provider where a.code=b.code ;");
        $this->db2->query('DROP TABLE IF EXISTS `idx_sector_weight_daily`');
        $this->db2->query('create table `idx_sector_weight_daily` (select a.code as idx_code ,sum(a.WEIGHT) as weight, b.stk_sector as sector , a.date
from `idx_compo` as a, (select * from `stk_ref` group by stk_code) as b 
where a.ISIN=b.ticker and a.PROVIDER in("VNX","IFRC","PVN","IFRCLAB","PROVINCIAL")
group by a.code,stk_sector order by a.code,weight desc)');

       $this->db2->query("update idx_compo set ISIN = REPLACE(ISIN,'STK','') where provider='IFRCGWC'");
       $this->db2->query("insert into idx_month_chart (date,open,high,low,close,volume,adjclose,code,perform,provider) select * from tmp_p;");
       $this->db2->query("update idx_month_chart set date=REPLACE(date,'-','/');");

       $time = date('Y-m-d H:i:s');
		$sql_time="UPDATE upload_process SET `times` = '$time' WHERE id=5";
        $this->db->query($sql_time); 
        echo "Done!";


    }
    public function daily_host()
    {
        $this->daily_local();
        $this->update_all();
        
        $time = date('Y-m-d H:i:s');
		$sql_time="UPDATE upload_process SET `times` = '$time' WHERE id=3";
        $this->db->query($sql_time); 
        echo "Done!";
        
    }
    public function womenceo_host()
    {
        $this->womenceo_local();
        $this->update_all();
        
        $time = date('Y-m-d H:i:s');
		$sql_time="UPDATE upload_process SET `times` = '$time' WHERE id=4";
        $this->db->query($sql_time); 
        echo "Done!";
    }
    public function undodaily()
    {
		$this->db2 = $this->load->database('database5', true); //connect local vnxindex
        $date_dl = $this->db->query("select distinct date from idx_specs_rt; ")->row_array(); 
        $this->db2->query("delete from idx_day where date='" . $date_dl['date'] ."' and provider in ('PVN','IFRC','IFRCRESEARCH','PROVINCIAL','IFRCLAB','HOSE','HNX');");
        $this->db2->query("delete from idx_compo where provider in ('PVN','IFRC','IFRCRESEARCH','PROVINCIAL','IFRCLAB');");
        $idx_compo = $this->db2->select(" `code`, isin, `name`,curr,shares ,`floats`,capping,last,date,weight,provider")->get("cp_daily_undo")->result_array();
        $this->db2->insert_batch('idx_compo', $idx_compo);
        
        $time = date('Y-m-d H:i:s');
		$sql_time="UPDATE upload_process SET `times` = '$time' WHERE id=6";
        $this->db->query($sql_time); 
        echo "Done!";
    }
    public function undogwc()
    {
		$this->db2 = $this->load->database('database5', true); //connect local vnxindex
        $date_dl = $this->db->query("select distinct date from idx_specs_ed; ")->row_array(); 
        $this->db2->query("delete from idx_day where date='" . $date_dl['date'] ."' and provider in ('IFRCGWC');");
        $this->db2->query("delete from idx_compo where provider in ('IFRCGWC');");
        $idx_compo = $this->db2->select(" `code`, isin, `name`,curr,shares ,`floats`,capping,last,date,weight,provider")->get("cp_gwc_undo")->result_array();
        $this->db2->insert_batch('idx_compo', $idx_compo);
       
       $time = date('Y-m-d H:i:s');
		$sql_time="UPDATE upload_process SET `times` = '$time' WHERE id=7";
        $this->db->query($sql_time); 
        echo "Done!";
    }
    
    public function upload_data()
    {
		 $this->db2 = $this->load->database('database5', true); //connect local vnxindex
		 $this->db3 = $this->load->database('database1', true); 
		
       $start_date = $_POST['start_date']; 
       $end_date = $_POST['end_date'];
       
       $idx_day = $this->db2->query("select date,`open`,high,low,`close`,volume,adjclose,`code`,provider,perform from idx_day
        where date >= '{$start_date}' and date<= '{$end_date}'; ")->result_array();
       if(count($idx_day)>0)
       {
        $this->db3->query("delete from idx_day where date >= '{$start_date}' and date<= '{$end_date}' ;");
        $this->db3->insert_batch('idx_day', $idx_day);
       }
        $time = date('Y-m-d H:i:s');
		$sql_time="UPDATE upload_process SET `times` = '$time' WHERE id=8";
        $this->db->query($sql_time); 
       echo "Done!";
    }
    
    
}
