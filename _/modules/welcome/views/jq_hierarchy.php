<?php    if(!$this->session->userdata_vnefrc('user_id')){
	redirect(base_url().'start');	
}?>

<div class="col-md-6" style="padding-left:10px;">
	<form id="form_currency">
	<?php if(isset($filter_get_all)){?>
    <input type="hidden" class="filter_get_all" id="filter_get_all" name="filter_get_all" attr='<?php echo $filter_get_all; ?>' />
    <?php }?>
   
    </form>
    <?php //echo "<pre>";print_r($column);exit;

	?>
    <input type="hidden" class="column" id="column" name="column" attr='<?php echo $column; ?>' attrchild='<?php echo $column_child; ?>' />
   <?php //echo "<pre>";print_r($column);exit;?>
   <div class="col-md-4" style="z-index:10;  position: absolute; right: 32px; top: 8px;">
        <div class="table-group-actions pull-right">
        
     <button class="btn btn-sm green exportTxt " >
                    TXT 
                </button>
             <button class="btn btn-sm red exportCsv" >
                    CSV 
                </button> 
            <button class="btn btn-sm yellow exportXls" >
                    Excel 
            </button>
        </div>
    </div>
    <form id="form_tab" action ="" method="post">
    <table id="jqGrid" class="jq_table" attr="<?php echo $table;?>" order_by="<?php echo $summary_des['order_by'];?>" summary_des="<?php echo $summary_des['description']?>" admin ="<?php echo $summary_des['user_level'];?>">
    
    </table>	
    <div id="jqGridPager"></div>
    <input type="hidden" value="" name="actexport" id="actexport" />
    <input type="hidden" value="<?php echo $table ?>" name="table_name_export" id="table_name_export" />
    </form>

  </div> 
<!--END TEST-->


<input type="hidden" id="jqGrid3" class="jq_table3" attr="" />

<div class="col-md-6">
	
    <?php //echo "<pre>";print_r($column);exit;

	?>
    <input type="hidden" class="column2" id="column2" name="column2" attr='<?php echo $column2; ?>' attrchild='<?php echo $column_child2; ?>'/>
   <?php //echo "<pre>";print_r($column);exit;?>
   <div class="col-md-4" style="z-index:1000;  position: absolute; right: 32px; top: 8px;">
        <div class="table-group-actions pull-right">
        
     <button class="btn btn-sm green exportTxt2 " >
                    TXT 
                </button>
             <button class="btn btn-sm red exportCsv2" >
                    CSV 
                </button> 
            <button class="btn btn-sm yellow exportXls2" >
                    Excel 
            </button>
        </div>
    </div>
    <form id="form_tab2" action ="" method="post">
    <table id="jqGrid2" class="jq_table2" attr="<?php echo $table2;?>" order_by="<?php echo $summary_des2['order_by'];?>" summary_des2="<?php echo $summary_des2['description']?>" admin ="<?php echo $summary_des2['user_level'];?>">
    
    </table>	
    <div id="jqGridPager2"></div>
    <input type="hidden" value="" name="actexport2" id="actexport2" />
    <input type="hidden" value="<?php echo $table2 ?>" name="table_name_export2" id="table_name_export2" />
    </form>

  </div>
 