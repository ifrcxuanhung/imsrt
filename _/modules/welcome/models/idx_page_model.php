<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* * *******************************************************************************************************************
 * Client  Name ：  IFRC
 * ---------------------------------------------------------------------------------------------------------------------
 * Project Name ：  IMS v3.0
 * ---------------------------------------------------------------------------------------------------------------------
 * File Name    ：  idx_page_model.php 
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
 * Version V003 ：  2013.07.09 (Nguyen Tuan Anh)        Update
 * ******************************************************************************************************************* */

class Idx_page_model extends CI_Model {

    public $idx_ca = "idx_ca";
    public $idx_ref = "idx_ref";
    public $stk_div = "stk_div";
    public $stk_ref = "stk_ref";
    public $idx_composition = "idx_composition";
    public $idx_specs = "idx_specs";
    public $vndb_company = "vndb_company";
    public $formula_ref = "formula_ref";

    public function __construct() {
        parent::__construct();
    }

    /*     * ***********************************************************************************************************
     * Name         ： getIdx
     * -----------------------------------------------------------------------------------------------------------------
     * Description  ：
     * -----------------------------------------------------------------------------------------------------------------
     * Params       ： $idx_code
     * -----------------------------------------------------------------------------------------------------------------
     * Return       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Warning      ：
     * -----------------------------------------------------------------------------------------------------------------
     * Copyright    ： IFRC
     * -----------------------------------------------------------------------------------------------------------------
     * M001         ： Update  2013.07.09 (Nguyen Tuan Anh)
     * *************************************************************************************************************** */

    public function getIdx($idx_code = "") {
        $tables = array($this->idx_ref, $this->idx_ca, $this->idx_composition, $this->idx_specs);
        if (is_array($tables)) {
            foreach ($tables as $table) {
                /* table idx_ref */
                if ($table == $this->idx_ref) {
                    $sql = "SELECT r1.idx_code, r3.name as calcul_types, r1.idx_curr, r1.idx_base, r1.idx_dtbase, r1.idx_type,
                        r1.idx_bbs, r1.idx_mother, r2.idx_name AS idx_name, r1.idx_name AS idx_name2, r1.idx_name_vn
                        FROM {$this->idx_ref} AS r1
                        LEFT JOIN {$this->idx_ref} AS r2
                        ON r1.idx_mother = r2.idx_code
						JOIN {$this->formula_ref} AS r3
                        ON r1.calcul_types = r3.code
                        WHERE r1.idx_code = '{$idx_code}'
                        GROUP BY idx_code;";
                } else {
                    /* table idx_composition */
                    if ($table == $this->idx_composition) {
                        $sql = "SELECT exdate, stk_divnet, stk_divgross, {$this->idx_composition}.stk_code AS code1,
                            {$this->stk_div}.stk_code AS code2, {$this->idx_composition}.stk_name AS name1, {$this->stk_div}.stk_name AS name2,
                            stk_price, stk_shares_idx, stk_capp_idx, stk_float_idx, stk_mcap_idx,stk_dcap_idx, stk_wgt, {$this->stk_ref}.stk_name_sn
                            FROM {$this->idx_composition}
                            LEFT JOIN {$this->stk_div}
                            ON {$this->idx_composition}.stk_code = {$this->stk_div}.stk_code
                            JOIN {$this->stk_ref} 
                            ON {$this->idx_composition}.stk_code = {$this->stk_ref}.stk_code";
                        if (isset($data[$this->idx_ref][0]['idx_mother'])) {
                            $sql .= " WHERE idx_code = '{$data[$this->idx_ref][0]['idx_mother']}'
                                GROUP BY {$this->idx_composition}.stk_code
                                ORDER BY stk_wgt DESC;";
                        } else {
                            return false;
                        }
                    } else if ($table == $this->idx_specs) {
                        /* table idx_specs */
                        $sql = "SELECT *
                                FROM {$this->idx_specs}";
                        if (isset($data[$this->idx_ref][0]['idx_mother'])) {
                            $sql .= " WHERE idx_code = '{$data[$this->idx_ref][0]['idx_mother']}' ";
                        } else {
                            return false;
                        }
                    } else {
                        /* the rest table */
                        $sql = "SELECT *
                                FROM {$table}
                                WHERE idx_code = '{$idx_code}' 
                                GROUP BY stk_code, exdate
                                ORDER BY exdate DESC, stk_code ASC";
                    }
                }
                //print_R($sql);exit;
                $info = $this->db->query($sql)->result_array();
                if (count($info) > 0) {

                    $data[$table] = $info;
                } else {
                    $data[$table] = "";
                }
            }
            return $data;
        }
    }

    /*     * ***********************************************************************************************************
     * Name         ： showLinkedIndex
     * -----------------------------------------------------------------------------------------------------------------
     * Description  ：
     * -----------------------------------------------------------------------------------------------------------------
     * Params       ： $idx_code
     * -----------------------------------------------------------------------------------------------------------------
     * Return       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Warning      ：
     * -----------------------------------------------------------------------------------------------------------------
     * Copyright    ： IFRC
     * -----------------------------------------------------------------------------------------------------------------
     * M002         ： Update  2013.07.09 (Nguyen Tuan Anh)
     * *************************************************************************************************************** */

    public function showLinkedIndex($idx_code = "") {
        $sql = "SELECT `idx_mother`
                FROM {$this->idx_specs}
                WHERE `idx_code` = '{$idx_code}';";
        $rows = $this->db->query($sql)->result_array();
        if (isset($rows[0]['idx_mother']) == TRUE) {
            $this->db->where('LEFT(`idx_mother`, LENGTH(`idx_mother`) - 5) = ', substr($rows[0]['idx_mother'], 0, -5));
            return $this->db->count_all_results($this->idx_ref);
        } else {
            return 0;
        }
    }

    /*     * ***********************************************************************************************************
     * Name         ： findSpecs
     * -----------------------------------------------------------------------------------------------------------------
     * Description  ：
     * -----------------------------------------------------------------------------------------------------------------
     * Params       ： $idx_code
     * -----------------------------------------------------------------------------------------------------------------
     * Return       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Warning      ：
     * -----------------------------------------------------------------------------------------------------------------
     * Copyright    ： IFRC
     * -----------------------------------------------------------------------------------------------------------------
     * M003         ： Update  2013.07.09 (Nguyen Tuan Anh)
     * *************************************************************************************************************** */

    public function findSpecs($idx_code = "") {
        $data = array();
        $this->db->select('idx_code, idx_name');
        $this->db->where('LEFT(idx_mother, LENGTH(idx_mother) - 5) = ', substr($idx_code, 0, -5));
        $rows = $this->db->get($this->idx_ref)->result_array();
        foreach ($rows as $item) {
            $data[] = array($item['idx_code'], $item['idx_name']);
        }
        return $data;
    }

    /*     * ***********************************************************************************************************
     * Name         ： get_stk_div
     * -----------------------------------------------------------------------------------------------------------------
     * Description  ：
     * -----------------------------------------------------------------------------------------------------------------
     * Params       ： $idx_code
     * -----------------------------------------------------------------------------------------------------------------
     * Return       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Warning      ：
     * -----------------------------------------------------------------------------------------------------------------
     * Copyright    ： IFRC
     * -----------------------------------------------------------------------------------------------------------------
     * M003         ： Update  2013.07.09 (Nguyen Tuan Anh)
     * *************************************************************************************************************** */

    public function get_stk_div($idx_code = "") {
        $sql = "SELECT {$this->stk_div}.stk_code, {$this->stk_ref}.stk_name_sn, {$this->stk_div}.exdate, {$this->stk_div}.stk_divnet,
                {$this->stk_div}.stk_divgross, {$this->idx_composition}.idx_code
                FROM {$this->stk_div}, {$this->idx_composition}, {$this->stk_ref}, `setting`
                WHERE {$this->stk_div}.stk_code = {$this->idx_composition}.stk_code
                AND {$this->stk_ref}.stk_code = {$this->idx_composition}.stk_code
                AND {$this->idx_composition}.idx_code = '{$idx_code}'
                GROUP BY stk_div.stk_code, stk_div.exdate
                ORDER BY {$this->stk_div}.exdate DESC, {$this->stk_div}.stk_code ASC;";
        return $this->db->query($sql)->result_array();
    }

}