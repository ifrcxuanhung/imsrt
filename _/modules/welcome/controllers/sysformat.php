<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* * ****************************************************************** */
/*     Client  Name  :  IFRC                                      */
/*     Project Name  :  cms v3.0                                     */
/*     Program Name  :  sysformat.php                                      */
/*     Entry Server  :                                               */
/*     Called By     :  System                                       */
/*     Notice        :  File Code is utf-8                           */
/*     Copyright     :  IFRC                                         */
/* ------------------------------------------------------------------- */
/*     Comment       :  controller sys format                             */
/* ------------------------------------------------------------------- */
/*     History       :                                               */
/* ------------------------------------------------------------------- */
/*     Version V001  :  2012.08.14 (Tung)        New Create      */
/* * ****************************************************************** */

class Sysformat extends Welcome {

    public $table;
    public $pages;

    public function __construct() {
        parent::__construct();
        $this->load->Model('sysformat_model', 'msys');
        $this->table = $this->input->get('table');
        if ($this->table == '') {
            $this->table = 'efrc_currency_data';
        }
        $this->pages = $this->uri->segment(2);
    }

    public function index() {
		
        if ($this->input->is_ajax_request()) {
            $table = $this->input->get('table');
            $page = $this->input->get('page'); // get the requested page
            $limit = $this->input->get('rows'); // get how many rows we want to have into the grid
            $sidx = $this->input->get('sidx'); // get index row - i.e. user click to sort
            $sord = $this->input->get('sord'); // get the direction
            //$col = array('dates', 'times', 'idx_code', 'idx_name', 'idx_curr', 'idx_base', 'idx_type', 'idx_mother', 'idx_divisor' , 'idx_mcap', 'idx_dcap', 'idx_last', 'ip_plast', 'idx_var');
            $where = '';
            $current = $this->input->get('current');
			
            //unset($this->input->get('current'));
            $order_start = $current * 9 + 1;
            $response = $this->msys->getTableData($table, $page, $limit, $sidx, $sord, '', $where, $order_start);
			
            echo json_encode($response);
        } else {
			
            echo $this->input->get('type');
            $this->template->write_view('content', 'sysformat/sysformat_list', $this->data);
            //$this->template->write('title', 'View');
            $this->template->render();
        }
	
    }
	
	  public function full() {
        if ($this->input->is_ajax_request()) {
            $table = strtolower($this->input->get('table'));
            $page = $this->input->get('page'); // get the requested page
            $limit = $this->input->get('rows'); // get how many rows we want to have into the grid
            $sidx = $this->input->get('sidx'); // get index row - i.e. user click to sort
            $sord = $this->input->get('sord'); // get the direction
            $where = '';
            $current = $this->input->get('current');
            //unset($this->input->get('current'));
            $order_start = $current * 9 + 1;
            $response = $this->msys->getTableDataFull($table, $page, $limit, $sidx, $sord, '', $where, $order_start);
            echo json_encode($response);
        } else {
            echo $this->input->get('type');
            $this->template->write_view('content', 'sysformat/sysformat_list', $this->data);
            $this->template->write('title', 'View');
            $this->template->render();
        }
    }

    public function upload_view() {

    }

    public function show_view() {
        $this->data->content = $this->msys->find_view();
        $this->template->write_view('content', 'sysformat/view_list', $this->data);
        $this->template->write('title', 'View');
        $this->template->render();
    }

    public function add() {
        $this->template->write_view('content', 'sysformat/sysformat_add', $this->data);
        $this->template->write('title', 'Sysformat');
    }

    public function edit() {
        if ($this->input->is_ajax_request()) {
            unset($_POST['oper']);
            $this->msys->update($this->table, $this->input->post('id'), $this->input->post());
        }
    }

    public function updateWidth(){
        if($this->input->is_ajax_request()){
            $header = $this->input->get('header');
            $table = $this->input->get('table');
            $data['widths'] = $this->input->get('width');
            $this->msys->updateWidth($table, $header, $data);
        }
    }

    public function active() {
        if ($this->input->is_ajax_request()) {
            $status = $this->input->get('status');
            $id = $this->input->get('id');
            $data['active'] = $status;
            if ($this->msys->update('idx_view', $id, $data)) {
                echo "Success";
            }
        }
    }

    public function getConfig(){
        if($this->input->is_ajax_request()){
            $table = $this->input->get('table');
			
            $response = $this->msys->load_format($table, 'headers');
			
            echo json_encode($response);

        }
    }
	
	  public function getConfigFull() {
        if ($this->input->is_ajax_request()) {
            $table = $this->input->get('table');
            $response = $this->msys->load_format_all_fields($table, 'headers');
            echo json_encode($response);
        }
    }

    protected function _getTableData() {
        //khai bao table
        $page = $this->input->get('page'); // get the requested page
        $limit = $this->input->get('rows'); // get how many rows we want to have into the grid
        $sidx = $this->input->get('sidx'); // get index row - i.e. user click to sort
        $sord = $this->input->get('sord'); // get the direction
        $response = $this->msys->getTableData($this->table, $page, $limit, $sidx, $sord);
        echo json_encode($response);
    }

    public function export() {
        if ($this->input->is_ajax_request()) {
            $path = APPPATH . '../../assets/download/views/';
            $table = $this->input->get('table');
            $filename = $table . '.txt';
            $path_file = $path . $filename;
            $id = '';
            if($this->input->get('id')){
                $id = $this->input->get('id');
            }
            $data = $this->msys->listView($table, $id);
            file_put_contents($path_file, $data);
            $response['file'] = $filename;
            $response['path'] = $path_file;
            echo json_encode($response);
        }
    }
	
	  public function export_result() {
        if ($this->input->is_ajax_request()) {
            $path = APPPATH . '../../assets/download/views/';
            $table = strtolower($this->input->get('table'));
            $type = $this->input->get('type');
            if ($type == 'price') {
                $column = 'close_pr';
            } else if ($type == 'total-return') {
                $column = 'close_tr';
            } else {
                $column = 'close_nr';
            }
            $filename = $type . '.txt';
            $path_file = $path . $filename;
            $id = '';
            if ($this->input->get('id')) {
                $id = $this->input->get('id');
            }
            $data = $this->msys->list_view_qidx_final($table, $id, $column);
            file_put_contents($path_file, $data);
            $response['file'] = $filename;
            $response['path'] = $path_file;
            echo json_encode($response);
        }
    }



    public function download_file() {
        $file = $this->input->get('file');
        $path = $this->input->get('path');
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$file");
        header("Content-Type: text/plain");
        header("Content-Transfer-Encoding: binary");
        header("Content-Length: " . filesize($path));
        $this->_readfile_chunked($path);
    }

    public function test() {
        $file = 'idx_currency_day.txt';
        $path = "_/application/../../assets/download/views/idx_currency_day.txt";
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$file");
        header("Content-Type: application/octet_stream");
        header("Content-Transfer-Encoding: binary");
        $this->_readfile_chunked($path);
    }

    protected function _readfile_chunked ($filename) { 
        $chunksize = 1*(1024*1024); // how many bytes per chunk 
        $buffer = ''; 
        $handle = fopen($filename, 'rb'); 
        if ($handle === false) { 
            return false; 
        } 
        while (!feof($handle)) { 
            $buffer = fread($handle, $chunksize); 
            print $buffer;
            ob_flush();
            flush();
        } 
        return fclose($handle); 
    }

}