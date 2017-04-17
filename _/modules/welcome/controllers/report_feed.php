<?php
class Report_feed extends Welcome{
	 var $channel;
    public function __construct() {
        
        parent::__construct();
		set_time_limit(0);
        $this->load->database();
		$this->load->Model('exchange_model', 'mexchange');
		$this->load->library('curl');
		
    }
    public function index()
    {    
	//$this->dowwnload_stox_feed();
	$this->download_hsx_newwebsite();
       
       $this->template->write_view('content', 'report_feed', $this->data);
        $this->template->render();     
    }
    private function dowwnload_stox_feed(){
		 define('_USERNAME', 'IFRC');
        define('_PASSWORD', 'IFRCF$$D2014');
        $markets = array();
        array_push($markets, array('market' => 'hose', 'indexType' => 0));
        array_push($markets, array('market' => 'hnx', 'indexType' => 1));
        array_push($markets, array('market' => 'upcom', 'indexType' => 3));
        $startdate=date('Y-m-d');
        $enddate=date('Y-m-d');/*date('Y-m-d');*/
        $date = date('Ymd');
        $message = 'DONE!';
        $this->db->query("truncate vndb_prices_day_stp");
            
        foreach ($markets as $key => $value) {
            $urlPageCount = "http://datafeed.stox.vn/DataFeed.asmx/GetEODStockByEXPageCount";
            $postPageCount = "username="._USERNAME."&password="._PASSWORD."&exCode=".$value['market']."&date=".$enddate;
            $ch = curl_init($urlPageCount);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postPageCount);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $xml_data = curl_exec($ch);
            $PageCount = simplexml_load_string($xml_data);
			
			if($_SERVER['HTTP_HOST'] == 'linux.itvn.fr'){
				$path="/var/lib/mysql/imsrt";
			}else {
				$path="ftp_download/";
			}
			if (!is_dir($path)) {
				mkdir($path);
			}
			$filename = "STP_{$value['market']}_{$date}.txt";
			$file = $path . $filename;
			if (is_file($file)) {
				unlink($file);
			}
            for($page = 0; $page < $PageCount; $page++)
            {
                switch ($value['market']) {
                    case 'hose':
                        $header = array('StockSymbol','DateReport','PriorClosePrice', 'Ceiling', 'Floor', 'OpenPrice', 'Highest', 'Lowest','Last', 'Totalshare','TotalValue');
                        $tagget = 'stox_tb_HOSE_Trading';
                        break;
                    case 'hnx':
                        $header = array('Code', 'Trading_date','Basic_price', 'Ceiling_price', 'Floor_price', 'Open_price', 'Highest_price', 'Lowest_price','average_price', 'Close_price', 'Nm_total_traded_qtty','Nm_total_traded_value');
                        $tagget = 'stox_tb_StocksInfo';
                        break;
                    case 'upcom':
                        $header = array('Code', 'Trading_date','Basic_price', 'Ceiling_price', 'Floor_price', 'Open_price', 'Highest_price', 'Lowest_price','average_price', 'Close_price', 'Nm_total_traded_qtty','Nm_total_traded_value');
                        $tagget = 'stox_tb_upcom_StocksInfo';
                        break;
                }
                $url = 'http://datafeed.stox.vn/DataFeed.asmx/GetEODStockByEX';
                $post = "username="._USERNAME."&password="._PASSWORD."&exCode={$value['market']}&date={$enddate}&page=".$page;
                $base64 = true;
                $dataxml = $this->getdataxml($url, $post, $tagget, $header, $base64);
                $header = array_map('strtolower', $header);
                if(is_file($file))
                {
                    $this->exportfile_append($path, $filename, $header, $dataxml); 
                }
                else
                {
                    $this->exportfile($path, $filename, $header, $dataxml);
                }
            }
          if($_SERVER['HTTP_HOST'] == 'linux.itvn.fr'){
        	$this->db->query("LOAD DATA INFILE '".$filename."'
          	INTO TABLE vndb_prices_day_stp CHARACTER SET UTF8 FIELDS TERMINATED BY  '\\t'  IGNORE 1 LINES (ticker,date,pref,pcei,pflr,popn,phgh,plow,pcls,vlm,trn)");
		  }
		  else {
			  $this->db->query("LOAD DATA LOCAL INFILE '".$path."/".$filename."'
          	INTO TABLE vndb_prices_day_stp CHARACTER SET UTF8 FIELDS TERMINATED BY  '\\t'  IGNORE 1 LINES (ticker,date,pref,pcei,pflr,popn,phgh,plow,pcls,vlm,trn)");
		  }
        }
		
		curl_close($ch);
	}
	 private function download_hsx_newwebsite(){
			$date = date('d.m.Y');
			if(isset($_GET['date'])){
				$date = $_GET['date'];
			}
			
			$channel = curl_init();
        // you might want the headers for http codes
			curl_setopt($channel, CURLOPT_HEADER, 0);
			// you may need to set the http useragent for curl to operate as
			// you wanna follow stuff like meta and location headers
			curl_setopt($channel, CURLOPT_FOLLOWLOCATION, 1);
			// you want all the data back to test it for errors
			curl_setopt($channel, CURLOPT_RETURNTRANSFER, 1);
			 curl_setopt($channel, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($channel, CURLOPT_SSL_VERIFYPEER, 0);
			// probably unecessary, but cookies may be needed to
			// if the $vars are in an array then turn them into a usable string
		   curl_setopt ($channel, CURLOPT_URL, 'https://www.hsx.vn/Modules/Rsde/Report/QuoteReport?pageFieldName1=Date&pageFieldValue1='.$date.'&pageFieldOperator1=eq&pageFieldName2=KeyWord&pageFieldValue2=&pageFieldOperator2=&pageFieldName3=IndexType&pageFieldValue3=0&pageFieldOperator3=&pageCriteriaLength=3&_search=false&nd=1423196420736&rows=2147483647&page=1&sidx=id&sord=desc');
			
            $content = 'source	ticker	market	date	yyyymmdd	shli	shou	shfn	pref	pcei	pflr	popn	phgh	plow	pbase	pavg	pcls	vlm	trn	adj_pcls	adj_coeff' . PHP_EOL;
        	$datahtml =curl_exec($channel);
			$datahtml1 = $datahtml;
            $datahtml = substr($datahtml, strpos($datahtml,'{'));
			$datahtml = json_decode($datahtml, 1);
			foreach($datahtml['rows'] as $item){
                $content .='EXC'. chr(9);//source
				$ticker = $item['cell'][0];
				$content .= $ticker . chr(9);//ticker
                $content .='HSX' .chr(9);//market
				//$isin =  $item['cell'][2];
				//$content .= $isin . chr(9);//isin
                $content .=date('Y/m/d').chr(9);//date
				$lcdate   = explode('.',$date);
				$yyyymmdd = $lcdate[2] . $lcdate[1] . $lcdate[0];
				$content .= $yyyymmdd . chr(9);//yyyymmdd
                $content .=''.chr(9);//shli
                $content .=''.chr(9);//shou
                $content .=''.chr(9);//shfn
				$content .= 1000*str_replace(',', '.', $item['cell'][6]) . chr(9);//exc_pref
				$content .= 1000*str_replace(',', '.', $item['cell'][4]) . chr(9);//exc_pcei
                $content .= 1000*str_replace(',', '.', $item['cell'][5]) . chr(9);//exc_pflr
				$content .= 1000*str_replace(',', '.', $item['cell'][7]) . chr(9);//exc_popn
                $content .= 1000*str_replace(',', '.', $item['cell'][12]) . chr(9);//exc_phgh
                $content .= 1000*str_replace(',', '.', $item['cell'][11]) . chr(9);//exc_plow
                $content .= ''.chr(9);//pbase
                $content .= 1000*str_replace(',', '.', $item['cell'][13]) . chr(9);//exc_avg
				$content .= 1000*str_replace(',', '.', $item['cell'][8]) . chr(9);//exc_pcls
				$content .= 10*str_replace(',', '.',str_replace('.', '', $item['cell'][14])) . chr(9);//exc_pvlm
				$content .= 1000000*str_replace(',', '.', str_replace('.', '', $item['cell'][15])) . chr(9);//exc_ptrn
                $content .=''.chr(9);//adj_pcls
               // $content .=''.chr(9);//adj_coeff
				$content .= PHP_EOL;
			}
			$date2 = explode('.', $date);
			$date3 = $date2[2] . $date2[1] . $date2[0];
			if($_SERVER['HTTP_HOST'] == 'linux.itvn.fr'){
				$file = fopen('/var/lib/mysql/imsrt/EXC_HSX_' .$date3. '.txt', 'w');
			}else {
				$file = fopen('ftp_download/EXC/EXC_HSX_' .$date3. '.txt', 'w');
			}
			
            fwrite($file, $content);
			$file = fopen('ftp_download/EXC/HSX/HSX_' .$date3. '.htm', 'w');
            fwrite($file, $datahtml1);
			if($_SERVER['HTTP_HOST'] == 'linux.itvn.fr'){
        	
			$this->db->query("LOAD DATA INFILE 'EXC_HSX_" .$date3. ".txt' INTO TABLE vndb_prices_day FIELDS TERMINATED BY  '\\t'  IGNORE 1 LINES");
		  }
		  else {
			  $this->db->query("LOAD DATA LOCAL INFILE 'ftp_download/EXC/EXC_HSX_" .$date3. ".txt' INTO TABLE vndb_prices_day FIELDS TERMINATED BY  '\\t'  IGNORE 1 LINES");
		  }
            
            $sql = "UPDATE vndb_prices_day SET last=IF(pcls <> 0, pcls, pref);";                
            $this->db->query($sql);

	 }
    function getdataxml($url = '', $post = '', $tagget = '', $header = array(), $base64 = true) {
        $result = array();
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $xml_data = curl_exec($ch);
        if ($xml_data) {
            $parser = simplexml_load_string($xml_data);
            $doc = new DOMDocument();
            if ($base64 == true) {
                $doc->loadXML(base64_decode($parser));
            } else {
                $doc->loadXML($parser);
            }
            $key = 0;

            foreach ($doc->getElementsByTagName($tagget) as $item) {
                foreach ($header as $col) {
                    $value = @$item->getElementsByTagName($col)->item(0)->nodeValue;
                    $result[$key][strtolower($col)] = isset($value) ? trim($value) : '';
                }
                $key++;
            }
        }
        return $result;
    }

    function exportfile($path = '', $file_name = '', $headers = array(), $arr = array()) {
        $file = "{$path}{$file_name}";
        if (is_file($file)) {
            unlink($file);
        }
        $temp = '';
        $data = array();
        foreach ($headers as $k => $value) {
            $temp .= $value . chr(9);
        }
        $data[0] = trim($temp) . PHP_EOL;
        foreach ($arr as $k => $item) {
            $temp = '';
            $count = 1;
            foreach ($headers as $value) {
                if ($count < count($headers)) {
                    if (isset($item[$value])) {
                        $temp .= $item[$value] . chr(9);
                    } else {
                        $temp .= chr(9);
                    }
                } else {
                    $temp .= $item[$value];
                }
                $count++;
            }
            $data[] = $temp . PHP_EOL;
        }
        file_put_contents($file, $data);
        unset($data);
    }

    function exportfile_append($path = '', $file_name = '', $headers = array(), $arr = array()) {
        $file = "{$path}/{$file_name}";
        
        $temp = '';
        $data = array();
        foreach ($headers as $k => $value) {
            $temp .= $value . chr(9);
        }
        $data[0] = trim($temp) . PHP_EOL;
        foreach ($arr as $k => $item) {
            $temp = '';
            $count = 1;
            foreach ($headers as $value) {
                if ($count < count($headers)) {
                    if (isset($item[$value])) {
                        $temp .= $item[$value] . chr(9);
                    } else {
                        $temp .= chr(9);
                    }
                } else {
                    $temp .= $item[$value];
                }
                $count++;
            }
            $data[] = $temp . PHP_EOL;
            unset($data['0']);
        }
        file_put_contents($file, $data, FILE_APPEND);
        unset($data);
    }  
	

    function makeRequest($method, $url, $vars) {
		 $channel = curl_init($url);
        // you might want the headers for http codes
        curl_setopt($channel, CURLOPT_HEADER, true);
        // you may need to set the http useragent for curl to operate as
        // you wanna follow stuff like meta and location headers
        curl_setopt($channel, CURLOPT_FOLLOWLOCATION, true);
        // you want all the data back to test it for errors
        curl_setopt($channel, CURLOPT_RETURNTRANSFER, true);
        // probably unecessary, but cookies may be needed to
        // if the $vars are in an array then turn them into a usable string
       
        return curl_exec($channel);
    }

}