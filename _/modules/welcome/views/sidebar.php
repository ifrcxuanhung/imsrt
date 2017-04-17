<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse in">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <li class="sidebar-toggler-wrapper">
                <div class="languages">
                <?php
                if($list_lang)
                    foreach($list_lang as $lang) {
                        ?>
                        <a class="switch-language" href="javascript: void(0);" langcode="<?php echo $lang['code']; ?>">
                            <img style="<?php echo $curent_language['code'] == $lang['code'] ? '' : 'opacity: 0.5;'; ?>" src="<?php echo template_url(); ?>img/<?php echo $lang['code']; ?>.png" alt="" />
                        </a>
                        <?php
                    }
                ?>
                </div>
            </li>
            <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
            <li class="sidebar-search-wrapper">
                <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
                <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
                <form class="sidebar-search " action="" method="POST">
                    <a href="javascript: void(0);" class="remove">
                    <i class="icon-close"></i>
                    </a>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="<?php trans('Search'); ?>..."/>
                        <span class="input-group-btn">
                        <a href="javascript:;" class="btn submit" disabled="disabled"><i class="icon-magnifier"></i></a>
                        </span>
                    </div>
                </form>
                <!-- END RESPONSIVE QUICK SEARCH FORM -->
            </li>
            <li class="start<?php echo $id_menu_actived == 0 ? ' active' : ''; ?>">
                <input type="hidden" value="<?php echo $id_menu_actived; ?>" />
                <a class="menu-nav" id-menu="0" href="<?php echo base_url(); ?>" parent="true">
                    <i class="icon-home"></i> 
                    <span class="title">
                        <?php trans('Home') ?>
                    </span>
                    <?php echo $id_menu_actived == 0 ? '<span class="selected"></span>' : ''; ?>
                </a>
            </li>
            <?php 
                $i = 0;
                foreach($menu as $key => $value) {
                    $i++;
                    $classLi = '';
                    $classSubLi = '';
                    $spanSelected = '';
                    if($id_menu_actived != 0) {
                        if($value['id'] == $id_menu_actived) {
                            $classLi = ' class="active open"';
                            $classSubLi = ' class="active"';
                            $spanSelected = '<span class="selected"></span>';
                        }
                    }
                    $arrow = isset($value['cmenu']) ? '<span class="arrow'.($classLi != '' ? ' open': '').'"></span>' : '';
                    
                    if(substr($value['link'], 0, 4) != "html") {
                        $link = base_url().$value['link'];
                    } else {
                        $link = $value['link'];
                    }
                    ?>
                    <li<?php echo $classLi; ?>>
                        <a class="menu-nav" id-menu="<?php echo $value['id']; ?>" href="<?php echo $link; ?>" parent="true">
                            <i class="fa <?php echo $value['image']; ?>"></i> 
                            <span class="title">
                                <?php echo $value['name']; ?>
                            </span>
                            <?php echo $arrow; ?>
                            <?php echo $spanSelected; ?>
                        </a>
                        <?php
                        if(isset($value['cmenu'])) {
                            echo '<ul class="sub-menu">';
                            foreach($value['cmenu'] as $k => $v) {
                                if(substr($v['link'], 0, 4) != 'html') {
                                    $link = base_url().$v['link'];
                                } else {
                                    $link = $v['link'];
                                }
                                ?>
                                <li<?php echo $classSubLi; ?>>
                                    <a class="menu-nav" id-menu="<?php echo $v['id']; ?>" href="<?php echo $link; ?>" parent="false">
                                        <?php echo $v['name']; ?>
                                        <?php echo isset($v['cmenu']) ? $arrow : ''; ?>
                                    </a>
                                    <?php
                                    if(isset($v['cmenu'])) {
                                        echo '<ul class="sub-menu">';
                                        foreach($v['cmenu'] as $cm) {
                                            if(substr($cm['link'], 0, 4) != 'html') {
                                                $link = base_url().$cm['link'];
                                            } else {
                                                $link = $cm['link'];
                                            }
                                            ?>
                                            <li<?php echo $classSubLi; ?>>
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
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
</div>
<!-- END SIDEBAR -->