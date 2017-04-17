<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/* * *******************************************************************************************************************
 * Client  Name ：  IFRC
 * ---------------------------------------------------------------------------------------------------------------------
 * Project Name ：  IMS v3.0
 * ---------------------------------------------------------------------------------------------------------------------
 * File Name    ：  group_model.php
 * ---------------------------------------------------------------------------------------------------------------------
 * Entry Server ：
 * ---------------------------------------------------------------------------------------------------------------------
 * Called By    ：  System
 * ---------------------------------------------------------------------------------------------------------------------
 * Notice       ：
 * ---------------------------------------------------------------------------------------------------------------------
 * Copyright    ：  IFRC
 * ---------------------------------------------------------------------------------------------------------------------
 * Comment      ：  
 * ---------------------------------------------------------------------------------------------------------------------
 * History      ：
 * ---------------------------------------------------------------------------------------------------------------------
 * Version V001 ：  2013.06.24 (LongNguyen)        New Create 
 * ******************************************************************************************************************* */
class Group_model extends CI_Model {

    var $table = 'group';

    function __construct() {
        parent::__construct();
    }
    /*     * ***********************************************************************************************************
     * Name         ： find
     * -----------------------------------------------------------------------------------------------------------------
     * Description  ：
     * -----------------------------------------------------------------------------------------------------------------
     * Params       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Return       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Warning      ：
     * -----------------------------------------------------------------------------------------------------------------
     * Copyright    ： IFRC
     * -----------------------------------------------------------------------------------------------------------------
     * M001         ： 
     * *************************************************************************************************************** */
    public function find($id = NULL) {
        if (is_numeric($id)) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get($this->table);
        return $query->result_array();
    }
    /*     * ***********************************************************************************************************
     * Name         ： add
     * -----------------------------------------------------------------------------------------------------------------
     * Description  ：
     * -----------------------------------------------------------------------------------------------------------------
     * Params       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Return       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Warning      ：
     * -----------------------------------------------------------------------------------------------------------------
     * Copyright    ： IFRC
     * -----------------------------------------------------------------------------------------------------------------
     * M001         ： 
     * *************************************************************************************************************** */
    public function add($data = NULL) {
        if($this->db->insert($this->table, $data)){
            return $this->db->insert_id();
        }
        return FALSE;
    }
    /*     * ***********************************************************************************************************
     * Name         ： update
     * -----------------------------------------------------------------------------------------------------------------
     * Description  ：
     * -----------------------------------------------------------------------------------------------------------------
     * Params       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Return       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Warning      ：
     * -----------------------------------------------------------------------------------------------------------------
     * Copyright    ： IFRC
     * -----------------------------------------------------------------------------------------------------------------
     * M001         ： 
     * *************************************************************************************************************** */
    public function update($data = NULL, $id = NULL) {
        if (!is_numeric($id)) {
            return FALSE;
        }
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }
    /*     * ***********************************************************************************************************
     * Name         ： update_service_info
     * -----------------------------------------------------------------------------------------------------------------
     * Description  ：
     * -----------------------------------------------------------------------------------------------------------------
     * Params       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Return       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Warning      ：
     * -----------------------------------------------------------------------------------------------------------------
     * Copyright    ： IFRC
     * -----------------------------------------------------------------------------------------------------------------
     * M001         ： 
     * *************************************************************************************************************** */
    public function update_service_info($data = NULL, $code = NULL) {
            $this->db->where('services_code', $code);
            $this->db->where('type', 'group');
            $this->db->where('bind', $data['bind']);
            $this->db->where('right', $data['right']);
            $this->db->delete('services_info');
        if(isset($data['active']) && $data['active']==1){
            return $this->db->insert('services_info', $data);
        }
        return FALSE;
    }
    /*     * ***********************************************************************************************************
     * Name         ： delete
     * -----------------------------------------------------------------------------------------------------------------
     * Description  ：
     * -----------------------------------------------------------------------------------------------------------------
     * Params       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Return       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Warning      ：
     * -----------------------------------------------------------------------------------------------------------------
     * Copyright    ： IFRC
     * -----------------------------------------------------------------------------------------------------------------
     * M001         ： 
     * *************************************************************************************************************** */
    public function delete($id = NULL) {
        if (!is_numeric($id)) {
            return FALSE;
        }
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }
    /*     * ***********************************************************************************************************
     * Name         ： check_name
     * -----------------------------------------------------------------------------------------------------------------
     * Description  ：
     * -----------------------------------------------------------------------------------------------------------------
     * Params       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Return       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Warning      ：
     * -----------------------------------------------------------------------------------------------------------------
     * Copyright    ： IFRC
     * -----------------------------------------------------------------------------------------------------------------
     * M001         ： 
     * *************************************************************************************************************** */
    public function check_name($key = NULL, $id = NULL) {
        if (!is_numeric($id)) {
            return FALSE;
        }
        $this->db->where('name', $key);
        $this->db->where('id !=', $id);
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0)
            return FALSE;
        else
            return TRUE;
    }
    /*     * ***********************************************************************************************************
     * Name         ： get_user_group
     * -----------------------------------------------------------------------------------------------------------------
     * Description  ：
     * -----------------------------------------------------------------------------------------------------------------
     * Params       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Return       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Warning      ：
     * -----------------------------------------------------------------------------------------------------------------
     * Copyright    ： IFRC
     * -----------------------------------------------------------------------------------------------------------------
     * M001         ： 
     * *************************************************************************************************************** */
    public function get_user_group($id = NULL) {
        if (!is_numeric($id)) {
            return FALSE;
        }
        $this->db->where('user_id', $id);
        $data = $this->db->get('user_group');
        return $data->row();
    }

}
