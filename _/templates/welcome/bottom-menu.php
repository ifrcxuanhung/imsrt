<style>
.label-warning{ background:#4b77be;}
</style>

<div class="row form">
				<!-- BEGIN FORM-->
	<form action="" class="form-horizontal form-row-seperated">
			<div class="form-group">
            	<div class="top-col-md-3">
                	<div id="status"></div>
                	<div class="cbp-l-filters-dropdown cbp-l-filters-dropdown-floated dropdow1" id="js-filters-lightbox-gallery1" style="width:350px !important;">
                        <div class="cbp-l-filters-dropdownWrap border-grey-salsa cbp1" style="position: relative !important;">
                            <div class="cbp-l-filters-dropdownHeader uppercase"><?php if (isset($stk_feed_last[0]['update_time'])) { ?><span id="link_feed"><a href="<?php echo base_url(); ?>jq_loadtable/stk_feed_rt"><i class="icon-settings font-yellow-crusta"></i></a></span>&nbsp; <?php } ?><span id="feed_first"><span class='custom-margin label lable-sm label-danger' id='feed_update_time'><?php echo isset($stk_feed_last[0]['update_time']) ? $stk_feed_last[0]['update_time'] : '';?></span> <span class='custom-margin label lable-sm label-danger' id='feed_time'><?php echo isset($stk_feed_last[0]['time']) ? $stk_feed_last[0]['time'] : '';?></span> <span id='feed_codeint'><?php echo isset($stk_feed_last[0]['code']) ? $stk_feed_last[0]['code'] : '';?></span> <span class='custom-margin-left label lable-sm label-warning' id='feed_last'><?php echo isset($stk_feed_last[0]['last']) ? number_format($stk_feed_last[0]['last'], 3, '.', ',') : '';?></span> </span> </div>
                      
                            <div class="cbp-l-filters-dropdownList cbp12" id="feed_list" style="background-color:#FFF !important;">
                            	<?php 
								$i_feed = 0;
								foreach($stk_feed_last as $value){ if ($i_feed >0){ ?>
                                <div class="cbp-filter-item-active cbp-filter-item uppercase">  <span class='custom-margin label lable-sm label-danger'><?php echo $value['update_time'];?> </span> <span class='custom-margin label lable-sm label-danger'><?php echo $value['time'];?> </span> <?php echo $value['code'];?> <span class='custom-margin-left label lable-sm label-warning'><?php echo number_format($value['last'], 3, '.', ',');?> </span> </div>
                                 <?php } $i_feed++; }?>
                            </div>
                        </div>
                    </div>
        		</div>
   				<div class="top-col-md-3">
                 	<div class="cbp-l-filters-dropdown cbp-l-filters-dropdown-floated dropdow2" id="js-filters-lightbox-gallery2">
                        <div class="cbp-l-filters-dropdownWrap border-grey-salsa cbp2" style="position: relative !important;">
                            <div class="cbp-l-filters-dropdownHeader uppercase"><?php if (isset($cur_feed_rt[0]['time'])) { ?><span id="link_cur"><a href="<?php echo base_url(); ?>jq_loadtable/cur_feed_rt"><i class="icon-settings font-yellow-crusta"></i></a></span>&nbsp; <?php }?><span id="cur_first"><span class='custom-margin label lable-sm label-danger' id='cur_time'><?php echo isset($cur_feed_rt[0]['time']) ? $cur_feed_rt[0]['time'] : '';?></span> <span id='cur_code'><?php echo isset($cur_feed_rt[0]['code']) ? $cur_feed_rt[0]['code'] : '';?></span> <span class='custom-margin-left label lable-sm label-warning' id='cur_conv'><?php echo isset($cur_feed_rt[0]['last']) ? number_format($cur_feed_rt[0]['last'], 3, '.', ',') : '';?></span></span> </div>
                            <div class="cbp-l-filters-dropdownList" id="cur_list" style="background-color:#FFF !important;">
                            	<?php 
								$i_curr = 0;
								foreach($cur_feed_rt as $value_cur){ if ($i_curr >0){ ?>
                                <div class="cbp-filter-item-active cbp-filter-item uppercase">  <span class='custom-margin label lable-sm label-danger'><?php echo $value_cur['time'];?> </span> <?php echo $value_cur['code'];?> <span class='custom-margin-left label lable-sm label-warning'><?php echo number_format($value_cur['last'], 3, '.', ',');?> </span> </div>
                                 <?php } $i_curr++; }?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="top-col-md-3">
                	
                	<div class="cbp-l-filters-dropdown cbp-l-filters-dropdown-floated dropdow3" id="js-filters-lightbox-gallery3" style="width:340px;">
                        <div class="cbp-l-filters-dropdownWrap border-grey-salsa cbp3" style="position: relative !important;">
                            <div class="cbp-l-filters-dropdownHeader uppercase"><?php if (isset($idx_specs_abnormal[0]['codeint'])) { ?><span id="link_specs"><a href="<?php echo base_url(); ?>jq_loadtable/idx_specs_abnormal"><i class="icon-settings font-yellow-crusta"></i></a></span>&nbsp; <?php }?><span id="specs_first"><span id="specs_first"><span class='custom-margin label lable-sm label-danger' id='specs_time'><?php echo isset($idx_specs_abnormal[0]['time']) ? $idx_specs_abnormal[0]['time'] : '';?></span> <span id='specs_codeint'><?php echo isset($idx_specs_abnormal[0]['codeint']) ? $idx_specs_abnormal[0]['codeint'] : '';?></span> <span class='custom-margin-left label lable-sm label-warning' id='specs_dvar'><?php echo isset($idx_specs_abnormal[0]['idx_dvar']) ? (number_format($idx_specs_abnormal[0]['idx_dvar'], 2, '.', ',').' %') : '';?></span></span></div>
                      
                            <div class="cbp-l-filters-dropdownList" id="specs_list" style="background-color:#FFF !important;">
                            
                            	<?php 
								$i_specs = 0;
								foreach($idx_specs_abnormal as $value){ if ($i_specs >0){ ?>
                                <div class="cbp-filter-item-active cbp-filter-item uppercase">  <span class='custom-margin label lable-sm label-danger'><?php echo $value['time'];?> </span> <?php echo $value['codeint'];?> <span class='custom-margin-left label lable-sm label-warning'><?php echo number_format($value['idx_dvar'], 2, '.', ',');?> %</span> </div>
                                 <?php } $i_specs++; }?>
                            </div>
                        </div>
                    </div>
        		</div>
                <div class="top-col-md-3-right">
                    <?php $today = getdate(); ?>
            		<script>
                        var d = new Date(<?php echo $today['year'].",".$today['mon'].",".$today['mday'].",".$today['hours'].",".$today['minutes'].",".$today['seconds']; ?>);
                        setInterval(function() {
                            d.setSeconds(d.getSeconds() + 1);
            				var hours   = d.getHours();
            				var minutes = d.getMinutes();
            				var seconds = d.getSeconds()
            			
            				if (hours   < 10) {hours   = "0"+hours;}
            				if (minutes < 10) {minutes = "0"+minutes;}
            				if (seconds < 10) {seconds = "0"+seconds;}
                            $('#timer').text((hours +':' + minutes + ':' + seconds));
                        }, 1000);
                    </script> 
                    <a class="btn red timer" style="height: auto; ">
                         <i class="fa fa-calendar" style="color: #FFF; margin-right:5px; float: left;"></i><?php echo date("Y-m-d"); ?> <span id="timer"><?php echo date("H:i:s"); ?></span>
                    </a>
                </div>
                <div class="top-col-md-3-right">
                    <a class="btn <?php echo $setting_rt['value']=='CLOSED' ? 'red' : 'blue'; ?>" id="class_ims_status" style="height: auto; ">
                        <span id='ims_status'><?php echo $setting_rt['value']; ?></span>
                    </a>
                
                    <a class="btn blue">
                      <span id="ims_start"><?php echo $setting_rt_start['value']; ?></span>
                      - <span id="ims_end"><?php echo $setting_rt_end['value']; ?></span>
                      <span id="ims_fre"><?php echo "(".$setting_rt_fre['value'].")"; ?></span>
                    </a>
                </div>
            </div><!--end form-group -->									
	</form><!-- END FORM-->
    <!--form method="GET" action="page_general_search.html" class="search-form">
    	
    </form>
    
     <div class="search-form">
        
    </div-->
    
</div>