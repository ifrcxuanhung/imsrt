<link href="<?php echo template_url() ?>plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<form name="formLanguage" class="form" id="complex_form" method="post" action="">
    <section class="grid_12">
        <div class="block-border">
            <div class="block-content">
                <h1><?php trans('mn_menu'); ?></h1>
                <div class="columns">
                    <div class="block-controls">
                        <ul class="controls-buttons">
                            <li></li>
                        </ul>
                        <div style="float: right; margin-right: 20px;" class="custom-btn">
                            <button type="submit"><?php trans('bt_save'); ?></button>
                            <button onclick="$(location).attr('href','<?php echo admin_url() . 'menu' ?>');" type="button" class="red"><?php trans('bt_cancel'); ?></button>
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
                            <span class="label"><?php trans('status'); ?></span>
                            <span class="relative float-left" style="padding-top:5px">
                                <input type="checkbox" style="cursor: pointer;" <?php echo (isset($input['status']) && $input['status'] == 1) ? 'checked' : NULL; ?> name="status" id="status" />
                            </span>
                        </p>
                    </div>
                    <div class="columns">
                        <p class="colx3-left inline-label">
                            <span class="label"><?php trans('parent_menu'); ?></span><?php
                    ?>
                            <span class="relative">
                                <?php
                                if (isset($list_menu) && is_array($list_menu)):
                                    echo form_dropdown('parent_id', unshift($list_menu, '0', trans('select_menu', 1)), isset($input['parent_id']) ? $input['parent_id'] : NULL, 'class =full-width');
                                endif;
                                ?>
                            </span>
                        </p>
                    </div>
                    <div class="columns">
                        <p class="colx3-left inline-label">
                            <span class="label"><?php trans('ordering'); ?></span>
                            <span class="relative">
                                <?php
                                $input['sort_order'] = isset($sort_order) ? $sort_order : $input['sort_order'];
                                ?>
                                <input type="text" value="<?php echo $input['sort_order']; ?>" name="sort_order" id="sort_order" class="full-width" />
                            </span>
                        </p>
                    </div>
                    <div class="columns">
                        <p class="colx3-left inline-label">
                            <span class="label"><?php trans('Level'); ?></span>
                            <span class="relative">
                                <?php
                                $level = isset($input['level']) ? $input['level'] : 0;
                                ?>
                                <input type="text" value="<?php echo $level; ?>" name="level" id="level" class="full-width" />
                            </span>
                        </p>
                    </div>
                    <div class="columns">
                        <p class="colx3-left inline-label">
                            <span class="label"><?php trans('type') ?></span>
                            <span class="relative">
                                <?php
                                if (isset($input['type']) == false) {
                                    $input['type'] = 'url';
                                }
                                ?>
                                <input type="radio" value="url" name="type" <?php if ($input['type'] == 'url') echo 'checked'; ?> /> <?php trans('url') ?>
                                <input type="radio" value="web" name="type" <?php if ($input['type'] == 'web') echo 'checked'; ?> /> <?php trans('web_page') ?>
                                <input type="radio" value="art" name="type" <?php if ($input['type'] == 'art') echo 'checked'; ?> /> <?php trans('article'); ?>
                                <input type="radio" value="cate" name="type" <?php if ($input['type'] == 'cate') echo 'checked'; ?> /> <?php trans('category'); ?>
                            </span>
                        </p>
                    </div>
                    <div class="columns">
                        <p class="colx3-left inline-label">
                            <span class="label required"><?php trans('url'); ?></span>
                            <span class="relative">
                                <input type="text" value="<?php echo isset($input['link']) ? $input['link'] : "#"; ?>" name="link" id="link" class="full-width" />
                            </span>
                        </p>
                    </div>
                    <div id="page_id" class="columns hidden">
                        <p class="colx3-left inline-label">
                            <span class="label required"><?php trans('web_page') ?></span>
                            <span class="relative">
                                <?php
                                if (isset($list_page) && is_array($list_page)):
                                    echo form_dropdown('page_id', unshift($list_page, '0', trans('select_page', 1)), isset($input['page_id']) ? $input['page_id'] : NULL, 'class =full-width');
                                endif;
                                ?>
                            </span>
                        </p>
                    </div>
                    <div id="category_id" class="columns hidden">
                        <p class="colx3-left inline-label">
                            <span class="label required"><?php trans('Category'); ?></span>
                            <span class="relative">
                                <?php
                                if (isset($list_category) && is_array($list_category)):
                                    echo form_dropdown('category_id', unshift($list_category, '0', trans('select_category', 1)), isset($input['category_id']) ? $input['category_id'] : NULL, 'class=full-width');
                                endif;
                                ?>
                            </span>
                        </p>
                    </div>
                    <div id='sortby' class="columns hidden">
                        <p class="colx3-left inline-label">
                            <span class="label"><?php trans('Sort by'); ?></span>
                            <?php
                                
                                $sort = isset($input['sort_by']) ? explode('.',$input['sort_by']) : "";
                                if ($sort != '') {
                                    $sortby = $sort[0];
                                }
                            ?>
                            <input type="radio" value="date_creation" name="sortby" <?php if(isset($sortby)) { if ($sortby == 'date_creation') echo 'checked'; } ?> /> <?php trans('date'); ?>
                            <input type="radio" value="clean_order" name="sortby" <?php if(isset($sortby)) { if ($sortby == 'clean_order') echo 'checked'; } ?> /> <?php trans('sort_order'); ?>
                            <input type="radio" value="title" name="sortby" <?php if(isset($sortby)) { if ($sortby == 'title') echo 'checked';} ?> /> <?php trans('title'); ?>
                        </p>
                    </div>
                    <div id='sortchange' class="columns hidden">
                        <p class="colx3-left inline-label">
                            <span class="label"><?php trans('Sort change'); ?></span>
                            <?php
                                if ($sort != '') {
                                    $sortchange =  $sort[1];
                                }
                            ?>
                            <input type="radio" value="asc" name="sortchange" <?php if(isset($sortchange)){if ($sortchange == 'asc') echo 'checked';} ?> /> <?php trans('asc'); ?>
                            <input type="radio" value="desc" name="sortchange" <?php if(isset($sortchange)){if ($sortchange == 'desc') echo 'checked';} ?> /> <?php trans('desc'); ?>
                        </p>
                    </div>
                    
                    <!--div id='fladdate' class="columns hidden">
                        <p class="colx3-left inline-label">
                            <span class="label"><?php trans('Show date'); ?></span>
                            <?php
                                $check = isset($input['check']) ? explode('_',$input['check']) : "" ;
                                if ($check != "") {
                                   $fladdate =  $check[0];
                                }
                            ?>
                            <input type="radio" value="1" name="fladdate" <?php if(isset($fladdate)){if ($fladdate == 1) echo 'checked';} ?> /> <?php trans('on'); ?>
                            <input type="radio" value="0" name="fladdate" <?php if(isset($fladdate)){if ($fladdate == 0) echo 'checked';} ?> /> <?php trans('off'); ?>
                        </p>
                    </div>
                    
                    <div id='showimage' class="columns hidden">
                        <p class="colx3-left inline-label">
                            <span class="label"><?php trans('Show Image Article'); ?></span>
                            <?php
                               if ($check != "") {
                                   $showimage = $check[1];
                                }
                            ?>
                            <input type="radio" value="1" name="showimage" <?php if(isset($showimage)){ if ($showimage == 1) echo 'checked';} ?> /> <?php trans('on'); ?>
                            <input type="radio" value="0" name="showimage" <?php if(isset($showimage)){ if ($showimage == 0) echo 'checked';} ?> /> <?php trans('off'); ?>
                        </p>
                    </div>
                    
                    <div id='showseemore' class="columns hidden">
                        <p class="colx3-left inline-label">
                            <span class="label"><?php trans('Show See More Button'); ?></span>
                            <?php
                                if ($check != "") {
                                    $showseemore = $check[2];
                                }
                            ?>
                            <input type="radio" value="1" name="showseemore" <?php if(isset($showseemore)){ if ($showseemore == 1) echo 'checked';} ?> /> <?php trans('on'); ?>
                            <input type="radio" value="0" name="showseemore" <?php if(isset($showseemore)){ if ($showseemore == 0) echo 'checked';} ?> /> <?php trans('off'); ?>
                        </p>
                    </div>

                    <div id='showLinkWebsite' class="columns hidden">
                        <p class="colx3-left inline-label">
                            <span class="label"><?php trans('Show Link Website'); ?></span>
                            <?php
                                if ($check != "") {
                                    $showLinkWebsite = $check[3];
                                }
                            ?>
                            <input type="radio" value="1" name="showLinkWebsite" <?php if(isset($showLinkWebsite)){if ($showLinkWebsite == 1) echo 'checked';} ?> /> <?php trans('on'); ?>
                            <input type="radio" value="0" name="showLinkWebsite" <?php if(isset($showLinkWebsite)){if ($showLinkWebsite == 0) echo 'checked';} ?> /> <?php trans('off'); ?>
                        </p>
                    </div-->
                    
                    <div id='article_id' class="columns hidden">
                        <p class="colx3-left inline-label">
                            <span class="label">&nbsp;</span>
                            <span class="relative" id='rs'></span>
                        </p>
                        <input type='hidden' name='article_id' value='' />
                    </div>
                    <div class="columns">
                        <p class="colx3-left inline-label">
                            <span class="label"><?php trans('image'); ?></span>
                            <span class="relative">
                                <input type="text" value="<?php echo isset($input['image']) ? $input['image'] : NULL; ?>" name="image" id="image" class="full-width" />
                            </span>
                        </p>
                    </div>
                    <div class="columns">
                        <p class="colx3-left inline-label">
                            <span class="label"><?php trans('icon') ?></span>
                            
                                <?php
                                $text = 'icon-action-redo,.icon-action-undo,.icon-anchor,.icon-arrow-down,.icon-arrow-left,.icon-arrow-right,.icon-arrow-up,.icon-badge,.icon-bag,.icon-ban,.icon-bar-chart,.icon-basket,.icon-basket-loaded,.icon-bell,.icon-book-open,.icon-briefcase,.icon-bubble,.icon-bubbles,.icon-bulb,.icon-calculator,.icon-calendar,.icon-call-end,.icon-call-in,.icon-call-out,.icon-camcorder,.icon-camera,.icon-check,.icon-chemistry,.icon-clock,.icon-close,.icon-cloud-download,.icon-cloud-upload,.icon-compass,.icon-control-end,.icon-control-forward,.icon-control-pause,.icon-control-play,.icon-control-rewind,.icon-control-start,.icon-credit-card,.icon-crop,.icon-cup,.icon-cursor,.icon-cursor-move,.icon-diamond,.icon-direction,.icon-directions,.icon-disc,.icon-dislike,.icon-doc,.icon-docs,.icon-drawer,.icon-drop,.icon-earphones,.icon-earphones-alt,.icon-emoticon-smile,.icon-energy,.icon-envelope,.icon-envelope-letter,.icon-envelope-open,.icon-equalizer,.icon-eye,.icon-eyeglasses,.icon-feed,.icon-film,.icon-fire,.icon-flag,.icon-folder,.icon-folder-alt,.icon-frame,.icon-game-controller,.icon-ghost,.icon-globe,.icon-globe-alt,.icon-graduation,.icon-graph,.icon-grid,.icon-handbag,.icon-heart,.icon-home,.icon-hourglass,.icon-info,.icon-key,.icon-layers,.icon-like,.icon-link,.icon-list,.icon-lock,.icon-lock-open,.icon-login,.icon-logout,.icon-loop,.icon-magic-wand,.icon-magnet,.icon-magnifier,.icon-magnifier-add,.icon-magnifier-remove,.icon-map,.icon-microphone,.icon-mouse,.icon-moustache,.icon-music-tone,.icon-music-tone-alt,.icon-note,.icon-notebook,.icon-paper-clip,.icon-paper-plane,.icon-pencil,.icon-picture,.icon-pie-chart,.icon-pin,.icon-plane,.icon-playlist,.icon-plus,.icon-pointer,.icon-power,.icon-present,.icon-printer,.icon-puzzle,.icon-question,.icon-refresh,.icon-reload,.icon-rocket,.icon-screen-desktop,.icon-screen-smartphone,.icon-screen-tablet,.icon-settings,.icon-share,.icon-share-alt,.icon-shield,.icon-shuffle,.icon-size-actual,.icon-size-fullscreen,.icon-social-dribbble,.icon-social-dropbox,.icon-social-facebook,.icon-social-tumblr,.icon-social-twitter,.icon-social-youtube,.icon-speech,.icon-speedometer,.icon-star,.icon-support,.icon-symbol-female,.icon-symbol-male,.icon-tag,.icon-target,.icon-trash,.icon-trophy,.icon-umbrella,.icon-user,.icon-user-female,.icon-user-follow,.icon-user-following,.icon-user-unfollow,.icon-users,.icon-vector,.icon-volume-1,.icon-volume-2,.icon-volume-off,.icon-wallet,.icon-wrench';
                                $array = explode(',.',$text);
                                //print_R($array);exit;
                                if (isset($input['icon']) == false) {
                                    $input['icon'] = '';
                                }
                                foreach($array as $value){
                                ?>
                           <span class="relative">     
                                <input type="radio" value="<?php echo $value ?>" name="icon" <?php if ($input['icon'] == $value) echo 'checked'; ?>/>  <span class="<?php echo $value ?>" ></span>
                                <?php } ?>
                                <!--input type="radio" value="icon-tags" name="icon" <?php if ($input['icon'] == 'icon-tags') echo 'checked'; ?> /> <span class="icon-tags" ></span>
                                <input type="radio" value="icon-tag" name="icon" <?php if ($input['icon'] == 'icon-tag') echo 'checked'; ?> /> <span class="icon-tag" ></span>
                                <input type="radio" value="icon-book" name="icon" <?php if ($input['icon'] == 'icon-book') echo 'checked'; ?> /> <span class="icon-book" ></span>
                                <input type="radio" value="icon-bookmark" name="icon" <?php if ($input['icon'] == 'icon-bookmark') echo 'checked'; ?> /> <span class="icon-bookmark" ></span>
                                <input type="radio" value="icon-print" name="icon" <?php if ($input['icon'] == 'icon-print') echo 'checked'; ?> /> <span class="icon-print" ></span>
                                <input type="radio" value="icon-camera" name="icon" <?php if ($input['icon'] == 'icon-camera') echo 'checked'; ?> /> <span class="icon-camera" ></span>
                                <input type="radio" value="icon-tasks" name="icon" <?php if ($input['icon'] == 'icon-tasks') echo 'checked'; ?> /> <span class="icon-tasks" ></span>
                                <input type="radio" value="icon-share" name="icon" <?php if ($input['icon'] == 'icon-share') echo 'checked'; ?> /> <span class="icon-share" ></span>
                                <input type="radio" value="icon-calendar" name="icon" <?php if ($input['icon'] == 'icon-calendar') echo 'checked'; ?> /> <span class="icon-calendar" ></span>
                                <input type="radio" value="icon-magnet" name="icon" <?php if ($input['icon'] == 'icon-magnet') echo 'checked'; ?> /> <span class="icon-magnet" ></span>
                                <input type="radio" value="icon-gift" name="icon" <?php if ($input['icon'] == 'icon-gift') echo 'checked'; ?> /> <span class="icon-gift" ></span>
                                <input type="radio" value="icon-tablet" name="icon" <?php if ($input['icon'] == 'icon-tablet') echo 'checked'; ?> /> <span class="icon-tablet" ></span>
                                <input type="radio" value="icon-suitcase" name="icon" <?php if ($input['icon'] == 'icon-suitcase') echo 'checked'; ?> /> <span class="icon-suitcase" ></span>
                                <input type="radio" value="icon-flag-alt" name="icon" <?php if ($input['icon'] == 'icon-flag-alt') echo 'checked'; ?> /> <span class="icon-flag-alt" ></span>
                                <input type="radio" value="icon-microphone" name="icon" <?php if ($input['icon'] == 'icon-microphone') echo 'checked'; ?> /> <span class="icon-microphone" ></span>
                                <input type="radio" value="icon-th" name="icon" <?php if ($input['icon'] == 'icon-th') echo 'checked'; ?> /> <span class="icon-th" ></span>
                                <input type="radio" value="icon-file-text" name="icon" <?php if ($input['icon'] == 'icon-file-text') echo 'checked'; ?> /> <span class="icon-file-text" ></span>
                                <input type="radio" value="icon-bookmark-empty" name="icon" <?php if ($input['icon'] == 'icon-bookmark-empty') echo 'checked'; ?> /> <span class="icon-bookmark-empty" ></span>
                                <input type="radio" value="icon-cogs" name="icon" <?php if ($input['icon'] == 'icon-cogs') echo 'checked'; ?> /> <span class="icon-cogs" ></span>
                                <input type="radio" value="icon-trophy" name="icon" <?php if ($input['icon'] == 'icon-trophy') echo 'checked'; ?> /> <span class="icon-trophy" ></span>
                                <input type="radio" value="icon-bell" name="icon" <?php if ($input['icon'] == 'icon-bell') echo 'checked'; ?> /> <span class="icon-bell" ></span-->
                                <input type="radio" value="" name="icon" <?php if ($input['icon'] == '') echo 'checked'; ?> /> <span class="icon-none" >None</span>
                            </span>
                        </p>
                    </div>
                    <div class="columns">
                        <div class="tabs-content">
                            <?php if (isset($list_language) && is_array($list_language)): ?>
                                <ul class="mini-tabs no-margin js-tabs same-height">
                                    <?php foreach ($list_language as $value) : ?>
                                        <li><a href="#tab-<?php echo $value['code'] ?>"><img src="<?php echo template_url() ?>images/icons/flags/<?php echo $value['code']; ?>.png" width="16" height="11" alt="<?php echo trans($value['name'], 1); ?>" title="<?php echo trans($value['name'], 1); ?>"> <?php echo trans($value['name'], 1); ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                                <?php foreach ($list_language as $value) : ?>
                                    <div id="tab-<?php echo $value['code'] ?>" class="tabs-content-info">
                                        <label class="float-left margin-right width150"><?php trans('name_menu'); ?></label>
                                        <input type="text" value="<?php echo isset($input['name'][$value['code']]) ? $input['name'][$value['code']] : NULL; ?>" name="name[<?php echo $value['code'] ?>]" id="name-<?php echo $value['code'] ?>" class="full-width">
                                        <div class="clear height10" style="margin-bottom: 10px"></div>

                                        <label class="float-left margin-right width150"><?php trans('description'); ?></label>
                                        <div class="clear height10" style="margin-bottom: 10px"></div>

                                        <textarea name="description[<?php echo $value['code'] ?>]" id="description-<?php echo $value['code'] ?>" class="full-width"><?php echo isset($input['description'][$value['code']]) ? $input['description'][$value['code']] : NULL; ?></textarea>
                                        <div class="clear height10"></div>

                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/bundles/ckeditor/ckeditor.js"></script>
<script>
    $(document).ready(function(){
        var url1;
        var url = '';
        var url_temp = "<?php echo @$input['link']; ?>";
        var cate_id = "<?php echo @$input['category_id']; ?>";
        var art_id = "<?php echo @$input['article_id']; ?>";
        var page_id = "<?php echo @$input['page_id']; ?>";
        var type = "<?php echo @$input['type']; ?>";
        if(type == 'art'){
            $('#page_id').slideUp();
            $('#category_id').slideUp();
            $('#sortby').slideUp();
            $('#sortchange').slideUp();
            $('#fladdate').slideUp();
            $('#showimage').slideUp();
            $('#showseemore').slideUp();
            $('#showLinkWebsite').slideUp();
            
            url = 'article/';
            // show article
            $.ajax({
                url: '<?php echo base_url(); ?>backend/page/listArticle',
                type: 'post',
                data: 'id=' + cate_id,
                async: false,
                success: function(rs){
                    if(rs != '[]') {
                        rs = JSON.parse(rs);
                        var content = "<ul style='list-style-type: decimal; padding-left: 20px;'>";
                        $(rs).each(function(i){
                            content += "<li><a href='#tin' class='cate' id='" + rs[i].article_id + "'>" + rs[i].title + "</a></li>";
                        });
                        content += "</ul>";
                        $('#rs').append(content);
                        $('#article_id').slideDown();
                        $('#' + art_id).css('color', 'red');
                    }
                }
            });
         }else if(type == 'web'){
            $('#category_id').slideUp();
            $('#page_id').slideDown();
            $('#sortby').slideUp();
            $('#sortchange').slideUp();
            $('#fladdate').slideUp();
            $('#showimage').slideUp();
            $('#showseemore').slideUp();
            $('#showLinkWebsite').slideUp();
            url = 'page/';
        }else if(type == 'cate') {
            $('#page_id').slideUp();
            $('#category_id').slideDown();
            $('#sortby').slideDown();
            $('#sortchange').slideDown();
            $('#fladdate').slideDown();
            $('#showimage').slideDown();
            $('#showseemore').slideDown();
            $('#showLinkWebsite').slideDown();
        } else {
            $('#category_id').slideUp();
            $('#page_id').slideUp();
            $('#sortby').slideUp();
            $('#sortchange').slideUp();
            $('#fladdate').slideUp();
            $('#showimage').slideUp();
            $('#showseemore').slideUp();
            $('#showLinkWebsite').slideUp();
        }
        $('input[name="type"]').change(function(){
            if($(this).prop('checked')){
                $('#article_id').slideUp();
                type = $(this).val();
                if(type == 'art'){
                    $('#page_id').slideUp();
                    $('#category_id').slideDown();
                    $('#fladdate').slideUp();
                    $('#sortby').slideUp();
                    $('#sortchange').slideUp();
                    $('#showimage').slideUp();
                    $('#showseemore').slideUp();
                    $('#showLinkWebsite').slideUp();
                    url = 'article/';
                }else if(type == 'web'){
                    $('#category_id').slideUp();
                    $('#page_id').slideDown();
                    $('#sortby').slideUp();
                    $('#sortchange').slideUp();
                    $('#fladdate').slideUp();
                    $('#showimage').slideUp();
                    $('#showseemore').slideUp();
                    $('#showLinkWebsite').slideUp();
                    url = 'page/';
                }else if(type == 'cate'){
                    $('#page_id').slideUp();
                    $('#category_id').slideDown();
                    $('#sortby').slideDown();
                    $('#sortchange').slideDown();
                    $('#fladdate').slideDown();
                    $('#showimage').slideDown();
                    $('#showseemore').slideDown();
                    $('#showLinkWebsite').slideDown();
                    url = 'category/';
                }else{
                    $('#category_id').slideUp();
                    $('#page_id').slideUp();
                    $('#sortby').slideUp();
                    $('#sortchange').slideUp();
                    $('#fladdate').slideUp();
                    $('#showimage').slideUp();
                    $('#showseemore').slideUp();
                    $('#showLinkWebsite').slideUp();
                }

            }
        });
        
        // $('input[name="sortby"]').change(function(){
        //     if($(this).prop('checked')){
        //         $('#sortchange').slideDown();
        //         type1 = $(this).val();
        //         var type2 = $('input[name="fladdate"]:checked').val();
        //         var type3 = $('input[name="sortchange"]:checked').val();
        //         var type4 = $('input[name="showimage"]:checked').val();
        //         var type5 = $('input[name="showseemore"]:checked').val();
        //         var type6 = $('input[name="showLinkWebsite"]:checked').val();
        //         url = '';// url = 'article/';
        //         var category = $('select[name="category_id"] option:selected').text();
        //         url2 = url+ 'category/?category='+utf8_convert_url(category.replace('... ', ''))+'.html&sort_by='+type1+'.'+type3+'&check='+type2+'_'+type4+'_'+type5+'_'+type6;
        //         $('#link').val(url2);
        //     }
        // });
        //  $('input[name="sortchange"]').change(function(){
        //     if($(this).prop('checked')){
        //         type3 = $(this).val();
        //         var type1 = $('input[name="sortby"]:checked').val();
        //         var type2 = $('input[name="fladdate"]:checked').val();
        //         var type4 = $('input[name="showimage"]:checked').val();
        //         var type5 = $('input[name="showseemore"]:checked').val();
        //         var type6 = $('input[name="showLinkWebsite"]:checked').val();
        //         url = '';// url = 'article/';
        //         var category = $('select[name="category_id"] option:selected').text();
        //         url2 = url+ 'category/?category='+utf8_convert_url(category.replace('... ', ''))+'.html&sort_by='+type1+'.'+type3+'&check='+type2+'_'+type4+'_'+type5+'_'+type6;
        //         $('#link').val(url2);
        //     }
        // }); 
        // $('input[name="fladdate"]').change(function(){
        //     if($(this).prop('checked')){
        //         type2 = $(this).val();
        //         var type1 = $('input[name="sortby"]:checked').val();
        //         var type3 = $('input[name="sortchange"]:checked').val();
        //         var type4 = $('input[name="showimage"]:checked').val();
        //         var type5 = $('input[name="showseemore"]:checked').val();
        //         var type6 = $('input[name="showLinkWebsite"]:checked').val();
        //         url = '';// url = 'article/';
        //         var category = $('select[name="category_id"] option:selected').text();
        //         url2 = url+ 'category/?category='+utf8_convert_url(category.replace('... ', ''))+'.html&sort_by='+type1+'.'+type3+'&check='+type2+'_'+type4+'_'+type5+'_'+type6;
        //         $('#link').val(url2);
        //     }
        // });
        // $('input[name="showimage"]').change(function(){
        //     if($(this).prop('checked')){
        //         type4 = $(this).val();
        //         var type2 = $('input[name="fladdate"]:checked').val();
        //         var type3 = $('input[name="sortchange"]:checked').val();
        //         var type1 = $('input[name="sortby"]:checked').val();
        //         var type5 = $('input[name="showseemore"]:checked').val();
        //         var type6 = $('input[name="showLinkWebsite"]:checked').val();
        //         url = '';// url = 'article/';
        //         var category = $('select[name="category_id"] option:selected').text();
        //         url2 = url+ 'category/?category='+utf8_convert_url(category.replace('... ', ''))+'.html&sort_by='+type1+'.'+type3+'&check='+type2+'_'+type4+'_'+type5+'_'+type6;
        //         $('#link').val(url2);
        //     }
        // });
        //  $('input[name="showseemore"]').change(function(){
        //     if($(this).prop('checked')){
        //         type5 = $(this).val();
        //         var type2 = $('input[name="fladdate"]:checked').val();
        //         var type3 = $('input[name="sortchange"]:checked').val();
        //         var type1 = $('input[name="sortby"]:checked').val();
        //         var type4 = $('input[name="showimage"]:checked').val();
        //         var type6 = $('input[name="showLinkWebsite"]:checked').val();
        //         url = '';// url = 'article/';
        //         var category = $('select[name="category_id"] option:selected').text();
        //         url2 = url+ 'category/?category='+utf8_convert_url(category.replace('... ', ''))+'.html&sort_by='+type1+'.'+type3+'&check='+type2+'_'+type4+'_'+type5+'_'+type6;
        //         $('#link').val(url2);
        //     }
        // });
        // $('input[name="showLinkWebsite"]').change(function(){
        //     if($(this).prop('checked')){
        //         type6 = $(this).val();
        //         var type2 = $('input[name="fladdate"]:checked').val();
        //         var type3 = $('input[name="sortchange"]:checked').val();
        //         var type1 = $('input[name="sortby"]:checked').val();
        //         var type4 = $('input[name="showimage"]:checked').val();
        //         var type5 = $('input[name="showseemore"]:checked').val();
        //         url = '';// url = 'article/';
        //         var category = $('select[name="category_id"] option:selected').text();
        //         url2 = url+ 'category/?category='+utf8_convert_url(category.replace('... ', ''))+'.html&sort_by='+type1+'.'+type3+'&check='+type2+'_'+type4+'_'+type5+'_'+type6;
        //         $('#link').val(url2);
        //     }
        // });
           
        // bat dau su kien change select category
        $('select[name="page_id"]').live('change', function(){
            var id = $(this).val();
            var code = utf8_convert_url($('#page_id option[value=' + id + ']').text());
            $('#link').val(url + code + '.html');
        });
        //ket thuc su kien change
        
        $('input[name="icon"]').live('change', function(){
            if($(this).prop('checked')){
            icon = $(this).val();
            $('#image').val(icon);
            }
        });
        
        // bat dau su kien change select category
        $('select[name="category_id"]').live('change', function(){
            var type = $('input[name="type"]:checked').val();
            $('#rs').html(' ');
            $('#article_id').slideUp();
            cate_id = $(this).val();
            url = '';// url = 'article/';
            url1 = url + 'article/'+ cate_id;//url1 = url+'index/' + cate_id;
            var category = $('select[name="category_id"] option:selected').text();
            url2 = url+ 'category/?category='+utf8_convert_url(category.replace('... ', ''));
            $('#link').val(url2);
            if (type=='art'){
            // show article
                $.ajax({
                    url: '<?php echo base_url(); ?>backend/page/listArticle',
                    type: 'post',
                    data: 'id=' + cate_id,
                    async: false,
                    success: function(rs){
                        if(rs != '[]'){
                            rs = JSON.parse(rs);
                            var content = "<ul style='list-style-type: decimal; padding-left: 20px;'>";
                            $(rs).each(function(i){
                                content += "<li><a href='#tin' class='cate' id='" + rs[i].article_id + "'>" + rs[i].title + "</a></li>";
                            });
                            content += "</ul>";
                            $('#rs').append(content);
                            $('#article_id').slideDown();
                        }
                    }
                });
            }else if(type=='cate'){
                $('#fladdate').slideDown();
                $('#sortby').slideDown();
                $('#showimage').slideDown();
                $('#showseemore').slideDown();
            }

        });

        // ket thuc su kien change
        //thay doi url textbox khi chon article
        $('a.cate').live('click', function(){
            // var code = $(this).text();
            // code = code.toLowerCase();
            // code = code.replaceAll(' ', '-');
            var code = $(this).attr('id');
            if(url1 != null){
                // $('#link').val(url1 + '/' + code + '.html');
                $('#link').val(url1 + '/' + code+'/'+utf8_convert_url($(this).html())+'.html');
            }else{
                // code = code + '.html';
                url_arr = url_temp.split('/');
                var temp = url_temp.replaceAll(url_arr[6], code);
                url_temp = temp;
                $('#link').val(url_temp);
            }
            $('#article_id input[type="hidden"]').val($(this).attr('id'));
            $(this).css('color', 'red');
            $(this).parent().siblings().find('a.cate').attr('style', '');
        });
    });
<?php
if (isset($list_language) && is_array($list_language)):
    foreach ($list_language as $value) :
        ?>
                    CKEDITOR.replace('description[<?php echo $value['code'] ?>]');
        <?php
    endforeach;
endif;
?>
</script>