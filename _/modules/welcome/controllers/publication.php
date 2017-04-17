<?php

require('_/modules/welcome/controllers/block.php');
require('_/modules/welcome/controllers/mail/class.phpmailer.php');
require('_/modules/welcome/controllers/mail/class.smtp.php');

class Publication extends Welcome{
    public function __construct() {
        parent::__construct();
        $this->load->model('publication_model', 'publication');
    }

    public function index()
    {
        $headers = $this->publication->get_headers();
        foreach ($headers as $key => $value) {
            if(($value['active'] == 1)&& ($value['type_search'] == 1)) {
                switch(strtolower($value['type'])) {
                    case 'varchar':
                    case 'longtext':
                    case 'int':
                        $headers[$key]['filter'] = $this->publication->append_input(strtolower($value['field']));
                        break;
                    case 'list':
                        $headers[$key]['filter'] = $this->publication->append_select(strtolower($value['field']));
                        break;
                    case 'date':
                        $headers[$key]['filter'] = $this->publication->append_date(strtolower($value['field']));
                        break;
                    default:
                        $headers[$key]['filter'] = '';
                }
            } else {
                $headers[$key]['filter'] = '';
            }
        }
        $this->data->headers = $headers;
        
        $this->template->write_view('content', 'table/publication', $this->data);
        $this->template->render();  
    }
    
    function list_publications() {
        
        $table = $_GET['table'];
        $iDisplayLength = intval($_REQUEST['length']);
        $iDisplayStart = intval($_REQUEST['start']);
        $sEcho = intval($_REQUEST['draw']);

        // select columns
        $where = "where 1=1";
        $headers = $this->publication->get_headers();
        $aColumns = array();
        foreach ($headers as $item) {
            if($item['active'] == 1) {
                $aColumns[] = '`'.strtolower($item['field']).'`';
                if($this->input->post(strtolower($item['field']))) {
                    switch(strtolower($item['type'])) {
                        case 'varchar':
                        case 'longtext':
                        case 'int':
                            $where .= " and {$item['field']} like '%".real_escape_string($this->input->post(strtolower($item['field'])))."%'";
                            break;
                        case 'list':
                            if($this->input->post(strtolower($item['field'])) != 'all') {
                                $where .= " and {$item['field']} = '".real_escape_string($this->input->post(strtolower($item['field'])))."'";    
                            }
                            break;
                        case 'date':
                            $where .= " and {$item['field']} = '".real_escape_string($this->input->post(strtolower($item['field'])))."'";
                            break;
                        default:
                            break;
                    }
                }
            }
        }

        $sTable = "(Select * FROM $table) as sTable";
        
        $iTotalRecords = $this->db->get($sTable)->num_rows();
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 

        // order
         $order_by = "";
        if (isset($_REQUEST['order'][0]['column'])) {
            $iSortCol_0 = $_REQUEST['order'][0]['column'];
            $sSortDir_0 = $_REQUEST['order'][0]['dir'];
            foreach($aColumns as $key => $value) {
                if($iSortCol_0 == $key) {
                    $order_by = "order by $value ".$sSortDir_0;
                    break;
                }
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
            //$records["data"][$key][] = '<input type="checkbox" class="checkbox-active" name="id[]" value="'.$value['title'].'">';
            foreach($headers as $item) {  
                if($item['active'] == 1) {
                    switch($item['align']) {
                        case 'L':
                            $align = ' class="align-left"';
                            break;
                        case 'R';
                            $align = ' class="align-right"';
                            break;
                        default:
                            $align = ' class="align-center"';
                            break;
                    }
                    $records["data"][$key][] = '<div'.$align.'>'.$value[strtolower($item['field'])].'</div>';
                    
                }
              
            }
            $records["data"][$key][] = '';
           // $records["data"][$key][] .= '<center><div class="align-center">'
//                                        .'<a class="btn default btn-xs green view-journal" id_journal="'.$value['issn'].'" href="#modal_view" data-toggle="modal">
//                                        <i class="fa fa-edit"></i></a>'
//                                        .'<!--a class="btn default btn-xs red" href="#">
//                                        <i class="fa fa-trash-o"></i></a-->'
//                                        .'</div></center>';
        }
           
        

        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iFilteredTotal;
          
        $this->output->set_output(json_encode($records));
    }
    
    function export() {
        // select columns
        $where = "where 1=1";
        $headers = $this->publication->get_headers();
        $aColumns = array();
        foreach ($headers as $item) {
            if($item['active'] == 1) {
                $aColumns[] = '`'.strtolower($item['field']).'`';
                if($this->input->post(strtolower($item['field']))) {
                    switch(strtolower($item['type'])) {
                        case 'varchar':
                        case 'longtext':
                        case 'int':
                            $where .= " and `{$item['field']}` like '%".real_escape_string($this->input->post(strtolower($item['field'])))."%'";
                            break;
                        case 'list':
                            if($this->input->post(strtolower($item['field'])) != 'all') {
                                $where .= " and `{$item['field']}` = '".real_escape_string($this->input->post(strtolower($item['field'])))."'";    
                            }
                            break;
                        case 'date':
                            $where .= " and `{$item['field']}` = '".real_escape_string($this->input->post(strtolower($item['field'])))."'";
                            break;
                        default:
                            break;
                    }
                }
            }
        }
            
        $sTable = "(Select * FROM efrc_publications) as sTable";

        $sql = "select sql_calc_found_rows " . str_replace(' , ', ' ', implode(', ', $aColumns)) . "
                from {$sTable} {$where};";

        $this->load->dbutil();
        $query = $this->db->query($sql);
        
        switch($this->input->post('export_type')) {
            case 'txt':
                $delimiter = chr(9);
                $newline = "\r\n";
                $data = $this->dbutil->csv_from_result($query, $delimiter, $newline, '');
                $path_file = 'assets/download/publication.txt';
                break;
            default:
                $delimiter = ",";
                $newline = "\r\n";
                $data = $this->dbutil->csv_from_result($query, $delimiter, $newline, '"');
                $path_file = 'assets/download/publication.csv';
                break;
        }
        file_put_contents($path_file, chr(239).chr(187).chr(191).$data);
        echo $path_file;
        
        
    }
    
    
    
}