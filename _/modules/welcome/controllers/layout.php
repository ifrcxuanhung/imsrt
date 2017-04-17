<?php

class Layout extends Welcome{
    public function __construct() {
        parent::__construct();
        $this->load->model('Setting_model', 'setting');
		$this->load->model('Table__model', 'table');
    }

    public function index()
    {
        
        $this->template->write_view('content', 'layout', $this->data);
        $this->template->render();  
    }
    
    function list_layout() {
        $iDisplayLength = intval($_REQUEST['length']);
        $iDisplayStart = intval($_REQUEST['start']);
        $sEcho = intval($_REQUEST['draw']);
        // select columns
        $where = "where 1=1";
        $aColumns = array('type','gl_ref','gl_data1','gl_data2','gl_data3','gl_data4','gl_summary','gl_other','vn_ref','vn_data1','vn_data2','vn_data3','vn_data4','vn_summary','vn_other');
        $sTable = "(Select * FROM efrc_layout) as sTable";
        
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
        //print_R($data);exit;
        $setting = $this->setting->get_group('layout');
        foreach ($data as $key => $value) {
          
            $records["data"][$key][] = "<div class='title-blue'>".$value['type']."</div>";
			
            $records["data"][$key][] = isset($value['gl_ref'])&&$value['gl_ref']!='' ? "<div class='align-center'><a data-toggle='tooltip' data-placement='top' data-trigger='hover' data-html='true' data-container='body' data-original-title='".$value['gl_ref']."' title='".$value['gl_ref']."' class='btn btn-icon-only blue tooltips align-center'  href='".base_url().$value['gl_ref']."' target='_blank'><i class='".$setting['icon-button']."'></i></a></a>" : '';
            $records["data"][$key][] = isset($value['gl_data1'])&&$value['gl_data1']!='' ? "<div class='align-center'><a data-toggle='tooltip' data-placement='top' data-trigger='hover' data-html='true' data-container='body' data-original-title='".$value['gl_data1']."' title='".$value['gl_data1']."' class='btn btn-icon-only blue tooltips align-center'  href='".base_url().$value['gl_data1']."' target='_blank'><i class='".$setting['icon-button']."'></i></a></a>" : '';
            $records["data"][$key][] = isset($value['gl_data2'])&&$value['gl_data2']!='' ? "<div class='align-center'><a data-toggle='tooltip' data-placement='top' data-trigger='hover' data-html='true' data-container='body' data-original-title='".$value['gl_data2']."' title='".$value['gl_data2']."' class='btn btn-icon-only blue tooltips align-center'  href='".base_url().$value['gl_data2']."' target='_blank'><i class='".$setting['icon-button']."'></i></a></a>" : '';
            $records["data"][$key][] = isset($value['gl_data3'])&&$value['gl_data3']!='' ? "<div class='align-center'><a data-toggle='tooltip' data-placement='top' data-trigger='hover' data-html='true' data-container='body' data-original-title='".$value['gl_data3']."' title='".$value['gl_data3']."' class='btn btn-icon-only blue tooltips align-center'  href='".base_url().$value['gl_data3']."' target='_blank'><i class='".$setting['icon-button']."'></i></a></a>" : '';
            $records["data"][$key][] = isset($value['gl_data4'])&&$value['gl_data4']!='' ? "<div class='align-center'><a data-toggle='tooltip' data-placement='top' data-trigger='hover' data-html='true' data-container='body' data-original-title='".$value['gl_data4']."' title='".$value['gl_data4']."' class='btn btn-icon-only blue tooltips align-center'  href='".base_url().$value['gl_data4']."' target='_blank'><i class='".$setting['icon-button']."'></i></a></a>" : '';
            $records["data"][$key][] = isset($value['gl_summary'])&&$value['gl_summary']!='' ? "<div class='align-center'><a data-toggle='tooltip' data-placement='top' data-trigger='hover' data-html='true' data-container='body' data-original-title='".$value['gl_summary']."' title='".$value['gl_summary']."' class='btn btn-icon-only blue tooltips align-center'  href='".base_url().$value['gl_summary']."' target='_blank'><i class='".$setting['icon-button']."'></i></a></a>" : '';
            $records["data"][$key][] = '';
			$records["data"][$key][] = isset($value['gl_other'])&&$value['gl_other']!='' ? "<div class='align-center'><a data-toggle='tooltip' data-placement='top' data-trigger='hover' data-html='true' data-container='body' data-original-title='".$value['gl_other']."' title='".$value['gl_other']."' class='btn btn-icon-only blue tooltips align-center'  href='".base_url().$value['gl_other']."' target='_blank'><i class='".$setting['icon-button']."'></i></a></a>" : '';
            $records["data"][$key][] = isset($value['vn_ref'])&&$value['vn_ref']!='' ? "<div class='align-center'><a data-toggle='tooltip' data-placement='top' data-trigger='hover' data-html='true' data-container='body' data-original-title='".$value['vn_ref']."' title='".$value['vn_ref']."' class='btn btn-icon-only blue tooltips align-center'  href='".base_url().$value['vn_ref']."' target='_blank'><i class='".$setting['icon-button']."'></i></a></a>" : '';
            $records["data"][$key][] = isset($value['vn_data1'])&&$value['vn_data1']!='' ? "<div class='align-center'><a data-toggle='tooltip' data-placement='top' data-trigger='hover' data-html='true' data-container='body' data-original-title='".$value['vn_data1']."' title='".$value['vn_data1']."' class='btn btn-icon-only blue tooltips align-center'  href='".base_url().$value['vn_data1']."' target='_blank'><i class='".$setting['icon-button']."'></i></a></a>" : '';
            $records["data"][$key][] = isset($value['vn_data2'])&&$value['vn_data2']!='' ? "<div class='align-center'><a data-toggle='tooltip' data-placement='top' data-trigger='hover' data-html='true' data-container='body' data-original-title='".$value['vn_data2']."' title='".$value['vn_data2']."' class='btn btn-icon-only blue tooltips align-center'  href='".base_url().$value['vn_data2']."' target='_blank'><i class='".$setting['icon-button']."'></i></a></a>" : '';
            $records["data"][$key][] = isset($value['vn_data3'])&&$value['vn_data3']!='' ? "<div class='align-center'><a data-toggle='tooltip' data-placement='top' data-trigger='hover' data-html='true' data-container='body' data-original-title='".$value['vn_data3']."' title='".$value['vn_data3']."' class='btn btn-icon-only blue tooltips align-center'  href='".base_url().$value['vn_data3']."' target='_blank'><i class='".$setting['icon-button']."'></i></a></a>" : '';
            $records["data"][$key][] = isset($value['vn_data4'])&&$value['vn_data4']!='' ? "<div class='align-center'><a data-toggle='tooltip' data-placement='top' data-trigger='hover' data-html='true' data-container='body' data-original-title='".$value['vn_data4']."' title='".$value['vn_data4']."' class='btn btn-icon-only blue tooltips align-center'  href='".base_url().$value['vn_data4']."' target='_blank'><i class='".$setting['icon-button']."'></i></a></a>" : '';
            $records["data"][$key][] = isset($value['vn_summary'])&&$value['vn_summary']!='' ? "<div class='align-center'><a data-toggle='tooltip' data-placement='top' data-trigger='hover' data-html='true' data-container='body' data-original-title='".$value['vn_summary']."' title='".$value['vn_summary']."' class='btn btn-icon-only blue tooltips align-center'  href='".base_url().$value['vn_summary']."' target='_blank'><i class='".$setting['icon-button']."'></i></a></a>" : '';
            $records["data"][$key][] = '';
			$records["data"][$key][] = isset($value['vn_other'])&&$value['vn_other']!='' ? "<div class='align-center'><a data-toggle='tooltip' data-placement='top' data-trigger='hover' data-html='true' data-container='body' data-original-title='".$value['vn_other']."' title='".$value['vn_other']."' class='btn btn-icon-only blue tooltips align-center'  href='".base_url().$value['vn_other']."' target='_blank'><i class='".$setting['icon-button']."'></i></a></a>" : '';
            //$records["data"][$key][] = '';
            
        }
           
        

        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iFilteredTotal;
          
        $this->output->set_output(json_encode($records));
    }
   

    
  


}
