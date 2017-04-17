<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product_model extends CI_Model {

    public $products_ref = 'products_ref';
    public $products_images = 'products_images';
    public $products_contents = 'products_contents';
    public $contents_ref = 'contents_ref';

    function __construct() {
        parent::__construct();
    }

    public function find() {
        $sql = "SELECT {$this->products_ref}.name, {$this->products_ref}.intro, {$this->products_ref}.type,
                {$this->products_images}.image
                FROM {$this->products_ref}, {$this->products_images}
                WHERE {$this->products_ref}.reference = {$this->products_images}.reference;";
        return $this->db->query($sql)->result_array();
    }

}
