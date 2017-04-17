<div class="logo_partners">
	<ul>
    <?php
        foreach($list_partners['current'] as $key=>$value)
        {
            echo '<li><a title="'. $value['title'] .'" target="_blank" href="' . $value['link'] . '"><img style="height: 45px;" src="'. base_url() . $value['image'] . '"></a></li>';
        }
    ?>
        <!--
    	<li><a href="#"><img src="<?php echo base_url() ?>assets/templates/welcome/img/ifrc_logo_partners_top.png"></a></li>
        <li><a href="#"><img src="<?php echo base_url() ?>assets/templates/welcome/img/uel_logo_partners_top.jpg"></a></li>
        <li><a href="#"><img src="<?php echo base_url() ?>assets/templates/welcome/img/khtn_logo_partners_top.jpg"></a></li>
        <li><a href="#"><img src="<?php echo base_url() ?>assets/templates/welcome/img/triviet_logo_partners_top.jpg"></a></li>
        <li><a href="#"><img src="<?php echo base_url() ?>assets/templates/welcome/img/tdt_logo_partners_top.jpg"></a></li>
        <li><a href="#"><img src="<?php echo base_url() ?>assets/templates/welcome/img/sgu_logo_partners_top.jpg"></a></li>
        <li><a href="#"><img src="<?php echo base_url() ?>assets/templates/welcome/img/vcreme_logo_partners_top.jpg"></a></li>
        -->
    </ul>
</div>