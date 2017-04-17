<!-- BEGIN PAGE HEADER-->

<div class="row-fluid">
	<div class="span12">
		<!-- Begin Logo_partners -->
            <?php echo $logo_partners;?>
        <!-- End Logo_partners -->   
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title" style="font-family: sans-serif;"><strong><?php echo $menu['name']; ?></strong></h3>
		<ul class="breadcrumb">
			<li>
				<i class="icon-home"></i>
				<a href="<?php echo base_url(); ?>"><?php trans('home'); ?></a>
                <i class="icon-angle-right"></i> 
			</li>
            <li>
				<a href="<?php echo base_url().$menu['link']; ?>"><?php echo $menu['name']; ?></a>
			</li> 
		</ul>
        <?php echo $hightlights; ?>
	</div>
</div>
<!-- END PAGE HEADER--> 
<div id="dashboard">
	<div class="row-fluid">
    	<div class="span6" style="width: 57%;">
            <!-- BEGIN Portlet PORTLET-->
            <div class="portlet box yellow" >
                <div class="portlet-title">
                    <div class="caption"><i class="icon-reorder"></i><?php trans('the_project') ?></div>
                </div>
                <div class="portlet-body">
                <?php $article_index = $article_index['current'][0]; ?>
                    <div class="scroller" data-height="650px" data-always-visible="1" data-rail-visible="1">
                        <h1 class="title_publ"><?php echo $article_index['title']; ?></h1>
						<div class="row-fluid">
							<div class="span6 blog-tag-data-inner" style="float: right;"></div>
						</div>
						<div class="news-item-page">
						<blockquote style="display: block !important; font-size: 14px !important;">
							<div class="row-fluid">
								<div class="span4 blog-img blog-tag-data" style="width: 20% !important; padding-right: 10px;">
									<img class="img-responsive" src="<?php echo base_url().$article_index['image']; ?>" alt="">
								</div>
								<div class="blog-article none-font-css"><?php echo $article_index['description']; ?></div>
							</div>
						</blockquote>
							<div class="row-fluid"> <?php echo $article_index['long_description']; ?></div>
						</div>
                    </div>
                </div>
            </div>
            <!-- END Portlet PORTLET-->
        </div>
        <?php echo $calendar; ?>
    </div>
	
	
	
	
    <div class="clearfix"></div>
</div>
<?php echo $feed_chat; ?>