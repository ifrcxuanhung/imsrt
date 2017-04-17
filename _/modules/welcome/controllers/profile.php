<?php
//require('_/modules/welcome/controllers/block.php');

class Profile extends Welcome{
    public function __construct() {
        parent::__construct();
		$this->load->model('Profile_model', 'user');
        $this->load->model('Table__model', 'table');
    }
    
    public function index() {
		 $this->load->library('ion_auth');
		
		$this->data->detail_user = $this->user->get_detail_user($this->session->userdata_vnefrc('user_id'));
        //print_r($this->user->get_detail_user($this->session->userdata_vnefrc('user_id')));exit;
        $this->data->profile_user = $this->user->get_profile();
        $this->template->write_view('content', 'profile/index', $this->data);
        $this->template->render();
    }
    
    
    function upload_image() {
        
        $allowedExts = array("gif", "jpeg", "jpg", "png", "GIF", "JPG", "JPEG", "PNG");
        $temp = explode(".", $_FILES["file"]["name"]);
        $extension = end($temp);

        $respone['error'] = '';
        $respone['success'] = '';
        
        if ($_FILES["file"]["type"] == "image/gif"
        	|| $_FILES["file"]["type"] == "image/jpeg"
        	|| $_FILES["file"]["type"] == "image/jpg"
	        || $_FILES["file"]["type"] == "image/pjpeg"
	        || $_FILES["file"]["type"] == "image/x-png"
	        || $_FILES["file"]["type"] == "image/png"
	        && in_array($extension, $allowedExts)) {
            if ($_FILES["file"]["error"] > 0) {
                $respone['error'] = $_FILES["file"]["error"];
            } else {
            	$path = 'assets/upload/images/';
                $filename = strtolower($extension);
                if(move_uploaded_file($_FILES["file"]["tmp_name"], $path.basename($filename))) {
                //	$this->db->where('id_user', $this->session->userdata_vnefrc('user_id'))
//                		->update('dghq_users', array('images' => $path.$filename));
                    $respone['success'] = $path.$filename;
                } else {
                    $respone['error'] = "Can not upload file";
                }
            }
        } else {
            $respone['error'] = "Invalid file";
        }
        $this->output->set_output(json_encode($respone));
    }
    
    function upload_avatar() {
        $allowedExts = array("gif", "jpeg", "jpg", "png", "GIF", "JPG", "JPEG", "PNG");
        $temp = explode(".", $_FILES["fileavatar"]["name"]);
        $extension = end($temp);

        $respone['error'] = '';
        $respone['success'] = '';
        
        if ($_FILES["fileavatar"]["type"] == "image/gif"
        	|| $_FILES["fileavatar"]["type"] == "image/jpeg"
        	|| $_FILES["fileavatar"]["type"] == "image/jpg"
	        || $_FILES["fileavatar"]["type"] == "image/pjpeg"
	        || $_FILES["fileavatar"]["type"] == "image/x-png"
	        || $_FILES["fileavatar"]["type"] == "image/png"
	        && in_array($extension, $allowedExts)) {
            if ($_FILES["fileavatar"]["error"] > 0) {
                $respone['error'] = $_FILES["fileavatar"]["error"];
            } else {
            	$path = 'assets/upload/avatar/';
                $filename = $this->session->userdata_vnefrc('user_id').'.'.strtolower($extension);
                if(move_uploaded_file($_FILES["fileavatar"]["tmp_name"], $path.basename($filename))) {
                	$this->db->where('id', $this->session->userdata_vnefrc('user_id'))
                		->update('user', array('avatar' => $path.$filename));
                    $respone['success'] = $path.$filename;
                } else {
                    $respone['error'] = "Can not upload file";
                }
            }
        } else {
            $respone['error'] = "Invalid file";
        }
        $this->output->set_output(json_encode($respone));
    }
	
	public function deleteImage(){
		$url = $_POST['attr'];
		$url_image = explode('assets',$url);
		$url_cut_image = "assets".$url_image[1]; 
		$data = array(
               'avatar' => ''
            );

		$this->db->where('avatar', $url_cut_image);
		$this->db->update('user', $data);
		$result = true;
		$this->output->set_output(json_encode($result));
	}
	
    function view_user_home() {
        $sql = "select du.first_name, du.last_name, dui.profile, dui.education, dui.experiences, dui.interests
                from user_info dui, user du
                where dui.id_user = du.id
                and dui.id_user = '".$this->session->userdata_vnefrc('user_id')."';";
        $this->output->set_output(json_encode($this->db->query($sql)->row_array()));
    }
     function view_modal() {
		$this->data->old_email = $this->db->where('id', $this->session->userdata_vnefrc('user_id'))->get('user')->row()->email;
        $this->data->detail_user = $this->user->get_detail_user($this->session->userdata_vnefrc('user_id'));
        $table = isset($_POST['table']) ? $_POST['table'] : "";
        $field = isset($_POST['field']) ? $_POST['field'] : "";
        $type_field = isset($_POST['type_field']) ? $_POST['type_field'] : "";
        $title = isset($_POST['title']) ? $_POST['title'] : "";
		
        if($table == 'user_info'){
            $strvalue = $this->db->where('id_user', $this->session->userdata_vnefrc('user_id'))->get($table)->row_array();
        }else if($table== 'user_profile'){
            $_lang = $this->session->userdata_vnefrc('curent_language');
            $strvalue = $this->db->where('id_user', $this->session->userdata_vnefrc('user_id'))->where('info',strtoupper($field))->where('lan',$_lang['code'])->get('user_profile')->row_array();
            //print_r($this->db->where('id_user', $this->session->userdata_vnefrc('user_id'))->where('info',strtoupper($field))->where('lan',$_lang['code'])->get('user_profile'));exit;
        }else if($table== 'user'){
            $strvalue = $this->db->where('id', $this->session->userdata_vnefrc('user_id'))->get($table)->row_array();
        }
        //print_R($value);exit;
		$html_code ='';
        if (isset($type_field) && (strpos(strtolower($type_field), 'input') !== FALSE)){
            $html_code = $this->table->append_input_editon(strtolower($field),isset($strvalue[$field])? $strvalue[$field] :"", '',0);	   
        }else if (isset($type_field) && (strpos(strtolower($type_field), 'select2') !== FALSE))    
        {
            $html_code = $this->table->append_select2(strtolower($field),$table, '', isset($strvalue[$field])? $strvalue[$field]: "");
        }else if(isset($type_field) && (strpos(strtolower($type_field), 'datetime') !== FALSE))
        {
           $html_code = $this->table->append_date_editon(strtolower($field), isset($strvalue[$field])? $strvalue[$field] :"", '',0);
        }else if(isset($type_field) && (strpos(strtolower($type_field), 'textarea') !== FALSE)){
           $html_code = $this->table->append_textarea_editon(strtolower($field),isset($strvalue['profile'])? $strvalue['profile'] :"",null,5);
        }
        $this->data->html_code = $html_code;
        $this->data->field = $field;
        $this->data->title = $title;
        $this->data->table = $table;
        $this->data->id = $this->session->userdata_vnefrc('user_id');
		
        $this->load->view('profile/'.$this->input->post('modal_type'), $this->data);
    }
    function ajax_update_profile(){
    
        $name = $_POST['field']; 
        $id = $_POST['id'];
        $table = $_POST['table'];
        $value = $_POST['value'];
        $result = $this->user->update_profile($name, $id, $value, $table);
        
        echo json_encode($result); 
    
    }
    function change_password() {
        $respone = 0;
        $old_password = real_escape_string($_POST['old_password']);
        $new_password = real_escape_string($_POST['new_password']);
		$query = $this->db->select('password, salt')
                ->where('id', $this->session->userdata_vnefrc('user_id'))
                ->limit(1)
                ->get('user');

        $hash_password_db = $query->row();

        if ($query->num_rows() !== 1) {
             $respone = 0;
        }else{
        // sha1
			 $salt = substr($hash_password_db->password, 0, 10);
			 $db_password = $salt . substr(sha1($salt . $old_password), 0, -10);
			if($db_password == $hash_password_db->password) {
				if(!empty($new_password)){
					$salt_2 = substr(md5(uniqid(rand(), true)), 0, 10);
					$new_password_db = $salt_2 . substr(sha1($salt_2 . $new_password), 0, -10);
					$count = strlen($new_password);
					$data = array(
						'count_pass'=>$count,
						'password' => $new_password_db,
						'remember_code' => NULL,
					);
					// Count number password
					
					$this->db->where('id', $this->session->userdata_vnefrc('user_id'))
						->update('user', $data);
					$respone = 1;
				}
			}
		}
        $this->output->set_output(json_encode($respone));
    }
    
    
    function change_user_info() {
        $respone = 0;
        $first_name = real_escape_string($_POST['first_name']);
        $last_name = real_escape_string($_POST['last_name']);
        $profile = real_escape_string($_POST['profile']);
        $education = real_escape_string($_POST['education']);
        $experiences = real_escape_string($_POST['experiences']);
        $interests = real_escape_string($_POST['interests']);
        
        $sql = "UPDATE user, user_info
                SET first_name = '{$first_name}',last_name = '{$last_name}',education = '{$education}',`profile` = '{$profile}',experiences = '{$experiences}',interests = '{$interests}'
                WHERE user.id=user_info.id_user
                AND user.id = '{$this->session->userdata_vnefrc('user_id')}';";
        $respone = $this->db->query($sql);
        //$this->db->where('id_user', )
        //->update('dghq_users_info', array('first_name' => $first_name, 'last_name' => $last_name, 'education' => $education,'profile' => $profile, 'experiences' => $experiences, 'interests' => $interests));
        //$respone = 1;
        //print_r($first_name.$last_name.$education);exit;
        $this->output->set_output(json_encode($respone));
    }

    function change_email() {
        $respone = array();
        $old_email = real_escape_string($_POST['old_email']);
        $new_email = real_escape_string($_POST['new_email']);
        $conform_email = real_escape_string($_POST['confirm_email']);
		if($new_email==''||$conform_email==''){
			$respone["status"] = "0";
			$respone["message"] = "Please input email";
		}
		else if ($new_email != $conform_email){
			$respone["status"] = "0";
			$respone["message"] = "Please check conform email";
		}
        else if($old_email == $this->db->where('id', $this->session->userdata_vnefrc('user_id'))->get('user')->row()->email) {
            $this->db->where('id', $this->session->userdata_vnefrc('user_id'))
                ->update('user', array('email' => $new_email));
			$respone["status"] = "1";
			$respone["message"] = $new_email;
        }
		else {
			$respone["status"] = "0";
			$respone["message"] = "Invalid email";
		}
        $this->output->set_output(json_encode($respone));
    }

   // function view_user() {
//        $sql = "select dui.id_user, du.first_name, du.last_name, dui.from, du.birthdate, dui.prof_phone, dui.prof_mobile, du.email,
//                dui.addr_street, dui.addr_city, dui.addr_country
//                from {$this->user->table_dghq_users_info} dui, {$this->user->table_dghq_users} du
//                where dui.id_user = du.id_user
//                and dui.id_user = '".$this->input->post('id_user')."';";
//        $this->output->set_output(json_encode($this->db->query($sql)->row_array()));
//    }
//    
//	function view_user_home() {
//        $sql = "select du.first_name, du.last_name, dui.profile, dui.education, dui.experiences, dui.interests
//                from {$this->user->table_dghq_users_info} dui, {$this->user->table_dghq_users} du
//                where dui.id_user = du.id_user
//                and dui.id_user = '".$this->session->userdata_vnefrc('id_user')."';";
//        $this->output->set_output(json_encode($this->db->query($sql)->row_array()));
//    }

    function update_user() {
        $respone = 0;
        foreach ($this->input->post() as $key => $value) {
            switch ($key) {
                case 'from':
                case 'prof_phone':
                case 'prof_mobile':
                case 'addr_street':
                case 'addr_city':
                case 'addr_country':
                    $data_info[$key] = real_escape_string($value);
                    break;
                default:
                    $data[$key] = real_escape_string($value);
                    break;
            }
        }

        $this->db->trans_start();
        
        $this->db->where('id', $this->session->userdata_vnefrc('user_id'))
            ->update('user', $data);

        $this->db->where('id', $this->session->userdata_vnefrc('user_id'))
            ->update('user_info', $data_info);

        if($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_complete();
            $respone = 1;
        }

        $this->output->set_output(json_encode($respone));
    }

}
