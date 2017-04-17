<div class="breaking-news"> <span><?php echo trans('hightlights') ?></span>
	<ul>
    <?php
        foreach($article_hightlights['current'] as $key=>$value)
        {
            $date_add = $value['date_creation'];
            $date_add_d = substr($date_add,0,10);
            $date_add_h = substr($date_add,11,5);
            
        	//$date_add_d = strtotime($date_add_d);
            $date_add_d = date('d-m-Y', strtotime($date_add_d));

            $link = base_url() . "article/{$value['clean_cat']}/{$value['clean_artid']}/". utf8_convert_url($value['title']) .".html";
    ?>
	  <li><a href="<?php echo $link ?>" title="<?php echo $value['title'] ?>"><?php echo $value['title'] ?></a></li>
    <?php
        }
    ?>
	</ul>
</div>