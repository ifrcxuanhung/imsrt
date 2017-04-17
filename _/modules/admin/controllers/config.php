<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Config extends Admin {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('my_array_helper', 'form'));
    }

    function index() {
        $this->data->input = array();
        $a = $this->data->input = $this->db->get('config')->result_array();
        $this->data->input[0]['thumb'] = isset($this->data->input[0]['logo_website']) && $this->data->input[0]['logo_website'] != "" ? image_thumb($this->data->input[0]['logo_website'], 100, 175) : 'assets/images/no-image.jpg';
        $this->template->write_view('content', 'config/config_form', $this->data);
        $this->template->write('title', 'Config ');
        $this->template->render();
    }

    function update() {
        $data = array('title_website' => $_POST['title_website'],
            'logo_website' => str_replace(base_url(), "", $_POST['logo_website']),
            'facebook' => $_POST['facebook'],
            'meta_des' => $_POST['meta_des'],
            'meta_key' => $_POST['meta_key']
            );
        $this->db->truncate('config');
        $this->db->insert('config', $data);
    }

}