<div class="row-fluid">
	<div class="span12">
		<!-- BEGIN PORTLET-->
		<div class="portlet paddingless">
			<div class="portlet-title line">
				<div class="caption"><i class="icon-bell"></i><?php trans('hightlights') ?></div>
				<div class="tools">
					<a href="" class="collapse"></a>
                    <!--
					<a href="#portlet-config" data-toggle="modal" class="config"></a>
					<a href="" class="reload"></a>
                    -->
					<a href="" class="remove"></a>
				</div>
			</div>
			
            <div class="portlet-body fx_fleft">
				<!--BEGIN TABS-->
				<div class="tabbable tabbable-custom">
					<div class="tab-content">
						<div class="tab-pane active" id="tab_1_1">
							<div class="scroller" data-height="210px" data-always-visible="1" data-rail-visible1="1">
                            
                            <?php
                                
                                foreach($article_hightlights['current'] as $key=>$value)
                                {
                                    $date_add = $value['date_creation'];
                                    $date_add_d = substr($date_add,0,10);
                                    $date_add_h = substr($date_add,11,5);
                                    
                                	//$date_add_d = strtotime($date_add_d);
                                    $date_add_d = date('d-m-Y', strtotime($date_add_d));

	
                                    $link = base_url() . 'article/' .$value['category_id']. '/' .$value['article_id']. '/' .utf8_convert_url($value['title']). '.html';
                            ?>
                                    <div class="row-fluid">
    									<div class="span12 user-info">
    										<img width="45" height="45" alt="" src="<?php echo base_url() . $value['image'] ?>" />
    										<div class="details">
    											<div>
    												<a href="<?php echo $link ?>"><?php echo $value['title'] ?></a> <span style="color: #3B3B3B; font-size: 11px; margin-left: 10px;"><?php echo $date_add_d ?></span>
    											</div>
    											<div><?php echo $value['description'] ?></div>
    										</div>
    									</div>
    									
    								</div>
                            <?php  
                                }
                            ?>
							</div>
						</div>
						<!--div class="tab-pane" id="tab_1_3">
							
						</div-->
					</div>
				</div>
				<!--END TABS-->
			</div>
            
		</div>
		<!-- END PORTLET-->
	</div>
    <!--
	<div class="span6">
		<div class="portlet">
			<div class="portlet-title line">
				<div class="caption"><i class="icon-comments"></i>Chats</div>
				<div class="tools">
					<a href="" class="collapse"></a>
					<a href="#portlet-config" data-toggle="modal" class="config"></a>
					<a href="" class="reload"></a>
					<a href="" class="remove"></a>
				</div>
			</div>
			<div class="portlet-body" id="chats">
				<div class="scroller" data-height="435px" data-always-visible="1" data-rail-visible1="1">
					<ul class="chats">
						<li class="in">
							<img class="avatar" alt="" src="<?php echo base_url() ?>assets/templates/welcome/img/avatar1.jpg" />
							<div class="message">
								<span class="arrow"></span>
								<a href="#" class="name">Bob Nilson</a>
								<span class="datetime">at Jul 25, 2012 11:09</span>
								<span class="body">
								Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
								</span>
							</div>
						</li>
						<li class="out">
							<img class="avatar" alt="" src="<?php echo base_url() ?>assets/templates/welcome/img/avatar2.jpg" />
							<div class="message">
								<span class="arrow"></span>
								<a href="#" class="name">Lisa Wong</a>
								<span class="datetime">at Jul 25, 2012 11:09</span>
								<span class="body">
								Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
								</span>
							</div>
						</li>
						<li class="in">
							<img class="avatar" alt="" src="<?php echo base_url() ?>assets/templates/welcome/img/avatar1.jpg" />
							<div class="message">
								<span class="arrow"></span>
								<a href="#" class="name">Bob Nilson</a>
								<span class="datetime">at Jul 25, 2012 11:09</span>
								<span class="body">
								Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
								</span>
							</div>
						</li>
						<li class="out">
							<img class="avatar" alt="" src="<?php echo base_url() ?>assets/templates/welcome/img/avatar3.jpg" />
							<div class="message">
								<span class="arrow"></span>
								<a href="#" class="name">Richard Doe</a>
								<span class="datetime">at Jul 25, 2012 11:09</span>
								<span class="body">
								Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
								</span>
							</div>
						</li>
						<li class="in">
							<img class="avatar" alt="" src="<?php echo base_url() ?>assets/templates/welcome/img/avatar3.jpg" />
							<div class="message">
								<span class="arrow"></span>
								<a href="#" class="name">Richard Doe</a>
								<span class="datetime">at Jul 25, 2012 11:09</span>
								<span class="body">
								Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
								</span>
							</div>
						</li>
						<li class="out">
							<img class="avatar" alt="" src="<?php echo base_url() ?>assets/templates/welcome/img/avatar1.jpg" />
							<div class="message">
								<span class="arrow"></span>
								<a href="#" class="name">Bob Nilson</a>
								<span class="datetime">at Jul 25, 2012 11:09</span>
								<span class="body">
								Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
								</span>
							</div>
						</li>
						<li class="in">
							<img class="avatar" alt="" src="<?php echo base_url() ?>assets/templates/welcome/img/avatar3.jpg" />
							<div class="message">
								<span class="arrow"></span>
								<a href="#" class="name">Richard Doe</a>
								<span class="datetime">at Jul 25, 2012 11:09</span>
								<span class="body">
								Lorem ipsum dolor sit amet, consectetuer adipiscing elit, 
								sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
								</span>
							</div>
						</li>
						<li class="out">
							<img class="avatar" alt="" src="<?php echo base_url() ?>assets/templates/welcome/img/avatar1.jpg" />
							<div class="message">
								<span class="arrow"></span>
								<a href="#" class="name">Bob Nilson</a>
								<span class="datetime">at Jul 25, 2012 11:09</span>
								<span class="body">
								Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. sed diam nonummy nibh euismod tincidunt ut laoreet.
								</span>
							</div>
						</li>
					</ul>
				</div>
				<div class="chat-form">
					<div class="input-cont">   
						<input class="m-wrap" type="text" placeholder="Type a message here..." />
					</div>
					<div class="btn-cont"> 
						<span class="arrow"></span>
						<a href="" class="btn blue icn-only"><i class="icon-ok icon-white"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	-->
</div>