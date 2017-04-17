<div class="modal-header" style="background-color: #44b6ae; color: #fff">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
	<h4 class="modal-title"><?php echo $name_desc; ?></h4>
</div>
<form id="checkupdate_modal" role="form" class="form-horizontal" action="" method="post">
    <div class="modal-body">
    	<div class="row">
    		<div class="col-md-12">
                <div class="form-body">
                    <div class="alert alert-danger display-hide" style="display: none;">
                        <button data-close="alert" class="close"></button>
                        Dữ liệu hiện tại không đúng!
                    </div>
                    <div class="alert alert-success display-hide" style="display: none;">
                        <button data-close="alert" class="close"></button>
                        Lưu thành công!
                    </div>
                    <div class="form-body">
                    <?php
                            foreach ($headers as $item) { ?>
                            <div class="form-group">
								<label class="col-md-3 control-label"><?php echo $item['Field'] ?></label>
								<div class="col-md-9">
									<?php echo $item['filter']?>
								</div>
							</div>
                    <?php } ?>
                    </div>
        			
                 </div>
    		</div>
    	</div>
    </div>
    <div class="modal-footer">
    	<button type="button" class="btn default" data-dismiss="modal">Close</button>
    	<button type="submit" class="btn blue">Save changes</button>
        <input type="hidden" id="table_name_parent" name="table_name_parent" value="<?php echo $name_table ?>" />
        <input type="hidden" id="keys" name="keys" value="<?php echo $keys ?>" />
    </div>
</form>

<style>

.date-picker { z-index: 1151 !important;  }

</style>