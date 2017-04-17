<form name="formConfig" class="form" id="complex_form" method="post" action="">
    <section class="grid_12">
        <div class="block-border">
            <div class="block-content">
                <h1><?php trans('mn_config'); ?></h1>
                <div class="columns">
                    <div class="block-controls">
                        <ul class="controls-buttons">
                            <li></li>
                        </ul>
                        <div style="float: right; margin-right: 20px;" class="custom-btn">
                            <button type="button" name="update_config_info" class="update-config-info"><?php trans('bt_save'); ?></button>
                            <button onclick="$(location).attr('href','<?php echo admin_url(); ?>');" type="button" class="red"><?php trans('bt_cancel'); ?></button>
                            <div style="clear: left;"></div>
                        </div>
                    </div>
                    <?php if (isset($error) && $error != '') : ?>
                        <ul class="message warning no-margin">
                            <li>
                                <?php
                                if (is_array($error)):
                                    foreach ($error as $value):
                                        echo '<p>' . $value . '</p>';
                                    endforeach;
                                else:
                                    echo $error;
                                endif;
                                ?>
                            </li>
                            <li class="close-bt"></li>
                        </ul>
                    <?php endif; ?>
                    <div class="columns">
                        <p class="colx3-left inline-label">
                            <span class="label"><?php trans('title_website'); ?></span>
                            <span class="relative">
                                <?php
                                echo form_input('title_website', set_value('title_website', $input[0]['title_website']), 'class =full-width');
                                ?>
                            </span>
                        </p>
                    </div>
                    <!--
                    <div class="columns">
                        <p class="colx3-left inline-label">
                            <span class="label"><?php trans('contact_email'); ?></span>
                            <span class="relative">
                                <?php
                                echo form_input('contact_email', set_value('contact_email', $input[0]['contact_email']), 'class =full-width');
                                ?>
                            </span>
                        </p>
                    </div>
                    -->
                    <div class="columns">
                        <p class="colx3-left inline-label">
                            <span class="label"><?php trans('logo_website'); ?></span>
                        <div class="relative ">
                            <div class="image" style="display: block; clear: both; padding-left: 20em; ">
                                <img style="padding-bottom: 1em; width: 175px; height: 100px;" src="<?php
                                echo base_url();
                                echo (isset($input[0]['thumb']) && $input[0]['thumb'] != '') ? str_replace(base_url(), "", $input[0]['thumb']) : 'assets/images/no-image.jpg';
                                ?>" id="thumb" />
                                <br />
                                <a class="pointer" onclick="image_upload('logo_website', 'thumb');"><?php trans('browse_files'); ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="pointer" onclick="$('#thumb').attr('src', '<?php echo base_url(); ?>assets/images/no-image.jpg'); $('#image').attr('value', '');"><?php trans('clear_image'); ?></a></div>
                            <?php
                            echo form_input('image', set_value('image', isset($input[0]['logo_website']) ? $input[0]['logo_website'] : ''), 'id="image" style="display:none"');
                            ?>
                        </div>
                        </p>
                    </div>
                    <div class="columns">
                        <p class="colx3-left inline-label">
                            <span class="label"><?php trans('social_facebook'); ?></span>
                            <span class="relative">
                                <?php
                                echo form_input('facebook', set_value('facebook', $input[0]['facebook']), 'class =full-width');
                                ?>
                            </span>
                        </p>
                    </div>
                    <div class="columns">
                        <p class="colx3-left inline-label">
                            <span class="label"><?php trans('meta_des'); ?></span>
                            <span class="relative">
                                <?php
                                echo form_textarea('meta_des', set_value('meta_des', $input[0]['meta_des']), 'class =full-width');
                                ?>
                            </span>
                        </p>
                    </div>
                    <div class="columns">
                        <p class="colx3-left inline-label">
                            <span class="label"><?php trans('meta_key'); ?></span>
                            <span class="relative">
                                <?php
                                echo form_textarea('meta_key', set_value('meta_key', $input[0]['meta_key']), 'class =full-width');
                                ?>
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>