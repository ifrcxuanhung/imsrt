<?php

class Block extends MY_Controller {

    protected $data;

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
    }
    
    
    public function footer()
    {
        return $this->load->view('block/footer', $this->data, true);
    }
    
    public function header()
    {
        return $this->load->view('block/header', $this->data, true);
    }
    
    public function sidebar_menu()
    {
        $this->load->model('menu_model');
        $sql = "select * from language where status = 1 order by sort_order";
        @$this->data->list_lang = $this->db->query($sql)->result_array();
        //@$this->data->menu = $this->menu_model->getMainMenu();
        @$this->data->menu = $this->menu_model->getMenu();
        @$this->data->id_menu_actived = $this->session->userdata_vnefrc('id_menu');
        return $this->load->view('block/sidebar_menu', $this->data, true);
    }
    
    public function feed_chat()
    {
		$this->load->model('ifrc_article_model');
        $this->data->article_hightlights = $this->ifrc_article_model->get_article_by_cate_code(str_replace('-','','highlights'),str_replace('.',' ','date_creation.desc'),3);
        return $this->load->view('block/feed_chat', $this->data, true);
    }
    
    public function logo_partners()
    {
        $this->load->model('media_model');
        @$this->data->list_partners = $this->media_model->getMediaByCateCode('partners');
        return $this->load->view('block/logo_partners', $this->data, true);
    }
    
    public function calendar()
    {
        $this->load->model('article_model');
        @$this->data->calendar = $this->article_model->getArticleByCodeCategory('calendar');
        return $this->load->view('block/calendar', $this->data, true);
    }
    
    public function rightoptionstrategies()
    {
        return $this->load->view('block/rightoptionstrategies', $this->data, true);
    }
    
    public function hightlights()
    {
		 $this->load->model('ifrc_article_model');
        $this->data->article_hightlights = $this->ifrc_article_model->get_article_by_cate_code(str_replace('-','','highlights'),str_replace('.',' ','date_creation.desc'),100);
        return $this->load->view('block/hightlights', $this->data, true);
    }
    
    public function compare_chart($code = '') {
        $this->load->model('dashboard_model', 'dashboard');
        if ($this->input->is_ajax_request()) {
            $response = $this->dashboard->getClose($code);
            $this->output->set_output(json_encode($response));
        }
        $data = new stdClass();
        $data->template_url = template_url();
        $where = array(
            'PLACE' => 'Vietnam',
            'CURR' => 'VND',
            'PRICE' => 'PR',
            'VNXI'  => '1'
        );
        $data->icode = $code;
        $data->hnx = $this->dashboard->getClose('IFRCHNX');
        $data->vni = $this->dashboard->getClose('IFRCVNI');
        $data->sample = $this->dashboard->getSampleCode($where);
        return $this->load->view('block/compare_chart', $data, true);
    }
    
     public function compare_chart_2() {
        $this->load->model('dashboard_model', 'dashboard');
        if ($this->input->is_ajax_request()) {
            $frequency = $this->input->post('frequency');
            $dataCode = array();
            foreach($_POST as $key => $value){
                if (strpos($key,'code') !== false) {
                    $getName = $this->db->query('SELECT shortname FROM idx_sample WHERE code = "'.$value.'"')->row_array();
                    $dataCode[$getName['shortname']] = $this->dashboard->getClose2($value,$frequency);
                }
            }
            $response['data'] = $dataCode;
            echo json_encode($response);
        }
    }
    
}