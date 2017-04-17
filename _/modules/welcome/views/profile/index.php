<div class="row profile">
	<div class="col-md-12">
		<!--BEGIN TABS-->				
		<div class="row">
			<div class="col-md-4">
                <div class="row">
                    <div class="scroller" data-height="760px" data-always-visible="1" data-rail-visible="1">
                        <div class="col-md-12">
                        	<form enctype="multipart/form-data" method="POST"  id="fileupload" class="" style="width: 100%;"> 
                                <center>
                                <div class="fileinput <?php echo (isset($detail_user['avatar']) && is_file($detail_user['avatar'])) ? 'fileinput-exists' : 'fileinput-new'; ?>"
                                 data-provides="fileinput" data-name="avatar"style="width:100%;" >
                                        <div id="file" class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 61.5%">
                                            <img id="myavatar" src="<?php
                                            echo base_url();
                                            echo (isset($detail_user['avatar']) && is_file($detail_user['avatar'])) ? str_replace(base_url(), "", $detail_user['avatar']) : 'assets/upload/avatar/no_avatar.jpg';
                                            ?>" alt=""/>
                                        </div>    
                                        <div class="margin-bottom-20 align-left" style="float: right; width: 10%; margin-right: 10px;">
                                           <span class="btn btn-icon-only blue btn-file" style="margin-top: 10px;">
                                            <span class="fileinput-new" style="font-size:11px;"><i class="fa fa-edit"></i></span>
                                            <span class="fileinput-exists">
                                            <i class="fa fa-edit" ></i> </span>
                                            <input type="file" name="fileavatar" id ="fileavatar" value="<?php echo (isset($detail_user['avatar']) && is_file($detail_user['avatar'])) ? str_replace(base_url(), "", $detail_user['avatar']) : 'assets/upload/avatar/no_avatar.jpg'; ?>"/>
                                            </span>
                                            <a href="javascript:;" class="btn btn-icon-only red fileinput-exists remove-image-profile" data-dismiss="fileinput"style="margin-top: 10px;margin-left: 0px!important;">
                                            <i class="fa fa-remove"></i> </a>
                                            <a class="btn btn-icon-only green save-avatar" href="javascript:;" style="margin-top: 10px;margin-left: 0px!important;">
                                            <i class="fa fa-check"></i> </a>
                                            <a class="btn btn-icon-only yellow mix-preview fancybox-button" data-fancybox-group="avatar" title='<?php echo $user['last_name'].' '.$user['first_name']; ?>' href="<?php echo (isset($detail_user['avatar']) && is_file($detail_user['avatar'])) ? str_replace(base_url(), "", $detail_user['avatar']) : 'assets/upload/avatar/no_avatar.jpg'; ?>"style="margin-top: 10px;margin-left: 0px!important;">
                                            <i class="fa fa-search-plus"></i></a>
                                     </div>                                                             
                                </div>                          
                                </center> 
                            </form>
                        </div>
                        <div class="col-md-12 margin-top-10">
    						<!-- PORTLET MAIN -->
                            <div class="row">
    							<!-- SIDEBAR MENU -->
                                <div id="accordion1" class="panel-group">
    							<div class="panel panel-warning">
									<div class="panel-heading">
										<h4 class="panel-title">
										<a class="accordion-toggle" data-toggle="collapse" href="#account">
										<?php echo trans('Account'); ?> </a>
										</h4>
									</div>
    							<!-- END MENU -->
                                    <div id="account" class="panel-collapse collapse">
										<div class="panel-body">
                                            <table id="user" class="table table-bordered table-striped">
            									<tbody>
            										<tr>
            											<td style="width:15%; text-align: right;">
            												<strong> <?php echo trans('first_name'); ?>: </strong>
            											</td>
            											<td>
            												<span class="text-muted" name="first_name">
            												 <?php if(isset($user['first_name'])) echo $user['first_name']; ?> </span>
            											</td>
    									       	 	    <td style="width:10%; text-align: center; width:10%">
            												<a href="javascript:;" class="btn btn-icon-only blue edit-profile" edit_for="first_name" data-target="#modal_change" data-toggle="modal" data-table="user" data-type="input" data-title="<?php echo trans('first_name') ?>">
                            							     <i class="fa fa-edit"></i> </a>
            											</td> 
            										</tr>
                                                    <tr>
            											<td style="width:15%; text-align: right;">
            												<strong> <?php echo trans('last_name'); ?>: </strong>
            											</td>
            											<td>
            												<span class="text-muted" name="last_name">
            												 <?php if(isset($user['last_name'])) echo $user['last_name']; ?> </span>
            											</td>
            											<td style="width:10%; text-align: center; width:10%">
            												<a href="javascript:;" class="btn btn-icon-only blue edit-profile" edit_for="last_name" data-target="#modal_change" data-toggle="modal" data-table="user" data-type="input" data-title="<?php echo trans('last_name') ?>">
                            							<i class="fa fa-edit"></i> </a>
            											</td> 
            										</tr>
            										<tr>
            											<td style="width:15%; text-align: right;" >
            												<strong> <?php echo trans('Office'); ?>: </strong> 
            											</td>
            										
            											<td>
            												<span class="text-muted" name="id_office">
            												<?php if(isset($detail_user['id_office'])) echo trans($detail_user['id_office']); ?> </span>
            											</td>
            											<td style="width:10%; text-align: center; width:10%">
            												 <a href="javascript:;" class="btn btn-icon-only blue edit-profile" edit_for="id_office" data-target="#modal_change" data-toggle="modal" data-table="user_info" data-type="select2" data-title="<?php echo trans('service') ?>">
                            							     <i class="fa fa-edit"></i> </a>
            											</td> 
            										</tr>
            										 <tr>
                                                     
            											<td style="width:15%; text-align: right;" >
            											   <strong>  <?php echo trans('Level'); ?>: </strong>
            											</td>
            										
            											<td>
            												<span class="text-muted" name="user_level">
            												<?php echo isset($detail_user['user_level']) ? $detail_user['user_level'] : 0; ?></span>
            											</td>
            											 
            										</tr>
            										<tr>
            											<td style="width:30%; text-align: right; height:44px !important">
            												<strong> <?php echo trans('Username'); ?>:</strong>
            											</td>
            											<td colspan="2">
            												<span class="text-muted">
            											   <span id="user_email"> <?php if(isset($user['username'])) echo $user['username']; ?></span> </span>
            											</td>
            										</tr>
            										<!--<tr>
            											<td style="width:30%; text-align: right;">
            											   <strong> <?php echo trans('Password'); ?>:</strong> 
            											</td>
            											<td>
            												<span class="text-muted" id="count_pass">
            												<?php echo str_repeat('*', $user['count_pass']); ?> </span>
            											</td>
            											<td style="width:15%; text-align: center; width:10%">
                                                            <a id="change_password" class="btn btn-icon-only blue load_modals" data-target="#modal_change" data-toggle="modal">
                                                            <i class="fa fa-edit"></i>
                                                            </a>
                                                        </td>	
            										</tr>-->
                                                    <tr>
            											<td style="width:30%; text-align: right;">
            											   <strong> <?php echo trans('Email'); ?>:</strong> 
            											</td>
            											<td>
            												<span class="text-muted">
            												<?php echo $user['email']; ?> </span>
            											</td>
            											<td style="width:15%; text-align: center; width:10%">
                                                            <a id="change_email" class="btn btn-icon-only blue load_modals" data-target="#modal_change" data-toggle="modal">
                                                            <i class="fa fa-edit"></i>
                                                            </a>
                                                        </td>	
            										</tr>
            									</tbody>
            								</table>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
    						<!-- END PORTLET MAIN -->
                        </div>
                    </div>
                </div>
            </div>
			<div class="col-md-8">
                 <!--div class="scroller" data-height="auto" data-always-visible="1" data-rail-visible="1"-->
                    <!-- BEGIN FORM-->
					<form class="form-horizontal" role="form" style="overflow-x: auto;">
						<div class="form-body">
                            <!--h4 class="form-section text-uppercase"><?php echo trans('') ?></h4-->
                            <div id="accordion2" class="panel-group">
								<div class="panel panel-success">
									<div class="panel-heading">
										<h4 class="panel-title">
										<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_1">
										<?php echo trans('Information_trans'); ?> </a>
										</h4>
									</div>
									<div id="accordion2_1" class="panel-collapse collapse in">
										<div class="panel-body">
											 <table id="user_info" class="table table-bordered table-striped">
            									<tbody>
            										<tr>
            											<td style="text-align: right; width: 15%;">
            												<strong> <?php echo trans('Address'); ?>: </strong>
            											</td>
            											<td>
            												<span class="text-muted" name="addr_street">
            												<?php if(isset($detail_user['addr_street'])) echo $detail_user['addr_street']; ?>  </span>
            											</td>
        								       	 	    <td style="text-align: center; width:5%">
            											     <a href="javascript:;" class="btn btn-icon-only blue edit-profile" edit_for="addr_street" data-target="#modal_change" data-toggle="modal" data-table="user_info" data-type="input" data-title="<?php echo trans('addr_street') ?>">
                                							 <i class="fa fa-edit"></i> </a>
            											</td>
            										</tr>
                                                    <tr>
            											<td style="text-align: right; width: 15%;">
            												<strong> <?php echo trans('City'); ?>: </strong>
            											</td>
            											<td  >
            												<span class="text-muted" name="addr_city">
            												<?php if(isset($detail_user['addr_city'])) echo $detail_user['addr_city']; ?></span>
            											</td>
            											<td style="text-align: center; width:5%">
            												<a href="javascript:;" class="btn btn-icon-only blue edit-profile" edit_for="addr_city" data-target="#modal_change" data-toggle="modal" data-table="user_info" data-type="select2" data-title="<?php echo trans('addr_city') ?>">
                                                			<i class="fa fa-edit"></i> </a>
            											</td>
            										</tr>
            										<tr>
            											<td style="text-align: right; width: 15%;" >
            												<strong> <?php echo trans('Prof. Phone') ?>: </strong> 
            											</td>
            											<td>
            												<span class="text-muted" name="prof_mobile">
            												<?php if(isset($detail_user['prof_mobile'])) echo $detail_user['prof_mobile']; ?></span>
            											</td>
            											<td style="text-align: center; width:5%">
            												 <a href="javascript:;" class="btn btn-icon-only blue edit-profile" edit_for="prof_mobile" data-target="#modal_change" data-toggle="modal" data-table="user_info" data-type="input" data-title="<?php echo trans('prof_mobile') ?>">
                                							 <i class="fa fa-edit"></i> </a>
            											</td>
                                                    </tr>
            										<tr>
                                                        <td style="text-align: right; width: 15%;" >
            												<strong><?php echo trans('Pers. Phone') ?>: </strong> 
            											</td>
            											<td>
            												<span class="text-muted" name="pers_mobile">
            												<?php if(isset($detail_user['pers_mobile'])) echo $detail_user['pers_mobile']; ?></span>
            											</td>
            											<td style="text-align: center; width:5%">
            												 <a href="javascript:;" class="btn btn-icon-only blue edit-profile" edit_for="pers_mobile" data-target="#modal_change" data-toggle="modal" data-table="user_info" data-type="input" data-title="<?php echo trans('pers_mobile') ?>">
                                							 <i class="fa fa-edit"></i> </a>
            											</td>  
            										</tr>
            										<tr>
            											<td style="text-align: right; width: 15%;" >
            												<strong> <?php echo trans('Email') ?>: </strong> 
            											</td>
            											<td>
            												<span class="text-muted" name="prof_email">
            												<?php if(isset($detail_user['prof_email'])) echo $detail_user['prof_email']; ?></span>
            											</td>
            											<td style="text-align: center; width:5%">
            												 <a href="javascript:;" class="btn btn-icon-only blue edit-profile" edit_for="prof_email" data-target="#modal_change" data-toggle="modal" data-table="user_info" data-type="input" data-title="<?php echo trans('prof_email') ?>">
                                							<i class="fa fa-edit"></i> </a>
            											</td>
                                                    </tr>
                                                    <tr>    
                                                        <td style="text-align: right; width: 15%;" >
            												<strong><?php echo trans('Skype') ?>: </strong> 
            											<td>
            												<span class="text-muted" name="skype">
            												<?php if(isset($detail_user['skype'])) echo $detail_user['skype']; ?></span>
            											</td>
            											<td style="text-align: center; width:5%">
            												 <a href="javascript:;" class="btn btn-icon-only blue edit-profile" edit_for="skype" data-target="#modal_change" data-toggle="modal" data-table="user_info" data-type="input" data-title="<?php echo trans('skype') ?>">
                                							<i class="fa fa-edit"></i> </a>
            											</td> 
            										</tr>
                                                </tbody>
                                            </table>
										</div>
									</div>
								</div>
								<div class="panel panel-warning">
									<div class="panel-heading">
										<h4 class="panel-title">
										<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_2">
										<?php echo trans('profile_trans'); ?> </a>
										</h4>
									</div>
									<div id="accordion2_2" class="panel-collapse collapse">
										<div class="panel-body">
											 <table id="user_profile" class="table table-bordered table-striped">
                                                <tbody>
        											 <tr>
            											<td style="text-align: right; width: 15%;">
            												<strong> <?php echo trans('Profile'); ?>:</strong>
            											</td>
            											<td  >
            												<span class="text-muted" name="profile">
            											    <?php echo isset($profile_user['profile'])? $profile_user['profile']  : ""; ?></span>
            											</td>
                                                        <td style="text-align: center; width:5%">
                                                            <a href="javascript:;" class="btn btn-icon-only blue edit-profile" edit_for="profile" data-target="#modal_change" data-toggle="modal" data-table="user_profile" data-type="textarea" data-title="<?php echo trans('profile') ?>">
                                							<i class="fa fa-edit"></i> </a>
                                                        </td>
            										</tr>
            										<tr>
            											<td style="text-align: right; width: 15%;">
            											   <strong> <?php echo trans('Education'); ?>:</strong> 
            											</td>
            											<td  >
            												<span class="text-muted" name="education">
            												<?php echo isset($profile_user['education'])? $profile_user['education'] : ""; ?></span>
            											</td>
            											<td style="text-align: center; width:5%">
                                                            <a href="javascript:;" class="btn btn-icon-only blue edit-profile" edit_for="education" data-target="#modal_change" data-toggle="modal" data-table="user_profile" data-type="textarea" data-title="<?php echo trans('education') ?>">
                                							<i class="fa fa-edit"></i> </a>
                                                        </td>	
            										</tr>
                                                    <tr>
            											<td style="text-align: right; width: 15%;">
            												<strong><?php echo trans('Experiences'); ?>:</strong>
            											</td>
            											<td  >
            											     <span class="text-muted" name="experiences">
            											     <?php echo isset($profile_user['experiences']) ?$profile_user['experiences'] : ""; ?></span>
            											</td>
                                                        <td style="text-align: center; width:5% ">
                                                            <a href="javascript:;" class="btn btn-icon-only blue edit-profile" edit_for="experiences" data-target="#modal_change" data-toggle="modal" data-table="user_profile" data-type="textarea" data-title="<?php echo trans('experiences') ?>">
                                							<i class="fa fa-edit"></i> </a>
                                                        </td>
            										</tr>
            										<tr>
            											<td style="text-align: right; width: 15%;">
            											   <strong> <?php echo trans('Interests'); ?>:</strong> 
            											</td>
            											<td  >
            												<span class="text-muted" name="interests">
            												<?php echo isset($profile_user['interests'])? $profile_user['interests']: ""; ?></span>
            											</td>
            											<td style="text-align: center; width:5%">
                                                            <a href="javascript:;" class="btn btn-icon-only blue edit-profile" edit_for="interests" data-target="#modal_change" data-toggle="modal" data-table="user_profile" data-type="textarea" data-title="<?php echo trans('interests') ?>">
                                							<i class="fa fa-edit"></i> </a>
                                                        </td>	
            										</tr>
            									</tbody>
            								</table>
										</div>
									</div>
								</div>
                                
                            </div>    	
						</div>
					</form>
					<!-- END FORM-->  
                 <!--/div-->
			</div>
			<!--end row-->
		</div>
	</div>
</div>
			<!-- END PAGE CONTENT INNER -->
   <style>
   .borderless tbody tr td, .borderless thead tr th {
    border: none;
	}

   </style>
<!-- MODAL CHANGE -->
<div id="modal_change" class="modal fade" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-body">
			<img src="<?php echo template_url(); ?>global/img/loading-spinner-grey.gif" alt="" class="loading"/>
			<span>
			&nbsp;&nbsp;Loading... </span>
		</div>
    </div>
  </div>
</div>
<!-- END MODAL CHANGE -->
<!--MODAL VIEW USER -->
<div id="modal_view_user" class="modal bs-modal-md fade" tabindex="-1" aria-hidden="true" data-width="760">
	<div class="modal-dialog modal-lg">
	  <div class="modal-content">
	    <div class="modal-header" style="background-color: #E4AD36;">
	      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
	      <h4 class="modal-title"><?php echo trans('My profile'); ?></h4>
	    </div>
	    <form id="form_view_user" role="form" class="form-horizontal" action="" method="post">
	      <div class="modal-body">
	        <div class="scroller" style="height:500px" data-always-visible="1" data-rail-visible1="1">
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
	                  <label class="col-md-3 control-label">H? vÃ  tÃªn <span class="required" aria-required="true"> * </span></label>
	                  <div class="col-md-9">
	                    <input type="text" id="view_first_name" name="view_first_name" class="form-control input-inline input-medium" value="<?php echo $user['first_name']; ?>" placeholder="<?php echo trans('first_name'); ?>">
                        <input type="text" id="view_last_name" name="view_last_name" class="form-control input-inline input-small" value="<?php echo $user['last_name']; ?>" placeholder="<?php echo trans('last_name'); ?>">
	                  </div>
	                </div>	                
	                <div class="form-group">
	                  <label class="col-md-3 control-label"><?php echo trans('profile'); ?> </label>
	                  <div class="col-md-9">
                      	<textarea rows="3" id="view_profile" name="view_profile" style="overflow:auto;resize:none" class="form-control" ><?php echo $detail_user['profile']; ?></textarea>
	                  </div>
	                </div>
                    <div class="form-group">
	                  <label class="col-md-3 control-label"><?php echo trans('education'); ?> </label>
	                  <div class="col-md-9">
                      	<textarea rows="3" id="view_education" name="view_education" style="overflow:auto;resize:none" class="form-control" ><?php echo $detail_user['education']; ?></textarea>
	                  </div>
	                </div>
                    <div class="form-group">
	                  <label class="col-md-3 control-label"><?php echo trans('experiences'); ?>: </strong></td> </label>
	                  <div class="col-md-9">
                      <textarea rows="3" id="view_experiences" name="view_experiences" style="overflow:auto;resize:none" class="form-control" ><?php echo $detail_user['experiences']; ?></textarea>
	                  </div>
	                </div>
                    <div class="form-group">
	                  <label class="col-md-3 control-label"><?php echo trans('interests'); ?>: </strong></td> </label>
	                  <div class="col-md-9">
                      <textarea rows="3" id="view_interests" name="view_interests" style="overflow:auto;resize:none" class="form-control" ><?php echo $detail_user['interests']; ?></textarea>
	                  </div>
	                </div>
	              </div>
	            </div>
	          </div>
	        </div>
	      </div>
	      <div class="modal-footer">
	        <a href="#" class="btn default" data-dismiss="modal"><?php echo trans('Cancel'); ?></a>
	        <input type="submit" class="btn green" value="<?php echo trans('Save'); ?>"/>
	      </div>
	    </form>
	  </div>
	</div>
</div>
<!-- END MODAL VIEW USER -->
