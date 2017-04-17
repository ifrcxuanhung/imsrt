<!-- BEGIN HEADER -->
<style>
.form-control1{
    font-size: 25px;
}
.easy-autocomplete{ width:auto !important;}
.form-control::-moz-placeholder{ color:#FFF; opacity:0.4;}
#eac-container-search_efrc_data_ref ul{ top:100 !important; background:#555555 none repeat scroll 0 0;
    color: #fff;
    font-weight: 300;
}
#eac-container-search_efrc_data_ref li:hover{ background:#000;}
#eac-container-search_efrc_data_ref li:active{ background:#000;}
.easy-autocomplete-container ul li div{ font-family:inherit;}

#eac-container-search_efrc_ins_ref ul{ top:100 !important; background:#555555 none repeat scroll 0 0;
    color: #fff;
    font-weight: 300;
}
#eac-container-search_efrc_ins_ref li:hover{ background:#000;}
#eac-container-search_efrc_ins_ref li:active{ background:#000;}
.top-menu{ margin-top:20px;}
.positive{ color:<?php echo $setting_rt_color_positive['value'];?>}
.negative{ color:<?php echo $setting_rt_color_negative['value'];?>;}

.negative_bg{ background:#dc143c;}
.equal{ color:<?php echo $setting_rt_color_equal['value'];?>;}
.bold{ font-weight:bold;}
.italic{ font-style:italic}
.underline{ text-decoration:underline;}
</style>
<script>

function myFunction() {
    alert("Functionality is developing!");
}
function checkEnter(event)
{
    if (event.keyCode == 13) 
   {
       myFunction();
       return false;
    }
}
</script>

<div class="page-header">
	<!-- BEGIN HEADER TOP -->
	<div class="page-header-top">
		<div class="container-fluid">
			<!-- BEGIN LOGO -->
             <div class="col-xs-6 col-sm-8 col-md-5">
			<div class="page-title" style="width:100%; max-width:100%;">
				<h3 style="margin-top: 30px; margin-bottom: 8px;color:#fcd116 !important; font-weight: bold;">INDEXES <span style="color: red;"> <?php echo trans('title_home')?></span></h3>
               
               
                <div class="col-xs-12 col-sm-12 col-md-12" style="padding:10px;">
               	<?php //include "header_search.php";?>
                </div>
                    
            </div>
            </div>
			<!-- END LOGO -->
            
			<!-- BEGIN RESPONSIVE MENU TOGGLER -->
			
			<!-- END RESPONSIVE MENU TOGGLER -->
			<!-- BEGIN TOP NAVIGATION MENU -->
             <div class="col-xs-6 col-sm-4 col-md-7">
            <a href="javascript:;" class="menu-toggler"></a>
			<div class="top-menu">
                <?php 
				 if($this->router->fetch_class() != 'start'){
                        if(count($user_job) > 0) {
                            foreach($user_job as $uj) {
                            if (!preg_match("/^(http|https|ftp):/", $uj['url'])) {
							   $link = base_url().$uj['url'];
							}else{
								$link = $uj['url'];
							}
                    ?>
         
                    <div class="btn-group hidden-xs hidden-sm align-right">
                        <?php if (isset($uj['icon']) && $uj['icon']!='') { ?>
                         <a href="<?php echo $link ?>" class="btn btn-icon-only tooltips default margin-top-10" data-container="body" data-placement="bottom" data-original-title="<?php echo $uj['name'] ?>">
                        <i class="fa <?php echo $uj['icon'] ?>"></i> 
                         </a>
                        <?php } else { ?>
                          <a href="<?php echo $link ?>" class="btn btn-sm tooltips default margin-top-10" data-container="body" data-placement="bottom" data-original-title="<?php echo $uj['name'] ?>">
                          <?php echo $uj['text'] ?>
                          </a>
                         <?php } ?>
                        
                    </div>
                <?php }
                }
                } ?>
				<ul class="nav navbar-nav pull-right">
                    
					<!-- BEGIN TODO DROPDOWN -->
					<li class="dropdown dropdown-dark dropdown-lang">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<img src="<?php echo template_url() ?>img/<?php echo $curent_language['code'] ?>.png" />
						<!--<span class="badge"><?php echo $curent_language['code'] ?></span>-->
						</a>
						<ul class="dropdown-menu dropdown-menu-default">
						
                            <?php
                                foreach($list_lang as $lang) {
                            ?>
                                <li><a class="switch-language" href="javascript: void(0);" langcode="<?php echo $lang['code'] ?>" style="<?php echo $curent_language['code'] == $lang['code'] ? 'font-weight:bold' : 'font-weight:normal'; ?>">
                                    <img style="<?php echo $curent_language['code'] == $lang['code'] ? '' : 'opacity: 0.5;'; ?>" src="<?php echo template_url() ?>img/<?php echo $lang['code'] ?>.png" />
                                <?php echo $lang['name'] ?></a></li>
                            <?php
                                }
                            ?>
				
						</ul>
					</li>
					<!-- END TODO DROPDOWN -->
					<li class="droddown dropdown-separator">
						<span class="separator"></span>
					</li>
					<!-- BEGIN USER LOGIN DROPDOWN -->
					<li class="dropdown dropdown-user dropdown-dark">
                         <?php
                        // if user logged in
                        if($this->session->userdata_vnefrc('user_id')) {
							 $url = explode("/",$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
					 $baseURL = $url[0];
					 //echo $baseURL;exit;
					 
                            ?>
                            <a href="javascript:;" class="dropdown-dark dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <img alt="" class="img-hide1" src="<?php echo is_file($user['avatar']) ? base_url().$user['avatar'] :  base_url() .'assets/upload/avatar/no_avatar.jpg'; ?>"/>
                            <span class="username username-hide-mobile">
                            <?php echo $this->session->userdata_vnefrc('first_name'); ?> </span>
                            <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-default">
                                <li>
                                    <a href="<?php echo base_url(); ?>profile">
                                    <i class="icon-user"></i> My Profile </a>
                                </li>
                                
                                  <li>
                                    <a href="http://<?php echo $baseURL;?>/user-manage/profile.php"  id="change_password">
                                    <i class="icon-lock"></i> <?php trans('Change password / email'); ?></a>
                                </li>
                                
                                <li>
                                    <a  id="logout_modal">
                                    <i class="icon-key"></i> <?php trans('Log_out'); ?></a>
                                </li>
                            </ul>
                            <?php
                        } else {
                            ?>
							<a id="login_modal" data-target="#login_modals" data-toggle="modal">
							<i class="icon-lock"></i> <?php trans('sign_in'); ?> </a>
							<?php } ?>
					</li>
					<!-- END USER LOGIN DROPDOWN -->
				</ul>
			</div>
            </div>
			<!-- END TOP NAVIGATION MENU -->
		</div>
	</div>
	<!-- END HEADER TOP -->
    <?php if($this->router->fetch_class() != 'start'){ ?>
	<!-- BEGIN HEADER MENU -->
	<div class="page-header-menu">
		<div class="container-fluid">
			<!-- BEGIN HEADER SEARCH BOX -->		
			<!-- END HEADER SEARCH BOX -->
			<!-- BEGIN MEGA MENU -->
			<!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
			<!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
			<div class="hor-menu ">
				<ul class="nav navbar-nav">
					<li class="menu-dropdown classic-menu-dropdown <?php echo $id_menu_actived == 0 ? 'active' : ''; ?>">
                        <input type="hidden" value="<?php echo $id_menu_actived; ?>" />
    					<a class="menu-nav" id-menu="0" href="<?php echo base_url(); ?>" parent="true">
    					<i class="icon-home"></i> <?php echo $id_menu_actived == 0 ? '<span class="selected"></span>' : ''; ?>
    					</a>
    				</li>
                    <?php 
                 // echo "<pre>";print_r($menu);	exit;
                    $i = 0;
                    foreach($menu as $key => $value) {
                        $i++;
                        $classLi = '';
                        $classSubLi = '';
                        $spanSelected = '';
                        if($id_menu_actived != 0) {
                            if($value['id'] == $id_menu_actived) {
                                $classLi = ' active';
                                $classSubLi = ' active';
                                $spanSelected = '<span class="selected"></span>';
                            }
                        }
						
                        $menu_syb_clas = isset($value['cmenu']) ? ' data-hover="megamenu-dropdown" data-close-others="true" class="menu-nav dropdown-toggle"' :  'class="menu-nav"' ;
                        if(substr($value['link'], 0, 4) != "html") {
                            $link = base_url().$value['link'];
							
                        } else {
                            $link = $value['link'];
                        }
                    ?>
                    <li class='menu-dropdown classic-menu-dropdown <?php echo $classLi != '' ? " active" : "" ; ?>'>
                        <input type="hidden" value="<?php echo $id_menu_actived; ?>" />
    					<a id-menu="<?php echo $value['id']; ?>" href="<?php echo ($value['link'] != '#')? $link:"javascript:void(0)"; ?>" parent="true" <?php echo $menu_syb_clas;?>>
    					<i class="<?php echo isset($value['image']) ? $value['image'] : 'hide';?>"></i><span class="menu-hide-table"><?php echo $value['name']; ?></span></samp><i class="<?php echo isset($value['cmenu']) ? 'fa fa-angle-down' : 'hide';?>"></i>
                        <?php echo $spanSelected; ?>
    					</a>
                         <?php
                            if(isset($value['cmenu'])) {
                                echo '<ul class="dropdown-menu pull-left">';
                                foreach($value['cmenu'] as $k => $v) {
                                    if(substr($v['link'], 0, 4) != 'html') {
                                        $link = base_url().$v['link'];
                                    } else {
                                        $link = $v['link'];
                                    }
                                    ?>
        						<li class="<?php echo isset($v['cmenu']) ? 'dropdown-submenu ' : ''; ?> <?php echo $classSubLi; ?>">
        							<a class="menu-nav" id-menu="<?php echo $v['id']; ?>" href="<?php 
									
									$get_link = explode("link:",$link);
									$http='';
									if(isset($get_link[1])){
										echo  $get_link[1];
									}
									else
										echo $link;
									
									?>" parent="false">
        							<?php echo $v['name']; ?>
                                    </a>
                                     <?php
                                            if(isset($v['cmenu'])) {
                                                echo '<ul class="dropdown-menu">';
                                                foreach($v['cmenu'] as $cm) {
                                                    if(substr($cm['link'], 0, 4) != 'html') {
                                                        $link = base_url().$cm['link'];
                                                    } else {
                                                        $link = $cm['link'];
                                                    }
                                     ?>
            							<li class="<?php echo $classSubLi; ?>">
            								<a class="menu-nav" id-menu="<?php echo $cm['id']; ?>" href="<?php echo $link; ?>" parent="false">
                                                <?php echo $cm['name']; ?>
                                            </a>
            							</li>
        							<?php
                                                }
                                                echo '</ul>';
                                            }
                                            ?>
                                </li>
                                <?php
                                }
                                echo '</ul>';
                            }
                            ?>
                        </li>
                    <?php        
                    }
                    unset($menu);
                ?>
                     <li class="menu-dropdown">
    					<a data-toggle="dropdown" class="btn dropdown-toggle" href="javascript:;" aria-expanded="false">
    					<i class="icon-magnifier"></i>
    					</a>
                        <div class="dropdown-menu dropdown-custom hold-on-click">
                       	    <form class="search-form" action="<?php echo base_url() ?>search/" method="GET" id="searchform">
                				<div class="input-group btn-search">
                					<input type="text" class="form-control" placeholder="Search" id="s" name="query">
                					<span class="input-group-btn">
                					<a type="submit" class="btn submit" id="search-submit" class="search_submit"><i class="icon-magnifier"></i></a>
                					</span>
                				</div>
                			</form>
                        </div>
                    </li>
				</ul>
			</div>
			<!-- END MEGA MENU -->
		</div>
	</div>
    <?php } ?>
	<!-- END HEADER MENU -->
</div>
<!-- END HEADER -->
<style>
.btn-search{
  padding:5px 10px;
    
}
</style>