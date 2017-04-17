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
    	$this->data->identity = array('name' => 'identity',
            'id' => 'login',
            'type' => 'text',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('identity'),
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
}
