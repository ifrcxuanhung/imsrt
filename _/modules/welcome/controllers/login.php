<?php
class Login extends Welcome{
    public function __construct() {
        parent::__construct();
        if ($this->ion_auth->logged_in()) {
            redirect(base_url());
        }
        $this->load->library('form_validation');
    }
    
    public function index() {
    	$this->data->identity = array('name' => 'username',
            'id' => 'username',
            'type' => 'text',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('username'),
        );
        $this->data->password = array('name' => 'password',
            'id' => 'pass',
            'type' => 'password',
            'class' => 'form-control'
        );
        $this->data->message = '';
        $this->template->write_view('content', 'login', $this->data);
        $this->template->render();
    }
    function login_modal() {
        $this->data->identity = array('name' => 'username',
            'id' => 'username',
            'type' => 'text',
            'class' => 'form-control',
			'tabindex'=>'1',
            'value' => $this->form_validation->set_value('username'),
        );
        $this->data->password = array('name' => 'password',
            'id' => 'password',
            'type' => 'password',
            'class' => 'form-control',
			'tabindex'=>'2',
        );
        $this->data->message = '';
        $this->data->current_url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $this->load->view('login_modal', $this->data);
    }
    
}
