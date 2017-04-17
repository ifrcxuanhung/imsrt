<?php
require('_/modules/welcome/controllers/block.php');

class Index extends Welcome{
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        $block = new Block;
        $this->load->model('article_model');
        $this->load->model('Menu_model', 'menu');
        $this->data->calendar = $block->calendar();
        $this->data->logo_partners = $block->logo_partners();
        $this->data->feed_chat = $block->feed_chat();
        $this->data->hightlights = $block->hightlights();
        $this->data->article_index = $this->article_model->getArticleShowIndex();
                // get menu
        $this->data->menu = $this->menu->getMenuById($this->session->userdata_vnefrc('id_menu'));
        $this->template->write_view('content', 'index', $this->data);
        $this->template->render();
    }
}
