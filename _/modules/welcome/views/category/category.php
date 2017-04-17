<?php $_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
      $segments = explode('/', $_SERVER['REQUEST_URI_PATH']);
?>
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
    <?php 
	//echo "<pre>";print_r(count($listcate));exit;
    if($scat_arr=='' || is_null($scat_arr)){
    if(count($arr_current['current'])>0 && !is_null($arr_current['current'])) { 
		if(count($listcate) >1 ){
	?>
		<ul class="nav nav-tabs ">
            <?php $count = 0;  if(isset($listcate)){ foreach($listcate as $value) {
            ?>
            <li class="<?php echo $count == 0 ? "active" : "" ?>"><a href="#tab_<?php echo isset($value['clean_scat']) ? $value['clean_scat'] : ""; ?>" data-toggle="tab"><?php echo isset($value['clean_scat']) ? ucfirst($value['clean_scat']) : ""; ?></a></li>
            <?php $count++;}} ?>
		</ul>
    <?php
		}
    }
	?>
   
    
        <div class="tab-content">
        <?php 
		 } ?>
        <?php if(count($arr_current['current'])>0 && !is_null($arr_current['current'])) { ?>
        <?php $count = 0;
        if(isset($listcate) && !is_null($listcate)){
			
        foreach($listcate as $value){ 
        ?>
            <div id="tab_<?php echo isset($value['clean_scat']) ? $value['clean_scat'] : ""; ?>" class="tab-pane <?php echo $count == 0  ? "active" : "" ?>">
                <?php if(count($value['article']['current']) > 0){ ?>
                    <div class="col-md-9 article-block">
                    
                           
                    <?php       $total = ceil(count($value['article']['current'])/10) ;
                                foreach ($value['article']['current'] as $blog){
                                    $link = base_url() . "article/{$blog['clean_cat']}/{$blog['clean_artid']}/". utf8_convert_url($blog['title']) .".html";
                                    //$base_url = base_url(); 
                                    $image = explode("/",$blog['images']);
                                    $file = end($image);
                                    array_pop($image);
                                    $path1 = implode("/",$image);
                                    $path2 = $path1.'/thumb/255_'.$file;
                                    //$string = explode("<hr />", $value['description']);                     
                    ?>
                                    <div class="row"  id="<?php echo $blog['id'];?>">
                                    	<?php if($file!='' && !is_null($file)) {
											?>
                                        <div class="col-md-4 col-sm-4 col-xs-4 blog-img blog-tag-data" style="width: 20% !important;">
                                            <img src="<?php echo PATH_IFRC_ARTICLE.$path2 ?>" alt="" style="margin-top: 1.5em; width: 15em;" class="img-responsive"/>
                                            <!--div class="detail-views">
                                                <a data-rel="fancybox-button" title="Project Name" href="../../assets/admin/pages/media/works/img2.jpg" class="mix-preview fancybox-button">
												    <i class="fa fa-search"></i>
												</a>
                                            </div-->
                                            
                                            <?php 
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
                                        <?php } ?>
                                        <div class="<?php echo 'col-md-8 col-sm-8 col-xs-8' ?> blog-article " style="width: 80% !important;">
                                            <h3 class="text-uppercase" style=" color:#428bca;">
                                                <?php echo $blog['title'] ?>
                                            </h3>
                                            <p>
                                      	         <?php echo isset($no) ? $no : $blog['description']; ?>
                                            </p>
                                             <?php if($blog['long_description'] != ''){ ?>
                                            <a class="btn btn-xs blue" href="<?php echo $link; ?>">
                                                <?php trans('see_more') ?> <i class="m-icon-swapright m-icon-white"></i>
                                            </a>
                                            <?php 
											 } else if(($blog['url'] != '') && (strpos($blog['url'], 'http')!==false) || (strpos($blog['url'], 'https')!==false)) {
												?>
                                            <a class="btn btn-xs blue" target="_blank" href="<?php echo $blog['url']; ?>">
                                                <?php trans('_website') ?> <i class="m-icon-swapright m-icon-white"></i>
                                            </a>
                                            <?php 
											 } else if(($blog['url'] != '') && (strpos($blog['url'], 'www')!==false)) {
												?>
                                            <a class="btn btn-xs blue" target="_blank" href="<?php echo 'http://'.$blog['url']; ?>">
                                                <?php trans('_website') ?> <i class="m-icon-swapright m-icon-white"></i>
                                            </a>
                                            <?php 
											 } else if(($blog['url'] != '')) {
												?>
                                            <a class="btn btn-xs blue" target="_blank" href="<?php echo base_url().$blog['url']; ?>">
                                                <?php trans('_website') ?> <i class="m-icon-swapright m-icon-white"></i>
                                            </a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <hr/>
                                <?php } ?>
                              <?php
                             
                            	if($total > 1)
                            	{
		                      ?>                    
                                <!--/div-->
                                <!--ul class="pagination pull-right" class="pagenumber">
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
                   		       </ul-->
                            <?php } ?>
                            
                    </div>
                   <?php } else { ?>
                            	<div class="'col-md-9 col-sm-9 blog-article">
                                <h3><?php trans('0 article views..')?></h3>          
                                </div> 
                    <?php } ?>        
                            
                        <!--end col-md-8-->
                        <div class="col-md-3">
                           <!-- <h3><?php trans('link_website') ?></h3>-->
                            <ul class="ver-inline-menu tabbable margin-bottom-10 ">
                              <?php if(count($value['article']['current']) > 0){ 
                                        foreach($value['article']['current'] as $value)
                                        {
                                            $link = base_url() . "article/{$value['clean_scat']}/{$value['clean_artid']}/". utf8_convert_url($value['title']) .".html";
                              ?>
                                <!--<li style="line-height: 2em;"><a style="padding-left: 10px;" href="<?php echo $link ?>">-->
                                  <li class="">
                                 
                                  <a href="#<?php echo $value['id'] ?>" style=" display:flex;">
                                    <i class="fa fa-briefcase"></i>
                               			<div style="float:right; width:100%; padding:8px 0px;">
											 <?php echo $value['title']; ?>
                                        </div>
                                        </a>
                                </li>
                                 <?php
                                        }
                                    }
                                ?>
                            </ul>
                        </div>
                        <!--end col-md-4-->
          </div>
        <?php $count++; }
        }
         ?>
        <?php } else { ?>
        	<div class="'col-md-12 col-sm-12 blog-article">
                <h3><?php trans('Updating..')?></h3>          
            </div> 
        <?php } ?>
         <?php if($scat_arr=='' || is_null($scat_arr)){   ?>
        </div>
        <?php } ?>
    </div>
</div>
<!-- END PAGE CONTENT-->