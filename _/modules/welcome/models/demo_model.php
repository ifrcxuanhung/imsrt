<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class demo_model extends CI_Model {

   // var $table = 'efrc_publications';
    var $table_sys_format = 'demo_sys_format';
    var $table_summary = 'efrc_summary';
	var $table_summary_demo = 'efrc_demo_summary';

    function __construct() {
        parent::__construct();
    }

    function append_select_filter($select_id = 'converage', $data = 'converage', $table = 'publication', $value_selected = 'all') {
        $html = '<select id="'.$select_id.'" name="'.$select_id.'" class="form-control form-filter input-sm" autocomplete="off">';
        $html .= '<option value="all"'.($value_selected == 'all' ? ' selected="selected"' : '').'>'.trans('all',TRUE).'</option>';      
        $sql = "Select `{$data}` FROM {$table} jrn Group by `{$data}`;";
        $list_data = $this->db->query($sql)->result_array();
        
        foreach ($list_data as $item) {
            if(is_numeric($item[$data])) {
                $html .= '<option value="'.$data.'_'.$item[$data].'"'.($value_selected == $item[$data] ? ' selected="selected"' : '').'>'.$item[$data].'</option>';
            } else {                       
                $html .= '<option value="'.$item[$data].'"'.($value_selected == $item[$data] ? ' selected="selected"' : '').'>'.$item[$data].'</option>';
            }
        }
        return $html;
    }
    function get_headers ($table='',$field='') {
        return $this->db->select('*')
            ->from($this->table_sys_format)
            ->where_in('table', array($table))
			->order_by("order","asc")
            ->get()->result_array();
    }
     function get_table_summary_demo () {
        return $this->db->select('*')
            ->from($this->table_summary_demo)
            ->where('active', 1)
            ->get()->result_array();
    }
    function load_information () {
        return $this->db->select('*')
            ->from('efrc_demo_step')
			->order_by("step","asc")
            ->get()->result_array();
    }
    
    function get_headers_temp ($table='',$field='') {
        return $this->db->select('keys')
            ->from($this->table_summary)
            ->where_in('table_name', array($table))
            ->get()->result_array();
    }
    function append_date($field = '') {
        if($field == '') {
            return '';
        } else {
            $html = '<div class="input-group date date-picker margin-bottom-5">';
            $html .= '<input type="text" id="'.strtolower($field).'_start" name="'.strtolower($field).'_start" placeholder="Choose..." class="form-control form-filter input-sm date-picker" data-date-format="yyyy-mm-dd" autocomplete="off">';
            $html .= '<span class="input-group-btn">';
            $html .= '<button class="btn btn-icon-only default" type="button"><i class="fa fa-calendar"></i></button>';
            $html .= '</span>';
            $html .= '</div>';
            $html .= '<div class="input-group date date-picker">';
            $html .= '<input type="text" id="'.strtolower($field).'_end" name="'.strtolower($field).'_end" placeholder="Choose..." class="form-control form-filter input-sm date-picker" data-date-format="yyyy-mm-dd" autocomplete="off">';
            $html .= '<span class="input-group-btn">';
            $html .= '<button class="btn btn-icon-only default" type="button"><i class="fa fa-calendar"></i></button>';
            $html .= '</span>';
            $html .= '</div>';
            return $html;
        }
    }

    function append_select($field = '',$arr='') {
        if($field == '') {
            return '';
        } else {
            $html = '<select id="'.$field.'" name="'.$field.'" class="form-control form-filter input-sm" autocomplete="off">';
            $html .= '<option value="all">All</option>';
            $list_data = $this->db->query("select `$field` from $arr group by `$field` order by `$field` asc;")->result_array();
            foreach ($list_data as $item) {
                $html .= '<option value="'.$item[$field].'">'.$item[$field].'</option>';
            }
            $html .= '</select>';
            return $html;
        }
    }
    
    function append_input_number($field = '', $value = '', $readonly = '',$primary=0) {
        if($field == '') {
            return '';
        } else {
            $read = $readonly == '1' ? 'readonly="readonly"' : '' ;
			$strPrimary = $primary == '1' ? 'data-required="1" ' : '' ;
            return '<input type="text" id="'.strtolower($field).'" '.$read.$strPrimary.' name="'.strtolower($field).'" value="'.$value.'" class="form-control form-filter input-sm input_number" autocomplete="off"/>';
        }
    }
	function append_input_text($field = '', $value = '', $readonly = '',$primary=0) {
        if($field == '') {
            return '';
        } else {
            $read = $readonly == '1' ? 'readonly="readonly"' : '' ;
			$strPrimary = $primary == '1' ? 'data-required="1" ' : '' ;
            return '<input type="text" id="'.strtolower($field).'" '.$read.$strPrimary.' name="'.strtolower($field).'" value="'.$value.'" class="form-control form-filter input-sm" autocomplete="off"/>';
        }
    }
}