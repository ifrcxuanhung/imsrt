<?php
class Maintenance extends MY_Controller{
    
    public function __construct()
    {
        parent::__construct();
        $this->data = new stdClass();
        $this->load->library('session');
        $this->template->set_template('maintenance');
    }
    
    public function index()
    {
       //s print_r('1111111111111111111111');
      // $this->data->base_url = base_url();
       // $this->template->write_view('content', 'maintenance', $this->data);
       $this->template->render();
       
    }
}