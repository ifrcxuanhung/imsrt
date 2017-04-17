<?php
require('_/modules/welcome/controllers/block.php');

class Setting extends Welcome{
    public function __construct() {
        parent::__construct();
        $this->load->model('Article_model', 'article');
        $this->load->model('Market_maker_model', 'market');
    
    }
    
    public function index() {
        $block = new Block;
        $this->data->calendar = $block->calendar();
        $this->data->logo_partners = $block->logo_partners();
        $this->data->feed_chat = $block->feed_chat();
        $this->data->hightlights = $block->hightlights();
        $this->data->article_index = $this->article->getArticleShowIndex();
        $this->data->setting_content = $this->market->get_market_setting(0);
    
        $this->template->write_view('content', 'setting', $this->data);
        $this->template->render();
    }

    public function hose() {
        $block = new Block;
        $this->data->calendar = $block->calendar();
        $this->data->logo_partners = $block->logo_partners();
        $this->data->feed_chat = $block->feed_chat();
        $this->data->hightlights = $block->hightlights();
        $this->data->article_index = $this->article->getArticleShowIndex();
        $this->data->setting_content = $this->market->get_market_setting(0);

        $this->template->write_view('content', 'hose', $this->data);
        $this->template->render();
    }
    
}