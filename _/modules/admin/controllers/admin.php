<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* * *******************************************************************************************************************
 * Client  Name ：  IFRC
 * ---------------------------------------------------------------------------------------------------------------------
 * Project Name ：  IMS v3.0
 * ---------------------------------------------------------------------------------------------------------------------
 * File Name    ：  admin.php 
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
 * Version V001 ：  2012.08.14 (LongNguyen)        New Create 
 * ******************************************************************************************************************* */

class Admin extends MY_Controller {

    protected $data;
    protected $_host = '\\\LOCAL\\';

    function __construct() {
        parent::__construct();
        $this->load->library('user_agent');
        $this->load->library('ion_auth');
        if (!$this->ion_auth->logged_in()) {
            $this->session->set_userdata_vnefrc('url_login', current_url());
            $this->session->set_userdata_vnefrc('module_login', 'admin');
            redirect('auth/login', 'refresh');
        } elseif (!$this->ion_auth->is_admin()) {
            redirect($this->config->item('base_url'), 'refresh');
        }
        $this->load->model('Language_model', 'language_model');

        $where = array('status' => 1);
		
        $langList = $this->language_model->find(NULL, $where);
        if (is_array($langList) == TRUE && count($langList) > 0) {
            foreach ($langList as $value) {
                $this->data->list_language[$value['code']] = $value;
            }
            $this->data->default_language = $langList[0];
        }
        unset($langList);
        $this->session->set_userdata_vnefrc('default_language', $this->data->default_language);
        if (!$this->session->userdata_vnefrc('curent_language')) {
            $this->session->set_userdata_vnefrc('curent_language', $this->data->default_language);
        }
        $this->data->listServicesUser = FALSE;
        $user_id = $this->session->userdata_vnefrc('user_id');

        if ($user_id != FALSE) {
            $this->load->model('Group_model', 'group_model');
            $this->load->model('Services_model', 'services_model');
            $group_id = $this->group_model->get_user_group($user_id);
            $this->data->listServicesUser = $this->services_model->get_service_info('user', $user_id);
            if (!is_array($this->data->listServicesUser) || count($this->data->listServicesUser) == 0) {
                $this->data->listServicesUser = $this->services_model->get_service_info('group', $group_id->group_id);
            }
        }
        $this->data->curent_language = $this->session->userdata_vnefrc('curent_language');
        $this->data->user_service = $this->session->userdata_vnefrc('services');
        $this->data->setting = $this->registry->setting;
        $this->template->set_template('admin');
    }

    /*     * ***********************************************************************************************************
     * Name         ： index
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
     * M001         ： New  2012.08.14 (LongNguyen)  
     * *************************************************************************************************************** */

    public function index() {
        $this->template->write_view('content', 'dashboard');
        $this->template->write('title', 'Admin Panel ');
        $this->template->render();
    }

    /*     * ***********************************************************************************************************
     * Name         ： _thumb
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
     * M001         ： New  2012.08.14 (LongNguyen)  
     * *************************************************************************************************************** */

    public function _thumb(&$image = NULL) {
        $thumb = 'assets/upload/images/no-image.jpg';
        if ($image == NULL) {
            $image = $thumb;
            return $thumb;
        }
        if (isset($image) == TRUE && $image != '') {
            image_thumb($image, 100, 75);
        }
        return $image;
    }

    /*     * ***********************************************************************************************************
     * Name         ： access_denied
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
     * M001         ： New  2012.08.14 (LongNguyen)  
     * *************************************************************************************************************** */

    public function access_denied() {
        $data->message = $this->session->userdata_vnefrc('access');
        $this->template->write_view('content', 'access_denied', $data);
        $this->template->write('title', 'Admin Panel ');
        $this->template->render();
        return;
    }

}