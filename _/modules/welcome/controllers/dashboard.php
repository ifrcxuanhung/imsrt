<?php

require('_/modules/welcome/controllers/block.php');

class Dashboard extends Welcome{
    public function __construct() {
        parent::__construct();
        $this->load->model('dashboard_model','dashboard');
    }
    
   
    public function index()
    {
       
        $this->load->model('Article_model', 'article');
         $this->load->model('ifrc_article_model');
        $this->data->article_hightlights = $this->ifrc_article_model->get_article_by_cate_code(str_replace('-','','highlights'),str_replace('.',' ','date_creation.desc'),100);
        $this->data->detailArticle = $this->article->getArticleById(314);
       
        $data = $this->dashboard->getdashboardTable('level2');
        $dashboardTab = $this->dashboard->getdashboardTable();
        
        $tabledash = array() ;
       
        for($i=0; $i<count($data); $i++)
        {
            $tabledash[$i] = $data[$i];
            $id = $data[$i]['level1'];
            $tabChilren = $this->dashboard->getdashboardTable($id);
            if(!empty($tabChilren))
            {
                $tabledash[$i]['tabChilren'] = $tabChilren;

            }
        }
        //print_r($tabledash);exit;
        $this->data->dashboardTab = $tabledash;
        //var_export($this->data->detailArticle);
        $this->template->write_view('content', 'dashboard', $this->data);
        $this->template->render();   
    }
    //public function listdata(){
//        
//        $iTotalRecords = count($this->dashboard->getdashboardTable('level2'));
//        $iDisplayLength = intval($_REQUEST['length']);
//        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
//        $iDisplayStart = intval($_REQUEST['start']);
//        $sEcho = intval($_REQUEST['draw']);    
//        $records = array();
//        $records["data"] = array();   
//        $data = $this->dashboard->getdashboardTable('level2');
//        $dashboardTab = $this->dashboard->getdashboardTable();
//       
//        for($i=0; $i<count($data); $i++)
//        {
//            $records["data"][$i] = $data[$i];
//            $id = $data[$i]['level1'];
//            $tabChilren = $this->dashboard->getdashboardTable($id);
//            if(!empty($tabChilren))
//            {
//                $records["data"][$i]['tabChilren'] = $tabChilren;
//
//            }
//        }   
//        $records["draw"] = $sEcho;
//        $records["recordsTotal"] = $iTotalRecords;
//        $records["recordsFiltered"] = $iTotalRecords;
//       // print_R($records);exit;
//        $this->output->set_output(json_encode($records));
//    }

    public function listChilren()
    {
        $level = $_POST['level1'];
       
        $tabChilren = $this->dashboard->getdashboardTable($level);
        
  //      $html_equal = "<table>";
//        foreach($tabChilren as $value)
//        {
//            $html_equal = '<tr>';
//            $html_equal .= "<td>".$value['category']."</td>";
//            $html_equal .= "<td>".$value['type']."</td>";
//            $html_equal .= "<td>".($value['nb'] != 0) ? $value['nb'] : ''."</td>";
//            $html_equal .= "<td>".($value['column'] != 0) ? $value['column'] : ''."</td>";
//            $html_equal .= "<td>".($value['records'] != 0) ? $value['records'] : ''."</td>";
//            $html_equal .= "<td>".$value['coverage']."</td>";
//            $html_equal .= "<td>".($value['from'] != '0000-00-00') ? $value['from'] : ''."</td>";
//            $html_equal .= "<td>".$value['data']."</td>";
//            $html_equal .= "<td>".$value['update']."</td>";
//            $html_equal .= "<td>".$value['description']."</td>";
//            $html_equal .= '</tr>';
//        }
//        $html_equal .= "</table>";
//
//        $html_equal = $html_equal != "" ? $html_equal : "<table><tr><td>Không tìm th?y công ch?c</td></tr></table>";
//
        $output = $tabChilren;
        echo json_encode($output);
    }
}