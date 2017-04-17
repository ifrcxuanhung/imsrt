 <?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tabledetail extends Welcome {
    function __construct() {
        parent::__construct();
        $this->load->model('table_model', 'table');
    }
    function index(){
        
        $name = isset($_GET['name']) ? strtolower($_GET['name']) : "dghq_summary" ;
        $this->data->header = $this->table->table_type($name);
        $this->data->name = $name;
       // print_r($name);exit;
        $this->template->write_view('content', 'table/tabledetail', $this->data);
        $this->template->render();
    }
    public function listdatadetail(){
        
        $name = isset($_GET['name']) ? strtolower($_GET['name']) : "dghq_summary" ;
        $iTotalRecords = $this->table->table_info($name, 0, 10, 'get_total');
        $iDisplayLength = intval($_REQUEST['length']);
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
        $iDisplayStart = intval($_REQUEST['start']);
        $sEcho = intval($_REQUEST['draw']);    
        $records = array();
        $records["data"] = array();   
        $col = $this->table->table_info($name, $iDisplayStart, $iDisplayLength);
        $header = $this->table->table_type($name);
        foreach ($col as $key => $value) {
            foreach($header as $head){
                $records["data"][$key][] = $value[$head['Field']];
            }
        }      
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
        $this->output->set_output(json_encode($records));
    }
  
  
  
} 
    