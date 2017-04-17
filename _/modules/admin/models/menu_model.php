<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Menu_model extends CI_Model {

    public $table = 'menu';
    public $menu_description = 'menu_description';
    public $_lang;

    function __construct() {
        parent::__construct();
        $this->_lang = $this->session->userdata_vnefrc('curent_language');
    }

    public function listMenu($parentID = null, $stop = "", $data = null, $space = "") {

        if ($parentID)
            $this->db->where('parent_id', $parentID);
        else
            $this->db->where('parent_id', 0);

        if ($stop) {
            $this->db->where($this->table . '.id !=', $stop);
        }
        $this->db->where('lang_code', $this->_lang['code']);
        $this->db->from($this->table);
        $this->db->join($this->menu_description, $this->table . '.id = ' . $this->menu_description . '.id');
        $this->db->order_by('sort_order', 'asc');
        $query = $this->db->get();
		
        $rows = $query->result();
        if ($rows) {
            foreach ($rows as $value) {
                $arr = (object) array();
                $arr->id = $value->id;
                $arr->name = $space . $value->name;
                $arr->sort_order = $value->sort_order;
                $arr->status = $value->status;
                $arr->link = $value->link;
                $arr->image = $value->image;
                $arr->value = $value->value;
                $arr->parent = $value->parent_id;
                $data[] = $arr;
                unset($arr);

                $data = $this->listMenu($value->id, $stop, $data, $space . '... ');
            }
        }
        return $data;
    }

    public function addMenu($data = NULL, $list_language = NULL) {
        if (is_array($data) == TRUE && is_array($list_language) == TRUE) {
            $sortby = $data['sortby'].'.'.$data['sortchange'];
            $value = array(
                'type' => $data['type'],
                'category_id' => isset($data['category_id']) ? $data['category_id'] : '',
                'article_id' => isset($data['article_id']) ? $data['article_id'] : '',
                'page_id' => isset($data['page_id']) ? $data['page_id'] : '',
                'sort_by' => isset($sortby) && $sortby!='.' ? $sortby : '',
               // 'level' => isset($data['level']) ? $data['level'] : ''
                //'check' => $data['fladdate'].'_'.$data['showimage'].'_'.$data['showseemore'].'_'.$data['showLinkWebsite']
            );
            $value = json_encode($value);
            $data_menu = array(
                'image' => isset($data['image']) == TRUE ? $data['image'] : '',
                'sort_order' => $data['sort_order'],
                'parent_id' => $data['parent_id'],
                'status' => isset($data['status']) ? 1 : 0,
                'link' => str_replace(base_url(), '', $data['link']),
                'level' => isset($data['level']) ? $data['level'] : '',
                'value' => $value
            );
            $this->db->trans_begin();
            $this->db->insert($this->table, $data_menu);
            $id = $this->db->insert_id();
            if ($id != FALSE) {
                foreach ($list_language as $value) {
                    $data_menu_description = array(
                        'id' => $id,
                        'lang_code' => $value['code'],
                        'name' => $data['name'][$value['code']],
                        'description' => $data['description'][$value['code']],
						'id_menu' => $data['description'][$value['id_menu']]
                    );
                    $this->db->insert($this->menu_description, $data_menu_description);
                    unset($data_menu_description);
                }
            }
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return FALSE;
            } else {
                $this->db->trans_commit();
            }
            return TRUE;
        }
    }

    function get_one($id = NULL, $lang_code = NULL) {

        if ($id == NULL):
            return FALSE;
        endif;
        $this->db->where('id', $id);
        $query = $this->db->get($this->table);
        $data = $query->result_array();
        $value = $data[0]['value'];
        unset($data[0]['value']);
        $value = json_decode($value);
        if ($value)
            foreach ($value as $key => $item) {
                $data[0][$key] = $item;
            }

        // get description
        $this->db->where('id', $id);
        if ($lang_code != NULL) {
            $this->db->where('lang_code', $lang_code);
        }
        $query_des = $this->db->get($this->menu_description);
        $data['menu_description'] = $query_des->result_array();
        return $data;
    }

    function editMenu($data = NULL, $list_language = NULL, $id = NULL) {
        if (is_array($data) == TRUE && is_array($list_language) == TRUE && is_numeric($id) == TRUE) {
            $sortby = $data['sortby'].'.'.$data['sortchange'];
            $value = array(
                'type' => isset($data['type']) ? $data['type'] : '',
                'category_id' => isset($data['category_id']) ? $data['category_id'] : '',
                'article_id' => isset($data['article_id']) ? $data['article_id'] : '',
                'page_id' => isset($data['page_id']) ? $data['page_id'] : '',
                'sort_by' => isset($sortby) && $sortby!='.' ? $sortby : '',
               // 'level' => isset($data['level']) ? $data['level'] : ''
               // 'check' => $data['fladdate'].'_'.$data['showimage'].'_'.$data['showseemore'].'_'.$data['showLinkWebsite']
            );
            $value = json_encode($value);
            $data_menu = array(
                'image' => isset($data['image']) == TRUE ? $data['image'] : '',
                'sort_order' => $data['sort_order'],
                'parent_id' => $data['parent_id'],
                'status' => isset($data['status']) ? 1 : 0,
                'link' => str_replace(base_url(), '', $data['link']),
                'level' => isset($data['level']) ? $data['level'] : '',
                'value' => $value
            );
            $this->db->trans_begin();
            $this->db->update($this->table, $data_menu, array('id' => $id));
            foreach ($list_language as $value) {
                $data_menu_description = array(
                    'id' => $id,
                    'lang_code' => $value['code'],
                    'name' => $data['name'][$value['code']],
                    'description' => $data['description'][$value['code']],
					'id_menu' => $data['description'][$value['id_menu']]
                );
                if (self::_check_exist($id, $value['code']) == FALSE) {
                    $this->db->insert($this->menu_description, $data_menu_description);
                } else {
                    unset($data_menu_description['id']);
                    $this->db->update($this->menu_description, $data_menu_description, array('id' => $id, 'lang_code' => $value['code']));
                }
                unset($data_menu_description);
            }
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return FALSE;
            } else {
                $this->db->trans_commit();
            }
            return TRUE;
        }
    }

    public function _check_exist($id = NULL, $lang_code = NULL) {
        if (!is_numeric($id)) {
            return FALSE;
        }
        $this->db->where('id', $id);
        if ($lang_code != NULL) {
            $this->db->where('lang_code', $lang_code);
        }
        $query = $this->db->get($this->menu_description);
        if ($query->num_rows() > 0)
            return TRUE;
        else
            return FALSE;
    }

    function delete($id) {
        if ($this->listMenu($id))
            return false;
        else {
            $this->db->where('id', $id);
            $this->db->delete($this->table);
            $this->db->where('id', $id);
            $this->db->delete($this->menu_description);
            return true;
        }
    }

    function update($data, $id) {
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
        return true;
    }
    
    function detect_sort_order() {
        $sql = "SELECT MAX(sort_order) AS sort_order
                FROM {$this->table}
                LIMIT 1;";
        $data = $this->db->query($sql)->result_array();
        return isset($data[0]['sort_order']) ? $data[0]['sort_order'] + 1 : 0;
    }

}