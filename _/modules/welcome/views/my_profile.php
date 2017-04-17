
<!-- BEGIN PAGE HEADER-->
        <h3 class="page-title">
        <?php trans('Profile'); ?>
        </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="<?php echo base_url(); ?>">Home</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <!--li>
                    <a href="#">Extra</a>
                    <i class="fa fa-angle-right"></i>
                </li-->
                <li>
                    <a href="<?php echo base_url(); ?>contact"><?php trans('profile'); ?></a>
                </li>
            </ul>
        </div>
<!-- END PAGE HEADER-->
<div class="tab-pane active" id="tab_1_1">
							
								<div class="row">
									<div class="col-md-3">
										<ul class="list-unstyled profile-nav">
											<li>
												<img id="avatar" name="avatar" src="<?php echo is_file($user['avatar']) ? $user['avatar'] : 'assets/upload/avatar/no_avatar.jpg'; ?>" class="img-responsive-avatar" alt=""/>
												<div class="change-avatar"></div>
											</li>
										</ul>
									</div>
									<div class="col-md-9">
										<div class="row">
											<div class="col-md-8 profile-info">
												<div class="row">
                                            <div class="col-md-12">
					       <table id="user" class="table borderless">
				
                                <tr>
                                    <td style="width:15%; text-align: right;">
                                          <strong><?php echo trans('first_name'); ?>:</strong>
                                    </td>
                                    
                                    <td style="width:38%">
                                        <span class="text-muted">
                                         <strong><?php echo $user['first_name']; ?> </strong>  </span>
                                    </td>
                                   <td style="width:15%">
                                       <strong><?php echo trans('last_name'); ?>:</strong>
                                    </td>
                                     <td style="width:38%">
                                        <span class="text-muted">
                                         <strong><?php echo $user['last_name']; ?></strong>  </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right;"><!--td {border: 1px solid #ccc;}br {mso-data-placement:same-cell;}-->
                                  <strong><?php echo trans('profile'); ?>:</strong></td>
                                
                                    <td colspan="3"><!--td {border: 1px solid #ccc;}br {mso-data-placement:same-cell;}-->
                                      <div><?php echo $detail_user['profile']; ?></div>
                                    </span></td>
                                   
                                </tr>
                                <tr>
                                    <td style="text-align: right;"><!--td {border: 1px solid #ccc;}br {mso-data-placement:same-cell;}-->
                                  <strong><?php echo trans('education'); ?>:</strong></td>
                                
                                    <td colspan="3"><!--td {border: 1px solid #ccc;}br {mso-data-placement:same-cell;}-->
                                      <div><?php echo $detail_user['education']; ?></div>
                                    </span></td>
                                   
                                </tr>
                                <tr>
                                    <td style="text-align: right;"><!--td {border: 1px solid #ccc;}br {mso-data-placement:same-cell;}-->
                                  <strong><?php echo trans('experiences'); ?>: </strong></td>
                                
                                    <td colspan="3"><!--td {border: 1px solid #ccc;}br {mso-data-placement:same-cell;}-->
                                      <div><?php echo $detail_user['experiences']; ?></div>
                                    </span></td>
                                   
                                </tr>
                                <tr>
                                    <td style="text-align: right;"><!--td {border: 1px solid #ccc;}br {mso-data-placement:same-cell;}-->
                                  <strong><?php echo trans('interests'); ?>: </strong></td>
                                
                                    <td colspan="3"><!--td {border: 1px solid #ccc;}br {mso-data-placement:same-cell;}-->
                                      <div><?php echo $detail_user['interests']; ?></div>	
		</div>
                                    </span></td>
                                   
                                </tr>
                                 
			
					</table>
				</div>
                </div>
                                                <div>
                                                  <div class="col-md-8"></div>
                                              </div> 
										
											</div>
											<!--end col-md-8-->
										
										</div>
										<!--end row-->
									</div>
								</div>
								<div class="row">
        	<div class="col-md-3">
        	<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">                         
					<table id="user" class="table table-bordered table-striped">
					<tbody>
                                <tr>
                                    <td style="width:30%; text-align: right;">
                                        <strong> <?php echo trans('Department'); ?>: </strong>
                                    </td>
                                    
                                    <td>
                                        <span class="text-muted">
                                         <strong><?php echo trans($detail_user['department']); ?> </strong>  </span>
                                    </td>
                                    <td style="width:15%; text-align: center;" class="hidden-md">
                                        <a href="#" id="username" data-type="text" data-pk="1" data-original-title="Enter username">
                                        <?php echo trans('edit') ?> </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:30%; text-align: right;" >
                                        <strong> <?php echo trans('Service'); ?>: </strong> 
                                    </td>
                                
                                    <td>
                                        <span class="text-muted">
                                         <strong><?php echo trans($detail_user['service']); ?> </strong>  </span>
                                    </td>
                                    <td style="width:15%; text-align: center;"  class="hidden-md">
                                        <a href="#" id="username" data-type="text" data-pk="1" data-original-title="Enter username">
                                        <?php echo trans('edit') ?> </a>
                                    </td>
                                </tr>
                                 <tr>
                                    <td style="width:30%; text-align: right;" >
                                       <strong>  <?php echo trans('Level'); ?>: </strong>
                                    </td>
                                
                                    <td>
                                        <span class="text-muted">
                                         <strong>   <?php echo $detail_user['description']; ?> </strong>  </span>
                                    </td>
                                    <td style="width:15%; text-align: center;"  class="hidden-md" >
                                        <a href="#" id="username" data-type="text" data-pk="1" data-original-title="Enter username">
                                        <?php echo trans('edit') ?> </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:30%; text-align: right;">
                                        <strong> <?php echo trans('Email'); ?>:</strong>
                                    </td>
                                   
                                    <td>
                                        <span class="text-muted">
                                       <strong> <?php echo $user['email']; ?></strong> </span>
                                    </td>
                                     <td style="text-align: center;" class="hidden-md">
                                        <a href="#" id="sex" data-type="select" data-pk="1" data-value="" data-original-title="Select sex">Sửa
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:30%; text-align: right;">
                                       <strong> <?php echo trans('Password'); ?></strong> 
                                    </td>
                                    <td>
                                        <span class="text-muted">
                                        <?php echo str_repeat('*', strlen(base64_decode($user['password']))); ?> </span>
                                    </td>
                                    <td style="width:15%; text-align: center;" class="hidden-md">
                                        <a href="#modal_change_password" data-toggle="modal" id="group" data-type="select" data-pk="1" data-value="5" data-source="/groups" data-original-title="Select group">
                                        <?php echo trans('edit') ?> </a>
                                    </td>
                                    
                                        </tr>
					</tbody>
					</table>
				</div>
                </div>
	</div>
	<div class="col-md-9">
		<div class="tabbable tabbable-custom tabbable-custom-profile">
								<ul class="nav nav-tabs">
									<li class="active"><a href="#tab_1_11" data-toggle="tab">Latest Interventions</a></li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="tab_1_11">
										<div class="portlet-body" style="display: block;">
											<table class="table table-striped table-bordered table-advance table-hover">
												<thead>
													<tr>
														<th><i class="icon-briefcase"></i> Contract</th>
														<th class="hidden-phone"><i class="icon-question-sign"></i> Reference</th>
														<th><i class="icon-bookmark"></i> Order</th>
                                                        <th><i class="icon-bookmark"></i> Date</th>
														<th></th>
													</tr>
												</thead>
												<tbody>                                                   
                                                    <tr>
                                                        
                                                        <td>FUTURES VNX 25</td>
                                                        <td class="hidden-phone">OCTOBER 2012</td>
                                                        <td>BUY 120 at 2675</td>
                                                        <td>2014/10/15</td>
                                                        <td><a class="btn mini red-stripe" href="#">View</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>OPTION VNX25</td>
                                                        <td class="hidden-phone">DECEMBER 2014</td>
                                                        <td>BUY 25 CALL 2680 at 131.50</td>
                                                        <td>2014/10/16</td>
                                                        <td><a class="btn mini green-stripe" href="#">View</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>OPTION VNX25</td>
                                                        <td class="hidden-phone">OCTOBER 2014</td>
                                                        <td>SELL 10 PUT 2660 at 86.40</td>
                                                        <td>2014/10/16</td>
                                                        <td><a class="btn mini blue-stripe" href="#">View</a></td>
                                                    </tr>
                                                </tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
										
		</div>																		
										
</div>

							</div>
<!-- BEGIN PAGE CONTENT INNER -->
			
				
<!-- END PAGE CONTENT INNER -->
   <style>
   .borderless tbody tr td, .borderless thead tr th {
    border: none;
	}

   </style>