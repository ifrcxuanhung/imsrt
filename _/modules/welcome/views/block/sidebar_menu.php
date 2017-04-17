<ul class="page-sidebar-menu">
    <li>
        <div class="languages">
        <?php
            foreach($list_lang as $lang) {
            ?>
            <a class="switch-language" href="javascript: void(0);" langcode="<?php echo $lang['code'] ?>">
                <img style="<?php echo $curent_language['code'] == $lang['code'] ? '' : 'opacity: 0.5;'; ?>" src="<?php echo template_url() ?>img/<?php echo $lang['code'] ?>.png" />
            </a>
            <?php
            }
        ?>
        </div>
    </li>
	<li>
		<form class="sidebar-search">
			<div class="input-box">
				<a href="javascript:void(0);" class="remove"></a>
				<input type="text" placeholder="<?php trans('Search'); ?>..." />
				<input type="button" class="submit" value=" " disabled="disabled" />
			</div>
		</form>
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
            		<i class="<?php echo $value['image'] ?>"></i> 
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