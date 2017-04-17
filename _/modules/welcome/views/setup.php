<?php    if(!$this->session->userdata_vnefrc('user_id')){
		redirect(base_url().'start');	
	}?>
<style>
#sm2-container{height:0px; overflow:hidden;}
.no-js #loader { display: none;  }
.js #loader { display: block; position: absolute; left: 100px; top: 0; }


</style>

<div class="se-pre-con"></div>
<div class="col-md-6 ">
	
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-cog"></i> SETUP
            </div>
            <div class="tools">
                <a class="collapse" href="" data-original-title="" title="">
                </a>
                <a class="config" data-toggle="modal" href="#portlet-config" data-original-title="" title="">
                </a>
                <a class="reload" href="" data-original-title="" title="">
                </a>
                <a class="remove" href="" data-original-title="" title="">
                </a>
            </div>
        </div>
        
        <div class="portlet-body form">
            <form class="form-horizontal" role="form" id="form-setup">
            	<div class="alert alert-success display-hide" style="display: none;">
                        <button data-close="alert" class="close"></button>
                        Save successfull
                </div>
                <div class="form-body">
                    <div class="form-group">
                        <label class="col-md-4 control-label" style="font-weight:bold;">Date</label>
                        <div class="col-md-8">
                            <div>
                                <input type="text" id="calculation_date" name="calculation_date" value="<?php echo $calculation_date ?>" class="form-control date-picker" placeholder="yyyy/mm/dd"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" style="font-weight:bold;">Next date</label>
                        <div class="col-md-8">
                            <div>
                                <input type="text" id="next_date" name="next_date" value="<?php echo $next_date ?>" class="form-control date-picker" placeholder="yyyy/mm/dd"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" style="font-weight:bold;">Start time 1</label>
                        <div class="col-md-8">
                            <div>
                                <input type="text" id="start_time_1" name="start_time_1" value="<?php echo $start_time_1; ?>" class="form-control" placeholder="hh:mm:ss"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" style="font-weight:bold;">End time 1</label>
                        <div class="col-md-8">
                            <div>
                                <input type="text" id="end_time_1" name="end_time_1" value="<?php echo $end_time_1; ?>" class="form-control" placeholder="hh:mm:ss"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" style="font-weight:bold;">Start time 2</label>
                        <div class="col-md-8">
                            <div>
                                <input type="text" id="start_time_2" name="start_time_2" value="" class="form-control" placeholder="hh:mm:ss"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" style="font-weight:bold;">End time 2</label>
                        <div class="col-md-8">
                            <div>
                                <input type="text" id="end_time_2" name="end_time_2" value="" class="form-control" placeholder="hh:mm:ss"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" style="font-weight:bold;">Frequency</label>
                        <div class="col-md-8">
                            <div>
                                <input type="text" id="frequency" name="frequency" value="<?php echo $frequency; ?>" class="form-control" placeholder="mm:ss"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" style="font-weight:bold;">Feed Frequency</label>
                        <div class="col-md-8">
                            <div>
                                <input type="text" id="feed_frequency" name="feed_frequency" value="<?php echo $feed_frequency; ?>" class="form-control" placeholder="mm:ss"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" style="font-weight:bold;">Auto download feed</label>
                        <div class="col-md-8">
                            <div>
                                <input type="text" id="auto_download_feed" name="auto_download_feed" value="<?php echo $auto_download_feed; ?>" class="form-control" placeholder="1 or 0"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" style="font-weight:bold;">The number of calculations after close</label>
                        <div class="col-md-8">
                            <div>
                                <input type="text" id="after_close_calculation" name="after_close_calculation" value="<?php echo $after_close_calculation; ?>" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" style="font-weight:bold;">Max difference of shares</label>
                        <div class="col-md-8">
                            <div>
                                <input type="text" id="max_diff_shares" name="max_diff_shares" value="<?php echo $keys["max_diff_shares"]; ?>" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" style="font-weight:bold;">Max difference of mcap </label>
                        <div class="col-md-8">
                            <div>
                                <input type="text" id="max_diff_mcap" name="max_diff_mcap" value="<?php echo $keys["max_diff_mcap"]; ?>" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" style="font-weight:bold;">Max difference of dcap </label>
                        <div class="col-md-8">
                            <div>
                                <input type="text" id="max_diff_dcap" name="max_diff_dcap" value="<?php echo $keys["max_diff_dcap"]; ?>" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" style="font-weight:bold;">Max difference of price </label>
                        <div class="col-md-8">
                            <div>
                                <input type="text" id="max_diff_price" name="max_diff_price" value="<?php echo $keys["max_diff_price"]; ?>" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" style="font-weight:bold;">Max difference of divisor </label>
                        <div class="col-md-8">
                            <div>
                                <input type="text" id="max_diff_divisor" name="max_diff_divisor" value="<?php echo $keys["max_diff_divisor"]; ?>" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" style="font-weight:bold;">Max difference of last </label>
                        <div class="col-md-8">
                            <div>
                                <input type="text" id="max_diff_last" name="max_diff_last" value="<?php echo $keys["max_diff_last"]; ?>" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" style="font-weight:bold;">Max difference of pclose </label>
                        <div class="col-md-8">
                            <div>
                                <input type="text" id="max_diff_pclose" name="max_diff_pclose" value="<?php echo $keys["max_diff_pclose"]; ?>" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" style="font-weight:bold;">Max difference of convert currency </label>
                        <div class="col-md-8">
                            <div>
                                <input type="text" id="max_diff_conv" name="max_diff_conv" value="<?php echo $keys["max_diff_conv"]; ?>" class="form-control" />
                            </div>
                        </div>
                    </div>
                    
                    
                    
                    
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-4 col-md-8">
                        	<input type="hidden" id="start1" value="<?php echo $start_time_1; ?>" />
                            <input type="hidden" id="end1" value="<?php echo $end_time_1; ?>" />
                            <input type="hidden" id="fre" value="<?php echo $frequency; ?>" />
                            <button class="btn default cancel_setup" type="button">Cancel</button>
                            <button class="btn blue save_setup" type="button">Submit</button>
                        </div>
                    </div>
                </div>
                </div>
            </form>
        </div>
    </div>
    </div>



<div class="col-md-6">
	<!-- BEGIN SAMPLE TABLE PORTLET-->
	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-comments"></i>STEPS
			</div>
			<div class="tools">
				<a href="javascript:;" class="collapse">
				</a>
				<a href="#portlet-config" data-toggle="modal" class="config">
				</a>
				<a href="javascript:;" class="reload">
				</a>
				<a href="javascript:;" class="remove">
				</a>
			</div>
		</div>
		<div class="portlet-body">
			<div class="table-scrollable">
				<table class="table table-striped table-bordered table-advance table-hover">
				<thead>
				<tr>
					
					<th style="background:#cb5a5e; color:#fff; text-align:center; font-weight:bold;">
						Process
					</th>
					<th style="background:#cb5a5e; color:#fff; text-align:center; font-weight:bold;">
						 Times
					</th>
					
				</tr>
				</thead>
				<tbody>
				<tr>
					
					<td>
                
                <button class="btn blue initialisation" type="button">UPDATE PROCESS</button>

					</td>
					<td>
						 <?php if(isset($settup_process)) echo $settup_process[1]['times'];?>
					</td>
					
				</tr>
                <tr>
					
					<td>
				
                <button class="btn blue open-calculation" type="button">OPEN THE INDEXES CALCULATION</button>
					</td>
					<td>
						 <?php if(isset($settup_process)) echo $settup_process[2]['times'];?>
					</td>
					
				</tr>
                
                 <tr>	
					<td>
                        <button class="btn blue close-calculation" type="button">CLOSE THE INDEXES CALCULATION</button>
					</td>
					<td>
						 <?php if(isset($settup_process)) echo $settup_process[3]['times'];?>
					</td>
				</tr>
                <tr>
					<td>
                    <button class="btn blue backup_eod" type="button">BACKUP EOD</button>
					</td>
					<td>
						 <?php if(isset($settup_process)) echo $settup_process[10]['times'];?>
					</td>
				</tr>
                
                 <!--<tr>
					
					<td>
				
                <button class="btn blue switch-calculation" type="button">SWITCH NEXT DAY</button>
					</td>
					<td>
						<?php if(isset($settup_process)) echo $settup_process[4]['times'];?>
					</td>
					
				</tr>-->
                
                 <tr>
					<td>
                    <button class="btn blue statistics-update" type="button">UPDATE STATISTICS</button>
					</td>
					<td>
						 <?php if(isset($settup_process)) echo $settup_process[5]['times'];?>
					</td>
				</tr>
                 <!--<tr>
					
					<td>
				
               <button class="btn blue backup-data" type="button">BACKUP</button>
					</td>
					<td>
						 <?php if(isset($settup_process)) echo $settup_process[8]['times'];?>
					</td>
					
				</tr>
                
                 <tr>
					
					<td>
				
                <button class="btn blue opennew-calculation" type="button">IMPORT .TXT FILE FOR OPEN</button>
					</td>
					<td>
						 <?php if(isset($settup_process)) echo $settup_process[6]['times'];?>
					</td>
					
				</tr>-->
                
                 <tr>
					
					<td>
				
                 <button class="btn blue next-calculation" type="button">CREATE NEXT DAY DATA</button>
					</td>
					<td>
						 <?php if(isset($settup_process)) echo $settup_process[7]['times'];?>
					</td>
					
				</tr>
                
                <tr>
					
					<td>
				
                 <button class="btn blue clean-intraday" type="button">TEST CLEAN DATA</button>
					</td>
					<td>
						 
					</td>
				</tr> 
                <tr>
                    <td>
                        <button class="btn blue update_pclose" type="button">UPDATE PCLOSE VNDMI</button>
					</td>
						<td>
						 <?php if(isset($settup_process)) echo $settup_process[9]['times'];?>
					</td>
				</tr>
				
				</tbody>
				</table>
			</div>
		</div>
	</div>
	<!-- END SAMPLE TABLE PORTLET-->
</div>
<!--MODAL VIEW USER -->
<div id="modal_view_user" class="modal bs-modal-md fade" tabindex="-1" aria-hidden="true" data-width="500">
	<div class="modal-dialog">
	  <div class="modal-content">
	    <div class="modal-header" style="background-color: #E4AD36;">
	      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
	      <h4 class="modal-title"><?php echo trans('DELETE DATA DURING A PERIOD'); ?></h4>
	    </div>
	    <form id="form_view_user" role="form" class="form-horizontal" action="" method="post">
	      <div class="modal-body">
	        <div class="scroller" style="height:20%;" data-always-visible="1" data-rail-visible1="1">
	          <div class="row">
	            <div class="col-md-12">
	              <div class="form-body">
                    <div class="alert alert-danger display-hide" style="display: none;">
                            <button data-close="alert" class="close"></button>
                            <?php echo trans('Invalid'); ?>
                        </div>
                        <div class="alert alert-success display-hide" style="display: none;">
                            <button data-close="alert" class="close"></button>
                            <?php echo trans('Save successfull'); ?>
                    </div>
	                <div class="form-group">
	                  <label class="col-md-3 control-label">Start time <span class="required" aria-required="true"> * </span></label>
	                  <div class="col-md-6">
                      <input id="start_time" class="form-control" type="text" value="" name="start_time">
                        </div>
	                </div>	                
	                <div class="form-group">
	                  <label class="col-md-3 control-label">End time <span class="required" aria-required="true"> * </span> </label>
	                  <div class="col-md-6">
                      <input id="end_time" class="form-control" type="text" value="" name="end_time">
	                  </div>
	                </div>
                    
                   
	              </div>
	            </div>
	          </div>
	        </div>
	      </div>
	      <div class="modal-footer">
	        <a href="#" class="btn default" data-dismiss="modal"><?php echo trans('Cancel'); ?></a>
	        <input type="button" class="btn green cleandata" value="<?php echo trans('Save'); ?>"/>
	      </div>
	    </form>
	  </div>
	</div>
</div>
<!-- END MODAL VIEW USER -->


<div id="modal_view_user2" class="modal bs-modal-md fade" tabindex="-1" aria-hidden="true" data-width="500">
	<div class="modal-dialog">
	  <div class="modal-content">
	    <div class="modal-header" style="background-color: #E4AD36;">
	      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
	      <h4 class="modal-title"><?php echo trans('Do you want open new day? '); ?></h4>
	    </div>
	    <form id="form_view_user" role="form" class="form-horizontal" action="" method="post">
	      <div class="modal-body">
	        <div class="scroller" style="height:20%;" data-always-visible="1" data-rail-visible1="1">
	          <div class="row">
	            <div class="col-md-12">
	              <div class="form-body">
	                <div class="form-group">
	                  <label class="col-md-6 control-label">Truncate data intraday</label>
                      <input id="truncate" class="form-control" type="checkbox" value="" checked="checked" name="truncate">
	                </div>	                
	                                   
	              </div>
	            </div>
	          </div>
	        </div>
	      </div>
	      <div class="modal-footer">
          <?php if ($calculation_date != date("Y-m-d")) {
            ?>
            <label class="col-md-8 control-label" style="background-color: red; text-align: left; color: yellow; ">
            <?php echo trans('Warning: Calculate date difference system date!!!'); ?></label>
            <?php
          }?>
            <a href="#" class="btn default" data-dismiss="modal"><?php echo trans('Cancel'); ?></a>
	        <input type="button" class="btn green reopen" value="<?php echo trans('OK'); ?>"/>

	      </div>
	    </form>
	  </div>
	</div>
</div>
