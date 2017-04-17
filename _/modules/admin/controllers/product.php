<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product extends Admin {

    protected $data;

    function __construct() {
        parent::__construct();
        // load model product
        $this->load->model('product_model', 'mproduct');
        $this->load->helper(array('my_array_helper', 'form'));
    }

    function index() {
        $this->template->write_view('content', 'product/product_list', $this->data);
        $this->template->write('title', 'Product ');
        $this->template->render();
    }

    function listdata() {
        if ($this->input->is_ajax_request()) {
            $list_product = $this->mproduct->find();

            if (is_array($list_product) && count($list_product) > 0) {
                $aaData = array();
                $stt = 0;
                foreach ($list_product as $key => $value) {
                    $aaData[$key][] = ++$stt;
                    $aaData[$key][] = cut_str($value['name'], 50, ' [...]');
                    $aaData[$key][] = cut_str($value['intro'], 50, ' [...]');
                    $aaData[$key][] = $value['type'];
                    $aaData[$key][] = '<a class="fancybox" style="display: block; width: 35px;" href="' . (isset($value['image']) ? base_url() . str_replace(base_url(), "", $value['image']) : base_url() . 'assets/upload/images/no-image.jpg') . '" title="' . $value['name'] . '">
                                        <img class="thumbnails" src="' . (isset($value['image']) ? base_url() . str_replace(base_url(), "", image_thumb($value['image'], "auto", 175)) : base_url() . 'assets/upload/images/no-image.jpg') . '" /></a>';
                }
                $output = array(
                    "aaData" => $aaData
                );
                $this->output->set_output(json_encode($output));
            }
        }
    }

    function upload_product() {
        if ($this->input->is_ajax_request()) {
            $output = array();
            /* check folder products text exists */
            $dir = "assets/upload/images/products_text/";
            $output = array("err" => "", "folder" => "", "empty" => "");
            if (!is_dir($dir)) {
                $output["err"] = trans("upload", 1) . " " . trans("file", 1) . " " . trans("to", 1) . " " . trans("folder", 1) . ": products_text";
                $output["folder"] = "products_text";
                $output["empty"] = "1";
            } else {
                /* empty products */
                //$this->db->truncate();

                /* import products */
                $list_tables = array("products_contents", "products_images", "products_ref", "contents_ref");
                $fails_import = array();
                foreach ($list_tables as $item) {
                    $fails_import[] = self::_import_by_header("{$dir}{$item}.txt", $item);
                }

                if (!empty($fails_import)) {
                    $output["err"] = implode('<br />', $fails_import);
                }
            }
            $this->output->set_output(json_encode($output));
        }
    }

    function _import_by_header($file_text = "", $table = "", $empty = 1) {
        $fails = trans("error", 1) . " " . trans("upload", 1) . ": {$table}";
        if (is_file($file_text)) {
            if ($empty == 1) {
                $this->db->truncate($table);
            }
            $columns = $this->db->list_fields($table);
            $f = fopen($file_text, 'r');
            $data_import = '';
            $data_tmp = '';
            $headers = '';
            $i = 0;
            while ($data_tmp = fgetcsv($f, 0, "\t")) {
                $arr_check = array_filter($data_tmp);
                if (empty($arr_check)) {
                    continue;
                }
                unset($arr_check);
                $i++;
                if ($i == 1) {
                    $headers = $data_tmp;
                    continue;
                }
                foreach ($headers as $key => $header) {
                    $header = trim(strtolower($header));
                    if (in_array($header, $columns)) {
                        $data_import[$i - 1][$header] = @$data_tmp[$key];
                    }
                }
            }
            unset($data_tmp);
            unset($i);
            /* clean data */
            if (!empty($data_import)) {
                foreach ($data_import as $key => $value) {
                    $data_import[$key] = array_filter($data_import[$key]);
                    $err = $this->db->insert($table, $data_import[$key]);
                    if (!$err) {
                        $fails = $table;
                    } else {
                        $fails = $table . ": " . $this->db->count_all($table) . " (" . trans("rows", 1) . ")";
                    }
                }
                unset($data_import);
            }
        }
        return $fails;
    }

}