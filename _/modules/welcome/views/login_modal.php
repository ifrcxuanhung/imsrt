<?php
if(empty($_SESSION['imsrt']['token'])){
	$_SESSION['imsrt']['token'] = md5(uniqid(mt_rand(),true));
	//echo $_SESSION['imsrt']['token'];
}
?>
<div class="modal-header" style="background-color: #E4AD36;">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
<h4 class="form-title text-uppercase"><i class="fa fa-user"></i> <?php echo trans('sign_in') ?></h4>
</div>
<div class="modal-body">
<div class="row">
	<div class="col-md-12">
            <div class="alert alert-danger login-alert" id="login_alert" style="display:none;">
                <button class="close" data-close="alert"></button>
                <span class="aler_msg"><?php trans('Login failed'); ?></span>
            </div>
            <form role="form" class="form-horizontal" action="<?php echo base_url(); ?>user-manage/login.php" method="post">
                <div class="form-group">
                    <label class="col-md-3 control-label" for="email"><?php trans('username'); ?></label>
                    <div class="col-md-8">
                        <div class="input-icon">
                            <i class="fa fa-envelope"></i>
                            <?php echo form_input($identity); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label" for="password"><?php trans('Password'); ?></label>
                    <div class="col-md-8">
                        <div class="input-icon left">
                            <i class="fa fa-user"></i>
                            <?php echo form_input($password); ?>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="remember" name="remember" value="1"/>
                <input type="hidden" id="token" name="token" value="<?php echo $_SESSION['imsrt']['token']; ?>"/>
            </form>
            <div class="col-md-12 getinfo" style="text-align:center">
              <a id="register-btn" href="<?php echo base_url();?>user-manage/sign_up.php" tabindex="4"><?php trans('Create an account'); ?></a>
              <a class="forget-password" id="forget-password" href="<?php echo base_url();?>user-manage/forgot_password.php" style="margin-left:20px;" tabindex="5"><?php trans('Forgot Password?'); ?></a>
             	
                    
                </div>
	</div>
</div>
</div>
<div class="modal-footer">
    <a id="LoginProcess" class="btn btn-success uppercase login-process" tabindex="3">Login</a>
</div>

<script>
$("input").keyup(function(event)
{
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13')
    {   
        $('#LoginProcess').click();
    }
});
</script>
