<?php
require('_/modules/welcome/controllers/block.php');

class My_profile extends Welcome{
    public function __construct() {
        parent::__construct();
		 $this->load->model('Profile_model', 'user');
    }
    
    public function index() {
        $block = new Block;
        $this->load->model('article_model');
        $this->data->logo_partners = $block->logo_partners();
		 $this->data->detail_user = $this->user->get_detail_user($this->session->userdata_vnefrc('user_id'));
        $this->template->write_view('content', 'my_profile', $this->data);
        $this->template->render();
    }
}
