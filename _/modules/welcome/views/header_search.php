
<?php 
// phan seach cho efrc_data_ref

if(isset($jq_data['jq']) && $jq_data['jq'] == 1){

    if(strstr($_SERVER['REQUEST_URI'],"jq_loadtable/")){ 
	?>
    <form action="efrc_data_ref" method="get">
        <div class="input-group btn-search" style=" padding: 0px 0px !important; width:50% ; float: left;">
            <input style="background-color: #223f4d; color:#8c929b; font-size: 15px; border:1px solid #4b4b4b;" class="form-control search_efrc_data_ref" id="search_efrc_data_ref" type="text" name="name" placeholder="Search for data" onPaste="" />
            <!--onkeydown="return checkEnter(event);" onclick='myFunction()'-->
            <span class="input-group-btn" >
                <button type="submit" class="btn submit grey-cascade"><i class="icon-magnifier" ></i></button>
            </span>
        </div>
     </form>
     <?php }
     elseif(strstr($_SERVER['REQUEST_URI'],"/table/")){
         $base_url = explode("index.php",$_SERVER['PHP_SELF']);
         ?>
     
          <form action="<?php echo $base_url[0];?>jq_loadtable/efrc_data_ref" method="get">
            <div class="input-group btn-search" style=" padding: 0px 0px !important; width:50% ; float: left;">
                <input style="background-color: #223f4d; color:#8c929b; font-size: 15px; border:1px solid #4b4b4b;" class="form-control search_efrc_data_ref" id="search_efrc_data_ref" type="text" name="name" placeholder="Search for data" onPaste="" />
                <!--onkeydown="return checkEnter(event);" onclick='myFunction()'-->
                <span class="input-group-btn" >
                    <button type="submit" class="btn submit grey-cascade"><i class="icon-magnifier" ></i></button>
                </span>
            </div>
         </form>
            
     <?php }
     else{
     ?>
       <form action="jq_loadtable/efrc_data_ref" method="get">
        <div class="input-group btn-search" style=" padding: 0px 0px !important; width:50% ; float: left;">
            <input style="background-color: #223f4d; color:#8c929b; font-size: 15px; border:1px solid #4b4b4b;" class="form-control search_efrc_data_ref" id="search_efrc_data_ref" type="text" name="name" placeholder="Search for data" onPaste="" />
            <!--onkeydown="return checkEnter(event);" onclick='myFunction()'-->
            <span class="input-group-btn" >
                <button type="submit" class="btn submit grey-cascade"><i class="icon-magnifier" ></i></button>
            </span>
        </div>
     </form>
     <?php }
}else{

     if(strstr($_SERVER['REQUEST_URI'],"/table/")){ 
     
     ?>
  
    <form action="efrc_data_ref" method="get">
        <div class="input-group btn-search" style=" padding: 0px 0px !important; width:50% ; float: left;">
            <input style="background-color: #223f4d; color:#8c929b; font-size: 15px; border:1px solid #4b4b4b;" class="form-control search_efrc_data_ref" id="search_efrc_data_ref" type="text" name="name" placeholder="Search for data" onPaste="" />
            <!--onkeydown="return checkEnter(event);" onclick='myFunction()'-->
            <span class="input-group-btn" >
                <button type="submit" class="btn submit grey-cascade"><i class="icon-magnifier" ></i></button>
            </span>
        </div>
     </form>
     <?php }
     elseif(strstr($_SERVER['REQUEST_URI'],"jq_loadtable/")){ 
        $base_url = explode("index.php",$_SERVER['PHP_SELF']);
        
     ?>
             <form action="<?php echo $base_url[0];?>table/efrc_data_ref" method="get">
            <div class="input-group btn-search" style=" padding: 0px 0px !important; width:50% ; float: left;">
                <input style="background-color: #223f4d; color:#8c929b; font-size: 15px; border:1px solid #4b4b4b;" class="form-control search_efrc_data_ref" id="search_efrc_data_ref" type="text" name="name" placeholder="Search for data" onPaste="" />
                <!--onkeydown="return checkEnter(event);" onclick='myFunction()'-->
                <span class="input-group-btn" >
                    <button type="submit" class="btn submit grey-cascade"><i class="icon-magnifier" ></i></button>
                </span>
            </div>
         </form>
     
     <?php }
     else{
     ?>
       <form action="table/efrc_data_ref" method="get">
        <div class="input-group btn-search" style=" padding: 0px 0px !important; width:50% ; float: left;">
            <input style="background-color: #223f4d; color:#8c929b; font-size: 15px; border:1px solid #4b4b4b;" class="form-control search_efrc_data_ref" id="search_efrc_data_ref" type="text" name="name" placeholder="Search for data" onPaste="" />
            <!--onkeydown="return checkEnter(event);" onclick='myFunction()'-->
            <span class="input-group-btn" >
                <button type="submit" class="btn submit grey-cascade"><i class="icon-magnifier" ></i></button>
            </span>
        </div>
     </form>
     <?php } 
    
   }?>
   
   
   
    <?php 
    // Phan search cho efrc_ins_ref
	
if(isset($jq_ins['jq']) && $jq_ins['jq'] == 1){
        if(strstr($_SERVER['REQUEST_URI'],"jq_loadtable/")){ ?>
         <form action="efrc_ins_ref" method="get">
        <div class="input-group btn-search" style=" padding: 0px 0px !important; width: 49%; left: 4%;">
            <input style="background-color: #223f4d; color:#8c929b; font-size: 15px; border:1px solid #4b4b4b;" class="form-control search_efrc_ins_ref" id="search_efrc_ins_ref" type="text" name="name" placeholder="Search for instrument" onPaste=""/>
            <span class="input-group-btn" >
                <button type="submit" class="btn submit grey-cascade"><i class="icon-magnifier" ></i></button>
            </span>
        </div>
      </form>
  
     <?php }
     elseif(strstr($_SERVER['REQUEST_URI'],"/table/")){
         $base_url = explode("index.php",$_SERVER['PHP_SELF']);
         ?>
          <form action="<?php echo $base_url[0];?>jq_loadtable/efrc_ins_ref" method="get">
        <div class="input-group btn-search" style=" padding: 0px 0px !important; width: 49%; left: 4%;">
            <input style="background-color: #223f4d; color:#8c929b; font-size: 15px; border:1px solid #4b4b4b;" class="form-control search_efrc_ins_ref" id="search_efrc_ins_ref" type="text" name="name" placeholder="Search for instrument" onPaste=""/>
            <span class="input-group-btn" >
                <button type="submit" class="btn submit grey-cascade"><i class="icon-magnifier" ></i></button>
            </span>
        </div>
      </form>
    
     <?php }
     else{
     ?>
     
         <form action="jq_loadtable/efrc_ins_ref" method="get">
        <div class="input-group btn-search" style=" padding: 0px 0px !important; width: 49%; left: 4%;">
            <input style="background-color: #223f4d; color:#8c929b; font-size: 15px; border:1px solid #4b4b4b;" class="form-control search_efrc_ins_ref" id="search_efrc_ins_ref" type="text" name="name" placeholder="Search for instrument" onPaste=""/>
            <span class="input-group-btn" >
                <button type="submit" class="btn submit grey-cascade"><i class="icon-magnifier" ></i></button>
            </span>
        </div>
      </form>
      
    
     <?php }
}else{
    
	  
     if(strstr($_SERVER['REQUEST_URI'],"/table/")){ 
     ?>
         <form action="efrc_ins_ref" method="get">
        <div class="input-group btn-search" style=" padding: 0px 0px !important; width: 49%; left: 4%;">
            <input style="background-color: #223f4d; color:#8c929b; font-size: 15px; border:1px solid #4b4b4b;" class="form-control search_efrc_ins_ref" id="search_efrc_ins_ref" type="text" name="name" placeholder="Search for instrument" onPaste=""/>
            <span class="input-group-btn" >
                <button type="submit" class="btn submit grey-cascade"><i class="icon-magnifier" ></i></button>
            </span>
        </div>
      </form>
  
     <?php }
     elseif(strstr($_SERVER['REQUEST_URI'],"jq_loadtable/")){ 
        $base_url = explode("index.php",$_SERVER['PHP_SELF']);
        
     ?>
      <form action="<?php echo $base_url[0];?>table/efrc_ins_ref" method="get">
        <div class="input-group btn-search" style=" padding: 0px 0px !important; width: 49%; left: 4%;">
            <input style="background-color: #223f4d; color:#8c929b; font-size: 15px; border:1px solid #4b4b4b;" class="form-control search_efrc_ins_ref" id="search_efrc_ins_ref" type="text" name="name" placeholder="Search for instrument" onPaste=""/>
            <span class="input-group-btn" >
                <button type="submit" class="btn submit grey-cascade"><i class="icon-magnifier" ></i></button>
            </span>
        </div>
      </form>
     
     
     <?php }
     else{
     ?>
     
      <form action="table/efrc_ins_ref" method="get">
        <div class="input-group btn-search" style=" padding: 0px 0px !important; width: 49%; left: 4%;">
            <input style="background-color: #223f4d; color:#8c929b; font-size: 15px; border:1px solid #4b4b4b;" class="form-control search_efrc_ins_ref" id="search_efrc_ins_ref" type="text" name="name" placeholder="Search for instrument" onPaste=""/>
            <span class="input-group-btn" >
                <button type="submit" class="btn submit grey-cascade"><i class="icon-magnifier" ></i></button>
            </span>
        </div>
      </form>
     <?php } 
    
   }?>
                    