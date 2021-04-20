<div class="jumbotron jumbotron-fluid">
  <div class="container">
  	<?php $i = 0;?>
	 <?php foreach($this->resultExtrasence as $key => $value){?>
	 <?php $i++;?>
		<div> Экстрасенс <?php echo $i;?>:  <?php echo $value?></div>
	  <?php }?>
	<a href="/" role="button" class="btn btn-primary" >OK</a>
  </div>
</div>