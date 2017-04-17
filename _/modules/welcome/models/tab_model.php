<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tab_model extends CI_Model {

    var $table_sys_format = 'sys_format';
    var $table_sys_tab = 'efrc_summary';

    function __construct() {
        parent::__construct();
    }

    function get_headers ($table='',$field='') {
        return $this->db->select('*')
            ->from($this->table_sys_format)
            ->where_in('table', array($table))
			->where('active', 1)
			->order_by("order","asc")
            ->get()->result_array();
    }
	function get_tab ($tab='') {
		$sql = "select *
                from $this->table_sys_tab 
                where tab = '$tab' and user_level <=".$this->session->userdata_vnefrc('user_level');
		 return $this->db->query($sql)->row_array();
        
    }
	function get_config ($code='') {
		$sql = "select value
                from efrc_config 
                where code = '$code'";
		 return  $this->db->query($sql)->row_array();
        
    }
    function append_input($field = '', $value_filter='') {
        if($field == '') {
            return '';
        } else {
			if($value_filter!='')
            return '<input type="text" id="'.strtolower($field).'" name="'.strtolower($field).'" placeholder="Search..." class="form-control form-filter input-sm" autocomplete="off" value="'.$value_filter.'"/>';
			else
			return '<input type="text" id="'.strtolower($field).'" name="'.strtolower($field).'" placeholder="Search..." class="form-control form-filter input-sm" autocomplete="off" />';
			
        }
    }
    public function tab_type($table){
        $sql = "SHOW COLUMNS FROM {$table};";  
        return $this->db->query($sql)->result_array(); 
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
	 function append_range($field = '') {
        if($field == '') {
            return '';
        } else {
            $html = '<div class="margin-bottom-5">';
			$html .='<input type="text" placeholder="From" name="'.strtolower($field).'_from" class="form-control form-filter input-sm">';
            $html .= '</div>';
			$html .= '<input type="text" placeholder="To" name="'.strtolower($field).'_to" class="form-control form-filter input-sm">';
            return $html;
        }
    }

    function append_select($field = '',$arr ='', $value_filter='') {
		//ini_set("memory_limit","200M");
        if($field == '') {
            return '';
        } else {
            $html = '<select id="'.$field.'" name="'.$field.'" class="form-control form-filter input-sm" autocomplete="off">';
            $html .= '<option value="all">All</option>';
            $list_data = $this->db->query("select `$field` from $arr group by `$field` order by `$field` asc;")->result_array();
            foreach ($list_data as $item) {
				if($value_filter!='' && ($item[$field]==$value_filter))
                $html .= '<option value="'.$item[$field].'" selected="selected">'.$item[$field].'</option>';
				else 
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
    
    
    function append_textarea_editon($field = '', $value = '', $readonly= '',$primary=0) {
        if($field == '') {
            return '';
        } else {
            $read = $readonly == '1' ? 'readonly="readonly"' : '' ;
			$strPrimary = $primary == '1' ? 'data-required="1" ' : '' ;
            return '<textarea type="text" id="'.strtolower($field).'" '.$read.$strPrimary.' name="'.strtolower($field).'" style="overflow:auto;resize:none" rows="'.round(strlen($value)/64).'" class="form-control form-filter input-sm" autocomplete="off">'.$value.'</textarea>';
        }
    }
    
    function append_select_editon($field = '',$arr='', $value ='', $readonly = '',$primary=0) {
        if($field == '') {
            return '';
        } else {
            $read = $readonly == '1' ? ' disabled' : '' ;
			$strPrimary = $primary == '1' ? 'data-required="1" ': '' ;
            $html = '<select '.$read.' id="'.$field.'" name="'.$field.'" class="form-control form-filter input-sm" autocomplete="off">';
            $html .= '<option value="other_value">Other</option>';
            $list_data = $this->db->query("select `$field` from $arr group by `$field` order by `$field` asc;")->result_array();
            foreach ($list_data as $item) {
                $select = $item[$field] == $value ? ' selected="selected"' : '';
                $html .= '<option value="'.$item[$field].$select.'">'.$item[$field].'</option>';
            }
            $html .= '</select>';
            return $html;
        }
    }														
															
    function append_date_editon($field = '',$value ='') {
        if($field == '') {
            return '';
        } else {
            $html = '<div data-date-start-date="+0d" data-date-format="dd-mm-yyyy" class="input-group input-medium date date-picker">';
            $html .= '<input type="text" id="'.strtolower($field).'" class="form-control input-sm date-picker" readonly="" name="'.strtolower($field).'" value="'.$value.'">';
          //  $html .= '<input type="text" _start" name="'.strtolower($field).'" placeholder="Choose..." class="form-control form-filter input-sm date-picker" data-date-format="yyyy-mm-dd" autocomplete="off">';
            $html .= '<span class="input-group-btn">';
            $html .= '<button type="button" class="btn default"><i class="fa fa-calendar"></i></button>';
            $html .= '</span>';
            $html .= '</div>';
            $html .= '<span class="help-block"></span>';
            return $html;
        }
    }

}