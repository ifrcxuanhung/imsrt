<?php
class Ajax extends Welcome{
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
        $this->load->model('Table__model', 'table');
    }
    
    public function index() {
        echo "test";
    }
	public function ims_time(){
        $data1 = $this->db->query("SELECT value FROM setting_rt WHERE `key` ='start'")->row_array();
		$result['ims_start'] = $data1['value'];
		$data2 = $this->db->query("SELECT value FROM setting_rt WHERE `key` ='end'")->row_array();
		$result['ims_end'] = $data2['value'];
		$data3 = $this->db->query("SELECT value FROM setting_rt WHERE `key` ='frequency'")->row_array();
		$result['ims_fre'] = "(".$data3['value'].")";
		$this->output->set_output(json_encode($result));
	}
	public function getImsStatus(){
		$setting_rt = $this->db->where('group','setting')->where('key','imsrt_status')->get('setting_rt')->row_array();
		$result['ims_staus'] = $setting_rt['value'];
		$this->output->set_output(json_encode($result));
	}
	public function loadfeed(){
		  $stk_feed_last = $this->db->select('time,code,last,update_time')->where('time <>','00:00:00')->order_by('date desc, update_time desc, time desc')->limit(5)
         ->get('stk_feed_rt')->result_array();	 
		$html_ = ''; 
		$i = 0;
	    foreach($stk_feed_last as $value){
			if($i>0)
    	    $html_ .= "<div class='cbp-filter-item-active cbp-filter-item uppercase'><span class='custom-margin label lable-sm label-danger'>".$value['update_time']."</span> <span class='custom-margin label lable-sm label-danger'>".$value['time']."</span>".$value['code']."<span class='custom-margin-left label lable-sm label-warning'>".number_format($value['last'], 3, '.', ',')."</span></div>";
			$i++;
        }
		$html_ .='';
		$result['update_time'] = isset($stk_feed_last[0]['update_time'])?$stk_feed_last[0]['update_time']:'';
		$result['time'] = isset($stk_feed_last[0]['time'])?$stk_feed_last[0]['time']:'';
		$result['codeint'] = isset($stk_feed_last[0]['code']) ? $stk_feed_last[0]['code'] :'';
		$result['last'] = isset($stk_feed_last[0]['last']) ? number_format($stk_feed_last[0]['last'], 3, '.', ',') :'';
        $result['list']=$html_;
		 $this->output->set_output(json_encode($result));

    }
	public function loadspecs_abnormal(){
		  $idx_specs_abnormal = $this->db->select('codeint,time,idx_dvar')->order_by('ABS(idx_dvar) desc')->limit(5)
         ->get('idx_specs_abnormal')->result_array();	 
		$html_ = ''; 
		$i = 0;
	    foreach($idx_specs_abnormal as $value){
			if($i>0)
    	    $html_ .= "<div class='cbp-filter-item-active cbp-filter-item uppercase'><span class='custom-margin label lable-sm label-danger'>".$value['time']."</span>".$value['codeint']."<span class='custom-margin-left label lable-sm label-warning'>".number_format($value['idx_dvar'], 2, '.', ',')." %</span></div>";
			$i++;
        }
		$html_ .='';
		$result['time'] = isset($idx_specs_abnormal[0]['time'])?$idx_specs_abnormal[0]['time']:'';
		$result['codeint'] = isset($idx_specs_abnormal[0]['codeint']) ? $idx_specs_abnormal[0]['codeint'] :'';
		$result['idx_dvar'] = isset($idx_specs_abnormal[0]['idx_dvar']) ? (number_format($idx_specs_abnormal[0]['idx_dvar'], 2, '.', ',').' %') :'';
        $result['list']=$html_;
		 $this->output->set_output(json_encode($result));

    }
	public function loadcur(){
		
		$cur_feed_rt = $this->db->select('time,code,last')->order_by('date desc, time desc')->limit(5)->get('cur_feed_rt')->result_array();
		 foreach($cur_feed_rt as $k_cur=>$var_cur){
			
		}
		
		$result['time'] = isset($cur_feed_rt[0]['time']) ? $cur_feed_rt[0]['time'] :'';
		$result['code'] = isset($cur_feed_rt[0]['code']) ? $cur_feed_rt[0]['code'] :'';
		$result['cunv'] = isset($cur_feed_rt[0]['last']) ? number_format($cur_feed_rt[0]['last'], 3, '.', ',') : '';
		$result['first']="<span class='custom-margin label lable-sm label-danger' id='cur_time'>".$cur_feed_rt[0]['time']."</span> <span id='cur_code'>".$cur_feed_rt[0]['code']."</span> <span class='custom-margin-left label lable-sm label-warning' id='cur_conv'>".number_format($cur_feed_rt[0]['last'], 3, '.', ','). "</span>";
		 $cur_feed_rt = array_slice($cur_feed_rt,1,4);
		 $html_ = ''; 
	    foreach($cur_feed_rt as $value){
    	    $html_ .= "<div class='cbp-filter-item-active cbp-filter-item uppercase'><span class='custom-margin label lable-sm label-danger'>".$value['time']."</span>".$value['code']."<span class='custom-margin-left label lable-sm label-warning'>".number_format($value['last'], 3, '.', ',')."</span></div>";
        }
		$result['list']=$html_;
		$this->output->set_output(json_encode($result));

    }
	public function loadcurrency(){
		
		// get stk_feed_last theo thoi gian giam dan
		 $stk_feed_last = $this->db->select('*')->order_by("time", "desc")->limit(5)
         ->get('stk_feed_last')->result_array();
		 
		  // get cur_feed_rt theo thoi gian giam dan
		 $cur_feed_rt = $this->db->select('*')->order_by("time", "desc")->get('cur_feed_rt')->result_array();
		 foreach($cur_feed_rt as $k_cur=>$var_cur){
			/*if($var_cur['currency'] == $var_cur['tos']){
				unset($cur_feed_rt[$k_cur]);	
			}*/
		}
		
		 $cur_feed_rt = array_slice($cur_feed_rt,0,5);
		$html_ = ''; 
	    foreach($stk_feed_last as $value){
    	    $abz = "<span class='custom-margin label lable-sm label-danger'>".$value['time']."</span>".$value['codeint']."<span class='custom-margin-left label lable-sm label-warning'>".number_format($value['stk_last'], 3, '.', ',')."</span>";
            $html_ .='<option  data-content="'.$abz.'">'.$value['codeint'].'</option>';
        }
		 
		$html ='';
		foreach($cur_feed_rt as $value_cur){
					$abc = "<span class='custom-margin label lable-sm label-danger'>
				".$value_cur['time']." </span> ".$value_cur['code']." <span class='custom-margin-left label lable-sm label-warning'>". number_format($value_cur['curr_conv'], 3, '.', ',')."</span>";
			$html .= '<option data-content="'.$abc.'">'.$value_cur['code'].'</option>';
		}
	   $result['cur_feed_rt']=$html;
       $result['stk_feed_last']=$html_;
       $this->output->set_output(json_encode($result));

    }
    public function create_session_menu() {
        $id_menu = $_POST['id_menu'];
        $this->session->set_userdata_vnefrc('id_menu', $id_menu);
        exit();
    }
    
    public function change_language()
    {
        $langcode = $_POST['langcode'];
        $sql = "SELECT * FROM `language` WHERE `code` = '".$langcode."'";
        $data = $this->db->query($sql)->result_array();
        $this->session->set_userdata_vnefrc(array('curent_language'=>$data[0]));
    }
	
	public function autocomplete_search_header_data()
    {
		
		$name = $_REQUEST['phrase'];
       $sql = "SELECT * FROM `efrc_data_ref` WHERE name LIKE '%$name%'";
        $data = $this->db->query($sql)->result_array();
		
		//echo "<pre>";print_r($data);exit;
		$this->output->set_output(json_encode($data));
    }
	public function autocomplete_search_header_ins()
    {
		
		$name = $_REQUEST['phrase'];
       $sql = "SELECT * FROM `efrc_ins_ref` WHERE name LIKE '%$name%'";
        $data = $this->db->query($sql)->result_array();
		
		//echo "<pre>";print_r($data);exit;
		$this->output->set_output(json_encode($data));
    }
    
    public function getPrice_realtime()
    {
        if (strpos(base_url(), 'local') !== false) {
            $config['hostname'] = "local.itvn.fr";
            $config['username'] = "local";
            $config['password'] = "ifrcvn";
        } else {
            $config['hostname'] = "localhost";
            $config['username'] = "vnxindex_user";
            $config['password'] = "indexvnx";
        }
        $config['database'] = "vnxindex_data";
        $config['dbdriver'] = "mysqli";
        $DB2 = $this->load->database($config, TRUE);
        $sql = "select idx_code, round(idx_last, 2) idx_last, date, time from idx_specs where idx_code = 'VNX25PRVND';";
        $results = $DB2->query($sql)->result_array();
        
        $rand = (int)(rand(0, 50));
        $results[0]['idx_last'] -= $rand < 25 ? $rand : - $rand;
        //$results2 = array();
        // foreach ( $results as $key => $value ) {
        //     $results2['data'][$value['idx_code']] = array(
        //         'idx_code' => $value['idx_code'],
        //         'last' => $value['idx_last']
        //     );
        // }
        //$results2['time'] = array( 'date' => date( 'Y-m-d', strtotime( $results[0]['date'] ) ), 'time' => $results[0]['time'] );
        //$results2['last'] = number_format($results[0]['idx_last'], 2, '.', ',');
        //$results = $results2;
        
        echo json_encode($results);
        exit();
    }
    public function loadtable(){
        //ini_set('memory_limit','512sM');
		
        $iDisplayLength = intval($_REQUEST['length']);
        $iDisplayStart = intval($_REQUEST['start']);
        
        $sEcho = intval($_REQUEST['draw']);
		$table = isset($_REQUEST['name_table'])? $_REQUEST['name_table'] :'';
	   //print_R($table);exit;
		
		$category = isset($_POST['category'])? strtoupper($_POST['category']) :'';
		$arr_table_sys = $this->table->get_summary_efrc($table);
		
		
		$table_sys = isset($arr_table_sys["table_name"]) ? $arr_table_sys["table_name"] : 'efrc_'.$table;
			
        //print_R($table_sys);exit;
		// select columns
		$where = "where 1=1 ";
       
		$headers = $this->table->get_headers($table_sys);
		//echo "<pre>";print_r($headers);exit;
		$aColumns = array();
		
		foreach ($headers as $item) {
	        if($item['format_n'] == 'group'){
	              $aColumns[] = '`'.strtolower($item['field'].'_frt').'`,`'.strtolower($item['field'].'_bcd').'`,`'.strtolower($item['field'].'_hst').'`';
	        }else{  
			     $aColumns[] = '`'.strtolower($item['field']).'`';
            }
			$field_post = $this->input->post(strtolower($item['field']));
			$field_post_html = $this->input->post(strtolower("html_".$item['field']));
			if(($field_post!='') || ($field_post_html!='')){
				$field_post = $field_post !='empty' ? $field_post :'';
				if((strpos(strtolower($item['type']),'list')!==false)){
					if($field_post == 'is_null')
					{
						$where .= " and (`{$item['field']}` is null OR `{$item['field']}` = '')"; 
					}
					else if($field_post != 'all') {
						$where .= " and `{$item['field']}` = '".$field_post."'";    
					}
					
				}
				else {
					switch(strtolower($item['type'])) {
						case 'varchar':
						case 'longtext':
						case 'int':
						case 'link':
							$where .= " and `{$item['field']}` like '%".$field_post."%'";
							break;
						case 'html':
						case 'info':
							$where .= " and `{$item['field']}` like '%".$field_post_html."%'";
							break;
						default:
							break;
					}
				}
			}else if($this->input->post('date_'.strtolower($item['field'].'_start')) and strtotime($this->input->post('date_'.strtolower($item['field'].'_start')))) {
				$where .= " and `{$item['field']}` >= '".real_escape_string($this->input->post('date_'.strtolower($item['field'].'_start')))."'";
			} 
			 else if($this->input->post(strtolower($item['field'].'_from'))) {
				$where .= " and `{$item['field']}` >= ".(int)($this->input->post(strtolower($item['field'].'_from')))."";
			}
			
			if($this->input->post('date_'.strtolower($item['field'].'_end')) and strtotime($this->input->post('date_'.strtolower($item['field'].'_end')))){
				 $where .= " and `{$item['field']}` <= '".real_escape_string($this->input->post('date_'.strtolower($item['field'].'_end')))."'";
			}
			if($this->input->post(strtolower($item['field'].'_to'))) {
				$where .= " and `{$item['field']}` <= ".(int)($this->input->post(strtolower($item['field'].'_to')))."";
			}
             
		}		
		$sTable = $table_sys; //$category == 'all' ? "efrc_".$table : "(SELECT * FROM efrc_".$table." where category = '".$category."') as sTable " ;	
		
		$sqlColumn = "SHOW COLUMNS FROM {$sTable};";  
		
		$arrColumn = $this->db->query($sqlColumn)->result_array(); 
		
		foreach ($arrColumn as $item){		 	
			if(!$this->input->post(strtolower($item['Field'])) && isset($_GET[$item['Field']]) && ($_GET[$item['Field']]!='all') && (strtolower($item['Field']!='tab'))){
				//print_r($_GET[$item['Field']]);exit;	
				 $where .= " and `{$item['Field']}` LIKE '%".$_GET[$item['Field']]."%'";
				 
			}
		 }
		// if($sTable=='efrc_summary'){
//			 $where .=' and `active` <= '.(($this->session->userdata_vnefrc('user_level')) ? $this->session->userdata_vnefrc('user_level'):0);
//		 };
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
		$order_by .= (($arr_table_sys['order_by']!='') && (!is_null($arr_table_sys['order_by'])))?($order_by =='' ? ('order by '.$arr_table_sys['order_by']):(','.$arr_table_sys['order_by'])):'';
        
        $sqlkey = "SELECT `keys`, `user_level` FROM efrc_summary WHERE `table_name` = '{$table_sys}'";
		$keyARR = $this->db->query($sqlkey)->row_array();
        if(isset($keyARR)){
            if(isset($keyARR['keys'])&&$keyARR['keys'] != ''){
        		$keyARR = isset($keyARR) ? $keyARR: array();
        		$arr = explode(',',$keyARR['keys']);
        		foreach($arr as $v){ 
        			$aa[] = '`'.TRIM($v).'`';
        		}   
        		$rs = in_array($aa, $aColumns, TRUE) ?  $aColumns : array_merge((array)$aa, (array)$aColumns);
                $ke = explode(',',$keyARR['keys']);	
            }else{
                $rs = $aColumns;
            }  
        }
		//print_R($rs);exit;
        $sql = "select SQL_NO_CACHE " .($table_sys=='efrc_summary' ? 'tab, ' :''). str_replace(' , ', ' ', implode(', ', $rs)) . "
    					from {$sTable} {$where} {$order_by};";
		$data = $this->db->query($sql)->result_array();
        
		//secho "<pre>";print_r($sql);exit;
		//$data = $this->db->query($sql)->result_array();  
		$arr_data = array();
		$i =0;
		foreach ($data as $key => $value) {
			$arr_data[$i] = $value;	
			$i++;		
		}
		
		//var_export($arr_data);
		$iFilteredTotal = $i;
		$iTotalRecords = $iFilteredTotal;
		$iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
		//$data = $this->db->query($sql)->result_array();   
		$records = array();
		$records["data"] = array();
		$key = 0;
		for ($x = $iDisplayStart; $x < $iDisplayStart + $iDisplayLength; $x++) {
			if(isset($arr_data[$x])) {
				$path = base_url().'assets/upload/intranet';
				if(isset($arr_data[$x]['group']) && $arr_data[$x]['group']!='') $path .='/'.strtolower($arr_data[$x]['group']);
				if(isset($arr_data[$x]['owner']) && $arr_data[$x]['owner']!='') $path .='/'.strtolower($arr_data[$x]['owner']);
				if(isset($arr_data[$x]['category']) && $arr_data[$x]['category']!='') $path .='/'.strtolower($arr_data[$x]['category']);
				if(isset($arr_data[$x]['subcat']) && $arr_data[$x]['subcat']!='') $path .='/'.strtolower($arr_data[$x]['subcat']);
                if($table == 'efrc_query_ref'){
			         $records["data"][$key][] = '<input type="checkbox" class="checkboxes" value="'.$arr_data[$x]['id'].'">';	// check s
                }
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
					if(($item['hidden']>= $this->session->userdata_vnefrc('user_level')) && ($item['hidden']!=0)){
						$pattern = '/[\S]/';
						$replacement = '*';
						$records["data"][$key][] = '<div'.$align.'>'. preg_replace($pattern, $replacement,  $arr_data[$x][strtolower($item['field'])]).'</div>';
					}
					else if((strpos(strtolower($item['format_n']),'decimal')!==false)&&$arr_data[$x][strtolower($item['field'])]!=''){
						$start = strpos(strtolower($item['format_n']),'(') +1;
						$end = strpos(strtolower($item['format_n']),')');
						$str = ($start!==false && $end!==false) ? intval(substr($item['format_n'],$start,  $end - $start)) : 0;
						$records["data"][$key][] = '<div'.$align.'>'.number_format((float)$arr_data[$x][strtolower($item['field'])], intval($str), '.', ',').'</div>';
					}
					
					else if($item['format_n'] == 'group'){	
						$records["data"][$key][] = '<div'.$align.'><a href="http://'.$arr_data[$x][strtolower($item['field']).'_frt'].'" '.($arr_data[$x][strtolower($item['field']).'_frt'] != '' ? '' : 'disabled') .' target="_blank" class="btn btn-sm default btn-'.(isset($arr_data[$x][strtolower($item['field']).'_hst']) ? strtolower(str_replace(' ','',$arr_data[$x][strtolower($item['field']).'_hst'])) :"local.itvn.fr").' '.($arr_data[$x][strtolower($item['field']).'_frt'] != '' ? '' : 'hide' ).'">Front </i><a href="http://'.$arr_data[$x][strtolower($item['field']).'_bcd'].'"'.($arr_data[$x][strtolower($item['field']).'_bcd'] == '#' ? 'disabled' : '' ).' target="_blank" class="btn btn-sm blue '.($arr_data[$x][strtolower($item['field']).'_bcd'] != '' ? '' : 'hide' ).'">Back </div>';
					}else if($item['format_n'] == 'image'){
						$imgsize = @getimagesize(base_url().'assets/upload/images/'.$arr_data[$x][strtolower($item['field'])]);
						if (!is_array($imgsize)){ 
							$records["data"][$key][] = '';
						}else{
							$start = strpos(strtolower($item['type']),'(') +1;
							$end = strpos(strtolower($item['type']),')');
							$str = ($start!==false && $end!==false) ? substr($item['type'],$start,  $end - $start) : '';
							$arrHeight = explode(',', $str);
							$height = (isset($arrHeight[0]) && $arrHeight[0] >0) ?  $arrHeight[0]: 20;
							$heightMax = (isset($arrHeight[1]) && $arrHeight[1] >0 ) ?  $arrHeight[1]: 200;
							$image = $arr_data[$x][strtolower($item['field'])]!=''? '<img height="'.$height.'" src="'.base_url().'assets/upload/images/'.$arr_data[$x][strtolower($item['field'])].'" class="thumb" data-height="'.$heightMax.'" >' :'';
							$records["data"][$key][] = '<div'.$align.'>'.$image.'</div>';
						}
					}else if($item['format_n'] == 'button'){
						// Nếu jq = 1 thì hiển thỉ big data, ngược lại hiện dât dạng cũ
						if($arr_data[$x]['jq'] == 1){
							$records["data"][$key][] = '<div'.$align.'><a href="'.base_url().'jq_loadtable/'.$arr_data[$x]['tab'].'" class="text-uppercase">'.$arr_data[$x][strtolower($item['field'])].'</a></div>';
						}else{
							$records["data"][$key][] = '<div'.$align.'><a href="'.base_url().'table/'.$arr_data[$x]['tab'].'" class="text-uppercase">'.$arr_data[$x][strtolower($item['field'])].'</a></div>'; 
						}
						//echo "<pre>";print_r($arr_data[$x]['jq']);exit;  
					}else if($item['format_n'] == 'popup'){
						 if((strpos(strtolower($item['type']),'image')!==false)){
							$start = strpos(strtolower($item['type']),'(') +1;
							$end = strpos(strtolower($item['type']),')');
							$str = ($start!==false && $end!==false) ? substr($item['type'],$start,  $end - $start) : '';
							$arrHeight = explode(',', $str);
							$height = (isset($arrHeight[0]) && $arrHeight[0] >0) ?  $arrHeight[0]: 20;
							$heightMax = (isset($arrHeight[1]) && $arrHeight[1] >0 ) ?  $arrHeight[1]: 200;							
						}
                         if(strtolower($arr_data[$x][strtolower($item['field'])]) == 'x'){
                            $records["data"][$key][]= '<a  class="mix-link" href="'.$path.'/'.$arr_data[$x]['file'].'.'.strtolower($item['field']).'" download="'.$arr_data[$x]['file'].'.'.strtolower($item['field']).'">
										<i class="fa fa-link"></i> </a>
													<a data-fancybox-group="'.$category.'_'.strtolower($item['field']).'" title="'.$arr_data[$x]['file'].'" href="'.$path.'/'.$arr_data[$x]['file'].'.'.strtolower($item['field']).'" class="mix-preview fancybox-button">
													<i class="fa fa-search thumb" src="'.$path.'/'.$arr_data[$x]['file'].'.'.strtolower($item['field']).'" data-height="'.$heightMax.'"></i>';
                         }
						  else if(is_file($arr_data[$x][strtolower($item['field'])])){
                            $records["data"][$key][]= '<a  class="mix-link" href="'.base_url().$arr_data[$x][strtolower($item['field'])].'" download="'.$arr_data[$x][strtolower($item['field'])].'">
										<i class="fa fa-link"></i> </a>
													<a data-fancybox-group="'.$category.'_'.strtolower($item['field']).'" title="'.$arr_data[$x][strtolower($item['field'])].'" href="'.base_url().$arr_data[$x][strtolower($item['field'])].'" class="mix-preview fancybox-button">
													<i class="fa fa-search thumb" src="'.base_url().$arr_data[$x][strtolower($item['field'])].'" data-height="'.$heightMax.'"></i>';
                         }else{
                            $records["data"][$key][] = $arr_data[$x][strtolower($item['field'])];
                         }
                    }else if((strtolower($item['format_n'])=='info')&& $arr_data[$x][strtolower($item['field'])]!=''){
						$records["data"][$key][] = "<div".$align."><a data-toggle='tooltip' data-placement='top' data-trigger='hover' data-html='true' data-container='body' data-original-title='".html_entity_decode($arr_data[$x][strtolower($item['field'])])."' title='".html_entity_decode($arr_data[$x][strtolower($item['field'])])."' class='btn btn-icon-only blue tooltips'  href='#'>
									<i class='fa fa-question'></i></a></div>";
						
					}else if($item['format_n'] == 'download'){
                         if(strtolower($arr_data[$x][strtolower($item['field'])]) == 'x'){
							 
                            $records["data"][$key][]= '<a title="'.$arr_data[$x]['file'].'" href="'.$path.'/'.$arr_data[$x]['file'].'.'.strtolower($item['field']).'" download="'.$arr_data[$x]['file'].'.'.strtolower($item['field']).'" >
            				   							<i class="fa fa-download"></i>
            											</a>';
                         }else if(is_file($arr_data[$x][strtolower($item['field'])])){
                            $records["data"][$key][]= '<a title="'.$arr_data[$x][strtolower($item['field'])].'" href="'.base_url().$arr_data[$x][strtolower($item['field'])].'" download="'.$arr_data[$x][strtolower($item['field'])].'" >
            				   							<i class="fa fa-download"></i>
            											</a>';
                         }else{
                            $records["data"][$key][] = $arr_data[$x][strtolower($item['field'])];
                         }
                    }
					else if((strpos(strtolower($item['type']),'image')!==false)){
						$start = strpos(strtolower($item['type']),'(') +1;
						$end = strpos(strtolower($item['type']),')');
						$str = ($start!==false && $end!==false) ? substr($item['type'],$start,  $end - $start) : '';
						$arrHeight = explode(',', $str);
						$height = (isset($arrHeight[0]) && $arrHeight[0] >0) ?  $arrHeight[0]: 20;
						$heightMax = (isset($arrHeight[1]) && $arrHeight[1] >0 ) ?  $arrHeight[1]: 200;
						$image =$arr_data[$x][strtolower($item['field'])]!=''? '<img height="'.$height.'" src="'.base_url().$arr_data[$x][strtolower($item['field'])].'" class="thumb" data-height="'.$heightMax.'" >' :'';
						
						$records["data"][$key][] = '<div'.$align.'><a data-fancybox-group="'.$category.'" title="'.$arr_data[$x][strtolower($item['field'])].'" href="'.base_url().$arr_data[$x][strtolower($item['field'])].'" class="mix-preview fancybox-button">'.$image.'</a></div>';
						
					}
					else if((strtolower($item['type'])=='file')&& $arr_data[$x][strtolower($item['field'])]!=''){
						$records["data"][$key][] = '<div'.$align.' style = "text-align:center;"><a class="btn btn-icon-only blue"  href="'.base_url().$arr_data[$x][strtolower($item['field'])].'" download="'.$arr_data[$x][strtolower($item['field'])].'">
									<i class="fa fa-file-pdf-o"></i></a></div>';
						
					}
                    else if((strtolower($item['type'])=='info')&& $arr_data[$x][strtolower($item['field'])]!=''){
						$records["data"][$key][] = '<div'.$align.' style = "text-align:center;"><span class="tooltips" data-toggle="tooltip" data-placement="top" title="'.$arr_data[$x][strtolower($item['field'])].'"><a  class="btn btn-icon-only blue"  href="#">
									<i class="fa fa-question"></i></a></span></div>';
						
					}
					else if((strpos(strtolower($item['type']),'link')!==false)&&$arr_data[$x][strtolower($item['field'])]!=''){
						$start = strpos(strtolower($item['type']),'(') +1;
						$end = strpos(strtolower($item['type']),')');
						$str = ($start!==false && $end!==false) ? substr($item['type'],$start,  $end - $start) : 'Link';
						if(strpos($arr_data[$x][strtolower($item['field'])], 'http')!==false || strpos($arr_data[$x][strtolower($item['field'])], 'https')!==false)
							$records["data"][$key][] = '<div'.$align.' style = "text-align:center;" ><a class="btn btn-sm green" href="'.$arr_data[$x][strtolower($item['field'])].'" target="_blank">
									<i class="fa fa-globe"></i> '.trim($str).' </a></div>';
												
						else if(strpos($arr_data[$x][strtolower($item['field'])], 'www')!==false)
							$records["data"][$key][] = '<div'.$align.'><a class="btn btn-sm green" href="http://'.$arr_data[$x][strtolower($item['field'])].'" target="_blank">
									<i class="fa fa-globe"></i> '.trim($str).' </a></div>';			
						else {
							
							$records["data"][$key][] = '<div'.$align.'><a class="btn btn-sm green" href="'.base_url().$arr_data[$x][strtolower($item['field'])].'" target="_blank">
									<i class="fa fa-globe"></i> '.trim($str).' </a></div>';	
							
						}
					}
					
					else{
						$records["data"][$key][] = '<div'.$align.'>'.$arr_data[$x][strtolower($item['field'])] .'</div>';
					}
					
	
				}
				
                if(isset($keyARR['keys'])&&$keyARR['keys'] != ''){
                    $keys = array();
				
    				foreach($ke as $val){
    				   $keys[] = "'".$arr_data[$x][strtolower($val)]."' ";
    			   
    				}

    				$k = implode(',',$keys);
                    
    				
                    if($keyARR['user_level'] > $this->session->userdata_vnefrc('user_level')){
    					$records["data"][$key][] .='';
						
						 /*  $records["data"][$key][] .= '<center><div class="align-center">'
											.'<a class="btn btn-icon-only green show-modal" type-modal="update" keys_value="'.$k.'" table_name="'.$table.'"  data-target="#modal" data-toggle="modal">
											<i class="fa fa-edit"></i></a>'
											.'<a class="btn btn-icon-only red deleteField" keys_value="'.$k.'" table_name="'.$table.'" href="#">
											<i class="fa fa-trash-o"></i></a>'
											.'</div></center>';*/
    				}
					elseif($table == 'efrc_query_ref'){
						  $records["data"][$key][] .= '<center><div class="btn-group-sm align-center" style = "position:relative;">'
						  					.'<a class="btn blue show-all-query" keys_value="'.$k.'" table_name="'.$table.'"  data-target="#modal" data-toggle="modal">
											<i class="fa fa-info"></i></a>'
						  
											.'<a class="btn btn-icon-only green show-modal" type-modal="update" keys_value="'.$k.'" table_name="'.$table.'"  data-target="#modal" data-toggle="modal">
											<i class="fa fa-edit"></i></a>'
											
											.'<a class="btn btn-icon-only red deleteField" keys_value="'.$k.'" table_name="'.$table.'" href="#">
											<i class="fa fa-trash-o"></i></a>'
											.'</div></center>';	
					}
					else{
							
				     $records["data"][$key][] .= '<center><div class="align-center" style = "position:relative;">'
											.'<a class="btn btn-icon-only green show-modal" type-modal="update" keys_value="'.$k.'" table_name="'.$table.'"  data-target="#modal" data-toggle="modal">
											<i class="fa fa-edit"></i></a>'
											.'<a class="btn btn-icon-only red deleteField" keys_value="'.$k.'" table_name="'.$table.'" href="#">
											<i class="fa fa-trash-o"></i></a>'
											.'</div></center>';
    				}
                }else
                {
                    $records["data"][$key][] .= '';
                }
			}
			$key ++;
		
		}

        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iFilteredTotal;
          
        $this->output->set_output(json_encode($records));
    }
	
	function runQuery(){
      
        $idArr = implode(',',$_POST['dataArr']);
		
		$sql_query = "Select reference FROM efrc_query_ref WHERE id in ({$idArr})";
		$data_query = $this->db->query($sql_query)->result_array();
		//$this->db->select('reference')->from('efrc_query_ref')->
		//echo $_SERVER['HTTP_HOST'];exit;
	
		$reference = array();
		foreach($data_query as $va_query){
			$reference[] = $va_query['reference'];	
		}
		$implode_reference = implode(',',$reference);
		$add_quos_im_re = "'".str_replace(",","','",$implode_reference)."'";
	
        $sql = "Select * FROM efrc_query WHERE reference in ({$add_quos_im_re})";
        $data = $this->db->query($sql)->result_array();
        $query = '';
        foreach($data as $value){
            $query .= $value['query'];
        }
		$query = explode(";", $query);
		
        //run commands
        $total = $success = 0;
		$result = array();
        foreach($query as $command){
			$command = trim($command);
            if($command!=''){
				if($this->db->simple_query($command)==false){
					$result["message"] = $command;
				}
				else {
					 $success ++;
				}
                
                $total += 1;
            }
        }
		$result["total"] = $total;
		$result["success"] = $success;
        $this->output->set_output(json_encode($result));
        //print_R($query);
    }
	
	
	function runQueryLocal(){
     
        $idArr = implode(',',$_POST['dataArr']);
		
		$sql_query = "Select reference FROM efrc_query_ref WHERE id in ({$idArr})";
		$data_query = $this->db->query($sql_query)->result_array();
		//$this->db->select('reference')->from('efrc_query_ref')->
		//echo $_SERVER['HTTP_HOST'];exit;
	
		$reference = array();
		foreach($data_query as $va_query){
			$reference[] = $va_query['reference'];	
		}
		$implode_reference = implode(',',$reference);
		$add_quos_im_re = "'".str_replace(",","','",$implode_reference)."'";
	
        $sql = "Select * FROM efrc_query WHERE reference in ({$add_quos_im_re})";
        $data = $this->db->query($sql)->result_array();
        $query = '';
        foreach($data as $value){
            $query .= $value['query'];
        }
		$query = explode(";", $query);
		
		
	
        //run commands
        $total = $success = 0;
		$result = array();
        foreach($query as $command){
			$command = trim($command);
            if($command!=''){
				if($this->db->simple_query($command)==false){
					$result["message"] = $command;
				}
				else {
					 $success ++;
				}
                
                $total += 1;
            }
        }
		$result["total"] = $total;
		$result["success"] = $success;
        $this->output->set_output(json_encode($result));
        //print_R($query);
    }
	
	function runQueryHost(){
     
        $idArr = implode(',',$_POST['dataArr']);
		
		$sql_query = "Select reference FROM efrc_query_ref WHERE id in ({$idArr})";
		$data_query = $this->db->query($sql_query)->result_array();
		//$this->db->select('reference')->from('efrc_query_ref')->
		//echo $_SERVER['HTTP_HOST'];exit;
	
		$reference = array();
		foreach($data_query as $va_query){
			$reference[] = $va_query['reference'];	
		}
		$implode_reference = implode(',',$reference);
		$add_quos_im_re = "'".str_replace(",","','",$implode_reference)."'";
	
        $sql = "Select * FROM efrc_query WHERE reference in ({$add_quos_im_re})";
        $data = $this->db->query($sql)->result_array();
        $query = '';
        foreach($data as $value){
            $query .= $value['query'];
        }
		$query = explode(";", $query);
		
		
		// Neu tren host thi thay the LOAD DATA LOCAL INFILE 'U:\EFRC\REFERENCE\FINAL\ thanh LOAD DATA INFILE
		
		$setting = "SELECT value FROM `setting` WHERE `key` = 'folder_upload_data_host' AND `group` = 'setting'";
        $result_setting = $this->db->query($setting)->row_array();
		if($_SERVER['HTTP_HOST'] == 'vnefrc.com' || $_SERVER['HTTP_HOST'] == 'linux.itvn.fr'){
			
			foreach($query as $k=>$val){
				
				if(strstr($val,"load data local infile")){
					$cut_arr = explode("upload",$val);
					if(isset($cut_arr[1])){
						$query[$k] = "load data infile '".$result_setting['value'].substr($cut_arr[1],1);
						//echo $query[$k];exit;
					}
					
				}
			}	
			
		}
		
		
		//end Neu tren host thi thay the LOAD DATA LOCAL INFILE 'U:\EFRC\REFERENCE\FINAL\ thanh LOAD DATA INFILE
        //run commands
        $total = $success = 0;
		$result = array();
        foreach($query as $command){
			$command = trim($command);
            if($command!=''){
				if($this->db->simple_query($command)==false){
					$result["message"] = $command;
				}
				else {
					 $success ++;
				}
                
                $total += 1;
            }
        }
		$result["total"] = $total;
		$result["success"] = $success;
        $this->output->set_output(json_encode($result));
        //print_R($query);
    }
	
	public function test(){
		//echo "<pre>";print_r($_REQUEST);
		$page = $_REQUEST['page']; 
 
		// get how many rows we want to have into the grid - rowNum parameter in the grid 
		$limit = $_REQUEST['rows']; 
		$sidx = $_REQUEST['sidx']; 
		// get index row - i.e. user click to sort. At first time sortname parameter -
		// after that the index from colModel 
		// sorting order - at first time sortorder 
		
		if(!$sidx) $sidx =1; 
		//echo "hung";exit;
		 $this->load->model('currency_model');
		 $sord = $_REQUEST['sord'];
		 //echo $sord;exit;

		$filter = $_REQUEST;
		$result = $this->currency_model->getCurrency($page,$limit,$sord,$sidx,$filter);
		
		echo json_encode($result);
	}
	
	public function jq_efrc_currency_data(){
		//echo "<pre>";print_r($_REQUEST);exit;
		$page = $_REQUEST['page']; 
 
		// get how many rows we want to have into the grid - rowNum parameter in the grid 
		$limit = $_REQUEST['rows']; 
		$sidx = $_REQUEST['sidx'];
		$filter_get = array(); 
		
		if(isset($_REQUEST['form_currency'])){
			$filter_get['filter_get'] = $_REQUEST['form_currency'];
		}
		// get index row - i.e. user click to sort. At first time sortname parameter -
		// after that the index from colModel 
		// sorting order - at first time sortorder 
		
		if(!$sidx) $sidx =1; 
		//echo "hung";exit;
		 $this->load->model('jq_efrc_currency_data_model');
		 $sord = $_REQUEST['sord'];

		$filter = $_REQUEST;
		$result = $this->jq_efrc_currency_data_model->getCurrency($page,$limit,$sord,$sidx,$filter,$filter_get);
		
		echo json_encode($result);
	}

	public function jqgrid_test(){
		$page = $_REQUEST['page']; 
 
		// get how many rows we want to have into the grid - rowNum parameter in the grid 
		$limit = $_REQUEST['rows']; 
		$sidx = $_REQUEST['sidx']; 
		// get index row - i.e. user click to sort. At first time sortname parameter -
		// after that the index from colModel 
		// sorting order - at first time sortorder 
		
		if(!$sidx) $sidx =1; 
		//echo "hung";exit;
		 $this->load->model('currency_model');
		 $sord = $_REQUEST['sord'];

		$filter = $_REQUEST;
		$result = $this->currency_model->getCurrency($page,$limit,$sord,$sidx,$filter);
		
		echo json_encode($result);
	}
	
	public function jqgrid_article(){
		$page = $_REQUEST['page']; 
 
		// get how many rows we want to have into the grid - rowNum parameter in the grid 
		$limit = $_REQUEST['rows']; 
		$sidx = $_REQUEST['sidx']; 
		// get index row - i.e. user click to sort. At first time sortname parameter -
		// after that the index from colModel 
		// sorting order - at first time sortorder 
		
		if(!$sidx) $sidx =1; 
		//echo "hung";exit;
		 $this->load->model('article_model');
		 $sord = $_REQUEST['sord'];

		$filter = $_REQUEST;
		$result = $this->article_model->getJqgridArticle($page,$limit,$sord,$sidx,$filter);
		
		echo json_encode($result);
	}
	public function edit_jqgrid_article(){
		 $this->load->model('article_model');
		 echo "<pre>";print_r($_FILES);exit;
		 
		if($_POST['oper'] == 'del'){
			$this->db->delete('article', array('article_id' => $_POST['id'])); 
			echo "true";
		}
		//echo "<pre>";print_r($_POST);exit;
		if($_POST['oper'] == 'add'){
			 $data = array(
				   'category_id' => $_POST['category_id'],
				   'status' => $_POST['status'],
				   'sort_order' => $_POST['sort_order'],
					'image' => $_POST['image'],
					 'viewed' => $_POST['viewed'],
					  'date_added' => date("Y-m-d",strtotime($_POST['date_added'])),
					   'user_id' => $_POST['user_id'],
					   'url' => $_POST['url'],
					  
			);
			
	//echo "<pre>";print_r($data);exit;
			$this->db->insert('article', $data); 
			echo "true";
			
		}
		 if($_POST['oper'] == 'edit'){
			 $data = array(
				   'category_id' => $_POST['category_id'],
				   'status' => $_POST['status'],
				   'sort_order' => $_POST['sort_order'],
					//'image' => $_POST['image'],
					 'viewed' => $_POST['viewed'],
					  //'date_added' => $_POST['date_added'],
					   'user_id' => $_POST['user_id'],
					   'url' => $_POST['url'],
					  
				);
	
			$this->db->where('article_id', $_POST['article_id']);
			$this->db->update('article', $data);
			echo "true";
		 }
	}
	
	public function edit_del_add_jqgrid_currency(){
		 $this->load->model('article_model');
		 //echo "<pre>";print_r($_POST);exit;
		 
		if($_POST['oper'] == 'del'){
			$this->db->delete('efrc_currency_data_day', array('id' => $_POST['id'])); 
			echo "true";
			exit;
		}
		//echo "<pre>";print_r($_POST);exit;
		if($_POST['oper'] == 'add'){
			 $data = array(
				   'code' => $_POST['code'],
				   'date' => date("Y-m-d",strtotime($_POST['date'])),
				   'close' => $_POST['close'],
					'type' => $_POST['type'],
					 'cur_from' => $_POST['cur_from'],
					   'cur_to' => $_POST['cur_to'],
					  
			);
			
	//echo "<pre>";print_r($data);exit;
			$this->db->insert('efrc_currency_data_day', $data); 
			echo "true";
			exit;
			
		}
		 if($_POST['oper'] == 'edit'){
			 $data = array(
				    'code' => $_POST['code'],
				   'date' => date("Y-m-d",strtotime($_POST['date'])),
				   'close' => $_POST['close'],
					'type' => $_POST['type'],
					 'cur_from' => $_POST['cur_from'],
					   'cur_to' => $_POST['cur_to'],
					  
				);
	
			$this->db->where('id', $_POST['id']);
			$this->db->update('efrc_currency_data_day', $data);
			echo "true";
			exit;
		 }
	}
	
	public function edit_del_add_jq_efrc_currency_data(){
		 $this->load->model('article_model');
		 //echo "<pre>";print_r($_POST);exit;
		 
		if($_POST['oper'] == 'del'){
			$this->db->delete('efrc_currency_data', array('id' => $_POST['id'])); 
			echo "true";
			exit;
		}
		//echo "<pre>";print_r($_POST);exit;
		if($_POST['oper'] == 'add'){
			 $data = array(
				   'code' => $_POST['code'],
				   'date' => date("Y-m-d",strtotime($_POST['date'])),
				   'close' => $_POST['close'],
					'type' => $_POST['type'],
					 'cur_from' => $_POST['cur_from'],
					   'cur_to' => $_POST['cur_to'],
					  
			);
			
	//echo "<pre>";print_r($data);exit;
			$this->db->insert('efrc_currency_data', $data); 
			echo "true";
			exit;
			
		}
		 if($_POST['oper'] == 'edit'){
			 $data = array(
				    'code' => $_POST['code'],
				   'date' => date("Y-m-d",strtotime($_POST['date'])),
				   'close' => $_POST['close'],
					'type' => $_POST['type'],
					 'cur_from' => $_POST['cur_from'],
					   'cur_to' => $_POST['cur_to'],
					  
				);
	
			$this->db->where('id', $_POST['id']);
			$this->db->update('efrc_currency_data', $data);
			echo "true";
			exit;
		 }
	}

    public function show_query(){
		$keys_value = str_replace("'","",$_POST['keys_value']);
		$sql_query = "Select reference FROM efrc_query_ref WHERE id = $keys_value";
		$data_query = $this->db->query($sql_query)->row_array();
		
		if($data_query){
			$param = $data_query['reference'];
			$sql = "Select query FROM efrc_query WHERE reference = '$param'";
			$this->data->query = $this->db->query($sql)->result_array();
		}
		$this->load->view('table/query', $this->data);	
	}
	public function show_select_query(){
		

		$this->load->view('table/select_query');	
		
	}
    function show_modal() {
      //s print_R($_REQUEST['table_name']);exit;
        $table_name = isset($_REQUEST['table_name']) ? $_REQUEST['table_name']: '';		
        $table = $this->table->get_summary($table_name);
        $keys = isset($_POST['keys_value']) ? strtolower(TRIM($_POST['keys_value'])) : "";
        $headers = $this->table->tab_type($table['table_name']);
       //print_r($headers);exit;
	    $sqlkey = "SELECT `keys` FROM efrc_summary WHERE table_name = '{$table['table_name']}'";
        $keyARR = $this->db->query($sqlkey)->row_array();
        
        //print_R($keyARR);exit;
        $where = '1 = 1';
        if($keys != ''){
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
            foreach($wh as $key=>$value){  
            $where .= " and `$key` = {$value}";
            }
        }
        $sql = "Select * FROM {$table['table_name']} WHERE {$where} ;";
        $data = isset($key) ? $this->db->query($sql)->row_array() : "";
		//type in sys_format
		$sqlType = "SELECT `type`,`field` FROM sys_format WHERE `table` = '{$table['table_name']}'";
        $typeArr = $this->db->query($sqlType)->result_array();
		$strTypeArr= array();
		foreach ($typeArr as $item=> $value) {
			$strTypeArr[$value['field']] = $value['type'];
		}
       // print_R($headers);exit;
        foreach ($headers as $key => $value) {
            $readonly = '0';
            $primary = '0';
            if($keys != ''){
				$readonly = isset($data[$value['Field']]) && in_array(strtolower($value['Field']), $aa ) ? '1' : '0' ;
				$primary = in_array(strtolower($value['Field']), $aa ) ? '1' : '0' ;
				$value_field = isset($data[$value['Field']]) ? $data[$value['Field']] : '';					
			}
		//	else if($keyARR['article']==1 && $value['Field']=='lang_code'){
//				$value_field = 'en';		
//			}
			else if ($value['Field']=='date_added') {
				$value_field = date('Y-m-d H:i:s');
			} 
			else if(strtolower($value['Field'])=='id'){
				$readonly = '1' ;
				$primary =  '1' ;
				$value_field = isset($data[$value['Field']]) ? $data[$value['Field']] : '';	
			}
			else {
				$value_field ='';
			}
			
			if (isset($strTypeArr[$value['Field']]) && (strpos(strtolower($strTypeArr[$value['Field']]), 'list') !== FALSE)){
				$start = strpos(strtolower($strTypeArr[$value['Field']]),'(') +1;
				$end = strpos(strtolower($strTypeArr[$value['Field']]),')');
				$str = ($start!==false && $end!==false) ? substr($strTypeArr[$value['Field']],$start,  $end - $start) : '';
				if(trim($str)!=''){
					$headers[$key]['filter'] = $this->table->append_list_editon(strtolower($value['Field']),$str,$value_field , $readonly, $primary);
				}
				else{
					$headers[$key]['filter'] = $this->table->append_select_editon(strtolower($value['Field']),$table['table_name'],$value_field, $readonly, $primary);
				}

			}
			else if (isset($strTypeArr[$value['Field']]) && (strpos(strtolower($strTypeArr[$value['Field']]), 'image') !== FALSE)){
				$headers[$key]['filter'] = '<div class="col-md-9">';
				$headers[$key]['filter'] .= $this->table->append_image_editon($value_field,strtolower($value['Field']));
				$headers[$key]['filter'] .= '</div>';

			}
			else if (isset($strTypeArr[$value['Field']]) && (strpos(strtolower($strTypeArr[$value['Field']]), 'html') !== FALSE)){
				$headers[$key]['filter'] = '<div class="col-md-9">';
				$headers[$key]['filter'] .= $this->table->append_html_editon(strtolower($value['Field']),$value_field);
				$headers[$key]['filter'] .= '</div>';

			}
			else if (isset($strTypeArr[$value['Field']]) && (strpos(strtolower($strTypeArr[$value['Field']]), 'file') !== FALSE)){
				$headers[$key]['filter'] = '<div class="col-md-9">';
				$headers[$key]['filter'] .= $this->table->append_file_editon($value_field,strtolower($value['Field']));
				$headers[$key]['filter'] .= '</div>';

			}
			
			else {
				$headers[$key]['filter'] = '<div class="col-md-9">';
				if(($value['Field']=='date_update')){
					$headers[$key]['filter'] .= $this->table->append_date_editon(strtolower($value['Field']),  date('Y-m-d H:i:s'), '1');
				}else if(strtolower($value['Field'])=='password'){
					$headers[$key]['filter'] .= $this->table->append_input_editon(strtolower($value['Field']),$value_field, $readonly, $primary, 'password');
				}
				else if ((strpos(strtolower($value['Type']), 'text') !== FALSE)|| (strpos(strtolower($value['Type']), 'longtext') !== FALSE)){
					$headers[$key]['filter'] .= $this->table->append_textarea_editon(strtolower($value['Field']),$value_field);
				}				
				else if((strpos(strtolower($value['Type']), 'varchar') !== FALSE) || (strpos(strtolower($value['Type']), 'int') !== FALSE)||(strpos(strtolower($value['Type']), 'double') !== FALSE)||(strpos(strtolower($value['Type']), 'interger') !== FALSE) ){
					$headers[$key]['filter'] .= $this->table->append_input_editon(strtolower($value['Field']),$value_field, $readonly,$primary);
				}
				else if((strpos(strtolower($value['Type']), 'date') !== FALSE)){
					$headers[$key]['filter'] .= $this->table->append_date_editon(strtolower($value['Field']), $value_field, $readonly,$primary);
				}
				else{
					$headers[$key]['filter'] .= $this->table->append_input_editon(strtolower($value['Field']),$value_field, $readonly, $primary);
				}
				$headers[$key]['filter'] .= '</div>';
			}
			
        }
        $this->data->headers = $headers;
        $this->data->name_table = $table['table_name'];
        $this->data->name_desc = $table['description'];
		$this->data->keys = $keys;
       
        $this->load->view('table/modal', $this->data);
    }
    
    function update_modal() {
		ini_set('post_max_size', '200M');
		ini_set('upload_max_filesize', '200M');
		$table = $_POST['table_name_parent'];
        $keys = TRIM($_POST['keys_value']);
        
		$arr_table_sys = $this->table->get_summary($table);
		$table_name = isset($arr_table_sys["table_name"]) ? $arr_table_sys["table_name"] : $table;
        $headers = $this->table->tab_type($table_name);
		$sqlkey = "SELECT `keys` FROM efrc_summary WHERE table_name = '{$table_name}'";
		$keyARR = $this->db->query($sqlkey)->row_array();
		$eq = array();
		$respone['error'] = '';
        $respone['success'] = '';
		$respone['status'] = '';
		$allowext = array("jpg","png","jpeg");
		if($keys==''){			
			$column ='';
			$value_column='';
			foreach ($headers as $item) {
				if(isset($_FILES[$item['Field']])){
					if ($_FILES[$item['Field']]["error"] > 0) {
							$respone['error'] = $_FILES[$item['Field']]["error"];
						} else {
							$path ='assets/upload/intranet';
							if(isset($_POST['group']) && trim($_POST['group'])!='') $path .='/'.strtolower($_POST['group']);
							if(isset($_POST['owner']) && trim($_POST['owner'])!='') $path .='/'.strtolower($_POST['owner']);
							if(isset($_POST['category']) && trim($_POST['category'])!='') $path .='/'.strtolower($_POST['category']);
							if(isset($_POST['subcat']) && trim($_POST['subcat'])!='') $path .='/'.strtolower($_POST['subcat']);
							if (!file_exists($path)) {
								mkdir($path, 0777, true);
							}
							if(move_uploaded_file($_FILES[$item['Field']]["tmp_name"], $path.'/'.basename($_FILES[$item['Field']]["name"]))) {
								$ext = substr($_FILES[$item['Field']]["name"], strrpos($_FILES[$item['Field']]["name"], '.') + 1);
								if(in_array($ext, $allowext)) {
									image_thumb_w($path.'/'.basename($_FILES[$item['Field']]["name"]),65);
									image_thumb_w($path.'/'.basename($_FILES[$item['Field']]["name"]),145);
									image_thumb_w($path.'/'.basename($_FILES[$item['Field']]["name"]),175);
									image_thumb_w($path.'/'.basename($_FILES[$item['Field']]["name"]),255);
									image_thumb_w($path.'/'.basename($_FILES[$item['Field']]["name"]),450);
									image_thumb_w($path.'/'.basename($_FILES[$item['Field']]["name"]),600);
								}
								$column .= $column==''? "`{$item['Field']}`" : " , `{$item['Field']}`";
								$value_column .=$value_column==''? "'".$path.'/'.$_FILES[$item['Field']]["name"]."'" : " , '".$path.'/'.$_FILES[$item['Field']]["name"]."'";
							} else {
								$respone['error'] = "Can not upload file";
							}
						}
				}
				else if($item['Field']=='password'){
                        $salt_2 = substr(md5(uniqid(rand(), true)), 0, 10);
    					$new_password_db = $salt_2 . substr(sha1($salt_2 . $_POST[$item['Field']]), 0, -10);
    					$count = strlen($_POST[$item['Field']]);
    				//	$data = array(
//    						'count_pass'=>$count,
//    						'password' => $new_password_db,
//    						'remember_code' => NULL,
//    					);
    					// Count number password
    					
    				//	$this->db->where('id', $this->session->userdata('user_id'))
//    						->update('user', $data);
		               $column .= $column==''? "`{$item['Field']}`" : " , `{$item['Field']}`";
					   $value_column .=$value_column==''? "'".real_escape_string($new_password_db)."'" : " , '".real_escape_string($new_password_db)."'";
                }
				else if(isset($_POST[$item['Field']])){
					$column .= $column==''? "`{$item['Field']}`" : " , `{$item['Field']}`";
					$value_column .=$value_column==''? "'".real_escape_string($_POST[$item['Field']])."'" : " , '".real_escape_string($_POST[$item['Field']])."'";
				}
			} 
			$sql = "INSERT  INTO {$table_name} ($column) VALUES ({$value_column});";
			$respone['status']  = $this->db->query($sql);
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
				if(isset($_FILES[$item['Field']])){
					if ($_FILES[$item['Field']]["error"] > 0) {
							$respone['error'] = $_FILES[$item['Field']]["error"];
						} else {
							$path ='assets/upload/intranet';
							if(isset($_POST['group']) && trim($_POST['group'])!='') $path .='/'.strtolower($_POST['group']);
							if(isset($_POST['owner']) && trim($_POST['owner'])!='') $path .='/'.strtolower($_POST['owner']);
							if(isset($_POST['category']) && trim($_POST['category'])!='') $path .='/'.strtolower($_POST['category']);
							if(isset($_POST['subcat']) && trim($_POST['subcat'])!='') $path .='/'.strtolower($_POST['subcat']);
							if (!file_exists($path)) {
								mkdir($path, 0777, true);
							}
							if(move_uploaded_file($_FILES[$item['Field']]["tmp_name"], $path.'/'.basename($_FILES[$item['Field']]["name"]))) {
								$ext = substr($_FILES[$item['Field']]["name"], strrpos($_FILES[$item['Field']]["name"], '.') + 1);
								if(in_array($ext, $allowext)) {
									image_thumb_w($path.'/'.basename($_FILES[$item['Field']]["name"]),65);
									image_thumb_w($path.'/'.basename($_FILES[$item['Field']]["name"]),145);
									image_thumb_w($path.'/'.basename($_FILES[$item['Field']]["name"]),175);
									image_thumb_w($path.'/'.basename($_FILES[$item['Field']]["name"]),255);
									image_thumb_w($path.'/'.basename($_FILES[$item['Field']]["name"]),450);
									image_thumb_w($path.'/'.basename($_FILES[$item['Field']]["name"]),600);
								}
								
								$update .= $update==''? "`{$item['Field']}` = '".$path.'/'.$_FILES[$item['Field']]["name"]."'" : " , `{$item['Field']}` = '".$path.'/'.$_FILES[$item['Field']]["name"]."'";
							} else {
								$respone['error'] = "Can not upload file";
							}
						}
				}
				else if(isset($_POST[$item['Field']]))
				$update .= $update==''? "`{$item['Field']}` = '".real_escape_string($_POST[$item['Field']])."'" : " , `{$item['Field']}` = '".real_escape_string($_POST[$item['Field']])."'";
				if($item['Field']=='password'){
                        $salt_2 = substr(md5(uniqid(rand(), true)), 0, 10);
    					$new_password_db = $salt_2 . substr(sha1($salt_2 . $_POST[$item['Field']]), 0, -10);
    					$count = strlen($_POST[$item['Field']]);
		                $update .= $update==''? "`{$item['Field']}` = '".real_escape_string($new_password_db)."'" : " , `{$item['Field']}` = '".real_escape_string($new_password_db)."'";
                    }
				//else if ()
			}  			
        	$sql = "UPDATE {$table_name} SET {$update} WHERE {$where} ;";
			$respone['status']  = $this->db->query($sql);
		}    
        $this->output->set_output(json_encode($respone));
    }
	function delete_row() {   
        $table = $_POST['table_name'];
        $keys = TRIM($_POST['keys_value']);		
        $arr_table_sys = $this->table->get_summary($table);
		$table_name = isset($arr_table_sys["table_name"]) ? $arr_table_sys["table_name"] : 'efrc_'.$table;
        $headers = $this->table->tab_type($table_name);
		$sqlkey = "SELECT `keys` FROM efrc_summary WHERE table_name = '{$table_name}'";
		$keyARR = $this->db->query($sqlkey)->row_array();
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
    
    function checkupdate(){
        $this->db->from('user_log');
//        $this->db->where('user_log.user_id =', $this->session->userdata('user_id'));
        $query = $this->db->get();
        $data = $query->result_array();
        foreach($data as $row) {
          if($row['user_id'] == $this->session->userdata_vnefrc('user_id')){
                $sql = "UPDATE user_log
            			SET `status`=1,
                         lastactive=NOW()   
            			WHERE user_id='".$row['user_id']."' LIMIT 1";
                $this->db->query($sql);
          }else{
        //print_R(date('Y-m-d H:i:s',strtotime("+30 minutes", strtotime($row['lastactive']))));
              if(date('Y-m-d H:i:s',strtotime("+30 minutes", strtotime($row['lastactive']))) < date('Y-m-d H:i:s',strtotime("now"))) { // if lastActivity plus five minutes was longer ago then now
                $sql = "UPDATE user_log
            			SET `status`=0  
            			WHERE user_id='".$row['user_id']."'";
                $this->db->query($sql);
                // Green light
              }else {
                $sql = "UPDATE user_log
            			SET `status`=1 
            			WHERE user_id='".$row['user_id']."'";
                $this->db->query($sql);
              }
          }
        }
        $this->db->from('user_log');
        $this->db->join('user', 'user_log.user_id = user.id');
        $this->db->where('user_log.user_id !=', $this->session->userdata_vnefrc('user_id'));
        $query = $this->db->get();
        $data = $query->result_array();
        $html = $this->setListUser($data);
        $this->output->set_output(json_encode($html));
    }
 
      //log the user out
    function logout() {
        $sql = "UPDATE user_log
    			SET `status`=0  
    			WHERE user_id='".$this->session->userdata_vnefrc('user_id')."'";
        $this->db->query($sql);
        $this->ion_auth->logout();
        echo (true);
    }
	
	public function autocomplete_url(){
		
		$this->db->select('url');
		$this->db->distinct();
		$this->db->like('url', $_REQUEST['term']); 
		$query = $this->db->get('article');
		$data = $query->result_array();
		
		if($data != NULL){
			foreach($data as $k=>$info){
				$result[$k]['value'] = $info['url'];
				$result[$k]['label'] = $info['url'];
			}
			//echo "<pre>";print_r($result);exit;
			$this->output->set_output($_REQUEST['callback']."(".json_encode($result).")");
		}else{
			$result[0]['value'] = '';
			$result[1]['label'] = '';
			$this->output->set_output($_REQUEST['callback']."(".json_encode($result).")");	
		}
	}
	public function autocomplete_category(){
		
		$this->db->select('category_id');
		$this->db->distinct();
		$this->db->like('category_id', $_REQUEST['term']); 
		$query = $this->db->get('article');
		$data = $query->result_array();
			
		if($data != NULL){
			foreach($data as $k=>$info){
				$result[$k]['value'] = $info['category_id'];
				$result[$k]['label'] = $info['category_id'];
			}
			//echo "<pre>";print_r($result);exit;
			$this->output->set_output($_REQUEST['callback']."(".json_encode($result).")");
			//echo "<pre>";print_r($_REQUEST);exit;
		}
		else{
			$result[0]['value'] = '';
			$result[1]['label'] = '';
			$this->output->set_output($_REQUEST['callback']."(".json_encode($result).")");
		}
	}
	public function autocomplete_type(){
		//print_r($_REQUEST);exit;
		$this->db->select('type');
		$this->db->distinct();
		$this->db->like('type', $_REQUEST['term']); 
		$query = $this->db->get('efrc_currency_data');
		$data = $query->result_array();
			
		if($data != NULL){
			foreach($data as $k=>$info){
				$result[$k]['value'] = $info['type'];
				$result[$k]['label'] = $info['type'];
			}
			//echo "<pre>";print_r($result);exit;
			$this->output->set_output($_REQUEST['callback']."(".json_encode($result).")");
			//echo "<pre>";print_r($_REQUEST);exit;
		}
		else{
			$result[0]['value'] = '';
			$result[1]['label'] = '';
			$this->output->set_output($_REQUEST['callback']."(".json_encode($result).")");
		}
	}
	
	public function autocomplete_currency_from(){
		//print_r($_REQUEST);exit;
		$this->db->select('cur_from');
		$this->db->distinct();
		$this->db->like('cur_from', $_REQUEST['term']); 
		$query = $this->db->get('efrc_currency_data');
		$data = $query->result_array();
			
		if($data != NULL){
			foreach($data as $k=>$info){
				$result[$k]['value'] = $info['cur_from'];
				$result[$k]['label'] = $info['cur_from'];
			}
			//echo "<pre>";print_r($result);exit;
			$this->output->set_output($_REQUEST['callback']."(".json_encode($result).")");
			//echo "<pre>";print_r($_REQUEST);exit;
		}
		else{
			$result[0]['value'] = '';
			$result[1]['label'] = '';
			$this->output->set_output($_REQUEST['callback']."(".json_encode($result).")");
		}
	}
	
	public function autocomplete_currency_to(){
		//print_r($_REQUEST);exit;
		$this->db->select('cur_to');
		$this->db->distinct();
		$this->db->like('cur_to', $_REQUEST['term']); 
		$query = $this->db->get('efrc_currency_data');
		$data = $query->result_array();
			
		if($data != NULL){
			foreach($data as $k=>$info){
				$result[$k]['value'] = $info['cur_to'];
				$result[$k]['label'] = $info['cur_to'];
			}
			//echo "<pre>";print_r($result);exit;
			$this->output->set_output($_REQUEST['callback']."(".json_encode($result).")");
			//echo "<pre>";print_r($_REQUEST);exit;
		}
		else{
			$result[0]['value'] = '';
			$result[1]['label'] = '';
			$this->output->set_output($_REQUEST['callback']."(".json_encode($result).")");
		}
	}
	public function getSelected(){
		$name = $_POST['name'];
		$table = $_POST['table'];
		
		$this->db->select($name);
		$this->db->distinct();
		$this->db->order_by($name,"ASC");
	
		$query = $this->db->get($table);
		$data = $query->result_array();
		$result='';
		foreach($data as $k=>$v){
			if($v[$name] == ''){
				unset($data[$k]);
			}else{
				$result.= $v[$name].":".$v[$name].";";
			}
			
		}
		echo json_encode($result);
	}
    
	
	public function jq_loadtable(){
		//echo "<pre>";print_r($_REQUEST);exit;
		$jq_table = $_REQUEST['jq_table'];
		$page = $_REQUEST['page']; 
        if($jq_table == 'summary'){
            $jq_table =='efrc_'.$jq_table;
        }
		// get how many rows we want to have into the grid - rowNum parameter in the grid 
		$limit = $_REQUEST['rows']; 
		$sidx = $_REQUEST['sidx'];
		$filter_get = array(); 
		if(isset($_REQUEST['filter_get_all'])){
			$filter_get = json_decode($_REQUEST['filter_get_all']);
		}
		// get index row - i.e. user click to sort. At first time sortname parameter -
		// after that the index from colModel 
		// sorting order - at first time sortorder 
	
		if(!$sidx) $sidx =1; 
		//echo "hung";exit;
		 $this->load->model('jq_loadtable_model');
		 $sord = $_REQUEST['sord'];

		$filter = $_REQUEST;
		//print_R($filter);exit;
		$result = $this->jq_loadtable_model->getTable($page,$limit,$sord,$sidx,$filter,$filter_get,$jq_table);
		//var_export($result);exit;
		echo json_encode($result);
	}
	
	/*public function sessionEnableEdit(){
        $_SESSION['session_enable_edit'] = "enable";
    }*/
    
    public function search(){
		//echo "<pre>";print_r($_REQUEST);exit;
		$jq_table = $_REQUEST['jq_table'];
		$page = $_REQUEST['page']; 
        if($jq_table == 'summary'){
            $jq_table =='efrc_'.$jq_table;
        }
		// get how many rows we want to have into the grid - rowNum parameter in the grid 
		$limit = $_REQUEST['rows']; 
		$sidx = $_REQUEST['sidx'];
		$filter_get = array(); 
		if(isset($_REQUEST['filter_get_all'])){
			$filter_get = json_decode($_REQUEST['filter_get_all']);
		}
        //print_R($filter_get);exit;
		// get index row - i.e. user click to sort. At first time sortname parameter -
		// after that the index from colModel 
		// sorting order - at first time sortorder 
	
		if(!$sidx) $sidx =1; 
		//echo "hung";exit;
		 $this->load->model('search_model');
		 $sord = $_REQUEST['sord'];

		$filter = $_REQUEST;
		//print_R($filter);exit;
		$result = $this->search_model->getTable($page,$limit,$sord,$sidx,$filter,$filter_get,$jq_table);
		//var_export($result);exit;
		echo json_encode($result);
	}
	
	public function jq_loadwebservice(){
		//echo "<pre>";print_r($_REQUEST);exit;
		$jq_table = $_REQUEST['jq_table'];
		$page = $_REQUEST['page']; 
        if($jq_table == 'summary'){
            $jq_table =='efrc_'.$jq_table;
        }
		// get how many rows we want to have into the grid - rowNum parameter in the grid 
		$limit = $_REQUEST['rows']; 
		$sidx = $_REQUEST['sidx'];
		$filter_get = array(); 
		if(isset($_REQUEST['filter_get_all'])){
			$filter_get = json_decode($_REQUEST['filter_get_all']);
		}
		// get index row - i.e. user click to sort. At first time sortname parameter -
		// after that the index from colModel 
		// sorting order - at first time sortorder 
	
		if(!$sidx) $sidx =1; 
		//echo "hung";exit;
		 $this->load->model('jq_loadtable_model');
		 $sord = $_REQUEST['sord'];

		$filter = $_REQUEST;
		
		$result = $this->jq_loadtable_model->getTableWebservice($page,$limit,$sord,$sidx,$filter,$filter_get,$jq_table);
		
		echo json_encode($result);
	}
	
	public function jq_compare_comporation(){
		//echo "<pre>";print_r($_REQUEST);exit;
		$jq_table = $_REQUEST['jq_table'];
		$page = $_REQUEST['page']; 
        if($jq_table == 'summary'){
            $jq_table =='efrc_'.$jq_table;
        }
		// get how many rows we want to have into the grid - rowNum parameter in the grid 
		$limit = $_REQUEST['rows']; 
		$sidx = $_REQUEST['sidx'];
		$filter_get = array(); 
		if(isset($_REQUEST['filter_get_all'])){
			$filter_get = json_decode($_REQUEST['filter_get_all']);
		}
		// get index row - i.e. user click to sort. At first time sortname parameter -
		// after that the index from colModel 
		// sorting order - at first time sortorder 
	
		if(!$sidx) $sidx =1; 
		//echo "hung";exit;
		 $this->load->model('jq_compare_model');
		 $sord = $_REQUEST['sord'];

		$filter = $_REQUEST;
		
		$result = $this->jq_compare_model->getTable($page,$limit,$sord,$sidx,$filter,$filter_get,$jq_table);
		//var_export($result);exit;
		echo json_encode($result);
	}
	
	public function jq_compare_specs2(){
		//echo "<pre>";print_r($_REQUEST);exit;
		$jq_table = $_REQUEST['jq_table'];
		$page = $_REQUEST['page']; 
        if($jq_table == 'summary'){
            $jq_table =='efrc_'.$jq_table;
        }
		// get how many rows we want to have into the grid - rowNum parameter in the grid 
		$limit = $_REQUEST['rows']; 
		$sidx = $_REQUEST['sidx'];
		$filter_get = array(); 
		if(isset($_REQUEST['filter_get_all'])){
			$filter_get = json_decode($_REQUEST['filter_get_all']);
		}
		// get index row - i.e. user click to sort. At first time sortname parameter -
		// after that the index from colModel 
		// sorting order - at first time sortorder 
	
		if(!$sidx) $sidx =1; 
		//echo "hung";exit;
		 $this->load->model('jq_compare_model');
		 $sord = $_REQUEST['sord'];

		$filter = $_REQUEST;
		
		$result = $this->jq_compare_model->getTable($page,$limit,$sord,$sidx,$filter,$filter_get,$jq_table);
		//var_export($result);exit;
		echo json_encode($result);
	}
    
	public function edit_del_add_search(){
		//echo "<pre>";print_r($_REQUEST);exit;
		 $this->load->model('article_model');
		 
		$data = array();
		
		if($_POST['oper'] == 'del'){
			$this->db->delete($_REQUEST['jq_table'], array('id' => $_POST['id'])); 
			echo "true";
		}
		if($_POST['oper'] == 'add'){
			foreach($_POST as $k=>$v){
				if($k!= 'oper' && $k!= 'id')
					$data[$k] = $v;	
			}
			$this->db->insert($_REQUEST['jq_table'], $data); 
			echo "true";
			
		}
		 if($_POST['oper'] == 'edit'){
			foreach($_POST as $k=>$v){
				if($k!= 'oper' && $k!= 'id')
					$data[$k] = $v;	
			}

			$this->db->where('id', $_POST['id']);
			$this->db->update($_REQUEST['jq_table'], $data);
			echo "true";
			
		 }
	}
	public function edit_del_add_jq_loadtable(){
		//echo "<pre>";print_r($_REQUEST);exit;
		 $this->load->model('article_model');
		 
		$data = array();
		
		if($_POST['oper'] == 'del'){
			$this->db->delete($_REQUEST['jq_table'], array('id' => $_POST['id'])); 
			echo "true";
		}
		if($_POST['oper'] == 'add'){
			foreach($_POST as $k=>$v){
				if($k!= 'oper' && $k!= 'id')
					$data[$k] = $v;	
			}
			$this->db->insert($_REQUEST['jq_table'], $data); 
			echo "true";
			
		}
		 if($_POST['oper'] == 'edit'){
			foreach($_POST as $k=>$v){
				if($k!= 'oper' && $k!= 'id')
					$data[$k] = $v;	
			}

			$this->db->where('id', $_POST['id']);
			$this->db->update($_REQUEST['jq_table'], $data);
			echo "true";
			
		 }
	}
	public function edit_del_add_webservices(){
	    unset($_REQUEST['id']);
	//	echo "<pre>";print_r($_REQUEST);exit;
		 $this->load->model('article_model');
		 
		$data = array();
		
		if($_POST['oper'] == 'del'){
		    unset($_POST['id']);
			$this->db->delete($_REQUEST['jq_table'], array('nrf' => $_POST['nrf'])); 
			echo "true";
		}
		if($_POST['oper'] == 'add'){
		    unset($_POST['id']);
			foreach($_POST as $k=>$v){
				if($k!= 'oper' && $k!= 'nrf')
					$data[$k] = $v;	
			}
			$this->db->insert($_REQUEST['jq_table'], $data); 
			echo "true";
			
		}
		if($_POST['oper'] == 'edit'){
		    unset($_POST['id']);
			foreach($_POST as $k=>$v){
				if($k!= 'oper' && $k!= 'nrf')
					$data[$k] = $v;	
			}

			$this->db->where('nrf', $_POST['nrf']);
			$this->db->update($_REQUEST['jq_table'], $data);
			echo "true";
			
		 }
         //$this->last_query();
	}
	public function jq_loadrealtime1(){
		
		$jq_table = $_REQUEST['jq_table1'];
		$page = $_REQUEST['page']; 
 
		// get how many rows we want to have into the grid - rowNum parameter in the grid 
		$limit = $_REQUEST['rows']; 
		$sidx = $_REQUEST['sidx'];
		$filter_get = array(); 
		
		
		if(isset($_REQUEST['filter_get_all'])){
			$filter_get = $_REQUEST['filter_get_all'];
		}
		// get index row - i.e. user click to sort. At first time sortname parameter -
		// after that the index from colModel 
		// sorting order - at first time sortorder 
	
		if(!$sidx) $sidx =1; 
		//echo "hung";exit;
		 $this->load->model('jq_realtime_model');
		 $sord = $_REQUEST['sord'];

		$filter = $_REQUEST;
		
		$result = $this->jq_realtime_model->getTableRealTime1($page,$limit,$sord,$sidx,$filter,$filter_get,$jq_table);
		
		echo json_encode($result);
	}
	
	
	public function jq_loadrealtime2(){
		//echo "<pre>";print_r($_REQUEST);exit;
		$jq_table = $_REQUEST['jq_table2'];
		$page = $_REQUEST['page']; 
 
		// get how many rows we want to have into the grid - rowNum parameter in the grid 
		$limit = $_REQUEST['rows']; 
		$sidx = $_REQUEST['sidx'];
		$filter_get = array(); 
		
		if(isset($_REQUEST['filter_get_all'])){
			$filter_get = $_REQUEST['filter_get_all'];
		}
		// get index row - i.e. user click to sort. At first time sortname parameter -
		// after that the index from colModel 
		// sorting order - at first time sortorder 
	
		if(!$sidx) $sidx =1; 
		//echo "hung";exit;
		 $this->load->model('jq_realtime_model');
		 $sord = $_REQUEST['sord'];

		$filter = $_REQUEST;
		
		$result = $this->jq_realtime_model->getTableRealTime2($page,$limit,$sord,$sidx,$filter,$filter_get,$jq_table);
	
		echo json_encode($result);
	}
	public function jq_loadrealtime3(){
		//echo "<pre>";print_r($_REQUEST);exit;
		$jq_table = $_REQUEST['jq_table3'];
		$page = $_REQUEST['page'];
		//echo "<pre>";print_r(json_decode($_REQUEST['codeint'],true));exit;
		if(isset($_REQUEST['codeint'])){
 			$codeint = json_decode($_REQUEST['codeint'],true);
		}else{
			$codeint = '';	
		}
		// get how many rows we want to have into the grid - rowNum parameter in the grid 
		$limit = $_REQUEST['rows']; 
		$sidx = $_REQUEST['sidx'];
		$filter_get = array(); 
		
		if(isset($_REQUEST['filter_get_all'])){
			$filter_get = $_REQUEST['filter_get_all'];
		}
		// get index row - i.e. user click to sort. At first time sortname parameter -
		// after that the index from colModel 
		// sorting order - at first time sortorder 
	
		if(!$sidx) $sidx =1; 
		//echo "hung";exit;
		 $this->load->model('jq_realtime_model');
		 $sord = $_REQUEST['sord'];

		$filter = $_REQUEST;
		
		$result = $this->jq_realtime_model->getTableRealTime3($page,$limit,$sord,$sidx,$filter,$filter_get,$jq_table,$codeint);

		echo json_encode($result);
	}
	public function jq_loadtop_composition(){
		//echo "<pre>";print_r($_REQUEST);exit;
		$jq_table = $_REQUEST['jq_table3'];
		$page = $_REQUEST['page']; 
 
		// get how many rows we want to have into the grid - rowNum parameter in the grid 
		$limit = $_REQUEST['rows']; 
		$sidx = $_REQUEST['sidx'];
		$filter_get = array(); 
		
		if(isset($_REQUEST['filter_get_all'])){
			$filter_get = $_REQUEST['filter_get_all'];
		}
		// get index row - i.e. user click to sort. At first time sortname parameter -
		// after that the index from colModel 
		// sorting order - at first time sortorder 
	
		if(!$sidx) $sidx =1; 
		//echo "hung";exit;
		 $this->load->model('jq_compare_model');
		 $sord = $_REQUEST['sord'];

		$filter = $_REQUEST;
		
		$result = $this->jq_compare_model->getTableCompare3($page,$limit,$sord,$sidx,$filter,$filter_get,$jq_table);
	
		echo json_encode($result);
	}
	
	public function jq_loadtop_composition_two(){
		//echo "<pre>";print_r($_REQUEST);exit;
		$jq_table = $_REQUEST['jq_table3'];
		$page = $_REQUEST['page']; 
 
		// get how many rows we want to have into the grid - rowNum parameter in the grid 
		$limit = $_REQUEST['rows']; 
		$sidx = $_REQUEST['sidx'];
		$filter_get = array(); 
		
		if(isset($_REQUEST['filter_get_all'])){
			$filter_get = $_REQUEST['filter_get_all'];
		}
		// get index row - i.e. user click to sort. At first time sortname parameter -
		// after that the index from colModel 
		// sorting order - at first time sortorder 
	
		if(!$sidx) $sidx =1; 
		//echo "hung";exit;
		 $this->load->model('jq_compare_model');
		 $sord = $_REQUEST['sord'];

		$filter = $_REQUEST;
		
		$result = $this->jq_compare_model->getTableCompare3Two($page,$limit,$sord,$sidx,$filter,$filter_get,$jq_table);
	
		echo json_encode($result);
	}
	
	public function jq_loadtop_specs(){
		//echo "<pre>";print_r($_REQUEST);exit;
		$jq_table = $_REQUEST['jq_table4'];
		$page = $_REQUEST['page']; 
 
		// get how many rows we want to have into the grid - rowNum parameter in the grid 
		$limit = $_REQUEST['rows']; 
		$sidx = $_REQUEST['sidx'];
		$filter_get = array(); 
		
		if(isset($_REQUEST['filter_get_all'])){
			$filter_get = $_REQUEST['filter_get_all'];
		}
		// get index row - i.e. user click to sort. At first time sortname parameter -
		// after that the index from colModel 
		// sorting order - at first time sortorder 
	
		if(!$sidx) $sidx =1; 
		//echo "hung";exit;
		 $this->load->model('jq_compare_model');
		 $sord = $_REQUEST['sord'];

		$filter = $_REQUEST;
		
		$result = $this->jq_compare_model->getTableCompare3($page,$limit,$sord,$sidx,$filter,$filter_get,$jq_table);
	
		echo json_encode($result);
	}
	
	public function jq_loadtop_specs_two(){
		//echo "<pre>";print_r($_REQUEST);exit;
		$jq_table = $_REQUEST['jq_table4'];
		$page = $_REQUEST['page']; 
 
		// get how many rows we want to have into the grid - rowNum parameter in the grid 
		$limit = $_REQUEST['rows']; 
		$sidx = $_REQUEST['sidx'];
		$filter_get = array(); 
		
		if(isset($_REQUEST['filter_get_all'])){
			$filter_get = $_REQUEST['filter_get_all'];
		}
		// get index row - i.e. user click to sort. At first time sortname parameter -
		// after that the index from colModel 
		// sorting order - at first time sortorder 
	
		if(!$sidx) $sidx =1; 
		//echo "hung";exit;
		 $this->load->model('jq_compare_model');
		 $sord = $_REQUEST['sord'];

		$filter = $_REQUEST;
		
		$result = $this->jq_compare_model->getTableCompare3Two($page,$limit,$sord,$sidx,$filter,$filter_get,$jq_table);
	
		echo json_encode($result);
	}
	
	
	public function jq_loadrealtime4(){
		$jq_table = $_REQUEST['jq_table4'];
		$page = $_REQUEST['page']; 
 
		// get how many rows we want to have into the grid - rowNum parameter in the grid 
		$limit = $_REQUEST['rows']; 
		$sidx = $_REQUEST['sidx'];
		$filter_get = array(); 
		
		if(isset($_REQUEST['filter_get_all'])){
			$filter_get = $_REQUEST['filter_get_all'];
		}
		// get index row - i.e. user click to sort. At first time sortname parameter -
		// after that the index from colModel 
		// sorting order - at first time sortorder 
	
		if(!$sidx) $sidx =1; 
		//echo "hung";exit;
		 $this->load->model('jq_realtime_model');
		 $sord = $_REQUEST['sord'];

		$filter = $_REQUEST;
		$result = $this->jq_realtime_model->getTableRealTime4($page,$limit,$sord,$sidx,$filter,$filter_get,$jq_table);
		

	
		echo json_encode($result);
	}
	
	
	public function jq_loadrealtime5(){
		//echo "<pre>";print_r($_REQUEST);exit;
		$jq_table = $_REQUEST['jq_table5'];
		$page = $_REQUEST['page']; 
 
		// get how many rows we want to have into the grid - rowNum parameter in the grid 
		$limit = $_REQUEST['rows']; 
		$sidx = $_REQUEST['sidx'];
		$filter_get = array(); 
		
		if(isset($_REQUEST['filter_get_all'])){
			$filter_get = $_REQUEST['filter_get_all'];
		}
		// get index row - i.e. user click to sort. At first time sortname parameter -
		// after that the index from colModel 
		// sorting order - at first time sortorder 
	
		if(!$sidx) $sidx =1; 
		//echo "hung";exit;
		 $this->load->model('jq_realtime_model');
		 $sord = $_REQUEST['sord'];

		$filter = $_REQUEST;
		
		$result = $this->jq_realtime_model->getTableRealTime5($page,$limit,$sord,$sidx,$filter,$filter_get,$jq_table);
	
		echo json_encode($result);
	}
	
	public function jq_loadstockpage1(){
		
		$jq_table = $_REQUEST['jq_table1'];
		$page = $_REQUEST['page']; 
 
		// get how many rows we want to have into the grid - rowNum parameter in the grid 
		$limit = $_REQUEST['rows']; 
		$sidx = $_REQUEST['sidx'];
		$filter_get = array(); 
		
		
		if(isset($_REQUEST['filter_get_all'])){
			$filter_get = $_REQUEST['filter_get_all'];
		}
		// get index row - i.e. user click to sort. At first time sortname parameter -
		// after that the index from colModel 
		// sorting order - at first time sortorder 
	
		if(!$sidx) $sidx =1; 
		//echo "hung";exit;
		 $this->load->model('jq_stockpage_model');
		 $sord = $_REQUEST['sord'];

		$filter = $_REQUEST;
		
		$result = $this->jq_stockpage_model->getTablestockpage1($page,$limit,$sord,$sidx,$filter,$filter_get,$jq_table);
		
		echo json_encode($result);
	}
	
	public function jq_loadstockpage2(){
		
		$jq_table = $_REQUEST['jq_table2'];
		$page = $_REQUEST['page']; 
 
		// get how many rows we want to have into the grid - rowNum parameter in the grid 
		$limit = $_REQUEST['rows']; 
		$sidx = $_REQUEST['sidx'];
		$filter_get = array(); 
		
		
		if(isset($_REQUEST['filter_get_all'])){
			$filter_get = $_REQUEST['filter_get_all'];
		}
		// get index row - i.e. user click to sort. At first time sortname parameter -
		// after that the index from colModel 
		// sorting order - at first time sortorder 
	
		if(!$sidx) $sidx =1; 
		//echo "hung";exit;
		 $this->load->model('jq_stockpage_model');
		 $sord = $_REQUEST['sord'];

		$filter = $_REQUEST;
		
		$result = $this->jq_stockpage_model->getTablestockpage2($page,$limit,$sord,$sidx,$filter,$filter_get,$jq_table);
		
		echo json_encode($result);
	}
	
	public function jq_loadstockpage3(){
		
		$jq_table = $_REQUEST['jq_table3'];
		$page = $_REQUEST['page']; 
 
		// get how many rows we want to have into the grid - rowNum parameter in the grid 
		$limit = $_REQUEST['rows']; 
		$sidx = $_REQUEST['sidx'];
		$filter_get = array(); 
		
		
		if(isset($_REQUEST['filter_get_all'])){
			$filter_get = $_REQUEST['filter_get_all'];
		}
		// get index row - i.e. user click to sort. At first time sortname parameter -
		// after that the index from colModel 
		// sorting order - at first time sortorder 
	
		if(!$sidx) $sidx =1; 
		//echo "hung";exit;
		 $this->load->model('jq_stockpage_model');
		 $sord = $_REQUEST['sord'];

		$filter = $_REQUEST;
		
		$result = $this->jq_stockpage_model->getTablestockpage3($page,$limit,$sord,$sidx,$filter,$filter_get,$jq_table);
		
		echo json_encode($result);
	}
	public function jq_loadstockpage4(){
		
		$jq_table = $_REQUEST['jq_table4'];
		$page = $_REQUEST['page']; 
 
		// get how many rows we want to have into the grid - rowNum parameter in the grid 
		$limit = $_REQUEST['rows']; 
		$sidx = $_REQUEST['sidx'];
		$filter_get = array(); 
		
		
		if(isset($_REQUEST['filter_get_all'])){
			$filter_get = $_REQUEST['filter_get_all'];
		}
		// get index row - i.e. user click to sort. At first time sortname parameter -
		// after that the index from colModel 
		// sorting order - at first time sortorder 
	
		if(!$sidx) $sidx =1; 
		//echo "hung";exit;
		 $this->load->model('jq_stockpage_model');
		 $sord = $_REQUEST['sord'];

		$filter = $_REQUEST;
		
		$result = $this->jq_stockpage_model->getTablestockpage4($page,$limit,$sord,$sidx,$filter,$filter_get,$jq_table);
		
		echo json_encode($result);
	}
	
	public function jq_loadstockpage5(){
		//echo "<pre>";print_r($_REQUEST);exit;
		$jq_table = $_REQUEST['jq_table5'];
		$page = $_REQUEST['page']; 
 
		// get how many rows we want to have into the grid - rowNum parameter in the grid 
		$limit = $_REQUEST['rows']; 
		$sidx = $_REQUEST['sidx'];
		$filter_get = array(); 
		
		if(isset($_REQUEST['filter_get_all'])){
			$filter_get = $_REQUEST['filter_get_all'];
		}
		// get index row - i.e. user click to sort. At first time sortname parameter -
		// after that the index from colModel 
		// sorting order - at first time sortorder 
	
		if(!$sidx) $sidx =1; 
		//echo "hung";exit;
		 $this->load->model('jq_stockpage_model');
		 $sord = $_REQUEST['sord'];

		$filter = $_REQUEST;
		
		$result = $this->jq_stockpage_model->getTablestockpage5($page,$limit,$sord,$sidx,$filter,$filter_get,$jq_table);
		
		echo json_encode($result);
	}
	
	
	public function jq_compare_composition(){
	
		//echo "<pre>";print_r($_REQUEST);exit;
		$jq_table  ="(SELECT a.idx_code,a.stk_code, a.stk_shares_idx, b.stk_shares_idx as stk_shares_idx_rt, ABS(a.stk_shares_idx - b.stk_shares_idx) as diff1,(CASE 
         WHEN (a.stk_shares_idx - b.stk_shares_idx) = 0 THEN 0
         ELSE 1
      END) AS stt1, a.stk_mcap_idx, b.stk_mcap_idx as stk_mcap_idx_rt, ABS(a.stk_mcap_idx - b.stk_mcap_idx) as diff2,(CASE 
         WHEN (a.stk_mcap_idx - b.stk_mcap_idx) = 0 THEN 0
         ELSE 1
      END) AS stt2, a.stk_dcap_idx, b.stk_dcap_idx as stk_dcap_idx_rt,  ABS(a.stk_dcap_idx - b.stk_dcap_idx) as diff3,(CASE 
         WHEN (a.stk_dcap_idx - b.stk_dcap_idx) = 0 THEN 0
         ELSE 1
      END) AS stt3, a.stk_price,b.stk_price as stk_price_rt , ABS(a.stk_price - b.stk_price) as diff4,(CASE 
         WHEN (a.stk_price - b.stk_price) = 0 THEN 0
         ELSE 1
      END) AS stt4, a.date FROM idx_composition_temp_local as a INNER JOIN idx_composition_rt as b ON a.idx_code=b.idx_code and a.stk_code=b.stk_code) A";
		$page = $_REQUEST['page']; 
 
		// get how many rows we want to have into the grid - rowNum parameter in the grid 
		$limit = $_REQUEST['rows']; 
		$sidx = $_REQUEST['sidx'];
		$filter_get = array(); 
		
		if(isset($_REQUEST['filter_get_all'])){
			$filter_get = json_decode($_REQUEST['filter_get_all']);
		}
		// get index row - i.e. user click to sort. At first time sortname parameter -
		// after that the index from colModel 
		// sorting order - at first time sortorder 
	
		if(!$sidx) $sidx =1; 
		//echo "hung";exit;
		 $this->load->model('jq_loadtable_model');
		 $sord = $_REQUEST['sord'];

		$filter = $_REQUEST;
	
		$result = $this->jq_loadtable_model->getTableCompareComposition($page,$limit,$sord,$sidx,$filter,$filter_get,$jq_table);
		//echo "<pre>"; print_r($result);exit;
		echo json_encode($result);
	}
	
	public function jq_compare_two_composition(){
	
		//echo "<pre>";print_r($_REQUEST);exit;
		$jq_table  ="idx_composition_compare_open";
		$page = $_REQUEST['page']; 
 
		// get how many rows we want to have into the grid - rowNum parameter in the grid 
		$limit = $_REQUEST['rows']; 
		$sidx = $_REQUEST['sidx'];
		$filter_get = array(); 
		
		if(isset($_REQUEST['filter_get_all'])){
			$filter_get = json_decode($_REQUEST['filter_get_all']);
		}
		// get index row - i.e. user click to sort. At first time sortname parameter -
		// after that the index from colModel 
		// sorting order - at first time sortorder 
	
		if(!$sidx) $sidx =1; 
		//echo "hung";exit;
		 $this->load->model('jq_loadtable_model');
		 $sord = $_REQUEST['sord'];

		$filter = $_REQUEST;
	
		$result = $this->jq_loadtable_model->getTableCompareCompositionTwo($page,$limit,$sord,$sidx,$filter,$filter_get,$jq_table);
		//echo "<pre>"; print_r($result);exit;
		echo json_encode($result);
	}
	
	
	public function jq_compare_specs(){
	
		//echo "<pre>";print_r($_REQUEST);exit;
		$jq_table  ="idx_specs_compare_close";
		$page = $_REQUEST['page']; 
 
		// get how many rows we want to have into the grid - rowNum parameter in the grid 
		$limit = $_REQUEST['rows']; 
		$sidx = $_REQUEST['sidx'];
		$filter_get = array(); 
		
		if(isset($_REQUEST['filter_get_all'])){
			$filter_get = json_decode($_REQUEST['filter_get_all']);
		}
		// get index row - i.e. user click to sort. At first time sortname parameter -
		// after that the index from colModel 
		// sorting order - at first time sortorder 
	
		if(!$sidx) $sidx =1; 
		//echo "hung";exit;
		 $this->load->model('jq_loadtable_model');
		 $sord = $_REQUEST['sord'];

		$filter = $_REQUEST;
	
		$result = $this->jq_loadtable_model->getTableCompareSpecs($page,$limit,$sord,$sidx,$filter,$filter_get,$jq_table);
		//var_export($result);exit;
		echo json_encode($result);
	}
	
	public function jq_compare_two_specs(){
	
		//echo "<pre>";print_r($_REQUEST);exit;
		$jq_table  ="idx_specs_compare_open";
		$page = $_REQUEST['page']; 
 
		// get how many rows we want to have into the grid - rowNum parameter in the grid 
		$limit = $_REQUEST['rows']; 
		$sidx = $_REQUEST['sidx'];
		$filter_get = array(); 
		
		if(isset($_REQUEST['filter_get_all'])){
			$filter_get = json_decode($_REQUEST['filter_get_all']);
		}
		// get index row - i.e. user click to sort. At first time sortname parameter -
		// after that the index from colModel 
		// sorting order - at first time sortorder 
	
		if(!$sidx) $sidx =1; 
		//echo "hung";exit;
		 $this->load->model('jq_loadtable_model');
		 $sord = $_REQUEST['sord'];

		$filter = $_REQUEST;
	
		$result = $this->jq_loadtable_model->getTableCompareSpecs($page,$limit,$sord,$sidx,$filter,$filter_get,$jq_table);
		//var_export($result);exit;
		echo json_encode($result);
	}
	
	
	public function getStockCurrency(){
		 // get stk_feed_last theo thoi gian giam dan
		 $this->data->stk_feed_last = $this->db->select('*')->order_by("time", "desc")->limit(5)
         ->get('stk_feed_last')->result_array();
		 
		  // get cur_feed_rt theo thoi gian giam dan
		 $cur_feed_rt = $this->db->select('*')->order_by("time", "desc")->get('cur_feed_rt')->result_array();
		 foreach($cur_feed_rt as $k_cur=>$var_cur){
			if($var_cur['currency'] == $var_cur['tos']){
				unset($cur_feed_rt[$k_cur]);	
			}
		}
		// echo "<pre>";print_r($cur_feed_rt);exit;
		 $this->data->cur_feed_rt = array_slice($cur_feed_rt,0,5);	
	}
    function getSpectIntraday(){
         $result = $this->db->select('idx_code,idx_last,time')->where('idx_code',$_POST['idx_code'])->order_by("time", "asc")
         ->get('idx_specs_intraday')->result_array();
         echo json_encode($result);
    }   
    function getFeedIntraday(){
         $result = $this->db->select('code,last,time')->where('code',$_POST['idx_code'])->order_by("time", "asc")
         ->get('stk_feed_intraday')->result_array();
		
         echo json_encode($result);
    }
    
    function insert_ca_group(){   
        //print_R('$sql');exit;
        $this->db->query("drop table if exists idx_ca_rt_tmp; ");
        $this->db->query("create table  idx_ca_rt_tmp select stk_code,idx_code1 idx_code,date,new_shares,nxt_float_idx,nxt_capp_idx,adj_close,intro,removal,exdate,effective_date,active,to_adjust,id_ca,time,idx_sg,
        event_name,stk_split,id_event_insert,evt_code from (
select a.*,c.idx_code as idx_code1, c.stk_name from (select * from idx_adj_group where (idx_code is null or length(idx_code)<1) and current_date()- date <5 ) as a
left join (select a1.stk_code, a1.idx_code,a1.stk_name, b.`group` from idx_composition_rt as a1, idx_ref_rt as b where a1.idx_code=b.idx_mother) as c 
on a.stk_code=c.stk_code and a.`group`=c.`group` ) as phuong group by stk_code, idx_code1,date; ");
        $this->db->query("insert into idx_ca_rt_tmp (stk_code,idx_code,date,new_shares,nxt_float_idx,nxt_capp_idx,adj_close,intro,removal,exdate,effective_date,active,to_adjust,id_ca,time,idx_sg,
        event_name,stk_split,id_event_insert,evt_code)
select stk_code,idx_code,date,new_shares,nxt_float_idx,nxt_capp_idx,adj_close,intro,removal,exdate,effective_date,active,to_adjust,id_ca,time,idx_sg,
        event_name,stk_split,id_event_insert,evt_code from idx_adj_group where length(idx_code)>1 and current_date()-date < 5;");
      //  print_R($sql);exit;
        $sql="select s.* from idx_ca_rt_tmp as s left join idx_ca_rt as n  on n.`idx_code` = s.`idx_code` and n.date=s.date and n.stk_code=s.stk_code 
where (n.`idx_code` is null or n.date is null or n.stk_code is null) ;";
                $idx_ca_rt= $this->db->query($sql)->result_array();
                if(count($idx_ca_rt)>0){
                    $this->db->insert_batch('idx_ca_rt', $idx_ca_rt);	
                }
                $this->db->query("update idx_ca_rt set codeint=concat('STKVN',stk_code) where codeint is null ; ");
                $this->db->query("update idx_ca_rt set to_adjust=1 where stk_split is null ; ");
                echo "Done!";  
    }
	public function getTableToFilterSelect(){
		
		$this->db->select('time');
		$this->db->distinct();
		$result = $this->db->get($_REQUEST['table'])->result_array(); 
		//echo "<pre>";print_r($result);exit;	
		echo json_encode($result);
	}
	public function curr_specs(){
		$this->load->model('Jq_compare_model', 'jq_compare_mode');
		$this->db7 = $this->load->database('database6', TRUE);//connect imsrt linux
		$sql_truncate2 = "truncate idx_specs_temp;";
		$this->db->query($sql_truncate2);
		$sql_drop2 = "DROP TABLE IF EXISTS idx_specs_compare_open;";
		$this->db->query($sql_drop2);
		
		if(isset($_REQUEST['curr_specs'])&&($_REQUEST['curr_specs']=='VND')){
			$currencySpecs =" WHERE right(a.`idx_code`,3)='VND'";
		}
		else 
			$currencySpecs = "";
		
		$specs_database_other = $this->db7->select("idx_code,idx_divisor,idx_mcap,idx_last,idx_dcap,idx_pclose,date,time,idx_conv")->get("idx_specs_rt")->result_array();
		$this->db->insert_batch('idx_specs_temp', $specs_database_other);
	  
	  $table_common2 ="create table idx_specs_compare_open (SELECT a.idx_code, a.date, a.idx_divisor, b.idx_divisor as idx_divisor_rt, ABS(a.idx_divisor - b.idx_divisor) as diff1,(CASE 
         WHEN (a.idx_divisor - b.idx_divisor) = 0 THEN 0
         ELSE 1
      END) AS stt1, a.idx_mcap, b.idx_mcap as idx_mcap_rt, ABS(a.idx_mcap - b.idx_mcap) as diff2,(CASE 
         WHEN (a.idx_mcap - b.idx_mcap) = 0 THEN 0
         ELSE 1
      END) AS stt2, a.idx_last, b.idx_last as idx_last_rt,  ABS(a.idx_last - b.idx_last) as diff3,(CASE 
         WHEN (a.idx_last - b.idx_last) = 0 THEN 0
         ELSE 1
      END) AS stt3, a.idx_dcap,b.idx_dcap as idx_dcap_rt , ABS(a.idx_dcap - b.idx_dcap) as diff4,(CASE 
         WHEN (a.idx_dcap - b.idx_dcap) = 0 THEN 0
         ELSE 1
      END) AS stt4, a.idx_pclose,b.idx_pclose as pclose_rt , ABS(a.idx_pclose - b.idx_pclose) as diff5,(CASE 
         WHEN (a.idx_pclose - b.idx_pclose) = 0 THEN 0
         ELSE 1
      END) AS stt5,
			a.idx_conv,b.idx_conv as idx_conv_rt , ABS(a.idx_conv - b.idx_conv) as diff6,(CASE 
         WHEN (a.idx_conv - b.idx_conv) = 0 THEN 0
         ELSE 1
      END) AS stt6 FROM idx_specs_temp as a INNER JOIN idx_specs_rt as b ON a.idx_code=b.idx_code {$currencySpecs});";
	  $this->db->query($table_common2);
	  $this->jq_compare_mode->count_top_specs("idx_specs_compare_open");
	}
	public function curr_specs_close(){
		$this->load->model('Jq_compare_model', 'jq_compare_mode');
		$this->db3 = $this->load->database('database3', TRUE);//connect local
		$sql_truncate2 = "truncate idx_specs_temp_local;";
		$this->db->query($sql_truncate2);
		$sql_drop2 = "DROP TABLE IF EXISTS idx_specs_compare_close;";
		$this->db->query($sql_drop2);
		
		if(isset($_REQUEST['curr_specs'])&&($_REQUEST['curr_specs']=='VND')){
			$currencySpecs =" WHERE right(a.`idx_code`,3)='VND'";
		}
		else 
			$currencySpecs = "";
		
		$specs_database_other = $this->db3->select("idx_code,idx_divisor,idx_mcap,idx_last,idx_dcap,idx_pclose,idx_conv")->get("idx_specs")->result_array();
		$this->db->insert_batch('idx_specs_temp_local', $specs_database_other);
	  
	  $table_common2 ="create table idx_specs_compare_close (SELECT a.idx_code, a.date, a.idx_divisor, b.idx_divisor as idx_divisor_rt, ABS(a.idx_divisor - b.idx_divisor) as diff1,(CASE 
         WHEN (a.idx_divisor - b.idx_divisor) = 0 THEN 0
         ELSE 1
      END) AS stt1, a.idx_mcap, b.idx_mcap as idx_mcap_rt, ABS(a.idx_mcap - b.idx_mcap) as diff2,(CASE 
         WHEN (a.idx_mcap - b.idx_mcap) = 0 THEN 0
         ELSE 1
      END) AS stt2, a.idx_last, b.idx_last as idx_last_rt, ABS(a.idx_last - b.idx_last) as diff3,(CASE 
         WHEN (a.idx_last - b.idx_last) = 0 THEN 0
         ELSE 1
      END) AS stt3, a.idx_dcap,b.idx_dcap as idx_dcap_rt , ABS(a.idx_dcap - b.idx_dcap) as diff4,(CASE 
         WHEN (a.idx_dcap - b.idx_dcap) = 0 THEN 0
         ELSE 1
      END) AS stt4, a.idx_pclose,b.idx_pclose as pclose_rt , ABS(a.idx_pclose - b.idx_pclose) as diff5,(CASE 
         WHEN (a.idx_pclose - b.idx_pclose) = 0 THEN 0
         ELSE 1
      END) AS stt5, a.idx_conv,b.idx_conv as idx_conv_rt , ABS(a.idx_conv - b.idx_conv) as diffconv,(CASE 
         WHEN (a.idx_conv - b.idx_conv) = 0 THEN 0
         ELSE 1
      END) AS stt6 FROM idx_specs_temp_local as a INNER JOIN idx_specs_rt as b ON a.idx_code=b.idx_code {$currencySpecs} ) ;";
	  $this->db->query($table_common2);
	  $this->jq_compare_mode->count_top_specs("idx_specs_compare_close");
	}
}