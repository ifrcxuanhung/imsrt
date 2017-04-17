<form id="change_email" role="form" class="form-horizontal" action="" method="post">
<div class="modal-header" style="background-color: #E4AD36;">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title text-uppercase"><?php echo trans('Change Email'); ?></h4>
</div>
    <div class="modal-body">
        <div class="scroller" style="height:250px" data-always-visible="1" data-rail-visible1="1">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-body">
                        <div class="alert alert-danger display-hide" style="display: none;">
                            <button data-close="alert" class="close"></button>
                            <span id"message_fail"><?php echo trans('Invalid'); ?></span>
                        </div>
                        <div class="alert alert-success display-hide" style="display: none;">
                            <button data-close="alert" class="close"></button>
                            <?php echo trans('Save successfull'); ?>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label text-uppercase"><strong><?php echo trans('Old Email'); ?></strong></label>
                            <div class="col-md-8">
                                <input type="text" id="old_email" name="old_email" placeholder="<?php echo trans('Old Email'); ?>" value="<?php echo $old_email; ?>" disabled="disabled" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label text-uppercase"><strong><?php echo trans('New Email'); ?></strong><span class="required">
										* </span></label>
                            <div class="col-md-8">
                                <input type="text" id="new_email" name="new_email" placeholder="<?php echo trans('New Email'); ?>" class="form-control" data-required="1"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label text-uppercase"><strong><?php echo trans('Confirm Email'); ?><span class="required">
										* </span></strong></label>
                            <div class="col-md-8">
                                <input type="text" id="confirm_email" name="confirm_email" placeholder="<?php echo trans('Confirm Email'); ?>" class="form-control" data-required="1"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a class="clear-change btn default" data-dismiss="modal"><?php echo trans('cancel'); ?></a>
        <input type="button" class="btn green save-change-email" value="<?php echo trans('save'); ?>" />
    </div>
</form>