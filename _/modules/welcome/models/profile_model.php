<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Profile_model extends CI_Model {

    var $table_user_info = 'user_info';
    var $table_office_ref = 'office_ref';
    var $table_level_ref = 'level_ref';
    function __construct() {
        parent::__construct();
    }

    function get_detail_user($id_user) {
        $sql = "select dui.*, dor.department, dor.service, dlr.description, u.avatar
                from $this->table_user_info dui
                left join $this->table_office_ref dor
                on dor.id_office = dui.id_office
                left join user u
                on dui.id_user = u.id
                left join $this->table_level_ref dlr
                on dlr.id_office = dui.id_office and dlr.level = dui.id_level
                where dui.id_user = '$id_user';";
        return $this->db->query($sql)->row_array();
    }
    function get_profile(){
        $lang = $this->session->userdata_vnefrc('curent_language');
        $id = $this->session->userdata_vnefrc('user_id');
        $data = $this->db->where('id_user', $id)->where('lan', $lang['code'])->get('user_profile')->result_array();
        $result = array();
        foreach($data as $value){
            $result[strtolower($value['info'])] = $value['profile'];
        }
        return $result;
    }
    function update_profile($name, $id, $value, $table){
        if($table == 'user_info'){
            if (self::_check_exist($table, $id) == FALSE) {
                $data = array(
                    'id_user' => $id,
                    "$name" => $value
                );
                $this->db->insert($table, $data);
            } else {
               $data = array(
                    "$name" => $value
                );
                $this->db->where('id_user', $id);
                $this->db->update($table, $data);
            }
        }else if($table == 'user'){
             if (self::_check_exist($table, $id) == FALSE) {
                $data = array(
                    'id' => $id,
                    "$name" => $value
                );
                $this->db->insert($table, $data);
            } else {
               $data = array(
                    "$name" => $value
                );
                $this->db->where('id', $id);
                $this->db->update($table, $data);
            }
        }else {
             $lang = $this->session->userdata_vnefrc('curent_language');
             if (self::_check_exist($table, $id, $name, $lang['code']) == TRUE) {
                
                $data = array(
                    'profile' => $value
                );
                $this->db->where('lan', $lang['code']);
                $this->db->where('id_user', $id);
                $this->db->where('info', strtoupper($name));
                $this->db->update($table, $data);
            }else{
                //$lang = $this->session->userdata_vnefrc('curent_language');
                $data = array(
                    'id_user' => $this->session->userdata_vnefrc('user_id'),
                    'lan' => strtoupper($lang['code']),
                    'info' => strtoupper($name),
                    'profile' => $value,
                    'date_update' => date('Y-m-d h:i:s')
                );
                $this->db->insert($table, $data);
            } 
        }
        return $value;
    }
    function _check_exist($table = '', $id ='', $field='',$lang=''){
        if (!is_numeric($id)) {
            return FALSE;
        }
        if($table == 'user_info'){
            $this->db->where('id_user', $id);
            $query = $this->db->get($table);
        }else if($table == 'user'){
            $this->db->where('id', $id);
            $query = $this->db->get($table);
        }else {
           $query = $this->db->where('id_user', $id)->where('info', strtoupper($field))->where('lan', $lang)->get($table);
        }
        if ($query->num_rows() > 0)
            return TRUE;
        else
            return FALSE;
    }
    

}