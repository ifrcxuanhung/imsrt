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
                	<h3 style="color: #428bca;" class="text-uppercase"><?php echo $detailArticle['title']?></h3>
                    <div class="row">
                     <?php 
                        $image = explode("/",$detailArticle['images']);
                        $file = end($image);
                        array_pop($image);
                        $path1 = implode("/",$image);
                        $path2 = $path1.'/thumb/450_'.$file;
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
				    </div>
					<div class="blog-tag-data">
                        <div class="row">
                        <?php if($file!='') { ?>
                            <div class="col-md-2 col-sm-2 col-xs-2 blog-img blog-tag-data">
                                <img src="<?php echo PATH_IFRC_ARTICLE.$path2 ?>" alt="" class="img-responsive" />
                            </div>
                            <?php } ?>
                            <div class="col-md-10 col-sm-10 col-xs-10 blog-article">
                	                   <?php echo isset($no) ? $no : $detailArticle['description']; ?>
                                     <small><?php echo isset($tags_string) ?  $tags_string : '' ; ?> <!--cite title="Source Title">Source Title</cite--></small>
                                      <hr />	
                                      <div>
										<?php echo $detailArticle['long_description']; ?>
                                    </div>
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
                                             trans('_website') ?> <i class="m-icon-swapright m-icon-white"></i>
                                        </a>
                                        <hr/>
                                        <?php } ?>
                            </div>
                        </div>
                       <!-- <hr />	-->
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
                         <ul class="ver-inline-menu tabbable margin-bottom-10 ">
                         <?php
                                
                                foreach($article_relative as $key=>$value)
                                {
                                    $link = base_url() . "article/{$value['clean_cat']}/{$value['clean_artid']}/". utf8_convert_url($value['title']) .".html";
                         ?>
                         
                            <li class="">
                              <a href="<?php echo $link ?>" style=" display:flex;">
                                    <i class="fa fa-briefcase"></i>
                                     <div style="float:right; width:100%; padding:8px 0px;">
											 <?php echo $value['title']; ?>
                                        </div>
                                    </a>    
                            </li>
                        <?php   } ?>	
                        </ul>
                 <?php } ?>
                 </div>
            </div>
        </div>
    </div>
