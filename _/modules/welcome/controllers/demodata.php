<?php

require('_/modules/welcome/controllers/block.php');

class Demodata extends Welcome{
    public function __construct() {
        parent::__construct();
        $this->load->model('journals_model', 'journals');
    }

    public function index()
    {
        $this->data->select_category = $this->journals->append_select_filter('category', 'category','efrc_data_demo');
        $this->data->select_stype = $this->journals->append_select_filter('stype', 'stype','efrc_data_demo');
        $this->data->select_group = $this->journals->append_select_filter('group', 'group','efrc_data_demo');
        $this->data->select_d = $this->journals->append_select_filter('d', 'd','efrc_data_demo');
        $this->data->select_m = $this->journals->append_select_filter('m', 'm','efrc_data_demo');
        $this->data->select_q = $this->journals->append_select_filter('q', 'q','efrc_data_demo');
        $this->data->select_y = $this->journals->append_select_filter('y', 'y','efrc_data_demo');
        
        $this->template->write_view('content', 'table/demodata', $this->data);
        $this->template->render();  
    }
    
    function list_demodata() {
        $iDisplayLength = intval($_REQUEST['length']);
        $iDisplayStart = intval($_REQUEST['start']);
        $sEcho = intval($_REQUEST['draw']);

        // select columns
        $aColumns = array('category', 'stype', '`group`', 'sgroup', '`code`', '`name`','`date`','d','m','q','y','`close`','vard','varm','vary');

        $sTable = "(Select * FROM efrc_data_demo) as sTable";
        
        $iTotalRecords = $this->db->get($sTable)->num_rows();
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
        // fiter
        $where = "where 1=1";
        if($this->input->post('category') and real_escape_string($this->input->post('category')) and $this->input->post('category') != 'all') {
            $where .= " and `category` = '".real_escape_string($this->input->post('category'))."'";
        }
        if($this->input->post('stype') and real_escape_string($this->input->post('stype')) and $this->input->post('stype') != 'all') {
            $where .= " and stype = '".real_escape_string($this->input->post('stype'))."'";
        }
         if($this->input->post('group') and real_escape_string($this->input->post('group')) and $this->input->post('group') != 'all') {
            $where .= " and `group` = '".real_escape_string($this->input->post('group'))."'";
        }
        if($this->input->post('sgroup')) {
            $where .= " and sgroup like '%".real_escape_string($this->input->post('sgroup'))."%'";
        }
        if($this->input->post('code')) {
            $where .= " and `code` like '%".real_escape_string($this->input->post('code'))."%'";
        }
        if($this->input->post('name')) {
            $where .= " and `name` like '%".real_escape_string($this->input->post('name'))."%'";
        }
        if($this->input->post('date_create_start') and strtotime($this->input->post('date_create_start'))) {
            $where .= " and `date` >= '".real_escape_string($this->input->post('date_create_start'))."'";
        }
        if($this->input->post('date_create_end') and strtotime($this->input->post('date_create_end'))) {
            $where .= " and `date` <= '".real_escape_string($this->input->post('date_create_end'))."'";
        }
         if($this->input->post('d') and $this->input->post('d') != 'all') {
            $array = explode('_',$this->input->post('d'));  
            $where .= " and `d` = '".real_escape_string($array[1])."'";
        }
        if($this->input->post('m') and $this->input->post('m') != 'all') {
            $array = explode('_',$this->input->post('m'));  
            $where .= " and `m` = '".real_escape_string($array[1])."'";
        }
        if($this->input->post('q') and $this->input->post('q') != 'all') {
            $array = explode('_',$this->input->post('q'));
            $where .= " and `q` = '".real_escape_string($array[1])."'";
        }
        if($this->input->post('y') and $this->input->post('y') != 'all') {
            $array = explode('_',$this->input->post('y'));
            $where .= " and `y` = '".real_escape_string($array[1])."'";
        }
        if($this->input->post('close_from') and is_numeric($this->input->post('close_from'))) {
            $where .= " and `close` >= '".real_escape_string($this->input->post('close_from'))."'";
        }
        if($this->input->post('close_to') and is_numeric($this->input->post('close_to'))) {
            $where .= " and `close` <= '".real_escape_string($this->input->post('close_to'))."'";
        }
        //if($this->input->post('close') and is_numeric($this->input->post('close'))) {
//            $where .= " and `close` like '%".real_escape_string($this->input->post('close'))."%'";
//        }  
        if($this->input->post('vard') and is_numeric($this->input->post('vard'))) {
            $where .= " and vard like '%".real_escape_string($this->input->post('vard'))."%'";
        }
        if($this->input->post('varm') and is_numeric($this->input->post('varm'))) {
            $where .= " and varm like '%".real_escape_string($this->input->post('varm'))."%'";
        }
        if($this->input->post('vary') and is_numeric($this->input->post('vary'))) {
            $where .= " and vary like '%".real_escape_string($this->input->post('vary'))."%'";
        }
        // order
        $order_by = "order by `category` desc";
        if (isset($_REQUEST['order'][0]['column'])) {
            $iSortCol_0 = $_REQUEST['order'][0]['column'];
            $sSortDir_0 = $_REQUEST['order'][0]['dir'];
            switch ($iSortCol_0) {
                case 1:
                    $order_by = "order by stype ".$sSortDir_0;
                    break;
                case 2:
                    $order_by = "order by `group` ".$sSortDir_0;
                    break;
                case 3:
                    $order_by = "order by sgroup ".$sSortDir_0;
                    break;
                case 4:
                    $order_by = "order by `code` ".$sSortDir_0;
                    break;
                case 5:
                    $order_by = "order by `name` ".$sSortDir_0;
                    break;
                case 6:
                    $order_by = "order by `date` ".$sSortDir_0;
                    break;
                case 7:
                    $order_by = "order by d ".$sSortDir_0;
                    break;
                case 8:
                    $order_by = "order by m ".$sSortDir_0;
                    break;
                case 9:
                    $order_by = "order by q ".$sSortDir_0;
                    break;
                case 10:
                    $order_by = "order by y ".$sSortDir_0;
                    break;
                case 11:
                    $order_by = "order by `close` ".$sSortDir_0;
                    break;
                case 12:
                    $order_by = "order by vard ".$sSortDir_0;
                    break;
                case 13:
                    $order_by = "order by varm ".$sSortDir_0;
                    break;
                case 14:
                    $order_by = "order by vary ".$sSortDir_0;
                    break;
                default:
                    $order_by = "order by `category` ".$sSortDir_0;
                    break;
            }
        }

        $sql = "select sql_calc_found_rows " . str_replace(' , ', ' ', implode(', ', $aColumns)) . "
                from {$sTable} {$where} {$order_by} limit {$iDisplayStart}, {$iDisplayLength};";
        $data = $this->db->query($sql)->result_array();

        $sql = "select count(*) count
                from {$sTable} {$where}";
        $iFilteredTotal = $this->db->query($sql)->row()->count;

        $records = array();
        $records["data"] = array();
        foreach ($data as $key => $value) {
            $records["data"][$key][] = $value['category'];
            $records["data"][$key][] = $value['stype'];
            $records["data"][$key][] = $value['group'];
            $records["data"][$key][] = $value['sgroup'];
            $records["data"][$key][] = $value['code'];
            $records["data"][$key][] = $value['name'];
            $records["data"][$key][] = $value['date'];
            $records["data"][$key][] = $value['d'];
            $records["data"][$key][] = $value['m'];
            $records["data"][$key][] = $value['q'];
            $records["data"][$key][] = $value['y'];
            $records["data"][$key][] = $value['close'];
            $records["data"][$key][] = $value['vard'];
            $records["data"][$key][] = $value['varm'];
            $records["data"][$key][] = $value['vary'];
            $records["data"][$key][] = '';           
        }

        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iFilteredTotal;
          
        $this->output->set_output(json_encode($records));
    }
    
    function export() {
           // select columns
        $aColumns = array('`category`', 'stype', '`group`', 'sgroup', '`code`', '`name`','`date`','d','m','q','y','`close`','vard','varm','vary');

        $sTable = "(Select * FROM efrc_data_demo) as sTable";
        
        // fiter
        $where = "where 1=1";
        if($this->input->post('category') and real_escape_string($this->input->post('category')) and $this->input->post('category') != 'all') {
            $where .= " and `category` = '".real_escape_string($this->input->post('category'))."'";
        }
        if($this->input->post('stype') and real_escape_string($this->input->post('stype')) and $this->input->post('stype') != 'all') {
            $where .= " and stype = '".real_escape_string($this->input->post('stype'))."'";
        }
         if($this->input->post('group') and real_escape_string($this->input->post('group')) and $this->input->post('group') != 'all') {
            $where .= " and `group` = '".real_escape_string($this->input->post('group'))."'";
        }
        if($this->input->post('sgroup')) {
            $where .= " and sgroup like '%".real_escape_string($this->input->post('sgroup'))."%'";
        }
        if($this->input->post('code')) {
            $where .= " and `code` like '%".real_escape_string($this->input->post('code'))."%'";
        }
        if($this->input->post('name')) {
            $where .= " and `name` like '%".real_escape_string($this->input->post('name'))."%'";
        }
        if($this->input->post('date_create_start') and strtotime($this->input->post('date_create_start'))) {
            $where .= " and `date` >= '".real_escape_string($this->input->post('date_create_start'))."'";
        }
        if($this->input->post('date_create_end') and strtotime($this->input->post('date_create_end'))) {
            $where .= " and `date` <= '".real_escape_string($this->input->post('date_create_end'))."'";
        }
        if($this->input->post('d') and $this->input->post('d') != 'all') {
            $array = explode('_',$this->input->post('d'));  
            $where .= " and `d` = '".real_escape_string($array[1])."'";
        }
        if($this->input->post('m') and $this->input->post('m') != 'all') {
            $array = explode('_',$this->input->post('m'));  
            $where .= " and `m` = '".real_escape_string($array[1])."'";
        }
        if($this->input->post('q') and $this->input->post('q') != 'all') {
            $array = explode('_',$this->input->post('q'));
            $where .= " and `q` = '".real_escape_string($array[1])."'";
        }
        if($this->input->post('y') and $this->input->post('y') != 'all') {
            $array = explode('_',$this->input->post('y'));
            $where .= " and `y` = '".real_escape_string($array[1])."'";
        }
        if($this->input->post('close_from') and is_numeric($this->input->post('close_from'))) {
            $where .= " and `close` >= ".real_escape_string($this->input->post('close_from'))."";
        }
        if($this->input->post('close_to') and is_numeric($this->input->post('close_to'))) {
            $where .= " and `close` <= ".real_escape_string($this->input->post('close_to'))."";
        }  
        if($this->input->post('vard')) {
            $where .= " and vard like '%".real_escape_string($this->input->post('vard'))."%'";
        }
        if($this->input->post('varm')) {
            $where .= " and varm like '%".real_escape_string($this->input->post('varm'))."%'";
        }
        if($this->input->post('vary')) {
            $where .= " and vary like '%".real_escape_string($this->input->post('vary'))."%'";
        }

        $sql = "select sql_calc_found_rows " . str_replace(' , ', ' ', implode(', ', $aColumns)) . "
                from {$sTable} {$where};";

        $this->load->dbutil();
        $query = $this->db->query($sql);
        
        switch($this->input->post('export_type')) {
            case 'txt':
                $delimiter = chr(9);
                $newline = "\r\n";
                $data = $this->dbutil->csv_from_result($query, $delimiter, $newline, '"');
                $path_file = 'assets/download/demodata.txt';
                break;
            default:
                $delimiter = ",";
                $newline = "\r\n";
                $data = $this->dbutil->csv_from_result($query, $delimiter, $newline, '"');
                $path_file = 'assets/download/demodata.csv';
                break;
        }
        file_put_contents($path_file, $data);
        echo $path_file;
    }
    
    
 }