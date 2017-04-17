<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/* * ****************************************************************** */
/*     Client  Name  :  IFRC                                      */
/*     Project Name  :  cms v3.0                                     */
/*     Program Name  :  translate.php                                */
/*     Entry Server  :                                               */
/*     Called By     :  System                                       */
/*     Notice        :  File Code is utf-8                           */
/*     Copyright     :  IFRC                                         */
/* ------------------------------------------------------------------- */
/*     Comment       :  controller translate                             */
/* ------------------------------------------------------------------- */
/*     History       :                                               */
/* ------------------------------------------------------------------- */
/*     Version V001  :  2012.08.14 (Tung)        New Create      */
/* * ****************************************************************** */

class translate extends Admin {

    protected $data;

    function __construct() {
        parent::__construct();
        $this->load->model('Translate_model', 'translate');
        $this->load->helper('my_helper', 'form');
        $this->load->library('form_validation');
    }

    /*     * ************************************************************** */
    /*    Name ： index                                                */
    /* --------------------------------------------------------------- */
    /*    Description  ：  this function will be called automatically  */
    /*                   when the controller is called               */
    /* --------------------------------------------------------------- */
    /*    Params  ：  None                                             */
    /* --------------------------------------------------------------- */
    /*    Return  ：                                                 */
    /* --------------------------------------------------------------- */
    /*    Warning ：                                                  */
    /* --------------------------------------------------------------- */
    /*    Copyright : IFRC                                         */
    /* --------------------------------------------------------------- */
    /*    M001 : New  2012.08.14 (Tung)                            */
    /*     * ************************************************************** */

    function index() {
        $this->data->title = 'List translate';
        //$this->translate->check_word('Hello', 'en');
        $this->template->write_view('content', 'translate/translate_list', $this->data);
        $this->template->write('title', 'Translates ');
        $this->template->render();
    }

    /*     * ************************************************************** */
    /*    Name ： add                                                */
    /* --------------------------------------------------------------- */
    /*    Description  ： add new translate                             */
    /* --------------------------------------------------------------- */
    /*    Params  ：  None                                             */
    /* --------------------------------------------------------------- */
    /*    Return  ：   redirect backend/category when add category success  */
    /* --------------------------------------------------------------- */
    /*    Warning ：                                                     */
    /* --------------------------------------------------------------- */
    /*    Copyright : IFRC                                         */
    /* --------------------------------------------------------------- */
    /*    M001 : New  2012.08.14 (Tung)                             */
    /*     * ************************************************************** */

    function listdata() {
        if ($this->input->is_ajax_request()) {
            $this->data->list_translate = $this->translate->list_translate();
            if (is_array($this->data->list_translate)) {
                $aaData = array();
                $stt = 0;
                foreach ($this->data->list_translate as $key => $value) {
                    $aaData[$key][] = ++$stt;
                    $aaData[$key][] = cut_str($value['word'], 30, ' [...]');
                    foreach ($this->data->list_language as $v) {
                        if(isset($value['translate'][$v['code']])) {
                            $aaData[$key][] = cut_str(@$value['translate'][$v['code']], 30, ' [...]');
                        } else {
                            $aaData[$key][] = "";
                        }
                    }
                    $aaData[$key][] = '<ul class="keywords" style="text-align:center;"><li class="green-keyword"><a title="" class="with-tip" href="' . admin_url() . 'translate/edit/' . $value['word'] . '">' . trans('bt_edit', 1) . '</a></li>
                                   <li class="red_fx_keyword"><a title="" class="with-tip action-delete " translate_word="' . $value['word'] . '" href="javascript: void(0);">' . trans('bt_delete', 1) . '</a></li></ul>';
                }
                $output = array(
                    "aaData" => $aaData
                );
                $this->output->set_output(json_encode($output));
            }
        }
    }

    function add() {
        $this->data->input = $this->input->post();
        $translate = NULL;
        $this->data->title = 'Translate - Add new';
        // set rule validate
        $this->form_validation->set_rules('word', 'Word', 'required');
        // run validate
        if ($this->form_validation->run() == FALSE) {
            $this->data->error = validation_errors();
        } else {
            foreach ($this->data->input['translate'] as $key => $item) {
                $input['word'] = utf8_convert_url($this->data->input['word'], '_');
                $input['lang_code'] = $key;
                $input['translate'] = $item;
                if ($this->translate->check_word($this->data->input['word'], $key)) {
                    $this->translate->add_translate($input);
                    $check = true;
                } else {
                    $check = false;
                }
            }
            if ($check == false) {
                $this->data->error = 'This word existed.';
            } else {
                redirect(base_url() . 'backend/translate');
            }
        }


        // load view and set data
        $this->template->write_view('content', 'translate/translate_form', $this->data);
        // set data for title
        $this->template->write('title', 'Add');
        //render template
        $this->template->render();
    }

    /*     * ************************************************************** */
    /*    Name ： edit                                                */
    /* --------------------------------------------------------------- */
    /*    Description  ： edit 1 translate                             */
    /* --------------------------------------------------------------- */
    /*    Params  ：  $word                                            */
    /* --------------------------------------------------------------- */
    /*    Return  ：   redirect backend/category when edit category success  */
    /* --------------------------------------------------------------- */
    /*    Warning ：                                                     */
    /* --------------------------------------------------------------- */
    /*    Copyright : IFRC                                         */
    /* --------------------------------------------------------------- */
    /*    M001 : New  2012.08.14 (Tung)                             */
    /*     * ************************************************************** */

    function edit($word = "") {
        $this->data->input = $this->translate->find($word);
        $this->data->title = 'Translate - Edit';

        //set rule validate
        $this->form_validation->set_rules('word', 'Word', 'required');
        //run validate
        if ($this->form_validation->run() == FALSE) {
            $this->data->info = $this->translate->find($word);
        } else {
            foreach ($this->input->post('translate') as $key => $item) {
                $input['word'] = utf8_convert_url($this->input->post('word'), '_');
                $input['lang_code'] = $key;
                $input['translate'] = $item;
                if ($this->translate->check_word($this->input->post('word'), $key, $this->data->input['word'])) {
                    $this->translate->update_translate($input, $this->input->post('word'), $key);
                    $check = true;
                } else {
                    $check = false;
                }
            }
            if ($check == false) {
                $this->data->error = 'This word existed.';
            } else {
                redirect(base_url() . 'backend/translate');
            }
        }


        $this->template->write_view('content', 'translate/translate_form', $this->data);
        $this->template->write('title', 'Edit');
        $this->template->render();
    }

    /**     * ************************************************************* */
    /*    Name ： delete                                                */
    /* --------------------------------------------------------------- */
    /*    Description  ： delete 1 translate   call by ajax               */
    /* --------------------------------------------------------------- */
    /*    Params  ：  $_POST id                                             */
    /* --------------------------------------------------------------- */
    /*    Return  ：   return 0 when delete false return 1 when delete success  */
    /* --------------------------------------------------------------- */
    /*    Warning ：                                                     */
    /* --------------------------------------------------------------- */
    /*    Copyright : IFRC                                         */
    /* --------------------------------------------------------------- */
    /*    M001 : New  2012.08.14 (LongNguyen)                             */
    /*     * ************************************************************** */

    function delete() {
        $this->output->enable_profiler(FALSE);
        if ($this->input->is_ajax_request()) {
            echo $this->translate->del_translate($this->input->post('word'));
        }
    }

    function getTrans() {
        if ($this->input->is_ajax_request()) {
            $word = $this->input->post('word');
            echo $this->_get($word);
        }
    }
    
    function _get($word = "") {
        $lang_code = $this->session->userdata_vnefrc('curent_language');
        $lang_code_default = $this->session->userdata_vnefrc('default_language');
        $lang_code_default = $lang_code_default['code'];
        $lang_code = $lang_code['code'];
        $this->db->where('word', $word);
        $query = $this->db->get('translate');
        $translate = $query->result();
        $t = array();
        if ($translate) {
            foreach ($translate as $key => $value) {
                $t[$value->lang_code] = $value->translate;
            }
            if (isset($t[$lang_code]) == TRUE && $t[$lang_code] != '') {
                return $t[$lang_code];
            } elseif (isset($t[$lang_code_default]) == TRUE && $t[$lang_code_default] != '') {
                return $t[$lang_code_default];
            } else {
                return $word;
            }
        }
        return $word;
    }

}