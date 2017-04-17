<section class="grid_12">
    <div class="block-border">
        <form class="block-content form-table-ajax" id="" method="post" action="">
            <h1><?php trans('mn_product'); ?></h1>

            <div style="float: right; margin-right: 20px;" class="custom-btn">
                <select style="cursor: pointer;" id="media-category" name="media-category" class="float-left margin-right padding-child-2-5">
                    <option value="0"><?php echo trans('select_type', 1) . " (" . trans("all", 1) . ") "; ?></option>
                    <?php
                        $list_type = array("product" => trans("product", 1), "accessory" => trans("accessory", 1));
                        foreach ($list_type as $key => $item) {
                            echo "<option value='" . $key . "'>" . $item . "</option>";
                        }
                    ?>
                </select>
                <button onclick="javascript: void(0);" class="action-upload-product-accessory" type="button"><?php trans('bt_upload'); ?></button>
                <div style="clear: left;"></div>
            </div>
            <div id="loading"><img src="<?php echo base_url() . 'assets/images/loading.gif'; ?>" /></div>
            <div class="no-margin">
                <table class="table table-product-list table-ajax" cellspacing="0" width="100%" style="display: table">
                    <thead>
                        <tr>
                            <th width="8%" scope="col" sType="numeric" bSortable="false">
                                <span class="column-sort">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                </span>
                                <?php trans('no_'); ?>
                            </th>
                            <th scope="col" sType="string" bSortable="true">
                                <span class="column-sort">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                </span>
                                <?php trans('name'); ?>
                            </th>
                            <th width="25%" scope="col" sType="string" bSortable="true">
                                <span class="column-sort">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                </span>
                                <?php trans('intro'); ?>
                            </th>
                            <th width="15%" scope="col" sType="string" bSortable="true">
                                <span class="column-sort">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                </span>
                                <?php trans('type'); ?>
                            </th>
                            <th width="15%" scope="col"><?php trans('image'); ?></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </form>
    </div>
</section>