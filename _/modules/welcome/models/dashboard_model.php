<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class dashboard_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function get_pre_opening()
    {
        $sql = "SELECT * FROM setting_rt WHERE `key` ='pre_opening'";
        $data = $this->db->query($sql)->row_array();
        return $data;
    }
	function get_pre_closing()
    {
        $sql = "SELECT * FROM setting_rt WHERE `key` ='pre_closing'";
        $data = $this->db->query($sql)->row_array();
        return $data;
    }
	function get_frequency()
    {
        $sql = "SELECT * FROM setting_rt WHERE `key` ='frequency'";
        $data = $this->db->query($sql)->row_array();
        return $data;
    }
	function get_delay_min()
    {
        $sql = "SELECT * FROM setting_rt WHERE `key` ='delay_min'";
        $data = $this->db->query($sql)->row_array();
        return $data;
    }
	function get_start()
    {
        $sql = "SELECT * FROM setting_rt WHERE `key` ='start'";
        $data = $this->db->query($sql)->row_array();
        return $data;
    }
	function get_end()
    {
        $sql = "SELECT * FROM setting_rt WHERE `key` ='end'";
        $data = $this->db->query($sql)->row_array();
        return $data;
    }
	function get_start_1()
    {
        $sql = "SELECT * FROM setting_rt WHERE `key` ='start_1'";
        $data = $this->db->query($sql)->row_array();
        return $data;
    }
	function get_end_1()
    {
        $sql = "SELECT * FROM setting_rt WHERE `key` ='end_1'";
        $data = $this->db->query($sql)->row_array();
        return $data;
    }
	function get_imsrt_status()
    {
        $sql = "SELECT * FROM setting_rt WHERE `key` ='imsrt_status'";
        $data = $this->db->query($sql)->row_array();
        return $data;
    }
	function get_close_status()
    {
        $sql = "SELECT * FROM setting_rt WHERE `key` ='close_status'";
        $data = $this->db->query($sql)->row_array();
        return $data;
    }
	function get_after_close_calculation()
    {
        $sql = "SELECT * FROM setting_rt WHERE `key` ='after_close_calculation'";
        $data = $this->db->query($sql)->row_array();
        return $data;
    }
	function get_feed_advance()
    {
        $sql = "SELECT * FROM setting_rt WHERE `key` ='feed_advance'";
        $data = $this->db->query($sql)->row_array();
        return $data;
    }
	function get_export_file_cronjob()
    {
        $sql = "SELECT * FROM setting_rt WHERE `key` ='export_file_cronjob'";
        $data = $this->db->query($sql)->row_array();
        return $data;
    }
	function get_Auto_Download_Feed()
    {
        $sql = "SELECT * FROM setting_rt WHERE `key` ='auto_download_feed'";
        $data = $this->db->query($sql)->row_array();
        return $data;
    }
	function get_auto_download_feed_frequency()
    {
        $sql = "SELECT * FROM setting_rt WHERE `key` ='auto_download_feed_frequency'";
        $data = $this->db->query($sql)->row_array();
        return $data;
    }
}