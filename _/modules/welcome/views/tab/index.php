<!-- BEGIN PAGE HEADER-->


<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<div class="row">
<div class="col-md-12">
    <div class="alert alert-success fade in" style="display: none;">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
    </div>
</div>
<div class="col-md-12" style="float: none !important;">
<!--<h3 class="page-title" style=" font-weight: bold !important;"><?php trans($title); ?></h3>-->
<h3 style="margin-bottom: -18px; margin-top: 30px;"><?php trans($title);?></h3>
<div class="actions" style="float: right;">
<a class="btn btn-xs" href="<?php echo base_url(); ?>table"><button class="btn btn-sm blue" ><?php trans('our_database'); ?></button></a>
	<button class="btn btn-sm green exportTxt" >
			TXT 
		</button>
     <button class="btn btn-sm red exportCsv" >
			CSV 
		</button> 
    <button class="btn btn-sm yellow exportXls" >
			Excel 
	</button>
    <!--<a class="btn default btn-xs green view-tab-modal-edit" keys="" table_name="<?php echo $tab_name ?>" href="#tab_modal" data-toggle="modal">
                                       <span class="hidden-480">Add new </span><i class="fa fa-plus"></i> 
    </a>-->
    <?php if($feedback== 1) {?>
    <button id="feedback_popup" class="btn btn-sm green" href="#modal_view_feedback" data-toggle="modal">
                	Feedback <i class="icon-envelope-open"></i>
                </button>
    <?php } ?>
              
</div>
</div>
<div class="col-md-12" >
    <form id="form_tab" action ="" method="post">
         <table class="table table-striped table-bordered table-hover" id="tab">
               <thead>
					<tr role="row" class="heading">
						<?php
						$colWidth = 0;
						$colNoWidth = 0;
						$sumWidth = 0;
						$sum = 0;
						foreach ($headers as $item) {
							if(is_numeric($item['width']) && ($item['width'] >=0)) {
								$colWidth ++;
								$sumWidth += $item['width'];
							}
							else {
								$colNoWidth ++;
							}
							$sum ++;
						}
						$divWidth = $colWidth/$sum*90;
						$divNoWidth = $colNoWidth / $sum * 90;
						foreach ($headers as $item) {
							if($item['active'] == 1) {
								switch($item['align']) {
									case 'L':
										$align = ' class="align-left"';
										break;
									case 'R':
										$align = ' class="align-right"';
										break;
									default:
										$align = ' class="align-center"';
										break;
								}
								$width = (is_numeric($item['width']) && ($item['width'] >=0)) ? ($item['width'] / $sumWidth * $divWidth) : (1/$colNoWidth * $divNoWidth);
        					    echo '<th width="'.$width.'%"' .$align.'><b data-toggle="tooltip" data-placement="right" title="'.(isset($item['tips_en']) ? strip_tags($item['tips_en']): '' ).'"><font color="#FFFFFF">'.trans($item['title'],TRUE).'</font></b></th>';
							}
						}
						?>
						<th class="align-center" width="10%"><font color="#FFFFFF"><?php trans('Action') ?></font></th>
      
					</tr>
					<tr role="row" class="filter">
						<?php
						foreach ($headers as $item) {
							echo '<td>';
							echo $item['filter'];
							echo '</td>';
						}
						?>
						<td>
                            <center>
							<div class="margin-bottom-5">
								<button class="btn btn-icon-only yellow filter-submit margin-bottom"><i class="fa fa-search"></i></button>
							
							<button class="btn btn-icon-only red filter-cancel"><i class="fa fa-times"></i></button> </div></center>
						</td>
					</tr>
				</thead>
                <tbody style="font-size: 13px !important;"></tbody>
        </table>
        <input type="hidden" value="<?php echo $tab_name ?>" name="tab_name" id="tab_name" />
        <input type="hidden" value="<?php echo $tab_note ?>" name="note" id="note" />
        <input type="hidden"  value="<?php echo $value_filter?>" id="value_filter" name="value_filter" />
       
        <input type="hidden" value="" name="act" id="act" />
      </form>
            <div class="clearfix"></div>
     </div>
        <div class="clearfix"></div>
</div>
<div class="modal fade" id="tab_modal" role="basic" aria-hidden="true">
	<div class="page-loading page-loading-boxed">
		<img src="<?php echo template_url(); ?>global/img/loading-spinner-grey.gif" alt="" class="loading"/>
		<span>
		&nbsp;&nbsp;Loading... </span>
	</div>
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
		</div>
	</div>
</div>
<!-- BEGIN MODAL FEEDBACK -->
<div id="modal_view_feedback" class="modal fade" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-lg">
    	 <div class="modal-content">
                        <!-- BEGIN VALIDATION STATES-->
                        <div class="portlet">
                            <div class="modal-header" style="background-color: #44b6ae !important">
                                <div class="caption">
                                <button class="close" aria-hidden="true" data-dismiss="modal" type="button"></button>
                                    Feedback
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <!-- BEGIN FORM-->
                                <form class="form-horizontal" id="form_sample_1" action="#" novalidate="novalidate">
                                    <div class="form-body">
                                    	<p class="feedback_warning"></p>
                                        <div class="form-group has-error">
                                            <label class="control-label col-md-3"><?php trans('Name') ?> <span class="required" aria-required="true">
                                            * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="feedback_name" name="feedback_name"/>
                                            </div>
                                        </div>
                                        <div class="form-group has-error">
                                            <label class="control-label col-md-3"><?php trans('Email') ?> <span class="required" aria-required="true">
                                            * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="feedback_email" id="feedback_email"/>
                                            </div>
                                        </div>
                                        <div class="form-group has-error">
                                            <label class="control-label col-md-3"><?php trans('Message') ?> <span class="required" aria-required="true">
                                            * </span>
                                            </label>
                                            <div class="col-md-6">
                                            	<textarea name="feedback_message" class="form-control" rows="3=6" id="feedback_message"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group has-error">
                                            <label class="control-label col-md-3">Confirmation code 
                                            </label>
                                            <div class="col-md-6">
                                            	<img src="<?php echo base_url(); ?>captcha?cid=contact" style="margin:6px 0px 10px 2px; float:left;" /><br class="clear" />
                                                <input type="text" class="form-control" name="feedback_code" id="feedback_code"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                            	<input type="hidden" name="feedback_receiving_email" value="contact@ifrc.vn" />
                                                <button class="btn green button-sendfeedback" type="button"><i class="fa fa-mail-forward"></i> <?php trans('Send') ?></button>
                                                <button class="btn default" type="button" data-dismiss="modal"><?php trans('Cancel') ?></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <!-- END FORM-->
                            </div>
                        </div>
                        <!-- END VALIDATION STATES-->
                    </div>
    </div>
</div>
<!-- END MODAL FEEDBACK -->
