<?php    if(!$this->session->userdata_vnefrc('user_id')){
	redirect(base_url().'start');	
}?>



<form id="form_currency">
	<?php if(isset($filter_get_all)){?>
    <input type="hidden" class="filter_get_all" id="filter_get_all" name="filter_get_all" attr='<?php echo $filter_get_all; ?>' />
    <?php }?>
   
    </form>

<div class="col-md-6" style="padding-left:10px;">
	
   
    <?php //echo "<pre>";print_r($column);exit;

	?>
    <input type="hidden" class="column1" id="column1" name="column1" attr='<?php echo $column1; ?>' />
   <?php //echo "<pre>";print_r($column);exit;?>
   <div class="col-md-4 export_total" style="z-index:940;  position: absolute; right: 32px; top: 8px;">
        <div class="table-group-actions pull-right">
        
     <button class="btn btn-sm green exportTxt1" >
                    TXT 
                </button>
             <button class="btn btn-sm red exportCsv1" >
                    CSV 
                </button> 
            <button class="btn btn-sm yellow exportXls1" >
                    Excel 
            </button>
        </div>
    </div>
    <form id="form_tab1" action ="" method="post">
    <table id="jqGrid1" class="jq_table1" attr="<?php echo $table1;?>" order_by="<?php echo $summary_des1['order_by'];?>" summary_des1="<?php echo $summary_des1['description']?>" admin ="<?php echo $summary_des1['user_level'];?>">
    
    </table>	
    <div id="jqGridPager1"></div>
    <input type="hidden" value="" name="actexport1" id="actexport1" />
    <input type="hidden" value="<?php echo $table1 ?>" name="table_name_export1" id="table_name_export1" />
    </form>

</div> 
<!--END TEST-->
<div class="col-md-6 block_map">
    <!-- BEGIN PORTLET-->
    <div class="portlet box " style="background-color: #89c4f4 !important; border: 1px solid #89c4f4;">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-share font-red-sunglo hide"></i>
                <span class="caption-subject bold uppercase" style="color: #606060;"><?php echo trans('Revenue') ?></span>
                <span class="caption-helper" style="color: #606060;"><?php echo trans('monthlystats') ?>...</span>
            </div>
            <!--div class="actions">
                <div class="btn-group">
                    <a href="" class="btn dark btn-outline btn-circle btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Filter Range
                        <span class="fa fa-angle-down"> </span>
                    </a>
                    <ul class="dropdown-menu pull-right">
                        <li>
                            <a href="javascript:;"> Q1 2014
                                <span class="label label-sm label-default"> past </span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;"> Q2 2014
                                <span class="label label-sm label-default"> past </span>
                            </a>
                        </li>
                        <li class="active">
                            <a href="javascript:;"> Q3 2014
                                <span class="label label-sm label-success"> current </span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;"> Q4 2014
                                <span class="label label-sm label-warning"> upcoming </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div-->
        </div>
        <div class="portlet-body">
            <!--div id="site_activities_loading">
                <img src="<?php echo template_url() ?>global/img/loading.gif" alt="loading" /> </div>
            <div id="site_activities_content" class="display-none"-->
                <div id="chartdiv" class="chart" style="height: 490px;"> </div>
            <!--/div-->
        </div>
    </div>
    <!-- END PORTLET-->

</div>
<!--END TEST-->
<div class="col-md-12" style="padding-left:10px;  margin-top:30px;  ">
	
    <?php //echo "<pre>";print_r($column);exit;

	?>
    <input type="hidden" class="column2" id="column2" name="column2" attr='<?php echo $column2; ?>' />
   <?php //echo "<pre>";print_r($column);exit;?>
   <div class="col-md-4 export_total" style="z-index:940;  position: absolute; right: 32px; top: 8px;">
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
<!--END TEST-->




<div class="col-md-12" style="padding-left:10px; margin-top:30px;">
	
   
    <?php //echo "<pre>";print_r($column);exit;

	?>
    <input type="hidden" class="column3" id="column3" name="column3" attr='<?php echo $column3; ?>' />
   <?php //echo "<pre>";print_r($column);exit;?>
   <div class="col-md-4 export_total" style="z-index:940;  position: absolute; right: 32px; top: 8px;">
        <div class="table-group-actions pull-right">
        
     <button class="btn btn-sm green exportTxt3" >
                    TXT 
                </button>
             <button class="btn btn-sm red exportCsv3" >
                    CSV 
                </button> 
            <button class="btn btn-sm yellow exportXls3" >
                    Excel 
            </button>
        </div>
    </div>
    <form id="form_tab3" action ="" method="post">
    <table id="jqGrid3" class="jq_table3" attr="<?php echo $table3;?>" order_by="<?php echo $summary_des3['order_by'];?>" summary_des3="<?php echo $summary_des3['description']?>" codeint='<?php echo $codeint;?>' admin ="<?php echo $summary_des3['user_level'];?>">
    
    </table>	
    <div id="jqGridPager3"></div>
    <input type="hidden" value="" name="actexport3" id="actexport3" />
    <input type="hidden" value="<?php echo $table3 ?>" name="table_name_export3" id="table_name_export3" />
    </form>

  </div> 
<!--END TEST-->


<div class="col-md-12" style="padding-left:10px; margin-top:30px;">
	
    <?php //echo "<pre>";print_r($column);exit;

	?>
    <input type="hidden" class="column4" id="column4" name="column4" attr='<?php echo $column4; ?>' />
   <?php //echo "<pre>";print_r($column);exit;?>
   <div class="col-md-4 export_total" style="z-index:940;  position: absolute; right: 32px; top: 8px;">
        <div class="table-group-actions pull-right">
        
     <button class="btn btn-sm green exportTxt4" >
                    TXT 
                </button>
             <button class="btn btn-sm red exportCsv4" >
                    CSV 
                </button> 
            <button class="btn btn-sm yellow exportXls4" >
                    Excel 
            </button>
        </div>
    </div>
    <form id="form_tab4" action ="" method="post">
    <table id="jqGrid4" class="jq_table4" attr="<?php echo $table4;?>" order_by="<?php echo $summary_des4['order_by'];?>" summary_des4="<?php echo $summary_des4['description']?>" admin ="<?php echo $summary_des4['user_level'];?>">
    
    </table>	
    <div id="jqGridPager4"></div>
    <input type="hidden" value="" name="actexport4" id="actexport4" />
    <input type="hidden" value="<?php echo $table4 ?>" name="table_name_export4" id="table_name_export4" />
    </form>

  </div> 
<!--END TEST-->

<div class="col-md-12" style="padding-left:10px; margin-top:30px;">
	
    <?php //echo "<pre>";print_r($column);exit;

	?>
    <input type="hidden" class="column5" id="column5" name="column5" attr='<?php echo $column5; ?>' />
   <?php //echo "<pre>";print_r($column);exit;?>
   <div class="col-md-4 export_total" style="z-index:940;  position: absolute; right: 32px; top: 8px;">
        <div class="table-group-actions pull-right">
        
     <button class="btn btn-sm green exportTxt5" >
                    TXT 
                </button>
             <button class="btn btn-sm red exportCsv5" >
                    CSV 
                </button> 
            <button class="btn btn-sm yellow exportXls5" >
                    Excel 
            </button>
        </div>
    </div>
    <form id="form_tab5" action ="" method="post">
    <table id="jqGrid5" class="jq_table5" attr="<?php echo $table5;?>" order_by="<?php echo $summary_des5['order_by'];?>" summary_des5="<?php echo $summary_des5['description']?>" admin ="<?php echo $summary_des5['user_level'];?>">
    
    </table>	
    <div id="jqGridPager5"></div>
    <input type="hidden" value="" name="actexport5" id="actexport5" />
    <input type="hidden" value="<?php echo $table5 ?>" name="table_name_export5" id="table_name_export5" />
    </form>

</div> 

