<!-- ajax -->
<style>
th{ color:#FFF;}
</style>
<div id="status_modal" class="modal fade" tabindex="-1"  aria-hidden="true">
    <div class="page-loading page-loading-boxed">
		<img src="<?php echo template_url(); ?>global/img/loading-spinner-grey.gif" alt="" class="loading"/>
		<span>
		&nbsp;&nbsp;Loading... </span>
	</div>
	<div class="modal-dialog">
		<div class="modal-content">
		</div>
	</div>
</div>
<div class="modal fade" id="save_script" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
    	<div class="modal-content">
        	<div class="modal-header">
            	<button aria-hidden="true" data-dismiss="modal" class="bootbox-close-button close" type="button">×</button>
                <h4 class="modal-title">Script title </h4>
            </div>
       		<div class="modal-body">
            	<div class="bootbox-body">
                	<form class="bootbox-form" id="form_save_script">
                    	<div class="alert alert-success fade in" style="display: none;" id="save-script-success">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                        </div>
                    	<input type="text" autocomplete="off" class="bootbox-input bootbox-input-text form-control" id="title_save" name="title_save">
                    </form>
                </div>
            </div>
            <div class="modal-footer">
            	<button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary btn-save-script" type="button" >OK</button>
            </div>
        </div>
    </div>
</div>
<div class="modal bs-modal-lg fade" id="load_script" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    	<div class="modal-content">
        	<div class="modal-header">
            	<button aria-hidden="true" data-dismiss="modal" class="bootbox-close-button close" type="button">×</button>
                <h4 class="modal-title">All your script</h4>
            </div>
       		<div class="modal-body">
            	<div class="bootbox-body">
                	<form class="bootbox-form" id="form_save_script">
                    	<div class="alert alert-success fade in" style="display: none;" id="save-delete-success">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                        </div>
                    	<table class="table table-striped table-bordered table-hover" id="table_load_script">
                               <thead>
                                    <tr role="row" class="heading">
                                        <?php
                                        $colWidth = 0;
                                        $colNoWidth = 0;
                                        $sumWidth = 0;
                                        $sum = 0;
                                        foreach ($headers_table_script as $item) {
                                            if($item['active'] == 1) {
                                                if(is_numeric($item['width']) && ($item['width'] >=0)) {
                                                    $colWidth ++;
                                                    $sumWidth += $item['width'];
                                                }
                                                else {
                                                    $colNoWidth ++;
                                                }
                                                $sum ++;
                                            }
                                        }
                                        $divWidth = $colWidth/$sum*85;
                                        $divNoWidth = $colNoWidth / $sum * 85;	
                                        foreach ($headers_table_script as $item) {
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
                                                echo '<th width="'.$width.'%"' .$align.'>'.trans($item['title'],TRUE).'</th>';
                                                
                                            }
                                        }
                                        ?>
                                        <th class="align-center" width="15%"><?php trans('action') ?></th>
                                    </tr>
                                    <tr role="row" class="filter">
                                        <?php
                                        foreach ($headers_table_script as $item) {
                                            if($item['active'] == 1) {
                                                echo '<td>';
                                                echo $item['filter'];
                                                echo '</td>';
                                            }
                                        }
                                        ?>
                                        <td>
                                            <center>
                                            <div class="margin-bottom-5">
                                                <button class="btn btn-icon-only yellow filter-submit margin-bottom"><i class="fa fa-search"></i></button>
                                                <button class="btn btn-icon-only red filter-cancel"><i class="fa fa-times"></i></button> </div>
                                               </center>
                                        </td>
                                    </tr>
                              </thead>
                                <tbody style="font-size: 13px !important;"></tbody>
                        </table>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
            	<button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- /.modal -->
<div class="row">    
	<div class="col-md-12" id="form_wizard_1">
            	<div class="alert alert-warning" style="display: block;">
                    <?php echo $information[0]['info']; ?>
                    <a href="#load_script" class="btn blue nav navbar-nav navbar-right load-script" data-toggle="modal">
                    <i class="fa fa-download"></i>  Load your script
                    </a>
                    <a href="#" class="btn red nav navbar-nav navbar-right load-none-script">
                    <i class="fa fa-download"></i>  Cancel load script
                    </a>
                   <!-- 
                    <a href="javascript:;" class="btn default nav navbar-nav navbar-right button-previous">
                    <i class="m-icon-swapleft"></i> Back </a>
                    <a href="javascript:;" class="btn blue nav navbar-nav navbar-right button-next">
                    Continue <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                    <a href="javascript:;" class="btn green nav navbar-nav navbar-right button-submit">
                    Submit <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                    <a href="javascript:;" class="btn red nav navbar-nav navbar-right button-calculator">
                    <i class="fa fa-calculator"></i> Calculator
                    </a>-->
                </div>
				<form action="#" class="form-horizontal" id="submit_form" method="POST">
					<div class="form-wizard">
						<div class="form-body">
							<ul class="nav nav-pills nav-justified steps">
								<li>
									<a href="#tab1" data-toggle="tab" class="step">
									<span class="number">
									1 </span>
									<span class="desc">
									<i class="fa fa-check"></i> <?php echo $information[1]['tittle_en']; ?> </span>
									</a>
								</li>
								<li>
									<a href="#tab2" data-toggle="tab" class="step">
									<span class="number">
									2 </span>
									<span class="desc">
									<i class="fa fa-check"></i> <?php echo $information[2]['tittle_en']; ?> </span>
									</a>
								</li>
								<li>
									<a href="#tab3" data-toggle="tab" class="step active">
									<span class="number">
									3 </span>
									<span class="desc">
									<i class="fa fa-check"></i> <?php echo $information[3]['tittle_en']; ?> </span>
									</a>
								</li>
								<li>
									<a href="#tab4" data-toggle="tab" class="step">
									<span class="number">
									4 </span>
									<span class="desc">
									<i class="fa fa-check"></i> <?php echo $information[4]['tittle_en']; ?> </span>
									</a>
								</li>
                                <li>
									<a href="#tab5" data-toggle="tab" class="step">
									<span class="number">
									5 </span>
									<span class="desc">
									<i class="fa fa-check"></i> <?php echo $information[5]['tittle_en']; ?> </span>
									</a>
								</li>
							</ul>
							<div id="bar" class="progress progress-striped" role="progressbar">
								<div class="progress-bar progress-bar-success">
								</div>
							</div>
							<div class="tab-content">
								<div class="alert alert-danger display-none">
									<button class="close" data-dismiss="alert"></button>
									You have some form errors. Please check below.
								</div>
								<div class="alert alert-success display-none">
									<button class="close" data-dismiss="alert"></button>
									Your form validation is successful!
								</div>
								<div class="tab-pane active" id="tab1">
                                	<div class="alert alert-danger" style="display: block;">
										<?php echo $information[1]['info']; ?>
                                    </div>
                                    <div class="form-group">
                                        <form id="form_literature_reviewer" action ="" method="post" style="font-size: 12px !important;">
                                        <div class="col-md-8">
                                        <div class="col-md-13 align-right"> 
                                            
                                        </div>
                                            <input class="hide" name="table" id="tablestep1" value="efrc_publications" />
                                                 <table class="table table-striped table-bordered table-hover" id="literature_reviewer">
                                                       <thead>
                                        					<tr role="row" class="heading">
                                                            <th width="2%">
                    											<input type="checkbox" class="group-checkable"/>
                    										</th>
                                        						<?php
																$colWidth = 0;
																$colNoWidth = 0;
																$sumWidth = 0;
																$sum = 0;
																foreach ($headers_table_step1 as $item) {
																	if($item['active'] == 1) {
																		if(is_numeric($item['width']) && ($item['width'] >=0)) {
																			$colWidth ++;
																			$sumWidth += $item['width'];
																		}
																		else {
																			$colNoWidth ++;
																		}
																		$sum ++;
																	}
																}
																$divWidth = $colWidth/$sum*90;
																$divNoWidth = $colNoWidth / $sum * 90;	
                                        						foreach ($headers_table_step1 as $item) {
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
        																echo '<th width="'.$width.'%"' .$align.'>'.trans($item['title'],TRUE).'</th>';
																		
                                        							}
                                        						}
                                        						?>
                                        						<th class="align-center" width="10%"><?php trans('action') ?></th>
                                        					</tr>
                                        					<tr role="row" class="filter">
                                                                <td>
										                        </td>
                                        						<?php
                                        						foreach ($headers_table_step1 as $item) {
                                        							if($item['active'] == 1) {
                                        								echo '<td>';
                                        								echo $item['filter'];
                                        								echo '</td>';
                                        							}
                                        						}
                                        						?>
                                        						<td>
                                                                    <center>
                                        							<div class="margin-bottom-5">
                                        								<button class="btn btn-icon-only yellow filter-submit margin-bottom"><i class="fa fa-search"></i></button>
                                        							    <button class="btn btn-icon-only red filter-cancel"><i class="fa fa-times"></i></button> </div>
                                                                       </center>
                                        						</td>
                                        					</tr>
                                        			  </thead>
                                                      <tbody></tbody>
                                             </table>
                                         
                                         </div>
                                         <div class="col-md-4">
    
                                               <table class="table table-striped table-bordered table-hover dataTable" id="table_temp_1">
                                                    <thead>
                                                        <tr class="heading">
                                                        <th style="width:3%;"><a class="btn btn-xs red-intense" style="margin: 0px !important;" href="javascript:;" id="saveas_tabletemp1"><i class="fa fa-plus icon-white"></i> Add </a></th>
                                                        <th style="width:97%;"><?php echo trans("Selected items", TRUE); ?></th>
                                                        </tr>
                                                    </thead>
                                                        
                                                    <tbody></tbody>    
                                               </table>  
                                         </div>
                                         </form>
									</div>
								</div>
								<div class="tab-pane" id="tab2">
                                	<div class="alert info-demo-step" style="display: block;">
										<?php echo $information[2]['info']; ?>
                                    </div>
									<div class="form-group">
                                    <form id="form_data_construction" action ="" method="post" style="font-size: 12px !important;">
                                        <div class="col-md-8">
                                                <input class="hide" name="table" id="tablestep2" value="efrc_demo_idx_ref" />
                                                     <table class="table table-striped table-bordered table-hover" id="data_construction">
                                                           <thead>
                                            					<tr role="row" class="heading">
                                                                <th width="2%">
                        											<input type="checkbox" class="group-checkable"/>
                        										</th>
                                            						<?php
																	$colWidth = 0;
																	$colNoWidth = 0;
																	$sumWidth = 0;
																	$sum = 0;
																	foreach ($headers_table_step2 as $item) {
																		if($item['active'] == 1) {
																			if(is_numeric($item['width']) && ($item['width'] >=0)) {
																				$colWidth ++;
																				$sumWidth += $item['width'];
																			}
																			else {
																				$colNoWidth ++;
																			}
																			$sum ++;
																		}
																	}
																	$divWidth = $colWidth/$sum*90;
																	$divNoWidth = $colNoWidth / $sum * 90;	
                                            						foreach ($headers_table_step2 as $item) {
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
        																echo '<th width="'.$width.'%"' .$align.'>'.trans($item['title'],TRUE).'</th>';
                                            							}
                                            						}
                                            						?>
                                            						<th class="align-center" width="10%"><?php trans('action') ?></th>
                                            					</tr>
                                            					<tr role="row" class="filter">
                                                                    <td>
    										                        </td>
                                            						<?php
                                            						foreach ($headers_table_step2 as $item) {
                                            							if($item['active'] == 1) {
                                            								echo '<td>';
                                            								echo $item['filter'];
                                            								echo '</td>';
                                            							}
                                            						}
                                            						?>
                                            						<td>
                                                                        <center>
                                            							<div class="margin-bottom-5">
                                            								<button class="btn btn-icon-only yellow filter-submit margin-bottom"><i class="fa fa-search"></i></button>
                                            							    <button class="btn btn-icon-only red filter-cancel"><i class="fa fa-times"></i></button>
                                      
                                                                        </div></center>
                                            						</td>
                                            					</tr>
                                            			  </thead>
                                                          <tbody></tbody>
                                                 </table>
										</div>
                                        <div class="col-md-4">
       
                                            <table class="table table-striped table-bordered table-hover dataTable" id="table_temp_2">
                                                    <thead>
                                                        <tr class="heading">
                                                        <th style="width: 3%;"><a class="btn btn-xs red-intense" style="margin: 0;" href="javascript:;" id="saveas_tabletemp2"><i class="fa fa-plus icon-white"></i> Add</a></th>
                                                         <th style="width:97%;"><?php echo trans("Selected items", TRUE); ?></th>
                                                        </tr>
                                                    </thead>    
                                                    <tbody></tbody>    
                                               </table> 
                                        </div>
                                        </form>
									</div>
								</div>
								<div class="tab-pane" id="tab3">
                                    <div class="alert info-demo-step" style="display: block;">
										<?php echo $information[3]['info']; ?>
                                    </div>
									<div class="form-group">
                                    <form id="form_data_methodologies" action ="" method="post" style="font-size: 12px !important;">     
									    <div class="col-md-8">
                                                <input class="hide" name="table" id="tablestep3" value="efrc_demo_test" />
                                                     <table class="table table-striped table-bordered table-hover" id="methodologies">
                                                           <thead>
                                            					<tr role="row" class="heading">
                                                                <th width="2%">
                        											<input type="checkbox" class="group-checkable"/>
                        										</th>
                                            						<?php
																	$colWidth = 0;
																	$colNoWidth = 0;
																	$sumWidth = 0;
																	$sum = 0;
																	foreach ($headers_table_step3 as $item) {
																		if($item['active'] == 1) {
																			if(is_numeric($item['width']) && ($item['width'] >=0)) {
																				$colWidth ++;
																				$sumWidth += $item['width'];
																			}
																			else {
																				$colNoWidth ++;
																			}
																			$sum ++;
																		}
																	}
																	$divWidth = $colWidth/$sum*90;
																	$divNoWidth = $colNoWidth / $sum * 90;	
                                            						foreach ($headers_table_step3 as $item) {
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
        																echo '<th width="'.$width.'%"' .$align.'>'.trans($item['title'],TRUE).'</th>';
                                            							}
                                            						}
                                            						?>
                                            						<th class="align-center" width="10%"><?php trans('action') ?></th>
                                            					</tr>
                                            					<tr role="row" class="filter">
                                                                    <td>
    										                        </td>
                                            						<?php
                                            						foreach ($headers_table_step3 as $item) {
                                            							if($item['active'] == 1) {
                                            								echo '<td>';
                                            								echo $item['filter'];
                                            								echo '</td>';
                                            							}
                                            						}
                                            						?>
                                            						<td>
                                                                        <center>
                                            							<div class="margin-bottom-5">
                                            								<button class="btn btn-icon-only yellow filter-submit margin-bottom"><i class="fa fa-search"></i></button>
                                            							    <button class="btn btn-icon-only red filter-cancel"><i class="fa fa-times"></i></button>    
                                                                        </div></center>
                                            						</td>
                                            					</tr>
                                            			  </thead>
                                                          <tbody></tbody>
                                                 </table>
                                           
										</div>
                                        <div class="col-md-4">
                                            <table class="table table-striped table-bordered table-hover dataTable" id="table_temp_3">
                                                    <thead>
                                                        <tr class="heading">
                                                        <th style="width: 5%;"><a class="btn btn-xs red-intense" style="margin: 0;" href="javascript:;" id="saveas_tabletemp3"><i class="fa fa-plus icon-white"></i> Add</a></th>
                                                         <th style="width:95%;"><?php echo trans("Selected items", TRUE); ?></th>
                                                        </tr>
                                                    </thead>    
                                                    <tbody></tbody>    
                                               </table> 
                                        </div>
                                        </form>
									</div>
								</div>
								<div class="tab-pane form" id="tab4">
                                    <div class="alert info-demo-step" style="display: block;">
										<?php echo $information[4]['info']; ?>
                                         <button data-loading-text="Calculating..." class="demo-loading-btn btn red nav navbar-nav navbar-right button-calculator">
                                            <i class="fa fa-calculator"></i> Calculator
                                         </button>
                                        
                                    </div>
                                    <div class="form-group">
                                    <div class="col-md-12">
                                        	<div class="alert status-demo-step display-none">  
                                                <div class="alert alert-danger display-none">
                									<button class="close" data-dismiss="alert"></button>
                									You have some form errors. Please check below.
                								</div>
                								<div class="alert alert-success display-none">
                									<button class="close" data-dismiss="alert"></button>
                									Calculator is successful!
                								</div>      
                                            </div>
                                    </div>
                                    </div>
									<div class="form-group">
                                        <div class="col-md-4">
                                        	<table class="table table-striped table-bordered table-hover dataTable">
                                                    <thead>
                                                        <tr class="heading">
                                                        <th style="width: 5%;"></th>
                                                         <th style="width:95%;"><?php echo trans("Data From Step 1", TRUE); ?></th>
                                                        </tr>
                                                    </thead>    
                                                    <tbody class="form_data_step" data-display="publi"></tbody>    
                                               </table>
                                                
                                        </div>
                                        <div class="col-md-4">
                                        	<table class="table table-striped table-bordered table-hover dataTable">
                                                    <thead>
                                                        <tr class="heading">
                                                        <th style="width: 5%;"></th>
                                                         <th style="width:95%;"><?php echo trans("Data From Step 2", TRUE); ?></th>
                                                        </tr>
                                                    </thead>    
                                                    <tbody class="form_data_step" data-display="resear"></tbody>    
                                               </table>
                                        </div>
                                        <div class="col-md-4">
                                        	<table class="table table-striped table-bordered table-hover dataTable">
                                                    <thead>
                                                        <tr class="heading">
                                                        <th style="width: 5%;"></th>
                                                         <th style="width:95%;"><?php echo trans("Data From Step 3", TRUE); ?></th>
                                                        </tr>
                                                    </thead>    
                                                    <tbody class="form_data_step" data-display="tes"></tbody>    
                                               </table>
									</div>
									</div>
                                </div>
                                <div class="tab-pane form" id="tab5">
                                    <div class="alert info-demo-step" style="display: block;">
										<?php echo $information[5]['info']; ?>
                                        <a href="#save_script" class="btn red nav navbar-nav navbar-right save-script" data-toggle="modal">
                                            <i class="fa fa-save"></i>  Save your script
                                         </a>
                                    </div>                                    
									<div class="form-group">
                                    	
                                         <form id="form_data_rsfinal" action ="" method="post" style="font-size: 12px !important;"> 
    									    <div class="col-md-12" style="float: none !important;" id="form_rsfinal_wrapper">
                                            	<h3 style="margin-bottom: -18px; margin-top: 0px;">All table result</h3>
                                                <div class="actions" style="float: right;">
                                                    <a class="btn btn-sm green exportSumTxt" href="javascript:;">TXT</a>
                                                    <a class="btn btn-sm red exportSumCsv" href="javascript:;">CSV</a>
                                                    <a class="btn btn-sm yellow exportSumXls" href="javascript:;">Excel</a>
                                                </div>
                                                     <table class="table table-striped table-bordered table-hover" id="rsfinal">
                                                           <thead>
                                            					<tr role="row" class="heading">
                                            						<?php
																	$colWidth = 0;
																	$colNoWidth = 0;
																	$sumWidth = 0;
																	$sum = 0;
																	foreach ($headers_table_stepfinal as $item) {
																		if($item['active'] == 1) {
																			if(is_numeric($item['width']) && ($item['width'] >=0)) {
																				$colWidth ++;
																				$sumWidth += $item['width'];
																			}
																			else {
																				$colNoWidth ++;
																			}
																			$sum ++;
																		}
																	}
																	$divWidth = $colWidth/$sum*93;
																	$divNoWidth = $colNoWidth / $sum * 93;	
                                            						foreach ($headers_table_stepfinal as $item) {
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
        																	echo '<th width="'.$width.'%"' .$align.'>'.trans($item['title'],TRUE).'</th>';
                                            							}
                                            						}
                                            						?>
                                            						<th class="align-center" width="7%"><?php trans('action') ?></th>
                                            					</tr>
                                            					<tr role="row" class="filter">
                                            						<?php
                                            						foreach ($headers_table_stepfinal as $item) {
                                            							if($item['active'] == 1) {
                                            								echo '<td>';
                                            								echo $item['filter'];
                                            								echo '</td>';
                                            							}
                                            						}
                                            						?>
                                            						<td>
                                                                        <center>
                                            							<div class="margin-bottom-5">
                                            								<button class="btn btn-icon-only yellow filter-submit margin-bottom"><i class="fa fa-search"></i></button>
                                            							    <button class="btn btn-icon-only red filter-cancel"><i class="fa fa-times"></i></button>
                                                                        </div></center>
                                            						</td>
                                            					</tr>
                                            			  </thead>
                                                          <tbody></tbody>
                                                 </table>
                                                 </div>
                                                 <input type="hidden" value="" name="act_summary" id="act_summary" />
                                                 </form>
                                                 <?php foreach($arr_table_summary_demo as $tb_sum => $desc) {
													 ?>
												<form id="form_sub_final_<?php echo $tb_sum; ?>" action ="" method="post" style="font-size: 12px !important;"> 
                                                  <div class="col-md-12 table_wrapper_sub_final" style="float: none !important;" id="name_<?php echo $tb_sum; ?>">
                                                        <h3 style="margin-bottom: -18px; margin-top: 0px;"><?php trans($desc); ?></h3>
                                                        <div class="actions" style="float: right;">
                                                            <a class="btn btn-sm blue table_rsfinal" href="javascript:;">All result</a>
                                                            <a class="btn btn-sm green exportTxt" name="<?php echo $tb_sum; ?>" href="javascript:;">TXT</a>
                                                            <a class="btn btn-sm red exportCsv" name="<?php echo $tb_sum; ?>" href="javascript:;">CSV</a>
                                                            <a class="btn btn-sm yellow exportXls" name="<?php echo $tb_sum; ?>" href="javascript:;">Excel</a>                                                               
                                                        </div>
                                                        <table class="table table-striped table-bordered table-hover datatable_final" id="table_<?php echo $tb_sum; ?>" name="<?php echo $tb_sum; ?>">
                                                               <thead>
                                                                    <tr role="row" class="heading">
                                                                        <?php
                                                                        $colWidth = 0;
                                                                        $colNoWidth = 0;
                                                                        $sumWidth = 0;
                                                                        $sum = 0;
                                                                        foreach ($headers_table_sub_summary[$tb_sum] as $item) {
                                                                            if($item['active'] == 1) {
                                                                                if(is_numeric($item['width']) && ($item['width'] >=0)) {
                                                                                    $colWidth ++;
                                                                                    $sumWidth += $item['width'];
                                                                                }
                                                                                else {
                                                                                    $colNoWidth ++;
                                                                                }
                                                                                $sum ++;
                                                                            }
                                                                        }
                                                                        $divWidth = $colWidth/$sum*93;
                                                                        $divNoWidth = $colNoWidth / $sum * 93;	
                                                                        foreach ($headers_table_sub_summary[$tb_sum] as $item) {
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
                                                                                echo '<th width="'.$width.'%"' .$align.'>'.trans($item['title'],TRUE).'</th>';
                                                                            }
                                                                        }
                                                                        ?>
                                                                        <th class="align-center" width="7%"><?php trans('action') ?></th>
                                                                    </tr>
                                                                    <tr role="row" class="filter">
                                                                        <?php
                                                                        foreach ($headers_table_sub_summary[$tb_sum] as $item) {
                                                                            if($item['active'] == 1) {
                                                                                echo '<td>';
                                                                                echo $item['filter'];
                                                                                echo '</td>';
                                                                            }
                                                                        }
                                                                        ?>
                                                                        <td>
                                                                            <center>
                                                                            <div class="margin-bottom-5">
                                                                                <button class="btn btn-icon-only yellow filter-submit margin-bottom"><i class="fa fa-search"></i></button>
                                                                                <button class="btn btn-icon-only red filter-cancel"><i class="fa fa-times"></i></button>
                                                                            </div></center>
                                                                        </td>
                                                                    </tr>
                                                              </thead>
                                                              <tbody></tbody>
                                                     </table>
                                                     </div>
                                                      <input type="hidden" value="export" name="act" id="act" />
                                                     <input type="hidden" value="" name="action_sub_<?php echo $tb_sum; ?>" id="action_sub_<?php echo $tb_sum; ?>" />
                                            		 <input type="hidden" value="<?php echo $tb_sum; ?>" name="table_name" id="table_name" />
                                                     <input type="hidden" value="" name="data_rsfinal_<?php echo $tb_sum; ?>" id="data_rsfinal_<?php echo $tb_sum; ?>" class="data_rsfinal_sub" />
                                                     </form>
                                                 <?php } ?>
                                               
    										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-actions">
							<div class="row">
								<div class="col-md-offset-3 col-md-9">
									
								</div>
							</div>
						</div>
				</form>
		</div>
	</div>
</div>
<style>
table .table thead th {
    background-color: red;
    
}

</style>