<?php if (!$this->session->userdata_vnefrc('user_id')) {
    redirect(base_url() . 'start');
} ?>
<style>
#sm2-container{height:0px; overflow:hidden;}
.no-js #loader { display: none;  }
.js #loader { display: block; position: absolute; left: 100px; top: 0; }


</style>

<div class="col-md-6">
	<!-- BEGIN SAMPLE TABLE PORTLET-->
	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-comments"></i><?php trans('UPLOAD'); ?>
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
                    <th style="background:#cb5a5e; color:#fff; text-align:center; font-weight:bold;">
						 Undo
					</th>
					<th style="background:#cb5a5e; color:#fff; text-align:center; font-weight:bold;">
						 Times
					</th>
					
				</tr>
				</thead>
				<tbody>
                
                <tr>	
					<td>
                <button class="btn blue update-imsrt-day" type="button"><?php echo  'Update imsrt day'; ?></button>
					</td>
					<td>
						 <?php if (isset($upload_process))    echo $upload_process[1]['times']; ?>
					</td>
                    <td>
                        
					</td>
					<td>
						 <?php if (isset($upload_process))    echo $upload_process[6]['times']; ?>
					</td>                    
				</tr>
                
				<tr>	
					<td>
                <button class="btn blue local-daily" type="button"><?php echo  trans($upload_process[1]['process']); ?></button>
					</td>
					<td>
						 <?php if (isset($upload_process))    echo $upload_process[1]['times']; ?>
					</td>
                    <td>
                        <button class="btn red undo-daily" type="button"><?php echo trans($upload_process[6]['process']); ?></button>
					</td>
					<td>
						 <?php if (isset($upload_process))    echo $upload_process[6]['times']; ?>
					</td>                    
				</tr>
                <tr>	
					<td>
                <button class="btn blue local-gwc" type="button"><?php echo trans($upload_process[2]['process']); ?></button>
					</td>
					<td>
						 <?php if (isset($upload_process))    echo $upload_process[2]['times']; ?>
					</td>
                    <td>
                        <button class="btn red undo-gwc" type="button"><?php echo trans($upload_process[7]['process']); ?></button>
					</td>
					<td>
						 <?php if (isset($upload_process))    echo $upload_process[7]['times']; ?>
					</td> 	
				</tr>
                 <tr>	
					<td>
                <button class="btn blue host-daily" type="button"><?php echo trans($upload_process[3]['process']); ?></button>
					</td>
					<td>
						 <?php if (isset($upload_process))    echo $upload_process[3]['times']; ?>
					</td>
                    <td></td>
                    <td></td>		
				</tr> 
                 <tr>
					<td>
                <button class="btn blue host-gwc" type="button"><?php echo trans($upload_process[4]['process']); ?></button>
					</td>
					<td>
						<?php if (isset($upload_process))    echo $upload_process[4]['times']; ?>
					</td>
                    <td></td>
                    <td></td>		
				</tr>
                 <tr>	
					<td>
                <button class="btn blue update_all" type="button"><?php echo trans($upload_process[5]['process']); ?></button>
					</td>
					<td>
						 <?php if (isset($upload_process))    echo $upload_process[5]['times']; ?>
					</td>
                    <td></td>
                    <td></td>		
				</tr>
                
                <tr>	
					<td>
                <button class="btn blue upload_data" type="button"><?php echo trans($upload_process[8]['process']); ?></button>
					</td>
					<td>
						 <?php if (isset($upload_process))    echo $upload_process[8]['times']; ?>
					</td>
                    <td></td>
                    <td></td>		
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
	      <h4 class="modal-title"><?php echo trans('UPLOAD DATA FOR DAY'); ?></h4>
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
	                  <label class="col-md-3 control-label">Start Date <span class="required" aria-required="true"> * </span></label>
	                  <div class="col-md-6">
                        <input type="text" id="start_date" name="start_date" value="" class="form-control date-picker" placeholder="yyyy-mm-dd"/>
                       </div>

	                </div>
                    	                
	                <div class="form-group">
	                  <label class="col-md-3 control-label">End Date <span class="required" aria-required="true"> * </span> </label>
	                  <div class="col-md-6">
                      <input id="end_date" class="form-control date-picker" type="text" value="" name="end_time"  placeholder="yyyy-mm-dd"/>
	                  </div>
	                </div>
                    
                   
	              </div>
	            </div>
	          </div>
	        </div>
	      </div>
	      <div class="modal-footer">
	        <a href="#" class="btn default" data-dismiss="modal"><?php echo trans('Cancel'); ?></a>
	        <input type="button" class="btn green btnupload" value="<?php echo trans('Upload'); ?>"/>
	      </div>
	    </form>
	  </div>
	</div>
</div>
<!-- END MODAL VIEW USER -->