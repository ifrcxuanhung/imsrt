<?php

require('_/modules/welcome/controllers/block.php');

class Demo extends Welcome{
    public function __construct() {
        parent::__construct();
        $this->load->model('demo_model', 'demo');
		$this->load->model('Tab_model', 'tab');
    }

    public function index()
    {
		if(isset($_REQUEST['act'])&&($_REQUEST['act']=='export')){
			$this->export();
		}
		if(isset($_REQUEST['act_summary'])&&($_REQUEST['act_summary']=='exportTxt' || $_REQUEST['act_summary']=='exportCsv' || $_REQUEST['act_summary']=='exportXls')){
			$this->exportSum();
		}
        $information = $this->demo->load_information();
        foreach($information as $key=> $value)
        {
            $information[$key] = $value;
        }
        $this->data->information = $information;
        $headers_table_step1 = $this->demo->get_headers('efrc_publications');
      
        $this->data->headers_table_step1 = $this->get_header_demo($headers_table_step1,'efrc_publications');
        //var_export( $this->data->headers_table_step1);die();
        $headers_table_step2 = $this->demo->get_headers('efrc_demo_idx_ref');
		$this->data->headers_table_step2 = $this->get_header_demo($headers_table_step2,'efrc_demo_idx_ref');
        
        $headers_table_step3 = $this->demo->get_headers('efrc_demo_test');        
        $this->data->headers_table_step3 = $this->get_header_demo($headers_table_step3,'efrc_demo_test'); 
       
        
		$headers_table_stepfinal = $this->demo->get_headers('efrc_demo_summary');
        $this->data->headers_table_stepfinal = $this->get_header_demo($headers_table_stepfinal,'efrc_demo_summary'); 
        
        $table_summary_demo = $this->demo->get_table_summary_demo();
		$arr_table_summary_demo = array();
		 foreach ($table_summary_demo as $key => $value) {
			 $arr_table_summary_demo[$value['table_name']] = $value['description'];
			  $headers_table_sub = $this->demo->get_headers($value['table_name']);
			 $this->data->headers_table_sub_summary[$value['table_name']] = $this->get_header_demo($headers_table_sub,$value['table_name']); 
		 }
		$this->data->arr_table_summary_demo = $arr_table_summary_demo;
		//script
		$headers_table_script = $this->demo->get_headers('efrc_demo_save');
        $this->data->headers_table_script = $this->get_header_script($headers_table_script,'efrc_demo_save'); 
		
        $this->template->write_view('content', 'demo/index', $this->data);
        $this->template->render();  
    }
    
    
    function get_header_demo($headers_table_step1,$table){
		  foreach ($headers_table_step1 as $key => $value) {
            if(($value['active'] == 1)&& ($value['type_search'] == 1)) {
                switch(strtolower($value['type'])) {
                    case 'varchar':
                    case 'longtext':
                    case 'int':
                        $headers_table_step1[$key]['filter'] = $this->demo->append_input_text(strtolower($value['field']));
                        break;
                    case 'list':
                        $headers_table_step1[$key]['filter'] = $this->demo->append_select(strtolower($value['field']),$table);
                        break;
                    case 'date':
                        $headers_table_step1[$key]['filter'] = $this->demo->append_date(strtolower($value['field']));
                        break;
                    default:
                        $headers_table_step1[$key]['filter'] = '';
                }
            } else {
                $headers_table_step1[$key]['filter'] = '';
            }
        }
		return $headers_table_step1;
	}
	function get_header_script($headers,$table){
        foreach ($headers as $key => $value) {
            if(($value['active'] == 1) && ($value['type_search'] == 1)) {
                switch(strtolower($value['type'])) {
                    case 'varchar':
                    case 'longtext':
                    case 'int':
					case 'link':
					case 'efrc_link':
                        $headers[$key]['filter'] = $this->tab->append_input(strtolower($value['field']));
                        break;
                    case 'list':
                        $headers[$key]['filter'] = $this->tab->append_select(strtolower($value['field']),$table);
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
		return $headers;
	}
	function get_body_demo($table, $field_text, $name_text,$value_text){
		$table = $_GET['table'];
        $iDisplayLength = intval($_REQUEST['length']);
        $iDisplayStart = intval($_REQUEST['start']);
        $sEcho = intval($_REQUEST['draw']);
		//$datascript = explode (':;', $datascript);
        // select columns
        $where = "where 1=1";
        $headers = $this->demo->get_headers($table);
        $aColumns = array();
        foreach ($headers as $item) {
			$aColumns[] = '`'.strtolower($item['field']).'`';
            if($item['active'] == 1) {                
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
        $sTable = "(Select * FROM $table) as sTable";    
        $iTotalRecords = $this->db->get($sTable)->num_rows();
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
        // order
         $order_by = "";
        if (isset($_REQUEST['order'][0]['column'])) {
            $iSortCol_0 = $_REQUEST['order'][0]['column'];
            $sSortDir_0 = $_REQUEST['order'][0]['dir'];
            foreach($aColumns as $key => $value) {
                if($iSortCol_0 == $key) {
                    $order_by = "order by $value ".$sSortDir_0;
                    break;
                }
            }
        }

        $sql = "select sql_calc_found_rows " . str_replace(' , ', ' ', implode(', ', $aColumns)) . "
                from {$sTable} {$where} {$order_by} limit {$iDisplayStart}, {$iDisplayLength};";
				//var_export($sql);
        $data = $this->db->query($sql)->result_array();

        $sql = "select count(*) count
                from {$sTable} {$where}";
        $iFilteredTotal = $this->db->query($sql)->row()->count;

        $records = array();
        $records["data"] = array();
        
        foreach ($data as $key => $value) {
			//if(in_array($value[$field_text],$datascript)) $check = ' checked="checked"';
			//else $check ="";
            $records["data"][$key][] = '<input type="checkbox" class="checkbox-list" data-title="'.$value[$field_text].'" name="'.$name_text.'[]" value="'.$value[$value_text].'">';
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
							$records["data"][$key][] = '<a class="btn default btn-xs green" href="'.base_url().$value[strtolower($item['field'])].'"'.$align.'>
										<i class="fa fa-globe"></i> '.trim($str).' </a>';
							
						}
						else if((strpos(strtolower($item['type']),'link')!==false)&&$value[strtolower($item['field'])]!=''){
							$start = strpos(strtolower($item['type']),'(');
							$end = strpos(strtolower($item['type']),')');
							$str = ($start!==false && $end!==false) ? substr($item['type'],$start,  $end - $start) : 'Link';
							if(strpos($value[strtolower($item['field'])], 'http')===false && strpos($value[strtolower($item['field'])], 'https')===false)
							$records["data"][$key][] = '<a class="btn default btn-xs green" href="http://'.$value[strtolower($item['field'])].'" target="_blank"'.$align.'>
										<i class="fa fa-globe"></i> '.trim($str).' </a>';							
							
							else {
								$records["data"][$key][] = '<a class="btn default btn-xs green" href="'.$value[strtolower($item['field'])].'" target="_blank"'.$align.'>
										<i class="fa fa-globe"></i> '.trim($str).' </a>';
								
							}
						} else if((strtolower($item['type'])=='file')&&$value[strtolower($item['field'])]!=''){
							if(isset($downloadFile['value']) && $downloadFile['value']<=$this->session->userdata_vnefrc('user_level'))
							$records["data"][$key][] = '<a  href="'.base_url().'assets/upload/pdf/'.$value[strtolower($item['field'])].'" download="'.$value[strtolower($item['field'])].'"'.$align.'>
										<img src="'.base_url().'assets/templates/welcome/img/pdf.png" style="height:30px; width:30px;"> </a>';
							else $records["data"][$key][]='';
							
						}
						else if((strpos(strtolower($item['format_n']),'decimal')!==false)&&$value[strtolower($item['field'])]!=''){
							$start = strpos(strtolower($item['format_n']),'(') +1;
							$end = strpos(strtolower($item['format_n']),')');
							$str = ($start!==false && $end!==false) ? intval(substr($item['format_n'],$start,  $end - $start)) : 0;
							var_export($str);
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
                    		$records["data"][$key][] = '<a class="btn default btn-xs green" href="'.base_url().$value[strtolower($item['field'])].'"'.$align.'>
										<i class="fa fa-globe"></i> '.trim($str).' </a>';
						}
						else if((strpos(strtolower($item['type']),'link')!==false)&&$value[strtolower($item['field'])]!=''){
							$start = strpos(strtolower($item['type']),'(') +1;
							$end = strpos(strtolower($item['type']),')');
							$str = ($start!==false && $end!==false) ? substr($item['type'],$start,  $end - $start) : 'Link';
							if(strpos($value[strtolower($item['field'])], 'http')===false && strpos($value[strtolower($item['field'])], 'https')===false)
							$records["data"][$key][] = '<a class="btn default btn-xs green" href="http://'.$value[strtolower($item['field'])].'" target="_blank"'.$align.'>
										<i class="fa fa-globe"></i> '.trim($str).' </a>';							
							
							else {
								
								$records["data"][$key][] = '<a class="btn default btn-xs green" href="'.$value[strtolower($item['field'])].'" target="_blank"'.$align.'>
										<i class="fa fa-globe"></i> '.trim($str).' </a>';
								
							}
						}						
						else if((strtolower($item['type'])=='file')&&$value[strtolower($item['field'])]!=''){
							if(isset($downloadFile['value']) && $downloadFile['value']<=$this->session->userdata_vnefrc('user_level'))
							$records["data"][$key][] = '<a  href="'.base_url().'assets/upload/pdf/'.$value[strtolower($item['field'])].'" download="'.$value[strtolower($item['field'])].'"'.$align.'>
										<img src="'.base_url().'assets/templates/welcome/img/pdf.png" style="height:30px; width:30px;"> </a>';
							else $records["data"][$key][]='';
							
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
            $records["data"][$key][] = '';
        }
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iFilteredTotal;
		return $records;
	}
	function get_body_script() {
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
        $headers = $this->demo->get_headers($tab['table_name']);
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
		$user_id = $this->session->userdata_vnefrc('user_id') ? $this->session->userdata_vnefrc('user_id') : 0;
		$where .= " and id_user=$user_id";
		$sTable =(($tab['query']!='') && (!is_null($tab['query'])))?$tab['query']:$tab['table_name'];		
         $sqlColumn = "SHOW COLUMNS FROM {$sTable};";  
		 $arrColumn = $this->db->query($sqlColumn)->result_array(); 
		 foreach ($arrColumn as $item){			 		 
			 if(!$this->input->post(strtolower($item['Field'])) && isset($_GET[$item['Field']]) && strtolower($item['Field']!='tab'))
			 $where .= " and `{$item['Field']}` = '".$_GET[$item['Field']]."'";
		 }
		 $sql = "select count(*) count
                from {$sTable} {$where}";
        $iFilteredTotal = $this->db->query($sql)->row()->count;
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
        $data = $this->db->query($sql)->result_array();
		$ke = explode(',',$keyARR['keys']);
        //$aColumns[] = '`'.strtolower($item['field']).'`';
        
        $arr = explode(',',$keyARR['keys']);
        foreach($arr as $v){ 
            $aa[] = '`'.TRIM($v).'`';
        }
		$edit_table =  $this->tab->get_config('edit_table');    
        $records = array();
        $records["data"] = array();
        foreach ($data as $key => $value) {
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
			   $keys[] = "".$value[strtolower($val)]." ";
		   
		    }
			//print_r($keys);
			$k = implode(',',$keys);
            //$records["data"][$key][] = '';
			$sql = "select `publication_title`, `research_title`, `test_title`,`publication_value`, `research_value`, `test_value`,`title_save`
                from efrc_demo_save 
                where id = $k";
			$data_script = $this->db->query($sql)->row_array();
			//var_export($data_script);
			$records["data"][$key][] .= '<center><div class="align-center">'
										.'<a class="btn default btn-xs green load_script_db" keys="'.$k.'" href="#" publication_title="'.$data_script['publication_title'].'" research_title="'.$data_script['research_title'].'" test_title="'.$data_script['test_title'].'" publication_value="'.$data_script['publication_value'].'" research_value="'.$data_script['research_value'].'" test_value="'.$data_script['test_value'].'" script_title="'.$data_script['title_save'].'">
										 <li><span class="glyphicon glyphicon-cloud-download">
										</span>
										<span class="bs-glyphicon-class">
										Choose </span></li></a>'
										.'<a class="btn default btn-xs red delete_script_db" href="#" keys="'.$k.'">
                                        <i class="fa fa-trash-o"></i></a>'
										.'</div></center>';
        }

        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iFilteredTotal;
          
        $this->output->set_output(json_encode($records));
    }
    function table_stepone() {
		$data_script = isset($_POST["data_pulication"]) ? $_POST["data_pulication"] : ""; 
        $records = $this->get_body_demo('efrc_publications','title','publication','title',$data_script);     
          
        $this->output->set_output(json_encode($records));
    }
    
    function table_steptwo() {
		$data_script = isset($_POST["data_research"]) ? $_POST["data_research"] : ""; 
		$records = $this->get_body_demo('efrc_demo_idx_ref','idx_code','research','idx_name_sn', $data_script);     
        $this->output->set_output(json_encode($records));
    }
    
    function table_stepthree() {
		$data_script = isset($_POST["data_test"]) ? $_POST["data_test"] : ""; 
		$records = $this->get_body_demo('efrc_demo_test','test','test','selection', $data_script);     
        $this->output->set_output(json_encode($records));
    }
    
    function table_final() {
        $iDisplayLength = intval($_REQUEST['length']);
        $iDisplayStart = intval($_REQUEST['start']);
        $sEcho = intval($_REQUEST['draw']);
        // select columns
        $where = "where 1=1";
        $headers = $this->demo->get_headers('efrc_demo_summary');
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
		$sTable = '(Select * FROM efrc_demo_summary where `active` = 1) as sTable';
        //$sTable = '(Select * FROM efrc_test_autocorrelation where `idx_code` in ('.$code.')) as sTable';  
		 $sql = "select count(*) count
                from {$sTable} {$where}";
        $iFilteredTotal = $iTotalRecords = $this->db->query($sql)->row()->count;
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
        // order
         $order_by = "";
        if (isset($_REQUEST['order'][0]['column'])) {
            $iSortCol_0 = $_REQUEST['order'][0]['column'];
            $sSortDir_0 = $_REQUEST['order'][0]['dir'];
            foreach($aColumns as $key => $value) {
                if($iSortCol_0 == $key) {
                    $order_by = "order by $value ".$sSortDir_0;
                    break;
                }
            }
        }
        $sql = "select sql_calc_found_rows " . str_replace(' , ', ' ', implode(', ', $aColumns)) . "
                from {$sTable} {$where} {$order_by} limit {$iDisplayStart}, {$iDisplayLength};";
        $data = $this->db->query($sql)->result_array();       

        $records = array();
        $records["data"] = array();
        
        foreach ($data as $key => $value) {
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
							$records["data"][$key][] = '<a class="btn default btn-xs green" href="'.base_url().$value[strtolower($item['field'])].'"'.$align.'>
										<i class="fa fa-globe"></i> '.trim($str).' </a>';
							
						}
						else if((strpos(strtolower($item['type']),'link')!==false)&&$value[strtolower($item['field'])]!=''){
							$start = strpos(strtolower($item['type']),'(');
							$end = strpos(strtolower($item['type']),')');
							$str = ($start!==false && $end!==false) ? substr($item['type'],$start,  $end - $start) : 'Link';
							if(strpos($value[strtolower($item['field'])], 'http')===false && strpos($value[strtolower($item['field'])], 'https')===false)
							$records["data"][$key][] = '<a class="btn default btn-xs green" href="http://'.$value[strtolower($item['field'])].'" target="_blank"'.$align.'>
										<i class="fa fa-globe"></i> '.trim($str).' </a>';							
							
							else {
								$records["data"][$key][] = '<a class="btn default btn-xs green" href="'.$value[strtolower($item['field'])].'" target="_blank"'.$align.'>
										<i class="fa fa-globe"></i> '.trim($str).' </a>';
								
							}
						} else if((strtolower($item['type'])=='file')&&$value[strtolower($item['field'])]!=''){
							if(isset($downloadFile['value']) && $downloadFile['value']<=$this->session->userdata_vnefrc('user_level'))
							$records["data"][$key][] = '<a  href="'.base_url().'assets/upload/pdf/'.$value[strtolower($item['field'])].'" download="'.$value[strtolower($item['field'])].'"'.$align.'>
										<img src="'.base_url().'assets/templates/welcome/img/pdf.png" style="height:30px; width:30px;"> </a>';
							else $records["data"][$key][]='';
							
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
                    		$records["data"][$key][] = '<a class="btn default btn-xs green" href="'.base_url().$value[strtolower($item['field'])].'"'.$align.'>
										<i class="fa fa-globe"></i> '.trim($str).' </a>';
						}
						else if((strpos(strtolower($item['type']),'link')!==false)&&$value[strtolower($item['field'])]!=''){
							$start = strpos(strtolower($item['type']),'(') +1;
							$end = strpos(strtolower($item['type']),')');
							$str = ($start!==false && $end!==false) ? substr($item['type'],$start,  $end - $start) : 'Link';
							if(strpos($value[strtolower($item['field'])], 'http')===false && strpos($value[strtolower($item['field'])], 'https')===false)
							$records["data"][$key][] = '<a class="btn default btn-xs green" href="http://'.$value[strtolower($item['field'])].'" target="_blank"'.$align.'>
										<i class="fa fa-globe"></i> '.trim($str).' </a>';							
							
							else {
								
								$records["data"][$key][] = '<a class="btn default btn-xs green" href="'.$value[strtolower($item['field'])].'" target="_blank"'.$align.'>
										<i class="fa fa-globe"></i> '.trim($str).' </a>';
								
							}
						}						
						else if((strtolower($item['type'])=='file')&&$value[strtolower($item['field'])]!=''){
							if(isset($downloadFile['value']) && $downloadFile['value']<=$this->session->userdata_vnefrc('user_level'))
							$records["data"][$key][] = '<a  href="'.base_url().'assets/upload/pdf/'.$value[strtolower($item['field'])].'" download="'.$value[strtolower($item['field'])].'"'.$align.'>
										<img src="'.base_url().'assets/templates/welcome/img/pdf.png" style="height:30px; width:30px;"> </a>';
							else $records["data"][$key][]='';
							
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
			
            $records["data"][$key][] .= '<center><div class="align-center">'
                                        .'<a class="btn default btn-xs blue result_detail" href="javascript:;" id="'.$value["table_name"].'">
                                        <i class="fa fa-globe"></i> Link</a>'
                                        .'</div></center>';
			
        }
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iFilteredTotal;
          
        $this->output->set_output(json_encode($records));
    }
    function table_sub_final() {
        $table_name = isset($_GET['table_name']) ? $_GET['table_name'] :'';
		$sqlkey = "SELECT `keys` FROM efrc_demo_summary WHERE table_name = '{$table_name}'";
        $keyARR = $this->db->query($sqlkey)->row_array();
		$key= '';
		foreach($keyARR as $vl){ 
            $key = TRIM($vl);
        }
        $data_rsfinal = isset($_POST['data_rsfinal']) ? $_POST['data_rsfinal'] : array('""');
		$codes = array();
        foreach($data_rsfinal as $value){
            $codes[] = "'".$value."'";
        }
        $code =implode(',',$codes);	
        $iDisplayLength = intval($_REQUEST['length']);
        $iDisplayStart = intval($_REQUEST['start']);
        $sEcho = intval($_REQUEST['draw']);
        // select columns
        $where = "where 1=1";
        $headers = $this->demo->get_headers($table_name);
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
		//$sTable = '(Select * FROM efrc_demo_summary where `active` = 1) as sTable';
        $sTable = '(Select * FROM '.$table_name. ' where `'.$key.'` in ('.$code.')) as sTable';  
		 $sql = "select count(*) count
                from {$sTable} {$where}";
        $iFilteredTotal = $iTotalRecords = $this->db->query($sql)->row()->count;
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
        // order
         $order_by = "";
        if (isset($_REQUEST['order'][0]['column'])) {
            $iSortCol_0 = $_REQUEST['order'][0]['column'];
            $sSortDir_0 = $_REQUEST['order'][0]['dir'];
            foreach($aColumns as $key => $value) {
                if($iSortCol_0 == $key) {
                    $order_by = "order by $value ".$sSortDir_0;
                    break;
                }
            }
        }
        $sql = "select sql_calc_found_rows " . str_replace(' , ', ' ', implode(', ', $aColumns)) . "
                from {$sTable} {$where} {$order_by} limit {$iDisplayStart}, {$iDisplayLength};";
        $data = $this->db->query($sql)->result_array();       

        $records = array();
        $records["data"] = array();
        
        foreach ($data as $key => $value) {
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
							$records["data"][$key][] = '<a class="btn default btn-xs green" href="'.base_url().$value[strtolower($item['field'])].'"'.$align.'>
										<i class="fa fa-globe"></i> '.trim($str).' </a>';
							
						}
						else if((strpos(strtolower($item['type']),'link')!==false)&&$value[strtolower($item['field'])]!=''){
							$start = strpos(strtolower($item['type']),'(');
							$end = strpos(strtolower($item['type']),')');
							$str = ($start!==false && $end!==false) ? substr($item['type'],$start,  $end - $start) : 'Link';
							if(strpos($value[strtolower($item['field'])], 'http')===false && strpos($value[strtolower($item['field'])], 'https')===false)
							$records["data"][$key][] = '<a class="btn default btn-xs green" href="http://'.$value[strtolower($item['field'])].'" target="_blank"'.$align.'>
										<i class="fa fa-globe"></i> '.trim($str).' </a>';							
							
							else {
								$records["data"][$key][] = '<a class="btn default btn-xs green" href="'.$value[strtolower($item['field'])].'" target="_blank"'.$align.'>
										<i class="fa fa-globe"></i> '.trim($str).' </a>';
								
							}
						} else if((strtolower($item['type'])=='file')&&$value[strtolower($item['field'])]!=''){
							if(isset($downloadFile['value']) && $downloadFile['value']<=$this->session->userdata_vnefrc('user_level'))
							$records["data"][$key][] = '<a  href="'.base_url().'assets/upload/pdf/'.$value[strtolower($item['field'])].'" download="'.$value[strtolower($item['field'])].'"'.$align.'>
										<img src="'.base_url().'assets/templates/welcome/img/pdf.png" style="height:30px; width:30px;"> </a>';
							else $records["data"][$key][]='';
							
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
                    		$records["data"][$key][] = '<a class="btn default btn-xs green" href="'.base_url().$value[strtolower($item['field'])].'"'.$align.'>
										<i class="fa fa-globe"></i> '.trim($str).' </a>';
						}
						else if((strpos(strtolower($item['type']),'link')!==false)&&$value[strtolower($item['field'])]!=''){
							$start = strpos(strtolower($item['type']),'(') +1;
							$end = strpos(strtolower($item['type']),')');
							$str = ($start!==false && $end!==false) ? substr($item['type'],$start,  $end - $start) : 'Link';
							if(strpos($value[strtolower($item['field'])], 'http')===false && strpos($value[strtolower($item['field'])], 'https')===false)
							$records["data"][$key][] = '<a class="btn default btn-xs green" href="http://'.$value[strtolower($item['field'])].'" target="_blank"'.$align.'>
										<i class="fa fa-globe"></i> '.trim($str).' </a>';							
							
							else {
								
								$records["data"][$key][] = '<a class="btn default btn-xs green" href="'.$value[strtolower($item['field'])].'" target="_blank"'.$align.'>
										<i class="fa fa-globe"></i> '.trim($str).' </a>';
								
							}
						}						
						else if((strtolower($item['type'])=='file')&&$value[strtolower($item['field'])]!=''){
							if(isset($downloadFile['value']) && $downloadFile['value']<=$this->session->userdata_vnefrc('user_level'))
							$records["data"][$key][] = '<a  href="'.base_url().'assets/upload/pdf/'.$value[strtolower($item['field'])].'" download="'.$value[strtolower($item['field'])].'"'.$align.'>
										<img src="'.base_url().'assets/templates/welcome/img/pdf.png" style="height:30px; width:30px;"> </a>';
							else $records["data"][$key][]='';
							
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
            $records["data"][$key][] = '';
        }
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iFilteredTotal;
          
        $this->output->set_output(json_encode($records));
    }
    function export() {
		$table_name = isset($_POST['table_name']) ? $_POST['table_name'] :'';
		$sqlkey = "SELECT `keys` FROM efrc_demo_summary WHERE table_name = '{$table_name}'";
        $keyARR = $this->db->query($sqlkey)->row_array();
		$key= '';
		foreach($keyARR as $vl){ 
            $key = TRIM($vl);
        }
        $data_rsfinal = isset($_POST['data_rsfinal_'.$table_name]) ? $_POST['data_rsfinal_'.$table_name] : "";
		$data_rsfinal =explode(',',$data_rsfinal);
		$codes = array();
        foreach($data_rsfinal as $value){
            $codes[] = "'".trim($value)."'";
        }
        $code =implode(',',$codes);	
        // select columns
        $where = "where 1=1";
        $headers = $this->demo->get_headers($table_name);
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


         $sTable = '(Select * FROM '.$table_name. ' where `'.$key.'` in ('.$code.')) as sTable';  
        $sql = "select sql_calc_found_rows " . str_replace(' , ', ' ', implode(', ', $aColumns)) . "
                from {$sTable} {$where};";
        $this->load->dbutil();
        $query = $this->db->query($sql)->result_array();
		if(isset($_REQUEST['action_sub_'.$table_name])&&($_REQUEST['action_sub_'.$table_name]=='exportCsv')){
		$this->dbutil->export_to_csv("{$table_name}", $query, $aColumnsHeader, null,",", true);
		}
		else if(isset($_REQUEST['action_sub_'.$table_name])&&($_REQUEST['action_sub_'.$table_name]=='exportTxt')){
		$this->dbutil->export_to_txt("{$table_name}", $query, $aColumnsHeader, null,chr(9), true);
		}
		else if(isset($_REQUEST['action_sub_'.$table_name])&&($_REQUEST['action_sub_'.$table_name]=='exportXls')){
		$content = file_get_contents(base_url().'assets/download/tab_xls.php');
		$this->load->dbutil();
		$arrBody = $this->dbutil->PartitionString('<!--s_heading-->', '<!--e_heading-->', $content);
		$rowInfo = '';
        foreach ($headers as $item) {
			if($item['active'] == 1) {
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
		}
		        
		$content = $arrBody[0].$rowInfo.$arrBody[2];
		$arrBody = $this->dbutil->PartitionString('<!--s_body-->', '<!--e_body-->', $content);
		$rowInfo = '';
		$i= 0;
		foreach ($query as $key => $value) {
			$rowInfo .='<tr>';
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
            }
			$rowInfo .='</tr>';
        }
		$content = $arrBody[0].$rowInfo.$arrBody[2];
		header ( "Expires: Mon, 1 Apr 1974 05:00:00 GMT");
		header ( "Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT" );
		header ( "Pragma: no-cache" );
		header ( "Content-type: application/msexcel");
		header ( "Content-Disposition: inline; filename=\"{$table_name}_".date("dmYhi").".xls\"");
		print($content);
		}
		unset($headers);		
		die();
		
    }
	function exportSum() {
		$table_name = 'efrc_demo_summary';
        $where = "where 1=1";
        $headers = $this->demo->get_headers($table_name);
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
 
        $sql = "select sql_calc_found_rows " . str_replace(' , ', ' ', implode(', ', $aColumns)) . "
                from {$table_name} {$where};";
        $this->load->dbutil();
        $query = $this->db->query($sql)->result_array();
		if(isset($_REQUEST['act_summary'])&&($_REQUEST['act_summary']=='exportCsv')){
		$this->dbutil->export_to_csv("{$table_name}", $query, $aColumnsHeader, null,",", true);
		}
		else if(isset($_REQUEST['act_summary'])&&($_REQUEST['act_summary']=='exportTxt')){
		$this->dbutil->export_to_txt("{$table_name}", $query, $aColumnsHeader, null,chr(9), true);
		}
		else if(isset($_REQUEST['act_summary'])&&($_REQUEST['act_summary']=='exportXls')){
		$content = file_get_contents(base_url().'assets/download/tab_xls.php');
		$this->load->dbutil();
		$arrBody = $this->dbutil->PartitionString('<!--s_heading-->', '<!--e_heading-->', $content);
		$rowInfo = '';
        foreach ($headers as $item) {
			if($item['active'] == 1) {
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
		}
		        
		$content = $arrBody[0].$rowInfo.$arrBody[2];
		$arrBody = $this->dbutil->PartitionString('<!--s_body-->', '<!--e_body-->', $content);
		$rowInfo = '';
		$i= 0;
		foreach ($query as $key => $value) {
			$rowInfo .='<tr>';
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
            }
			$rowInfo .='</tr>';
        }
		$content = $arrBody[0].$rowInfo.$arrBody[2];
		header ( "Expires: Mon, 1 Apr 1974 05:00:00 GMT");
		header ( "Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT" );
		header ( "Pragma: no-cache" );
		header ( "Content-type: application/msexcel");
		header ( "Content-Disposition: inline; filename=\"{$table_name}_".date("dmYhi").".xls\"");
		print($content);
		}
		unset($headers);		
		die();
		
    }
    
    function status_modal() {

        $this->load->view('demo/status_modal',$this->data);
    }
	function save_script() {
		$id = isset($_POST["id_save"])?$_POST["id_save"]:'';
		$pulication_save = isset($_POST["pulication_save"])?implode(":;",real_escape_string($_POST["pulication_save"])):"";
		$research_save = isset($_POST["research_save"])?implode(":;",real_escape_string($_POST["research_save"])):"";
		$test_save = isset($_POST["test_save"])?implode(":;",real_escape_string($_POST["test_save"])):"";
		$pulication_save_value = isset($_POST["pulication_save_value"])?implode(":;",real_escape_string($_POST["pulication_save_value"])):"";
		$research_save_value = isset($_POST["research_save_value"])?implode(":;",real_escape_string($_POST["research_save_value"])):"";
		$test_save_value = isset($_POST["test_save_value"])?implode(":;",real_escape_string($_POST["test_save_value"])):"";
		$title_save = isset($_POST["title_save"])?real_escape_string($_POST["title_save"]):'';
		$date_modifield = date('Y-m-d H:i:s');
		$date_add = date('Y-m-d H:i:s');
		$user_id = $this->session->userdata_vnefrc('user_id') ? $this->session->userdata_vnefrc('user_id') : 0;
		$reult = array();
		if($id!=''){
			$sql_keys = "SELECT * FROM efrc_demo_save WHERE id=".$id;
			$reult = $this->db->query($sql_keys)->row_array();
		}
		if(count($reult)>=1){
			$sql = "UPDATE efrc_demo_save SET `id_user`=".$user_id.", `publication_title` ='".$pulication_save."', `research_title` ='".$research_save."', `test_title` ='".$test_save."', `publication_value` ='".$pulication_save_value."', `research_value` ='".$research_save_value."', `test_value` ='".$test_save_value."',`title_save` ='".$title_save."', `date_modified`='".$date_modifield."' WHERE id=".$id;
			
		}
		else {
			$sql = "INSERT  INTO efrc_demo_save ( `id_user`, `publication_title`, `research_title`, `test_title`, `publication_value`, `research_value`, `test_value`, `title_save`, `date_added` ) VALUES ('".$user_id ."','".$pulication_save ."','".$research_save."','".$test_save."','".$pulication_save_value ."','".$research_save_value."','".$test_save_value."','".$title_save."','".$date_add. "');";
		}
		$status = $this->db->query($sql);
        $this->output->set_output(json_encode($status));
		die();
    }
	function delete_script_row() {
	   
        $keys = TRIM($_POST['keys']);
		$where = " `id` = {$keys}";
		
        //$respone ='false';
		$sql = "DELETE FROM efrc_demo_save WHERE {$where}";
        
        $respone = $this->db->query($sql);
        
        $this->output->set_output(json_encode($respone));
    }
}