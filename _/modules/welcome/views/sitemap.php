<?php // print_r($menu);exit; ?>
<div class="row">
<?php 
    $i = 0;
	$flag = 0;
    foreach($menu as $key => $value) {
		if(isset($value['cmenu'])){
			if(count($value['cmenu'])  >= $flag){
				$flag = count($value['cmenu']);
			}
			
		}
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
    <div class="col-md-2">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="<?php echo isset($value['image']) ? $value['image'] : 'hide';?>"></i><?php echo $value['name']; ?></div>
                <div class="tools">
                    <a class="collapse" href="javascript:;" data-original-title="" title=""> </a>
                </div>
            </div>
            <?php if(isset($value['cmenu'])) { ?>
            <div class="portlet-body height_sitemap" >
                 <?php
                    
                      //  echo '<ul class="dropdown-menu pull-left">';
                        foreach($value['cmenu'] as $k => $v) {
                            if(substr($v['link'], 0, 4) != 'html') {
                                $link = base_url().$v['link'];
                            } else {
                                $link = $v['link'];
                            }
                            ?>
                <p class="text-muted"><a href="<?php echo $link ?>"><?php echo $v['name']; ?></a> </p>
                <?php 
                    }
                 ?>
                <!--p class="text-primary"> Primary text here </p>
                <p class="text-success"> Success text here </p>
                <p class="text-info"> Info text here </p>
                <p class="text-warning"> Warning text here </p>
                <p class="text-danger"> Danger text here </p-->
            </div>
            <?php } ?>
        </div>
    </div>
    <?php
    } ?>
    <div class="get_flag" attr="<?php echo $flag;?>"></div>
</div>
