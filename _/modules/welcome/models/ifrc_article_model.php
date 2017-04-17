<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* * ****************************************************************** */
/*     Client  Name  :  IFRC                                      */
/*     Project Name  :  cms v3.0                                     */
/*     Program Name  :  article_model.php               	      */
/*     Entry Server  :                                               */
/*     Called By     :  System                                       */
/*     Notice        :  File Code is utf-8                           */
/*     Copyright     :  IFRC                                         */
/* ------------------------------------------------------------------- */
/*     Comment       :  model article                             */
/* ------------------------------------------------------------------- */
/*     History       :                                               */
/* ------------------------------------------------------------------- */
/*     Version V001  :  2012.09.28 (Tung)        New Create      */
/* * ****************************************************************** */

class Ifrc_article_model extends CI_Model{
    protected $_table = 'ifrc_articles';
    protected $_table_cate = 'category';
    protected $_table_cate_detail = 'category_description';
    protected $_lang;

	public function __construct(){
		parent::__construct();
        $this->_lang = $this->session->userdata_vnefrc('curent_language');
		$this->db2 = $this->load->database('database', TRUE);
	}
	
	public function list_article_cate($cate) {
		if($this->_lang['code']=='us') $this->_lang['code'] = 'en';
		$sql = "SELECT tempt1.id ,tempt1.clean_cat, tempt1.title, tempt1.description, tempt1.long_description, tempt1.clean_artid, tempt1.images, tempt1.url, tempt2.date_creation, tempt2.clean_order FROM ifrc_articles as tempt1 RIGHT JOIN (select *, (@cnt := @cnt + 1) AS rowNumber from ifrc_articles CROSS JOIN (SELECT @cnt := 0) AS dummy where lang_code='en'  ORDER BY clean_order ASC) as tempt2
ON tempt1.clean_artid = tempt2.clean_artid
where  
 tempt1.lang_code='".$this->_lang['code']."' 
 and tempt2.clean_cat IN (".$cate.") and tempt2.`website` like '%vnefrc%' and tempt2.`status`=1
ORDER BY tempt2.rowNumber";
	  if($row = $this->db2->query($sql)){
			$data['current'] = $row->result_array();
		}
		$sql = "SELECT tempt1.id ,tempt1.clean_cat, tempt1.title, tempt1.description, tempt1.long_description, tempt1.clean_artid, tempt1.images, tempt1.url, tempt2.date_creation, tempt2.clean_order FROM ifrc_articles as tempt1 RIGHT JOIN (select *, (@cnt := @cnt + 1) AS rowNumber from ifrc_articles CROSS JOIN (SELECT @cnt := 0) AS dummy where lang_code='en'  ORDER BY clean_order ASC) as tempt2
ON tempt1.clean_artid = tempt2.clean_artid
where  
 tempt1.lang_code='".LANG_DEFAULT."' 
 and tempt2.clean_cat IN (".$cate.") and tempt2.`website` like '%vnefrc%' and tempt2.`status`=1
ORDER BY tempt2.rowNumber";
	if($row = $this->db2->query($sql)){
		$data['default'] = $row->result_array();
	}
	if(!empty($data['default'])){
		$data['current'] = replaceValueNull($data['current'], $data['default']);
	}

        return $data;
    }
	public function ifrc_article_intro(){
			if($this->_lang['code']=='us') $this->_lang['code'] = 'en';
	  	$sql = "SELECT * FROM ifrc_articles WHERE clean_cat = 'intro' and website like '%vnefrc%' and status = 1 and lang_code = '".$this->_lang['code']."' LIMIT 0,1";
     	$data = $this->db2->query($sql)->row_array();
		
        return $data;
	}
    public function getArticleById($art_id)
    {

        $sql = "SELECT tempt1.id ,tempt1.clean_cat, tempt1.title, tempt1.description, tempt1.long_description, tempt1.clean_artid, tempt1.images, tempt1.url, tempt2.date_creation, tempt2.clean_order FROM ifrc_articles as tempt1 RIGHT JOIN (select *, (@cnt := @cnt + 1) AS rowNumber from ifrc_articles CROSS JOIN (SELECT @cnt := 0) AS dummy where lang_code='en'  ORDER BY clean_order ASC) as tempt2
        ON tempt1.clean_artid = tempt2.clean_artid
        where  
        tempt1.lang_code='".$this->_lang['code']."' 
        and tempt2.`website` like '%vnefrc%' and tempt2.`status`=1 AND tempt1.clean_artid = '$art_id' 
        ORDER BY tempt2.rowNumber";
        if($row = $this->db2->query($sql)){
        		$data['current'] = $row->result_array();
        	}
        	$sql = "SELECT tempt1.id ,tempt1.clean_cat, tempt1.title, tempt1.description, tempt1.long_description, tempt1.clean_artid, tempt1.images, tempt1.url, tempt2.date_creation, tempt2.clean_order FROM ifrc_articles as tempt1 RIGHT JOIN (select *, (@cnt := @cnt + 1) AS rowNumber from ifrc_articles CROSS JOIN (SELECT @cnt := 0) AS dummy where lang_code='en'  ORDER BY clean_order ASC) as tempt2
        ON tempt1.clean_artid = tempt2.clean_artid
        where  
        tempt1.lang_code='".LANG_DEFAULT."' 
        and tempt2.`website` like '%vnefrc%' and tempt2.`status`=1 AND tempt1.clean_artid = '$art_id' 
        ORDER BY tempt2.rowNumber";
        if($row = $this->db2->query($sql)){
        	$data['default'] = $row->result_array();
        }
        
        if(!empty($data['default'])){
            $data['current'] = replaceValueNull($data['current'], $data['default']);
        }
        $data['current'] = @$data['current'];
        $data['default'] = @$data['default'];
	
        return $data;
    }
    public function getArticleRelative($cate, $art_id)
    {
        $lang = $this->session->userdata_vnefrc('curent_language');
        $lang = $lang['code'];

        $lang_default = $this->session->userdata_vnefrc('default_language');
        $lang_default = $lang_default['code'];

       	$sql = "SELECT tempt1.id ,tempt1.clean_cat, tempt1.title, tempt1.description, tempt1.long_description, tempt1.clean_artid, tempt1.images, tempt1.url, tempt2.date_creation, tempt2.clean_order FROM ifrc_articles as tempt1 RIGHT JOIN (select *, (@cnt := @cnt + 1) AS rowNumber from ifrc_articles CROSS JOIN (SELECT @cnt := 0) AS dummy where lang_code='en'  ORDER BY clean_order ASC) as tempt2
        ON tempt1.clean_artid = tempt2.clean_artid
        where  
         tempt1.lang_code='".$this->_lang['code']."' 
         and tempt2.clean_cat IN ('".$cate."') and tempt2.`website` like '%vnefrc%' and tempt2.`status`=1 AND tempt1.clean_artid != '$art_id' 
        ORDER BY tempt2.rowNumber";
        	  if($row = $this->db2->query($sql)){
        			$data['current'] = $row->result_array();
        		}
        		$sql = "SELECT tempt1.id ,tempt1.clean_cat, tempt1.title, tempt1.description, tempt1.long_description, tempt1.clean_artid, tempt1.images, tempt1.url, tempt2.date_creation, tempt2.clean_order FROM ifrc_articles as tempt1 RIGHT JOIN (select *, (@cnt := @cnt + 1) AS rowNumber from ifrc_articles CROSS JOIN (SELECT @cnt := 0) AS dummy where lang_code='en'  ORDER BY clean_order ASC) as tempt2
        ON tempt1.clean_artid = tempt2.clean_artid
        where  
         tempt1.lang_code='".LANG_DEFAULT."' 
         and tempt2.clean_cat IN ('".$cate."') and tempt2.`website` like '%vnefrc%' and tempt2.`status`=1 AND tempt1.clean_artid != '$art_id' 
        ORDER BY tempt2.rowNumber";
        	if($row = $this->db2->query($sql)){
        		$data['default'] = $row->result_array();
        	}
        
        if(!empty($data['default'])){
            $data['current'] = replaceValueNull($data['current'], $data['default']);
        }
        $data['current'] = @$data['current'];
        $data['default'] = @$data['default'];
        return $data;
    }
	
	public function ifrc_articles_news(){

		$sql_set = "SELECT value FROM setting WHERE `layout` = 'home' AND `key` = 'new' LIMIT 0,1";
		$set = $this->db->query($sql_set)->row_array();
		if($this->_lang['code']=='us') $this->_lang['code'] = 'en';
		$sql = "SELECT tempt1.id ,tempt1.clean_cat, tempt1.title, tempt1.description, tempt1.long_description, tempt1.clean_artid, tempt1.images, tempt1.url, tempt2.date_creation, tempt2.clean_order FROM ifrc_articles as tempt1 RIGHT JOIN (select *, (@cnt := @cnt + 1) AS rowNumber from ifrc_articles CROSS JOIN (SELECT @cnt := 0) AS dummy where lang_code='en'  ORDER BY date_creation ) as tempt2
                ON tempt1.clean_artid = tempt2.clean_artid
                where  
                 tempt1.lang_code='".$this->_lang['code']."' 
                 and tempt2.clean_cat = 'news' and tempt2.`website` like '%vnefrc%' and tempt2.`status`=1
                ORDER BY tempt2.rowNumber
                DESC LIMIT 0,".$set['value']."
                ";



             if($row = $this->db2->query($sql)){
            			$data['current'] = $row->result_array();
            		}
            		$sql = "SELECT tempt1.id ,tempt1.clean_cat, tempt1.title, tempt1.description, tempt1.long_description, tempt1.clean_artid, tempt1.images, tempt1.url, tempt2.date_creation, tempt2.clean_order FROM ifrc_articles as tempt1 RIGHT JOIN (select *, (@cnt := @cnt + 1) AS rowNumber from ifrc_articles CROSS JOIN (SELECT @cnt := 0) AS dummy where lang_code='en'  ORDER BY date_creation DESC ) as tempt2
            ON tempt1.clean_artid = tempt2.clean_artid
            where  
             tempt1.lang_code='".LANG_DEFAULT."' 
             and tempt2.clean_cat = 'news' and tempt2.`website` like '%vnefrc%' and tempt2.`status`=1
            ORDER BY tempt2.rowNumber
            LIMIT 0,".$set['value']."
            ";
             
            	if($row = $this->db2->query($sql)){
            		$data['default'] = $row->result_array();
            	}
            	if(!empty($data['default'])){
            		$data['current'] = replaceValueNull($data['current'], $data['default']);
            	}
            
                    return $data;
            		
    }
	public function ifrc_article_detail($id){
		$sql = "SELECT * FROM ifrc_articles WHERE clean_artid = $id and lang_code = '".$this->_lang['code']."'";	
		 if($row = $this->db2->query($sql)){
			$data['current'] = $row->result_array();
		}
		$sql = "SELECT * FROM ifrc_articles WHERE clean_artid = $id and lang_code = '".LANG_DEFAULT."'";
		if($row = $this->db2->query($sql)){
		$data['default'] = $row->result_array();
		}
		if(!empty($data['default'])){
			$data['current'] = replaceValueNull($data['current'], $data['default']);
		}
		
        return $data;
	}
	
	
	
	public function ifrc_get_by_category($id,$sort_order){
		$sql = "SELECT clean_cat FROM ifrc_articles WHERE clean_artid= $id";
		$data = $this->db2->query($sql)->row_array();

		if(isset($data['clean_cat'])){
			 $result['content'] = $this->get_article_by_cate_code($data['clean_cat'],$sort_order);
		}
		$result['cat']= $data['clean_cat'];
		
		return $result;
	}
	
	public function get_article_by_cate_code($code,$sort_order,$limit=''){
		  if($sort_order != ""){
            $sort = $sort_order;
        }else {
            $sort = ' clean_order asc';
        }
		if($limit!='') $str_limit =" LIMIT 0,{$limit}";
		else $str_limit ='';
	
        $data = '';
        // $sql = 'SELECT * FROM ifrc_articles s WHERE s.`website` like "%vnefrc%" AND s.clean_cat ="'.$code.'" AND s.`status` = 1 AND lang_code ="' . $this->_lang['code'] . '" ORDER BY clean_order';
        $sql = "SELECT tempt1.id ,tempt1.title, tempt1.description, tempt1.clean_cat ,tempt1.long_description, tempt1.clean_artid, tempt1.images, tempt1.url, tempt2.date_creation, tempt2.clean_order 
                FROM ifrc_articles as tempt1 
                RIGHT JOIN (select *, (@cnt := @cnt + 1) AS rowNumber from ifrc_articles 
                CROSS JOIN (SELECT @cnt := 0) AS dummy where  lang_code='en'  
                ORDER BY {$sort}) as tempt2
                ON tempt1.clean_artid = tempt2.clean_artid
                where  
                 tempt1.lang_code='{$this->_lang['code']}' 
				 and tempt2.clean_cat = '{$code}' and tempt2.`website` like '%vnefrc%' and tempt2.`status`=1
                ORDER BY tempt2.rowNumber {$str_limit}";
       
        if($row = $this->db2->query($sql)){
            $data['current'] = $row->result_array();
        }
        $sql = "SELECT tempt1.id ,tempt1.title, tempt1.description, tempt1.clean_cat ,tempt1.long_description, tempt1.clean_artid, tempt1.images, tempt1.url, tempt2.date_creation, tempt2.clean_order 
                FROM ifrc_articles as tempt1 
                RIGHT JOIN (select *, (@cnt := @cnt + 1) AS rowNumber from ifrc_articles 
                CROSS JOIN (SELECT @cnt := 0) AS dummy where lang_code='en'  
                ORDER BY {$sort}) as tempt2
                ON tempt1.clean_artid = tempt2.clean_artid
                where  
                 tempt1.lang_code='".LANG_DEFAULT."' 
				 and tempt2.clean_cat = '{$code}' and tempt2.`website` like '%vnefrc%' and tempt2.`status`=1
                ORDER BY tempt2.rowNumber {$str_limit}";
        //$sql = 'SELECT * FROM ifrc_articles s WHERE  s.`website` like "%vnefrc%" AND s.clean_cat ="'.$code.'" AND s.`status` = 1 AND lang_code ="' . LANG_DEFAULT . '" ORDER BY clean_order';
        
        if($row = $this->db2->query($sql)){
            $data['default'] = $row->result_array();
        }
        if(!empty($data['default'])){
            $data['current'] = replaceValueNull($data['current'], $data['default']);
        }
		 //echo "<pre>";print_r($data);exit;
        return $data;
    }
    
    public function get_article_by_scate_code($cat,$code,$sort_order){
		  if($sort_order != ""){
            $sort = $sort_order;
        }else {
            $sort = ' clean_order asc';
        }
		
        $data = '';
        // $sql = 'SELECT * FROM ifrc_articles s WHERE s.`website` like "%vnefrc%" AND s.clean_cat ="'.$code.'" AND s.`status` = 1 AND lang_code ="' . $this->_lang['code'] . '" ORDER BY clean_order';
        $sql = "SELECT tempt1.id ,tempt1.title, tempt1.description, tempt1.clean_cat ,tempt1.long_description, tempt1.clean_artid, tempt1.images, tempt1.url, tempt2.date_creation, tempt2.clean_order, tempt2.clean_scat
                FROM ifrc_articles as tempt1 
                RIGHT JOIN (select *, (@cnt := @cnt + 1) AS rowNumber from ifrc_articles 
                CROSS JOIN (SELECT @cnt := 0) AS dummy where  lang_code='en'  
                ORDER BY {$sort}) as tempt2
                ON tempt1.clean_artid = tempt2.clean_artid
                where  
                 tempt1.lang_code='{$this->_lang['code']}' 
				 and tempt2.clean_scat = '{$code}' and tempt2.`website` like '%vnefrc%' and tempt2.`status`=1
				 and tempt2.clean_cat='{$cat}'
                ORDER BY tempt2.rowNumber";
       
        if($row = $this->db2->query($sql)){
            $data['current'] = $row->result_array();
        }
        $sql = "SELECT tempt1.id ,tempt1.title, tempt1.description, tempt1.clean_cat ,tempt1.long_description, tempt1.clean_artid, tempt1.images, tempt1.url, tempt2.date_creation, tempt2.clean_order, tempt2.clean_scat
                FROM ifrc_articles as tempt1 
                RIGHT JOIN (select *, (@cnt := @cnt + 1) AS rowNumber from ifrc_articles 
                CROSS JOIN (SELECT @cnt := 0) AS dummy where lang_code='en'  
                ORDER BY {$sort}) as tempt2
                ON tempt1.clean_artid = tempt2.clean_artid
                where  
                 tempt1.lang_code='".LANG_DEFAULT."' 
				 and tempt2.clean_scat = '{$code}' and tempt2.`website` like '%vnefrc%' and tempt2.`status`=1
				  and tempt2.clean_cat='{$cat}'
                ORDER BY tempt2.rowNumber";
        //$sql = 'SELECT * FROM ifrc_articles s WHERE  s.`website` like "%vnefrc%" AND s.clean_cat ="'.$code.'" AND s.`status` = 1 AND lang_code ="' . LANG_DEFAULT . '" ORDER BY clean_order';
        if($row = $this->db2->query($sql)){
            $data['default'] = $row->result_array();
        }
        if(!empty($data['default'])){
            $data['current'] = replaceValueNull($data['current'], $data['default']);
        }
		 //echo "<pre>";print_r($data);exit;
        return $data;
    }
    
    function list_category_code($parentCode) {
        $data = '';
        // $sql = 'SELECT * FROM ifrc_articles s WHERE s.`website` like "%vnefrc%" AND s.clean_cat ="'.$code.'" AND s.`status` = 1 AND lang_code ="' . $this->_lang['code'] . '" ORDER BY clean_order';
        $sql = "SELECT tempt1.clean_cat,tempt1.clean_scat 
                FROM ifrc_articles as tempt1 
                where  
                 tempt1.lang_code='{$this->_lang['code']}' 
				 and tempt1.clean_cat = '{$parentCode}' and tempt1.`website` like '%vnefrc%' and tempt1.`status`=1
                ";
       
        if($row = $this->db2->query($sql)){
            $data['current'] = $row->result_array();
        }
        $sql = "SELECT tempt1.clean_cat, tempt1.clean_scat
                FROM ifrc_articles as tempt1 
                where  
                 tempt1.lang_code='".LANG_DEFAULT."' 
				 and tempt1.clean_cat = '{$parentCode}' and tempt1.`website` like '%vnefrc%' and tempt1.`status`=1
                ";
				
        //$sql = 'SELECT * FROM ifrc_articles s WHERE  s.`website` like "%vnefrc%" AND s.clean_cat ="'.$code.'" AND s.`status` = 1 AND lang_code ="' . LANG_DEFAULT . '" ORDER BY clean_order';
        //print_r($sql);
        if($row = $this->db2->query($sql)){
            $data['default'] = $row->result_array();
        }
        if(!empty($data['default'])){
            $data['current'] = replaceValueNull($data['current'], $data['default']);
        }
		 //echo "<pre>";print_r($data);exit;
        return $data;
    }
	


}