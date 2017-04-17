<!doctype html>
<!--[if lt IE 8 ]><html lang="en" class="no-js ie ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie"><![endif]-->
<!--[if (gt IE 8)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
    <head>
        <meta charset="utf-8" />
        <title>
            <?php
            trans('title_admin');
            echo ($this->router->fetch_class()) != "" ? " | " . ucwords($this->router->fetch_class()) : "";
            ?>
        </title>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo template_url(); ?>favicon.ico" />
        <link href="<?php echo template_url(); ?>css/compress2.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo template_url(); ?>css/style.css" rel="stylesheet" type="text/css" />
        <link href='<?php echo base_url(); ?>assets/bundles/jqGrid/css/ui.jqgrid.css' rel='stylesheet' type='text/css' media='screen' />
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/bundles/jqGrid/plugins/ui.multiselect.css" />
        <script src="<?php echo template_url(); ?>js/libs/modernizr.custom.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/bundles/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/bundles/ckeditor/ckeditor.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/bundles/jquery.livequery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/templates/backend/js/ZeroClipboard.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/templates/backend/js/highstocks.js"></script>
        <link href="<?php echo template_url(); ?>plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css">
        
		<script>
            var $template_url = '<?php echo template_url(); ?>';
            var $base_url = '<?php echo base_url(); ?>';
            var $admin_url = '<?php echo admin_url(); ?>';
            var $userid = '<?php echo isset($this->ion_auth->user()->row()->user_id) ? $this->ion_auth->user()->row()->user_id : $this->session->userdata_vnefrc('user_id'); ?>';
            var $lang = "<?php echo $curent_language['code']; ?>";

            var $app = {'module': '<?php echo $this->router->fetch_module(); ?>',
                'controller': '<?php echo $this->router->fetch_class(); ?>',
                'action': '<?php echo $this->router->fetch_method(); ?>'};
            var $device = "<?php echo strtolower($this->agent->mobile()); ?>";
        </script>
		
    </head>
    <body style="background: none;">
        <!-- The template uses conditional comments to add wrappers div for ie8 and ie7 - just add .ie or .ie7 prefix to your css selectors when needed -->
        <!--[if lt IE 9]><div class="ie"><![endif]-->
        <!--[if lt IE 8]><div class="ie7"><![endif]-->
        <!-- Header -->
        <!-- Server status -->
        <header id="myTop">
            <div class="container_12">
                <?php if (isset($list_language) && is_array($list_language)) { ?>
                    <div class="server-info list-language">
                        <ul>
                            <?php foreach ($list_language as $value) { ?>
                                <li class="<?php echo $curent_language['code'] == $value['code'] ? 'active' : '' ?>">
                                    <a href="javascript: void(0);" langcode="<?php echo $value['code']; ?>">
                                        <img src="<?php echo template_url() ?>images/icons/flags/<?php echo $value['code']; ?>.png" width="16" height="11" alt="<?php echo $value['name']; ?>" title="<?php echo $value['name']; ?>">
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
                <div class="server-info">
                    <?php trans('ip_address'); ?> : <span style="color: #FFF"><?php echo $_SERVER['SERVER_ADDR']; ?></span>
                </div>
                <div class="server-info">
                    <?php trans('bt_date'); ?> : <span style="color: #FFF"><?php echo date("Y-m-d"); ?></span>
                    <span id="timer" style="color: #FFF"></span>
                </div>
            </div>
            <h1 id="slogan">               
                <?php trans('slogan_admin'); ?>
            </h1>
        </header>
        <!-- End server status -->
        <!-- Main nav -->
        <nav style="height:90px;"></nav>
        <div id="gkMainMenu">
            <div class="gk-menu">
                <?php
                $group_id = $this->ion_auth->get_users_groups($this->ion_auth->user()->row()->user_id)->row()->id;
                ?>
                <ul class="gkmenu level0">
                    <li class="first">
                        <a href="<?php echo admin_url() . 'home'; ?>" class="first"><span style="height:45px;width:1px;background:none;"></span><img src="<?php echo template_url(); ?>images/home.png" alt="" /></a>
                    </li>
                    <?php
                    if (check_service($group_id, $listServicesUser, 'admin')) {
                        if ($this->ion_auth->is_admin()) {
                            ?>
                            <li>
                                <a href="<?php echo admin_url() . 'users' ?>" title="<?php trans('mn_Users'); ?>"><span class="menu-title"><?php trans('mn_Users'); ?></span></a>
                            </li>
                            <li class="haschild">
                                <a href="#" title="Websites"><span class="menu-title"><?php trans('mn_Websites'); ?></span></a>
                                <div class="childcontent">
                                    <div class="childcontent-inner-wrap normalSubmenu">
                                        <div class="childcontent-inner">
                                            <ul class="gkmenu level1">
                                                <li class="first haschild">
                                                    <a href="<?php echo admin_url() . 'menu' ?>" title="<?php trans('mn_Menu'); ?>"><span class="menu-title"><?php trans('mn_Menu'); ?></span></a>
                                                </li>
                                                <!--
												<li>
                                                    <a href="<?php echo admin_url() . 'page' ?>" title="<?php trans('mn_Pages'); ?>"><span class="menu-title"><?php trans('mn_Pages'); ?></span></a>
                                                </li>
												-->
                                                <li>
                                                    <a href="<?php echo admin_url() . 'category' ?>" title="<?php trans('mn_Categories'); ?>"><span class="menu-title"><?php trans('mn_Categories'); ?></span></a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo admin_url() . 'article' ?>" title="<?php trans('mn_Articles'); ?>"><span class="menu-title"><?php trans('mn_Articles'); ?></span></a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo admin_url() . 'media' ?>"  title="<?php trans('mn_Media'); ?>"><span class="menu-title"><?php trans('mn_Media'); ?></span></a>
                                                </li>
												<li>
                                                    <a href="<?php echo admin_url() . 'newsletter' ?>"  title="<?php trans('mn_Newsletter'); ?>"><span class="menu-title"><?php trans('mn_Newsletter'); ?></span></a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo admin_url() . 'request' ?>"  title="<?php trans('mn_Request'); ?>"><span class="menu-title"><?php trans('mn_Request'); ?></span></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php } ?>
                        <?php if ($this->ion_auth->is_admin()) { ?>
                            <!--
							<li>
                                <a href="<?php echo admin_url() . 'product' ?>" title="<?php trans('mn_Product'); ?>"><span style="height:45px;width:1px;background:none;"></span><?php trans('mn_Product'); ?></a>
                            </li>
							-->
                            <li class="haschild">
                                <a href="#" title="<?php trans('mn_System'); ?>"><span class="menu-title"><?php trans('mn_System'); ?></span></a>
                                <div class="childcontent">
                                    <div class="childcontent-inner-wrap normalSubmenu">
                                        <div class="childcontent-inner">
                                            <ul class="gkmenu level1">
                                                <li class="first">
                                                    <a href="<?php echo admin_url() . 'config' ?>" title="<?php trans('mn_Config'); ?>"><span class="menu-title"><?php trans('mn_Config'); ?></span></a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo admin_url() . 'language' ?>" title="<?php trans('mn_Languages'); ?>"><span class="menu-title"><?php trans('mn_Languages'); ?></span></a>
                                                </li>
                                                <li class="first">
                                                    <a href="<?php echo admin_url() . 'translate' ?>"  title="<?php trans('mn_Translates'); ?>"><span class="menu-title"><?php trans('mn_Translates'); ?></span></a>
                                                </li>
                                                <!--
												<li>
                                                    <a href="<?php echo admin_url() . '#' ?>" title="<?php trans('mn_Backup'); ?>"><span class="menu-title"><?php trans('mn_Backup'); ?></span></a>
                                                </li>
												-->
                                                <li>
                                                    <a href="javascript:;" onClick="file_manager();" title="<?php trans('mn_Files'); ?>"><span class="menu-title"><?php trans('mn_Files'); ?></span></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <?php
                        }
                    }
                    if (check_service($group_id, $listServicesUser, 'help')) {
                        ?>                            
                        <!--li>
                            <a href="<?php echo admin_url() . 'help' ?>" title="<?php trans('mn_Help'); ?>"><span style="height:45px;width:1px;background:none;"></span><?php trans('mn_Help'); ?></a>
                        </li-->
                        <?php
                    }
                    ?>
                </ul>

            </div>
        </div>
        <!-- end menu -->
        <!-- Status bar -->
        <div id="status-bar">
            <div class="container_12">
                <ul id="status-infos">
                    <li class="spaced">
                        <?php trans('bt_logged_as'); ?>:
                        <strong>
                            <?php echo isset($this->ion_auth->user()->row()->username) ? ucfirst($this->ion_auth->user()->row()->username) : ''; ?>
                        </strong>
                    </li>
                    <li>
                        <a class="button red" href="<?php echo base_url(); ?>auth/logout">
                            <?php trans('bt_logout'); ?>
                        </a>
                    </li>
                    <!-- li>
                        <a href="javascript:void(0)" class="button"><strong><?php trans('bt_info'); ?></strong></a>
                        <div id="message-list" class="result-block">
                            <span class="arrow"><span></span></span>
                            <ul class="relative small-files-list icon_info_tabs">
                                <li>
                                    <a href="#"><strong><?php trans('version'); ?>:</strong>
                                        <?php trans('home_version_txt_uel'); ?>
                                        <br>
                                        <small></small>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"><strong><?php trans('ip_address'); ?>:</strong>
                                        <?php echo $_SERVER['SERVER_ADDR']; ?>
                                        <br>
                                        <small></small>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li-->
                </ul>
                <ul id="breadcrumb">
                    <li><a href="#" title="<?php trans('bar_title'); ?>"><?php trans('bar_title'); ?></a></li>
                    <?php if ($this->router->fetch_class() != 'admin'): ?>
                        <li><a style="text-transform: capitalize" href="<?php echo admin_url() . $this->router->fetch_class(); ?>" title="<?php trans('mn_' . $this->router->fetch_class()); ?>"><?php trans('mn_' . $this->router->fetch_class()); ?></a></li>
                    <?php endif; ?>
                    <?php if ($this->router->fetch_method() != 'index'): ?>
                        <li><a style="text-transform: capitalize" href="#" title="<?php trans('mn_' . $title); ?>"><?php trans('mn_' . $title); ?></a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <!-- End status bar -->
        <div id="header-shadow"></div>
        <!-- End header -->
        <!-- Always visible control bar -->
        <!-- End control bar -->
        <!-- Content -->
        <!--[if lt IE 8]></div><![endif]-->
        <!--[if lt IE 9]></div><![endif]-->

        <!-- Always visible control bar -->
        <?php echo $bar; ?>
        <!-- End control bar -->

        <article class="container_12 main-container">
            <?php echo $content ?>
            <div class="clear"></div>
        </article>
        <footer>
            <div class="float-left">

            </div>
            <div class="float-right">

            </div>
        </footer>
        <div id="lean_overlay">
            <section class="grid_12" id="calculatingBlock">
                <span>
                    <center>
                        <?php trans('processing'); ?><br/><img width="100" src="<?php echo template_url(); ?>images/preloader.gif"/>
                    </center>
                </span>
            </section>
        </div>
        <!-- load javascript -->
        <!-- Generic libs -->
        <script src="<?php echo template_url(); ?>js/old-browsers.js"></script>
        <!-- remove if you do not need older browsers detection -->
        <script src="<?php echo template_url(); ?>js/libs/jquery.hashchange.js"></script>
        <!-- Template libs -->
        <script src="<?php echo template_url(); ?>js/jquery.accessibleList.js"></script>
        <script src="<?php echo template_url(); ?>js/searchField.js"></script>
        <script src="<?php echo template_url(); ?>js/common.js"></script>
        <script src="<?php echo template_url(); ?>js/standard.js"></script>
        <!--[if lte IE 8]><script src="js/standard.ie.js"></script><![endif]-->
        <script src="<?php echo template_url(); ?>js/jquery.tip.js"></script>
        <script src="<?php echo template_url(); ?>js/jquery.contextMenu.js"></script>
        <script src="<?php echo template_url(); ?>js/jquery.modal.js"></script>
        <!-- Custom styles lib -->
        <script src="<?php echo template_url(); ?>js/list.js"></script>
        <!-- Plugins -->
        <script src="<?php echo template_url(); ?>js/libs/jquery.dataTables.min.js"></script>
        <script src="<?php echo template_url(); ?>js/libs/dataTables.formattedNum.js"></script>
        <script src="<?php echo template_url(); ?>js/libs/dataTables.fnSetFilteringPressEnter.js"></script>
        <script src="<?php echo template_url(); ?>js/libs/dataTables.fnMyFilter.js"></script>
        <script src="<?php echo template_url(); ?>js/libs/dataTables.fnReloadAjax.js"></script>
        <script src="<?php echo template_url(); ?>js/libs/jquery.datepick/jquery.datepick.min.js"></script>
        <script src="<?php echo template_url(); ?>js/mootools-core.js"></script>
        <script src="<?php echo template_url(); ?>js/menu.gkmenu.js"></script>
        <script src="<?php echo template_url(); ?>js/jquery.dataTables.columnFilter.js"></script>
        <script src="<?php echo base_url(); ?>assets/bundles/jquery-ui/jquery-ui-1.8.22.custom.min.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bundles/jquery-ui/css/jquery-ui-1.8.1.custom.css" />
        <script src="<?php echo base_url(); ?>assets/bundles/jquery.mousewheel-3.0.6.pack.js" ></script>
        <script src="<?php echo base_url(); ?>assets/bundles/fancyBox/jquery.fancybox.pack.js" ></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bundles/fancyBox/jquery.fancybox.css" />
        <script src="<?php echo base_url(); ?>assets/bundles/sisyphus.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/bundles/jqGrid/js/i18n/grid.locale-en.js" type="text/javascript"></script>
        <script src='<?php echo base_url(); ?>assets/bundles/jqGrid/js/jquery.jqGrid.min.js' type="text/javascript"></script>
        <script data-main="<?php echo base_url(); ?>assets/apps/backend/main" src="<?php echo base_url(); ?>assets/bundles/require.js"></script>
    </body>
</html>