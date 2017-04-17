<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8"/>
        <title><?php echo isset($meta_title) ? $meta_title : 'VNEFRC | Vietnam Economics & Financial Research Center'; ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta content="<?php echo isset($meta_description) ? $meta_description : $config['meta_des']; ?>" name="description" />
        <meta content="<?php echo isset($meta_keywords) ? $meta_keywords : $config['meta_key']; ?>" name="keywords" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        
        <link href="<?php echo template_url(); ?>global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo template_url(); ?>global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo template_url(); ?>global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo template_url(); ?>global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo template_url(); ?>global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
        <link href="<?php echo template_url(); ?>global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo template_url(); ?>global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo template_url(); ?>global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo template_url(); ?>admin/pages/css/timeline.css" rel="stylesheet" type="text/css"/>
        <!-- END PAGE LEVEL PLUGIN STYLES -->
        <!-- BEGIN DATATABLE PLUGIN STYLES -->
        <link rel="stylesheet" type="text/css" href="<?php echo template_url(); ?>global/plugins/select2/select2.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo template_url(); ?>global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo template_url(); ?>global/plugins/bootstrap-datepicker/css/datepicker.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo template_url(); ?>global/plugins/clockface/css/clockface.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo template_url(); ?>global/plugins/bootstrap-datepicker/css/datepicker3.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo template_url(); ?>global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo template_url(); ?>global/plugins/bootstrap-colorpicker/css/colorpicker.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo template_url(); ?>global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo template_url(); ?>global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo template_url(); ?>global/plugins/bootstrap-select/bootstrap-select.min.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo template_url(); ?>global/plugins/jquery-multi-select/css/multi-select.css"/>        
        <!-- END DATATABLE PLUGIN STYLES -->
        <!-- BEGIN PAGE STYLES -->
        <link href="<?php echo template_url(); ?>admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
        <!-- END PAGE STYLES -->
        <!-- BEGIN THEME STYLES -->
        <link href="<?php echo template_url(); ?>global/css/components.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo template_url(); ?>global/css/plugins.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo template_url(); ?>admin/layout3/css/layout.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo template_url(); ?>admin/layout3/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
        <link href="<?php echo template_url(); ?>admin/layout3/css/custom.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo template_url(); ?>global/plugins/flipcountdown-master/jquery.flipcountdown.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo template_url(); ?>global/plugins/flipcountdown-master/jquery.flipcountdown.css" rel="stylesheet" type="text/css"/>
        <!-- END THEME STYLES -->
        <link rel="shortcut icon" href="<?php echo template_url(); ?>img/favicon.ico"/>

        <!-- BEGIN CUSTOME STYLES -->
        <link href="<?php echo template_url(); ?>css/style.css" rel="stylesheet" type="text/css"/>
        <!-- END CUSTOME STYLES -->
    </head>
    <!-- END HEAD -->
    <!-- BEGIN BODY -->
    <!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
    <!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
    <!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
    <!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
    <!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
    <!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
    <!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
    <!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
    <!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
    <body>
        <?php echo $header; ?>
        <?php //echo $mega_menu; ?>
        <!-- BEGIN CONTAINER -->
        <div class="page-container main-container">
            <?php echo $sidebar; ?>
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <!-- BEGIN LOGO PARTNER -->
                    <div class="logo_partners">
                        <ul>
                            <?php
                            if($list_partners['current'])
                                foreach($list_partners['current'] as $key => $value) {
                                    echo '<li><a title="'.$value['title'].'" target="_blank" href="'.$value['link'].'"><img src="'.base_url().$value['image'].'" alt=""></a></li>';
                                }
                            ?>
                        </ul>
                    </div>
                    <!-- END LOGO PARTNER -->
                    <?php echo $content; ?>
                </div>
            </div>
            <!-- END CONTENT -->
            <?php echo $quick_sidebar; ?>
        </div>
        <!-- END CONTAINER -->
    <?php echo $footer; ?>
    <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
    <!-- BEGIN CORE PLUGINS -->
    <!--[if lt IE 9]>
    <script src="<?php echo template_url(); ?>global/plugins/respond.min.js"></script>
    <script src="<?php echo template_url(); ?>global/plugins/excanvas.min.js"></script> 
    <![endif]-->
    <script src="<?php echo template_url(); ?>global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo template_url(); ?>global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
    <!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
    <script src="<?php echo template_url(); ?>global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
    <script src="<?php echo template_url(); ?>global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo template_url(); ?>global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
    <script src="<?php echo template_url(); ?>global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="<?php echo template_url(); ?>global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
    <script src="<?php echo template_url(); ?>global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
    <script src="<?php echo template_url(); ?>global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
    <script src="<?php echo template_url(); ?>global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
    <script src="<?php echo template_url(); ?>global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <!--<script src="<?php echo template_url(); ?>global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
    <script src="<?php echo template_url(); ?>global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
    <script src="<?php echo template_url(); ?>global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
    <script src="<?php echo template_url(); ?>global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
    <script src="<?php echo template_url(); ?>global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
    <script src="<?php echo template_url(); ?>global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
    <script src="<?php echo template_url(); ?>global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
    -->
    <script src="<?php echo template_url(); ?>global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
    <script src="<?php echo template_url(); ?>global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
    <script src="<?php echo template_url(); ?>global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
    <script src="<?php echo template_url(); ?>global/plugins/jquery.pulsate.min.js" type="text/javascript"></script>
    <!-- DATEPICKER -->
    <script type="text/javascript" src="<?php echo template_url(); ?>global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="<?php echo template_url(); ?>global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
    <script type="text/javascript" src="<?php echo template_url(); ?>global/plugins/clockface/js/clockface.js"></script>
    <script type="text/javascript" src="<?php echo template_url(); ?>global/plugins/bootstrap-daterangepicker/moment.min.js"></script>
    <script type="text/javascript" src="<?php echo template_url(); ?>global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script type="text/javascript" src="<?php echo template_url(); ?>global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
    <script type="text/javascript" src="<?php echo template_url(); ?>global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    <!--END DATEPICKER -->
    
    <!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
    <!--<script src="<?php echo template_url(); ?>global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
    <script src="<?php echo template_url(); ?>global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
    <script src="<?php echo template_url(); ?>global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>-->
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="<?php echo template_url(); ?>global/scripts/metronic.js" type="text/javascript"></script>
    <script src="<?php echo template_url(); ?>admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
    <script src="<?php echo template_url(); ?>admin/pages/scripts/index.js" type="text/javascript"></script>
    <script src="<?php echo template_url(); ?>admin/pages/scripts/tasks.js" type="text/javascript"></script>
    <!--<script src="http://maps.google.com/maps/api/js?sensor=true" type="text/javascript"></script>
    <script src="<?php echo template_url(); ?>global/plugins/gmaps/gmaps.js" type="text/javascript"></script>  -->
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN DATATABLE PLUGIN SCRIPTS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
            <script type="text/javascript" src="<?php echo template_url(); ?>global/plugins/select2/select2.min.js"></script>
            <script type="text/javascript" src="<?php echo template_url(); ?>global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
            <script type="text/javascript" src="<?php echo template_url(); ?>global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
            <script type="text/javascript" src="<?php echo template_url(); ?>global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
            <script type="text/javascript" src="<?php echo template_url(); ?>global/plugins/jquery.mockjax.js"></script>
            <script type="text/javascript" src="<?php echo template_url(); ?>global/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.js"></script>
			<script type="text/javascript" src="<?php echo template_url(); ?>global/plugins/bootstrap-editable/inputs-ext/address/address.js"></script>
            <script type="text/javascript" src="<?php echo template_url(); ?>global/plugins/bootstrap-editable/inputs-ext/wysihtml5/wysihtml5.js"></script>
            <script type="text/javascript" src="<?php echo template_url(); ?>global/plugins/jquery-multi-select/js/jquery.multi-select.js"></script>
            <script type="text/javascript" src="<?php echo template_url(); ?>global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
            <script type="text/javascript" src="<?php echo template_url(); ?>global/plugins/jquery-validation/js/additional-methods.min.js"></script>
            <script type="text/javascript" src="<?php echo template_url(); ?>global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
            <script src="<?php echo template_url(); ?>global/plugins/flipcountdown-master/jquery.flipcountdown.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
            <script src="<?php echo template_url(); ?>admin/pages/scripts/components-dropdowns.js"></script>
            <script src="<?php echo template_url(); ?>admin/layout/scripts/layout.js" type="text/javascript"></script>
            <script src="<?php echo template_url(); ?>admin/layout/scripts/demo.js" type="text/javascript"></script>
            <script src="<?php echo template_url(); ?>js/datatable.js"></script>
            <script src="<?php echo template_url(); ?>admin/pages/scripts/table-ajax.js"></script>
            
        <!-- END PAGE LEVEL SCRIPTS -->
    <!-- END DATATABLE PLUGIN SCRIPTS -->
    <script>
        jQuery(document).ready(function() {    
           Metronic.init(); // init metronic core componets
           Layout.init(); // init layout
           QuickSidebar.init(); // init quick sidebar
           // Demo.init(); // init demo features 
           Index.init();
           TableAjax.init(); //INIT TABLE 
        //   ContactUs.init();   
         //   Index.initDashboardDaterange();
//            Index.initJQVMAP();  //init index page's custom scripts
//            Index.initCalendar(); // init index page's custom scripts
//            Index.initCharts(); //init index page's custom scripts
//            Index.initChat();
//            Index.initMiniCharts();
            Tasks.initDashboardWidget();
        
        });
    </script>
    <!-- END JAVASCRIPTS -->

    <!-- CUSTOME JAVASCRIPTS -->
    <script type="text/javascript">
        var $template_url = '<?php echo template_url(); ?>';
        var $base_url = '<?php echo base_url(); ?>';
        var $admin_url = '<?php echo admin_url(); ?>';
        var $app = {'module': '<?php echo $this->router->fetch_module(); ?>',
            'controller': '<?php echo $this->router->fetch_class(); ?>',
            'action': '<?php echo $this->router->fetch_method(); ?>'};
    </script>
    <script data-main="<?php echo base_url(); ?>assets/apps/welcome/main" src="<?php echo base_url(); ?>assets/bundles/require.js"></script>
    <!-- END CUSTOME JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>