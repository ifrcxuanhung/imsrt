<?php include_once('settings.php'); 
$query = "SELECT `value` FROM `setting` WHERE `key`='maintenance' and `group` = 'setting'";
$stmt = $generic->query($query)->fetch();
//print_r($stmt['value']);exit;
?>
<fieldset>
	<legend><?php _e('Maintenance page'); ?></legend><br>
    <div class="btn-group btn-toggle"> 
        <button class="btn <?php echo $stmt['value'] == '0' ? 'btn-default' : 'btn-primary active' ?>" type="button" value="1">ON</button>
        <button class="btn <?php echo $stmt['value'] == '0' ? 'btn-primary active': 'btn-default'  ?>" type="button" value="0">OFF</button>
    </div>
    <hr>
	<input type="hidden" name="site-form" value="1">

</fieldset>
<script type="text/javascript">
// var $base_url = '<?php //echo base_url(); ?>';
$('.btn-toggle').click(function() {
    //alert('1');
   //var $this = $(event.currentTarget);
  
   //alert($base_url);
    var value = $(this).find('.btn-default').val();
	
    $.ajax({
        url: 'classes/insert.php',
        type: 'POST',
        async: false,
        data: {value: value}
    });
    $(this).find('.btn').toggleClass('active');  
    if ($(this).find('.btn-primary').size()>0) {
    	$(this).find('.btn').toggleClass('btn-primary');
       // alert('2');
    }
    $(this).find('.btn').toggleClass('btn-default');
    
});
</script>