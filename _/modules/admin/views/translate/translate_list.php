<section class="grid_12">
    <div class="block-border">
        <form class="block-content form-table-ajax" id="table_form" method="post" action="">
            <h1><?php trans('mn_Translate'); ?></h1>

            <div style="float: right; margin-right: 20px;" class="custom-btn">
                <button onclick="$(location).attr('href','<?php echo admin_url() . 'translate/add' ?>');" class="" type="button"><?php trans('bt_add'); ?></button>
                <div style="clear: left;"></div>
            </div>

            <div class="no-margin">
                <table class="table table-translate-list table-ajax" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th width="8%" scope="col" sType="numeric" bSortable="true">
                                <span class="column-sort">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                </span>
                                <?php trans('no_'); ?>
                            </th>
                            <th width="25%" scope="col" sType="string" bSortable="true">
                                <span class="column-sort">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                </span>
                                <?php trans('word') ?>
                            </th>
                            <?php
                            foreach ($list_language as $value) {
                                ?>
                                <th width="<?php echo (52/count($list_language)); ?>%" scope="col" sType="string" bSortable="true">
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                    <?php trans($value['name']); ?>
                                </th>
                                <?php
                            }
                            ?>
                            <th width="15%" scope="col" class="table-actions"><?php trans('actions'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <input id="count_header" type="hidden" value="<?php echo count($list_language); ?>"/>
            </div>
        </form>
    </div>
</section>
<!-- script>
    $(function(){
        $(".delete").click(function () {
            var $this=this
            if (confirm('<?php trans('are_you_sure'); ?>')) {
                var word=$($this).attr("translate_word");
                $.ajax({
                    type: "POST",
                    url: "<?php echo admin_url() ?>translate/delete",
                    data: "word="+word,
                    success: function(msg){
                        if(msg>=1){
                            $($this).parents('tr').fadeOut('slow');
                        }
                    }
                });
            }
        });
    });
</script-->