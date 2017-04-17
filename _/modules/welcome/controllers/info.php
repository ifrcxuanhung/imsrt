<?php

class Info extends Welcome{
    public function __construct() {
        parent::__construct();
       // $this->load->model('Setting_model', 'setting');
		$this->load->model('Table__model', 'table');
        $this->load->Model('idx_page_model', 'midx_page');
        $this->load->Model('vndb_events_day_model', 'vndb_events');
    }

    public function index($idx_code)
    {
        $header_composition = $this->table->get_headers('idx_composition_rt');
        $this->data->header_composition = $header_composition;
        //print_R($header_composition);exit;
        //print_R(implode(',',$header_composition['field']));exit;
        $data = $this->table->get_composition_table('idx_composition_rt',$idx_code);
        //$idx_code = $this->uri->segment(4);
        //$this->load->model('sysformat_model', 'msys');
       // $row = $this->msys->findSysformatByTable('idx_composition_realtime', 'decimals');
//        foreach ($row as $item) {
//            $decimal[$item['fields']] = $item['decimals'];
//        }
        //$data = $this->midx_page->getIdx($idx_code);
        
        //print_R($data);exit;
        //$this->data->news = $this->vndb_events->getNews($idx_code);
        //$this->data->decimal = $decimal;
        //$this->data->ref = $data['idx_ref'];
        //$this->data->ca = $data['idx_ca'];
        $this->data->composition = $data['idx_composition_rt'];
        
        //$this->data->stk_div = $this->midx_page->get_stk_div($idx_code);
        //$this->data->specs = $data['idx_specs'];
        //$this->data->const = count($data['idx_composition']);
        //$this->data->linked = $this->midx_page->showLinkedIndex($idx_code);
        
        /* get date time lated on idx_intraday, don't care about idx_code (ask Hoai Phuong) */
       //// $sql = "SELECT {$this->idx_intraday}.date, time, prv_date
//                FROM {$this->idx_intraday}, idx_calendar
//                WHERE {$this->idx_intraday}.date = idx_calendar.date
//                ORDER BY date DESC, time DESC
//                LIMIT 1";
       // $this->data->date_time = $this->db->query($sql)->result_array();
//        $this->data->title = 'Index Page';
//        
      // 
        
        $this->template->write_view('content', 'info/index', $this->data);
        $this->template->render();  
    }
    
}
