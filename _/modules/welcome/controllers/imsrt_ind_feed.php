<?php



class Imsrt_ind_feed extends Welcome{

    public function __construct() {

        parent::__construct();

		$this->load->model('Dashboard_model', 'dash');	

    }

    

    public function index() {

		//$homepage = file_get_contents('http://banggia.cafef.vn/stockhandler.ashx?center='.$j);

			$ch = curl_init();

			$timeout = 0;

			curl_setopt ($ch, CURLOPT_URL, 'http://banggia.cafef.vn/stockhandler.ashx?index=true');

			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);

			curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

			$homepage = curl_exec($ch);

			curl_close($ch);

			

		

			$array_cafef = json_decode($homepage,true);

			//echo "<pre>";print_r($array_cafef);exit;

			$get_file = array();

			foreach($array_cafef as $val){

				

				//$codeint = 'STKVN'.$val['a'];

				$symbol = $this->db->select("code")->where('symbol',$val['name'])->get('efrc_ins_ref')->row_array();		

				$get_file[] = $val['name']."\t".$val['index']."\t".$val['percent']."\t".$val['change']."\t".$symbol['code']."\r\n";				

	

			}

			if($_SERVER['HTTP_HOST'] == 'linux.itvn.fr'){

				file_put_contents("/var/lib/mysql/imsrt/efrc_ind_vn_feed.txt",$get_file);

			}

			else{

				file_put_contents("ftp_upload/efrc_ind_vn_feed.txt",$get_file);	

			}

       // var_export($result);

    }

}