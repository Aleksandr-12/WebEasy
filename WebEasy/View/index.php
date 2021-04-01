<div class="jumbotron jumbotron-fluid">
  <div class="container">
		<div> Пользователь: <?php echo $_SESSION['user']?></div>
		<div>История доверности Экстрасенс 1:  <?php echo $_SESSION["history_extra_1"]?>%</div>
		<div>История доверности Экстрасенс 2:  <?php echo $_SESSION["history_extra_2"]?>%</div>
	    <table class="table table-striped">
	  <thead>
		<tr>
		  <th scope="col" >Экстрасенс 1</th>
		  <th scope="col">Экстрасенс 2</th>
		  <th scope="col">Введенные числа пользователем</th>
		</tr>
	  </thead>
  <?php if($_SESSION['array_result']):?>
	  <tbody>
	  <?php foreach($_SESSION['array_result'] as $value){?>
		<tr>
		   <td><?php echo $value['dogatka_extra_1']; ?></td>
		  <td><?php echo $value['dogatka_extra_2']; ?></td>
		  <td><?php echo $value['number']; ?></td>
		  </tr>
	  <?php }?>
	   
	  </tbody>
 
  <?php endif;?>
</table>
 <h3>Догадки экстрасенсов:</h3>
  
	<div>Экстрасенс 1: <?php echo $_SESSION["dogat_extra_1"]?></div>
	<div> Экстрасенс 2:  <?php echo $_SESSION["dogat_extra_2"]?></div>

 	  <form action="/rand"  method="get">
  		  <div class="form-group">
			<label for="exampleInputName">Число</label>
			<input name="number" type="number" class="form-control"  placeholder="Введите число" required>
		 </div>
        <button type="submit" class="btn btn-primary">Отправить</button>
 	  </form> 
  </div>
</div>
<!-- Button trigger modal -->







