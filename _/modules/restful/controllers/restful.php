<?php

require APPPATH . 'libraries/REST_Controller.php';

class Restful extends REST_Controller {
    public $data;
    public function __construct() {
        parent::__construct();
      //  $this->load->database();
       // $this->load->library('database');
        $this->load->library('session');
        $this->load->library('user_agent');
        ob_start(); 
		if(!isset($_SESSION)){
			session_start();
		}
        $this->db = $this->load->database( '', TRUE );
        $this->load->library( 'ion_auth' );
        
        if(isset($_GET['username'])&&isset($_GET['password'])){ 
            $row = $this->db->select('user_id')->where('username',$_GET['username'])->where('password',md5($_GET['password']))->get('login_users')->row_array();
           // print_R($row);exit;
            if(isset($row['user_id'])){
                $this->session->set_userdata_vnefrc('user_id', $row['user_id']);
            }else{
                $this->session->unset_userdata_vnefrc('user_id');
            }    
        }else{
            //print_R($_SESSION['imsrt']['username']);exit;
            if(isset($_SESSION['imsrt']['user_id'])){
    			$this->session->set_userdata_vnefrc('user_id', $_SESSION['imsrt']['user_id']);
    		}
    		else {
    			$this->session->unset_userdata_vnefrc('user_id');
    		}
            
        }
        //exit;
        if(!$this->session->userdata_vnefrc('user_id')){
           $this->session->set_userdata_vnefrc('url_login', current_url());
           $this->session->set_userdata_vnefrc('module_login', 'welcome');
           redirect( 'start', 'refresh' );	
        }
    }

    public function index_get() {
        $this->load->model('admin/Service_model', 'service_model');
        $this->data['list_service'] = $this->session->userdata_vnefrc('services');
        $this->template->set_template( 'restful' );
        $this->template->write( 'title', 'web services' );
        $this->template->write_view('content', 'index/list', $this->data);
        $this->template->render();
    }
//
    public function table_get( $table = '' ) {
	
       $data = array();
       $this->db = $this->load->database( '', TRUE );
       // print_r($table);exit;
       $perpage =$this->db->query( "select `value` FROM setting_rt WHERE `key`='webservice_perpage';" )->row_array();
	   
	   $where = "where 1=1 ";
       $where .= isset($_GET['idx_code']) ? ' AND idx_code = "'.$_GET['idx_code'].'"' : '';
	   $where .= isset($_GET['date']) ? ' AND date = "'.$_GET['date'].'"' : '';
	   
       $limit = isset($_GET['page']) ? ' Limit '.(($_GET['page']-1)*$perpage['value']).','.$perpage['value'] : '';
	   
       if($limit==''){
		   $id = $this->session->userdata_vnefrc('user_id');
		   $get_limit = $this->db->query( "select webservice_nrg FROM login_users WHERE `user_id`= $id" )->row_array();
	
		   if(isset($get_limit['webservice_nrg'])){
			   $get_rgt = $this->db->query( "select * FROM idx_webservice_rgt WHERE `nrg`= $get_limit[webservice_nrg]" )->row_array();
			   $date_current = date("Y/m/d");
			   $data_past = date("Y/m/d",strtotime($get_rgt['limitfd']));
			   $where .="AND date between '$data_past' AND '$date_current'";
			  
			   if($get_rgt['recordfd'] == 'all'){
					  $limit =''; 
				}else{
					$limit =  "LIMIT ".$get_rgt['recordfd']; 
				}
		   }
           
       }
	   
	   
	   
	   
       // $start=($_GET['page']-1)*100;
       // $limit = "Limit "
        if ( $table != '' && $table != 'format' ) {
            $fields = $this->db->query( "select DISTINCT `field` FROM idx_webservice_feed WHERE `table`='{$table}'" )->result_array();
				
            if ( isset( $fields ) ) {
                $field = "`";
                $arra = explode(', ',$fields[0]['field']);
                foreach ( $arra as $key => $value ) {
                    $field.= $value . "`,`";
                }
                $field = substr( $field, 0, -2 );
                
            }else{
                $fields = $this->db->query( "SHOW COLUMNS FROM {$table};" )->result_array();
                $field = "`";
                foreach ( $fields as $key => $value ) {
                    $field.= $value['Field'] . "`,`";
                }
                $field = substr( $field, 0, -2 );
              //  $data = $this->db->query( "select {$field} from {$table}" )->result_array();
                //print_r($data);exit;
            }
			
            $data = $this->db->query( "select {$field} from {$table} $where $limit;" )->result_array();
			
        } else {
            $data = $this->db->query( 'select * from setting' )->result_array();
        }
        if ( $data ) {
            $this->response( $data );
        } else {
            $this->response( NULL, 404 );
        }
    }
//
//    public function index_post() {
//
//    }

}
