<form enctype="multipart/form-data" method="POST"  id="check_modal" class="form-horizontal" action=""> 
<div class="modal-header" style="background-color: #44b6ae; color: #fff">
	<div class="modal-title">
      <div class="caption">
        <i class="fa fa-cogs font-white-sunglo"></i>  <span class="caption-subject font-white-sunglo bold uppercase">QUERY</span>
    </div>
     
    </div>
	
    
</div>
    <div class="modal-body">
    	<div class="row">
    		<div class="col-md-12">
                <div class="form-body">
                    <?php 
					$i = 1;
					foreach($query as $value){?>
                        <div class="well">
                            <h4><span class="caption-subject font-red-sunglo bold uppercase">Query <?php echo $i;?>:</span></h4>
                             <?php echo $value['query'];?>
                        </div>
                    <?php $i++;}?>	
                 </div>
    		</div>
    	</div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn red" data-dismiss="modal">Close</button>
        <input type="hidden" id="table_name_parent" name="table_name_parent" value="" />
        <input type="hidden" id="keys_value" name="keys_value" value="" />
    </div>
</form>

<style>

.date-picker { z-index: 1151 !important;  }

</style>
<script>
//$('.ckeditor').each(function(index, value){
//	CKEDITOR.replace( $(this).attr('name'), {
//		height : 150,
//		colorButton_foreStyle : {
//			element: 'font',
//			attributes: { 'color': '#(color)' }
//		},
//		colorButton_backStyle : {
//			element: 'font',
//			styles: { 'background-color': '#(color)' }
//		}
//	});
//});
</script>