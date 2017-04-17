<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.4
Version: 3.9.0
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD --><head>
<meta charset="utf-8">
<title><?php echo isset($meta_title) ? $meta_title : 'VNEFRC | Vietnam Economics & Financial Research Center'; ?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport">
<meta content="<?php echo isset($meta_description) ? $meta_description : $config['meta_des']; ?>" name="description">
<meta content="<?php echo isset($meta_keywords) ? $meta_keywords : $config['meta_key']; ?>" name="author">
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="<?php echo template_url(); ?>global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo template_url(); ?>global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo template_url(); ?>global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo template_url(); ?>global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css">
<link href="<?php echo template_url(); ?>global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="<?php echo template_url(); ?>global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>


<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
<link href="<?php echo template_url(); ?>admin/pages/css/profile.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo template_url(); ?>global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo template_url(); ?>admin/pages/css/timeline.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo template_url(); ?>global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="<?php echo template_url(); ?>global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo template_url(); ?>global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<!--<link rel="stylesheet" type="text/css" href="<?php echo template_url(); ?>global/plugins/bootstrap-datepicker/css/datepicker.css"/>-->
<link rel="stylesheet" type="text/css" href="<?php echo template_url(); ?>global/plugins/clockface/css/clockface.css"/>

<!--<link rel="stylesheet" type="text/css" href="<?php echo template_url(); ?>global/plugins/bootstrap-datepicker/css/datepicker3.css"/>-->


<!--<link rel="stylesheet" type="text/css" href="<?php echo template_url(); ?>global/plugins/bootstrap-datepicker/css/datepicker3.css"/>
-->
<link rel="stylesheet" type="text/css" href="<?php echo template_url(); ?>global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo template_url(); ?>global/plugins/bootstrap-colorpicker/css/colorpicker.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo template_url(); ?>global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo template_url(); ?>global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo template_url(); ?>global/plugins/bootstrap-select/bootstrap-select.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo template_url(); ?>global/plugins/jquery-multi-select/css/multi-select.css"/>

<!--link href="<?php echo template_url(); ?>global/plugins/morris/morris.css" rel="stylesheet" type="text/css"-->
<!-- END PAGE LEVEL PLUGIN STYLES -->
<!-- BEGIN PAGE STYLES -->
<link rel="stylesheet" type="text/css" href="<?php echo template_url(); ?>admin/pages/css/portfolio.css"/>
<link href="<?php echo template_url(); ?>admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE STYLES -->
<!-- BEGIN THEME STYLES -->
<!-- DOC: To use 'rounded corners' style just load 'components-rounded.css' stylesheet instead of 'components.css' in the below style tag -->
<link href="<?php echo template_url(); ?>global/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css">
<link href="<?php echo template_url(); ?>global/css/plugins.css" rel="stylesheet" type="text/css">
<link href="<?php echo template_url(); ?>admin/layout3/css/layout.css" rel="stylesheet" type="text/css">
<link href="<?php echo template_url(); ?>admin/layout3/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color">
<link href="<?php echo template_url(); ?>admin/layout3/css/custom.css" rel="stylesheet" type="text/css">
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="<?php echo template_url(); ?>img/favicon.ico"/>
<link href="<?php echo template_url(); ?>css/style.css" rel="stylesheet" type="text/css">

<!--BEGIN TEST-->
<!-- The jQuery library is a prerequisite for all jqSuite products -->

<link rel="stylesheet" type="text/css" media="screen" href="<?php echo template_url(); ?>global/test/css/jquery-ui.css" />
<!-- The link to the CSS that the grid needs -->
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo template_url(); ?>global/test/css/ui.jqgrid.css" />
<!--END TEST-->
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-menu-fixed" class to set the mega menu fixed  -->
<!-- DOC: Apply "page-header-top-fixed" class to set the top menu fixed  -->
<body class="page-header-menu-fixed">
<?php echo $header; ?>
<!-- BEGIN PAGE CONTAINER -->
<div class="page-container">
	<!-- BEGIN PAGE HEAD -->
	<div class="page-head">
		<div class="container-fluid">
        	<!-- BEGIN PAGE TITLE -->
			<?php echo $quick_sidebar; ?>
            <!-- END PAGE TITLE -->
			<!-- BEGIN PAGE TOOLBAR -->
           
			<div class="page-toolbar">
				<!-- BEGIN THEME PANEL -->
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
				<!-- END THEME PANEL -->
			</div>
           
			<!-- END PAGE TOOLBAR -->
		</div>
	</div>
	<!-- END PAGE HEAD -->
	<!-- BEGIN PAGE CONTENT -->
	<div class="page-content">
    
		<div class="container-fluid main-container">
            <div class="modal bs-modal-md fade" id="login_modals" role="dialog" aria-hidden="true" >
				<div class="modal-dialog modal-md">
					<div class="modal-content">
						<div class="modal-body">
                       
							<img src="<?php echo template_url(); ?>global/img/loading-spinner-grey.gif" alt="" class="loading"/>
							<span>
							&nbsp;&nbsp;Loading... </span>
						</div>
					</div>
				</div>
			</div>
			<!-- BEGIN PAGE CONTENT INNER -->
		    <?php echo $content; ?>
			<!-- END PAGE CONTENT INNER -->
            <div class="modal fade" id="modal" role="dialog" tabindex="-1" aria-hidden="true">
            	<div class="page-loading page-loading-boxed">
            		<img src="<?php echo template_url(); ?>global/img/loading-spinner-grey.gif" alt="" class="loading"/>
            		<span>
            		&nbsp;&nbsp;Loading... </span>
            	</div>
            	<div class="modal-dialog modal-full">
            		<div class="modal-content">
            		</div>
            	</div>
            </div>
            
		</div>
	</div>
	<!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->

<!-- BEGIN FOOTER -->
<div class="page-footer">
	<div class="container-fluid">
		 <?php echo $footer; ?>
	</div>
</div>
<div class="scroll-to-top">
	<i class="icon-arrow-up"></i>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS (Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php echo template_url(); ?>global/plugins/respond.min.js"></script>
<script src="<?php echo template_url(); ?>global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="<?php echo template_url(); ?>global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo template_url(); ?>global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
   <script src="<?php echo template_url(); ?>global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>

<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script type="text/javascript" src="<?php echo template_url(); ?>global/plugins/ckeditor/ckeditor.js"></script>
<!--<script src="<?php echo template_url(); ?>global/plugins/bootstrap/js/bootstrap-ckeditor-fix.js" type="text/javascript"></script>-->
<script type="text/javascript" src="<?php echo template_url(); ?>global/plugins/fancybox/source/jquery.fancybox.pack.js"></script>
<script src="<?php echo template_url(); ?>global/plugins/jquery-mixitup/jquery.mixitup.min.js" type="text/javascript"></script>
<script src="<?php echo template_url(); ?>global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?php echo template_url(); ?>global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo template_url(); ?>global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo template_url(); ?>global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo template_url(); ?>global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo template_url(); ?>global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?php echo template_url(); ?>global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?php echo template_url(); ?>global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="<?php echo template_url(); ?>global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo template_url(); ?>global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo template_url(); ?>global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>

<script type="text/javascript" src="<?php echo template_url(); ?>global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo template_url(); ?>global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
<!--script src="<?php echo template_url(); ?>global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
<script src="<?php echo template_url(); ?>global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
<script src="<?php echo template_url(); ?>global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
<script src="<?php echo template_url(); ?>global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
<script src="<?php echo template_url(); ?>global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
<script src="<?php echo template_url(); ?>global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script-->
<!-- IMPORTANT! fullcalendar depends on jquery-ui.min.js for drag & drop support -->
<!--script src="<?php echo template_url(); ?>global/plugins/morris/morris.min.js" type="text/javascript"></script>
<script src="<?php echo template_url(); ?>global/plugins/morris/raphael-min.js" type="text/javascript"></script-->
<script src="<?php echo template_url(); ?>global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
 <!-- DATEPICKER -->
<script type="text/javascript" src="<?php echo template_url(); ?>global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo template_url(); ?>global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="<?php echo template_url(); ?>global/plugins/clockface/js/clockface.js"></script>
<script type="text/javascript" src="<?php echo template_url(); ?>global/plugins/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="<?php echo template_url(); ?>global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="<?php echo template_url(); ?>global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="<?php echo template_url(); ?>global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<!--END DATEPICKER -->

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
<script src="<?php echo template_url(); ?>global/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>

<!--<script src="<?php echo template_url(); ?>global/plugins/flipcountdown-master/jquery.flipcountdown.js" type="text/javascript"></script>-->
<!--script src="<?php echo template_url(); ?>global/plugins/flipcountdown-master/jquery.flipcountdown.js" type="text/javascript"></script-->

<!-- END PAGE LEVEL PLUGINS -->


<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo template_url(); ?>global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo template_url(); ?>admin/layout3/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo template_url(); ?>admin/layout3/scripts/demo.js" type="text/javascript"></script>
<!--script src="<?php echo template_url(); ?>admin/pages/scripts/index3.js" type="text/javascript"></script-->
<script src="<?php echo template_url(); ?>admin/pages/scripts/tasks.js" type="text/javascript"></script>
<script src="<?php echo template_url(); ?>js/datatable.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!--<script src="<?php echo base_url(); ?>assets/bundles/jqGrid/js/i18n/grid.locale-en.js" type="text/javascript"></script>
<script src='<?php echo base_url(); ?>assets/bundles/jqGrid/js/jquery.jqGrid.min.js' type="text/javascript"></script>-->
<!--TEST-->

<!-- This is the Javascript file of jqGrid -->   
<script type="text/ecmascript" src="<?php echo template_url(); ?>global/test/src/i18n/grid.locale-en.js"></script>
<script type="text/ecmascript" src="<?php echo template_url(); ?>global/test/js/jquery.jqGrid.min.js"></script>
<script type="text/ecmascript" src="<?php echo template_url(); ?>global/test/src/js/jquery-ui.min.js"></script>
<script type="text/ecmascript" src="<?php echo template_url(); ?>global/test/src/js/prettify/prettify.js"></script>
<script type="text/ecmascript" src="<?php echo template_url(); ?>global/test/src/js/codetabs.js"></script><script type="text/ecmascript" src="<?php echo template_url(); ?>global/test/src/js/themeswitchertool.js"></script>
 <script type="text/javascript"> 
        $(document).ready(function () {
			
            $("#jqGrid").jqGrid({
                url: '<?php echo base_url();?>ajax/test',
				//url: 'http://trirand.com/blog/phpjqgrid/examples/jsonp/getjsonp.php?callback=?&qwery=longorders',
                mtype: "POST",
                datatype: "json",
                colModel: [
                   
                    {   label : "code",
						//sorttype: 'integer',
						name: 'code', 
						key: true, 
						width: 75 
					},
                    { 
						label: "date",
                        name: 'date',
                        width: 150,
						sorttype:'date',
						formatter: 'date',
						srcformat: 'Y-m-d',
						newformat: 'n/j/Y',
                        searchoptions: {
                            // dataInit is the client-side event that fires upon initializing the toolbar search field for a column
                            // use it to place a third party control to customize the toolbar
                            dataInit: function (element) {
                                $(element).datepicker({
                                    id: 'orderDate_datePicker',
                                    dateFormat: 'm/d/yy',
                                    //minDate: new Date(2010, 0, 1),
                                    maxDate: new Date(2020, 0, 1),
                                    showOn: 'focus'
                                });
                            }
                        }
                    },  
                    {
						label: "close",
						sorttype: 'number',
						name: 'close', width: 150 
					},
					  {   label : "type",
						//sorttype: 'integer',
						name: 'type', 
						key: true, 
						width: 75 
					},
					  {   label : "Currency from",
						//sorttype: 'integer',
						name: 'cur_from', 
						key: true, 
						width: 75 
					},
					  {   label : "Currency to",
						//sorttype: 'integer',
						name: 'cur_to', 
						key: true, 
						width: 75 
					},
                
                  
					
					 
                ],
				viewrecords: true,
                width: 1320,
                height: 300,
                rowNum: 20,
				
				//multiselect: true,
				caption:"Efrc currency data",
                pager: "#jqGridPager",
				
            });
        });
 
   </script>
   
<!--END TEST-->   
<script>
jQuery(document).ready(function() {    
   Metronic.init(); // init metronic core componets
   Layout.init(); // init layout
   Demo.init(); // init demo(theme settings page)
  // Index.init(); // init index page
   Tasks.initDashboardWidget(); // init tash dashboard widget
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