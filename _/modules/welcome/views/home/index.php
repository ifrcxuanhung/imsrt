<!-- BEGIN PAGE HEADER-->
<h3 class="page-title"><?php trans('Home'); ?></h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="<?php echo base_url(); ?>"><?php trans('Home'); ?></a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="breaking-news">
            <span><?php echo trans('hightlights'); ?></span>
            <ul>
                <?php
                if($article_hightlights['current'])
                    foreach($article_hightlights['current'] as $key => $value) {
                        $date_add = $value['date_creation'];
                        $date_add_d = substr($date_add, 0, 10);
                        $date_add_h = substr($date_add, 11, 5);
                        
                        $date_add_d = date('d-m-Y', strtotime($date_add_d));
        
                        $link = base_url() . "article/{$value['clean_cat']}/{$value['clean_artid']}/". utf8_convert_url($value['title']) .".html";
                        ?>
                        <li><a href="<?php echo $link; ?>" title="<?php echo $value['title']; ?>"><?php echo $value['title']; ?></a></li>
                        <?php
                    }
                ?>
            </ul>
        </div>
    </div>
</div>
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT -->
<div class="row">
    <div class="col-md-7">
        <div class="portlet box yellow">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-speech"></i>
                    <?php trans('The project'); ?>
                </div>
            </div>
            <div class="portlet-body">            
                <div class="scroller" data-height="650px" data-always-visible="1" data-rail-visible="1">
                <div class="col-md-12 col-sm-12 article-block">
                    <h3 style="color: #428bca;"><?php echo $article['title']; ?></h3>
                    <div class="blog-tag-data">
                    <blockquote class="media">
                        <a class="pull-left">
                        <img alt="" style="width: 10em;" class="media-object" src="<?php echo base_url().$article['image']?>"/>
                        </a>
						<div class="media-body">
							 <?php echo $article['description']; ?>
						</div>
					</blockquote>	
					</div>
                    <hr />
                    <div class="row">
                        <div class="col-md-12 col-sm-12 blog-article"><?php echo $article['long_description']; ?></div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-calendar"></i>
                    <?php trans('Calendar'); ?>
                </div>
            </div>
            <div class="portlet-body">
                <div class="scroller" data-height="650px" data-always-visible="1" data-rail-visible="1">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <ul class="timeline">
                                <?php
                                if($calendar['current'])
                                    foreach($calendar['current'] as $key => $value) {
                                        $meta_keyword = $value['meta_keyword'];
                                        $arr_meta_keyword = explode('-', $meta_keyword);
                                        $year = isset($arr_meta_keyword['0']) ? $arr_meta_keyword['0'] : "";
                                        $quy = isset($arr_meta_keyword['1']) ? $arr_meta_keyword['1'] : "";

                                        $meta_description = $value['meta_description'];
                                        $arr_meta_description = explode('-', $meta_description);
                                        $color = isset($arr_meta_description['0']) ? $arr_meta_description['0'] : "red";
                                        ?>
                                        <li class="timeline-<?php echo $color; ?> fix">
                                            <div class="timeline-time">
                                                <span class="date"><?php echo $year; ?></span>
                                                <span class="time"><?php echo $quy; ?></span>
                                            </div>
                                            <div class="timeline-icon">
                                                <i class="fa fa-trophy"></i>
                                            </div>
                                            <div class="timeline-body">
                                                <h2><?php echo $value['title']; ?></h2>
                                                <div class="timeline-content"><?php echo $value['description']; ?></div>
                                                <div class="timeline-footer">
                                                    <a href="#" class="nav-link pull-right">
                                                        <?php trans('Read more'); ?>
                                                        <i class="m-icon-swapright m-icon-white"></i> 
                                                    </a>  
                                                </div>
                                            </div>
                                        </li>
                                        <?php
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-bell"></i>
                    <?php trans('hightlights'); ?>
                </div>
            </div>
            <div class="portlet-body">
                <div class="scroller" data-height="250px" data-always-visible="1" data-rail-visible="1">
                    <div class="row">
                        <?php
                        if($article_hightlights_bottom['current'])  
                            foreach($article_hightlights['current'] as $key => $value) {
                                $date_add = $value['date_creation'];
                                $date_add_d = substr($date_add, 0, 10);
                                $date_add_h = substr($date_add, 11, 5);
                                
                                $date_add_d = date('d-m-Y', strtotime($date_add_d));
                                $link = base_url() . "article/{$value['clean_cat']}/{$value['clean_artid']}/". utf8_convert_url($value['title']) .".html";
                                ?>
                                <div class="media">
                                    <a class="pull-left" href="#"><img class="media-object" width="45" height="45" src="<?php echo base_url().$value['image']; ?>" alt=""></a>
                                    <div class="media-body">
                                        <a href="<?php echo $link; ?>">
                                            <h4 class="media-heading"><?php echo $value['title']; ?></h4>
                                        </a>
                                        <?php echo $value['description'] ?>
                                    </div>
                                </div>
                                <?php  
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END PAGE CONTENT -->    