<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class publication_model extends CI_Model {

    var $table = 'efrc_publications';
    var $table_sys_format = 'sys_format';
   

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
    function get_headers () {
        return $this->db->select('*')
            ->from($this->table_sys_format)
            ->where('table', $this->table)
            ->get()->result_array();
    }


    function append_input($field = '') {
        if($field == '') {
            return '';
        } else {
            return '<input type="text" id="'.strtolower($field).'" name="'.strtolower($field).'" placeholder="'.trans('search', TRUE).'" class="form-control form-filter input-sm" autocomplete="off"/>';
        }
    }

    function append_date($field = '') {
        if($field == '') {
            return '';
        } else {
            $html = '<div class="input-group date date-picker margin-bottom-5">';
            $html .= '<input type="text" id="'.strtolower($field).'_start" name="'.strtolower($field).'_start" placeholder="'.trans('input', TRUE).'" class="form-control form-filter input-sm date-picker" data-date-format="yyyy-mm-dd" autocomplete="off">';
            $html .= '<span class="input-group-btn">';
            $html .= '<button class="btn btn-icon-only default" type="button"><i class="fa fa-calendar"></i></button>';
            $html .= '</span>';
            $html .= '</div>';
            $html .= '<div class="input-group date date-picker">';
            $html .= '<input type="text" id="'.strtolower($field).'_end" name="'.strtolower($field).'_end" placeholder="'.trans('input', TRUE).'" class="form-control form-filter input-sm date-picker" data-date-format="yyyy-mm-dd" autocomplete="off">';
            $html .= '<span class="input-group-btn">';
            $html .= '<button class="btn btn-icon-only default" type="button"><i class="fa fa-calendar"></i></button>';
            $html .= '</span>';
            $html .= '</div>';
            return $html;
        }
    }

    function append_select($field = '') {
        if($field == '') {
            return '';
        } else {
            $html = '<select id="'.$field.'" name="'.$field.'" class="form-control form-filter input-sm" autocomplete="off">';
            $html .= '<option value="all">'.trans('all', TRUE).'</option>';
            $list_data = $this->db->query("select `$field` from $this->table group by `$field` order by `$field` asc")->result_array();
            foreach ($list_data as $item) {
                $html .= '<option value="'.$item[$field].'">'.$item[$field].'</option>';
            }
            return $html;
        }
    }
    
    
    

}