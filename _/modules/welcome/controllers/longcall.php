<?php
require('_/modules/welcome/controllers/block.php');

class Longcall extends Welcome{
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        $block = new Block;
        $this->load->model('article_model');
        $this->data->logo_partners = $block->logo_partners();
        $this->data->rightoptionstrategies = $block->rightoptionstrategies();
        //$this->data->getArticle_description=$block->getArticle_description(300);
        $this->data->description = $this->article_model->getArticle_description(300);
        
        $this->template->write_view('content', 'longcall', $this->data);
        $this->template->render();
    }
}
