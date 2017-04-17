    <div class="page-title"  style="font-weight:800; font-size:18px; color: #666;">
    <?php    
    if ($this->router->fetch_class()!='table'&&$this->router->fetch_class()!='category'){ 
    ?>
        <h1 class="text-uppercase"><?php echo trans($this->router->fetch_class()); ?><!--small>statistics & reports</small--></h1>
     <?php } else if ($this->router->fetch_class()=='category' && $this->uri->segment(3)!=''){ 
	 ?>
      <h1><?php echo trans($this->uri->segment(2)) ?>&nbsp; <i class="fa fa-angle-right"></i> &nbsp; <?php echo trans($this->uri->segment(3)); ?><!--small>statistics & reports</small--></h1>
       <?php } else if ($this->router->fetch_class()=='category' && $this->uri->segment(3)==''){ 
	 ?>
      <h1><?php echo trans($this->uri->segment(2)) ?> <!--small>statistics & reports</small--></h1>
     <?php } ?>
    </div>
            
			