<?php
require('_/modules/welcome/controllers/block.php');

class Blackscholes extends Welcome{
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        $block = new Block;
        $this->load->model('article_model');
        $this->data->logo_partners = $block->logo_partners();
        
        $this->template->write_view('content', 'blackscholes', $this->data);
        $this->template->render();
    }
}
