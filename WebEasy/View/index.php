<div class="jumbotron jumbotron-fluid">
  <div class="container">
		<div> Пользователь: <?php echo $this->user;?></div>
		<div>История доверности Экстрасенс 1:  
		<?php if(isset($this->historyExtrasenceOne)):
			echo $this->historyExtrasenceOne;
			else: echo '0';
			endif;?>%</div>
		<div>История доверности Экстрасенс 2:  
		<?php if(!isset($this->historyExtrasenceTwo) AND !$this->historyExtrasenceTwo = ""):
			echo  '0';
			else: echo $this->historyExtrasenceTwo;
			endif;?>%</div>
	    <table class="table table-striped">
	  <thead>
		<tr>
		  <th scope="col" >Экстрасенс 1</th>
		  <th scope="col">Экстрасенс 2</th>
		  <th scope="col">Введенные числа пользователем</th>
		</tr>
	  </thead>
  <?php if($this->data):?>
	  <tbody>
	  <?php foreach($this->data as $value){?>
		<tr>
		   <td><?php echo $value['reliabilityExtrasenceOne']; ?></td>
		  <td><?php echo $value['reliabilityExtrasenceTwo']; ?></td>
		  <td><?php echo $value['number']; ?></td>
		  </tr>
	  <?php }?>
	   
	  </tbody>
 
  <?php endif;?>
</table>
 <h3>Догадки экстрасенсов:</h3>
  
	<div>Экстрасенс 1: <?php echo $this->extrasenceNumberOne;?></div>
	<div> Экстрасенс 2:  <?php echo $this->extrasenceNumberTwo;?></div>
	
	<?php if(getError()):?>
	<div class="alert alert-danger" role="alert">
		Вы ввели не двухзначное число или строку
	</div>
	<?php endif;?>
 	  <form action="/rand"  method="get">
  		  <div class="form-group">
			<label for="exampleInputName">Введите двухзначное число</label>
			<input name="number" type="number" class="form-control"  placeholder="Введите число" required>
		 </div>
        <button type="submit" class="btn btn-primary">Отправить</button>
 	  </form> 
  </div>
</div>
<!-- Button trigger modal -->







