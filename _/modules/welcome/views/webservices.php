<?php    if(!$this->session->userdata_vnefrc('user_id')){
	redirect(base_url().'start');	
}?>



<form id="form_currency">
	<?php if(isset($filter_get_all)){?>
    <input type="hidden" class="filter_get_all" id="filter_get_all" name="filter_get_all" attr='<?php echo $filter_get_all; ?>' />
    <?php }?>
   
    </form>



<div class="col-md-12" style="padding-left:10px; ">
	
    <?php //echo "<pre>";print_r($column);exit;

	?>
   <input type="hidden" class="column" id="column" name="column" attr='<?php echo $column; ?>' />
   <div class="col-md-4" style="z-index:1000;  position: absolute; right: 32px; top: 8px;">
        <div class="table-group-actions pull-right">
        
            <button class="btn btn-sm green" >
                    VIEW 
             </button>
             <!--button class="btn btn-sm red exportCsv2" >
                    CSV 
                </button> 
            <button class="btn btn-sm yellow exportXls2" >
                    Excel 
            </button-->
        </div>
    </div>
    <form id="form_tab" action ="" method="post">
    <table id="jqGrid" class="jq_table" attr="<?php echo $tables;?>" order_by="<?php echo $summary_des['order_by'];?>" summary_des="<?php echo $summary_des['description']?>" admin ="<?php echo $summary_des['user_level'];?>">
    </table>	
    <div id="jqGridPager"></div>
    <input type="hidden" value="" name="actexport" id="actexport1" />
    <input type="hidden" value="<?php echo $tables ?>" name="table_name_export" id="table_name_export" />
    </form>

  </div> 
<!--END TEST-->
