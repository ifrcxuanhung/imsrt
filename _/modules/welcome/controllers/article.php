<?php
require('_/modules/welcome/controllers/block.php');

class Article extends Welcome{
    public function __construct() {
        parent::__construct();
    }
    
    public function index($cate, $art_id) {
		
        if(is_numeric($art_id) && $cate !='') {
            $block = new Block;
            $this->load->model('article_model');
            $this->load->model('ifrc_article_model');
            $art_id = round($art_id);
			
            $this->data->logo_partners = $block->logo_partners();
            $this->data->detailArticle = $this->ifrc_article_model->getArticleById($art_id);
			//if(isset($this->data->detailArticle['current'][0]['title'])){
            	$this->data->meta_title = $this->data->detailArticle['current'][0]['title'];
			//}
            //$this->data->meta_description = $this->data->detailArticle['current'][0]['meta_description'];
            //$this->data->meta_keywords = $this->data->detailArticle['current'][0]['meta_keyword'];
           // print_r($this->article_model->getArticleById($art_id));exit;
            $this->data->article_relative = $this->ifrc_article_model->getArticleRelative($cate, $art_id);
            $this->template->write_view('content', 'article/article', $this->data);
            $this->template->render();
        } else {
            
        }
    }
    
    public function category($cate_id, $page = 1) {
        $this->load->model('article_model');
        $num_page = $this->data->num_page = $this->article_model->getNumPageArticleByCat($cate_id);
        $page = round($page);$page = max(1,$page);$page = min($num_page,$page);
        @$this->data->articleNew = $this->article_model->getArticleByCat($cate_id, $page);
        @$this->data->name_cat = $this->data->articleNew[0]['name_cat'];
        $this->data->page = $page;
        $this->data->cate_id = $cate_id;
        $this->data->base_url = base_url();
        $this->template->write_view('content', 'article/category', $this->data);
        $this->template->render();
    }
}
