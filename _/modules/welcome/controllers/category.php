<?php

require('_/modules/welcome/controllers/block.php');

class Category extends Welcome{
    public function __construct() {
        parent::__construct();
    }
    
    public function index($cate, $scate ='') {
        $block = new Block;
        $this->load->model('article_model');
        $this->load->model('ifrc_article_model');
        $this->load->model('category_model');
        $this->load->model('Menu_model', 'menu');
		$this->load->model('setting_model', 'setting');
        $this->data->logo_partners = $block->logo_partners();
       // $cate = isset($_GET['category'])? $_GET['category'] : '.' ;
        // get value menu
	
		  $sortby = $this->article_model->setting_category($cate);
	
       //$arr = json_decode($this->db->where('id',  $this->session->userdata_vnefrc('id_menu'))
         //   ->get('menu')->row()->value, true);
         //   print_R(str_replace('.',' ',$arr['sort_by']));exit;
       // $sortby = isset($arr['sort_by']) ? str_replace('.',' ',$arr['sort_by']) : '';
        //$sort = $arr['sort_by'];
//        $endsort = strpos($sort,'.');
//        $sortby = substr($sort,0,$endsort);
//        $change = substr($sort,$endsort+1,strlen($sort));
        /*$check = isset($arr['check'])? $arr['check'] : '1_1_1_1' ;
        $this->data->checkimg = substr($check, 2, 1);
        $this->data->checkdate = substr($check, 0, 1);    
        $this->data->checkseemore = substr($check, 4, 1);
        $this->data->checkLinkWebsite = substr($check, 6, 1);*/
        $this->data->namepage = $cate;
		$this->data->scat_arr = $scate;
        // get menu
        //$this->data->menu = $this->menu->getMenuById($this->session->userdata_vnefrc('id_menu'));
        $article = $this->ifrc_article_model->get_article_by_cate_code(str_replace('-','',$cate),$sortby);
        $this->data->article_blog = $article['current'];
        //print_r(str_replace('-','',$_GET['category']));exit;
        //print_r($this->article_model->getArticleByCodeCategory('on-going-researches',0,100,$sortby,$change));exit;
        $category = $this->ifrc_article_model->list_category_code(str_replace('-','',$cate));
        //print_R($category);exit;
        //$array = json_decode(json_encode($category),true);
        $this->data->arr_current = $category;
        if($scate != ''){
             $this->data->listcate[str_replace('-','',$cate)]['article'] = $this->ifrc_article_model->get_article_by_scate_code($cate,str_replace('-','',$scate),$sortby);
        }else{
            //print_R($category);exit;
            if(count($category['current'])>0 && !is_null($category['current'])){
                foreach($category['current'] as $value)
                {
                  // print_R($value);
                    $this->data->listcate[$value['clean_scat']]['clean_scat'] = $value['clean_scat'];
                  //  $this->data->listcate[$value['clean_cat']]['name'] = $value['name'];
                    $this->data->listcate[$value['clean_scat']]['article'] = $this->ifrc_article_model->get_article_by_scate_code($cate,$value['clean_scat'],$sortby);
                }
                //print_R($this->data->listcate);exit;
                unset($category);
            }else {
               // print_r($array);exit;
                $this->data->listcate[str_replace('-','',$cate)]['article'] = $this->ifrc_article_model->get_article_by_scate_code($cate,str_replace('-','',$cate),$sortby);
            }
        }
		//var_export( $this->data->listcate);
        $this->template->write_view('content', 'category/category', $this->data);
        $this->template->render();
    }
}