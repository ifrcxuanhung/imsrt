
        <!-- BEGIN PAGE BASE CONTENT -->
        <!-- Center Wrap BEGIN -->
        <!--<div class="center-wrap">
            <div class="center-align">
                <div class="center-body">
                    <div class="row">
                    	<div class="col-sm-6">
                            <a class="webapp-btn" href="<?php echo base_url().'setup'; ?>">
                                <h3><?php echo trans('SETTINGS'); ?></h3>
                                <p><?php echo trans('Subtitle_SETTINGS'); ?></p>
                            </a>
                        </div>
                        <div class="col-sm-6 margin-bottom-30">
                            <a class="webapp-btn" href="<?php echo base_url().'jq_loadtable/summary'; ?>">
                                <h3><?php echo trans('MANAGEMENT'); ?></h3>
                                <p><?php echo trans('Subtitle_MANAGEMENT'); ?></p>
                            </a>
                        </div>
                      
                    </div>
                    <div class="row">
                    	  <div class="col-sm-6 margin-bottom-30">
                            <a class="webapp-btn" href="<?php echo base_url().'overview'; ?>">
                                <h3><?php echo trans('CALCULATION'); ?></h3>
                                <p><?php echo trans('Subtitle_CALCULATION'); ?></p>
                            </a>
                        </div>
                        <div class="col-sm-6 sm-margin-bottom-30">
                            <a class="webapp-btn" href="<?php echo base_url().'table/?category=DISSEMINATION'?>">
                                <h3><?php echo trans('DISSEMINATION'); ?></h3>
                                <p><?php echo trans('Subtitle_DISSEMINATION'); ?></p>
                            </a>
                        </div>
                        
                    </div>
                     <div class="row">
                    	<div class="col-sm-6">
                            <a class="webapp-btn" href="<?php echo base_url().'table/?category=FEED IN'?>">
                                <h3><?php echo trans('FEEDIN'); ?></h3>
                                <p><?php echo trans('Subtitle_FEEDIN'); ?></p>
                            </a>
                        </div>
                        <div class="col-sm-6 margin-bottom-30">
                            <a class="webapp-btn" href="<?php echo base_url().'table/?category=FEED OUT'?>">
                                <h3><?php echo trans('FEEDOUT'); ?></h3>
                                <p><?php echo trans('Subtitle_FEEDOUT'); ?></p>
                            </a>
                        </div>
                      
                    </div>
                </div>
            </div>
        </div>-->
        
        <div class="center-wrap">
            <div class="center-align">
                <div class="center-body">
                    <div class="row">
                    <?php foreach($starthomes as $starthome){?>
                    	<div class="col-sm-4 margin-bottom-30">
                            <a class="webapp-btn" href="<?php echo base_url().$starthome['url'];?>">
                                <h3><?php echo $starthome['title']; ?></h3>
                                <p><?php echo $starthome['description']; ?></p>
                            </a>
                        </div>
                     <?php }?>
                      
                    </div>
                   
                </div>
            </div>
        </div>
        <!-- Center Wrap END -->
        <!-- END PAGE BASE CONTENT -->
        <!-- BEGIN FOOTER -->
        <!-- BEGIN QUICK SIDEBAR TOGGLER -->
        <!--button type="button" class="quick-sidebar-toggler" data-toggle="collapse">
            <span class="sr-only">Toggle Quick Sidebar</span>
            <i class="icon-logout"></i>
        </button-->
        <!-- END QUICK SIDEBAR TOGGLER -->
        <p class="copyright">
            <?php trans('footer') ?>
        </p>
        <!-- END FOOTER -->

<!-- END CONTAINER -->