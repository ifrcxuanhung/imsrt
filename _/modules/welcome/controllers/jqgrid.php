<?php
class Jqgrid extends Welcome{
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
        $this->load->model('Table__model', 'table');
    }
    
    public function index() {
        echo "test";
    }
	
	public function jq_loadhierarchy(){
		//echo "<pre>";print_r($_REQUEST);exit;
		$jq_table = $_REQUEST['jq_table'];
		$page = $_REQUEST['page']; 
        if($jq_table == 'summary'){
            $jq_table =='efrc_'.$jq_table;
        }
		// get how many rows we want to have into the grid - rowNum parameter in the grid 
		$limit = $_REQUEST['rows']; 
		$sidx = $_REQUEST['sidx'];
		$filter_get = array(); 
		if(isset($_REQUEST['filter_get_all'])){
			$filter_get = json_decode($_REQUEST['filter_get_all']);
		}
		// get index row - i.e. user click to sort. At first time sortname parameter -
		// after that the index from colModel 
		// sorting order - at first time sortorder 
	
		if(!$sidx) $sidx =1; 
		//echo "hung";exit;
		 $this->load->model('jq_loadtable_model');
		 $sord = $_REQUEST['sord'];

		$filter = $_REQUEST;
		
		$result = $this->jq_loadtable_model->getTableHierarchy($page,$limit,$sord,$sidx,$filter,$filter_get,$jq_table);
		//var_export($result);exit;
		echo json_encode($result);
	}
	
	public function jq_loadhierarchyChild(){
		//echo "<pre>";print_r($_REQUEST);exit;
		$jq_table = 'idx_composition_rt';
		$page = $_REQUEST['page']; 
        if($jq_table == 'summary'){
            $jq_table =='efrc_'.$jq_table;
        }
		// get how many rows we want to have into the grid - rowNum parameter in the grid 
		$limit = $_REQUEST['rows']; 
		$sidx = $_REQUEST['sidx'];
		$filter_get = array(); 
		if(isset($_REQUEST['filter_get_all'])){
			$filter_get = json_decode($_REQUEST['filter_get_all']);
		}
		// get index row - i.e. user click to sort. At first time sortname parameter -
		// after that the index from colModel 
		// sorting order - at first time sortorder 
	
		if(!$sidx) $sidx =1; 
		//echo "hung";exit;
		 $this->load->model('jq_loadtable_model');
		 $sord = $_REQUEST['sord'];

		$filter = $_REQUEST;
		
		$result = $this->jq_loadtable_model->getTableHierarchyChild($page,$limit,$sord,$sidx,$filter,$filter_get,$jq_table);
		//var_export($result);exit;
		echo json_encode($result);
	}
	
	
	public function jq_loadhierarchyChild_ca(){
		//echo "<pre>";print_r($_REQUEST);exit;
		$jq_table = 'idx_ca_rt';
		$page = $_REQUEST['page']; 
        if($jq_table == 'summary'){
            $jq_table =='efrc_'.$jq_table;
        }
		// get how many rows we want to have into the grid - rowNum parameter in the grid 
		$limit = $_REQUEST['rows']; 
		$sidx = $_REQUEST['sidx'];
		$filter_get = array(); 
		if(isset($_REQUEST['filter_get_all'])){
			$filter_get = json_decode($_REQUEST['filter_get_all']);
		}
		// get index row - i.e. user click to sort. At first time sortname parameter -
		// after that the index from colModel 
		// sorting order - at first time sortorder 
	
		if(!$sidx) $sidx =1; 
		//echo "hung";exit;
		 $this->load->model('jq_loadtable_model');
		 $sord = $_REQUEST['sord'];

		$filter = $_REQUEST;
		
		$result = $this->jq_loadtable_model->getTableHierarchyChild_ca($page,$limit,$sord,$sidx,$filter,$filter_get,$jq_table);
		//var_export($result);exit;
		echo json_encode($result);
	}
	
	
	public function jq_loadhierarchy2(){
		
		$jq_table = $_REQUEST['jq_table2'];
		//so sanh ben model
		$table = $_REQUEST['jq_table'];
		//
		$page = $_REQUEST['page']; 
        if($jq_table == 'summary'){
            $jq_table =='efrc_'.$jq_table;
        }
		// get how many rows we want to have into the grid - rowNum parameter in the grid 
		$limit = $_REQUEST['rows']; 
		$sidx = $_REQUEST['sidx'];
		$filter_get = array(); 
		if(isset($_REQUEST['filter_get_all'])){
			$filter_get = json_decode($_REQUEST['filter_get_all']);
		}
		// get index row - i.e. user click to sort. At first time sortname parameter -
		// after that the index from colModel 
		// sorting order - at first time sortorder 
	
		if(!$sidx) $sidx =1; 
		//echo "hung";exit;
		 $this->load->model('jq_loadtable_model');
		 $sord = $_REQUEST['sord'];

		$filter = $_REQUEST;
		
		$result = $this->jq_loadtable_model->getTableHierarchy2($page,$limit,$sord,$sidx,$filter,$filter_get,$jq_table,$table);
	
		echo json_encode($result);
	}
	
	public function jq_loadhierarchyChild2(){
		//echo "<pre>";print_r($_REQUEST);exit;
		$jq_table = 'idx_composition_rt';
		$page = $_REQUEST['page']; 
        if($jq_table == 'summary'){
            $jq_table =='efrc_'.$jq_table;
        }
		// get how many rows we want to have into the grid - rowNum parameter in the grid 
		$limit = $_REQUEST['rows']; 
		$sidx = $_REQUEST['sidx'];
		$filter_get = array(); 
		if(isset($_REQUEST['filter_get_all'])){
			$filter_get = json_decode($_REQUEST['filter_get_all']);
		}
		// get index row - i.e. user click to sort. At first time sortname parameter -
		// after that the index from colModel 
		// sorting order - at first time sortorder 
	
		if(!$sidx) $sidx =1; 
		//echo "hung";exit;
		 $this->load->model('jq_loadtable_model');
		 $sord = $_REQUEST['sord'];

		$filter = $_REQUEST;
		
		$result = $this->jq_loadtable_model->getTableHierarchyChild2($page,$limit,$sord,$sidx,$filter,$filter_get,$jq_table);
		//var_export($result);exit;
		echo json_encode($result);
	}
	
	public function jq_loadhierarchyChild_compo(){
		//echo "<pre>";print_r($_REQUEST);exit;
		$jq_table = 'idx_composition_rt';
		$page = $_REQUEST['page']; 
        if($jq_table == 'summary'){
            $jq_table =='efrc_'.$jq_table;
        }
		// get how many rows we want to have into the grid - rowNum parameter in the grid 
		$limit = $_REQUEST['rows']; 
		$sidx = $_REQUEST['sidx'];
		$filter_get = array(); 
		if(isset($_REQUEST['filter_get_all'])){
			$filter_get = json_decode($_REQUEST['filter_get_all']);
		}
		// get index row - i.e. user click to sort. At first time sortname parameter -
		// after that the index from colModel 
		// sorting order - at first time sortorder 
	
		if(!$sidx) $sidx =1; 
		//echo "hung";exit;
		 $this->load->model('jq_loadtable_model');
		 $sord = $_REQUEST['sord'];

		$filter = $_REQUEST;
		
		$result = $this->jq_loadtable_model->getTableHierarchyChild_ca_compo($page,$limit,$sord,$sidx,$filter,$filter_get,$jq_table);
		//var_export($result);exit;
		echo json_encode($result);
	}
	
	
	
	
	public function jq_loadhierarchy3(){
		//echo "<pre>";print_r($_REQUEST);exit;
		$jq_table = $_REQUEST['jq_table3'];
		$page = $_REQUEST['page']; 
        if($jq_table == 'summary'){
            $jq_table =='efrc_'.$jq_table;
        }
		// get how many rows we want to have into the grid - rowNum parameter in the grid 
		$limit = $_REQUEST['rows']; 
		$sidx = $_REQUEST['sidx'];
		$filter_get = array(); 
		if(isset($_REQUEST['filter_get_all'])){
			$filter_get = json_decode($_REQUEST['filter_get_all']);
		}
		// get index row - i.e. user click to sort. At first time sortname parameter -
		// after that the index from colModel 
		// sorting order - at first time sortorder 
	
		if(!$sidx) $sidx =1; 
		//echo "hung";exit;
		 $this->load->model('jq_loadtable_model');
		 $sord = $_REQUEST['sord'];

		$filter = $_REQUEST;
		
		$result = $this->jq_loadtable_model->getTableHierarchy3($page,$limit,$sord,$sidx,$filter,$filter_get,$jq_table);
		//var_export($result);exit;
		echo json_encode($result);
	}
	
	public function edit_del_add_jq_loadhierarchy(){
		//echo "<pre>";print_r($_REQUEST);exit;
		 $this->load->model('article_model');
		 
		$data = array();
		
		if($_POST['oper'] == 'del'){
			$this->db->delete($_REQUEST['jq_table'], array('id' => $_POST['id'])); 
			echo "true";
		}
		if($_POST['oper'] == 'add'){
			foreach($_POST as $k=>$v){
				if($k!= 'oper' && $k!= 'id')
					$data[$k] = $v;	
			}
			$this->db->insert($_REQUEST['jq_table'], $data); 
			echo "true";
			
		}
		 if($_POST['oper'] == 'edit'){
			foreach($_POST as $k=>$v){
				if($k!= 'oper' && $k!= 'id')
					$data[$k] = $v;	
			}

			$this->db->where('id', $_POST['id']);
			$this->db->update($_REQUEST['jq_table'], $data);
			echo "true";
			
		 }
	}
	
	

}