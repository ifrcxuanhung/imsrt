<style>
.export_total{ display:none;}
</style>
<?php    if(!$this->session->userdata_vnefrc('user_id')){
	redirect(base_url().'start');	
}?>
<div>
	<form id="form_currency">
	<?php if(isset($filter_get_all)){?>
    <input type="hidden" class="filter_get_all" id="filter_get_all" name="filter_get_all" attr='<?php echo $filter_get_all; ?>' />
    <?php }?>
   
    </form>
    <?php //echo "<pre>";print_r($column);exit;

	?>
    <input type="hidden" class="column" id="column" name="column" attr='<?php echo $column; ?>' />
   <?php // echo "<pre>";print_r($column);exit;?>
   <div class="col-md-4 export_total" style="z-index:100;  position: absolute; right: 42px; top: 8px;">
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
    <table id="jqGrid" class="jq_table" attr="<?php echo $table;?>" order_by="<?php echo $summary_des['order_by'];?>" summary_des="<?php echo $summary_des['description']?>" admin ="<?php echo $summary_des['user_level'];?>" session_edit = "disable">
    
    </table>	
    <div id="jqGridPager"></div>
    <input type="hidden" value="" name="actexport" id="actexport" />
    <input type="hidden" value="<?php echo $table ?>" name="table_name_export" id="table_name_export" />
    </form>

  </div> 
<!--END TEST-->

