
<!--<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="<?php echo base_url(); ?>">Home</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#"><?php echo $menu['name']; ?></a>
		</li>
	</ul>
</div>-->
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<div class="row">
    <div class="tabbable tabbable-custom tabbable-full-width">
    <?php if(count($array)>0) { ?>
		<ul class="nav nav-tabs">
            <?php $count = 0;  if(isset($listcate)){ foreach($listcate as $value) {
            ?>
            <li class="<?php echo $count == 0 ? "active" : "" ?>"><a href="#tab_<?php echo $value['category_code'] ?>" data-toggle="tab"><?php echo $value['name'] ?></a></li>
            <?php $count++;}} ?>
		</ul>
    <?php  } ?>
        <div class="tab-content">
        <?php $count = 0;
        if(isset($listcate)){
        foreach($listcate as $value){ 
        ?>
            <div id="tab_<?php echo isset($value['category_code']) ? $value['category_code'] : ""; ?>" class="tab-pane <?php echo $count == 0  ? "active" : "" ?>">
                <?php if(count($value['article']['current']) > 0){ ?>
                    <div class="<?php echo $checkLinkWebsite == 1 ? 'col-md-9' : 'col-md-12'; ?> article-block">
                    
                           
                    <?php       $total = ceil(count($value['article']['current'])/10) ;
                                foreach ($value['article']['current'] as $blog){
                                    $link = base_url() . "art_vnefrc/{$blog['category_id']}/{$blog['article_id']}/". utf8_convert_url($blog['title']) .".html";
                                    $base_url = base_url();                      
                    ?>
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 col-xs-4 blog-img blog-tag-data" style="width: 20% !important;">
                                            <?php if($checkimg == '1') { ?>
                                            <img src="<?php echo $base_url.$blog['image'] ?>" alt="" style="margin-top: 1.5em; width: 15em;" class="img-responsive"/>
                                            <?php } ?>
                                            <?php if($checkdate == '1'){ ?>
                                            <ul class="list-inline">
                                            	<li>
                                            		<i class="fa fa-calendar"></i>
                                            		<a href="#">
                                            		<?php echo date('d/m/Y',strtotime($blog['date_added'])) ?> </a>
                                            	</li>
                                            </ul>
                                            <?php }
                                                 $final_string = '';
                                                 $string = ltrim(strip_tags($blog['description']));
                                                 $start = strpos($string,'(');
                                                 if($start == 0 && substr($string,0,1) == '(')
                                                 {
                                                     $end =strpos($string,')');
                                                     $final_string = substr($string,$start,$end+1);
                                                     $tags_string = substr($string,$start+1,$end-1);
                                                     $no = str_replace($final_string, "", $blog['description']);
                                            ?>
                                            <ul class="list-inline blog-tags">
                                            	<li>
                                            		<i class="fa fa-tags"></i>
                                            		<a href="#">
                                            		<?php echo isset($tags_string) ?  $tags_string : '' ; ?> </a>
                                            	</li>
                                            </ul>
                                            <?php } ?>
                                        </div>
                                        <div class="<?php echo $checkimg == 1 ? 'col-md-8 col-sm-8 col-xs-8' : 'col-md-12 col-sm-12 col-xs-12'; ?> blog-article " style="width: 80% !important;">
                                            <h3 style="color:#428bca;">
                                                <?php echo $blog['title'] ?>
                                            </h3>
                                            <p>
                                      	         <?php echo isset($no) ? $no : $blog['description']; ?>
                                            </p>
                                             <?php if($checkseemore == '1'){ ?>
                                            <a class="btn btn-xs blue" href="<?php echo $link; ?>">
                                                <?php trans('see_more') ?> <i class="m-icon-swapright m-icon-white"></i>
                                            </a>
                                            <?php  } ?>
                                        </div>
                                    </div>
                                    <hr/>
                                <?php } ?>
                              <?php
                             
                            	if($total > 1)
                            	{
		                      ?>                    
                                <!--/div-->
                                <ul class="pagination pull-right" class="pagenumber">
                        			<li>
                        				<a href="#">
                        				<i class="fa fa-angle-left"></i>
                        				</a>
                        			</li>
                                    <?php
                        				for($i = 1; $i <= $total; $i++)
                        				{
                        					$current = ($i == 1) ? "class='current'" : "";
                        					echo '<li><a cate_code="" href="javascript:void(0)" '.$current.'>'.$i.'</a></li>';
                        				}
                        			?>
                        			<li>
                        				<a href="#">
                        				<i class="fa fa-angle-right"></i>
                        				</a>
                        			</li>
                   		       </ul>
                            <?php } ?>
                            
                    </div>
                   <?php } else { ?>
                            	<div class="<?php echo $checkLinkWebsite == 1 ? 'col-md-9 col-sm-9' : 'col-md-12 col-sm-12'; ?> blog-article">
                                <h3><?php trans('Updating..')?></h3>          
                                </div> 
                    <?php } ?>        
                            
                        <!--end col-md-8-->
                     <?php
                    if($checkLinkWebsite == 1) {
                    ?> 
                        <div class="col-md-3 blog-sidebar">
                           <!-- <h3><?php trans('link_website') ?></h3>-->
                            <ul class="ver-inline-menu tabbable margin-bottom-10 tabbable-full-width">
                              <?php if(count($value['article']['current']) > 0){ 
                                        foreach($value['article']['current'] as $value)
                                        {
                                            $link = base_url() . "art_vnefrc/{$value['category_id']}/{$value['article_id']}/". utf8_convert_url($value['title']) .".html";
                              ?>
                                <li style="line-height: 2em;"><a style="padding-left: 10px;" href="<?php echo $link ?>">
                                    <!--i class="fa fa-link"></i-->
                                    <?php echo $value['title'] ?>
                               <?php if($checkdate == '1'){ ?>
                                    <p>- <?php echo date('d/m/Y',strtotime($value['date_added'])) ?></p>
                               <?php }
                                         $final_string = '';
                                         $string = ltrim(strip_tags($value['description']));
                                         $start = strpos($string,'(');
                                        // $end = strpos($string,')');
                                         if($start == 0 && substr($string,0,1) == '(')
                                         {
                                             $end =strpos($string,')');
                                             $final_string = substr($string,$start,$end+1);
                                             $tags_string = substr($string,$start+1,$end-1);
                                ?>
                                    <p>
                                    <i class="fa fa-tags"></i>
                                    <?php echo isset($tags_string)? $tags_string : '' ; ?> 
                                    </p> 
                                    <?php } ?>
                                    <!--i class="fa fa-briefcase top-news-icon"></i-->
                                </a></li>
                                 <?php
                                        }
                                    }
                                ?>
                            </ul>
                        </div>
                <?php } ?>
                        <!--end col-md-4-->
          </div>
        <?php $count++; }
        } ?>
            
        </div>
    </div>
</div>
<!-- END PAGE CONTENT-->