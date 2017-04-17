<?php
require('_/modules/welcome/controllers/block.php');

class Cronjobs extends Welcome{
    public function __construct() {
        parent::__construct();
		$this->load->model('Dashboard_model', 'dash');
        $this->load->model('Daily_calculation_model', 'daily_calculation_model');
        
    }
    public function index()
    {  
		
		$timmer =0;
		$pre_opening = $this->dash->get_pre_opening();
		$pre_closing = $this->dash->get_pre_closing();
		$start = $this->dash->get_start();
		$start_time = $start["value"];
		$start_1 = $this->dash->get_start_1();
		$start_time_1 = $start_1["value"];
		$end = $this->dash->get_end();
		$end_time = $end["value"];
		$end_1 = $this->dash->get_end_1();
		$end_time_1 = $end_1["value"];
		$frequency = $this->dash->get_frequency();	
		$arr_frequency = explode(":",$frequency["value"]);
		$fre = $arr_frequency[0]*60 + $arr_frequency[1];
		$value_time = date('H:i:s',microtime(true)*1000);
		set_time_limit(300);
		$i = 0;
		$k = 60/$fre;	
		$imsrt_status = $this->dash->get_imsrt_status();
		$close_status = $this->dash->get_close_status();
		$after_close_calculation = $this->dash->get_after_close_calculation();	
        while (((($start_time<= date('H:i:s')) && ($end_time>= date('H:i:s')))||(($imsrt_status["value"]=='CLOSING')&&(int)$close_status["value"] <= (int)$after_close_calculation["value"]))&&$i<$k) {
				/*$start_second = microtime(true)*1000;
				$start = $this->dash->get_start();
				$start_time = $start["value"];
				//$start_1 = $this->dash->get_start_1();
				//$start_time_1 = $start_1["value"];
				$end = $this->dash->get_end();
				$end_time = $end["value"];
				//$end_1 = $this->dash->get_end_1();
				//$end_time_1 = $end_1["value"];
				$frequency = $this->dash->get_frequency();
				$arr_frequency = explode(":",$frequency["value"]);
				$fre = $arr_frequency[0]*60 + $arr_frequency[1];				
				$k = 300/$fre;
				/*if(date('H:i:s')<=$start_time_1 || date('H:i:s')>=$end_time_1){
					$date= date("H:i:s",$old_time);					
					$old_time +=$fre;		
					$start_second = microtime(true)*1000;
					$this->daily_calculation_model->updateTimesOnIDX_composition($date);
					$this->daily_calculation_model->update_calculs_basevalue_idxtype_idx_specs_from_idx_ref();
					$this->daily_calculation_model->updateSTK_priceFromSTK_feed($date);
					$this->daily_calculation_model->setIDX_lastOnIDX_specs();
					$this->daily_calculation_model->updateFieldsOfSTK_prices();
					$this->daily_calculation_model->updateIDX_compositionFromSTK_prices();
					$this->daily_calculation_model->updateOfIDX_compositionFromCURR_dates();
					$this->daily_calculation_model->caculateSTK_curr_convSTK_mcap_idxOnIDX_compositon();
					$this->daily_calculation_model->caculateSTK_dcurr_convSTK_dcap_idxOnIDX_composition();
					$this->daily_calculation_model->updateIDX_specsFromCUR_rates();
					$this->daily_calculation_model->updateIDX_specsFromIDX_composition();
					$this->daily_calculation_model->caculateIDX_lastOnIDX_specs();
					$this->daily_calculation_model->calculateIdx_dvarIdx_varRecordsOnIdx_specs();
					$this->daily_calculation_model->calculateStk_wgtOnIdx_composition();
					$end_second = microtime(true)*1000;
					$totaltime = round(($end_second - $start_second)/1000,6);
					$i ++;
					usleep (($fre-$totaltime)*1000000);
				}*/
				//$old_time = $timmer%60==0 ? ':00'  : (':'.$timer);
				$start_second = microtime(true)*1000;
				$imsrt_status = $this->dash->get_imsrt_status();
				$close_status = $this->dash->get_close_status();
				$after_close_calculation = $this->dash->get_after_close_calculation();					
				if((int)$close_status["value"] < (int)$after_close_calculation["value"]) {
					$date= date("H:i".($timmer%60==0 ? ':00'  : (':'.$timmer)));					
					$timmer +=$fre;	
					$timmer = 	abs(60-$timmer);		
					$this->daily_calculation_model->updateTimesOnIDX_composition($date);
					//$this->daily_calculation_model->update_calculs_basevalue_idxtype_idx_specs_from_idx_ref();
					$this->daily_calculation_model->updateSTK_priceFromSTK_feed($date);
					$this->daily_calculation_model->setIDX_lastOnIDX_specs();
					$this->daily_calculation_model->updateFieldsOfSTK_prices();
					$this->daily_calculation_model->updateIDX_compositionFromSTK_prices();
					$this->daily_calculation_model->updateOfIDX_compositionFromCURR_dates();
					$start_time_calcul =microtime(true);
					$this->daily_calculation_model->caculateSTK_curr_convSTK_mcap_idxOnIDX_compositon();
					//$this->daily_calculation_model->caculateSTK_dcurr_convSTK_dcap_idxOnIDX_composition();
					$this->daily_calculation_model->updateIDX_specsFromCUR_rates();
					$this->daily_calculation_model->updateIDX_specsFromIDX_composition();
					$this->daily_calculation_model->caculateIDX_lastOnIDX_specs();
					$this->daily_calculation_model->caculateIDX_lastOnIDX_specs_2();
					$this->daily_calculation_model->calculateIdx_dvarIdx_varRecordsOnIdx_specs();
					$this->daily_calculation_model->calculateStk_wgtOnIdx_composition();			
					 $sql = 'UPDATE setting_rt
					SET `value` = "'. round((microtime(true) - $start_time_calcul), 3).'"
					where `key`="time_calculation" and `group`="setting"';
					$this->db->simple_query($sql);
				//update intraday
					$this->daily_calculation_model->updateIDX_compositionIntraday();
					$this->daily_calculation_model->updateSTK_priceFromIntraday();
					//$this->daily_calculation_model->updateCURR_datesIntraday();
					$this->daily_calculation_model->updateIDX_specsIntraday();
					$this->daily_calculation_model->updateIDX_specsAbnormal();
				}
				if($imsrt_status["value"]=='CLOSING'){
					$sql = 'UPDATE setting_rt
					SET `value` = "'.((int)$close_status["value"]+1).'"
					where `key`="close_status" and `group`="setting"';
					$this->db->simple_query($sql);
				}
				if(($imsrt_status["value"]=='CLOSING') && ((int)$close_status["value"] >= (int)$after_close_calculation["value"]))
				{
					$sql = 'UPDATE setting_rt
					SET `value` = "CLOSED"
					where `key`="imsrt_status" and `group`="setting"';
					$this->db->simple_query($sql);
				}
				if(($imsrt_status["value"]!='CLOSED') && ($imsrt_status["value"]!='CLOSING')&& ($imsrt_status["value"]!='CALCULATING')){
					$sql = 'UPDATE setting_rt
					SET `value` = "CALCULATING"
					where `key`="imsrt_status" and `group`="setting"';
					$this->db->simple_query($sql);
					$sql = 'UPDATE setting_rt
					SET `value` = "0"
					where `key`="close_status" and `group`="setting"';
					$this->db->simple_query($sql);
				}				
				$end_second = microtime(true)*1000;				
				$totaltime = round(($end_second - $start_second)/1000,6);
				//var_export($totaltime);die();
				$i ++;
				usleep (($fre-$totaltime)*1000000);
				unset($date);
				unset($start_second);
				unset($end_second);
				unset($totaltime);
        }
    }
	 public function backup_histoday()
    {
		ini_set("memory_limit", -1);
		set_time_limit(0);
		$this->load->dbutil();
        //IDX_SPECS_HISTODAY
		$sql_drop = "DROP TABLE IF EXISTS tmp_specs_histoday;";
		$this->db->query($sql_drop);
		$sql_create = "CREATE TABLE tmp_specs_histoday select * from idx_specs_histoday where `date` < SUBDATE(CURDATE(),1)"; 
		$this->db->query($sql_create);

        //IDX_COMPOSITION_HISTODAY
		$sql_drop = "DROP TABLE IF EXISTS tmp_composition_histoday;";
		$this->db->query($sql_drop);
		$sql_create = "CREATE TABLE tmp_composition_histoday select * from idx_composition_histoday where `date` < SUBDATE(CURDATE(),1)"; 
		$this->db->query($sql_create);

        //STK_PRICES_HISTODAY 
		$sql_drop = "DROP TABLE IF EXISTS tmp_prices_histoday;";
		$this->db->query($sql_drop);
		$sql_create = "CREATE TABLE tmp_prices_histoday select * from stk_prices_histoday where `date` < SUBDATE(CURDATE(),1)"; 
		$this->db->query($sql_create);

        //STK_FEED_HISTODAY
		$sql_drop = "DROP TABLE IF EXISTS tmp_feed_histoday;";
		$this->db->query($sql_drop);
		$sql_create = "CREATE TABLE tmp_feed_histoday select * from stk_feed_histoday where `date` < SUBDATE(CURDATE(),1)"; 
		$this->db->query($sql_create);

        //CMD_FEED_HISTODAY
		$sql_drop = "DROP TABLE IF EXISTS tmp_cmd_feed_histoday;";
		$this->db->query($sql_drop);
		$sql_create = "CREATE TABLE tmp_cmd_feed_histoday select * from cmd_feed_histoday where `date` < SUBDATE(CURDATE(),1)"; 
		$this->db->query($sql_create);
        
        //IND_FEED_HISTODAY
		$sql_drop = "DROP TABLE IF EXISTS tmp_ind_feed_histoday;";
		$this->db->query($sql_drop);
		$sql_create = "CREATE TABLE tmp_ind_feed_histoday select * from ind_feed_histoday where `date` < SUBDATE(CURDATE(),1)"; 
		$this->db->query($sql_create);        
 
		$prefs = array(
			'tables'      => array('tmp_specs_histoday','tmp_composition_histoday','tmp_prices_histoday','tmp_feed_histoday','tmp_cmd_feed_histoday','tmp_ind_feed_histoday' ),  // Array of tables to backup.
			'ignore'      => array(),           // List of tables to omit from the backup
			'format'      => 'zip',             // gzip, zip, txt
			'filename'    => 'backup_histoday.sql',    // File name - NEEDED ONLY WITH ZIP FILES
			'add_drop'    => TRUE,              // Whether to add DROP TABLE statements to backup file
			'add_insert'  => TRUE,              // Whether to add INSERT data to backup file
			'newline'     => "\n"               // Newline character used in backup file
		  );
		$backup =$this->dbutil->backup($prefs); 

        $db_name = 'assets/download/backup-on-'. date("Y-m-d-H-i-s") .'.zip';
        $save = $db_name;

        $this->load->helper('file');
        write_file($save, $backup); 
       
		 $sql_drop = "DROP TABLE IF EXISTS tmp_specs_histoday;";
		 $this->db->query($sql_drop);
		  $sql_drop = "DROP TABLE IF EXISTS tmp_composition_histoday;";
		 $this->db->query($sql_drop);
		  $sql_drop = "DROP TABLE IF EXISTS tmp_prices_histoday;";
		 $this->db->query($sql_drop);
		 $sql_drop = "DROP TABLE IF EXISTS tmp_feed_histoday;";
		 $this->db->query($sql_drop);
         
         $sql_drop = "DROP TABLE IF EXISTS tmp_cmd_feed_histoday;";
		 $this->db->query($sql_drop);
         
         $sql_drop = "DROP TABLE IF EXISTS tmp_ind_feed_histoday;";
		 $this->db->query($sql_drop);
// =================================================================================
        	$prefs1 = array(
			'tables'      => array('idx_specs_rt_history','idx_composition_rt_history','stk_prices_rt_history' ),  // Array of tables to backup.
			'ignore'      => array(),           // List of tables to omit from the backup
			'format'      => 'zip',             // gzip, zip, txt
			'filename'    => 'backup_eod.sql',    // File name - NEEDED ONLY WITH ZIP FILES
			'add_drop'    => TRUE,              // Whether to add DROP TABLE statements to backup file
			'add_insert'  => TRUE,              // Whether to add INSERT data to backup file
			'newline'     => "\n"               // Newline character used in backup file
		  );
		$backup1 =$this->dbutil->backup($prefs1); 

        $db_name1 = 'assets/download/eod_backup_'. date("Y-m-d-H-i-s") .'.zip';
        $save1 = $db_name1;

        $this->load->helper('file');
        write_file($save1, $backup1); 

	}

function backup_test()
	{
 	 // $command="mysqldump  --host=localhost --user=ifrcdata_imsrt --password=imsrt@ifrcdata ifrcdata_imsrt.idx_specs_rt_history > test.sql";
      //  system($command);
    $dbhost   = "localhost";
    $dbuser   = "ifrcdata_imsrt";
    $dbpwd    = "imsrt@ifrcdata";
    $dbname   = "ifrcdata_imsr";
    $dumpfile = $dbname . "_" . date("Y-m-d_H-i-s") . ".sql";
    passthru("/usr/bin/mysqldump --opt --host=$dbhost --user=$dbuser --password=$dbpwd $dbname > $dumpfile");
    
    echo "$dumpfile "; passthru("tail -1 $dumpfile");
    }
	
}