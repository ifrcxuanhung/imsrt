<!-- BEGIN PAGE HEADER-->
<?php
    $detailArticle = $detailArticle['current'][0];
?>

<!--<div class="page-bar">
    
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="<?php echo base_url(); ?>">Home</a>
			<i class="fa fa-angle-right"></i>
		</li>
        <li>
			<a href="#"><?php echo $detailArticle['name']?></a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#"><?php echo $detailArticle['title']?></a>
		</li>
	</ul>
</div>-->
<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-md-12 blog-page">
       <div class="row"> 
	       <div class="col-md-9 article-block">
                	<h3 style="color: #428bca;"><?php echo $detailArticle['title']?></h3>
                    <div class="row">
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
									<div class="col-md-6">
										<ul class="list-inline blog-tags">
											<li>
												<i class="fa fa-tags"></i>
												<a href="#">
												<?php echo isset($tags_string) ?  $tags_string : '' ; ?></a>
											</li>
										</ul>
									</div>
                        <?php } ?>
									<div class="col-md-6 blog-tag-data-inner">
										<ul class="list-inline">
											<li>
												<i class="fa fa-calendar"></i>
												<a href="#">
												<?php echo date('d/m/Y',strtotime($detailArticle['date_added'])); ?> </a>
											</li>
										</ul>
									</div>
				    </div>
					<div class="blog-tag-data">
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-2 blog-img blog-tag-data">
                                <img src="<?php echo base_url().$detailArticle['image']?>" alt="" class="img-responsive" />
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-10 blog-article">
                	                   <?php echo isset($no) ? $no : $detailArticle['description']; ?>
                                     <small><?php echo isset($tags_string) ?  $tags_string : '' ; ?> <!--cite title="Source Title">Source Title</cite--></small>
                                      <hr />
                                     <?php echo $detailArticle['long_description']; ?>
                                      <?php if($detailArticle['url'] != ''){ ?>
                                    <div class="space20"></div>
                                        <?php 
                                        if((strpos($detailArticle['url'], 'http')!==false) || (strpos($detailArticle['url'], 'https')!==false)) {
                                        ?>
                                        <a href="<?php echo $detailArticle['url']; ?>" class="btn btn-xs blue" target="_blank">
                                        <?php 
                                        }
                                        else if((strpos($detailArticle['url'], 'www')!==false)) {
                                        ?>
                                        <a href="<?php echo "http://".$detailArticle['url']; ?>" class="btn btn-xs blue" target="_blank">
                                        <?php 
                                        }else { 
                                        ?>
                                       <a href="<?php echo  base_url().$detailArticle['url']; ?>" class="btn btn-xs blue" target="_blank">
                                        <?php }
                                         trans('see_more') ?> <i class="m-icon-swapright m-icon-white"></i>
                                    </a>
                                    <hr/>
                                    <?php } ?>
                            </div>
                        </div>
                       <!-- <hr />-->	
					</div>
							<!--end news-tag-data-->
							<!--<div>
								<?php //echo $detailArticle['long_description']; ?>
							</div>-->
                    
                   
            </div> 
            <div class="col-md-3 blog-sidebar">
                <?php
                $article_relative = $article_relative['current'];
                if(count($article_relative) > 0)
                {
                ?>
						<h3><?php trans('article_relative') ?></h3>
						<ul class="ver-inline-menu tabbable margin-bottom-10 tabbable-full-width">
                         <?php
                                
                                foreach($article_relative as $key=>$value)
                                {
                                    $link = base_url() . "article/{$value['category_id']}/{$value['article_id']}/". utf8_convert_url($value['title']) .".html";
                         ?>
                            <li style="line-height: 2em;"><a style="padding-left: 10px;" href="<?php echo $link ?>">
                            <!--i class="fa fa-link"></i-->			
							<?php echo $value['title'] ?>
							<em style="font-size:10px;">- <?php echo date('d/m/Y',strtotime($value['date_added'])) ?></em>
                            <?php 
                                     $final_string = '';
                                     $string = ltrim(strip_tags($value['description']));
                                     $start = strpos($string,'(');
                                     if($start == 0 && substr($string,0,1) == '(')
                                     {
                                         $end =strpos($string,')');
                                         $final_string = substr($string,$start,$end+1);
                                         $tags_string = substr($string,$start+1,$end-1);              
                            ?>
							<em>
							<i class="fa fa-tags"></i>
							<?php echo isset($tags_string)? $tags_string : '' ; ?> </em>
                            <?php     } ?>
							</a></li>
                        <?php   } ?>	
                        </ul>
                 <?php } ?>
                 </div>
            </div>
        </div>
    </div>
 </div>