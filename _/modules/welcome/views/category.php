<!-- BEGIN PAGE HEADER-->
<div class="row">
	<div class="col-md-12">
    	<!-- Begin Logo_partners -->
        <?php echo $logo_partners;?>
        <!-- End Logo_partners --> 
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title" style="font-family: sans-serif;"><strong><?php echo $menu['name']; ?></strong>
		</h3>
		<ul class="breadcrumb">
			<li>
				<i class="icon-home"></i>
				<a href="<?php echo base_url() ?>"><?php trans('Home') ?></a> 
				<i class="icon-angle-right"></i>
			</li>
			<li>
				<a href="<?php echo base_url().$menu['link']; ?>"><?php echo $menu['name']; ?></a>
			</li> 
		</ul>
		<!-- END PAGE TITLE & BREADCRUMB-->
	</div>
</div>
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<div class="row">
    <div class="tabbable tabbable-custom tabbable-full-width" id="cate_tab">
    <?php if(count($array)>0) { ?>
        <ul class="nav nav-tabs">
        <!--li class="active"><a href="#<?php // echo $value['category_code'] ?>" data-toggle="tab"><?php //echo $value['name'] ?></a></li-->
        <?php $count = 0; foreach($listcate as $value) {
            //print_r($listcate[0]['category_code']);exit;
            ?>
            <li class="<?php echo $count == 0 ? "active" : "" ?>"><a href="#tab_<?php echo $value['category_code'] ?>" data-toggle="tab"><?php echo $value['name'] ?></a></li>
        <?php $count++;} ?>
        </ul>
    <?php  } ?>
        <div class="tab-content">
    
        <?php $count = 0;
        foreach($listcate as $value){ 
        ?>
    <div class="tab-pane <?php echo $count == 0  ? "active" : "" ?>" id="tab_<?php echo isset($value['category_code']) ? $value['category_code'] : ""; ?>">
        <div class="row">
            <div class="col-md-8 blog-tag-data">
			<!--h1><?php //echo $menu['name']; ?></h1-->
                        
            <?php if(count($value['article']['current']) > 0){ ?>
					
                <?php foreach ($value['article']['current'] as $blog)
                    {
                    $link = base_url() . "article/{$blog['category_id']}/{$blog['article_id']}/". utf8_convert_url($blog['title']) .".html";
                    $base_url = base_url();
                  //  print_R($base_url.$blog['image']);exit;
                    ?>
                    
                        <div class="row">	
                            <?php if($checkimg == '1') { ?>
    								<div class="col-md-4 blog-img blog-tag-data" style="width: 20% !important;">
    									<img class="img-responsive" alt="" style="margin-top: 1.5em;" src="<?php echo $base_url.$blog['image'] ?>"/>
    									<?php if($checkdate == '1'){ ?>
                                        <ul class="inline">
    										<li style="width:12em;">
    											<i class="icon-calendar"></i>
                                                <!--?php trans('Date-added') ?-->
    										      <?php echo date('d/m/Y',strtotime($blog['date_added'])) ?> 
    										</li>
    										<!--li>
    											<i class="fa fa-comments"></i>
    											<a href="#">
    											38 Comments </a>
    										</li-->
    									</ul>
                                        <?php 
                                        }   
                                         $final_string = '';
                                         $string = ltrim(strip_tags($blog['description']));
                                         $start = strpos($string,'(');
                                        // $end = strpos($string,')');
                                         if($start == 0 && substr($string,0,1) == '(')
                                         {
                                             $end =strpos($string,')');
                                             $final_string = substr($string,$start,$end+1);
                                             $tags_string = substr($string,$start+1,$end-1);
                                             //   $final_string_2 = substr($blog['description'],$end);
                                             $no = str_replace($final_string, "", $blog['description']);
                                          
                                        ?>
    									<ul class="inline blog-tags">
    										<li>
    											<i class="icon-tags"></i>
    										
    											<?php echo isset($tags_string) ?  $tags_string : '' ; ?>
    											<!--a href="#">
    											Education </a>
    											<a href="#">
    											Internet </a-->
    										</li>
    									</ul>
                                        <?php  } ?>
    								</div>
                             <?php } ?>       
                                    
    								<div class="<?php echo $checkimg == 1 ? 'col-md-8' : 'col-md-12'; ?> blog-article">
    									<h3 style="line-height: 30px; color: #0d638f;">
    									<?php echo $blog['title'] ?>
    									</h3>
    									<p>
    										<?php echo isset($no) ? $no : $blog['description']; ?>
    									</p>
    									 <?php if($checkseemore == '1'){ ?>
    									<a href="<?php echo $link; ?>" class="btn btn-sm blue">
    								    <?php trans('see_more') ?> <i class="m-icon-swapright m-icon-white"></i>
    									</a>
                                        <?php } ?>
    								</div>
            				</div>
        				<hr />
            	    
                    <?php } ?>
            <?php }else { ?>
            	<div class="col-md-8 blog-article">
                <h3><?php trans('updating')?></h3>          
                </div>  
            <?php } ?>   
            </div>   
            <div class="col-md-4">
                <h2><?php trans('link_website') ?></h2>
                <div class="top-news">
        <?php if(count($value['article']['current']) > 0){ ?>
                <?php
                    foreach($value['article']['current'] as $value)
                    {
                    $link = base_url() . "article/{$value['category_id']}/{$value['article_id']}/". utf8_convert_url($value['title']) .".html";
                ?>
                    <a href="<?php echo $link ?>" class="btn green">
                    <span style="display: inline !important; text-align: left;"><?php echo $value['title'] ?></span>
                    
                    <em style="display: inline-block; font-family: 'Segoe UI',Helvetica,Arial,sans-serif !important; ">
                    <?php if($checkdate == '1'){ ?>
                        - <i class="icon-calendar" style="font-size: 12px;">
                        <?php echo date('d-m-Y',strtotime($value['date_added'])) ?></i>
                        <?php
                            } 
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
                    }
                ?>
                
                </div>
            </div>
               
                      
            </div>         
        </div>
            
        <?php $count++; } ?>
        </div>
            <!--div class="tab-pane" id="tab_market">
                <div class="row">
                
                </div>
            </div-->
        
    </div>
</div>
<!-- END PAGE CONTENT-->