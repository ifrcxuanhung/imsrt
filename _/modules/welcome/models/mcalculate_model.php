<?php
class Mcalculate_model extends CI_Model{
    protected $_lang;
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->_lang = $this->session->userdata_vnefrc('curent_language');
    }
    
    function normal($x){
        if($x<0){
            return 1-$this->normal(-$x);
            }
        if($x == 0)
        {
            return 0.5;
        }
            $k = 1.0 / (1.0 + 0.2316419 * $x);
            $y = 1.0 - exp(-$x * $x / 2) * $k * (0.31938153 +
                    $k * (-0.356563782 +
                      $k * (1.781477937 +
                        $k * (-1.821255978 +
                          $k * 1.330274429)))) / sqrt(6.28318530717958646);
        return $y;
    }
    function fnormal($x){ 
        $y = exp(-$x * $x / 2) /sqrt(2*PI());
        return $y;
    }
    /*--
    Hàm này tính buycal,buyput,Ventecall,Writeput
    Ðây là d?ng : 1 C hoac 1 P
    --*/
    function Calculate_buycall($S,$K,$R,$T,$Sigma,$Q,$I='100',$calls = 'c',$Achat=1){
        $RR = $R/100;
        $QQ=$Q/100;
        $Sigmaa = $Sigma/100;
        $Temps = $T/365;
        $d1= (log($S/$K)+($RR-$QQ+0.5*$Sigmaa*$Sigmaa)*$Temps)/($Sigmaa*sqrt($Temps));
        $d2=$d1-$Sigmaa*sqrt($Temps);
        $call =  $S*exp(-$QQ*$Temps)* $this->normal($d1)-$K*exp(-$RR*$Temps)* $this->normal($d2);
        $put  = -$S*exp(-$QQ*$Temps)*$this->normal(-$d1)+$K*exp(-$RR*$Temps)* $this->normal(-$d2);
        $deltac = exp(-$QQ*$Temps)*$this->normal($d1);
        $deltap = exp(-$QQ*$Temps)*($this->normal($d1)-1);
        $gammac = $this->fnormal($d1)/($S*$Sigmaa*sqrt($Temps));
        $gammap = $gammac;
        $vegac=$S*sqrt($Temps)*$this->fnormal($d1)*exp(-$QQ*$Temps);
        $vegap=$vegac;
        $thetac = -($S*exp(-$QQ*$Temps)*$Sigmaa*$this->fnormal($d1))/(2*sqrt($Temps)) + $QQ*$S*exp(-$QQ*$Temps)*$this->normal($d1) - $RR*$K*exp(-$RR*$Temps)*$this->normal($d2);
        $thetap = -($S*exp(-$QQ*$Temps)*$Sigmaa*$this->fnormal($d1))/(2*sqrt($Temps)) - $QQ*$S*exp(-$QQ*$Temps)*$this->normal(-$d1) + $RR*$K*exp(-$RR*$Temps)*$this->normal(-$d2);
        $su = $K;
            $i = 1;
            for($i;$i<=4;$i++){
                $su = $su - $I;
                $support[] = $su;
                
            }
            $su = $K;
            $n = 1;
            for($n;$n<=4;$n++){
                $su = $su + $I;
                $support[] = $su;
            }
        $support[] = $K;
        sort($support);
        $v = 1;
        for($v;$v<=9;$v++){
            $t = $v -1;
            $vars[] = ((($support[$t]/$S) - 1)*100);
            if($calls == "c"){
                $max = max(0,($support[$t] - $K));
                $Option = $max - $call;
                $Options[] = $Achat * $Option;
                
                @$Perf[] = ($Options[$t]/$call) * 100;
            }else{
                $max = max(0,(-$support[$t] + $K));
                $Option = $max - $call;
                $Options[] = $Achat * $Option;          
                @$Perf[] = ($Options[$t]/$call) * 100;   
            }
        }
        $arr_data = array('support'=>$support,'vars'=>$vars,'Options'=>$Options,'Perf'=>$Perf);
        return $arr_data;          
    }
    /*--
    Hàm này tính Achat de stellage,Vente de stellage,Achat de strangle ,Vente de strangle , Achat dun tunnel , Vente dun tunnel
    Ðây là d?ng : 1 C va 1 P, -1 C va -1 P
    --*/
    function Calculate_Achatdestellage($S,$K_1,$K_2,$R,$T,$Sigma,$Q,$I='100',$calls = 'c',$puts='p',$Achat_1=1,$Achat_2=1){
        $RR = $R/100;
        $QQ=$Q/100;
        $Sigmaa = $Sigma/100;
        $Temps = $T/365;
        $d1= (log($S/$K_1)+($RR-$QQ+0.5*$Sigmaa*$Sigmaa)*$Temps)/($Sigmaa*sqrt($Temps));
        $d2=$d1-$Sigmaa*sqrt($Temps);
        $call =  $S*exp(-$QQ*$Temps)*$this->normal($d1)-$K_1*exp(-$RR*$Temps)*$this->normal($d2);
        $put  = -$S*exp(-$QQ*$Temps)*$this->normal(-$d1)+$K_2*exp(-$RR*$Temps)*$this->normal(-$d2);
        $deltac = exp(-$QQ*$Temps)*$this->normal($d1);
        $deltap = exp(-$QQ*$Temps)*($this->normal($d1)-1);
        $gammac = $this->fnormal($d1)/($S*$Sigmaa*sqrt($Temps));
        $gammap = $gammac;
        $vegac=$S*sqrt($Temps)*$this->fnormal($d1)*exp(-$QQ*$Temps);
        $vegap=$vegac;
        $thetac = -($S*exp(-$QQ*$Temps)*$Sigmaa*$this->fnormal($d1))/(2*sqrt($Temps)) + $QQ*$S*exp(-$QQ*$Temps)*$this->normal($d1) - $RR*$K_1*exp(-$RR*$Temps)*$this->normal($d2);
        $thetap = -($S*exp(-$QQ*$Temps)*$Sigmaa*$this->fnormal($d1))/(2*sqrt($Temps)) - $QQ*$S*exp(-$QQ*$Temps)*$this->normal(-$d1) + $RR*$K_1*exp(-$RR*$Temps)*$this->normal(-$d2);
        $su = $K_1;
            $i = 1;
            
            for($i;$i<=4;$i++){
                $su = $su - $I;
                $support[] = $su;
                
            }
            $su = $K_1;
            $n = 1;
            for($n;$n<=4;$n++){
                $su = $su + $I;
                $support[] = $su;
            }
        $support[] = $K_1;
        sort($support);
        $v = 1;
        for($v;$v<=9;$v++){
            $t = $v -1;
            $vars[] = ((($support[$t]/$S) - 1)*100);
            if($calls == "c"){
                $max = max(0,($support[$t] - $K_1));
                $Patte_1 = $max - $call;
                $Pattes_1[] = $Achat_1 * $Patte_1;            
            }else{
                $max = max(0,(-$support[$t] + $K_2));
                $Patte_1 = $max - $put;
                $Pattes_1[] = $Achat_2 * $Patte_1;
                //echo $Pattes_1;exit;
            }
        }
        
        
        $tong_put = (1 * $call) + (1 * $put);
        $su = $K_2;
        $v = 1;
        for($v;$v<=9;$v++){
            $t = $v -1;
           
            if($puts == "p"){
                $max = max(0,(-$support[$t] + $K_2));
                $Patte_2 = $max - $put;
                $Pattes_2[] = $Achat_2 * $Patte_2;
                // combinne = 2 patte c?ng l?i
                $combinee[] = $Pattes_1[$t] + $Pattes_2[$t];
                //Performance = combinee chia cho tong_put 
                @$Perf[] = ($combinee[$t]/$tong_put) * 100;
            }else{
                $max = max(0,($support[$t] - $K_1));
                $Patte_2 = $max - $call;
                $Pattes_2[] = $Achat_1 * $Patte_2;
                // combinne = 2 patte c?ng l?i
                $combinee[] = $Pattes_1[$t] + $Pattes_2[$t];
                //Performance = combinee chia cho tong_put 
                @$Perf[] = ($combinee[$t]/$tong_put) * 100; 
            }
        }
        return $arr_data = array('support'=>$support,'vars'=>$vars,'Pattes_1'=>$Pattes_1,'Pattes_2'=>$Pattes_2,
                                'combinee'=>$combinee,'Perf'=>$Perf);           
    }
    /*
    Hàm này tính Achat d'un spread haussier,Vente d'un spread haussier
    Ðây là d?ng : 1 C va -1 C hoac -1 C va 1 C 
    */
    function Calculate_Achatdunspreadhaussier($S,$K_1,$K_2,$R,$T,$Sigma,$Q,$I='100',$calls = 'c',$Achat_1=1,$Achat_2=-1){
        $RR = $R/100;
        $QQ=$Q/100;
        $Sigmaa = $Sigma/100;
        $Temps = $T/365;
        $d1= (log($S/$K_1)+($RR-$QQ+0.5*$Sigmaa*$Sigmaa)*$Temps)/($Sigmaa*sqrt($Temps));
        $d2=$d1-$Sigmaa*sqrt($Temps);
        $call_1 =  $S*exp(-$QQ*$Temps)*$this->normal($d1)-$K_1*exp(-$RR*$Temps)*$this->normal($d2);
        $call_2 =  $S*exp(-$QQ*$Temps)*$this->normal($d1)-$K_2*exp(-$RR*$Temps)*$this->normal($d2);
        $put_1  = -$S*exp(-$QQ*$Temps)*$this->normal(-$d1)+$K_1*exp(-$RR*$Temps)*$this->normal(-$d2);
        $deltac = exp(-$QQ*$Temps)*$this->normal($d1);
        $deltap = exp(-$QQ*$Temps)*($this->normal($d1)-1);
        $gammac = $this->fnormal($d1)/($S*$Sigmaa*sqrt($Temps));
        $gammap = $gammac;
        $vegac=$S*sqrt($Temps)*$this->fnormal($d1)*exp(-$QQ*$Temps);
        $vegap=$vegac;
        $thetac = -($S*exp(-$QQ*$Temps)*$Sigmaa*$this->fnormal($d1))/(2*sqrt($Temps)) + $QQ*$S*exp(-$QQ*$Temps)*$this->normal($d1) - $RR*$K_1*exp(-$RR*$Temps)*$this->normal($d2);
        $thetap = -($S*exp(-$QQ*$Temps)*$Sigmaa*$this->fnormal($d1))/(2*sqrt($Temps)) - $QQ*$S*exp(-$QQ*$Temps)*$this->normal(-$d1) + $RR*$K_1*exp(-$RR*$Temps)*$this->normal(-$d2);
        $calls = 'c';
        $su = $K_1;
            $i = 1;
            
            for($i;$i<=4;$i++){
                $su = $su - $I;
                $support[] = $su;
                
            }
            $su = $K_1;
            $n = 1;
            for($n;$n<=4;$n++){
                $su = $su + $I;
                $support[] = $su;
            }
        $support[] = $K_1;
        sort($support);
        $v = 1;
        for($v;$v<=9;$v++){
            $t = $v -1;
            $vars[] = ((($support[$t]/$S) - 1)*100);
            if($calls == "c"){
                $max = max(0,($support[$t] - $K_1));
                $Patte_1 = $max - $call_1;
                $Pattes_1[] = $Achat_1 * $Patte_1;
            }
        }
        
        
        
        $tong_put = (1 * $call_1) + (1 * $call_2);
                    $su = $K_2;
                    $v = 1;
                    for($v;$v<=9;$v++){
                        $t = $v -1;
                        if($calls == "c"){
                            $max = max(0,($support[$t] - $K_2));
                            $Patte_2 = $max - $call_2;
                            $Pattes_2[] = $Achat_2 * $Patte_2;
                            // combinne = 2 patte c?ng l?i
                            $combinee[] = $Pattes_1[$t] + $Pattes_2[$t];
                            //Performance = combinee chia cho tong_put 
                            @$Perf[] = ($combinee[$t]/$tong_put) * 100;
                        }
                    }
        return $arr_data = array('support'=>$support,'vars'=>$vars,'Pattes_1'=>$Pattes_1,'Pattes_2'=>$Pattes_2,
                                'combinee'=>$combinee,'Perf'=>$Perf);      
                
    }
    /*
    Hàm này tính Achat dun papillon, Vente dun papillon
    Ðây là d?ng : 1 1 C va -1 C hoac -1 -1 C va 1 C 
    */
    function Calculate_Achatdunpapillon($S,$K_1,$K_2,$K_3,$R,$T,$Sigma,$Q,$I='50',$calls = 'c',$Achat_1=1,$Achat_2=1,$Achat_3=-1){
        $RR = $R/100;
        $QQ=$Q/100;
        $Sigmaa = $Sigma/100;
        $Temps = $T/365;
        $d1= (log($S/$K_1)+($RR-$QQ+0.5*$Sigmaa*$Sigmaa)*$Temps)/($Sigmaa*sqrt($Temps));
        $d2=$d1-$Sigmaa*sqrt($Temps);
        $call_1 =  $S*exp(-$QQ*$Temps)*$this->normal($d1)-$K_1*exp(-$RR*$Temps)*$this->normal($d2);
        $call_2 =  $S*exp(-$QQ*$Temps)*$this->normal($d1)-$K_2*exp(-$RR*$Temps)*$this->normal($d2);
        $call_3 =  $S*exp(-$QQ*$Temps)*$this->normal($d1)-$K_3*exp(-$RR*$Temps)*$this->normal($d2);
        $put_1  = -$S*exp(-$QQ*$Temps)*$this->normal(-$d1)+$K_1*exp(-$RR*$Temps)*$this->normal(-$d2);
        $deltac = exp(-$QQ*$Temps)*$this->normal($d1);
        $deltap = exp(-$QQ*$Temps)*($this->normal($d1)-1);
        $gammac = $this->fnormal($d1)/($S*$Sigmaa*sqrt($Temps));
        $gammap = $gammac;
        $vegac=$S*sqrt($Temps)*$this->fnormal($d1)*exp(-$QQ*$Temps);
        $vegap=$vegac;
        $thetac = -($S*exp(-$QQ*$Temps)*$Sigmaa*$this->fnormal($d1))/(2*sqrt($Temps)) + $QQ*$S*exp(-$QQ*$Temps)*$this->normal($d1) - $RR*$K_1*exp(-$RR*$Temps)*$this->normal($d2);
        $thetap = -($S*exp(-$QQ*$Temps)*$Sigmaa*$this->fnormal($d1))/(2*sqrt($Temps)) - $QQ*$S*exp(-$QQ*$Temps)*$this->normal(-$d1) + $RR*$K_1*exp(-$RR*$Temps)*$this->normal(-$d2);
        $calls = 'c';
        $su = $K_1;
      
            $i = 1;
            
            for($i;$i<=4;$i++){
                $su = $su - $I;
                $support[] = $su;
                
            }
            $su = $K_1;
            $n = 1;
            for($n;$n<=4;$n++){
                $su = $su + $I;
                $support[] = $su;
            }
        $support[] = $K_1;
        sort($support);
        $v = 1;
        
        for($v;$v<=9;$v++){
            $t = $v -1;
            $vars[] = ((($support[$t]/$S) - 1)*100);
            if($calls == "c"){
                $max_1 = max(0,($support[$t] - $K_1));
                $Patte_1 = $max_1 - $call_1;
                $Pattes_1[] = $Achat_1 * $Patte_1;
                
                $max_2 = max(0,($support[$t] - $K_2));
                $Patte_2 = $max_2 - $call_2;
                $Pattes_2[] = $Achat_2 * $Patte_2;
            }
        }
        
        
        $tong_put = (abs($Achat_1) * $call_1) + (abs($Achat_2) * $call_2) + (abs($Achat_3) * $call_3);                 
        $v = 1;                   
        for($v;$v<=9;$v++){
            $t = $v -1;
            if($calls == "c"){
                $max_3 = max(0,($support[$t] - $K_3));
                $Patte_3 = $max_3 - $call_3;
                $Pattes_3[] = ($Achat_3 * $Patte_3) * 2;
                // combinne = 2 patte c?ng l?i
                $combinee[] = $Pattes_1[$t] + $Pattes_2[$t] + $Pattes_3[$t];
                //Performance = combinee chia cho tong_put 
                @$Perf[] = ($combinee[$t]/$tong_put) * 100;
            }
        }
        return $arr_data = array('support'=>$support,'vars'=>$vars,'Pattes_1'=>$Pattes_1,'Pattes_2'=>$Pattes_2,
                                'Pattes_3'=>$Pattes_3,'combinee'=>$combinee,'Perf'=>$Perf);  
    }
}