
<!-- BEGIN PAGE HEADER-->
     
			<!--<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="index.html">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					li>
						<a href="#">Extra</a>
						<i class="fa fa-angle-right"></i>
					</li
					<li>
						<a href="<?php echo base_url(); ?>contact"><?php trans('contact_us'); ?></a>
					</li>
				</ul>
        </div>-->
				<!--div class="page-toolbar">
					<div class="btn-group pull-right">
						<button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
						Actions <i class="fa fa-angle-down"></i>
						</button>
						<ul class="dropdown-menu pull-right" role="menu">
							<li>
								<a href="#">Action</a>
							</li>
							<li>
								<a href="#">Another action</a>
							</li>
							<li>
								<a href="#">Something else here</a>
							</li>
							<li class="divider">
							</li>
							<li>
								<a href="#">Separated link</a>
							</li>
						</ul>
					</div>
				</div-->

			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					<div class="row margin-bottom-20">
                    <?php
                        if($article_contact['current'])
                        {
                            $contact = $article_contact['current'][0];
                    ?>
						<div class="col-md-6">
							<div class="space20">
							</div>
							<p>
								 <?php echo $contact['description']?>
							</p>
							<div class="well">
								<h4><?php trans('Address') ?></h4>
								<address>
								<?php 
                                            echo $contact['long_description'];
                                ?>
								<!--abbr title="Phone">P:</abbr> (234) 145-1810 </address-->
								<address>
								<strong><?php trans('Email') ?></strong><br/>
								<a href="mailto:#">
								<?php echo $contact['meta_keyword'] ?> </a>
								</address>
								<ul class="social-icons margin-bottom-10">
									<li>
										<a href="#" data-original-title="facebook" class="facebook">
										</a>
									</li>
									<li>
										<a href="#" data-original-title="github" class="github">
										</a>
									</li>
									<li>
										<a href="#" data-original-title="Goole Plus" class="googleplus">
										</a>
									</li>
									<li>
										<a href="#" data-original-title="linkedin" class="linkedin">
										</a>
									</li>
									<li>
										<a href="#" data-original-title="rss" class="rss">
										</a>
									</li>
									<li>
										<a href="#" data-original-title="skype" class="skype">
										</a>
									</li>
									<li>
										<a href="#" data-original-title="twitter" class="twitter">
										</a>
									</li>
									<li>
										<a href="#" data-original-title="youtube" class="youtube">
										</a>
									</li>
								</ul>
							</div>
						</div>
                    <?php
                        }
                    ?>
						<div class="col-md-6">
							<div class="space20">
							</div>
							<!-- BEGIN FORM-->
							<!--form action="#"-->
								<h3 class="form-section"><?php trans('Feedback_Form') ?></h3>
								<!--p>
									 Lorem ipsum dolor sit amet, Ut wisi enim ad minim veniam, quis nostrud exerci. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat consectetuer
								</p-->
								<!--div class="form-group">
									<div class="input-icon">
										<i class="fa fa-check"></i>
										<input type="text" class="form-control" placeholder="<?php trans('Subject') ?>"/>
									</div>
								</div-->
								<div class="form-group">
									<div class="input-icon">
										<i class="fa fa-user"></i>
										<input type="text" class="form-control"  name="contact_name" placeholder="<?php trans('Name') ?>"/>
									</div>
								</div>
								<div class="form-group">
									<div class="input-icon">
										<i class="fa fa-envelope"></i>
										<input name="contact_email" type="text" class="form-control" placeholder="<?php trans('Email') ?>"/>
									</div>
								</div>
								<div class="form-group">
									<textarea name="contact_message" class="form-control" rows="3" placeholder="<?php trans('Feedback') ?>"></textarea>
								</div>
                                <div class="form-group">
                                	<img src="<?php echo base_url(); ?>captcha?cid=contact" style="margin:0px 12px 2px 2px; float:left;" /><brs/>
                                    <input type="text" maxlength="5" class="form-control" style="width:20%; height:48px; text-align: center;" placeholder="<?php trans('Code here') ?>" name="contact_code" id="contact_code"/>
                                </div>  
                                <input type="hidden" name="email_receiving_email" value="<?php echo $contact['meta_keyword'] ?>" />
            					<button type="button" style="float: right; margin-top: -63px; width:12%; height:48px;" class="btn blue button-sendcontact"><i class="fa fa-mail-forward"></i> <?php trans('Send') ?></button>
                                <p class="contact_warning"></p>
                                
							<!--/form-->
							<!-- END FORM-->
						</div>
					</div>
                    <!-- Google Map -->
					<div class="row">
						<div id="map" class="gmaps margin-bottom-40" style="height:400px;">
						</div>
					</div>
				</div>
			</div>
			<!-- END PAGE CONTENT-->
	<!-- END CONTENT -->
    
    <!--<script src="<?php echo template_url(); ?>global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
    <script src="<?php echo template_url(); ?>global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
    <script src="<?php echo template_url(); ?>global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
    <script src="<?php echo template_url(); ?>global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
    <script src="<?php echo template_url(); ?>global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
    <script src="<?php echo template_url(); ?>global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
    <script src="<?php echo template_url(); ?>global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>-->
 	<script src="http://maps.google.com/maps/api/js?sensor=true" type="text/javascript"></script>
    <script src="<?php echo template_url(); ?>global/plugins/gmaps/gmaps.js" type="text/javascript"></script>