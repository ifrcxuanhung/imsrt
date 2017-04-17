<?php
class Market_maker_model extends CI_Model{
    
    protected $_lang;
    
    public function __construct() {
        parent::__construct();
        $this->_lang = $this->session->userdata_vnefrc('curent_language');
    }

    public function get_market_setting($user) {
        if(is_numeric($user)) {
            $sql = "SELECT mms.*, CONVERT(CONCAT(mms.yyyy, if(mms.mm<10, CONCAT(0, mms.mm), mms.mm)), UNSIGNED INTEGER) yyyymm
                    FROM market_maker_setting mms
                    LEFT JOIN market_maker_setting temp ON mms.mm=temp.mm AND mms.yyyy=temp.yyyy
                    WHERE mms.user={$user} AND mms.active=1
                    GROUP BY mms.mm, mms.yyyy
                    ORDER BY yyyymm ASC;";
        } else {
            $sql = "SELECT mms.*, CONVERT(CONCAT(mms.yyyy, if(mms.mm<10, CONCAT(0, mms.mm), mms.mm)), UNSIGNED INTEGER) yyyymm
                    FROM market_maker_setting mms
                    WHERE mms.active=1
                    GROUP BY mms.mm, mms.yyyy
                    ORDER BY yyyymm ASC;";
        }
        return $this->db->query($sql)->result_array();
    }
    
    public function get_option($user) {
        if(is_numeric($user)){
            $sql = "SELECT istt.*, ds.name 
                    FROM index_setting istt
                    LEFT JOIN data_setting ds ON ds.id=istt.data
                    WHERE istt.user= {$user}
                    GROUP BY code
                    ORDER BY code ASC;";
        } else {
            $sql = "SELECT istt.*, ds.name 
                    FROM index_setting istt
                    LEFT JOIN data_setting ds ON ds.id=istt.data
                    GROUP BY code
                    ORDER BY code ASC;";
        }
        return $this->db->query($sql)->result_array();
    }
    
//    public function get_data($index) {
//        if(isset($index)) {
//            $sql = "SELECT istt.*, ds.name 
//                    FROM index_setting istt
//                    LEFT JOIN data_setting ds ON ds.id=istt.data
//                    WHERE istt.code='{$index}' 
//                    GROUP BY code
//                    ORDER BY code ASC;";
//        } else {
//            $sql = "SELECT istt.*, ds.name 
//                    FROM index_setting istt
//                    LEFT JOIN data_setting ds ON ds.id=istt.data
//                    GROUP BY code
//                    ORDER BY code ASC;";
//        }
//        return $this->db->query($sql)->result_array();
//    }

    public function update_option($id_user,$ocode,$odata,$onumberCon){
        $sql = 'UPDATE index_setting B SET 
                B.code = "' . $ocode . '",
                B.data = "' . $odata . '",
                B.nboption = "' . $onumberCon . '"
            WHERE 
                 B.`user` = "' . $id_user.'"';
        return $this->db->query($sql);
    }
    
    public function update_contentoption($id_setting,$id_user,$season,$month,$interval,$tick,$nbcontact){
        $sql = 'UPDATE market_maker_setting B SET 
                B.type = "' . $season . '",
                B.mm = "' . $month . '",
                B.interval = "' . $interval . '", 
                B.tick = "' . $tick . '", 
                B.nbcontract = "' . $nbcontact . '"
            WHERE 
                B.id = "' . $id_setting . '"
            AND B.`user` = "' . $id_user.'"';
                
        return $this->db->query($sql);
    }
    
    public function update_contentmarket($id_setting,$id_user,$obligcheck,$nbstrikes,$maxspd,$minquant){
        $sql = 'UPDATE market_maker_setting B SET 
                B.oblig = "' . $obligcheck . '",
                B.nbstrikes = "' . $nbstrikes . '",
                B.maxspd = "' . $maxspd . '", 
                B.minquant = "' . $minquant . '"
            WHERE 
                B.id = "' . $id_setting . '"
            AND B.`user` = "' . $id_user.'"';   
        return $this->db->query($sql);
        
    }   
    public function getPrice_realtime() {
        $rand = (int)(rand(0, 50));
        return $this->db->select('code as idx_code, name, if('.$rand.' < 25, last - '.$rand.', last + '.$rand.') as idx_last, (select "'.date('Y-m-d').'") as date, (select "'.date('H:i:s').'") as time')
            ->from('index_setting')
            ->where('active', 1)
            ->get()->row_array();
    }

}