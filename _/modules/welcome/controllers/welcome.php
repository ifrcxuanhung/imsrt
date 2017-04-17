<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends MY_Controller {

    protected $data;

    function __construct() {
		
        parent::__construct();
        $this->data = new stdClass();
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $this->load->library('user_agent');
        $this->load->library('ion_auth');
        $this->load->library('session');
		/*ob_start(); 
		if(!isset($_SESSION)){
			session_start();
		}
		//var_export(($_SESSION['vndmi']));die();
       
		if (isset($_SESSION['imsrt']['username'])) :
			$this->ion_auth->logout();
		endif;
		*/
		if(isset($_SESSION['imsrt']['user_id'])){
			$this->session->set_userdata_vnefrc('user_id', $_SESSION['imsrt']['user_id']);
		}
		else {
			$this->session->unset_userdata_vnefrc('user_id');
		}
        if (!$this->ion_auth->logged_in()) {
            $this->session->set_userdata_vnefrc('url_login', current_url());
            $this->session->set_userdata_vnefrc('module_login', 'welcome');
        }
        //print_R($this->session->userdata_vnefrc('user_id'));exit;
        $this->data->config = $this->db->get('config')->row_array();
		$this->data->setting_rt = $this->db->where('group','setting')->where('key','imsrt_status')->get('setting_rt')->row_array();
        //Times
        
		$this->data->setting_rt_fre = $this->db->where('group','setting')->where('key','frequency')->get('setting_rt')->row_array();
        $this->data->setting_rt_start = $this->db->where('group','setting')->where('key','start')->get('setting_rt')->row_array();
        $this->data->setting_rt_end = $this->db->where('group','setting')->where('key','end')->get('setting_rt')->row_array();
		//get setting color in setting_rt
		$this->data->setting_rt_color_equal = $this->db->where('group','setting')->where('key','color_equal')->get('setting_rt')->row_array();
		$this->data->setting_rt_color_positive = $this->db->where('group','setting')->where('key','color_positive')->get('setting_rt')->row_array();
		$this->data->setting_rt_color_negative = $this->db->where('group','setting')->where('key','color_negative')->get('setting_rt')->row_array();

		
        $this->load->model('admin/Language_model', 'language');
        $where = array('status' => 1);
        $langList = $this->language->find(NULL, $where);
        if (is_array($langList) == TRUE && count($langList) > 0) {
            foreach ($langList as $value) {
                $this->data->list_language[$value['code']] = $value;
            }
            $this->data->default_language = $langList[0];
        }
        unset($langList);
        $this->session->set_userdata_vnefrc('default_language', $this->data->default_language);
        if (!$this->session->userdata_vnefrc('curent_language')) {
            $this->session->set_userdata_vnefrc('curent_language', $this->data->default_language);
        }
        $this->data->curent_language = $this->session->userdata_vnefrc('curent_language');
		//user info
		if($this->session->userdata_vnefrc('user_id')) {
			if (!$this->session->userdata_vnefrc('user_level')) {
				 $this->load->model('User_model', 'user_detail');
				 $detail = $this->user_detail->get_detail_user($this->session->userdata_vnefrc('user_id'));
				 $this->session->set_userdata_vnefrc('user_level', $detail['user_level']);
			}
		}
		else {
			 $this->session->set_userdata_vnefrc('user_level', 0);
		}
		//menu
        if (!$this->session->userdata_vnefrc('id_menu')) {
            $this->session->set_userdata_vnefrc('id_menu', '0');
        }
        $this->data->template_url = template_url();
        $setting = $this->registry->setting;
        $this->data->setting = $setting;
        $this->template->set_template('default');
        if ($setting['maintenance'] == 1)
        {
             redirect(base_url().'maintenance', 'refresh');
        }
		
        // load data sidebar
        $this->load->model('Menu_model', 'menu');
        $this->data->menu = $this->menu->getMenu();
        $this->data->id_menu_actived = $this->session->userdata_vnefrc('id_menu');
        
        // load language
        $this->data->list_lang = $this->db->where('status', 1)
            ->order_by('sort_order', 'asc')
            ->get('language')->result_array();
		$this->data->user = $this->db->where('id', $this->session->userdata_vnefrc('user_id'))
                    ->limit(1)
                    ->get('user')->row_array();
        // load media
        $this->load->model('Media_model', 'media');
		
        $this->data->list_partners = $this->media->getMediaByCateCode('partners');
		if($this->router->fetch_class()=='table'){
		$this->load->model('Table__model', 'table');
		$arr_table_sys = $this->table->get_summary(@$this->uri->segment(2) ? @$this->uri->segment(2) : 'summary');
		}	
		$this->data->title_description = isset($arr_table_sys["description"]) ? $arr_table_sys["description"] :'';
		
		// load jq_loadtable
		$this->load->model('jq_loadtable_model');
		 $this->data->jq_data = $this->db->select('jq')->where('table_name','efrc_data_ref')
         ->get('efrc_summary')->row_array();
		 
		 // get stk_feed_last theo thoi gian giam dan
		 $this->data->stk_feed_last = $this->db->select('*')->where('time <>','00:00:00')->order_by('date desc, update_time desc, time desc')->limit(5)
         ->get('stk_feed_rt')->result_array();
		 $this->data->idx_specs_abnormal = $this->db->select('codeint,time,idx_dvar')->order_by('ABS(idx_dvar) desc')->limit(5)
         ->get('idx_specs_abnormal')->result_array();
		  // get cur_feed_rt theo thoi gian giam dan
		 $cur_feed_rt = $this->db->select('*')->order_by('date desc, time desc')->limit(5)->get('cur_feed_rt')->result_array();
		 foreach($cur_feed_rt as $k_cur=>$var_cur){
			/*if($var_cur['currency'] == $var_cur['tos']){
				unset($cur_feed_rt[$k_cur]);	
			}*/
		}
		// echo "<pre>";print_r($cur_feed_rt);exit;
		 $this->data->cur_feed_rt = array_slice($cur_feed_rt,0,5);
		 
		 
		 $this->load->model('jq_loadtable_model');
		 $this->data->jq_ins = $this->db->select('jq')->where('table_name','efrc_ins_ref')
         ->get('efrc_summary')->row_array();
		 
		 $this->data->user_job = $this->db->where_in('userid', array($this->session->userdata_vnefrc('user_id'),0))->where('active', 1)
                                ->get('int_shortcuts')->result_array();
		// echo $this->session->userdata_vnefrc('session_counts');exit;
		//end phan trang load nhanh
        $this->template->write_view('header', 'header', $this->data);
        //$this->template->write_view('mega_menu', 'mega_menu', $this->data);
      //  $this->template->write_view('sidebar', 'sidebar', $this->data);
        $this->template->write_view('quick_sidebar', 'quick_sidebar', $this->data);
        
    }

    public function index() {
     
    }
	

    public function active($langCode = '') {
        $ls = $this->language_model->find();
        foreach ($ls as $key => $value) {
            $this->data->list_language[$value['code']] = $value;
        }
        if (isset($this->data->list_language[$langCode]) == TRUE) {
            $this->session->set_userdata_vnefrc('curent_language', $this->data->list_language[$langCode]);
            $this->output->set_output(json_encode(array('result' => 1)));
        }
    }

    public function timer() {
        $this->output->set_output(date('H:i:s'));
    }

}

/* End of file welcome.php */
    /* Location: ./application/controllers/welcome.php */