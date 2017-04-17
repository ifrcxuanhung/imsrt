<form id="change_password" role="form" class="form-horizontal" action="" method="post">
<div class="modal-header" style="background-color: #E4AD36;">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title text-uppercase"><?php echo trans('Change Password'); ?></h4>
</div>
<div class="modal-body">
    <div class="scroller" style="height:250px" data-always-visible="1" data-rail-visible1="1">
        <div class="row">
            <div class="col-md-12">
                <div class="form-body">
                    <div class="alert alert-danger display-hide" style="display: none;">
                        <button data-close="alert" class="close"></button>
                        <?php echo trans('Invalid'); ?>.
                    </div>
                    <div class="alert alert-success display-hide" style="display: none;">
                        <button data-close="alert" class="close"></button>
                        <?php echo trans('Save successfull'); ?>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label text-uppercase"><strong><?php echo trans('Old Password'); ?></strong></label>
                        <div class="col-md-8">
                            <input type="password" id="old_password" name="old_password" placeholder="<?php echo trans('Old Password'); ?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label text-uppercase"><strong><?php echo trans('New Password'); ?></strong></label>
                        <div class="col-md-8">
                            <input type="password" id="new_password" name="new_password" placeholder="<?php echo trans('New Password'); ?>" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label text-uppercase"><strong><?php echo trans('Confirm Password'); ?></strong></label>
                        <div class="col-md-8">
                            <input type="password" id="confirm_password" name="confirm_password" placeholder="<?php echo trans('Confirm Password'); ?>" class="form-control"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <a class="clear-change btn default" data-dismiss="modal"><?php echo trans('cancel'); ?></a>
    <input type="button" class="btn green save-change-pass" value="<?php echo trans('save'); ?>" />
</div>
</form>