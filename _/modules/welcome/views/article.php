<?php
    $detailArticle = $detailArticle['current'][0];
?>
<!-- BEGIN PAGE HEADER-->
<div class="row-fluid">
	<div class="span12">
		<!-- Begin Logo_partners -->
            <?php echo $logo_partners;?>
        <!-- End Logo_partners -->   
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">
			<strong></strong> 
		</h3>
		<ul class="breadcrumb">
			<li>
				<i class="icon-home"></i>
				<a href="<?php echo base_url() ?>"><?php trans('home') ?></a> 
				<i class="icon-angle-right"></i>
			</li>
            <li><?php echo $detailArticle['title']?></li>
		</ul>
		<!-- END PAGE TITLE & BREADCRUMB-->
	</div>
</div>
<!-- END PAGE HEADER-->

<div id="dashboard">
	<div class="row-fluid">
    	<div class="span8 ">
            <!-- BEGIN Portlet PORTLET-->
            <div class="portlet box yellow">
                <div class="portlet-title">
                    <div style="text-indent:-99999px" class="caption"><!--<i class="icon-reorder"></i>--><?php echo $detailArticle['title']?></div>
                </div>
                <div class="portlet-body">
                    <div class="scroller" data-height="650px" data-always-visible="1" data-rail-visible="1" style="padding-right: 2em !important">
                        <div class="span12 blog-tag-data"> 
                        <h1 class="title_publ"><?php echo $detailArticle['title']?></h1>
                        <div class="row-fluid">
                        <?php 
                         $final_string = '';
                         $string = ltrim(strip_tags($detailArticle['description']));
                         $start = strpos($string,'(');
                         $end = 0;
                         if($start == 0 && substr($string,0,1) == '(')
                         {
                             $end =strpos($string,')');
                             $final_string = substr($string,$start,$end+1);
                             $tags_string = substr($string,$start+1,$end-1);
                             $final_string_2 = substr($detailArticle['description'],$end);
                             $no = str_replace($final_string, "", $detailArticle['description']);
                              
                        ?>  
                            <div class="span6">
                                <ul class="unstyled inline blog-tags">
                                    <li>
                                        <i class="icon-tags"></i> 
                                        <!--a href="#">Technology</a> 
                                        <a href="#">Education</a-->
                                        <?php echo isset($tags_string) ?  $tags_string : '' ; ?>
                                    </li>
                                </ul>
                            </div>
                        <?php  } ?>
                            <div class="span6 blog-tag-data-inner" style="float: right;">
                                <ul class="unstyled inline"  style="float: right;">
                                    <li><i class="icon-calendar"></i>
                                        <?php
                                            $date_add = $detailArticle['date_added'];
                                        	$date_add = strtotime($date_add);
                                        	echo date('d-m-Y', $date_add);
                                            $base_url = base_url();
                                        ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="news-item-page">
                        <blockquote style="display: block !important; font-size: 14px !important;">
                            <div class="row-fluid">
                                 <?php if($detailArticle['image'] != 'assets/upload/images/no-image.jpg'){ ?>   
                                 <div class="span4 blog-img blog-tag-data" style="width: 20% !important; padding: 5px;">
                                        <img class="img-responsive" alt="" src="<?php echo $base_url.$detailArticle['image'] ?>"/>
                                        
                                 </div>  
                                 <?php } ?>                           
                                        <div class="blog-article none-font-css">
                                        
                                        <p style="font-size: 14px !important; font-weight: normal !important;">
                                        <?php echo isset($no) ? $no : $detailArticle['description']; ?>
                                        </p>
                                        
                                        
                                        
                                        </div>
    									<!-- small>Someone famous <cite title="Source Title">Source Title</cite></small -->
                            </div>
                        </blockquote>
                            <div class="row-fluid">
                            
                            <?php echo $detailArticle['long_description']?>
                            </div>
                            <?php if($detailArticle['url'] != ''){ ?>
                            <a href="<?php echo $detailArticle['url']; ?>" class="btn blue" target="_blank">
						    <?php trans('see_more') ?> <i class="m-icon-swapright m-icon-white"></i>
							</a>
                            <?php } ?>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Portlet PORTLET-->
        </div>
        
        <div class="span4 ">
            <!-- BEGIN Portlet PORTLET-->
            <?php
                $article_relative = $article_relative['current'];
                if(count($article_relative) > 0)
                {
            ?>
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-reorder"></i><?php trans('article_relative') ?></div>
                </div>
                <div class="portlet-body">
                    <div class="scroller" data-height="650px" data-always-visible="1" data-rail-visible="1">
                        <div class="span12">
                            <div class="top-news">
                            <?php
                                
                                foreach($article_relative as $key=>$value)
                                {
                                    $link = base_url() . "article/{$value['category_id']}/{$value['article_id']}/". utf8_convert_url($value['title']) .".html";
                            ?>
                                    <a href="<?php echo $link ?>" class="btn">
                					<span style="display: inline !important; text-align: left;"><?php echo $value['title'] ?></span>
                                    
                					<em style="display: inline-block;">
                    					- <i class="icon-calendar" style="font-size: 12px;">
                    					<?php echo date('d-m-Y',strtotime($value['date_added'])) ?></i>
                                        <?php 
                                             $final_string = '';
                                             $string = ltrim(strip_tags($value['description']));
                                             $start = strpos($string,'(');
                                            // $end = strpos($string,')');
                                             if($start == 0 && substr($string,0,1) == '(')
                                             {
                                                 $end =strpos($string,')');
                                                 $final_string = substr($string,$start,$end+1);
                                                 $tags_string = substr($string,$start+1,$end-1);
                                                 //   $final_string_2 = substr($blog['description'],$end);
                                                // $no = str_replace($final_string, "", $value['description']);
                                              
                                        ?>
                                        <i class="icon-tags" style="font-size: 12px;">
                					       <?php echo isset($tags_string)? $tags_string : '' ; }?></i>
                                    
                					</em>
                                             
                					</a>
                            <?php      
                                }
                            ?>
                            <!--
                                <a href="detail_black_ops.html" class="btn green">
                                <span>Black &amp; Scholes</span>                           
                                </a>
                                <a href="#" class="btn yellow">
                                <span>Black Options</span>                             
                                </a>
                                <a href="#" class="btn red">
                                <span>Options Pricing</span>
                                </a>
                            -->
                            </div>
                            
                            
                            <div class="space20">
                          
                            
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <?php 
                }
            ?>
            <!--
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-reorder"></i>Others</div>
                </div>
                <div class="portlet-body">
                    <div class="scroller" data-height="180px" data-always-visible="1" data-rail-visible="1">
                        <div class="span12">
                            <div class="top-news">
                                <a href="#" class="btn green">
                                <span>Black &amp; Scholes</span>                           
                                </a>
                                <a href="#" class="btn yellow">
                                <span>Black Options</span>                          
                                </a>
                                <a href="#" class="btn red">
                                <span>Options Pricing</span>
                                </a>
                                
                            </div>
                            <div class="space20"></div>
                            
                        </div>
                    </div>
                </div>
            </div>
            -->
            <!-- END Portlet PORTLET-->
        </div>
    </div>
	<div class="clearfix"></div>	
</div>

<style>
.none-font-css p{ 
    font-size: 14px;
    line-height: 1.5;
    padding-top: 5px;
}   
</style>