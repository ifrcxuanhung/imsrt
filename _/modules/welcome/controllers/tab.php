<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tab extends Welcome {
    function __construct() {
        parent::__construct();
        $this->load->model('Tab_model', 'tab');
        $this->load->model('User_model', 'user');		
    }
    
    function index() {
		//ini_set("memory_limit","32M");
		if(isset($_REQUEST['act'])&&($_REQUEST['act']=='exportCsv'||$_REQUEST['act']=='exportTxt')){
			$this->export();
		}
		else if(isset($_REQUEST['act'])&&($_REQUEST['act']=='exportXls')){
			$this->exportXls();
		}
		$name = isset($_REQUEST['tab'])?$_REQUEST['tab'] :'';
		$tab = $this->tab->get_tab($name);
		if(!isset($tab['tab'])){
		$this->template->write_view('content', 'tab/not_found', $this->data);
        $this->template->render();
		return;
		}
		$this->data->tab_name = $name;
		$this->data->title = $tab['description'];
		$this->data->tab_note = $tab['note'];
		$this->data->feedback = $tab['feedback'];
		
        // get headers
        $headers = $this->tab->get_headers($tab['table_name'],$tab['query']);
        foreach ($headers as $key => $value) {
            if(($value['active'] == 1) && ($value['type_search'] == 1)) {
				if(isset($_GET[$value['field']]) && $_GET[$value['field']]) { $value_filter = $_GET[$value['field']];}
				else 
				$value_filter='';
                switch(strtolower($value['type'])) {
                    case 'varchar':
                    case 'longtext':
                    case 'int':
					case 'link':
					case 'efrc_link':
                        $headers[$key]['filter'] = $this->tab->append_input(strtolower($value['field']), $value_filter);
                        break;
                    case 'list':
                        $headers[$key]['filter'] = $this->tab->append_select(strtolower($value['field']),(($tab['query']!='') && (!is_null($tab['query'])))?$tab['query']:$tab['table_name'], $value_filter);
                        break;
                    case 'date':
                        $headers[$key]['filter'] = $this->tab->append_date(strtolower($value['field']));
                        break;
					case 'range':
                        $headers[$key]['filter'] = $this->tab->append_range(strtolower($value['field']));
                        break;
                    default:
                        $headers[$key]['filter'] = '';
                }
            } else {
                $headers[$key]['filter'] = '';
            }
        }
        $this->data->headers = $headers;
		$this ->data->value_filter =parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
        $this->template->write_view('content', 'tab/index', $this->data);
        $this->template->render();
    }

    function list_tabs() {
        $iDisplayLength = intval($_REQUEST['length']);
        $iDisplayStart = intval($_REQUEST['start']);
        $sEcho = intval($_REQUEST['draw']);
		$name = isset($_REQUEST['tab'])?$_REQUEST['tab'] :'';
		$tab = $this->tab->get_tab($name);
		//config hidden
		 $hiddenConfig =  $this->tab->get_config('hidden');
		 $downloadFile =  $this->tab->get_config('file');
        // select columns
        $where = "where 1=1";
        $headers = $this->tab->get_headers($tab['table_name']);
        $aColumns = array();
        foreach ($headers as $item) {
            if($item['active'] == 1) {
                $aColumns[] = '`'.strtolower($item['field']).'`';
                if($this->input->post(strtolower($item['field']))) {
                    switch(strtolower($item['type'])) {
                        case 'varchar':
                        case 'longtext':
                        case 'int':
						case 'link':
                            $where .= " and `{$item['field']}` like '%".real_escape_string($this->input->post(strtolower($item['field'])))."%'";
                            break;
                        case 'list':
                            if($this->input->post(strtolower($item['field'])) != 'all') {
                                $where .= " and `{$item['field']}` = '".real_escape_string($this->input->post(strtolower($item['field'])))."'";    
                            }
                            break;
                        default:
                            break;
                    }
                } else if($this->input->post(strtolower($item['field'].'_start')) and strtotime($this->input->post(strtolower($item['field'].'_start')))) {
                    $where .= " and `{$item['field']}` >= '".real_escape_string($this->input->post(strtolower($item['field'].'_start')))."'";
                } 
				 else if($this->input->post(strtolower($item['field'].'_from'))) {
                    $where .= " and `{$item['field']}` >= ".(int)($this->input->post(strtolower($item['field'].'_from')))."";
                }
				if($this->input->post(strtolower($item['field'].'_end')) and strtotime($this->input->post(strtolower($item['field'].'_end')))){
					 $where .= " and `{$item['field']}` <= '".real_escape_string($this->input->post(strtolower($item['field'].'_end')))."'";
				}
				if($this->input->post(strtolower($item['field'].'_to'))) {
                    $where .= " and `{$item['field']}` <= ".(int)($this->input->post(strtolower($item['field'].'_to')))."";
                } 
            }
        }
		$sTable =(($tab['query']!='') && (!is_null($tab['query'])))?$tab['query']:$tab['table_name'];		
         $sqlColumn = "SHOW COLUMNS FROM {$sTable};";  
		 $arrColumn = $this->db->query($sqlColumn)->result_array(); 
		 foreach ($arrColumn as $item){			 		 
			 if(!$this->input->post(strtolower($item['Field'])) && isset($_GET[$item['Field']]) && strtolower($item['Field']!='tab'))
			 $where .= " and `{$item['Field']}` = '".$_GET[$item['Field']]."'";
		 }
		 $sql = "select count(*) count
                from {$sTable} {$where}";
        $iFilteredTotal = $this->db->query($sql,FALSE,TRUE,TRUE)->row()->count;
		$iTotalRecords = $iFilteredTotal;
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
        // order
        $order_by ='';	
        if (isset($_REQUEST['order'][0]['column'])) {
            $iSortCol_0 = $_REQUEST['order'][0]['column'];
            $sSortDir_0 = $_REQUEST['order'][0]['dir'];
            foreach($aColumns as $key => $value) {
                if($iSortCol_0 == $key) {                    
                    $order_by = " order by $value ".$sSortDir_0;
                    break;
                }
            }
        }
        $order_by .= (($tab['order_by']!='') && (!is_null($tab['order_by'])))?($order_by =='' ? ('order by '.$tab['order_by']):(','.$tab['order_by'])):'';
		$sqlkey = "SELECT `keys`, `user_level` FROM efrc_summary WHERE table_name = '{$tab['table_name']}'";
        $keyARR = $this->db->query($sqlkey)->row_array();
		$keyARR = isset( $keyARR) ? $keyARR: array();
		$arr = explode(',',$keyARR['keys']);
        foreach($arr as $v){ 
            $aa[] = '`'.TRIM($v).'`';
        }   
        $rs = in_array($aa, $aColumns, TRUE) ?  $aColumns : array_merge((array)$aa, (array)$aColumns);
        
            
        $sql = "select sql_calc_found_rows " . str_replace(' , ', ' ', implode(', ', $rs)) . "
                from {$sTable} {$where} {$order_by} limit {$iDisplayStart}, {$iDisplayLength};";
        $data = $this->db->query($sql,FALSE,TRUE,TRUE)->result_array();
		$ke = explode(',',$keyARR['keys']);
        //$aColumns[] = '`'.strtolower($item['field']).'`';
        
        $arr = explode(',',$keyARR['keys']);
        foreach($arr as $v){ 
            $aa[] = '`'.TRIM($v).'`';
        }
		$edit_table =  $this->tab->get_config('edit_table');    
        $records = array();
        $records["data"] = array();
		for ($i = 0, $c = count($data); $i < $c; $i++)
		{
			// access $query[$i] instead of $row
			$value = $data[$i];
			$key=$i;
            foreach($headers as $item) {
                if($item['active'] == 1) {
                    switch($item['align']) {
                        case 'L':
                            $align = ' class="align-left"';
                            break;
                        case 'R';
                            $align = ' class="align-right"';
                            break;
                        default:
                            $align = ' class="align-center"';
                            break;
                    }
					if(trim($value[strtolower($item['field'])])=='-')
					$records["data"][$key][] = '<div'.$align.'></div>';
					else if(($item['hidden']==1)&&(isset($hiddenConfig['value']) && ($this->session->userdata_vnefrc('user_level')<$hiddenConfig['value']))){
						$length = strlen($value[strtolower($item['field'])]);
						if((strpos(strtolower($item['type']),'efrc_link')!==false)&&$value[strtolower($item['field'])]!=''){
							$start = strpos(strtolower($item['type']),'(')+1;
							$end = strpos(strtolower($item['type']),')')+1;
							$str = ($start!==false && $end!==false) ? substr($item['type'],$start,  $end - $start) : 'Link';
							$records["data"][$key][] = '<div'.$align.'><a class="btn default btn-xs green" href="'.base_url().$value[strtolower($item['field'])].'">
										<i class="fa fa-globe"></i> '.trim($str).' </a></div>';
							
						}
						else if((strpos(strtolower($item['type']),'link')!==false)&&$value[strtolower($item['field'])]!=''){
							$start = strpos(strtolower($item['type']),'(');
							$end = strpos(strtolower($item['type']),')');
							$str = ($start!==false && $end!==false) ? substr($item['type'],$start,  $end - $start) : 'Link';
							if(strpos($value[strtolower($item['field'])], 'http')===false && strpos($value[strtolower($item['field'])], 'https')===false)
							$records["data"][$key][] = '<div'.$align.'><a class="btn default btn-xs green" href="http://'.$value[strtolower($item['field'])].'" target="_blank">
										<i class="fa fa-globe"></i> '.trim($str).' </a></div>';							
							
							else {
								$records["data"][$key][] = '<div'.$align.'><a class="btn default btn-xs green" href="'.$value[strtolower($item['field'])].'" target="_blank">
										<i class="fa fa-globe"></i> '.trim($str).' </a></div>';
								
							}
						} else if((strtolower($item['type'])=='file')&&$value[strtolower($item['field'])]!=''){
							if(isset($downloadFile['value']) && $downloadFile['value']<=$this->session->userdata_vnefrc('user_level'))
							$records["data"][$key][] = '<div'.$align.'><a  href="'.base_url().'assets/upload/pdf/'.$value[strtolower($item['field'])].'" download="'.$value[strtolower($item['field'])].'">
										<img src="'.base_url().'assets/templates/welcome/img/pdf.png" style="height:30px; width:30px;"> </a></div>';
							else $records["data"][$key][]='';
							
						}
						 else if((strpos(strtolower($item['type']),'image')!==false)&&$value[strtolower($item['field'])]!=''){
							$start = strpos(strtolower($item['type']),'(') +1;
							$end = strpos(strtolower($item['type']),')');
							$str = ($start!==false && $end!==false) ? substr($item['type'],$start,  $end - $start) : '';
							$arrHeight = explode(',', $str);
							$height = (isset($arrHeight[0]) && $arrHeight[0] >0) ?  $arrHeight[0]: 20;
							$heightMax = (isset($arrHeight[1]) && $arrHeight[1] >0 ) ?  $arrHeight[1]: 200;
							$image =is_file($value[strtolower($item['field'])])? base_url().$value[strtolower($item['field'])]:base_url().'assets/images/no-image.jpg';
							$records["data"][$key][] = '<div'.$align.'><img height="'.$height.'" src="'.$image.'" class="thumb" data-height="'.$heightMax.'" ></div>';
							
						}
						else if((strpos(strtolower($item['format_n']),'decimal')!==false)&&$value[strtolower($item['field'])]!=''){
							$start = strpos(strtolower($item['format_n']),'(') +1;
							$end = strpos(strtolower($item['format_n']),')');
							$str = ($start!==false && $end!==false) ? intval(substr($item['format_n'],$start,  $end - $start)) : 0;
							$records["data"][$key][] = '<div'.$align.'>'.number_format(($value[strtolower($item['field'])]), $str, '.', ',').'</div>';
						}
						else
						$records["data"][$key][] = '<div'.$align.'>'.str_repeat('*',$length).'</div>';
					}
					else {
						if((strpos(strtolower($item['type']),'efrc_link')!==false)&&$value[strtolower($item['field'])]!=''){
							$start = strpos(strtolower($item['type']),'(')+1;
							$end = strpos(strtolower($item['type']),')');
							$str = ($start!==false && $end!==false) ? substr($item['type'],$start,  $end - $start) : 'Link';					
                    		$records["data"][$key][] = '<div'.$align.'><a class="btn default btn-xs green" href="'.base_url().$value[strtolower($item['field'])].'">
										<i class="fa fa-globe"></i> '.trim($str).' </a></div>';
						}
						else if((strpos(strtolower($item['type']),'link')!==false)&&$value[strtolower($item['field'])]!=''){
							$start = strpos(strtolower($item['type']),'(') +1;
							$end = strpos(strtolower($item['type']),')');
							$str = ($start!==false && $end!==false) ? substr($item['type'],$start,  $end - $start) : 'Link';
							if(strpos($value[strtolower($item['field'])], 'http')===false && strpos($value[strtolower($item['field'])], 'https')===false)
							$records["data"][$key][] = '<div'.$align.'><a class="btn default btn-xs green" href="http://'.$value[strtolower($item['field'])].'" target="_blank">
										<i class="fa fa-globe"></i> '.trim($str).' </a></div>';							
							
							else {
								
								$records["data"][$key][] = '<div'.$align.'><a class="btn default btn-xs green" href="'.$value[strtolower($item['field'])].'" target="_blank">
										<i class="fa fa-globe"></i> '.trim($str).' </a></div>';
								
							}
						}						
						else if((strtolower($item['type'])=='file')&&$value[strtolower($item['field'])]!=''){
							if(isset($downloadFile['value']) && $downloadFile['value']<=$this->session->userdata_vnefrc('user_level'))
							$records["data"][$key][] = '<div'.$align.'><a  href="'.base_url().'assets/upload/pdf/'.$value[strtolower($item['field'])].'" download="'.$value[strtolower($item['field'])].'">
										<img src="'.base_url().'assets/templates/welcome/img/pdf.png" style="height:30px; width:30px;"> </a></div>';
							else $records["data"][$key][]='';
							
						}
						else if((strpos(strtolower($item['type']),'image')!==false)&&$value[strtolower($item['field'])]!=''){
							$start = strpos(strtolower($item['type']),'(') +1;
							$end = strpos(strtolower($item['type']),')');
							$str = ($start!==false && $end!==false) ? substr($item['type'],$start,  $end - $start) : '';
							$arrHeight = explode(',', $str);
							$height = (isset($arrHeight[0]) && $arrHeight[0] >0) ?  $arrHeight[0]: 20;
							$heightMax = (isset($arrHeight[1]) && $arrHeight[1] >0 ) ?  $arrHeight[1]: 200;
							$image =is_file($value[strtolower($item['field'])])? base_url().$value[strtolower($item['field'])]:base_url().'assets/images/no-image.jpg';
							$records["data"][$key][] = '<div'.$align.'><img height="'.$height.'" src="'.$image.'" class="thumb" data-height="'.$heightMax.'" ></div>';
							
						}
						else if((strpos(strtolower($item['format_n']),'decimal')!==false)&&$value[strtolower($item['field'])]!=''){
							$start = strpos(strtolower($item['format_n']),'(') +1;
							$end = strpos(strtolower($item['format_n']),')');
							$str = ($start!==false && $end!==false) ? intval(substr($item['format_n'],$start,  $end - $start)) : 0;
							$records["data"][$key][] = '<div'.$align.'>'.number_format(($value[strtolower($item['field'])]), $str, '.', ',').'</div>';
						}
						else
						$records["data"][$key][] = '<div'.$align.'>'.$value[strtolower($item['field'])].'</div>';
					}
                }
            }
            $keys = array();
            foreach($ke as $val){
			   $keys[] = "'".$value[strtolower($val)]."' ";
		   
		    }
			//print_r($keys);
			$k = implode(',',$keys);
            //$records["data"][$key][] = '';
			if(($keyARR['user_level']>$this->session->userdata_vnefrc('user_level'))||(isset($edit_table['value']) && ($this->session->userdata_vnefrc('user_level')<$edit_table['value']))){
				$records["data"][$key][] .='';
			}else{			
             $records["data"][$key][] .= '<center><div class="align-center">'
                                        .'<a class="btn default btn-xs green view-tab-modal-edit" keys="'.$k.'" table_name="'.$name.'" href="#tab_modal" data-toggle="modal">
                                        <i class="fa fa-edit"></i></a>'
                                        .'<a class="btn default btn-xs red" href="#">
                                        <i class="fa fa-trash-o"></i></a>'
                                        .'</div></center>';
			}
		}

        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iFilteredTotal;
          
        $this->output->set_output(json_encode($records));
    }
    
    function tab_modal() {
        $table_name = isset($_REQUEST['table_name']) ? $_REQUEST['table_name']: '';		
        $tab = $this->tab->get_tab($table_name);
        $keys = strtolower(TRIM($_POST['keys']));
        //$rs = in_array($aa, $aColumns, TRUE) ?  $aColumns : array_merge((array)$aa, (array)$aColumns);
        //print_r($tab);exit;
        // get headers
        //print_r($tab['table_name']);exit;
        $headers = $this->tab->tab_type($tab['table_name']);
       //print_r($headers);exit;
        $sqlkey = "SELECT `keys` FROM efrc_summary WHERE table_name = '{$tab['table_name']}'";
        $keyARR = $this->db->query($sqlkey)->row_array();
        
        $eql = explode(' ,',$keys);
        foreach($eql as $vl){ 
            $eq[] = TRIM($vl);
        }
       // print_r($eq);
        $arr = explode(',',$keyARR['keys']);
		$aa = array();
        foreach($arr as $v){ 
            $aa[] = TRIM(strtolower($v));
        }
        $wh = array_combine($aa,$eq);  
        
        $where = '1 = 1';
        foreach($wh as $key=>$value){  
            $where .= " and `$key` = {$value}";
        }
        $sql = "Select * FROM {$tab['table_name']} WHERE {$where} ;";
        $data = $this->db->query($sql)->row_array();
        //print_R($data);exit;
        foreach ($headers as $key => $value) {
			$readonly = isset($data[$value['Field']]) && in_array(strtolower($value['Field']), $aa ) ? '1' : '0' ;
			$primary = in_array(strtolower($value['Field']), $aa ) ? '1' : '0' ;
			//print_r($readonly);
			if ((strpos(strtolower($value['Type']), 'longtext') !== FALSE)||(strpos(strtolower($value['Type']), 'text') !== FALSE)){
				$headers[$key]['filter'] = $this->tab->append_textarea_editon(strtolower($value['Field']),isset($data[$value['Field']]) ? $data[$value['Field']]:'', $readonly, $primary);
			}
			else if((strpos(strtolower($value['Type']), 'int') !== FALSE)||(strpos(strtolower($value['Type']), 'double') !== FALSE)||(strpos(strtolower($value['Type']), 'interger') !== FALSE)){
				$headers[$key]['filter'] = $this->tab->append_input_number(strtolower($value['Field']),isset($data[$value['Field']]) ? $data[$value['Field']] :'',$readonly, $primary);
			}
			else if((strpos(strtolower($value['Type']), 'varchar') !== FALSE)){
				$headers[$key]['filter'] = $this->tab->append_input_text(strtolower($value['Field']),isset($data[$value['Field']]) ? $data[$value['Field']]:'', $readonly,$primary);
			}
			else if((strpos(strtolower($value['Type']), 'date') !== FALSE)){
				$headers[$key]['filter'] = $this->tab->append_date_editon(strtolower($value['Field']), isset($data[$value['Field']]) ? $data[$value['Field']]:'', $readonly,$primary);
			}
			else{
				$headers[$key]['filter'] = $this->tab->append_input_text(strtolower($value['Field']),isset($data[$value['Field']]) ? $data[$value['Field']] : '', $readonly, $primary);
			}
        }
        $this->data->headers = $headers;
        $this->data->name_table = $tab['table_name'];
        $this->data->name_desc = $tab['description'];
		$this->data->keys = $keys;
        $this->load->view('tab/tab_modal', $this->data);
    }
    

    function export() {
       
		$tab_name = isset($_REQUEST['tab_name'])?$_REQUEST['tab_name'] :'';
		$tab = $this->tab->get_tab($tab_name);
        // select columns
        $where = "where 1=1";
        $headers = $this->tab->get_headers($tab['table_name']);
        $aColumns = array();
		$aColumnsHeader = array();
		foreach ($headers as $item) {
			if($item['active'] == 1) {
				$aColumnsHeader[]=$item['title'];
			}
		}
        foreach ($headers as $item) {
            if($item['active'] == 1) {
                $aColumns[] = '`'.strtolower($item['field']).'`';
                if($this->input->post(strtolower($item['field']))) {
                    switch(strtolower($item['type'])) {
                        case 'varchar':
                        case 'longtext':
                        case 'int':
                            $where .= " and {$item['field']} like '%".real_escape_string($this->input->post(strtolower($item['field'])))."%'";
                            break;
                        case 'list':
                            if($this->input->post(strtolower($item['field'])) != 'all') {
                                $where .= " and {$item['field']} = '".real_escape_string($this->input->post(strtolower($item['field'])))."'";    
                            }
                            break;
                        default:
                            break;
                    }
                } else if($this->input->post(strtolower($item['field'].'_start')) and strtotime($this->input->post(strtolower($item['field'].'_start')))) {
                    $where .= " and `{$item['field']}` >= '".real_escape_string($this->input->post(strtolower($item['field'].'_start')))."'";
                } 
				 else if($this->input->post(strtolower($item['field'].'_from'))) {
                    $where .= " and `{$item['field']}` >= ".(int)($this->input->post(strtolower($item['field'].'_from')))."";
                }
				if($this->input->post(strtolower($item['field'].'_end')) and strtotime($this->input->post(strtolower($item['field'].'_end')))){
					 $where .= " and `{$item['field']}` <= '".real_escape_string($this->input->post(strtolower($item['field'].'_end')))."'";
				}
				if($this->input->post(strtolower($item['field'].'_to'))) {
                    $where .= " and `{$item['field']}` <= ".(int)($this->input->post(strtolower($item['field'].'_to')))."";
                } 
            }
        }
        unset($headers);

        $sTable = (($tab['query']!='') && (!is_null($tab['query'])))?$tab['query']:$tab['table_name'];
		if(is_null($tab['limit_export'])){
        $sql = "select sql_calc_found_rows " . str_replace(' , ', ' ', implode(', ', $aColumns)) . "
                from {$sTable} {$where};";
		}else {
			if(($this->session->userdata_vnefrc('user_id'))){
        	$detail_user = $this->user->get_detail_user($this->session->userdata_vnefrc('user_id'));
			$level= $detail_user['user_level'];
			}
			else 
			$level = 0;
		$arrlimit = explode(";",$tab['limit_export']);
        
		$limit = isset($arrlimit[$level]) ? $arrlimit[$level] :10;
		$sql = "select sql_calc_found_rows " . str_replace(' , ', ' ', implode(', ', $aColumns)) . "
                from {$sTable} {$where} limit {$limit};";
		}
        
        $this->load->dbutil();
        $query = $this->db->query($sql)->result_array();
		if(isset($_REQUEST['act'])&&($_REQUEST['act']=='exportCsv')){
		$this->dbutil->export_to_csv("{$tab_name}", $query, $aColumnsHeader, null,",", true);
		}
		else if(isset($_REQUEST['act'])&&($_REQUEST['act']=='exportTxt')){
		$this->dbutil->export_to_txt("{$tab_name}", $query, $aColumnsHeader, null,chr(9), true);
		}		
		die();
		
    }
	function exportXls(){
		$tab_name = isset($_REQUEST['tab_name'])?$_REQUEST['tab_name'] :'';
		$content = file_get_contents(base_url().'assets/download/tab_xls.php');
		$content = $this->bodyReport($content,$tab_name);
		header ( "Expires: Mon, 1 Apr 1974 05:00:00 GMT");
		header ( "Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT" );
		header ( "Pragma: no-cache" );
		header ( "Content-type: application/msexcel");
		header ( "Content-Disposition: inline; filename=\"{$tab_name}_".date("dmYhi").".xls\"");
		print($content);
		die();
	}
	function bodyReport($content,$tab_name){
		$tab = $this->tab->get_tab($tab_name);
		$headers = $this->tab->get_headers($tab['table_name'],$tab['query']);
		$this->load->dbutil();
		$arrBody = $this->dbutil->PartitionString('<!--s_heading-->', '<!--e_heading-->', $content);
		$rowInfo = '';
        foreach ($headers as $item) {
			$rowInfo .=$arrBody[1];
			switch($item['align']) {
					case 'L':
						$align = 'align="left"';
						break;
					case 'R';
						$align = ' align="right"';
						break;
					default:
						$align = ' align="center"';
						break;
				}
			$rowInfo = str_replace('{width}', $item['width'], $rowInfo);
			$rowInfo = str_replace('{align}', $align, $rowInfo);
			$rowInfo = str_replace('{title}', $item['title'], $rowInfo);
		}
		$content = $arrBody[0].$rowInfo.$arrBody[2];
		$where = "where 1=1";
		foreach ($headers as $item) {
            $aColumns[] = '`'.strtolower($item['field']).'`';
			if($this->input->post(strtolower($item['field']))) {
				switch(strtolower($item['type'])) {
					case 'varchar':
					case 'longtext':
					case 'int':
						$where .= " and {$item['field']} like '%".real_escape_string($this->input->post(strtolower($item['field'])))."%'";
						break;
					case 'list':
						if($this->input->post(strtolower($item['field'])) != 'all') {
							$where .= " and {$item['field']} = '".real_escape_string($this->input->post(strtolower($item['field'])))."'";    
						}
						break;
					default:
						break;
				}
			}else if($this->input->post(strtolower($item['field'].'_start')) and strtotime($this->input->post(strtolower($item['field'].'_start')))) {
				$where .= " and `{$item['field']}` >= '".real_escape_string($this->input->post(strtolower($item['field'].'_start')))."'";
			} 
			 else if($this->input->post(strtolower($item['field'].'_from'))) {
				$where .= " and `{$item['field']}` >= ".(int)($this->input->post(strtolower($item['field'].'_from')))."";
			}
			if($this->input->post(strtolower($item['field'].'_end')) and strtotime($this->input->post(strtolower($item['field'].'_end')))){
				 $where .= " and `{$item['field']}` <= '".real_escape_string($this->input->post(strtolower($item['field'].'_end')))."'";
			}
			if($this->input->post(strtolower($item['field'].'_to'))) {
				$where .= " and `{$item['field']}` <= ".(int)($this->input->post(strtolower($item['field'].'_to')))."";
			} 
        }

        $sTable = (($tab['query']!='') && (!is_null($tab['query'])))?$tab['query']:$tab['table_name'];
		if(is_null($tab['limit_export']))
        $sql = "select sql_calc_found_rows " . str_replace(' , ', ' ', implode(', ', $aColumns)) . "
                from {$sTable} {$where};";
		else {
			if(($this->session->userdata_vnefrc('user_id'))){
        	$detail_user = $this->user->get_detail_user($this->session->userdata_vnefrc('user_id'));
			$level= $detail_user['user_level'];
			}
			else 
			$level = 0;
		$arrlimit = explode(";",$tab['limit_export']);
		$limit = isset($arrlimit[$level]) ? $arrlimit[$level] :10;
		$sql = "select sql_calc_found_rows " . str_replace(' , ', ' ', implode(', ', $aColumns)) . "
                from {$sTable} {$where} limit {$limit};";
		}
        $data = $this->db->query($sql)->result_array();
		$arrBody = $this->dbutil->PartitionString('<!--s_body-->', '<!--e_body-->', $content);
		$rowInfo = '';
		$i= 0;
		foreach ($data as $key => $value) {
			$rowInfo .='<tr>';
            foreach($headers as $item) {
                switch($item['align']) {
					case 'L':
						$align = ' class="align-left"';
						break;
					case 'R';
						$align = ' class="align-right"';
						break;
					default:
						$align = ' class="align-center"';
						break;
				}
				$rowInfo .=$arrBody[1];
				if ($i % 2) 
				$rowInfo = str_replace('{color}', '#f7f7f7', $rowInfo);
				else
				$rowInfo = str_replace('{color}', '#fffff', $rowInfo);
				if($item['hidden']==1){
					$length = strlen($value[strtolower($item['field'])]);
					$rowInfo = str_replace('{body}', '<div'.$align.'>'.str_repeat('*',$length).'</div>', $rowInfo);
				}
				else
				$rowInfo = str_replace('{body}', '<div'.$align.'>'.$value[strtolower($item['field'])].'</div>', $rowInfo);
				$i ++;
            }
			$rowInfo .='</tr>';
        }
		$content = $arrBody[0].$rowInfo.$arrBody[2];
		return $content;
	}
    
    function update_tab_modal() {
		$table_name = $_POST['table_name_parent'];
        $keys = TRIM($_POST['keys']);
        $headers = $this->tab->tab_type($table_name);
		$sqlkey = "SELECT `keys` FROM efrc_summary WHERE table_name = '{$table_name}'";
		$keyARR = $this->db->query($sqlkey)->row_array();
		$eq = array();		
		if($keys==''){
			$arr = explode(',',$keyARR['keys']);
			foreach($arr as $v){ 
				$aa[] = TRIM($v);
				$eq[] = isset($_POST[TRIM($v)])?$_POST[TRIM($v)]:'';
			}
			$wh = array_combine($aa,$eq);  
			
			$where = '1 = 1';
			foreach($wh as $key=>$value){  
				$where .= " and `$key` = {$value}";
			}
			$sql_keys = "SELECT * FROM {$table_name} WHERE {$where}";
			$reult = $this->db->query($sql_keys)->row_array();
			if(count($reult)>=1){
				$status =false;
			}
			else {
				$column ='';
				$value_column='';
				foreach ($headers as $item) {
					$column .= $column==''? "`{$item['Field']}`" : " , `{$item['Field']}`";
					$value_column .=$value_column==''? "'".$_POST[$item['Field']]."'" : " , '".$_POST[$item['Field']]."'";
				} 
				$sql = "INSERT  INTO {$table_name} ($column) VALUES ({$value_column});";
				$status = $this->db->query($sql);
			}
		}
		else{
			$eql = explode(' ,',$keys);
			foreach($eql as $vl){ 
				$eq[] = TRIM($vl);
			}
			$arr = explode(',',$keyARR['keys']);
			foreach($arr as $v){ 
				$aa[] = TRIM($v);
			}
			$wh = array_combine($aa,$eq);  
			
			$where = '1 = 1';
			foreach($wh as $key=>$value){  
				$where .= " and `$key` = {$value}";
			}
			$update = '';
			foreach ($headers as $item) {
				$update .= $update==''? "`{$item['Field']}` = '".$_POST[$item['Field']]."'" : " , `{$item['Field']}` = '".$_POST[$item['Field']]."'";
			}  
			
        	$sql = "UPDATE {$table_name} SET {$update} WHERE {$where} ;";
			$status = $this->db->query($sql);
		}        
        $this->output->set_output(json_encode($status));
    }
	public function sendfeedback() {
        $name = $_POST['contact_name'];
        $email = $_POST['contact_email'];
        $message = $_POST['contact_message'];
        $subject = $_POST['url_send'];
        $to = 'contact_efrc@ifrc.fr';
        $send = $this->sendmail($to, $to, $name, $subject, $message, $name, $email);
        echo $send == 1 ? 1 : 0;
        exit();
    }
	public function sendmail($mailto, $nameto, $namefrom, $subject, $noidung, $namereplay, $emailreplay) {
        $mail = new PHPMailer();
        $mail->IsSMTP(); // set mailer to use SMTP
        $mail->Host = "auth.smtp.1and1.fr"; // specify main and backup server
        $mail->Port = 587; // set the port to use
        $mail->SMTPAuth = true; // turn on SMTP authentication
        $mail->SMTPSecure = "tls";
        $mail->Username = "index@ifrc.fr"; // your SMTP username or your gmail username// Email gui thu
        $mail->Password = "welcome"; // your SMTP password or your gmail password
        //$from = $mailfrom; // Reply to this email// Email khi reply
        $mail->CharSet = "utf-8";
        $from = $emailreplay; // Reply to this email// Email khi reply
        $to = $mailto; // Recipients email ID // Email nguoi nhan
        $name = $nameto; // Recipient's name // Ten cua nguoi nhan
        $mail->From = $from;
        $mail->FromName = $namefrom; // Name to indicate where the email came from when the recepient received// Ten nguoi gui
        $mail->AddAddress($to, $name);
        $mail->AddReplyTo($from, $namereplay); // Ten trong tieu de khi tra loi
        $mail->WordWrap = 50; // set word wrap
        $mail->IsHTML(true); // send as HTML
        $mail->Subject = $subject;
        $mail->Body = $noidung; //HTML Body
        $mail->AltBody = ""; //Text Body

        if (!$mail->Send()) {
            return 0;
        } else {
            return 1;
        }
    }
	public function checkCode() {
        $code = $_POST['validate_code'];        
        echo $code == $this->session->userdata_vnefrc('captcha_feedback') ? 1 : 0;
        exit();
    }
	function delete_row() {
	   
        $table_name = $_POST['table_name'];
        $keys = TRIM($_POST['keys']);
        $headers = $this->tab->tab_type($table_name);
		$sqlkey = "SELECT `keys` FROM vdm_summary WHERE table_name = '{$table_name}'";
		$keyARR = $this->db->query($sqlkey)->row_array();
		$eq = array();
        $eql = explode(' ,',$keys);
		foreach($eql as $vl){ 
			$eq[] = TRIM($vl);
		}
		$arr = explode(',',$keyARR['keys']);
		foreach($arr as $v){ 
			$aa[] = TRIM($v);
		}
		$wh = array_combine($aa,$eq);  
		
		$where = '1 = 1';
		foreach($wh as $key=>$value){  
			$where .= " and `$key` = {$value}";
		}
        //$respone ='false';
		$sql = "DELETE FROM {$table_name} WHERE {$where}";
        
        $respone = $this->db->query($sql);
        
        $this->output->set_output(json_encode($respone));
    }

}