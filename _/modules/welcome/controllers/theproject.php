<?php
require('_/modules/welcome/controllers/block.php');

class Theproject extends Welcome{
    public function __construct() {
        parent::__construct();
        $this->load->model('Article_model', 'article');
        $this->load->model('Menu_model', 'menu');
    }
    
    public function index() {
        $block = new Block;
       
         $this->load->model('ifrc_article_model');
        $this->data->article_hightlights = $this->ifrc_article_model->get_article_by_cate_code(str_replace('-','','highlights'),str_replace('.',' ','date_creation.desc'),100);

    	// get first article in list
    	//$list_article = $this->article->getArticleShowIndex();
        $list_article = $this->article->getArticleById(314);
    	$this->data->article = $list_article['current'][0];
    	unset($list_article);

        // get calendar
        $this->data->calendar = $this->article->getArticleByCodeCategory('calendar');

        // get article hightlights bottom
        $this->data->article_hightlights_bottom =  $this->ifrc_article_model->get_article_by_cate_code(str_replace('-','','highlights'),str_replace('.',' ','date_creation.desc'),3);
    	
        $this->data->menu = $this->menu->getMenuById($this->session->userdata_vnefrc('id_menu'));
        $this->template->write_view('content', 'theproject/theproject', $this->data);
        $this->template->render();
    }
}
